<DOCTYPE html>
<HTML>
<HEAD>
<TITLE>Add Equipment</TITLE>
    <!-- include bootstrap -->
    <?php include("bootstrap.php"); ?>
    <!-- style sheet -->
    <link rel="stylesheet" href="dashboard_style.css">

<HEAD>

<BODY>
    <?php 

    include_once("db_connect.php");

    $team=$_POST['selectTeam'];
    $type=$_POST['selectEq'];

    ?>
    <div>
        <div class="cardTop">
			<div class="card-body">
				Assign Equipment
			</div>
			<div class="btn" style="align: right">
				<button class="logoutbtn">Log Out</button>
            </div>
            <div class="btn" style="align: right">
				<button class="logoutbtn" onClick="window.location.href='http://www.cs.gettysburg.edu/~seabha01/cs360/proj5/adminhomePHP_test.php';">Back</button>
			</div>
		</div>
        <br>
        
        <div id="main-area" class="search-results">
        <?php
            // connect to db
            include_once("db_connect.php");

            // get all values from $_POST
            $sid=$_POST['sid'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $class=$_POST['class'];
            $scode=$_POST['scode'];
            $jnum=$_POST['jnum'];

            //generate the query
            $query="INSERT INTO athlete(id, fname, lname, class, scode, jnum) VALUES('$sid', '$fname', '$lname', '$class', '$scode', '$jnum');";

            // query the db
            $result=$db->query($query);

            if($result != FALSE)
            {
              print "<h3>You're all set. $fname was successfully registered.</h3>";
            }
            else{
              print "<h3>Oops...something went wrong. Please try again.</h3>";
            }
          ?>
        </div>

    </div>

</BODY>

</HTML>