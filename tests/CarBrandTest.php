<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\CarBrand;
use PHPUnit\Framework\TestCase;

class CarBrandTest extends TestCase
{
    public function testGetCarBrands()
    {
        $client = UnitData::client();
        $test = new CarBrand($client);
        $test->getCarBrands();
        $this->assertEquals('/brands', UnitData::debugUrl($client));
    }

    public function testGetCarBrandsBySocket()
    {
        $client = UnitData::client(['connect' => 'socket']);
        $test = new CarBrand($client);
        $test->getCarBrands();
        $this->assertEquals('/brands', UnitData::debugUrl($client));
    }
}
