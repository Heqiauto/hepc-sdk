<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 * @version   1.2.4
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
     * @param string $ocr base64码
     * @return mixed
     */
    public function getVinByOcr($ocr)
    {
        return $this->call('/vin', ['file_data' => $ocr], 'POST');
    }

    /**
     * 识别图片中的车牌号(使用前先将图片按base64编码)
     *
     * @param string $ocr base64码
     * @return mixed
     */
    public function getPlateByOcr($ocr)
    {
        return $this->call('/plate', ['file_data' => $ocr], 'POST');
    }

    private function call($path = '', $params = [], $method = '')
    {
        return $this->client->call(self::$base . $path, $params, $method);
    }
}