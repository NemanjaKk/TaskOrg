<?php
session_start();
include('../config/connection.php');
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $upit = "UPDATE tasks SET status=1 WHERE id=" . $id;
    $execute = $con->query($upit);
    header('Location:taskDetails.php?id='.$id);
}
if(isset($_POST['submitCancel'])){
    $id = $_POST['id'];
    $upit = "UPDATE tasks SET status=3 WHERE id=" . $id;
    $execute = $con->query($upit);
    header('Location:taskDetails.php?id='.$id);
}
if(!isset($_SESSION["UserId"])){
    header('Location:index.php');
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
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
                            echo '<a class="dropdown-item" href="manage.php">Manage</a>';
                            echo '<a class="dropdown-item" href="createTask.php">Create Task</a>';
                        }
                        ?>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</nav>
<div id="map" style="height: 500px; width: 100%"></div>
<script>
    function initMap() {
        $.ajax({
            url:"../api/task/readById.php",
            data:{id:"<?php echo $id?>"},
            dataType:"JSON",
            success:function(data)
            {
                var lat = parseFloat(data[0].Longitude);
                var lng = parseFloat(data[0].Latitude);

                var location = {lat: lat, lng: lng};
                var map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 13,
                    center: location
                });
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            },error:function (request) {
                console.log(request.responseText);
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLzQoOVRRtV-lZ2pyxgWZrhawiPRSXhII&callback=initMap"
        type="text/javascript"></script>
<div class="text-center" style="width: 70%; margin: auto; padding: 20px">
    <h1 id="title"></h1>
    <div id="status"></div>
    <div id="description" class="card col-xs-12 col-md-8" style="width: 100%;margin: auto">
    </div>
    <br><br>
    <h2>Deadline:</h2>
    <div id="deadline" class="card" style="margin: auto;width: 200px;padding: 12px">
    </div>
</div>
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
<script>
    $(document).ready(function () {
        $.ajax({
            url:"../api/task/readById.php",
            data:{id:"<?php echo $id?>"},
            dataType:"JSON",
            success:function(data)
            {
                $("#title").text(data[0].Name);
                if(data[0].Status=="Completed"){
                    $("#status").append("<h3 style='color: darkgreen'>"+data[0].Status+"</h3>");
                }else if(data[0].Status=="In Progress"){
                    $("#status").append("<h3 style='color: darkorange'>"+data[0].Status+"</h3>");
                    $("#status").append("<form method='post' action='taskDetails.php'><input type='hidden' name='id' value='"+data[0].TaskId+"'><a id='completeTask'><input type='submit' class='btn btn-primary' style='background-color:#e3a529;border-color:#e3b829;' name='submit' value='Complete Task'></form></a><br>");
                    if("<?php echo $_SESSION["Type"]?>"=="boss" || "<?php echo $_SESSION["Type"]?>"=="manager"){
                        $("#status").append("<form method='post' action='taskDetails.php'><input type='hidden' name='id' value='"+data[0].TaskId+"'><a id='cancelTask'><input type='submit' class='btn btn-primary' style='background-color:#e3a529;border-color:#e3b829;' name='submitCancel' value='Cancel Task'></form></a><br><br>");
                    }
                }else if(data[0].Status=="Canceled"){
                    $("#status").append("<h3 style='color: darkred'>"+data[0].Status+"</h3>");
                }
                $("#description").text(data[0].Description);
                $("#deadline").text(data[0].Time);
            },error:function (request) {
                console.log(request.responseText);
            }
        });
    });
</script>
<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="jquery-3.4.1.js"></script>
</body>
</html>
