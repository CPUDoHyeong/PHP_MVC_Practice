
<?php
class Sitemap extends Controller
{
	public function index()
	{
		require 'application/views/_templates/header.php';
		require 'application/views/sitemap/index.php';
		require 'application/views/_templates/footer.php';
	}
}

?>