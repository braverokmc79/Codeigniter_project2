<?php defined('BASEPATH') OR exit('No direct script access allowed');


/*
공통 게시판 모델
 */
class Board_m extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	function get_list($table, $type='', $offset='',$limit='')
	{
		$table='ci_board';
		
		$limit_query ='';

		//널일 경우 처리
		if(is_null($type))$type='';
		if(is_null($offset)) $offset='';
		if(is_null($limit)) $limit='';

		if($limit !='' OR $offset !='')
		{
			//페이징이 있을 경우의 처리
			$limit_query=' LIMIT '. $offset .', '. $limit ;
		}

		$sql ="select * from $table order by board_id desc ".$limit_query ;


		//$sql="SELECT * FROM $table order by board_id desc ";
		$query =$this->db->query($sql);

		if($type =='count')
		{
			//리스트를 반환하는 것이 아니라 전체 게시물의 개수를 반환
			$result =$query->num_rows();
			//$this->db->count_all($table);
		}
		else
		{
			//게시물 리스트 반환
			$result=$query->result();
		}

		return $result;		
	}






}

