<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\Part;
use PHPUnit\Framework\TestCase;

class PartTest extends TestCase
{
    private $client;
    /**
     * @var Part
     */
    private $part;

    public function setUp()
    {
        $this->client = UnitData::client();
        $this->part = new Part($this->client, UnitData::$category_child_id);
    }

    public function testGetPartCounts()
    {
        $this->part->getPartCounts();
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts',
            UnitData::debugUrl($this->client));
    }

    public function testGetPartsByBrandId()
    {
        $this->part->getPartsByBrandId(UnitData::$part_brand_id);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts',
            UnitData::debugUrl($this->client));
    }

    public function testGetPartByPsn()
    {
        $this->part->getPartByPsn(UnitData::$psn);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts/' . UnitData::$psn,
            UnitData::debugUrl($this->client));
    }

    public function testGetPartExt()
    {
        $this->part->getPartExt(UnitData::$psn);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts/' . UnitData::$psn . '/ext',
            UnitData::debugUrl($this->client));
    }

    public function testGetPartsByCarModel()
    {
        $this->part->getPartsByCarModel(UnitData::$model_id);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts',
            UnitData::debugUrl($this->client));
    }

    public function testGetSeriesFitsByPsn()
    {
        $this->part->getSeriesFitsByPsn(UnitData::$psn);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts/' . UnitData::$psn . '/fits',
            UnitData::debugUrl($this->client));
    }

    public function testGetBrandReplacement()
    {
        $this->part->getBrandReplacement(UnitData::$psn);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts/' . UnitData::$psn . '/replacements/brand',
            UnitData::debugUrl($this->client));
    }

    public function testGetOriginalReplacement()
    {
        $this->part->getOriginalReplacement(UnitData::$psn);
        $this->assertEquals('/categories/' . UnitData::$category_child_id . '/parts/' . UnitData::$psn . '/replacements/original',
            UnitData::debugUrl($this->client));
    }
}
