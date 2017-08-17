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

class CarModel
{
    private static $base = '/models';
    private $client = null;
    private $brandId = null;
    private $manuId = null;
    private $seriesId = null;

    /**
     * CarModel constructor.
     *
     * @param object  $client   HepcClient对象
     * @param integer $brandId  汽车品牌Id
     * @param integer $manuId   汽车厂商Id
     * @param integer $seriesId 车系Id
     */
    public function __construct($client = null, $brandId = null, $manuId = null, $seriesId = null)
    {
        $this->client = $client;
        $this->brandId = $brandId;
        $this->manuId = $manuId;
        $this->seriesId = $seriesId;
    }

    /**
     * 获取所有车型列表.
     *
     * （可选参数:yearId,capacityId）
     *
     * @param integer $yearId     年款Id
     * @param integer $capacityId 排量Id
     * @param string $year_order 按年款的排序类型("ASC"：正序；"DESC"：倒序；默认为倒序，先显示最新的年款)
     * @return object carModels list
     */
    public function getModels($yearId = null, $capacityId = null, $year_order = null)
    {
        if($yearId === '') $yearId = null;

        if($capacityId === '') $capacityId = null;
        return $this->call('', ['year_id' => $yearId, 'capacity_id' => $capacityId, 'year_order' => $year_order,]);
    }

    /**
     * 通过车型id获取车型详情.
     *
     * @param integer $modelId 车型Id
     * @return object one carModel detail
     */
    public function getModelById($modelId = null)
    {
        return $this->call('/' . $modelId);
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/brands/' . $this->brandId . '/sub-brands/' . $this->manuId . '/series/' . $this->seriesId . self::$base . $path,
            $params);
    }

}