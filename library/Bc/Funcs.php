<?php

class Bc_Funcs {
	protected static $ip = '';
	
	public static function cutstr($str, $len, $suffix='...') {
		$slen = iconv_strlen($str, 'utf-8');
		if ($slen>$len) {
			$str = iconv_substr($str, 0, $len, 'utf-8').' '.$suffix;
		}

		return $str;
	}

	public static function ip() {
		if (self::$ip=='') {
			self::$ip = getenv('HTTP_CLIENT_IP');
			if (!self::$ip) {
				$ips = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
				foreach ($ips as $ip) {
					list($first, $bar) = explode('.', trim($ip));
					if ($first!='192' && $first!='127' && $first!='10') {
						self::$ip = trim($ip);
						break;
					}	
				}
				
				if (!self::$ip) {
					self::$ip = array_pop($ips);
				}
				
				if (!self::$ip) {
					self::$ip = getenv('REMOTE_ADDR');
					if (!self::$ip) {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
				}
			}
		}
		
		return self::$ip;
	}

	public function array_merge($array1, $array2) {
		$array = $array1;

		foreach ($array2 as $k=>$v) {
			$array[$k] = $v;
		}

		return $array;
	}

	public static function rand($length="32"){
		$str="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$result="";
		for($i=0;$i<$length;$i++){
			$num[$i]=rand(0,25);
			$result.=$str[$num[$i]];
		}
		return $result;
	}
}