<?php

class User extends Registry {
    public $id = 0;
    public $login = '';
    public $password = '';
    public $password_hashed = '';
    public $email = '';
    public $confirmed = 'false';
    public $u_type = "PLAIN";
    public $allow_notifying = 'true';

    public $errors = array();

    private function hash_password ($password) {
        return md5(Config::get()->db->pwdprefhash.$this->login.$password);
    }

    public function auth () {
        $this->password_hashed = $this->hash_password($this->password);

        $result = DB::select()
            ->from(Config::get()->db->users_table)
            ->where("login", $this->login)
            ->where("password", $this->password_hashed)
            ->count();

        if ($result) {
            $result = DB::select()
                ->from(Config::get()->db->users_table)
                ->where("login", $this->login)
                ->where("password", $this->password_hashed)
                ->one();

            $this->id = $result->id;
            $this->email = $result->email;
            $this->confirmed = $result->confirmed;
            $this->u_type = $result->u_type;
            $this->allow_notifying = $result->allow_notifying;

            session_start();
            $_SESSION['login'] = $this->login;
            $_SESSION['password'] = $this->password;
        }

        return $result;
    }

    public function register () {
        $this->password_hashed = $this->hash_password($this->password);

        $login_exists = DB::select()
            ->from(Config::get()->db->users_table)
            ->where("login", $this->login)
            ->count();

        $email_exists = DB::select()
            ->from(Config::get()->db->users_table)
            ->where("email", $this->email)
            ->count();

        if ($login_exists > 0)
            array_push($this->errors, "Пользователь с таким логином уже зарегистрирован!");
        if ($email_exists > 0)
            array_push($this->errors, "Пользователь с таким email уже зарегистрирован!");

        if (count($this->errors) > 0)
            return false;

        DB::insert(
            array(
                "login"             => $this->login,
                "email"             => $this->email,
                "password"          => $this->password_hashed,
                "confirmed"         => $this->confirmed,
                "u_type"            => $this->u_type,
                "allow_notifying"   => $this->allow_notifying
            )
        )
        ->into(Config::get()->db->users_table)
        ->set();

        session_start();
        $_SESSION['login'] = $this->login;
        $_SESSION['password'] = $this->password;
        return true;
    }

    public function check ()
    {
        if ($this->login != '' && $this->password != '') {
            return $this->auth();
        } else {
            session_start();
            if (!empty($_SESSION['login']) && !empty($_SESSION['password'])) {
                $this->login = $_SESSION['login'];
                $this->password = $_SESSION['password'];

                return $this->auth();
            } else {
                return false;
            }
        }
    }

    public function logout () {
        session_start();
        unset($_SESSION["password"]);
    }
}