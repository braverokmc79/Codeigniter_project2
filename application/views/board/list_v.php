<article id="board_area">
	<header>
		<h1></h1>
	</header>
	<table cellspacing="0" cellpadding="0" class="table">
		<thead>
			<tr>
				<th scope="col">번호</th>
				<th scope="col">제목</th>
				<th scope="col">작성자</th>
				<th scope="col">조회수</th>
				<th scope="col">작성일</th>
			</tr>
		</thead>

		<tbody>
	<?php		
		foreach ($list as $lt ) {
		?>
		<tr>
			<th scope="row">
				<?php echo $lt->board_id; ?>
			</th>
			<td>
	<a rel="external" href="/todo/<?php echo $this->uri->segment(1);?>/view/<?php  echo $this->uri->segment(3); ?>" >
			<?php echo $lt->subject; ?></a></td>
			<td><?php echo  $lt->user_name; ?></td>
			<td><?php echo $lt->hits; ?></td>
			<td>
			<time datetime="<?php echo mdate("%Y. %m. %j" ,human_to_unix($lt->reg_date)); ?>" >
			<?php echo mdate( "%Y. %m. %j ", human_to_unix($lt->reg_date)); ?></time></td>

		</tr>
	<?php		
		}
	?>
		</tbody>

	</table>
</article>