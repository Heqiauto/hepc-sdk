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
     * 通过品类id获取该目录下的子目录和节点
     *
     * @param integer $category_id 为空时返回一级目录
     * @return mixed
     */
    public function getCategoryVirtual($category_id = NULL)
    {
        return $this->call('', ['category_id' => $category_id]);
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call('/groups/' . $this->groupId . self::$base . $path, $params);
    }
}