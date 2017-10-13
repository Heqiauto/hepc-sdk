<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 * @version   1.2.5
 */

namespace Heqiauto\HepcSdk;

class Part
{
    private static $base = '/parts';
    private $client = null;
    private $categoryId = null;

    /**
     * Part constructor.
     *
     * @param object  $client     HepcClient对象
     * @param integer $categoryId 配件目录Id
     */
    public function __construct($client = null, $categoryId = null)
    {
        $this->client = $client;
        $this->categoryId = $categoryId;
    }

    /**
     * 获取配件总数.
     *
     * @return int part count
     */
    public function getPartCounts()
    {
        return $this->call('', ['action' => 'counts']);
    }

    /**
     * 通过配件品牌id获取品牌关联的配件列表.
     *
     * @param int $brandId 配件品牌Id
     * @return array|bool part list
     */
    public function getPartsByBrandId($brandId)
    {
        if ($brandId === null) {
            return false;
        }

        return $this->call('', ['brand_id' => $brandId]);
    }

    /**
     * 通过车系id获取车型关联的配件列表.
     *
     * @param int $seriesId 车系Id
     * @return array|bool part list
     */
    public function getPartsBySeriesId($seriesId)
    {
        if ($seriesId === null) {
            return false;
        }

        return $this->call('', ['series_id' => $seriesId]);
    }

    /**
     * 通过车型id获取车型关联的配件列表.
     *
     * @param int $modelId 车型Id
     * @param int $brandId 配件品牌Id (可选参数，用于筛选)
     * @return array|bool part list
     */
    public function getPartsByCarModel($modelId, $brandId = null)
    {
        if ($modelId === null) {
            return false;
        }

        return $this->call('', ['model_id' => $modelId, 'brand_id' => $brandId]);
    }

    /**
     * 通过配件psn获取适配的车系列表
     *
     * @param string $psn 配件唯一编码
     * @return array|bool part list
     */
    public function getSeriesFitsByPsn($psn)
    {
        return $this->call('/' . $psn . '/fits', ['type' => 'series']);
    }

    /**
     * 分页查询所有配件.
     *
     * @param int $start 分页起始
     * @param int $limit 每页条数(默认10条)
     * @return array part list
     */
    public function getParts($start, $limit)
    {
        return $this->call('', ['start' => $start, 'limit' => $limit]);
    }

    /**
     * 通过psn查询配件详情.
     *
     * @param string $psn 配件唯一编码
     * @return array one part
     */
    public function getPartByPsn($psn)
    {
        return $this->call('/' . $psn);
    }

    /**
     * 通过psn查询配件扩展属性.
     *
     * @param string $psn 配件唯一编码
     * @return array part ext list
     */
    public function getPartExt($psn)
    {
        return $this->call('/' . $psn . '/ext');
    }

    /**
     * 通过psn查询配件Oe码.
     *
     * @param string $psn 配件唯一编码
     * @return array one part oe
     */
    public function getPartOe($psn)
    {
        return $this->call('/' . $psn . '/indexes/oe');
    }

    /**
     * 通过psn查询配件uni码.
     *
     * @param string $psn 配件唯一编码
     * @return array one part uni
     */
    public function getPartUni($psn)
    {
        return $this->call('/' . $psn . '/indexes/uni');
    }

    /**
     * 通过psn查询配件使用码.
     *
     * @param string $psn 配件唯一编码
     * @return array one part usage
     */
    public function getPartUsage($psn)
    {
        return $this->call('/' . $psn . '/indexes/usage');
    }


    private function call($path = '', $params = [])
    {
        return $this->client->call('/categories/' . $this->categoryId . self::$base . $path, $params);
    }
}
