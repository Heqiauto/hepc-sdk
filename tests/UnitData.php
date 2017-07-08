<?php
/**
 * Hepc SDK - Sdk client for Heqiauto-epc service
 *
 * @copyright 2017. Heqiauto Inc.
 * @license   https://opensource.org/licenses/Apache-2.0
 * @link      https://github.com/Heqiauto/hepc-sdk
 */

namespace Tests;

class UnitData
{
    /**
     * @var static
     */
    protected static $unitData;

    public static $brand_id = 4;
    public static $brand_name = '奥迪';
    public static $manu_id = 4; //品牌id
    public static $manu_name = '一汽大众(奥迪)'; //品牌id对应的名称
    public static $series_id = 9; //厂商id
    public static $series_name = 'A4'; //厂商id对应的名称
    public static $series_year_id = 3919; //车系id
    public static $series_year_value = '2016';
    public static $series_capacity_id = 16; //车系id
    public static $series_capacity_value = '2';
    public static $model_id = 23323; //车型id
    public static $model_name = 'A4L';
    public static $category_id = 30; //车型Id
    public static $category_child_id = 31; //配件品类id
    public static $category_child_name = '蓄电池'; //配件品类名称
    public static $part_brand_id = 16; //配件品牌id
    public static $psn = 'p003149905';
    public static $part_name = '蓄电池(S4动力神系列)L2-400';
    public static $part_ext_id = 36; //配件拓展属性id
    public static $property_value = 54; //配件拓展属性值
    public static $part_oe_id = '212'; //配件拓展属性值
    public static $part_oe = '44443453'; //配件拓展属性值
    public static $part_uni_id = '210'; //配件拓展属性值
    public static $part_uni = '11111'; //配件拓展属性值
    public static $part_usage_id = '233'; //配件拓展属性值
    public static $part_usage = '1111'; //配件拓展属性值
    public static $plate_url = '4354wert4.jpg'; //车牌图片
    public static $vin_url = '669803153629290992.jpg'; //Vin图片
    public static $vin = 'LVVDB12A6DD201624'; //Vin号

    protected $config;

    protected function __construct()
    {
        $this->config = [
            'host'          => 'localhost',
            'client_id'     => 'client_id',
            'client_secret' => 'client_secret',
        ];

        if (file_exists(__DIR__ . '/../.env.php')) {
            $this->config = array_merge($this->config, require_once(__DIR__ . '/../.env.php'));
        }
    }

    public function create($params = [])
    {
        $client = new HepcClientDecorator(
            $this->config['host'],
            $this->config['client_id'],
            $this->config['client_secret'],
            array_merge([
                'debug' => true,
            ], $params));

        return $client;
    }

    public function getConfig()
    {
        return $this->config;
    }
    
    public static function client($params = [])
    {
        if ( ! static::$unitData) {
            static::$unitData = new static();
        }
        
        return static::$unitData->create($params);
    }

    public static function debug($client, $name = null)
    {
        $info = $client->get_request();
        if ($name === null) {
            return $info;
        } else {
            return $info[$name];
        }
    }

    public static function debugUrl($client)
    {
        $info = $client->get_request();
        if (empty($info['url'])) {
            return false;
        }
        $url = $info['url'];
        $config = static::$unitData->getConfig();
        if (0 !== strpos($url, $config['host'])) {
            return false;
        }
        $url = substr($url, strlen($config['host']));
        if (false !== ($pos = strpos($url, '?'))) {
            $url = substr($url, 0, $pos);
        }

        return $url;
    }

    public static function debugQuery($client, $name)
    {
        $info = $client->get_request();
        if (empty($info['url'])) {
            return false;
        }
        $url = $info['url'];
        $config = static::$unitData->getConfig();
        if (0 !== strpos($url, $config['host'])) {
            return false;
        }
        $url = parse_url($info['url']);
        if (empty($url['query'])) {
            return false;
        }
        parse_str($url['query'], $query);
        if ( ! isset($query[$name])) {
            return false;
        }

        return $query[$name];
    }

    public static function getBase64($pic)
    {
        $fp = fopen($pic, "r");
        $file_content=chunk_split(base64_encode(fread($fp, filesize($pic))));//base64编码
        fclose($fp);

        return $file_content;
    }
}