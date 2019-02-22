# HEPC SDK Documents

API Documents
--------------

+ [汽车子品牌类库](汽车子品牌类库.md)
+ [汽车车系类库](汽车车系类库.md)
+ [汽车车型类库](汽车车型类库.md)
+ [汽车配件类库](汽车配件类库.md)
+ [汽车品牌类库](汽车品牌类库.md)
+ [VIN查询车型类库](VIN查询车型类库.md)
+ [虚拟目录类库](虚拟目录类库.md)
+ [配件品牌类库](配件品牌类库.md)
+ [配件目录类库](配件目录类库.md)
+ [详细错误码](ErrorCode.md)

认证及请求签名机制
-------------

调用 API 时需要对调用者身份进行验证，以及对请求数据进行签名。

需要提供3个必要的 Query 参数：`client_id`， `nonce`， `sign`，

- *client_id* 是为API用户分配的 client_id 值
- *nonce* 是由调用方生成的 43 位随机字符串，算法为 `MD5(client_id + client_secret + 时间戳) + "." + 时间戳`, 算法中时间戳是相同值。
- *sign* 是由签名算法得到的字符串

对于 POST 请求，请求体内容格式为 json 格式。

### API 地址

接口访问地址为：提供的 Host/path，对于该 SDK，规则为 host + 业务模型的 $base 值 + 方法定义的路径。

### 签名方法

1.对所有参数按照键名进行 `字典排序`, 被签名参数不包括 `sign` 本身。

2.将参数组装为查询字符串(使用 `&` 连接）, 按照 »RFC 1738和 application / x-www-form-urlencoded媒体类型执行编码，这意味着空格被编码为加号（+）。

3.将请求API的路径 `path` ，与上面步骤得到的结果 `query`，`client_secret` 三个值进行字符串连接后进行MD5，得到的结果即 `sign` 参数。

### 步骤
1. 生成一个随机的 _nocie 值
2. 对请求进行签名
3. 使用 Http 客户端等请求 API

示例代码（获取车型）

```php
<?php
$host = 'api.example.com';
$path = '/brands/1/sub-brands/1/series/1/models/1';

$id = 'id_value';
$secret = 'secret_value';

// 生成 nonce
$time = time();
$nonce = md5($id . $secret . $time) . '.' . $time;

$params = [
	'client_id' => $id, 
	'nonce' => $nonce
];

// 签名
ksort($params);
$sign = md5($path . http_build_query($params, '', '&') . $secret);

// 输出访问地址
$params['sign'] = $sign;
echo $host . $path . '?'  . http_build_query($params, '', '&');
```
输出URL `api.example.com/brands/1/sub-brands/1/series/1/models/1?client_id=id_value&nonce=ed940f0fd00618913d193e227c80061c.1550823251&sign=b1137439774d51e0a72c79ee0a61c023` (time = 1550823251)

返回数据：
```json
{
  "success": true,
  "result": {
    "id": "1",
    "cn": "AA270001",
    "brand_id": "1",
    "sub_brand_id": "1",
    "series_id": "1",
    "manu_id": "1",
    "brand_name": "奥迪",
    "sub_brand_name": "奥迪(进口)",
    "series_name": "A3",
    "manu_name": "奥迪汽车",
    "model_name": "A3 Limousine",
    "sales_desig": "1.8TFSI 双离合 40TFSI S-line 舒适型",
    "sales_version": "40TFSI S-line 舒适型",
    "model_year": "2014",
    "emission_std": "欧5",
    "structure_type": "轿车",
    "category_size": "紧凑型车",
    "guidance_price": "27.98",
    "sale_from_year": "2014",
    "sale_from_month": "3",
    "const_from": "2013",
    "const_to": "2015",
    "const_state": "0",
    "sale_state": "0",
    "country": "德国",
    "manu_type": "进口",
    "chassis_num": "8VS",
    "engine_code": "CJS",
    "cyl_capacity": "1798",
    "displacement": "1.8",
    "aspirated_way": "涡轮增压",
    "fuel_type": "汽油",
    "full_power": "180",
    "output_kw": "132",
    "output_rpm": "5100-6200",
    "torque_np": "250",
    "torque_rpm": "1250-5000",
    "cyl_arr": "L",
    "cyl_num": "4",
    "valves_per_cyl": "4",
    "comp_ratio": "",
    "mixture_prep": "直喷",
    "mii_fuel_eco": "6.7",
    "town_fuel_eco": "8.5",
    "sub_fuel_eco": "5.7",
    "acce_time": "7.00",
    "max_speed": "242",
    "cylinder_diameter": "",
    "stroke": "",
    "engine_desc": "1.8T L4 180PS 直喷汽油发动机",
    "trans_type": "自动",
    "trans_desc": "双离合变速器(DCT)",
    "trans_type_version": "DCT",
    "gears_num": "6",
    "front_brake": "通风盘式",
    "rear_brake": "盘式",
    "front_susp": "麦弗逊式独立悬挂",
    "rear_susp": "四连杆式独立悬挂",
    "steer_form": "齿轮齿条式",
    "power_steer": "电动助力",
    "engine_loc": "前置",
    "drive_mode": "前轮驱动",
    "drive_system": "前置前驱",
    "structure": "三厢",
    "length": "4466",
    "width": "1796",
    "height": "1404",
    "wheelbase": "2618",
    "front_gauge": "1552",
    "rear_gauge": "1520",
    "curb_weight": "1420",
    "max_load": "1870",
    "tank_vol": "50",
    "luggage_vol": "425",
    "roof_type": "硬顶",
    "carport_type": "硬顶",
    "doors_num": "4",
    "seats_num": "5",
    "front_tyre_spec": "225/45 R17",
    "rear_tyre_spec": "225/45 R17",
    "front_hub_spec": "7.5J×17",
    "rear_hub_spec": "7.5J×17",
    "hub_material": "铝合金",
    "spare_tyre_spec": "非全尺寸",
    "data_signature": "fcd616dade5034c274680f7b772d3a59d5b062b3",
    "car_type": "1",
    "is_released": "2",
    "exts": [
      {
        "category_name": "自动变速箱油",
        "ext": [
          {
            "id": "62156",
            "property_id": "82",
            "property_value_id": "990",
            "property_name": "大修加注量",
            "property_value": "6.9",
            "unit": "L"
          },
          {
            "id": "84884",
            "property_id": "83",
            "property_value_id": "1529",
            "property_name": "保养加注量",
            "property_value": "5.2",
            "unit": "L"
          },
          {
            "id": "31035",
            "property_id": "84",
            "property_value_id": "1197",
            "property_name": "规格",
            "property_value": "G 052 182",
            "unit": ""
          }
        ]
      },
      {
        "category_name": "汽机油",
        "ext": [
          {
            "id": "477026",
            "property_id": "78",
            "property_value_id": "591",
            "property_name": "保养加注量",
            "property_value": "5.2",
            "unit": "L"
          },
          {
            "id": "402649",
            "property_id": "79",
            "property_value_id": "851",
            "property_name": "基础油类型",
            "property_value": "全合成",
            "unit": ""
          },
          {
            "id": "253914",
            "property_id": "80",
            "property_value_id": "699",
            "property_name": "质量等级",
            "property_value": "VW 502 00",
            "unit": ""
          },
          {
            "id": "328281",
            "property_id": "81",
            "property_value_id": "794",
            "property_name": "粘度等级",
            "property_value": "5W-40",
            "unit": ""
          }
        ]
      }
    ]
  },
  "errors": []
}
```

  
