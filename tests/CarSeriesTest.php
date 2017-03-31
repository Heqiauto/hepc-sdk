<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\CarSeries;
use PHPUnit\Framework\TestCase;

class CarSeriesTest extends TestCase
{
    private $client;
    /**
     * @var CarSeries
     */
    private $carSeries;

    protected function setUp()
    {
        $this->client = UnitData::client();
        $this->carSeries = new CarSeries($this->client, UnitData::$brand_id, UnitData::$manu_id);
    }

    public function testGetSeries()
    {
        $this->carSeries->getSeries();
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/manus/' . UnitData::$manu_id . '/series',
            UnitData::debugUrl($this->client));
    }

    public function testGetYearsBySeriesId()
    {
        $this->carSeries->getYearsBySeriesId(UnitData::$series_id);
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/manus/' . UnitData::$manu_id . '/series/' .
            UnitData::$series_id . '/years',
            UnitData::debugUrl($this->client));
    }

    public function testGetCapacityBySeriesId()
    {
        $this->carSeries->getCapacitiesBySeriesId(UnitData::$series_id);
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/manus/' . UnitData::$manu_id . '/series/' .
            UnitData::$series_id . '/capacities',
            UnitData::debugUrl($this->client));
    }
}
