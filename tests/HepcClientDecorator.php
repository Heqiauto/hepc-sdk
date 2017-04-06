<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

use Heqiauto\HepcSdk\HepcClient;

/**
 * Class HepcClientDecorator
 *
 * @package Tests
 * @method _nonce()
 * @method _sign_heqi($params = [], $path = '')
 * @method _parse_url($url)
 * @method _build_request_info(&$parse, $method, $data)
 * @method _build_query($params)
 * @property  string base_uri
 * @property  string client_id
 * @property  string key_type
 * @property  string connect
 * @property  bool   debug
 * @property  int    connect_timeout
 * @property  array  debug_info
 * @property  int    timeout
 * @property  string sdk_version
 * @property  bool   gzip
 */
class HepcClientDecorator
{
    protected $client;

    protected $class;

    public function __construct($host, $key, $secret, $opts = [], $key_type = 'heqi')
    {
        $this->client = new HepcClient($host, $key, $secret, $opts, $key_type);
        $this->class = new \ReflectionClass($this->client);
    }

    public function call($path, $params = [], $method = HepcClient::METHOD)
    {
        $url = $this->base_uri . $path;
        if ($this->key_type == 'heqi') {
            $params['client_id'] = $this->client_id;
            $params['nonce'] = $this->_nonce();
            $params['sign'] = $this->_sign_heqi($params, $path);
        }
        if ($this->connect == 'curl') {
            $response = $this->_curl($url, $params, $method);
            // $result = $this->_parse_response_curl($response);
        } else {
            $response = $this->_socket($url, $params, $method);
            // $ret = $this->_parse_response($response);
            // $result = $ret['result'];
        }

        return $response; // $result;
    }

    private function _socket($url, $params = [], $method = HepcClient::METHOD)
    {
        $method = strtoupper($method);

        $parse = $this->_parse_url($url);
        $query = http_build_query($params, '', '&');
        $info = $this->_build_request_info(
            $parse,
            $method,
            $query
        );
        if ($this->debug) {
            $this->debug_info = $info;
        }

        return '';
    }

    private function _curl($url, $params = [], $method = HepcClient::METHOD)
    {
        $query = $this->_build_query($params);
        $method = strtoupper($method);

        if ($method == HepcClient::METHOD_GET) {
            $url .= preg_match('/\?/i', $url) ? '&' . $query : '?' . $query;
        } else {
            $method = HepcClient::METHOD_POST;
        }

        $options = [
            CURLOPT_HTTP_VERSION   => 'CURL_HTTP_VERSION_1_1',
            CURLOPT_CONNECTTIMEOUT => $this->connect_timeout,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT      => "heqiauto/php sdk " . $this->sdk_version,//php sdk 版本信息
            CURLOPT_HTTPHEADER     => ['Expect:'],
        ];

        if ($method == HepcClient::METHOD_POST) {
            $options[CURLOPT_POSTFIELDS] = $params;
        }

        if ($this->gzip) {
            $options[CURLOPT_ENCODING] = 'gzip';
        }

        $session = curl_init($url);
        curl_setopt_array($session, $options);
        // $response = curl_exec($session);
        $info = curl_getinfo($session);

        if ($this->debug) {
            $this->debug_info = $info; // query基本信息，供调试使用
        }

        curl_close($session);

        return '';
    }

    public function __get($name)
    {
        return $this->getProperty($name);
    }

    public function __set($name, $value)
    {
        $this->setProperty($name, $value);
    }

    public function __call($name, $arguments)
    {
        return $this->callMethod($name, $arguments);
    }

    protected function getProperty($name)
    {
        $callback = function($name) {
            return $this->$name;
        };
        $callback = $callback->bindTo($this->client, get_class($this->client));

        return $callback($name);
    }

    protected function setProperty($name, $value)
    {
        $callback = function($name, $value) {
            $this->$name = $value;
        };
        $callback = $callback->bindTo($this->client, get_class($this->client));

        $callback($name, $value);
    }

    protected function callMethod($name, $params)
    {
        $method = $this->class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($this->client, $params);
    }
}