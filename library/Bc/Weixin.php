<?php

class Bc_Weixin {

	public static function sign($token, $t, $n) {
		$arr = array(
			$token, $t, $n
			);
		asort($arr);
		$sign = sha1(implode('', $arr));

		return $sign;
	}

	/**
	 *	获取access token
	 *	Note: 仅用于服务的公众号
	 *
	 */
	public static function accessToken()
	{
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'weixin_access_token';
		$accessToken = $cacher->get($key);

		if (!$accessToken) {
			$url = sprintf('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s', $xx, $xx);
			$client = new Zend_Http_Client($url);
			$response = $client->request();

			if ($response->isSuccessful()) {
				try {
					$json = json_decode(trim($response->getBody()));
					$accessToken = $json->access_token;

					$cacher->set($key, $accessToken, $json->expires_in);
				} catch (Exception $e) {

				}

			}
		}

		return $accessToken;
	}
}