<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 * @version   1.0.0
 */

namespace Heqiauto\HepcSdk;

class CarSeries
{
    private static $base = '/series';
    private $client = null;
    private $brandId = null;
    private $manuId = null;

    /**
     * CarSeries constructor.
     *
     * @param object  $client  HepcClient对象
     * @param integer $brandId 汽车品牌Id
     * @param integer $manuId  汽车厂商Id
     */
    public function __construct($client = null, $brandId = null, $manuId = null)
    {
        $this->client = $client;
        $this->brandId = $brandId;
        $this->manuId = $manuId;
    }

    /**
     * 获取车系列表.
     *
     * @return array series list
     */
    public function getSeries()
    {
        return $this->call();
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/brands/' . $this->brandId . '/manus/' . $this->manuId . self::$base . $path,
            $params);
    }

    /**
     * 通过车系id获得车系年款.
     *
     * @param integer $seriesId 车系Id
     * @return array series years list
     */
    public function getYearsBySeriesId($seriesId)
    {
        return $this->call('/' . $seriesId . '/years');
    }

    /**
     * 通过车系id获得车系排量.
     *
     * @param integer $seriesId 车系Id
     * @return array series capacities list
     */
    public function getCapacitiesBySeriesId($seriesId)
    {
        return $this->call('/' . $seriesId . '/capacities');
    }
}