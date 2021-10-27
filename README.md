# 使用方式

```bash
composer require houzhonghua/map_range dev-main
```

## 引入

```php
use houzhonghua\map_range\Map;
```

## 调用生成范围方法
```php
$query = new Map($lat,$lng);
$res = $query->GetRange(200); // 200 公里

// 查询条件
$where[] = ['lat','between',"{$result['minLat']},{$result['maxLat']}"];
$where[] = ['lng','between',"{$result['minLng']},{$result['maxLng']}"];
$storelist = Brandlist::where($where)
    ->field('id,title,mobile,province,city,county,address,lat,lng,pic')
    ->select()
    ->toArray();
print_r($storelist);
```

## 调用计算距离方法
```php
$query = new Map($lat,$lng);
$res = $query->distanceBetween($fP2Lat,$fP2Lng); // 固定地点的纬度 经度

```