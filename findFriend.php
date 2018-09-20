<?php
		$request=false;
		$result="";
		$count=0;
	    session_start();
        include('connection.php');
        if($_SERVER["REQUEST_METHOD"] == "POST") {
              // username and password sent from form 
              
              $year = $_POST['year']; 
              $branch = $_POST['branch'];
              if($branch=="All")
              {
              	$sql = "SELECT email,first_name,last_name,fb_id FROM user WHERE graduation_year = '$year'";
                $result = mysqli_query($dbc,$sql);
        		    $count = mysqli_num_rows($result);     
              }
              else
              {
                $sql = "SELECT email,first_name,last_name,fb_id FROM user WHERE graduation_year = '$year' and department = '$branch'";
                $result = mysqli_query($dbc,$sql);
        		$count = mysqli_num_rows($result);        
              }
           }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Find friends</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
  <script>
  window.onload=function(){
     var min = 2012;
            var d = new Date();
            max = d.getFullYear();
            for (var i = min; i<=max; i++){
               var opt = document.createElement('option');
               opt.value = i;
               opt.innerHTML = i;
                console.log(document.getElementById('passYear'));
               document.getElementById('passYear').appendChild(opt);
                };
  }
</script>
<style>
    body{
    background-color: #fff;
}
.bg-color{
    background-color:#363636;
}
.navbar-dark .navbar-nav .nav-link{
    color:#fff;
}

.pad-1{
    padding: 10px;
    padding-top: 0px;
    padding-bottom: 0px;
}
.mar-top{
    margin-top: 65px;
}

.navigation{
    width: 100%;
    background-color: #CF6F3F;
    padding-top: 10px;
}
.pad-5{
    padding: 0px !important;
}
    </style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-color fixed-top pad-5">
      <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="asset/img/logo-iitp.png" width="50" height="auto" alt=""> Student Asssociation for Alumni Relations
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto navbar-right">
              <li class="nav-item">
                  <a class="nav-link active active1" href="index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="portal.php">Portal</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            
          </ul>
            
        </div>
      </div>
    </nav>
    <div class="container" style="margin-top: 125px;">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form method="post" action="">
                    <div class="jumbotron">
                        <center><h3><b>Find Friends</b></h3></center>
                        <div class="form-group">
                            <select class="custom-select" id="passYear" name="year">
                                <option value="" selected disabled hidden>Graduation Year</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="custom-select" id="branch" name="branch">
                               <option value="" selected disabled >Department</option>
                                <option value="All">All</option>
                                <option value="CSE">Computer Science and Engineering</option>
                                <option value="EE">Electrical Engineering</option>
                                <option value="ME">Mechanical Engineering</option>
                                <option value="CE">Civil Engineering</option>
                                <option value="CBE">Chemical and Biochemical Engineering</option> 
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--
    <form method="post" action="">  
    year of pass out:-
    <select id="passYear" name="year" >
            <option value="" selected disabled hidden>Graduation Year</option>
        </select>
     branch:-
      <select id="branch" name="branch" >
        <option value="" selected disabled >Department</option>
        <option value="All">All</option>
        <option value="CSE">Computer Science and Engineering</option>
        <option value="EE">Electrical Engineering</option>
        <option value="ME">Mechanical Engineering</option>
        <option value="CE">Civil Engineering</option>
        <option value="CBE">Chemical and Biochemical Engineering</option>
    </select>
    <input type="submit">
    </form>-->
    <?php 
    if($count!=0)
    {
    	echo '<table style="width:100%" border="1"> <tr><th>name</th><th>email</th> <th>FB</th></tr>';
    }
    while($count!=0 && $row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
    	echo '<tr><td>'.$row['first_name']." ".$row['last_name'].'</td><td>'.$row['email'].'</th> <th>'.$row['fb_id'].'</th></tr>';
    }
    if($count!=0)
    {
    	echo '</table>';
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>