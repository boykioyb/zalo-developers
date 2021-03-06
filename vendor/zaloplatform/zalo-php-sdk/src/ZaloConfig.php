<?php
/**
 * Zalo © 2017
 *
 */

namespace Zalo;

/**
 * Class ZaloConfig
 *
 * @package Zalo
 */
class ZaloConfig {

    /** @var self */
    protected static $instance;
    
    /** config your app id here */
    const ZALO_APP_ID_CFG = "4017297898852425598";
    
    /** config your app secret key here */
    const ZALO_APP_SECRET_KEY_CFG = "PKZ5VMm4QYu6vIX1d008";
    
    /** config your offical account id here */
    const ZALO_OA_ID_CFG = "4388051590925847044";
    
    /** config your offical account secret key here */
    const ZALO_OA_SECRET_KEY_CFG = "G4J3VoqIV6OY0L03er0W";

    /**
     * Get a singleton instance of the class
     *
     * @return self
     * @codeCoverageIgnore
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get zalo sdk config
     * @return []
     */
    public function getConfig() {
        return [
            'app_id' => static::ZALO_APP_ID_CFG,
            'app_secret' => static::ZALO_APP_SECRET_KEY_CFG,
            'oa_id' => static::ZALO_OA_ID_CFG,
            'oa_secret' => static::ZALO_OA_SECRET_KEY_CFG
        ];
    }

}
