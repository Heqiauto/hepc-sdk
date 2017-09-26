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

class CategoryVirtual
{
    private static $base = '/category-virtual';
    private $client = null;
    private $groupId = null;

    /**
     * Category constructor.
     *
     * @param object $client HepcClient对象
     * @param integer $group_id 虚拟目录组id
     */
    public function __construct($client = null , $group_id)
    {
        $this->groupId = $group_id;
        $this->client = $client;
    }

    /**
     * 通过虚拟目录id获取该目录下的子目录和节点
     *
     * @param integer $categoryId 为空时返回一级目录
     * @return array 包含本身目录信息和子集信息
     */
    public function getCategoryVirtual($categoryId = NULL)
    {
        $path = empty($categoryId) ? '' : '/' . $categoryId;

        return $this->call($path);
    }

    /**
     * 获取该虚拟目录详情
     *
     * @param integer $categoryId 配件虚拟目录Id
     * @return array
     */
    public function getCategoryVirtualDetail($categoryId = null)
    {
        return $this->call('/' . $categoryId, ['detail' => true]);
    }

    /**
     * 获取该虚拟目录配件列表
     *
     * @param integer $categoryId 配件虚拟目录Id
     * @param integer $brandId  配件品牌Id
     * @param integer $modelId  车型Id
     * @param array $pvIds  属性值数组
     * @param integer $page  配件分页
     * @param integer $limit  每页条数(默认10条)
     * @return array
     */
    public function getPartList($categoryId = NULL, $brandId = NULL, $modelId = NULL, $pvIds = [], $page = NULL, $limit = 10)
    {
        return $this->call('/' . $categoryId . '/parts', [
            'brand_id' => $brandId,
            'model_id' => $modelId,
            'pv_ids' => json_encode($pvIds),
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/groups/' . $this->groupId . self::$base . $path, $params);
    }
}