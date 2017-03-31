<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testGetCategories()
    {
        $client = UnitData::client();
        $test = new Category($client);
        $test->getCategories(UnitData::$category_id);
        $this->assertEquals('/categories/' . UnitData::$category_id, UnitData::debugUrl($client));
    }
}
