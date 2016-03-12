<?php
class User extends Registry {
    public $login = 'Name';
    public $password = 'Name';

    public function auth () {
        return true;
    }
}