<?php

Class Auth {

    private $email;
    private $password;

    //should this be in the controller -- line 12!!
//  
    // assign the variables, 
    // if statement in the controller - P - if statements validating and then calling the model
    // go through the queries and change them to the DB names
    public function __construct($email, $password) {

        $this->email = $email;
        $this->password = $password;
    }

    public function findEmail($email) {

        $db = Db::getInstance();
        $sql = $db->prepare("SELECT FROM admin_login WHERE email = :email");
        $sql->execute(array('email' => $email));
        $row = $sql->fetch();

        if ($row) {
            return new Auth($count['email']);
        } else {
            //replace with a more meaningful exception
            throw new Exception('Email already exist, please login');
        }
    }

    public function insertAdmin() {

        $db = Db::getInstance();
       $sql = $db->prepare("INSERT INTO admin_login (email, password) VALUES (:email,  :password)");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $password);
        $password = password_hash($password, PASSWORD_DEFAULT);

        if (isset($_POST['email']) && $_POST['email'] != "") {
            $filteredEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if (isset($_POST['password']) && $_POST['password'] != "") {
            $filteredPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $email = $filteredEmail;
        $password = $filteredPassword;
        $sql->execute();
    }

    public function login() {

        $db = Db::getInstance();

        $query = $db->prepare("SELECT * FROM admin_login WHERE :email ='$email' AND :password ='$password'");
        $stmt = 
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $rows = $stmt->fetchall();

        foreach ($rows as $row) {
            if (password_verify($password, $row["password"])) {
                $_Session['email'] = $this->email;// Hi Izzy, I am not sure what this session is going 
                header('uploadblog.php');
            } else {
                throw new Exception();
            }
        }
        $_SESSION["message"] = "You are now logged in!";
        $_SESSION["alert-class"] = "alert-success";

//                should take them to a page here where they can actually upload the blog
    }

}

//click login it activates this sort of function with a try and catch block - could even have a controller and action
// which calls the logmein function which automatically call the two methods of duplicate check and
// checkuser, otherwise if one doesnt pass smoothly it throwns the error and GAMEOVER they have to 
// try again. 
//// think we could put both of these in the above class as compound methods but i just wanted to get your 
//thoughts on it - when u press the button 'LOGIN' it can call the logmein action and when you press the 
// button 'SIGNUP' it can make the signmeup method to run


function logmein() {
    try {

        auth::duplicate_check();
        auth::checkuser();
    } catch (Exception $ex) {
        echo "sorry, soemthing went wrong, try again";
    }
}

function signmeup() {
    try {
        auth::duplicate_checl();
        auth::insertuser();
    } catch (Exception $ex) {
        echo "something went wrong with singing you up, please try again";
    }
}
