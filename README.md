# 使用方式

```bash
composer require houzhonghua/curl dev-main
```

## 引入

```php
use houzhonghua\curl\Curl;
```

## 请求接口
```php
$query = new Curl($url,$method,$https,$header,$timeout);
$res = $query->curl($data);
print_r($res);
```