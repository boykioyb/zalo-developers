<?php

namespace App\Http\Controllers;

use App\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use function Psy\debug;
use Zalo\Zalo;
use Zalo\ZaloConfig;
use Zalo\ZaloEndpoint;

class HomeController extends Controller
{
    public $zalo;
    public $session;
    public $webhook;
    public $baseUrl = 'http://e31a29a0.ngrok.io/';

    public function __construct(Session $session, Webhook $webhook)
    {
        $this->webhook = $webhook;
        $this->session = $session;
        $this->zalo = new Zalo(ZaloConfig::getInstance()->getConfig());
    }

    public function index()
    {

        dd($this->zalo);
        die;
    }

    public function login(Request $request)
    {
        $helper = $this->zalo->getRedirectLoginHelper();
        $callBackUrl = $this->baseUrl . "webhook";
        $loginUrl = $helper->getLoginUrl($callBackUrl); // This is login url
        $oauthCode = isset($_GET['code']) ? $_GET['code'] : "THIS NOT CALLBACK PAGE !!!"; // get oauthoauth code from url params
        $accessToken = $helper->getAccessToken($callBackUrl); // get access token
        if ($accessToken != null) {
            $expires = $accessToken->getExpiresAt(); // get expires time
        }
        dd($expires);
        die;
        return Redirect::to($loginUrl);
    }

    public function webhook(Request $request)
    {
        echo "hello webhook";
        $data = $request->request->all();

        $this->webhook->createCode($data);
        return Redirect::back()->withInput();
    }

    public function listFriend()
    {
        $data = $this->webhook::all();
        return view('zalo.list', compact('data'));
    }

    public function detail($uid)
    {
        $find = $this->webhook::where('uid', $uid)->first();
        if (!empty($find)) {
            $accessToken = $find->code;
            $params = ['offset' => 0, 'limit' => 10, 'fields' => "id, name"];
            $response = $this->zalo->get(ZaloEndpoint::API_GRAPH_ME, $params, $accessToken);
            $result = $response->getDecodedBody();
            dd($result);
            die;
        }
    }
}
