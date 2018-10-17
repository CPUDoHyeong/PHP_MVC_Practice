<h2>여기는 게시판 목록 페이지(board/index)입니다.</h2>
<p>이 페이지는 <?php echo URL; ?>board 또는 <?php echo URL; ?>board/index 로 접근할 수 있습니다.</p>
<ul class="board-list">
<?php foreach($board_list as $row){?>
<li>
	<a href="<?php echo URL; ?>board/view/<?php echo $row->idx;?>"><?php echo $row->title;?> / <?php echo $row->writer;?> / <?php echo $row->wdate;?></a>&nbsp;
	[<a href="<?php echo URL; ?>board/edit/<?php echo $row->idx;?>">edit</a>]&nbsp;
	[<a href="javascript:confirmDelete('<?php echo URL; ?>board/del/<?php echo $row->idx;?>')">delete</a>]
</li>
<?php } //end foreach?>
</ul>
<button onclick="location.href='<?php echo URL; ?>board/write'">글쓰기</button>
<script>
	function confirmDelete(url) {
		if( confirm('정말 삭제하시겠습니까?') ) {
			location.href = url;
		}
	}
</script>