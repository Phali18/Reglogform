<?php

class AuthenticationController {

    public $errors = array();

    public function validate() {


        if (isset($_POST["signup-btn"])) {

            if (empty($username)) {
                $errors["username"] = "Username Required";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Email addresss is invalid";
            }

            if (empty($email)) {
                $errors["email"] = "Email Required";
            }

            if (empty($password)) {
                $errors["password"] = "Password Required";
            }

            if ($password !== $passwordconf) {
                $errors["password"] = "The two password do not match";
            }

            try {
                Auth::duplicate_check();

                $row = Auth::all(); 
                //require_once('');
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
    }

    public function createAdmin() {
if (auth::duplicate_check()) {

        Auth::insertuser();

        $stmt = Auth::all();
        //require_once('');
    }
    }

    public function loginAdmin() {
        if (isset($_POST["login-btn"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            //validation
            if (empty($username)) {
                $errors["username"] = "Username Required";
            }

            if (empty($password)) {
                $errors["password"] = "Password Required";
            }
        } else {
            Auth::login();

            $rows = Auth::all();
        }
    }

}
