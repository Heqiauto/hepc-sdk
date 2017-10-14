<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class CarSeries
{
    private static $base = '/series';
    private $client = null;
    private $brandId = null;
    private $subBrandId = null;

    /**
     * CarSeries constructor.
     *
     * @param object  $client  HepcClient对象
     * @param integer $brandId 汽车品牌Id
     * @param integer $subBrandId  汽车子品牌Id
     */
    public function __construct($client = null, $brandId = null, $subBrandId = null)
    {
        $this->client = $client;
        $this->brandId = $brandId;
        $this->subBrandId = $subBrandId;
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
        return $this->client->call('/brands/' . $this->brandId . '/sub-brands/' . $this->subBrandId . self::$base . $path,
            $params);
    }

    /**
     * 通过车系id获得车系年款.
     *
     * @param integer $seriesId 车系Id
     * @param integer $displacementId 可选参数（通过displacementId和seriesId筛选出对应的年款）
     * @return array series years list
     */
    public function getYearsBySeriesId($seriesId, $displacementId = null)
    {
        return $this->call('/' . $seriesId . '/years', ['displacement_id' => $displacementId]);
    }

    /**
     * 通过车系id获得车系排量.
     *
     * @param integer $seriesId 车系Id
     * @param integer $yearId 可选参数（通过yearId和seriesId筛选出对应的排量）
     * @return array series displacements list
     */
    public function getDisplacementsBySeriesId($seriesId, $yearId = null)
    {
        return $this->call('/' . $seriesId . '/displacements', ['year_id' => $yearId]);
    }
}