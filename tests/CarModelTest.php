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
        $this->carModel = new CarModel($this->client, UnitData::$brand_id, UnitData::$sub_brand_id, UnitData::$series_id);
    }

    public function testGetModels()
    {
        $this->carModel->getModels(UnitData::$series_year_id, UnitData::$series_displacement_id);
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/sub-brands/' . UnitData::$sub_brand_id . '/series/'.
            UnitData::$series_id . '/models',
            UnitData::debugUrl($this->client));
    }

    public function testGetModelById()
    {
        $this->carModel->getModelById(UnitData::$model_id);
        $this->assertEquals('/brands/' . UnitData::$brand_id . '/sub-brands/' . UnitData::$sub_brand_id . '/series/'.
            UnitData::$series_id . '/models/' . UnitData::$model_id, UnitData::debugUrl($this->client));
    }
}
