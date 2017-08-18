<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
기타 테스트용 컨트롤러
*/
class Test extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}

	//주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	
	public function index()
	{
		$this->forms();
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



	//폼 검증 테스트
	public function forms()
	{
		// $this->ouput->enable_profiler(TRUE);

	 		//폼 검증 라이브러리 로드
			$this->load->library('form_validation');


			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('username', '아이디', 'trim|required|min_length[5]|max_length[12]|htmlspecialchars');
			$this->form_validation->set_rules('passconf', '비밀번호 확인', 'trim|required|md5|htmlspecialchars');
			$this->form_validation->set_rules('password', '비밀번호', 'trim|required|matches[passconf]|md5|htmlspecialchars');
			$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email|htmlspecialchars');

			//numeric 검사 대상이 숫자 이외의 문자를 포함할 때 FALSE 를 리턴합니다.
			$this->form_validation->set_rules('count', '기본 값', 'numeric');
			$this->form_validation->set_rules('myselect', '셀렉트값', '');
			$this->form_validation->set_rules('mycheck[]', '체크박스', '');
			$this->form_validation->set_rules('myradio', '라디오버튼' , '');


			if($this->form_validation->run() ==FALSE)
			{
				
				$this->load->view('test/forms_v');	
			}
			else
			{
				//폼 검증이 실패했을 경우 또는 일반 입력 페이지
				$data['test'] = array(
					'username'=>$this->input->post('username', TRUE),
					'password'=> $this->input->post("password", TRUE),
					'passconf'=>$this->input->post("passconf", TRUE),
					'email'=>$this->input->post('email', TRUE),
					'count'=>$this->input->post('count', TRUE),
					'myselect'=>$this->input->post('myselect', TRUE),
					'mycheck'=>$this->input->post('mycheck[]', TRUE),
					'myradio'=>$this->input->post('myradio', TRUE)

				);
				//폼 검증이 성공했을 때 보여줄 페이지
				$this->load->view('test/form_success_v', $data);
			}
		

	}


}