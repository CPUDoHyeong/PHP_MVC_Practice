<?php

class Application {
    private $controller = null;
    private $action = null;

    public function __construct() {
		// 컨트롤러가 정상적으로 실행되었는지 아닌지
		// 판단하기 위해 cancontroll 이라는 변수 사용
		// 후에 cancontroll이 false라면 
		// 컨트롤러가 실행되지 않았다는 뜻이고
		// 오류를 띄워준다.
        $cancontroll = false;
		$url = "";
		// 만약 url 이 있다면
        if(isset($_GET['url'])) {
			// rtrim은 오른쪽 정해진 혹은 빈 문자열을 제거하는 함수
			// 아래에서는 get으로 가져온 url중 마지막에 /를 제거
			$url = rtrim($_GET['url'], '/');
			
			// filter_var를 통해 주소에 포함되어선 안될 문자열을 제거한다
            $url = filter_var($url, FILTER_SANITIZE_URL);
		}
		
		// explode를 통해 url을 /기호로 구분하고 그 구분한 값들을 params로 저장한다
		// 이때 params는 배열이된다.
		$params = explode('/' ,$url);
		
		// params 배열의 길이를 counts에 저장
		$counts = count($params);
		
		/* 
		아래 코드는 프로그램에서 호출할 콘트롤러를 정해주는 부분임.
		이 때의 this는 Application 자신을 말하고 이 this의 controller에
		home을 대입한다. 즉 위에 null값으로 초기화했던 controller는
		home값을 가지게 된다.
		왜 home을 저장하느냐 하면은 127.0.0.1 뒤에 아무것도 붙지 않을 경우
		기본적으로 보여줄 페이지가 필요하기 때문이다.
		하지만 127.0.0.1/ 뒤에 뭔가 붙게 된다면 위의 explode를 통해 
		/를 제외하고 하나씩 params 배열에 저장한다.
		그럼 params는 값을 가지게 되고 if문에서 true가 나올 것이다.
		그래서 기본 페이지인 home이 아니라 주소창에 있는 값으로 controller를 변경한다.
		예를 들어 127.0.0.1/board라면 board가 params에 저장되고
		controller는 home에서 board로 변경되는 것이다.
		*/
        $this->controller = "home";
        if(isset($params[0])) {
            if($params[0]) $this->controller = $params[0];
		}
		
		/*
		파일 존재의 유무를 확인하기 위해 file_exists 함수를 사용한다.
		file_exists(경로 및 파일이름); 
		파일이 있으면 true를 return 한다.
		만일 url에 127.0.0.1이 입력되었다면 controller를 home일 것이고
		./application/controller/ 경로에 home.php 파일이 있는지 확인한다는 것이다.
		그리고 파일이 있다면 그 파일을 require 시켜준다.
		*/
        if(file_exists('./application/controller/' . $this->controller .'.php')) {
			require './application/controller/' . $this->controller . '.php';
			
			// 이 부분은 controller의 객체를 생성하는 것이다.
			// 예를 들어 controller가 home이라면 home.php파일을 reqruire 해주었고
			// 객체를 만들 수 있게 된다.
			// 위에서 대입되는 controller가 다르기 때문에
			// 객체 생성을 new Home()과 같이 하는 것이 아니라 아래왁 같이 한다.
			$this->controller = new $this->controller();
			
			// 그 다음 action은 객체가 생성되고
			// 그 안에 포함된 메소드를 실행시켜주기 위함이다.
			// 지금 여기서는 기본 값으로 action에 index메소드가 실행되도록
			// 지정해 놓은 것이다.(action이 지정되지 않았을 때)
			$this->action = "index";
			// 그리고 주소 값 끝에 두번째 값이 있다면 그것을 action으로 지정해준다.
			if(isset($params[1])) {
				if($params[1]) $this->action = $params[1];
			}

			// 이제 action 즉 메서드가 지정되었으므로
			// 그 메소드가 존재하는지 확인해야한다.
			// method_exists(객체, 메소드)
            if (method_exists($this->controller, $this->action)) {
				// cancontroll 위에서 컨트롤러가 제대로 실행되었는지
				// 안되었는지 판단하기 위해 만들었다는 변수
				// 이 cancontroll은 여기와서야 true값을 가진다.
				$cancontroll = true;

				/*
				아래 switch문은 실제로 클래스의 메소드를 호출하는 코드이다.
				*/
				switch ($counts) {
					// counts가 0이라는 것은 127.0.0.1 을입력했다는것이고
					// 1이라는 것은 127.0.0.1/home 즉 파일까지만 입력했다는 것
					// 2라는 것은 127.0.0.1/about/map 즉 메소드까지 입력되었다는 것
					// 근데 여기까지의 메소드는 전부 action에 저장되어있으므로
					// case 2에서 한꺼번에 보고 메소드를 실행시킨다.
					// 아래에서 {$this->action} 의 중괄호가 없다면 에러가 발생한다.
					// $this->action이 문자열 변수이기 때문 !!
					case '0':
					case '1':
					case '2':
						$this->controller->{$this->action}();
						break;

					/*
					127.0.0.1/board/view/2와 같이 주소값에 3번째 값이 있다면
					이때부터는 메소드가 아닌 파라미터값으로 인식하게되고
					메서드에 넘겨주게 된다.
					이 작업까지 마치면 객체를 생성하고 메서드를 호출하고
					필요 시 파라미터까지 넘겨주는 것 까지 끝나게 된다.
					*/
					case '3':
						$this->controller->{$this->action}($params[2]);
						break;
					case '4':
						$this->controller->{$this->action}($params[2],$params[3]);
						break;
					case '5':
						$this->controller->{$this->action}($params[2],$params[3],$params[4]);
						break;
					case '6':
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5]);
						break;
					case '7':
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6]);
						break;
					case '8':
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
						break;
					case '9':
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8]);
						break;
					case '10':
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9]);
						break;
				}	
			}

			
		}

		//
		if($cancontroll === false) {
			// echo "<!DOCTYPE html><html><head><meta charset='utf-8'></head><body><h1>Oops!!! 잘못된 접근입니다.</h1></body></html>";
			require 'application/views/_templates/error_page.php';
        }
    }
}
?>
