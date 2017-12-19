<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 * @version   1.2.6
 */

namespace Heqiauto\HepcSdk;

/**
 * Sdk client to access Heqiauto-EPC service
 *
 * 此类主要提供一下功能：
 * 1、根据请求的参数来生成签名和nonce.
 * 2、请求API服务并返回response结果.
 */
class HepcClient
{
    /**
     * 指定默认的请求方式；默认为GET.
     *
     * @var string
     */
    const METHOD = 'GET';

    /**
     * 请求的方式，有GET和POST.
     *
     * @var string
     */
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * 请求API的连接超时时间，单位为秒.
     *
     * @var int
     */
    const CONNECT_TIMEOUT = 30;

    /**
     * 请求API的时间，单位为秒.
     *
     * @var int
     */
    const TIMEOUT = 30;

    /**
     * 用户的client id。key_type为heqi使用.
     *
     * 此信息需联系heqiauto团队 bd@heqiauto.com申请.
     *
     * @var string
     */
    protected $client_id;

    /**
     * 用户的秘钥。key_type为heqi使用.
     *
     * 此信息需联系heqiauto团队 bd@heqiauto.com申请.
     *
     * @var string
     */
    protected $client_secret;

    /**
     * 请求API的base URI.
     *
     * @var string
     */
    protected $base_uri;

    /**
     * 当前API的版本号.
     *
     * @var string
     */
    private $version = 'v1';

    /**
     * SDK的版本号.
     *
     * @var string
     */
    private $sdk_version = '1.2.8';

    /**
     * 请求API的时间，单位为秒.
     *
     * @var int
     */
    private $timeout = 10;

    /**
     * 请求API的连接超时时间，单位为秒.
     *
     * @var int
     */
    private $connect_timeout = 1;

    /**
     * 请求的domain地址.
     *
     * @var string
     */
    private $host;

    /**
     * 当前的请求方式，有socket和curl两种.
     *
     * @var string
     */
    private $connect = 'curl';

    /**
     * 是否打开gzip功能.
     *
     * 如果打开gzip功能，则会在请求头中加上Accept-Encoding:gzip信息，同时如果服务器也设置了
     * 此功能的话，则服务器会返回zip的数据，此类会拿到gzip数据然后解压缩得到真实的数据.
     *
     * 此功能是用服务器计算换取网络耗时，对整个latency会有所降低.
     *
     * @var boolean
     */
    private $gzip = false;

    /**
     * 是否开启debug信息.
     *
     * @var boolean
     */
    private $debug = false;

    /**
     * debug信息，当$debug = true时 存储sdk调用时产生的debug信息，供 get_request 调用.
     *
     * @var string
     */
    private $debug_info = '';

    /**
     *指定使用加密key和对应的secret.
     *
     * @var string ('heqi')
     */
    protected $key_type = 'heqi';

    /**
     * 指定签名算法方式.
     *
     * @var string ('HMAC-SHA1'）
     */
    protected $signature_method = 'HMAC-SHA1';

    /**
     * 指定签名算法版本.
     *
     * @var string ('HMAC-SHA1'）
     */
    protected $signature_version = '1.0';

    /**
     * 构造函数.
     *
     * 与服务器交互的客户端，支持单例方式调用.
     *
     * @param string $host     请求的domain地址.
     * @param string $key      用户的key.
     * @param string $secret   用户的secret，对应的Access Key Secret.
     * @param array  $opts     包含下面一些可选信息 {
     *     @var string $key_type key和secret类型，表示这个是Heqiauto.com颁发的
     *     @var string $ version 使用的API版本。 默认值为:v1
     *     @var string $ gzip    指定返回的结果用gzip压缩。 默认值为:false
     *     @var string $ debug   打印debug信息。 默认值为:false
     *     @var string $ signature_method  签名方式，目前支持HMAC-SHA1。 默认值为:HMAC-SHA1
     *     @var string $ signature_version 签名算法版本。 默认值为:1.0
     * }
     */
    public function __construct($host, $key, $secret, $opts = [], $key_type = 'heqi')
    {
        if (substr($host, -1) == "/") { // 对于用户通过参数指定的host，需要检查host结尾是否有/，有则去掉
            $this->host = rtrim($host, '/');
        } else {
            $this->host = $host;
        }

        $this->key_type = $key_type;

        if ($this->key_type == 'heqi') {
            $this->key_type = 'heqi';
            $this->client_id = $key;
            $this->client_secret = $secret;
        }

        if (isset($opts['version']) && ! empty($opts['version'])) {
            $this->version = $opts['version'];
        }

        if (isset($opts['timeout']) && ! empty($opts['timeout'])) {
            $this->timeout = $opts['timeout'];
        }

        if (isset($opts['connect_timeout']) && ! empty($opts['connect_timeout'])) {
            $this->connect_timeout = $opts['connect_timeout'];
        }

        if (isset($opts['gzip']) && $opts['gzip'] == true) {
            $this->gzip = true;
        }

        if (isset($opts['debug']) && $opts['debug'] == true) {
            $this->debug = true;
        }

        if (isset($opts['signature_method']) && ! empty($opts['signature_method'])) {
            $this->signature_method = $opts['signature_method'];
        }

        if (isset($opts['signature_version']) && ! empty($opts['signature_version'])) {
            $this->signature_version = $opts['signature_version'];
        }

        $this->base_uri = rtrim($this->host, '/');

    }


    /**
     * 请求服务器.
     *
     * 向服务器发出请求并获得返回结果.
     *
     * @param string $path   当前请求的path路径.
     * @param array  $params 当前请求的所有参数数组.
     * @param string $method 当前请求的方法。默认值为:GET
     * @return string 返回获取的结果.
     * @throws Exception
     * @donotgeneratedoc
     */
    public function call($path, $params = [], $method = self::METHOD)
    {
        $url = $this->base_uri . $path;
        if ($this->key_type == 'heqi') {
            $params['client_id'] = $this->client_id;
            $params['nonce'] = $this->_nonce();
            $params['sign'] = $this->_sign_heqi($params, $path);
        }
        if ($this->connect == 'curl') {
            $response = $this->_curl($url, $params, $method);
            $result = $this->_parse_response_curl($response);
        } else {
            $response = $this->_socket($url, $params, $method);
            $ret = $this->_parse_response($response);
            $result = $ret['result'];
        }

        return $result;
    }

    /**
     * 生成当前的nonce值.
     *
     * NOTE: $time为10位的unix时间戳.
     *
     * @return string 返回生成的nonce串.
     */
    protected function _nonce()
    {
        $time = time();

        return md5($this->client_id . $this->client_secret . $time) . '.' . $time;
    }

    /**
     * 根据参数生成当前的签名.
     *
     * 如果指定了sign_mode且sign_mode为1，则参数中的items将不会被计算签名.
     *
     * @param array $params 返回生成的签名.
     * @return string
     */
    protected function _sign($params = [])
    {
        $query = "";
        if (isset($params['sign_mode']) && $params['sign_mode'] == 1) {
            unset($params['items']);
        }
        if (is_array($params) && ! empty($params)) {
            ksort($params);
            $query = $this->_build_query($params);
        }

        return md5($query . $this->client_secret);
    }

    protected function _sign_heqi($params = [], $path = '')
    {
        $query = "";
        if (isset($params['sign_mode']) && $params['sign_mode'] == 1) {
            unset($params['items']);
        }
        if (is_array($params) && ! empty($params)) {
            ksort($params);
            $query = $this->_build_query($params);
        }

        return md5($path . $query . $this->client_secret);
    }

    /**
     * 过滤签名中不用来签名的参数,并且排序.
     *
     * @param array $parameters
     * @return array
     */
    protected function _params_filter($parameters = [])
    {
        $params = [];
        while (list ($key, $val) = each($parameters)) {
            if ($key == "Signature" || $val === "" || $val === null) {
                continue;
            } else {
                $params[$key] = $parameters[$key];
            }
        }
        ksort($params);
        reset($params);

        return $params;
    }

    protected function _percent_encode($str)
    {
        // 使用urlencode编码后，将"+","*","%7E"做替换即满足 API规定的编码规范
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);

        return $res;
    }

    /**
     * 通过curl的方式获取请求结果.
     *
     * @param string $url    请求的URI.
     * @param array  $params 请求的参数数组.
     * @param string $method 请求的方法，默认为self::METHOD.
     * @return string 返回获取的结果.
     */
    private function _curl($url, $params = [], $method = self::METHOD)
    {
        $method = strtoupper($method);
        if ($method == self::METHOD_GET) {
            $query = $this->_build_query($params);
            $url .= preg_match('/\?/i', $url) ? '&' . $query : '?' . $query;

        } else {
            $query = [
                'client_id' => $params['client_id'],
                'nonce' => $params['nonce'],
                'sign' => $params['sign']
            ];
            $query = $this->_build_query($query);
            $url .= preg_match('/\?/i', $url) ? '&' . $query : '?' . $query;
            unset($params['client_id']);
            unset($params['nonce']);
            unset($params['sign']);
            $method = self::METHOD_POST;
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

        if ($method == self::METHOD_POST) {
            $options[CURLOPT_POSTFIELDS] = json_encode($params);
        }

        if ($this->gzip) {
            $options[CURLOPT_ENCODING] = 'gzip';
        }

        $session = curl_init($url);
        curl_setopt_array($session, $options);
        $response = curl_exec($session);
        $info = curl_getinfo($session);

        //error_log(var_export($info, true));
        //error_log($url);

        if ($this->debug) {
            $this->debug_info = $info; // query基本信息，供调试使用
        }

        curl_close($session);

        return $response;
    }


    /**
     * 通过socket的方式获取请求结果.
     *
     * @param string $url    请求的URI.
     * @param array  $params 请求的参数数组.
     * @param string $method 请求方法，默认为self::METHOD.
     * @throws Exception
     * @return string
     */
    private function _socket($url, $params = [], $method = self::METHOD)
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
        $content = $this->_build_request_content($info, $query);
        $socket = fsockopen(
            $parse['host'],
            $parse["port"],
            $errno,
            $errstr,
            $this->connect_timeout
        );

        stream_set_timeout($socket, $this->timeout);

        if ( ! $socket) {
            throw new Exception("Connect " . $parse['host'] . ' fail.');
        }

        $response = '';
        fwrite($socket, $content);
        while ($data = fgets($socket)) {
            $response .= $data;
        }
        fclose($socket);

        return $response;
    }

    /**
     * 调试接口.
     *
     * 获取SDK调用的调试信息,需要指定debug=true才能使用
     *
     * @return string|null 调试开关(debug)打开时返回调试信息.
     */
    public function get_request()
    {
        if ($this->debug) {
            return $this->debug_info;
        } else {
            return null;
        }
    }

    /**
     * 解析http返回的结果，并分析出response 头和body.
     *
     * @param string $response
     * @return array
     */
    private function _parse_response($response)
    {
        list($header_content,) = explode("\r\n\r\n", $response);
        $header = $this->_parse_http_socket_header($header_content);
        $response = trim(stristr($response, "\r\n\r\n"), "\r\n");

        $ret = [];
        $ret["result"] =
            (isset($header['Content-Encoding']) &&
                trim($header['Content-Encoding']) == 'gzip') ?
                $this->_gzdecode($response, $header) : $this->_check_chunk($response, $header);
        $ret["info"]["http_code"] =
            isset($header["http_code"]) ? $header["http_code"] : 0;
        $ret["info"]["headers"] = $header;

        return $ret;
    }

    private function _build_request_info(&$parse, $method, $data)
    {
        $info = [
            'url'            => '',
            'method'         => self::METHOD_GET,
            'content_type'   => 'application/x-www-form-urlencoded',
            'content_length' => 0,
            'http_code'      => 200,
            'header_size'    => 0,
            'request_size'   => 0,
            'gzip'           => false,
            'user_agent'     => '',
        ];


        if ($method == self::METHOD_GET) {
            $data = ltrim($data, '&');
            $query = isset($parse['query']) ? $parse['query'] : '';
            $parse['path'] .= ($query ? '&' : '?') . $data;
        } else {
            $info['method'] = self::METHOD_POST;
            $info['content_length'] = strlen($data);
        }

        $info['url'] = $parse['path'];
        $info['host'] = $parse['host'];
        $info['user_agent'] = 'Heqiauto-Epc/php sdk ' . $this->sdk_version;
        $info['gzip'] = $this->gzip;
        $info['connection'] = 'close';

        return $info;
    }

    /**
     * 生成http头信息.
     *
     * @param array  $info   请求参数信息
     * @param string $data   HTTP参数串.
     * @return string
     */
    private function _build_request_content($info, $data)
    {
        $strLength = '';
        $content = '';
        $parse = [];

        if ($info['method'] == self::METHOD_GET) {
            $data = ltrim($data, '&');
            $query = isset($parse['query']) ? $parse['query'] : '';
            $parse['path'] .= ($query ? '&' : '?') . $data;
        } else {
            $strLength = "Content-length: " . $info['content_length'] . "\r\n";
            $content = $data;
        }

        $write = $info['method'] . " " . $info['url'] . " HTTP/1.0\r\n";
        $write .= "Host: " . $info['host'] . "\r\n";
        $write .= "Content-type: application/x-www-form-urlencoded\r\n";
        $write .= "User-Agent:" . $info['user_agent'] . "\r\n";
        if ($info['gzip']) {
            $write .= "Accept-Encoding: gzip\r\n";
        }
        $write .= $strLength;
        $write .= "Connection: close\r\n\r\n";
        $write .= $content;

        return $write;
    }


    /**
     * 把数组生成http请求需要的参数.
     *
     * @param array $params
     * @return string
     */
    private function _build_query($params)
    {
        $args = http_build_query($params, '', '&');
        // remove the php special encoding of parameters
        // see http://www.php.net/manual/en/function.http-build-query.php#78603
        //return preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $args);
        return $args;
    }


    /**
     * 解析URL并生成host、schema、path、query等信息.
     *
     * @param string $url
     * @throws Exception
     * @return array
     */
    private function _parse_url($url)
    {
        $parse = parse_url($url);
        if (empty($parse) || ! is_array($parse)) {
            throw new Exception("Host is empty.");
        }

        if ( ! isset($parse['port']) || ! $parse['port']) {
            $parse['port'] = '80';
        }

        $parse['host'] = str_replace(
                ['http://', 'https://'],
                ['', 'ssl://'],
                $parse['scheme'] . "://"
            ) . $parse['host'];

        $parse["path"] = isset($parse["path"]) ? $parse["path"] : '/';
        $query = isset($parse['query']) ? $parse['query'] : '';

        $path = str_replace(['\\', '//'], '/', $parse['path']);
        $parse['path'] = $query ? $path . "?" . $query : $path;

        return $parse;
    }

    /**
     * 解析返回的header头.
     *
     * @param string $str 头信息.
     * @return array 返回头信息的数组.
     */
    private static function _parse_http_socket_header($str)
    {
        $slice = explode("\r\n", $str);
        $headers = [];

        foreach ($slice as $v) {
            if (false !== strpos($v, "HTTP")) {
                list(, $headers["http_code"]) = explode(" ", $v);
                $headers["status"] = $v;
            } else {
                $item = explode(":", $v);
                $headers[$item[0]] = isset($item[1]) ? $item[1] : '';
            }
        }

        return $headers;
    }


    /**
     * 解压缩gzip生成的数据.
     *
     * @param string $data 压缩的数据.
     * @param array  $header
     * @param string $rn
     * @return string 解压缩的数据.
     */
    private static function _gzdecode($data, $header, $rn = "\r\n")
    {
        if (isset($header['Transfer-Encoding'])) {
            $lrn = strlen($rn);
            $str = '';
            $ofs = 0;
            do {
                $p = strpos($data, $rn, $ofs);
                $len = hexdec(substr($data, $ofs, $p - $ofs));
                $str .= substr($data, $p + $lrn, $len);
                $ofs = $p + $lrn * 2 + $len;
            } while ($data[$ofs] !== '0');
            $data = $str;
        }
        if (isset($header['Content-Encoding'])) {
            $data = gzinflate(substr($data, 10));
        }

        return $data;
    }

    /**
     * 检查当前是否是返回chunk，如果是的话，从body中获取content长度并截取.
     *
     * @param string $data   body内容.
     * @param array  $header header头信息的数组.
     * @param string $rn     chunk的截取字符串.
     *
     * @return string 如果为chunk则返回正确的body内容，否则全部返回.
     */
    private static function _check_chunk($data, $header, $rn = "\r\n")
    {
        if (isset($header['Transfer-Encoding'])) {
            $p = strpos($data, $rn, 0);
            $len = hexdec(substr($data, 0, $p));
            $data = substr($data, $p + 2, $len);
        }

        return $data;
    }

    /**
     * @return float
     */
    protected function get_microtime()
    {
        list($usec, $sec) = explode(" ", microtime());

        return floor(((float)$usec + (float)$sec) * 1000);
    }

    /**
     * @param $resp
     * @return mixed
     * @throws Exception
     */
    protected function _parse_response_curl($resp)
    {
        $resp_arr = json_decode($resp, true);

        if (isset($resp_arr['success']) && $resp_arr['success'] == 'true') {
            return $resp_arr['result'];

        } else {
            throw new Exception("Errorcode:" . $resp_arr['errors'][0]['error_code'] . "#" . $resp_arr['errors'][0]['error_msg'], $resp_arr['errors'][0]['error_code']);
        }
    }
}
