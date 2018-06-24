<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function Psy\debug;

class Webhook extends Model
{
    public $table = 'webhooks';
    public $fillable = ['uid', 'code'];

    public function model()
    {
        return Webhook::class;
    }

    public function createCode($data)
    {

        return Webhook::updateOrCreate([
            'uid' => !empty($data['uid']) ? $data['uid'] : '',
            'code' => !empty($data['code']) ? $data['code'] : ''
        ]);
    }
}
