<?php
// declare (strict_types = 1);

namespace app\index\controller;
use app\index\BaseController;
use houzhonghua\map_range\Map;

class Test extends BaseController
{   
    public function test(){

        $lat = 39.899722; // 维度
        $lng = 116.484974; // 经度

        $map = new Map($lat,$lng);
        $range = $map->GetRange(100);
        $distance = $map->distanceBetween("39.90232", "116.484821");

        print_r($range);
        print_r($distance);
    }

    public function list(Request $request){

        $input = $request->param();

        $lat = $input['lat']; // 维度
        $lng = $input['lng']; // 经度

        $map = new Map($lat,$lng);

        // 查询条件
        $result = $map->GetRange($lat,$lng,100*1000);
        
        $where[] = ['lat','between',"{$result['minLat']},{$result['maxLat']}"];
        $where[] = ['lng','between',"{$result['minLng']},{$result['maxLng']}"];
        $storelist = Brandlist::where($where)->select()->toArray();

        // 算距离
        foreach($storelist as $k => &$v){

            $sort[$k] = $v['distance'] = $map->distanceBetween($lat, $lng, $v['lat'], $v['lng']);
        }

        // 按距离排序
        array_multisort($sort,SORT_ASC,$storelist);

        return json($storelist);
    }
}