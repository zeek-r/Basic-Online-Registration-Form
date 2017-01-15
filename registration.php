<! Doctype HTML>
 <html>
    <head>
        <title>Team registration for Web dev competition</title>
        <meta content="width=device-width,initial-scale=1" name=viewport>
        <link rel = "stylesheet" href ="static/bootstrap.min.css">
        <script type = "text/javascript" src = "static/jquery-3.1.1.min.js"></script>
        <script type = "text/javascript" src = "static/bootstrap.min.js"></script>
    </head>

    <body background = "bg.jpg"> 
        <div class = "container-fluid">
                <center>
                    <a href ="http://aberdeen.edu.np"><img src = "index.jpeg"></a>
                    <h3>I Aberdeen Web Dev Competition Online Registration Form</h3>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#registration"><strong>Registration Form</strong></a></li>
                        <li><a data-toggle="tab" href="#registrant" onclick = "myFunction()"><strong>Registrants</strong></a></li>
                    </ul>
                </center>
                <hr />
        <div class ="tab-content">
            <div id="registration" class="tab-pane fade in active">
                <div class = "jumbotron" style ="opacity: 0.9">
                    <form id = "registration" action = "registration.php" method = "POST">
                        <div class = "form-group">
                                <small> * Can't be empty</small><br />
                                <label class = "form-control-label">Team Name*</label>
                                    <input type = "text" class = "form-control" name = "team" placeholder = "What's the name of your ship!" required><br />
                                <label class = "form-control-label">Team Leader* </label>
                                    <input type = "text" class = "form-control" name = "leader" placeholder = "Name your captain !!" required><br />
                                <label class = "form-control-label">Member 1</label>
                                    <input type = "text" class = "form-control" name = "mem1" placeholder = "I Crew Member please" ><br />
                                <label class = "form-control-label">Member 2</label>
                                    <input type = "text" class = "form-control" name = "mem2" placeholder = "II Crew Member please"><br />
                                <label class = "form-control-label">Please specify your project*</label>
                                <input type = "text" class = "form-control" name = "title" placeholder = "Please copy your project name from the list below" required><br />
                                <center>
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Project list</button>
                                    <button type="submit" class="btn btn-info btn-lg" onclick="myFunction()">Submit</button>
                                </center>
                                <hr />
                            </div>
                        </form> 
                    </div>
                </div>

            <div id="registrant" class="tab-pane fade">
                <div class = "jumbotron" style ="opacity:0.7">
                    <center>
                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "root";
                            $dbname = "registrants";

                            // Create connection
                            $conn = mysqli_connect($servername, $username, $password, $dbname);                  
                            $sql = "SELECT * from student_info";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                echo"<table class='table-condensed'>";
                                echo"<tr><th>Team Name</th><th>Leader</th><th>Member 1</th><th>Member 2</th><th>Title</th></tr><br />";
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo"<tr><td>".$row['team_name']."</td><td>".$row['Leader']."</td><td>".$row['Member1']."</td><td>".$row['Member2']."</td><td>".$row['Title']."</td></tr>";
                                    echo"<br />";
                                }
                                echo"</table>";
                            } 
                            else {
                                echo "<script type='text/javascript'> alert('There are no registrants till now')</script>";   
                            }
                            mysqli_close($conn);
                        ?>
                    </center>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Project Titles</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                                $file = fopen("project.csv", "r");
                                while(!feof($file))
                                {
                                    echo fgets($file). "<br />";
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
        </div>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $team_name = $_POST["team"];
        $leader = $_POST["leader"];
        $member1 = $_POST["mem1"];
        $member2 = $_POST["mem2"];
        $title = $_POST["title"];

        $servername = "localhost";
		$username = "root";
		$password = "root";
        $dbname = "registrants";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "INSERT INTO student_info (team_name, Leader, Member1, Member2, Title ) VALUES ('$team_name', '$leader', '$member1', '$member2', '$title')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'> alert('Submitted Successfully!')</script>";
        } 
        else {
            echo "<script type='text/javascript'> alert('Some of the values in your table are duplicate, Please check registrants')</script>";
        }
        mysqli_close($conn);
    }
?>
<script>
function myFunction() {
    $("#registrant").load(location.href + " #registrant>*", "");
}
</script>
    </body>
</html>