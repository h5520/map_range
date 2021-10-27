<?php
namespace houzhonghua\map_range;

class Map
{
	// 定位获取的纬度
	private $lat;
	// 定位获取的经度
	private $lng;

	/**
	 * 初始化方法
	 * @Author   HOU
	 * @DateTime 2021-09-11T16:11:42+0800
	 * @param    [type]                   $lat
	 * @param    [type]                   $lng
	 */
	public function __construct($lat,$lng)
	{
		$this->lat = $lat;
		$this->lng = $lng;
	}

	/**
	 * 计算经纬度范围
	 * @Author   HOU
	 * @DateTime 2021-10-27T11:42:37+0800
	 * @param    [type]  $lat 定位获取的纬度
	 * @param    [type]  $lng 定位获取的经度
	 * @param    [type]  $raidus 需要计算的公里范围 
	 */
	public function GetRange($raidus){

		$raidus = $raidus*1000;
	    // 计算纬度
	    $degree = (24901 * 1609) / 360.0;
	    $dpmLat = 1 / $degree;
	    $radiusLat = $dpmLat * $raidus;
	    $minLat = $this->lat - $radiusLat; //得到最小纬度
	    $maxLat = $this->lat + $radiusLat; //得到最大纬度

	    // 计算经度
	    $mpdLng = $degree * cos($this->lat * (PI() / 180));
	    $dpmLng = 1 / $mpdLng;
	    $radiusLng = $dpmLng * $raidus;
	    $minLng = $this->lng - $radiusLng; //得到最小经度
	    $maxLng = $this->lng + $radiusLng; //得到最大经度

	    // 范围
	    $range = array(
	            'minLat' => $minLat,
	            'maxLat' => $maxLat,
	            'minLng' => $minLng,
	            'maxLng' => $maxLng
	    );

	    return $range;
	}   

	/**
	 * 计算距离
	 * @Author   HOU
	 * @DateTime 2021-10-27T11:38:28+0800
	 * @param    [type]  $fP2Lat 固定地点的纬度
	 * @param    [type]  $fP2lng 固定地点的经度
	 * @return   [type]  距离 km
	 */
	public function distanceBetween($fP2Lat, $fP2lng){

	    $fEARTH_RADIUS = 6378137;

	    // 角度换算成弧度
	    $fRadlng1 = deg2rad($this->lng);
	    $fRadlng2 = deg2rad($fP2lng);
	    $fRadLat1 = deg2rad($this->lat);
	    $fRadLat2 = deg2rad($fP2Lat);

	    // 计算经纬度的差值
	    $fD1 = abs($fRadLat1 - $fRadLat2);
	    $fD2 = abs($fRadlng1 - $fRadlng2);

	    // 距离计算
	    $fP = pow(sin($fD1/2), 2) +
	          cos($fRadLat1) * cos($fRadLat2) * pow(sin($fD2/2), 2);
	    return number_format(intval($fEARTH_RADIUS * 2 * asin(sqrt($fP)) + 0.5) / 1000,2);
	}
}
?>