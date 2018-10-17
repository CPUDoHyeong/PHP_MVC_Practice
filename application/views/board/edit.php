<h2>여기는 게시판 글 수정(board/edit/글번호)입니다.</h2>
<p>이 페이지는 <?php echo URL; ?>board/edit/글번호와 같이 접근할 수 있습니다.</p>
<div class="board-write">
	<form action="<?php echo URL; ?>board/update" method="POST">
		<input type="hidden" name="idx" id="idx" value="<?php echo $board_data->idx;?>">
		<p>글제목 : <input type="text" name="title" id="title" style="width:300px;" value="<?php echo $board_data->title;?>"></p>
		<p>글쓴이 : <input type="text" name="writer" id="writer" style="width:200px;" value="<?php echo $board_data->writer;?>"></p>
		<p>글내용 : <textarea name="content" id="content" style="width:300px;height:80px;"><?php echo $board_data->content;?></textarea></p>
		<p><input type="submit" name="submit_update_board" value="저장하기"> <button onclick="location.href='<?php echo URL; ?>board/index'">목록으로</button></p>
	</form>
</div>