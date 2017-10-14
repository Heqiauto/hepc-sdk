<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class Vin
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
     * @param integer $type 数据查询源类型选择,可选1，2, 3(类型1失败时可以尝试类型2,3，默认类型1)
     * @return mixed
     */
    public function getCarModelByVin($vin, $type = 1)
    {
        return $this->call('/' . $vin, ['type' => $type]);
    }

    /**
     * 通过vin查询车型详情信息
     *
     * @param string $vin
     * @return mixed
     */
    public function getCarModelDetailByVin($vin)
    {
        return $this->call('/' . $vin .'/detail');
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call(self::$base . $path, $params);
    }
}