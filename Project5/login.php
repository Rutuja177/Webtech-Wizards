
<?php
//https://www.youtube.com/watch?v=b-2_Y53CTYA
session_start();
$server = "localhost";
$uname = "root";
$password = "";
$dbname = "album";
$msg="";

$pdo = new PDO("mysql:host=localhost;dbname=album","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//$connect= new PDO("mysql:host=$server;dbname=$dbname", $uname, $password);
//$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST["submit"])){
    if(empty($_POST["username"]) || empty($_POST["password"])){
        $msg = '</label>All fields are required</label>';
    }
    else{
        $sql="SELECT*FROM users WHERE username =:username AND password =:password";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(
            array(
                'username' => $_POST["username"]
                , 'password' => md5($_POST["password"])
            )
            );
            $count = $stmt->rowCount();
            if($count > 0){
                session_start();
                $username = $_POST["username"];
                $_SESSION['username'] = $username;
                header("Location: albumNew.php");
                exit();
                //$_SESSION["username"] = $_POST["username"];
                //header("location: http://localhost/project5/albumNew.php");
                
            }
            else{
                header("login unsuccessful");
                $msg = '<label>Please enter valid Username or Password.</label>';
            }

    }
    //$connect->exec($sql);
    /*session_start();
    $_SESSION['username'] = $username;
    header("Location: albumNew.php");
    exit(); */
} 
?> 
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <?php
        if(isset($msg)){
            echo '<label>'.$msg.'</label>';
        }
        ?>
        <div class="container">
        <h2>Login Here</h2>
        <p>Please enter your Username and Password to Login.</p> 
        <form action ="login.php" method= "post">
            <label for="username"><b>Username</b></label>
            <input type="text" name="username" placeholder="Enter Username">
            </br></br>
            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter Password">
            </br></br>
            <button type="submit" name = "submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-primary">Register</a>
        </form> 
        </div>
    </body>
</html>
