<!DOCTYPE html>
  <!-- adminhomePHP_test.php 
  author: Hannah Seabert
  Virtual EQ Room Database Project
  This is the homepage for the admin. From here the admin can perform a number of actions-->
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <!-- include bootstrap -->
    <?php include("bootstrap.php"); ?>
    <?php include_once("db_connect.php"); ?>
    
    <!-- style sheet -->
    <link rel="stylesheet" href="dashboard_style.css">

    <!-- script for dashboard utils-->
    <script type="text/javascript" src="dashboard_utils.js"></script>
</head>


<body>
	<div>
		<div class="cardTop">
			<div class="card-body">
				Admin Homepage
			</div>
			<div class="btn" style="align: right">
				<button class="logoutbtn">Log Out</button>
			</div>
		</div>
		<br>		
		<div class="search">
			<input type="text" class="searchTerm" placeholder="Item">
			<button type="submit" class="btn-search">
			<i class="fa fa-search"></i>Search
			</button>
		</div>
		
	<br/><br/>
		
			<div class="btn-group">
			<button onClick="toggleDisplay('add-athlete-field');">Register Athlete</button>
			<button onClick="toggleDisplay('issue-item-field');">Issue Equipment</button>
			<button onClick="toggleDisplay('dne');">Return Equipment</button>
			<button onClick="toggleDisplay('add-item-field');">Add Equipment</button>
            <button onClick="window.location.href='http://www.cs.gettysburg.edu/~seabha01/cs360/proj5/import.html';">Import Spreadsheet</button>
			</div>

            <!-- want to improve the styling of this later (fix dropdown, view should match)-->
            <div class="dropdown">
                <button>Manage Workers</button>
				<div>
					<a href="http://www.cs.gettysburg.edu/~seabha01/cs360/proj5/viewworker.php">View</a>
					<a href="#">Add</a>
					<a href="#">Remove</a>
				</div>
            </div>

			<div class="dropdown">
				<button>Modify</button>
				<div>
					<a href="#">User</a>
					<a href="#">Equipment</a>
					<a href="#">Locker</a>
					<a href="#">Lock</a>
                </div>
            </div>
            	
	
		<div id="main-area" class="search-results">
			<div id="welcome-content" class="card-body">
				<h1>Welcome, Admin!</h1>
            </div>
            <div id="err-content" class="card">
					<h1>Oops, something went wrong...</h1>
			</div>
            <div id="add-item-field" class="card">
                    <div class="card-body">
                        <FORM name = "fmAddEquipment" method ="POST" action="addEquipment.php">
            
                            <h1>Enter Equipment Information:</h1>
                            <INPUT type="text" name = "type" placeholder = "Enter the type of equipment"/>
                            <BR /><BR /> 
                            <INPUT type ="text" name = "eq_size" placeholder = "Enter the size"/>
                            <BR /><BR /> 
                            <INPUT type ="text" name = "color" placeholder = "Enter the color"/>
                            <BR /><BR /> 
                            <INPUT type ="text" name = "brand" placeholder = "Enter the brand"/>
                            <BR /><BR /> 
                            <INPUT type ="text" name = "model" placeholder = "Enter the model"/>
                            <BR /><BR /> 
                            <INPUT type ="number" name = "lock_num" placeholder = "Enter the locker number"/>
                            <BR /><BR /> 
                            
                            <INPUT class="submit-css" type="submit" value="Add equipment"/>
                            
                            </FORM>
                    </div>
                </div>
        
                <div id="add-athlete-field" class="card">
                    <div class="card-body">
                        <FORM name = "fmAddAthlete" method ="POST" action="addAthlete.php">
                            <h1>Enter Athlete Information:</h1>
                            <INPUT type="text" name = "sid" placeholder = "Student ID"/>
                            <BR /><BR /> 
                            <INPUT type="text" name = "fname" placeholder = "First Name"/>
                            <BR /><BR /> 
                            <INPUT type ="text" name = "lname" placeholder = "Last Name"/>
                            <BR /><BR /> 
                            <INPUT type ="text" name = "jnum" placeholder = "Jersey Number"/>
                            <BR /><BR /> 
                            <label for="class">Class year: </label>
                            <!-- want to fix this so that years are not hard coded -->
                            <select class="select-css" name="class">
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                              </select>
                            <BR /><BR /> 
                            <label for="scode">Sport code: </label>
                            <select class="select-css" name="scode">
                            <?php
                                    $qStr = "SELECT scode FROM sport;";
                                    $qRes = $db->query($qStr);
                                    
                                    if ($qRes != FALSE){
                                        while ($row = $qRes->fetch()){
                                            // access similarly to a hashtable
                                            $scode = $row['scode'];
                                
                                            // we have to construct a string to print each row (including cols) of the table
                                            $str = "<option value='$scode'>$scode</option>";
                                            print $str;
                                        }
                                    }
                                ?>
                              </select>
                            <BR /><BR /> 
                        
                            <!-- Would be better to make sport & class year dropdown ...also jersey num?-->
                            <!-- Inventory num -- auto increment? -->
                            
                            <INPUT class="submit-css" type="submit" value="Add athlete"/>
                            
                        </FORM>
                    </div>
                </div>

                <div id="issue-item-field" class="card">
                    <div class="card-body">
                        <FORM name = "fmIssueEquipment" method ="POST" action="issueEquipment.php"> <!-- <action="issueEquipment.php"> -->
            
                            <h1>Create Assignment</h1>
                            <label for="team">Select Team: </label>
                            <select class="select-css" name="selectTeam">
                            <?php
                                    $qStr = "SELECT sname FROM sport;";
                                    $qRes = $db->query($qStr);
                                    
                                    if ($qRes != FALSE){
                                        while ($row = $qRes->fetch()){
                                            // access similarly to a hashtable
                                            $sname = $row['sname'];
                                
                                            // we have to construct a string to print each row (including cols) of the table
                                            $str = "<option value='$sname'>$sname</option>";
                                            print $str;
                                        }
                                    }
                                ?> 
                            </select>
                            <BR/>
                            <label for="team">Select Type: </label>
                            <select class="select-css" name="selectEq">
                            <?php
                                    $qStr = "SELECT DISTINCT etype FROM equipment;";
                                    $qRes = $db->query($qStr);
                                    
                                    if ($qRes != FALSE){
                                        while ($row = $qRes->fetch()){
                                            // access similarly to a hashtable
                                            $etype = $row['etype'];
                                
                                            // we have to construct a string to print each row (including cols) of the table
                                            $str = "<option value='$etype'>$etype</option>";
                                            print $str;
                                        }
                                    }
                                ?>
                                
                            </select>
                            <BR/>
                            
                            <INPUT class="submit-css" type="submit" value="Next"/>
                            
                            </FORM>
                    </div>
                </div>
		</div>

	</div>
	
<br><br>

</body>
</html>