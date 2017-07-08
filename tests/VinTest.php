<?php

namespace Tests;

use Heqiauto\HepcSdk\Vin;

class VinTest  extends TestCase
{
    public function testGetCarModelByVin()
    {
        $client = UnitData::client();
        $test = new Vin($client);
        $test->getCarModelByVin(UnitData::$vin);
        $this->assertEquals('/vin/' . UnitData::$vin, UnitData::debugUrl($client));
    }
}