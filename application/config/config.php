<?php
// php가 실행하면서 발생하는 모든 에러 메시지에 대해 리포팅을 하도록
// 설장하고 화면에 표시하도록 설정한다.
error_reporting(E_ALL);
ini_set("display_errors", 1);
// URL이라는 상수를 선언한다.
define('URL', 'http://127.0.0.1/');
/** 나중에 여기에 DB관련 환경설정 값이 입력됨. */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'mymvc');
define('DB_USER', 'root');
define('DB_PASS', '1234');
?>