<?php
session_start();
include('../config/connection.php');

$upit = "SELECT * FROM users WHERE id=".$_SESSION['UserId'];
$execute = $con->query($upit);
$row = $execute->fetch_assoc();
$username=$row['username'];
$password=$row['password'];

$check=true;
if (isset($_POST['submit'])) {
    if(!empty($_POST['name'])){
        if(strlen($_POST['name'])>4) {
            $name = $_POST['name'];
        }else{
            $check = false;
        }
    }else{
        $check = false;
    }
    if(!empty($_POST['password'])){
        if(strlen($_POST['password'])>4) {
            $pass = $_POST['password'];
        }else{
            $check = false;
        }
    }else{
        $check = false;
    }
    if($check){
        $upit = 'UPDATE users SET username="'.$name.'",password="'.$pass.'" WHERE id='.$_SESSION['UserId'];
        $execute = $con->query($upit);
        header('Location:home.php');
    }
}
if (!isset($_SESSION["UserId"])) {
    header('Location:index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>    <title>Task Org</title>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <link href="css/submitBtn.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #e3a529;">
    <a class="navbar-brand" href="home.php" style="margin-top: 10px">Task Org</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">

        </ul>
        <form class="form-inline my-2 my-md-0">
            <ul class="navbar-nav mr-auto" >
                <li class="nav-item dropdown" style="margin-right: 35px;: ">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 10px; font-size: large"><?php echo $_SESSION["Username"]?></a>
                    <div class="dropdown-menu"  aria-labelledby="dropdown04">
                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="#">Log out</a>
                        <a class="dropdown-item" href="userSettings.php">Settings</a>
                        <?php
                        if($_SESSION["Type"]=="boss" || $_SESSION["Type"]=="manager"){
                            echo '<a class="dropdown-item" href="createTask.php">Create Task</a>';
                        }
                        if($_SESSION["Type"]=="boss") {
                            echo '<a class="dropdown-item" href="manage.php">Manage</a>';
                        }
                        ?>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Log out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-primary" style="background-color: #e3a529;     border-color: #e3b829;">Log out</a>
            </div>
        </div>
    </div>
</div>
<div class="text-center col-xs-12 col-sm-10 col-md-6" style="margin: auto; padding: 20px">
    <!-- Material form contact -->
    <div class="card">

        <h5 class="card-header info-color white-text text-center py-4" style="background-color: #fcb628">
            <strong>Settings</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
            <!-- Form -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="text-center" style="color: #757575;">
                <!-- Name -->
                <div class="md-form mt-3">
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $username?>">
                    <label for="name">Username</label>
                </div>
                <!-- E-mail -->
                <div class="md-form">
                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $password?>"><input id="pass" value="?" type="button" onclick="passChange()">
                    <label for="password">Password</label>
                </div>
                <!-- Send button -->
                <button id="create" class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" disabled name="submit" type="submit">Save settings</button>
            </form>
            <!-- Form -->

        </div>
    </div>
    <!-- Material form contact -->
</div>
<script>
    $(document).ready(function(){
        $("#name").on('input', function() {
            var nameLng = $("#name").val().length;
            if(nameLng>3){
                $( "#create" ).prop( "disabled", false );
            }else{
                $( "#create" ).prop( "disabled", true );
            }
            var passLng = $("#password").val().length;
            if(passLng>3){
                $( "#create" ).prop( "disabled", false );
            }else{
                $( "#create" ).prop( "disabled", true );
            }
        });
        $("#password").on('input', function() {
            var nameLng = $("#name").val().length;
            if(nameLng>3){
                $( "#create" ).prop( "disabled", false );
            }else{
                $( "#create" ).prop( "disabled", true );
            }
            var passLng = $("#password").val().length;
            if(passLng>3){
                $( "#create" ).prop( "disabled", false );
            }else{
                $( "#create" ).prop( "disabled", true );
            }
        });
    });
    function passChange() {
        if(document.getElementById("password").type=="password"){
            document.getElementById("password").type="text";
        }else{
            document.getElementById("password").type="password";
        }
    }
</script>
<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="jquery-3.4.1.js"></script>
</body>