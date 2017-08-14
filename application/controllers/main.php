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


}
