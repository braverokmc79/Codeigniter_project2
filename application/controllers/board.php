<?php defined('BASEPATH') OR exit('No direct script access allowed');


/*
	게시팜 메인 컨트롤러
 */
class Board extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->model('board_m');
		$this->load->helper(array('url', 'date'));
	}


	/*
		주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	 */
	public function index()
	{
		$this->lists();
	}


	/*
		사이트 헤더, 푸터가 자동으로 추가 된다.
	 */
	public function _remap($method)
	{
		//헤더 include
		$this->load->view('header_v');

		if(method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}	

		//푸터 include
		$this->load->view('footer_v');
	}


	public function lists()
	{
		//$this->output->enable_profiler(TRUE);
		//검색어 초기화
		$search_word=$page_url='';
		$uri_segment=5;

		//주소 중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array=$this->segment_explode($this->uri->uri_string());

		if(in_array('q', $uri_array)){
			//주소에 검색어가 있을 경우의 처리, 즉 검색시
			$search_word=urldecode($this->url_explode($uri_array,'q'));

			//페이지네이션용 주소
			$page_url='/q/'.$search_word;
			$uri_segment=7;
		}


		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');



		$config=$this->pageConfig($page_url, $search_word);


		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		
		$data['pagination']=$this->pagination->create_links();

		//게시물 목록을 불러오기 위한 offset, limit 값 가져오기
		$page=$this->uri->segment($uri_segment, 1);

		if($page>1)
		{
			$start=(($page/$config['per_page']))*$config['per_page'];
		}
		else
		{
			$start=($page-1)*$config['per_page'];
		}

		$limit=$config['per_page'];

		//2.실질적인 페이징 처리 
		$data['list']=$this->board_m->get_list($this->uri->segment(3), '' , $start, $limit, $search_word);
		$this->load->view('board/list_v', $data);
	}




	function pageConfig($page_url, $search_word)
	{

		//페이지네이션 설정
		$config['base_url']='/todo/board/lists/ci_board/'.$page_url.'/page/'; //페이징 주소

		//1. 여기서는 카운터 수만 가져온다.
		$config['total_rows']=$this->board_m->get_list($this->uri->segment(3), "count",'','' ,$search_word);
		//게시물의 전체 개수
		$config['per_page']=5; //한 페이지에 표시할 게시물 수
		$config['uri_segment']=5; //페이지 번호가 위치한 세그먼트

		//페이지 번호
		$config['num_links']=2;
				
		//페이지 전체
		$config['full_tag_open']='<ul class="pagination">';
		$config['full_tag_close']='</ul>';
		
		//처음
		$config['first_tag_open']='<li>';
		$config['first_tag_close']='</li>';
		
		//마지막
		$config['last_tag_open']='<li>';
		$config['last_tag_close']='</li>';
		
		//현재
		$config['cur_tag_open']='<li class="active"><a href="#">';
		$config['cur_tag_close']='<span class="sr-only">(current)</span></a></li>';
		
		//숫자
		$config['num_tag_open']='<li>';
		$config['num_tag_close']='</li>';
		
		
		//다음
		$config['next_tag_open']='<li>';
		$config['next_tag_close']='</li>';
		
		//이전
		$config['prev_tag_open']='<li>';
		$config['prev_tag_close']='</li>';
		
		return $config;
	}



	//q 다음 검색어가 있을 경우 검색어를  가져온다. 
	function url_explode($url, $key)
	{
		$cnt =count($url);
		for($i=0; $i<$cnt; $i++)
		{
			if($url[$i] == $key)
			{
				$k=$i+1;
				return $url[$k];
			}
		}
	}

	function segment_explode($seg)
	{
		//세그먼트 앞뒤 '/' 제거 후 uri 를 배열로 반환
		$len =strlen($seg);
		if(substr($seg, 0, 1)=='/')
		{
			$seg=substr($seg, 1, $len);
		}	
		$len =strlen($seg);
		if(substr($seg, -1)=='/')
		{
			$seg=substr($seg, 0, $len-1);
		}
		$seg_exp=explode("/", $seg);
		return$seg_exp;

	}

	/*
		게시물 보기

	*/
	function view()
	{
		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
		$data['views']=$this->board_m->get_view($this->uri->segment(3));
		
		//echo "Dfef".$this->uri->segment(3);
		//view 호출
		$this->load->view('board/view_v', $data);
	}
}








