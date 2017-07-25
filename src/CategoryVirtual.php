<?php


class Hepc_SDK_CategoryVirtual
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
    public function __construct($client = null, $group_id)
    {
        $this->groupId = $group_id;
        $this->client = $client;
    }

    /**
     * 通过虚拟目录id获取该目录下的子目录和节点
     *
     * @param integer $categoryId 为空时返回一级目录
     * @return mixed 包含本身目录信息和子集信息
     */
    public function getCategoryVirtual($categoryId = null)
    {
        $path = empty($categoryId) ? '' : '/' . $categoryId;

        return $this->call($path);
    }

    private function call($path = '', $params = array())
    {
        return $this->client->call('/groups/' . $this->groupId . self::$base . $path, $params);
    }

    /**
     * 获取该虚拟目录详情
     *
     * @param integer $categoryId 配件虚拟目录Id
     * @return mixed
     */
    public function getCategoryVirtualDetail($categoryId = null)
    {
        return $this->call('/' . $categoryId, array('detail' => true));
    }
}