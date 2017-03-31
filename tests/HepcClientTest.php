<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use PHPUnit\Framework\TestCase;

class HepcClientTest extends TestCase
{
    public function testParseResponseCurl()
    {
        $client = UnitData::client();
        $this->assertNotEmpty($client->_parse_response_curl('{"success": true, "result": "1"}'));
    }

    public function testParseResponseCurlTrowException()
    {
        $this->setExpectedException('Heqiauto\\HepcSdk\\Exception');
        $client = UnitData::client();
        $client->_parse_response_curl('{"errors": [{"error_code": 0, "error_msg": ""}]}');
    }
}
