# 错误码

若请求错误，接口将抛出一个异常

#### 示例

```
Fatal error: Uncaught exception 'Heqiauto\HepcSdk\Exception' with message 'Errorcode:5001#Exception:Model not found'
```
请求的数据不存在，可能请求参数错误或该数据被删除，检查传入的参数再请求

#### 列表

错误码 | 错误信息 | 描述
---|---|---
5001 | Exception:Model not found | 数据未找到
5005 | REQUIRED_PARAM_NOT_PROVIDED | 缺少必须的参数，请检查参数是否有遗漏
5106 | Model not found | 品类未找到，检查品类参数是否正确
5120 | Missing required params | 必填的参数未提供或者提供了一个空值
5602 | No result for vin | 该VIN未找到车型
5619 | Recognize false | 图片识别错误
5629 | BASE64 error | Base64 编码错误
5631 | The num of vin is invalid, please check your num | 无效的VIN
5632 | Empty image | 图片为空，请检查后重新尝试
5701 | Not allowed to perform this unauthorized resource.  | 请求了不支持的服务
5702 | Not allowed to perform this resource, the number of requests is limited | QPS超限总额
5703 | Rate limit exceeded | QPS超限额
