<h2>여기는 게시판 글 쓰기(board/write)입니다.</h2>
<p>이 페이지는 http://127.0.0.1/board/write/ 와 같이 접근할 수 있습니다.</p>
<div class="board-write">
	<form action="<?php echo URL; ?>board/add" method="POST">
		<p>글제목 : <input type="text" name="title" id="title" style="width:300px;"></p>
		<p>글쓴이 : <input type="text" name="writer" id="writer" style="width:200px;"></p>
		<p>글내용 : <textarea name="content" id="content" style="width:300px;height:80px;"></textarea></p>
		<p><input type="submit" name="submit_insert_board" value="저장하기"> <button onclick="location.href='<?php echo URL; ?>board/index'">목록으로</button></p>
	</form>
</div>
<button>저장하기</button>
<button onclick="location.href='/board/index'">목록으로</button>