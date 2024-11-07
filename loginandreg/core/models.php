<?php 


function insertNewUser($pdo, $username, $password){
    $checkUserSQL = "SELECT * FROM user_passwords WHERE username = ?";
    $checkUserSQLStmt = $pdo->prepare($checkUserSQL);
    $checkUserSQLStmt->execute([$username]);

    if($checkUserSQLStmt->rowCount()== 0){
        $sql = "INSERT INTO user_passwords(username, password) VALUES(?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $password]);

        if ($executeQuery){
            $_SESSION['message'] = "User successfully inserted!";
            return true;
        }
        else {
            $_SESSION['message'] = "may error jo";

        }
    }
    else {
        $_SESSION['message'] = "user already exists!";
    }
}

function loginUser($pdo, $username, $password){

    $sql = "SELECT * FROM user_passwords WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$username]);

    if ($executeQuery){
        $userInfoRow = $stmt->fetch();
        $usernameFromDB = $userInfoRow['username'];
        $passwordFromDB = $userInfoRow['password'];

        if ($password == $passwordFromDB){
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['message'] = 'Login Succesful';

            return true;
        }
        else{
            $_SESSION['username'] = 'password dont match';
        }
    }
    else{
        $_SESSION['username'] = 'user dont exist';
    }
}


function getAllUsers($pdo){
    $sql = "SELECT * FROM user_passwords";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery){

        return $stmt->fetchAll();
    }
}

function getUserByID($pdo, $user_id){
    $sql = "SELECT * FROM user_passwords WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$user_id]);

    if ($executeQuery){
        return $stmt->fetch();
    }
}

?>