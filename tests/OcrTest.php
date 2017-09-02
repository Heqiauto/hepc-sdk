<?php

namespace Tests;

use Heqiauto\HepcSdk\Ocr;
use PHPUnit\Framework\TestCase;

class OcrTest extends TestCase
{
    public function testGetPlateByOcr()
    {
        $client = UnitData::client();
        $test = new Ocr($client);
        $test->getPlateByOcr(UnitData::getBase64(UnitData::$plate_url));
        $this->assertEquals('/ocr/plate', UnitData::debugUrl($client));
    }

    public function testGetVinByOcr()
    {
        $client = UnitData::client();
        $test = new Ocr($client);
        $test->getVinByOcr(UnitData::getBase64(UnitData::$vin_url));
        $this->assertEquals('/ocr/vin', UnitData::debugUrl($client));
    }

}