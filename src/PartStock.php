<?php

namespace Heqiauto\HepcSdk;


class PartStock
{
    private static $base = '/ale';

    public $host = null;
    public $header = [];

    /**
     * PartStock constructor.
     * @param $host
     * @param array $header ['User-Agent='xxx',etc.]
     */
    public function __construct($host = null, $header = [])
    {
        $this->host = $host;
        $this->header = $header;
    }

    /**
     * @param $psn
     * @return array
     */
    public function getPartPrice($psn)
    {
        $url = $this->host . self::$base . '/parts/' . $psn . '/price';
        $result = json_decode($this->get($url, $this->header), true);

        return isset($result['result']['0']) ? $result['result']['0'] : [];
    }

    /**
     * @param $psn
     * @return array
     */
    public function getPartProvince($psn)
    {
        $url = $this->host . self::$base . '/parts/' . $psn . '/province';
        $result = json_decode($this->get($url, $this->header), true);

        return isset($result['result']) ? $result['result'] : [];
    }

    public function get($url, $headers = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();

        return $return_content;
    }
}