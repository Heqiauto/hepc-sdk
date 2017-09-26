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

    private function call($path = '', $params = [])
    {
        return $this->client->call(self::$base . $path, $params);
    }
}