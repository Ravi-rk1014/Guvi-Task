<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location: php/login.php");
    }

    $mongo = new MongoDB\Driver\Manager("mongodb://username:password@hostname:27017/mydb");
    $filter = ['_id' => new MongoDB\BSON\ObjectID($user_id)];
    $query = new MongoDB\Driver\Query($filter);
    $result = $mongo->executeQuery("mydb.users", $query);
    $user = $result->toArray()[0];

    $name = $user->name;
    $age = $user->age;
    $dob = $user->dob;
    $email = $user->email;
    $contact = $user->contact;
?>