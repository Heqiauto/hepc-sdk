<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\CarModel;
use PHPUnit\Framework\TestCase;

class CarModelTest extends TestCase
{
    private $client;
    /**
     * @var CarModel
     */
    private $carModel;
    
    protected function setUp()
    {
        $this->client = UnitData::client();
        $this->carModel = new CarModel($this->client, UnitData::$brand_id, UnitData::$manu_id, UnitData::$series_id);
    }

    public function testGetModels()
    {
        $this->carModel->getModels(UnitData::$series_year_id, UnitData::$series_capacity_id);
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/manus/' . UnitData::$manu_id . '/series/'.
            UnitData::$series_id . '/models',
            UnitData::debugUrl($this->client));
    }

    public function testGetModelById()
    {
        $this->carModel->getModelById(UnitData::$model_id);
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/manus/' . UnitData::$manu_id . '/series/'.
            UnitData::$series_id . '/models/' . UnitData::$model_id, UnitData::debugUrl($this->client));
    }
}
