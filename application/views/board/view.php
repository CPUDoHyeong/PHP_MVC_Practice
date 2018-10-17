<h2>여기는 게시판 글 보기(board/index)입니다.</h2>
<p>이 페이지는 http://127.0.0.1/board/view/글번호 와 같이 접근할 수 있습니다.</p>
<div class="board-view">
	<h2><?php echo $board_view->idx;?>. <?php echo $board_view->title;?></h2>
	<p><?php echo $board_view->content;?></p>
	<p>글쓴이 : <?php echo $board_view->writer;?></p>
	<p>저장일 : <?php echo $board_view->wdate;?></p>
</div>
<button onclick="location.href='/board/index'">목록으로</button>