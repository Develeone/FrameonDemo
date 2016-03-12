<?php
class UserController extends Controller {
	function wtf(){
		$model = new User();
		$this->render('index',array('model'=>$model));
	}

    function ShowLoginForm() {
        $this->render('fullpage@user/login');
    }

    function Login () {
        $user = new User();
        if (isset($_POST['login'])) {
            $user->login = $_POST['login'];
            $user->password = $_POST['password'];

            if ($user->auth()) {
                header('Location:/personal');
                exit();
            } else {
                Die('Whoops, something went wrong!');
            }
        }
    }

    function ShowRegisterForm() {
        $this->render('fullpage@user/register');
    }

    function Register () {
        $user = new User();
        if (isset($_POST['login'])) {
            $user->login = $_POST['login'];
            $user->password = $_POST['password'];

            if ($user->auth()) {
                header('Location:/personal');
                exit();
            } else {
                Die('Whoops, something went wrong!');
            }
        }
    }

    function ShowPersonal () {
        $this->render('fullpage@user/personal');
    }
}