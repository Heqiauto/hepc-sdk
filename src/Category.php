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
     * 获取目录列表.
     *
     * (可选参数: $categoryId)
     *
     * @param integer $categoryId 配件目录Id (不传id则为查询所有目录)
     * @return object part categories list
     */
    public function getCategories($categoryId = null)
    {
        if (null === $categoryId) {
            $categoryId = 1;
        }

        return $this->call('/' . $categoryId);
    }

    public function getSearchCategory($query)
    {
        return $this->call('/' . $query . '/search');
    }

    private function call($path = '')
    {
        return $this->client->call(self::$base . $path);
    }
}
