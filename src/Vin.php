<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 * @version   1.0.0
 */


class Hepc_SDK_Vin
{
    private static $base = '/vin';
    private $client = null;

    /**
     * Category constructor.
     *
     * @param object $client HepcClient对象
     */
    public function __construct($client = null)
    {
        $this->client = $client;
    }

    /**
     * 通过vin码获取车型信息
     *
     * @param $vin
     * @return mixed
     */
    public function getCarModelByVin($vin)
    {
        return $this->call('/' . $vin);
    }

    private function call($path = '', $params = array())
    {
        return $this->client->call(self::$base . $path, $params);
    }
}