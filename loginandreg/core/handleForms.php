<?php 
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['registerUserBtn'])){

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (!empty($username) && !empty($password)){
        
        $insertQuery = insertNewUser($pdo, $username, $password);

        if($insertQuery){
            header("Location: ../login.php");
        }
        else{
            header("Location: ../register.php");
        }
    }
    else{
        $_SESSION['message'] = "please dapat walang empty ng input fields";
        header("Location: ../register.php");
    }

}
if (isset($_POST['loginUserBtn'])){
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (!empty($username) && !empty($password)){
        $loginQuery = loginUser($pdo, $username, $password);

        if ($loginQuery){
            header("Location: ../index.php");
        }
        else {
            header("Location: ../login.php");
            $_SESSION['message'] = "wala ka namang account e";
        }
    }
    else{
        $_SESSION['message'] = "please dapat walang empty ng input fields";
        header("Location: ../login.php");
    }
}

if (isset($_GET['logoutAUser'])){
    unset($_SESSION['username']);
    header("Location: ../login.php");
}

?>