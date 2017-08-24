	

	<article id="board_area">
		<header>
			<h1></h1>
		</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><?php echo $views->subject;?></th>
					<th scope="col">이름 : <?php echo $views->user_name;?></th>
					<th scope="col">조회수 : <?php echo $views->hits;?></th>
					<th scope="col">등록일 : <?php echo $views->reg_date;?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="4">
						<?php echo $views->contents;?>
					</th>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4"><a href="/todo/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a> 
					<a href="/todo/board/modify/board_id/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>page/<?php echo $this->uri->segment(6);?>" class="btn btn-warning">수정</a> 

<a href="/todo/board/delete/board_id/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/page/<?php echo $this->uri->segment(6);?>" class="btn btn-danger">삭제</a> 

				 <a href="/todo/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a></th>
				</tr>
			</tfoot>
		</table>

		<form class="form-horizontal" method="post" action="/todo/board/write" name="com_add">
		  <fieldset>
		    <div class="control-group">
		      <label class="control-label" for="input01">댓글</label>
		      <div class="controls">
		        <textarea class="input-xlarge" id="input01" name="comment_contents" rows="3"></textarea>
				<input class="btn btn-primary" type="button" id="comment_add" value="작성">
		        <p class="help-block"></p>
		      </div>
		    </div>
		  </fieldset>
		</form>



		<div id="comment_area">
			<table cellspacing="0" cellpadding="0" class="table table-striped" id="comment_table">
			
			<?php
				foreach ($comment_list as $lt) {
			
			?>
				<tr id="row_num_<?php echo $lt->board_id; ?>">
					<th scope="row">
						<?php echo $lt->user_id; ?>
					</th>
					<td><?php echo $lt->contents;?></a></td>
					<td><?php echo $lt->reg_date; ?></td>
					<td>
					<a href="#" onclick="javascript:comment_delete('<?php  echo $lt->board_id; ?>')"><i class="icon-trash"></i>삭제</a></td>
				</tr>
			<?php			
				}
			?>
			</table>
		</div>

	</article>



<script type="text/template" id="answerTemplate">

		<tr>
			<th scope="row">
				{0}
			</th>

			<td>{1}</td>
			
			<td>{2}</td>

			<td><a href="javascript:comment_delete({3})";>삭제</a></td>
		</tr>

</script>






<script type="text/javascript">
$(function(){

	$("#comment_add").click(function(){

		var comment_contents=encodeURIComponent($("#input01").val()) ;
		var csrf_test_name=getCookie('csrf_cookie_name');
		var table ="ci_board";
		var board_id =<?php echo $this->uri->segment(3); ?>;
		console.log("comment_contents : " + comment_contents + " csrf_test_name : " +csrf_test_name + " table : " +table + " board_id : " + board_id);
		

		$.ajax({
			url: "/todo/ajax_board/ajax_comment_add",
			type:"POST",
			data:{
				"comment_contents" :comment_contents,
				"csrf_test_name" :csrf_test_name,
				"table":table,
				"board_id":board_id

			},
			dataType:"html",
			success:function(data, status){
				
				//1. 첫번째 방법 
				//$("#comment_area").html(data);	
				//2.두번째 방법
				onSuccess2(data,status);

				$("#input01").val('');

			},
			error:function(xhr){
				alert("댓글 에러");
			}

		});

	});



});

function getCookie( name )
	{
		var nameOfCookie = name + "=";
		var x = 0;

		while ( x <= document.cookie.length )
		{
			var y = (x+nameOfCookie.length);

			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
				if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
					endOfCookie = document.cookie.length;

				return unescape( document.cookie.substring( y, endOfCookie ) );
			}

			x = document.cookie.indexOf( " ", x ) + 1;

			if ( x == 0 )

			break;
		}

		return "";
	}




function onSuccess(data2, status){
	console.log(data2);
	var answerTemplate =$("#answerTemplate").html();
	var data =JSON.parse(data2);
	
	console.log("json 길이 : " +data.length);
	console.log(" json  - " + data[0].user_id +" : " +  data[0].contents + " : "+  data[0].reg_date);
	var template =answerTemplate.format(data[0].user_id, data[0].contents,  data[0].reg_date);


	$("#comment_area").prepend(template);
}




function onSuccess2(data2, status){
	console.log(data2);
	var answerTemplate =$("#answerTemplate").html();
	var data =JSON.parse(data2);

	var template='<table cellspacing="0" cellpadding="0" class="table table-striped" id="comment_table">';
	for(var i=0; i< data.length; i++){
	  template +=answerTemplate.format(data[i].user_id, data[i].contents,  data[i].reg_date, data[i].board_id);		  
	}
	template +="</table>";
	$("#comment_area").html(template);
}


String.prototype.format = function() {
    var formatted = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        formatted = formatted.replace(regexp, arguments[i]);
    }
    return formatted;
}


function comment_delete(boardId){

	$.ajax({
		url:"/todo/ajax_board/ajax_comment_delete",
		type:"POST",
		data:{
			"csrf_test_name" :getCookie('csrf_cookie_name'),
			'table':'ci_board',
			'board_id':boardId,
			'board_pid':'<?php echo $this->uri->segment(3); ?>'
		},
		dataType:"text",
		success:function(data, status){

			alert('삭제 했습니다.');
			onSuccess2(data,status);

		},
		error:function(data){
			alert("삭제에 실패 했습니다.");
		}

	});

}		
</script>



