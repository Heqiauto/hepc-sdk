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
$ret = $vin->getCarModelByVin($vin, $type, $detail);//$detail默认为0不返回详细信息，传1可返回详细信息
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

**vin** | string | Vin号
**is_valid** | string | vin号是否合法


## 通过vin码获取车型信息

### `getCarModelDetailByVin($vin)`

#### 调用示例

```php
$client = new HepcClient($host, $key, $secret, $opts);
$vin = new Vin($client);
$ret = $vin->getCarModelDetailByVin($vin);
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
