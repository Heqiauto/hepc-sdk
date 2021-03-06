<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class Category
{
    private static $base = '/categories';
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
     * 获取子目录列表.
     *
     * (可选参数: $categoryId)
     *
     * @param integer $categoryId 配件目录Id (不传id则为查询所有一级目录)
     * @return array part categories list
     */
    public function getCategories($categoryId = null)
    {
        $path = empty($categoryId) ? '' : '/' . $categoryId;

        return $this->call($path);
    }

    /**
     * 获取该目录或节点详情
     *
     * @param integer $categoryId 配件目录或节点Id
     * @return array
     */
    public function getCategoryDetail($categoryId = null)
    {
        return $this->call('/' . $categoryId, ['detail' => true]);
    }

    /**
     * 目录节点搜索
     *
     * @param string $query 搜索条件
     * @return array
     */
    public function getSearchCategory($query)
    {
        return $this->call('/' . $query . '/search');
    }

    /**
     * 目录节点搜索(含拼音匹配)
     *
     * @param string $query 搜索条件
     * @return array
     */
    public function getSearchEnhanced($query)
    {
        return $this->call('/' . $query . '/search-enhanced');
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call(self::$base . $path, $params);
    }
}
