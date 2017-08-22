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


	function get_list($table, $type='', $offset='',$limit='',$search_word='')
	{
		$sword='';

		if($search_word !='')
		{
			//검색어가 있을 경우의 처리;
			$sword =' and subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
		}


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

		$sql ="select * from  ".$table. " where  board_pid =0". $sword."   order by board_id desc ".$limit_query ;


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


	/*
		게시물 상세보기 가져오기
	 */
	
	function get_view($id)
	{
		$table="ci_board";

		//조횟수 증가
		$sql0="UPDATE ".$table." set hits = hits+1  where board_id =? ";
		$this->db->query($sql0, array($id));

		$sql=" Select * from ".$table." where board_id = ? ";
		$query=$this->db->query($sql, array($id));

		//게시물 내용 반환
		$result =$query->row();
		return $result;
	}


	//쓰기
	function insert_board($arrays)
	{
		$insert_array= array(
			'board_pid' => 0, //원글이라 0을 입력, 댓글일 경우 번호 입력
			'user_id' =>$arrays['user_id'], 
			'user_name' =>'마카로닉스',
			'subject'=>$arrays['subject'],
			'contents'=>$arrays['contents'],
			'reg_date'=>date("Y-m-d H:i:s")
		);

		$result=$this->db->insert($arrays['table'], $insert_array);

		//결과 반환
		return $result;
	}

/*
	게시물 수정

	*/
	function modify_board($arrays)
	{
		$modify_array=array(
				'subject'=>$arrays['subject'],
				'contents'=>$arrays['contents']
			);

		$where=array(
				'board_id'=>$arrays['board_id']
			);

		$result=$this->db->update($arrays['table'], $modify_array, $where);

		//결과 반환
		return $result;
	}


	//게시물 삭제
	function delete_content($table, $no)
	{
		$delete_array=array(
			'board_id' =>$no
		);
		$result =$this->db->delete($table, $delete_array);
		//결과 반환
		return $result;
	}



	function writer_check()
	{
		$sql=" select user_id from CI_BOARD where board_id = ?" ;
		$query=$this->db->query($sql, array('board_id'=>$this->uri->segment(4)));
		return $query->row();

	}





	//댓글 입력
	function insert_comment($arrays)
	{
		$insert_array=array(
			'board_pid' =>$arrays['board_pid'], //원글 번호 입력
			'user_id' =>$arrays['user_id'],
			'user_name'	=>$arrays['user_id'],
			'subject'=>$arrays['subject'],
			'contents'=>$arrays['contents'],
			'reg_date'=>date("Y-m-d H:i:s")
		);

		$this->db->insert($arrays['table'], $insert_array);


		//******  이 구문은 최근에 입력된 번호를 반환합니다.
		$board_id=$this->db->insert_id();

		//결과 반환
		return $board_id;
	}



	// 댓글 리스트를 화면에 출력하기 위해 리스트를 가져오는 함수입니다.
	function get_comment($table, $id)
	{
		$sql=" select * from ci_board where board_pid =? order by board_id desc ";
		$query=$this->db->query($sql , array( 
				'0'=>$id
				)
		);

		//댓글 리스트 반환
		$result=$query->result();
		return $result;
	}




}








