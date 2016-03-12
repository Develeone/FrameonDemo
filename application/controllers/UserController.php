<?php
// TODO припилить защиту от подборов паролей, разрешая только по 5 попыток логина в 15 минут
class UserController extends Controller {
    function ShowLoginForm() {
        $this->user = new User();
        if ($this->user->check()) {
            header('Location:/personal');
        }
        $this->render('fullpage@user/login');
    }

    function Login () {
        if (isset($_POST['login'])) {
            $this->user->login = $_POST['login'];
            $this->user->password = $_POST['password'];

            if ($this->user->check()) {
                header('Location:/personal');
                exit();
            } else {
                $this->render('fullpage@user/login', array("error"=>true));
            }
        }
    }

    function ShowRegisterForm() {
        if ($this->user->check()) {
            header('Location:/personal');
        }
        $this->render('fullpage@user/register');
    }

    function Register () {
        $errors = array();

        if (isset($_POST['login'])) {
            $login = strtolower(trim($_POST['login']));
            $email = trim($_POST['email']);

            if (strlen($login) < 5) // TODO логин слишком длинный
                array_push($errors, "Логин слишком короткий! Требуется более пяти символов.");

            if (!preg_match("/^[a-z0-9]+(_?[a-z0-9])*$/i", $login))
                array_push(
                    $errors,
                    "Логин содержит недопустимые символы! Используйте только латинские символы".
                    ", цифры и знаки подчеркивания. Логин не может начинаться или заканчиваться символом \"_\"."
                );

            if (strlen($email) < 10) // TODO емэйл слишком длинный
                array_push($errors, "Пожалуйста, заполните поле Email корректно!");

            if (strlen($_POST['password']) < 5)
                array_push($errors, "Пароль слишком короткий! Требуется более пяти символов.");

            if ($_POST['password'] != $_POST['password_check'])
                array_push($errors, "Пароли не совпадают!");

            if (count($errors) == 0) {
                $this->user->login = $login;
                $this->user->email = $email;
                $this->user->password = $_POST['password'];
                $this->user->allow_notifying = isset($_POST['allow_notifying']);

                if ($this->user->register()) { // Success
                    header('Location:/personal');
                    return;
                } else {
                    $errors = array_merge($errors, $this->user->errors);
                }
            }

            $this->render(
                'fullpage@user/register',
                array(
                    "login" => $login,
                    "email" => $email,
                    "allow_notifying" => $_POST['allow_notifying'],
                    "errors" => $errors
                )
            );
        }
    }

    function Logout () {
        $this->user->logout();
        header('Location:/');
    }

    function ShowPersonal () {
        $this->render('fullpage@user/personal');
    }
}