<?php

// 어플리케이션의 환경설정을 저장하고 있다 (예 : DB이름, URL상수 등)
require 'application/config/config.php';
// 주소처리와 클래스 실행 등 이 mvc 프로그램의 핵심코드
require 'application/libs/application.php';
// 컨트롤러를 실행할 때 기본적으로 실행해야 할 코드들이 포함되어있음
require 'application/libs/controller.php';
// application.php 파일의 Application 클래스를 생성한다
$app = new Application();
?>
