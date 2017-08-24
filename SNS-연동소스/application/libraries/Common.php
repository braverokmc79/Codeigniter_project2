<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common{

	public function __construct() {

	}

	// CURL 함수
 	function restful_curl($url, $param='', $method='POST', $header='', $timeout=10) {
	    $method = (strtoupper($method) == 'POST') ? '1' : '0';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
        if(is_array($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_POST, $method);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	    $result = curl_exec($ch);
	    curl_close($ch);

	    return $result;
	 }

	function restful_curl_get($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
