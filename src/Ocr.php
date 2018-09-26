<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class Ocr
{
    private static $base = '/ocr';
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
     * 识别图片中的vin码(使用前先将图片按base64编码)
     *
     * @param string $fileData base64码
     * @return mixed
     */
    public function getVinByOcr($fileData)
    {
        return $this->call('/vin', ['file_data' => $fileData], 'POST');
    }

    /**
     * 识别图片中的vin码支持行驶证(使用前先将图片base64编码)
     * @param $fileData
     * @return mixed
     */
    public function getVinPro($fileData)
    {
        return $this->call('/vin-pro', ['file_data' => $fileData], 'POST');
    }


    /**
     * 识别图片中的车牌号(使用前先将图片按base64编码)
     *
     * @param string $fileData base64码
     * @return mixed
     */
    public function getPlateByOcr($fileData)
    {
        return $this->call('/plate', ['file_data' => $fileData], 'POST');
    }

    private function call($path = '', $params = [], $method = '')
    {
        return $this->client->call(self::$base . $path, $params, $method);
    }
}