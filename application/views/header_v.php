<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>CodeIgniter</title>

<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	$("#search_btn").click(function(){
		if($("#q").val()==''){
			alert('검색어를 입력하세요');
			return false;
		}else{
			var act ='/todo/board/lists/ci_board/q/'+$("#q").val()+'/page/1';
			$("#bd_search").attr('action', act).submit();
		}
	});

});

function board_search_enter(form){
	var keycode=window.event.keyCode;
	if(keycode ==13) $("#search_btn").click();
}

</script>


</head>
<body>
<div id="main" class="container">

	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
		<blockquote>
			<p>만들면서 배우는 CodeIgniter</p>
			<small>실행 예제</small>
			
		</blockquote>
	</header>

	<nav id="gnb"><!-- gnb Start -->
		<ul>
			<li><a rel="external" href="/todo/<?php $this->uri->segment(1); ?>/lists/<?php echo  $this->uri->segment(3); ?>" >게시판 프로젝트</a></li>
		</ul>
	</nav><!-- gnb End -->
		


