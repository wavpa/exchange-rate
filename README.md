# ExchangeRate

基于[极速数据汇率查询](https://www.jisuapi.com/api/exchange/)的汇率组件。

## 安装

```sh
composer require wavpa/exchange-rate -vvv
```

## 配置

在使用本扩展之前，你需要去极速数据注册账号，然后创建应用，获取应用的 API Key。

## 使用

```php
use Wavpa\ExchangeRate\ExchangeRate;

$key = 'xxxxxxxxxxxxxxxx';

$exchangeRate = new ExchangeRate($key);
```

## 汇率转换

```php
$response = $exchangeRate->convert('CNY', 'USD');
```

示例:

```php
{
    "status":0,
    "msg":"ok",
    "result":{
        "from":"CNY",
        "to":"USD",
        "fromname":"人民币",
        "toname":"美元",
        "updatetime":"2020-08-24 16:04:42",
        "rate":"0.1447",
        "camount":0.1447
    }
}
```

## 参数说明

```php
string convert(string $from, string $to)
```

- $from 要换算的单位，比如：“CNY“；
- $to   换算后的单位，比如：“USD“；

## 在 Laravel 中使用

在 Laravel 中使用也是同样的安装方式，配置写在`config/services.php`中：

```php
'exchange-rate' => [
    'key' => env('EXCHANGE_RATE_API_KEY'),
],
```

然后在`.env`中配置`EXCHANGE_RATE_API_KEY`：

```
EXCHANGE_RATE_API_KEY=xxxxxxxxxxxxxxxx
```

可以用两种方式来获取`Wavpa\ExchangeRate\ExchangeRate`实例：

1. 方法参数注入

```php
public function convert(Request $request, ExchangeRate $exchangeRate, $from, $to)
{
    return $exchangeRate->convert($from, $to);
}
```

2. 服务名访问

```php
public function convert(Request $request, $from, $to)
{
    return app('exchange-rate')->convert($from, $to);
}
```

## 参考

[极速数据汇率查询](https://www.jisuapi.com/api/exchange/)

## License

MIT
