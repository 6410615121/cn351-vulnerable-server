<?php
// Filename: db_model.php

$server = "mariadb"; //localhost
$username = "root";
$password = "secret";
$database = "my_db";

function db_connect($server, $username, $password, $database)
{
    $link = mysqli_connect($server, $username, $password, $database);
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $link;
}

$link = db_connect($server, $username, $password, $database);

function create_user($username, $password, $email)
{
   global $link;
   $query = "INSERT INTO users (username, password, email) VALUES('$username', '$password', '$email')";
   $result = mysqli_query($link, $query);

   if (!$result) {
       die("Query failed: " . mysqli_error($link));
   }
   return $result; // Return true or False
}

function login($username, $password){
    global $link;
    $query = "SELECT username, email FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        return $user; // Login successful
    } else {
        return false; // Login unsuccessful
    }
}

function addComment($comment,$user){
    global $link;
    $query = "INSERT INTO comments (comment,user) VALUES('$comment','$user')";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }
    return $result; // Return true or False
}

function getComments(){
    global $link;
    $query = "SELECT * FROM comments";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }

    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $comments;
}

function delete_all_comments(){
    global $link;
    $query = "DELETE FROM comments";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }
    return $result; // Return true or False
}

function get_user($username){
    global $link;
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }

    $user = mysqli_fetch_assoc($result);
    return $user; // Return true or False
}

function update_email($username, $new_email){
    global $link;
    $query = "UPDATE users set email = '$new_email' WHERE username = '$username'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }

    return $result; // Return true or False
}


