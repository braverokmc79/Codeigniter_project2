<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*

 사용자 인증 모델

*/
class Auth_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	//아이디 비빌번호 체크
	function login($auth)
	{
		$sql =" select username, email from USERS where username =? and password =?";
		$query=$this->db->query($sql, 
			array( 
				'username'=>$auth['username'],
				'password'=>$auth['password']
				)
			);

		if($query->num_rows()>0)
		{
			// 맞는 데이터가 있다면 해당 내용 반환
			return $query->row();
		}
		else
		{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}



}