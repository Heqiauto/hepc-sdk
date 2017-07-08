<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\CarManu;
use PHPUnit\Framework\TestCase;

class CarManuTest extends TestCase
{
    public function testGetCarManu()
    {
        $client = UnitData::client();
        $test = new CarManu($client, UnitData::$brand_id);
        $test->getCarManus();
        $this->assertEquals("/brands/" . UnitData::$brand_id . "/manus", UnitData::debugUrl($client));
    }
}
