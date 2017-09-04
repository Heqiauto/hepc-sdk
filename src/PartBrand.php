<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 * @version   1.2.3
 */

namespace Heqiauto\HepcSdk;

class PartBrand
{
    private static $base = '/part-brands';
    private $client = null;

    /**
     * PartBrand constructor.
     *
     * @param object $client HepcClient对象
     */
    public function __construct($client = null)
    {
        $this->client = $client;
    }

    /**
     * 获取所有配件品牌.
     *
     * @return array part brand list
     */
    public function getPartBrands()
    {
        return $this->call();
    }

    private function call($path = '', $params = [])
    {
        return $this->client->call(self::$base . $path, $params);
    }

    /**
     * 通过品类id获取关联的配件品牌.
     *
     * @param int $categoryId 配件品类Id
     * @return array|bool part brand list
     */
    public function getBrandsByCategoryId($categoryId)
    {
        if ($categoryId === null) {
            return false;
        }

        return $this->call('', ['category_id' => $categoryId]);
    }
}