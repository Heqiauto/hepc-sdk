<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class CarManu
{
    private static $base = '/manus';
    private $client = null;
    private $brandId = null;

    /**
     * CarManu constructor.
     *
     * @param object  $client  HepcClient对象
     * @param integer $brandId 汽车品牌Id
     */
    public function __construct($client = null, $brandId = null)
    {
        $this->client = $client;
        $this->brandId = $brandId;
    }

    /**
     * 获取品牌下的厂商.
     *
     * @return array carManus list
     */
    public function getCarManus()
    {
        return $this->call();
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/brands/' . $this->brandId . self::$base . $path, $params);
    }
}