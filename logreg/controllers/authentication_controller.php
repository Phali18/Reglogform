<?php

class AuthenticationController {

    public function validate() {
        if (!isset($_GET['email']))
            return call('pages', 'error');

        try {
            $row = Auth::duplicate_check($_GET['email']);
            require_once('../views/auth/signup.php');
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            require_once('C:\xampp\htdocs\logreg\views\signup.php'); // takes it to the form that they need to sign in
          
        }else{
            Authentication::insertAdmin();
            $stmt = Authentication::all();
            //require_once('..//');
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
            require_once('../views/signup.php');

            $rows = Auth::all();
        }
    }

}
