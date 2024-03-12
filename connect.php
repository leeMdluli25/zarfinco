<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    

    //Database connection
    $conn = new mysqli('localhost', 'root','', 'zarfinco');

    //Retrieve info from database
    

    //Check connection
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error );
    }else{
        $stmt = $conn->prepare("INSERT INTO register(firstname, lastname, username, email, password)
                values(?,?,?,?,?)");
        $stmt->bind_param("sssss",$firstname, $lastname, $username, $email, $password);
        $stmt->execute();
        echo "You have successfully registered...";
        $stmt->close();
        $conn->close();
    }

   /* session_start();
    if(!session_is_registered(username)){
        header("logIn.html");
    }*/
?>