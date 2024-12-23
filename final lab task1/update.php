<?php

    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'webtech');
        return $con;
    }

    
    function login($username, $password){
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }

   
    function addUser($username, $password, $email){
        $con = getConnection();
        $sql = "INSERT INTO users (username, password, email) VALUES ('{$username}', '{$password}', '{$email}')";
        if (mysqli_query($con, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function getUser($id){
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE id={$id}";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }


    function getAllUser(){
        $con = getConnection();
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con, $sql);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    }


    function updateUser($id, $username, $password, $email){
        $con = getConnection();
       
        $id = mysqli_real_escape_string($con, $id);
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);
        $email = mysqli_real_escape_string($con, $email);

        $sql = "UPDATE users SET username='{$username}', password='{$password}', email='{$email}' WHERE id={$id}";

        if (mysqli_query($con, $sql)) {
            return true; 
        } else {
            return false; 
        }
    }


    function deleteUser($id){
        $con = getConnection();
        $id = mysqli_real_escape_string($con, $id); 
        $sql = "DELETE FROM users WHERE id={$id}";

        if (mysqli_query($con, $sql)) {
            return true;
        } else {
            return false; 
        }
    }

?>
