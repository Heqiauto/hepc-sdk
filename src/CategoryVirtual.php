<?php

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

    private function call($path = '', $params = [])
    {
        return $this->client->call('/groups/' . $this->groupId . self::$base . $path, $params);
    }
}