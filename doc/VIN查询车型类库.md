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

