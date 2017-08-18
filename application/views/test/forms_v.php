	
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

	<?php  //echo validation_errors(); ?>		
	
	<?php

		if(form_error('username')){
			$error_username= form_error('username');
		}else
		{
			$error_username=form_error('username_check');
		}
	
	?>


		<form method="post" class="form-horizontal">
			<fieldset>
				<legend>폼 검증</legend>
				<div class="control-group">
					<label class="control-label" for="input01">아이디</label>
					<div class="controls">
						<input type="text" name="username" class="input-xlarge" id="input01" 
						value="<?php echo set_value('username');?>">

						<p class="help-block">
						<?php if($error_username==FALSE){ echo "아이디를 입력하세요.";}
							else {	echo $error_username; }
						?>	
						</p>

	
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input02">비밀번호</label>
					<div class="controls">
						<input type="text" name="password" class="input-xlarge" id="input02" >
						<p class="help-block">
						<?php if(form_error('password')==FALSE){ echo "비밀번호를 입력하세요";}
							else {	echo form_error('password'); }
						?>	

						</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input03">비밀번호 확인</label>
					<div class="controls">
						<input type="text" name="passconf" class="input-xlarge" id="input03" >
							
						<p class="help-block">
					<?php if(form_error('passconf')==FALSE){ echo "비밀번호를 한번 더 입력하세요.";}
						else { echo form_error('passconf');}
					?>
						</p>
					
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="input04">이메일</label>
					<div class="controls">
						<input type="text" name="email"  id="input04" 
							value="<?php echo set_value('email'); ?>" class="form-control">
						<p class="help-block">이메일을 입력하세요</p>

				</div>
				
				<!-- set_value 폼이 처음 로딩될 때 기본 값을 '0' 이 설정되어 보여집니다. -->
				<div class="control-group">
					<label class="control-label">기본값 0 설정</label>
				<input type="text" class="form-control" name="count" value="<?php echo set_value('count' , '0'); ?>" />
				</div>
			<!-- 	set_select . 첫 번째 아이템의 세 번째 파라미터가 TRUE 이므  one 로선택된 값입니다. -->
				<div class="control-group">
				<label class="control-label">선택박스</label>
				<select name="myselect" class="form-control">
					<option value="one" <?php echo set_select('myselect', 'one'  ) ;?>>Oen</option>
					<option value="two" <?php echo set_select('myselect', 'two', TRUE); ?> >Two</option>
					<option value="three" <?php echo set_select('myselect', 'three' ) ; ?> >Three</option>
				</select>
				</div>

				<div class="control-group">
					<label class="control-label" for="input07">체크박스</label>
					<div class="controls">
						1번 <input type="checkbox" name="mycheck[]" id="input07" value="1" 
						<?php echo set_checkbox('mycheck[]', '1', TRUE);	?> >
						2번 <input type="checkbox" name="mycheck[]" id="input07" value="2"
							<?php  echo set_checkbox('mycheck[]', '2'); ?> >
						<p class="control-group">체크박스를 선택하세요.</p>
					</div>
				</div>	


				<!-- set_radio. set_checkbox 와 동일 -->
				<div class="control-group">
				<label class="control-label">라디오 박스</label>
					<input type="radio" name="myradio" value="1" <?php echo set_radio('myradio', '1', TRUE) ?> >	
					<input type="radio" name="myradio" value="2" <?php echo set_radio('myradio', '2'); ?> >
				</div>


			<p></p>
		<input type="submit" value="전송" class="btn btn-primary" />
		

		</form>
	</article>