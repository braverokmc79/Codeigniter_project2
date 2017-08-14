<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('todo_m');
		$this->load->helper(array('url', 'date'));
	}


	public function index()
	{
		$this->lists();
	}


	public function lists()
	{
		$data['list']=$this->todo_m->get_list();
		$this->load->view('todo/list_v', $data);
	}


	function view()
	{
		//todo 번호에 해당하는 데이터 가져오기
		$id=$this->uri->segment(3);

		$data['views']= $this->todo_m->get_view($id);

		//view 호출
		$this->load->view('todo/view_v', $data);
	}


	function write()
	{
		if($_POST)
		{
			//글쓰기 POST 전송 시
			$content =$this->input->post('content', TRUE);

		}

	}



}
