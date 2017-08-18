	
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

	<?php  echo validation_errors(); ?>		
	

		<form method="post" class="form-horizontal">
			<fieldset>
				<legend>폼 검증</legend>
				<div class="control-group">
					<label class="control-label" for="input01">아이디</label>
					<div class="controls">
						<input type="text" name="username" class="input-xlarge" id="input01" >
						<p class="help-block">아이디를 입력하세요.</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input02">비밀번호</label>
					<div class="controls">
						<input type="text" name="password" class="input-xlarge" id="input02" >
						<p class="help-block">비밀번호를 입력하세요</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input03">비밀번호 확인</label>
					<div class="controls">
						<input type="text" name="passconf" class="input-xlarge" id="input03" >
						<p class="help-block">비밀번호를 한번 더 입력하세요</p>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="input04">이메일</label>
					<div class="controls">
						<input type="text" name="email" class="input-xlarge" id="input04" >
						<p class="help-block">이메일을 입력하세요</p>
				</div>
				

		<div><input type="submit" value="전송" class="btn btn-primary" /></div>

		</form>
	</article>