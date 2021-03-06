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
    private $subBrandId = null;
    private $seriesId = null;

    /**
     * CarModel constructor.
     *
     * @param object  $client   HepcClient对象
     * @param integer $brandId  汽车品牌Id
     * @param integer $subBrandId   汽车子品牌Id
     * @param integer $seriesId 车系Id
     */
    public function __construct($client = null, $brandId = null, $subBrandId = null, $seriesId = null)
    {
        $this->client = $client;
        $this->brandId = $brandId;
        $this->subBrandId = $subBrandId;
        $this->seriesId = $seriesId;
    }

    /**
     * 获取所有车型列表.
     *
     * （可选参数:yearId,capacityId）
     *
     * @param integer $yearId 年款Id
     * @param integer $displacement 排量Id
     * @param integer $engineCodeId 发动机型号Id
     * @param string $year_order 按年款的排序类型("ASC"：正序；"DESC"：倒序；默认为倒序，先显示最新的年款)
     * @param integer $carType 车型库类型
     * @return array carModels list
     */
    public function getModels($yearId = null, $displacement = null, $engineCodeId = null, $year_order = null, $carType = 1)
    {
        if ($yearId === '') $yearId = null;
        if ($displacement === '') $displacement = null;
        if ($engineCodeId === '') $engineCodeId = null;

        return $this->call('', ['year_id' => $yearId, 'displacement_id' => $displacement, 'engine_code_id' => $engineCodeId, 'year_order' => $year_order, 'car_type' => $carType]);
    }

    /**
     * 通过车型id获取车型详情.
     *
     * @param integer $modelId 车型Id
     * @return array one carModel detail
     */
    public function getModelById($modelId = null)
    {
        return $this->call('/' . $modelId);
    }

    /**
     * 根据modelId查找车型信息
     * @param null $modelId
     * @return mixed
     */
    public function getCarByModelId($modelId = null)
    {
        return $this->callBack('/' . $modelId);

    }

    /**
     * 通过vin查询车型信息
     * @param null $vin
     * @return mixed
     */
    public function getModelByVin($vin = null)
    {
        return $this->callBack('/' . $vin);
    }

    /**
     * 识别图片中的vin码(使用前先将图片按base64编码)
     * @param $fileData
     * @return mixed
     */
    public function getModelByOcr($fileData,$only = '')
    {
        return $this->callBack('/get-car-models', ['file' => $fileData ,'only' => $only], 'POST');
    }


    private function callBack($path = '', $params = [], $method = 'GET')
    {
        return $this->client->call(self::$base . $path, $params,$method);
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/brands/' . $this->brandId . '/sub-brands/' . $this->subBrandId . '/series/' . $this->seriesId . self::$base . $path,
            $params);
    }

}