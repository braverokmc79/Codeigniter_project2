<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_m extends CI_Model
{

	function __construct()
	{
		parent:: __construct();
	}
/*
	todo 목록 가져오기


	*/

	function get_list()
	{
		//3.1 절에서 작서안 items 테이블에서 내용을 가져오는 SQL 문을 작성합니다.
		$sql = "SELECT * FROM ITEMS";

		//쿼리를 실행. mysql_query($sql) 과 동일합니다.
		$query=$this->db->query($sql);
		
		//객체 배열 형태로 반환
		$result=$query->result();
		
		return $result;
	}


	function get_view($id)
	{
		$sql =" SELECT * FROM ITEMS where id=$id" ;


		$query =$this->db->query($sql);

		$result =$query->row();

		//내용 변환
		return $result;
	}



}

