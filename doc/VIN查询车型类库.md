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

### `getCarModelByVin($vin)`

#### 调用示例

```php
$client = new HepcClient($host, $key, $secret, $opts);
$vin = new Vin($client);
$ret = $vin->getCarModelByVin($vin);
```

#### 返回示例
```php
Array
(
    [model_id] => 23611
    [brand_name] => 奥迪
    [family_name] => 奥迪TT
    [vehicle_name] => 2010款 奥迪 奥迪TT 三厢 2.0T 双离合变速器 典藏版 (AUDI TT 2.0TFSI COUPE)
    [displacement] => 1.984
    [year_pattern] => 2010
    [gearbox_type] => 双离合变速器
    [engine_model] => 德国奥迪BWA
)
```

##### 参数说明

参数 | 类型 | 说明
--- | --- | ---
**model_id** | int | 车型id
**brand_name** | string | 汽车品牌名
**family_name** | string | 车系名称
**vehicle_name** | string | 车型名称
**displacement** | string | 排量
**year_pattern** | string | 年款
**gearbox_type** | string | 变速箱类型
**engine_model** | string | 发动机型号


