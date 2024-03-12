<?php


//DB connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zarfinco";

//include ("connect.php");

//Connection
$conn = new mysqli($servername, $username, $password, $dbname);
//$conn = new mysqli('localhost', 'root','', 'zarfinco');

session_start();

//check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];

//Sanitize user input to avoid sql injection
// $sanitized_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
// $sanitized_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

//validate
// $sanitized_username = validate($_POST['sanitized_username']);
// $sanitized_password = validate($_POST['sanitized_password']);

if (empty($username)){
    header("Location: index.php?error=Enter the username");
    //exit();
}else if (empty($password)){
    header("Location: index.php?error=Enter the password");
    //exit();
}else {

//Prepare a secured sql statement 
$sql = "SELECT *  FROM register WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if($result== TRUE) {
    $row = mysqli_fetch_assoc($result);

    if( $row['username'] === $username AND $row['password'] === $password) {
        echo 'You have successfully logged in!';
        
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];

         header("Location: home.html");
        // exit();
    }else {
        header("Location: index.php?error=Incorrect Username or password");
        //exit();
    }
}else {
    header("Location: index.php?error=Database Error");
    //exit();
}

}
//Prepare a secured sql statement 
//$sql = "SELECT * FROM register WHERE username = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("s", $sanitized_username);
//$stmt->execute();
//$result = $stmt->get_result();

//validate details
// if($result->num_rows > 0){
//     $row = $result->fetch_assoc();

//     if(password_verify($sanitized_password, $row['password'])) {
        
//         //start a session and redirect to home page.
//         session_start();
//         $_SESSION['logged_in'] = true;
//         $_SESSION['username'] = $row['username'];
//         header('Location: home.html');
        
//     }else{
//         echo 'Invalid credentials!';
//     }

// }else{
//     echo 'Invalid credentials!';
// }

//$stmt->close();
$conn->close();

?>