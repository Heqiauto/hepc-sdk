<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Heqiauto\HepcSdk;

class Search
{
    private static $base = '/search';
    private $client = null;

    /**
     * Search constructor.
     *
     * @param object $client HepcClient对象
     */
    public function __construct($client = null)
    {
        $this->client = $client;
    }

    /**
     * 获取搜索建议.
     *
     * @param string $query 关键字
     * @return array searchSuggest list
     */
    public function getSearchSuggest($query = null)
    {
        if ($query === null) {
            return null;
        }

        return $this->call('', ['query' => $query, 'action' => 'suggest']);
    }

    /**
     * 获取搜索结果.
     *
     * @param string $query 关键字
     * @return array search list
     */
    public function getSearchList($query = null)
    {
        if (empty($query)) {
            return null;
        }

        return $this->call('', ['query' => $query, 'action' => 'list']);
    }

    /**
     * 通过查询码搜索配件
     *
     * @param string $query
     * @return array
     */
    public function searchByIndexCode($query = null)
    {
        if (empty($query)) {
            return null;
        }

        return $this->call('/index-code', ['query' => $query]);
    }

    /**
     * 通过出厂编码和规格型号搜索配件
     *
     * @param string $query
     * @param integer $categoryId
     * @param null $brandId
     * @param null $groupId
     * @param null $page
     * @param int $pagesize
     * @return void
     */
    public function searchPart($query, $categoryId = null, $brandId = null, $groupId = null, $page = null, $pagesize = 10)
    {
        if (empty($query)) {
            return null;
        }

        return $this->call('/search-part', [
            'query' => $query,
            'category_id' => $categoryId,
            'brand_id' => $brandId,
            'group_id' => $groupId,
            'page' => $page,
            'page_size' => $pagesize,
        ]);
    }

    /**
     * 复合搜索，输出车系，品牌，配件，品类匹配项
     *
     * @param null $query
     * @param null $type 指定搜索类型(part,part_brand,car_series,part_category_virtual)
     * @return null
     */
    public function advancedSearch($query = null, $type = null)
    {
        if ($query === null) {
            return null;
        }

        return $this->call('/advanced-search', ['query' => $query, 'type' => $type]);
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call(self::$base . $path, $params);
    }
}
