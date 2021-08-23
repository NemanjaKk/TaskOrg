<?php
session_start();
include('../config/connection.php');
if(isset($_SESSION["UserId"])){
    header('Location:home.php');
}
$usernameErr =$username=$password= $passwordErr = "";
$check = true;

if (isset($_POST['submit'])) {
    if(!empty($_POST['username'])){
        if(strlen($_POST['username'])<=20) {
            $username = $_POST['username'];
        }else{
            $usernameErr = "Username is too long";
            $check = false;
        }
    }else{
        $usernameErr = "Username is empty";
        $check = false;
    }
    if(!empty($_POST['password'])){
        if(strlen($_POST['password'])<=20) {
            $password = $_POST['password'];
        }else{
            $passwordErr = "Password is too long";
            $check = false;
        }
    }else{
        $passwordErr = "Password is empty";
        $check = false;
    }
    if($check) {

        $check1=true;
        $upit = "SELECT username FROM users";
        $execute = $con->query($upit);
        while ($row1 = $execute->fetch_assoc()){
            if (strtolower($username) == strtolower($row1['username'])){
                $check1=false;
                $usernameErr="User with that name already exists.";
                break;
            }
        }
        if ($check1) {
            $sql = "INSERT INTO users(id, username, password, type) VALUES (NULL,'" . $username . "','" . $password . "',2)";
            $execute = $con->query($sql);

            $upit = 'SELECT u.id AS UserId, u.username AS Username, u.password AS Password, t.name AS Type FROM users u,usertype t WHERE t.id=u.type AND u.username='.'"'.$username.'"';
            $execute = $con->query($upit);
            $row2 = $execute->fetch_assoc();
            $_SESSION["Username"] = $username;
            $_SESSION["Type"] = $row2['Type'];
            $_SESSION["UserId"] = $row2['UserId'];
            header('Location:home.php');

        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Task Org</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Icon -->
        <div class="fadeIn first">
            <img src="img/login-icon.png" id="icon" alt="User Icon" />
        </div>
        <!-- Login Form -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
            <br>
            <span style="color: red;"><?php echo $usernameErr?></span>
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <br>
            <span style="color: red;"><?php echo $passwordErr?></span>
            <br>
            <input type="submit" name="submit" disabled class="fadeIn fourth" value="Register" id="login">
        </form>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="login.php">Already registered? Login in!</a>
        </div>

    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#username').on('input',function(e){
            var user = $('#username').val();
            if(user.length >= 4){
                $( "#login" ).prop( "disabled", false );
            }else{
                $( "#login" ).prop( "disabled", true );
            }
        });
    });
</script>
