<?php
session_start();
if (!isset($_SESSION["UserId"])) {
    header('Location:index.php');
}
//if(isset ($_SESSION["Type"])=="banned"){
//    echo '<script type="text/javascript">';
//    echo ' alert("You have been banned")';  //not showing an alert box.
//    echo '</script>';
//    header('Location:home.php');
//}
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
    <link href="css/home.css" rel="stylesheet">

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
<!--Table-->
<table class="table table-striped w-min" style="width: auto; margin: auto">

    <!--Table head-->
    <thead id="theader">
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody id="tbodyy">
    </tbody>
    <!--Table body-->
</table>
<!--Table-->
<!-- Button trigger modal -->


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
    $(document).ready(function(){
            if("<?php echo $_SESSION["Type"]?>"=="boss" || "<?php echo $_SESSION["Type"]?>"=="manager"){
                $.ajax({
                    url:"../api/task/read.php",
                    dataType:"JSON",
                    success:function(data)
                    {
                        $('#theader').append($('<tr>')
                            .append($('<th>').append("#"))
                            .append($('<th>').append("Name"))
                            .append($('<th>').append("Description"))
                            .append($('<th>').append("Worker"))
                            .append($('<th>').append("Status"))
                            .append($('<th>').append("Time"))
                            .append($('<th>').append($('<select onselect="hoho(this);"class="form-control" id="statusSelect">').append('<option value="all">all</option><option value="1">Completed</option><option value="2">In progress</option><option value="3">Canceled</option>')))
                        );
                        $( "#statusSelect" ).change(function() {
                            var selected = $("#statusSelect").val();
                            if(selected=="all"){
                                $('#tbodyy').empty();
                                $.ajax({
                                    url:"../api/task/read.php",
                                    data:{id:selected},
                                    dataType:"JSON",
                                    success:function(data)
                                    {
                                        $('#tbodyy').empty();
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            $('#tbodyy').append($('<tr>')
                                                .append($('<td>').append(data[i].TaskId))
                                                .append($('<td>').append(data[i].Name))
                                                .append($('<td style="word-wrap: break-word;max-width: 400px;">').append(data[i].Description))
                                                .append($('<td>').append(data[i].Worker))
                                                .append($('<td>').append(data[i].Status))
                                                .append($('<td>').append(data[i].Time))
                                                .append($('<td>').append('<a href="taskDetails.php?id='+data[i].TaskId+'"><button type="button" class="btn peach-gradient">Details</button></a>'))
                                            )
                                        }
                                    },error:function (request) {
                                        console.log(request.responseText);
                                    }
                                })
                            }else{
                                $.ajax({
                                    url:"../api/task/readByStatus.php",
                                    data:{id:selected},
                                    dataType:"JSON",
                                    success:function(data)
                                    {
                                        $('#tbodyy').empty();
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            $('#tbodyy').append($('<tr>')
                                                .append($('<td>').append(data[i].TaskId))
                                                .append($('<td>').append(data[i].Name))
                                                .append($('<td style="word-wrap: break-word;max-width: 400px;">').append(data[i].Description))
                                                .append($('<td>').append(data[i].Worker))
                                                .append($('<td>').append(data[i].Status))
                                                .append($('<td>').append(data[i].Time))
                                                .append($('<td>').append('<a href="taskDetails.php?id='+data[i].TaskId+'"><button type="button" class="btn peach-gradient">Details</button></a>'))
                                            )
                                        }
                                    },error:function (request) {
                                        console.log(request.responseText);
                                    }
                                })
                            }
                        });
                        var i;
                        for (i = 0; i < data.length; i++) {
                            $('#tbodyy').append($('<tr>')
                                .append($('<td>').append(data[i].TaskId))
                                .append($('<td>').append(data[i].Name))
                                .append($('<td style="word-wrap: break-word;max-width: 400px;">').append(data[i].Description))
                                .append($('<td>').append(data[i].Worker))
                                .append($('<td>').append(data[i].Status))
                                .append($('<td>').append(data[i].Time))
                                .append($('<td>').append('<a href="taskDetails.php?id='+data[i].TaskId+'"><button type="button" class="btn peach-gradient">Details</button></a>'))
                            )
                        }
                    },error:function (request) {
                        console.log(request.responseText);
                    }
                })
            }else{
                $.ajax({
                    url:"../api/task/readByUser.php",
                    data:{id:"<?php echo $_SESSION["UserId"]?>"},
                    dataType:"JSON",
                    success:function(data)
                    {
                        $('#theader').append($('<tr>')
                            .append($('<th>').append("#"))
                            .append($('<th>').append("Name"))
                            .append($('<th>').append("Description"))
                            .append($('<th>').append("Status"))
                            .append($('<th>').append("Time"))
                            .append($('<th>').append($('<select class="form-control" id="statusSelect">').append('<option value="all">all</option><option value="1">Completed</option><option value="2">In progress</option><option value="3">Canceled</option>')))
                        );
                        var j;
                        for (j = 0; j < data.length; j++) {
                            $('#tbodyy').append($('<tr>')
                                .append($('<td>').append(data[j].TaskId))
                                .append($('<td>').append(data[j].Name))
                                .append($('<td style="word-wrap: break-word;max-width: 400px;">').append(data[j].Description))
                                .append($('<td>').append(data[j].Status))
                                .append($('<td>').append(data[j].Time))
                                .append($('<td>').append('<a href="taskDetails.php?id='+data[j].TaskId+'"><button type="button" class="btn peach-gradient">Details</button></a>'))
                            )
                        }
                        $( "#statusSelect" ).change(function() {
                            var selected = $("#statusSelect").val();
                            if(selected=="all"){
                                $('#tbodyy').empty();
                                $.ajax({
                                    url:"../api/task/readByUser.php",
                                    data:{id:"<?php echo $_SESSION["UserId"]?>"},
                                    dataType:"JSON",
                                    success:function(data)
                                    {
                                        var j;
                                        for (j = 0; j < data.length; j++) {
                                                $('#tbodyy').append($('<tr>')
                                                    .append($('<td>').append(data[j].TaskId))
                                                    .append($('<td>').append(data[j].Name))
                                                    .append($('<td style="word-wrap: break-word;max-width: 400px;">').append(data[j].Description))
                                                    .append($('<td>').append(data[j].Status))
                                                    .append($('<td>').append(data[j].Time))
                                                    .append($('<td>').append('<a href="taskDetails.php?id='+data[j].TaskId+'"><button type="button" class="btn peach-gradient">Details</button></a>'))
                                                )
                                        }
                                    },error:function (request) {
                                        console.log(request.responseText);
                                    }
                                })
                            }else{
                                $.ajax({
                                    url:"../api/task/readByStatus.php",
                                    data:{id:selected},
                                    dataType:"JSON",
                                    success:function(data)
                                    {
                                        $('#tbodyy').empty();
                                        var j;
                                        for (j = 0; j < data.length; j++) {
                                            if(data[j].WorkerId=="<?php echo $_SESSION["UserId"]?>"){
                                            $('#tbodyy').append($('<tr>')
                                                .append($('<td>').append(data[j].TaskId))
                                                .append($('<td>').append(data[j].Name))
                                                .append($('<td style="word-wrap: break-word;max-width: 400px;">').append(data[j].Description))
                                                .append($('<td>').append(data[j].Status))
                                                .append($('<td>').append(data[j].Time))
                                                .append($('<td>').append('<a href="taskDetails.php?id='+data[j].TaskId+'"><button type="button" class="btn peach-gradient">Details</button></a>'))
                                            )
                                            }
                                        }
                                    },error:function (request) {
                                        console.log(request.responseText);
                                    }
                                })
                            }
                        });
                    },error:function (request) {
                        console.log(request.responseText);
                    }
                })
            }
    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="jquery-3.4.1.js"></script>
</body>
</html>