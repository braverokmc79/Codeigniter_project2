<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_board extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}
	
/*
	Ajax 테스트

*/
	public function test()
	{
		$this->load->view('ajax/test_v');
	}

	public function ajax_action()
	{
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$name=$this->input->post("name");
		echo $name."님 반갑습니다.!";
	}


	public function ajax_comment_add()
	{

		if(@$this->session->userdata('logged_in')==TRUE)
		{

			$this->load->model('board_m');

			$table=$this->input->post("table", TRUE);
			$board_pid=$this->input->post('board_id', TRUE);
			$comment_contents=$this->input->post('comment_contents', TRUE);


			if($comment_contents !='')
			{
				
				$write_data=array(
					'table' => $table, //게시판 테이블명
					'board_pid'=>$board_pid, //원글 번호
					'subject'=>'',
					'contents'=>$comment_contents,
					'user_id'=>$this->session->userdata('username')
				);

				//echo  implode(',' ,$write_data);
			
				$result =$this->board_m->insert_comment($write_data);

				if($result)
				{
					
					//글 작성 성공 시 댓글 목록 만들어 화면 출력
					$sql= " select * FROM ci_board  where board_pid = ? order by board_id desc ";
					$query=$this->db->query($sql , array(
						'0' => $board_pid
						)
					);

					$data=$query->result();

					//echo json_encode($data); // 1개의 데이터
					 echo json_encode($data);
					
					//$data['comment']=$query->result();
					//$this->load->view('board/ajax_commment_v', $data);
				
				}
				else
				{
					//글 실 패시 
					echo "글 작성에 실패 하였습니다.";
				}


			}
			else
			{
				//글 내용이 없을 경우
				echo "댓글 내용을 입력하세요.";
			}

		}
		else
		{
			//로그인 필요 에러
			echo "로그인하여야 합니다.";
			
		}
	}

}