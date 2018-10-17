<?php
class Board extends Controller
{
	public function index()
	{
		$board_model = $this->loadModel('BoardModel');
		$board_list = $board_model->getBoardList();
		require 'application/views/_templates/header.php';
		require 'application/views/board/index.php';
		require 'application/views/_templates/footer.php';
	}
	public function write()
	{
		require 'application/views/_templates/header.php';
		require 'application/views/board/write.php';
		require 'application/views/_templates/footer.php';
	}
	public function view($idx)
	{
		$board_model = $this->loadModel('BoardModel');
		$board_view = $board_model->getBoardView($idx);
		require 'application/views/_templates/header.php';
		require 'application/views/board/view.php';
		require 'application/views/_templates/footer.php';
	}
	public function add()
	{
		if (isset($_POST["submit_insert_board"])) {
			$board_model = $this->loadModel('BoardModel');
			$board_model->addBoard($_POST["title"], $_POST["content"],  $_POST["writer"]);
		}
		header('location: ' . URL . 'board/index');
	}
	public function edit($idx)
	{
		$board_model = $this->loadModel('BoardModel');
		$board_data = $board_model->getBoardView($idx);
		require 'application/views/_templates/header.php';
		require 'application/views/board/edit.php';
		require 'application/views/_templates/footer.php';
	}
	public function update()
	{
		if (isset($_POST["submit_update_board"])) {
			$board_model = $this->loadModel('BoardModel');
			$board_model->updateBoard($_POST["idx"], $_POST["title"], $_POST["content"],  $_POST["writer"]);
		}
		header('location: ' . URL . 'board/index');
	}
	public function del($idx)
	{
		$board_model = $this->loadModel('BoardModel');
		$board_model->deleteBoard($idx);
		header('location: ' . URL . 'board/index');
	}
}