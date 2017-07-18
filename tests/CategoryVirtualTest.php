<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\CategoryVirtual;
use PHPUnit\Framework\TestCase;

class CategoryVirtualTest extends TestCase
{
    public function testGetCategories()
    {
        $client = UnitData::client();
        $test = new CategoryVirtual($client, UnitData::$group_id);
        $test->getCategoryVirtual(UnitData::$category_virtual_id);
        $this->assertEquals('/groups/' . UnitData::$group_id . '/category-virtual/' . UnitData::$category_virtual_id, UnitData::debugUrl($client));
    }

    public function testGetCategoryDetail()
    {
        $client = UnitData::client();
        $test = new CategoryVirtual($client, UnitData::$group_id);
        $test->getCategoryVirtualDetail(UnitData::$category_virtual_id);
        $this->assertEquals('/groups/' . UnitData::$group_id . '/category-virtual/' . UnitData::$category_virtual_id, UnitData::debugUrl($client));
    }
}