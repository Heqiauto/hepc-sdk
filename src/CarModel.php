<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
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
     * @return object carModels list
     */
    public function getModels($yearId = null, $capacityId = null)
    {
        return $this->call('', ['year_id' => $yearId, 'capacity_id' => $capacityId]);
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/brands/' . $this->brandId . '/manus/' . $this->manuId . '/series/' . $this->seriesId . self::$base . $path,
            $params);
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
}