<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\CarSubBrand;
use PHPUnit\Framework\TestCase;

class CarSubBrandTest extends TestCase
{
    public function testGetCarSubBrand()
    {
        $client = UnitData::client();
        $test = new CarSubBrand($client, UnitData::$brand_id);
        $test->getCarSubBrands();
        $this->assertEquals("/brands/" . UnitData::$brand_id . "/sub-brands", UnitData::debugUrl($client));
    }
}
