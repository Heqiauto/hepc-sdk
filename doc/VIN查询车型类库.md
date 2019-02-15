# Vin 查询相关接口

## 主要功能

- 通过Vin查询车型信息

# 初始化

+ object  $client  HepcClient对象

```php
$vin = new Vin($client); //创建实例对象
```

# 接口

## 通过vin码获取车型信息

### `getCarModelByVin($vin, $type)`

#### 调用示例

```php
$client = new HepcClient($host, $key, $secret, $opts);
$vin = new Vin($client);
$vin->setCache(true);
$ret = $vin->getCarModelByVin($code, $type, $detail);//$detail默认为0不返回详细信息，传1可返回详细信息
```

#### 返回示例
```php
Array
(
    [models] => Array
        (
            [0] => Array
                (
                    [model_id] => 22162
                    [brand_name] => 福特
                    [manu_name] => 长安福特马自达
                    [family_name] => 福克斯
                    [sales_desig] => 1.8 手动 舒适型
                    [vehicle_name] => 福克斯-三厢
                    [displacement] => 1.8
                    [year_pattern] => 2007
                    [gearbox_type] => 手动
                    [chassis_num] => E71
                    [engine_model] => CAF483Q0
                    [fuel_type] => 汽油
                    [trans_desc] => 手动变速器(MT)
                    [gears_num] => 5
                    [front_tyre_spec] => 195/65 R15
                    [rear_tyre_spec] => 195/65 R15
                    [sales_version] => 舒适型
                    [hub_material] => 铝合金
                    [aspirated_way] => 机械增压
                    [drive_system] => 前置前驱
                    [multi_model] => 1
                    "car_model_info" => array (
                        [cn] =>  AB290008
                        [brand_name] =>  宝马
                        [sub_brand_name] =>  宝马(进口)
                        [series_name] =>  X6
                        [model_name] =>  X6 xDrive35i
                        [model_year] =>  2008
                        [displacement] =>  3.0
                        [trans_type] =>  自动
                        [gears_num] =>  6
                        [engine_code] =>  N54B30A
                        [aspirated_way] =>  双涡轮增压
                        [engine_desc] =>  3.0T L6 306PS 直喷汽油发动机
                        [trans_desc] =>  手自一体变速器(AMT)
                        [trans_type_version] =>  AMT
                        [output_kw] =>  225
                        [chassis_num] =>  E71
                        [structure] =>  两厢
                    ),
                    "car_base_info" => array (
                        [structure_type] =>  SUV
                        [category_size] =>  中大型车
                        [country] =>  德国
                        [sale_from_year] =>  2008
                        [sale_from_month] =>  1
                        [full_power] =>  306
                        [max_speed] =>  240
                        [acce_time] =>  6.70
                        [mii_fuel_eco] =>  12.1
                        [town_fuel_eco] =>  
                        [sub_fuel_eco] =>  
                        [emission_std] =>  欧4
                    ),
                    "car_body_info" => array (
                        [roof_type] =>  硬顶
                        [carport_type] =>  硬顶
                        [doors_num] =>  5
                        [seats_num] =>  4
                        [length] =>  4877
                        [width] =>  1983
                        [height] =>  1690
                        [wheelbase] =>  2933
                        [front_gauge] =>  1644
                        [rear_gauge] =>  1706
                        [curb_weight] =>  2145
                        [max_load] =>  
                        [luggage_vol] =>  570-1450
                        [tank_vol] =>  85
                        [cyl_capacity] =>  2979
                    ),
                    "car_engine_info" => array (
                        [mixture_prep] =>  直喷
                        [fuel_type] =>  汽油
                        [cyl_arr] =>  L
                        [cyl_num] =>  6
                        [cylinder_diameter] =>  84
                        [stroke] =>  
                        [valves_per_cyl] =>  4
                        [comp_ratio] =>  10.20
                        [engine_loc] =>  前置
                        [output_rpm] =>  5800
                        [torque_np] =>  400
                        [torque_rpm] =>  1300-5000
                    ),
                    "car_chassis_info" => array (
                        [drive_mode] =>  全时四驱
                        [drive_system] =>  前置四驱
                        [front_brake] =>  通风盘式
                        [rear_brake] =>  通风盘式
                        [front_susp] =>  双球节弹簧减震支柱前桥
                        [rear_susp] =>  整体铝制后桥
                        [steer_form] =>  
                        [power_steer] =>  电动助力
                        [front_tyre_spec] =>  255/50 R19
                        [rear_tyre_spec] =>  255/50 R19
                        [front_hub_spec] =>  19英寸
                        [rear_hub_spec] =>  9J×19
                        [hub_material] =>  铝合金
                        [spare_tyre_spec] =>  非全尺寸
                    )
                    "exts": [
                        {
                            "category_name": "汽机油",
                            "ext": [
                                {
                                    "id": "36120",
                                    "property_id": "78",
                                    "property_value_id": "606",
                                    "property_name": "保养加注量",
                                    "property_value": "6.5",
                                    "unit": "L"
                                }
                            ]
                        }
                    ]
                )
        )

    [meta] => Array
        (
            [vin] => LVSFCFME37F107967
            [is_valid] => true
        )


)
```

##### 参数说明

参数 | 类型 | 说明
--- | --- | ---
**model_id** | int | 车型id
**brand_name** | string | 汽车品牌名
**manu_name** | string | 汽车子品牌名
**family_name** | string | 车系名称
**sales_desig** | string | 销售名称
**vehicle_name** | string | 车型名称
**displacement** | string | 排量
**year_pattern** | string | 年款
**gearbox_type** | string | 变速箱类型
**engine_model** | string | 发动机型号
**fuel_type** | string | 燃油类型
**trans_desc** | string | 变速器描述
**gears_num** | string | 档位数
**front_tyre_spec** | string | 前轮胎规格
**rear_tyre_spec** | string | 后轮胎规格
**sales_version** | string | 销售版本
**hub_material** | string | 轮毂材料
**drive_system** | string | 驱动形式
**multi_model** | integer | 是否匹配多个车型(1,2) 2表示多个

**id** | int | 车型id
**brand_id** | int | 汽车品牌ID
**sub_brand_id** | int | 子品牌ID
**series_id** | int | 车系ID
**manu_id** | int | 厂商ID
**brand_name** | sting | 汽车品牌名称
**sub_brand_name** | sting | 子品牌名称
**series_name** | sting | 车系名称
**manu_name** | sting | 厂商名称
**model_name** | sting | 车型名称
**sales_desig** | sting | 销售名称
**sales_version** | sting | 销售版本
**model_year** | sting | 年款
**emission_std** | sting | 排放标准
**structure_type** | sting | 车辆类型
**category_size** | sting | 车辆级别
**guidance_price** | sting | 指导价格
**sale_from_year** | sting | 上市年份
**sale_from_month** | sting | 上市月份
**const_from** | sting | 生产年份
**const_to** | sting | 停产年份
**const_state** | sting | 生产状态
**sale_state** | sting | 销售状态
**country** | sting | 国别
**manu_type** | sting | 厂商类型:国产合资进口
**chassis_num** | sting | 底盘号
**engine_code** | sting | 发动机型号
**cyl_capacity** | int | 汽缸容积
**displacement** | sting | 排量
**aspirated_way** | sting | 进气形式
**fuel_type** | sting | 燃油类型
**fuel_label** | sting | 燃油标号
**full_power** | int | 最大马力(ps)
**ouput_kw** | int | 功率(kw)
**output_rpm** | int | 功率转速(rpm)
**torque_np** | int | 扭矩(nm)
**torque_rpm** | sting | 扭矩转速(rpm)
**cyl_arr** | sting | 汽缸排列形式
**cyl_num** | int | 汽缸数量
**valves_per_cyl** | int | 每缸气门数
**comp_ratio** | sting | 压缩比
**mixture_prep** | sting | 供油方式
**mii_fuel_eco** | sting | 工信部综合油耗
**town_fuel_eco** | sting | 市区工况油耗
**sub_fuel_eco** | sting | 市郊工况油耗
**acce_time** | sting | 加速时间
**max_speed** | int | 最高车速(km/h)
**cylinder_diameter** | string | 缸径
**stroke** | string | 冲程
**engine_desc** | string | 发动机描述
**trans_type** | sting | 变速箱类型
**trans_desc** | sting | 变速箱描述
**trans_type_version** | sting | 变速箱型号版本
**gears_num** | int | 档位数
**front_brake** | sting | 前制动类型
**rear_brake** | sting | 后制动类型
**front_susp** | sting | 前悬挂类型
**rear_susp** | sting | 后悬挂类型
**steer_form** | sting | 转向机形式
**power_steer** | sting | 助力类型
**engine_loc** | sting | 发动机位置
**drive_mode** | sting | 驱动方式
**drive_system** | sting | 驱动形式
**structure** | sting | 车身形式
**length** | int | 长度(mm)
**width** | int | 宽度(mm)
**height** | int | 高度（mm）
**wheelbase** | int | 轴距(mm)
**front_gauge** | int | 前轮距(mm)
**rear_gauge** | int | 后轮距(mm)
**curb_weight** | int | 整备质量(kg)
**max_load** | sting | 最大载重质量(kg)
**tank_vol** | sting | 油箱容积(l)
**luggage_vol** | sting | 行李箱容积
**roof_type** | sting | 车顶型式
**carport_type** | sting | 车篷型式
**doors_num** | sting | 车门数量
**seats_num** | int | 车座数量
**front_tyre_spec** | sting | 前轮胎规格
**rear_tyre_spec** | sting | 后轮胎规格
**front_hub_spec** | sting | 前轮毂规格
**rear_hub_spec** | sting | 后轮毂规格
**hub_material** | sting | 轮毂材料
**spare_tyre_spec** | sting | 备胎

**exts** | array | 车型拓展参数
**category_name** | string | 品类名称
**property_id** | array | 属性id
**property_value_id** | array | 属性值id
**property_name** | array | 属性名称
**unit** | string | 单位

**vin** | string | Vin号
**is_valid** | string | vin号是否合法


## 通过vin码获取车型信息

### `getCarModelDetailByVin($vin)`

#### 调用示例

```php
$client = new HepcClient($host, $key, $secret, $opts);
$vin = new Vin($client);
$ret = $vin->getCarModelDetailByVin($code);
```

#### 返回示例

```php

Array
(
    [model_id] => 5836
    [brand_name] => 宝马
    [sub_brand_name] => 宝马(进口)
    [series_name] => X6
    [model_year] => 2009
    [displacement] => 3.0
    [model_name] => X6 xDrive35i
    [trans_type] => 自动
    [engine_code] => N54B30A
    [structure] => 两厢
    [drive_system] => 前置四驱
    [chassis_num] => E71
    [const_from] => 2008
    [manu_type] => 进口
    [sales_desig] => 3.0T 手自一体
)
```

##### 参数说明

参数 | 类型 | 说明
--- | --- | ---
**model_id** | int | 车型id
**brand_name** | string | 汽车品牌
**sub_brand_name** | string | 子品牌名称
**series_name** | string | 车系名称
**model_year** | string | 年款
**displacement** | string | 排量
**model_name** | string | 车型名称
**trans_type** | string | 变速箱类型
**engine_code** | string | 发动机型号
**structure** | string | 车身形式
**drive_system** | string | 驱动形式
**chassis_num** | string | 底盘号
**const_from** | string | 生产年份
**manu_type** | string | 厂商类型(国产/合资/进口)
**sales_desig** | string | 销售名称
