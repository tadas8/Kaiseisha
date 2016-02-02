<?

class tadaFunctions{
	function getSearch($val1 = null, $val2 = null, $val3 = null){
		$arrMeta = array();
		if($val1){
			array_push($arrMeta, array("key"=>"dropdown", "value"=>$val1, "compare"=>"="));
		}
		if($val2){
			array_push($arrMeta, array("key"=>"coupon_amount", "value"=>$val2, "compare"=>"="));
		}
		if($val3){
			array_push($arrMeta, array("key"=>"discount_type", "value"=>$val3, "compare"=>"LIKE"));
		}
		$arrMeta["relation"] = 'AND';
		return $arrMeta;
	}
}