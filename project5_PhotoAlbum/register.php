<?php
$server = "localhost";
$uname = "root";
$password = "";
$dbname = "album";
//create connection
//$connect= new PDO("mysql:host=$server;dbname=$dbname", $uname, $password);
//$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = new PDO("mysql:host=localhost;dbname=album","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $sql= "SELECT* FROM users where username =:username";
    $sqlQuery = $pdo->prepare($sql);
    $param=[':username'=>$username];
    $sqlQuery->execute($param);
    if($sqlQuery->rowCount()==0){

        $password = md5($_POST['password']);
        $fullName = $_POST['fullname'];
        $email = $_POST['email'];
        $tmpname = './images/'.$username;
        mkdir("./images/".$username, 0700);
        //$tempnam("C:/xampp/htdocs/project5/images", "TEMP"); 
        $sql = "INSERT INTO users (username, password, fullname, email, image_dir) 
            VALUES ('$username','$password','$fullName','$email','$tmpname')";
        $pdo->exec($sql);
        //header("location:http://localhost/project5/albumNew.php");
        session_start();
        $username = $_POST["username"];
        $_SESSION['username'] = $username;
        header("Location: http://localhost/project5/albumNew.php");
        exit();
    }else {
        header("Location: http://localhost/project5/register.php");
    }

}


?>
<html>
    <head>
        <title>Regsitration Page</title>
    </head>
    <style>
    </style>
    <body>
        <h2>Register Here!<h2>
            <form action="register.php" method="post">
                <div class="container">
                    <label for="username">Username</label>
                    <input type="text" name = "username" placeholder="Enter Username" ></input>
                    </br></br>                  
                    <label for="password">Password</label>
                    <input type="password" name = "password" placeholder="Password"></input>
                    </br></br>
                    <label for="fullName">Full Name</label>
                    <input type="text" name = "fullname" placeholder="Full Name"></input>
                    </br></br>
                    <label for="Email">Email</lable>
                    <input type="text" name="email" placeholder="email"></input>
                    </br></br>
                    <button type="submit" name="submit">Register</button>

                </div>
    </body>
</html>
