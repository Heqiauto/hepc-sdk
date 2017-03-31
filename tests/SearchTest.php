<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\Search;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    protected $client;
    /**
     * @var Search
     */
    protected $search;

    protected function setUp()
    {
        $this->client = UnitData::client();
        $this->search = new Search($this->client);
    }

    public function testGetSearchSuggest()
    {
        $this->search->getSearchSuggest('BMW');
        $this->assertEquals('/search', UnitData::debugUrl($this->client));
        $this->assertEquals('BMW', UnitData::debugQuery($this->client, 'query'));
        $this->assertEquals('suggest', UnitData::debugQuery($this->client, 'action'));
    }

    public function testGetSearchList()
    {
        $this->search->getSearchList('car');
        $this->assertEquals('/search', UnitData::debugUrl($this->client));
        $this->assertEquals('car', UnitData::debugQuery($this->client, 'query'));
        $this->assertEquals('list', UnitData::debugQuery($this->client, 'action'));
    }
}
