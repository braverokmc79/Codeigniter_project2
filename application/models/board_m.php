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


	function get_list()
	{
		$table='ci_board';

		$sql="SELECT * FROM $table order by board_id desc ";
		$query =$this->db->query($sql);
		$result=$query->result();
		return $result;		
	}

}