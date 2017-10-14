<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class CarSubBrand
{
    private static $base = '/sub-brands';
    private $client = null;
    private $brandId = null;

    /**
     * CarSubBrand constructor.
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
     * 获取品牌下的子品牌.
     *
     * @return array carSubBrand list
     */
    public function getCarSubBrands()
    {
        return $this->call();
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/brands/' . $this->brandId . self::$base . $path, $params);
    }
}