
<style>
h2 
{
	margin-top:40px; 
}
</style>

<script>
function sub() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","subselect.php?sub="+document.getElementById("sn").value,false);
  xmlhttp.send(null);
  document.getElementById("sc").innerHTML = xmlhttp.responseText;
}
</script>


<?php
session_start();
if(!isset($_SESSION["librarian"]))
{
	?>
	<script type="text/javascript">
	window.location="login.php";
	</script>
	<?php
	
}
include('connection.php');
include('header.php');
error_reporting(0);
?>
        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3></h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">                         
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h1 style="color:black; text-align:center;">Generate Question Paper</h1> <br>
								<h4 style="color:black; width:100%; padding:10px; font-family:archivo;"> <b>NOTE:</b>
								<ul><li>By refering to the below table, you can select the questions based on the difficulty level.</li>
								 								</ul>
								</h4>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content"><br>
                                <form name = "form1" action='generate_question_paper.php' method="post">
									<table style="padding:10px">
										<tr>
											<td>
												<select id="sname" class="form-control selectpicker" name="sname" onChange="sub()">
                                				<option value="">select subject</option>
													<?php
													$query="SELECT distinct sname from assign_subject";
													$s=mysqli_query($con,$query);
													while($row=mysqli_fetch_array($s))
													{
														?>
														<option value='<?php echo $row["sname"];?>'>
    		                                			<?php echo $row["sname"];?>
            		                        			</option>
                    		                			<?php
													}
													?>								
												</select>
											</td>
    										<td><div id="sc"><input type="text" value="" name="scode" class="form-control" autocomplete="off" placeholder="Subject Code" style="border-radius:10px;  margin-left:10px;" size="7" disabled></div></td>
        									
											<td> <select name="marks" style="margin-left:20px;" class="form-control selectpicker" id="mks" onchange="handleMarksSelection()">
        <option value="" disabled selected>select Marks</option>
        <option value="20">20</option>
        <option value="40">40</option>
    </select>
											</td>
<script>
function handleMarksSelection() {
    var marks = document.getElementById("mks").value;
   // Show/hide dropdowns and labels for 20 marks
if (marks == "20") {
    // Show the first three questions and their corresponding difficulty dropdowns
    document.getElementById("que1_unit").style.visibility = "visible";
    document.getElementById("diff1").style.visibility = "visible";
    document.getElementById("que2_unit").style.visibility = "visible";
    document.getElementById("diff2").style.visibility = "visible";
    document.getElementById("que3_unit").style.visibility = "visible";
    document.getElementById("diff3").style.visibility = "visible";
    // Hide the fourth question and its corresponding difficulty dropdown
    document.getElementById("que4_unit").style.visibility = "hidden";
    document.getElementById("diff4").style.visibility = "hidden";
  document.getElementById("que4").style.visibility = "hidden";
document.getElementById("q4").style.visibility = "hidden";
  document.getElementById("qu4").style.visibility = "hidden";


} else if (marks == "40") {
    // Show all four questions and their corresponding difficulty dropdowns
    document.getElementById("que1_unit").style.visibility = "visible";
    document.getElementById("diff1").style.visibility = "visible";
    document.getElementById("que2_unit").style.visibility = "visible";
    document.getElementById("diff2").style.visibility = "visible";
    document.getElementById("que3_unit").style.visibility = "visible";
    document.getElementById("diff3").style.visibility = "visible";
    document.getElementById("que4_unit").style.visibility = "visible";
    document.getElementById("diff4").style.visibility = "visible";
  document.getElementById("que4").style.visibility = "visible";
document.getElementById("q4").style.visibility = "visible";
  document.getElementById("qu4").style.visibility = "visible";

  
}

}
</script>
  <tr style="padding:15px"><td style="padding:15px">      

<label for="que1">Question 1:</label><br>
<label for="que1">Unit:</label><br>

<select id="que1_unit" name="que1_unit">
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qpgs";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve selected course name from form
    $cn = $_POST['sname'];

    // Prepare SQL query to fetch units based on selected course
    $sql = "SELECT * FROM units ";
//WHERE subject_id IN (SELECT scode FROM question WHERE sname='$cn')";

    // Execute query
    $result = $conn->query($sql);

    // Check if query executed successfully
    if ($result === false) {
        // Print error message if query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        // If units found, populate dropdown
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["unit_name"] . "'>" . $row["unit_name"] . "</option>";
            }
        } else {
            // Inform user if no units found for the selected course
            echo "<option value=''>No units found for the selected course</option>";
        }
    }

    // Close database connection
    $conn->close();
    ?>
</select>

</select>
</select><br>
 <label style = "padding-top:10px" for="que1">Difficulty Level:</label><br>

                    <select id="diff1" name="diff1">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
  </div>
</td>
<td style="padding:10px>
<div>
<label for="que2">Question 2:</label><br>
<label for="que2">Unit:</label>

<select id="que2_unit" name="que2_unit">
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qpgs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM units ";
//WHERE cou_id = (SELECT unit FROM question WHERE sname='$cn')";

// Debug: Print SQL query for verification
echo "SQL Query: $sql <br>";

// Execute query
$result = $conn->query($sql);

// Check if query executed successfully
if ($result === false) {
    // Debug: Print error message if query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    // Debug: Print number of rows retrieved from the query
    echo "Number of rows: " . $result->num_rows . "<br>";
    
    // If units found, populate dropdown
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["unit_name"] . "'>" . $row["unit_name"] . "</option>";
        }
    } else {
        echo "No units found for the selected course.";
    }
//}
}
?>
</select>
</select><br>
<label for="que2" style="padding-top:10px">Difficulty Level</label><br>

                    <select id="diff2" name="diff2">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
  </div>
</td>
<td>
<div>
<label for="que1">Question 3:</label><br>
<label for="que2" ">Unit:</label>


<select id="que3_unit" name="que3_unit">
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qpgs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM units ";
//WHERE cou_id = (SELECT unit FROM question WHERE sname='$cn')";

// Debug: Print SQL query for verification
echo "SQL Query: $sql <br>";

// Execute query
$result = $conn->query($sql);

// Check if query executed successfully
if ($result === false) {
    // Debug: Print error message if query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    // Debug: Print number of rows retrieved from the query
    echo "Number of rows: " . $result->num_rows . "<br>";
    
    // If units found, populate dropdown
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["unit_name"] . "'>" . $row["unit_name"] . "</option>";
        }
    } else {
        echo "No units found for the selected course.";
    }
//}
}
?>

</select>
</select>
<br>
<label for="que2" style="padding-top:10px">Difficulty Level:</label>
<br>

                    <select id="diff3" name="diff3">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
  </div>
</td>

<td>
<div>
<label id="que4">Question 4:</label><br>
<label id="qu4" ">Unit:</label>


<select id="que4_unit" name="que4_unit">
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qpgs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM units ";
//WHERE cou_id = (SELECT unit FROM question WHERE sname='$cn')";

// Debug: Print SQL query for verification
echo "SQL Query: $sql <br>";

// Execute query
$result = $conn->query($sql);

// Check if query executed successfully
if ($result === false) {
    // Debug: Print error message if query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    // Debug: Print number of rows retrieved from the query
    echo "Number of rows: " . $result->num_rows . "<br>";
    
    // If units found, populate dropdown
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["unit_name"] . "'>" . $row["unit_name"] . "</option>";
        }
    } else {
        echo "No units found for the selected course.";
    }
//}
}
?>
</select>
</select>
<br>
<label id="q4" style="padding-top:10px">Difficulty Level:</label>
<br>

                    <select id="diff4" name="diff4">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
  
</td>
<tr>
<td>
 <label for="instructions">Instructions:</label>
    <input type="text" id="instructions" name="instructions" required>
</td>
</tr>

<tr>
<td>
    <label for="time">Time (in minutes):</label>
    <input type="number" id="time" name="time" min="1" required>
</td>
</tr>

</div>
</div>
											
	</tr>										<td><button  type="submit" name="submit1" style="border:none; display: inline-block; margin-left:40px; margin-top:5px; border-radius:30px;"> 
												<img src="images/search.png" height="33px" width="50px" style="border-radius:10px; display: block;"></button></td>
										</tr>
									</table>
								</form>
							
								<form action='generate_question_paper.php' method='post'>
								<?php
								if(isset($_POST["submit1"]))
								{	
									?>										
										<h2 style='color:black;'>Module 1 </h2>
										<input type="hidden" value="<?php echo $_POST['subject']?>" name="subject">
										<input type="hidden" value="<?php echo $_POST['marks']?>" name="marks">
										<table>
										<tr>
										<td>
										<select type="text" id="myNumber1a" style="margin-left:10px;  color:black;" onChange="difficulty1a()">
										<option> section 1 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select>
										
									<?php
								}
								?>
								<?php
								if(isset($_POST["submit1"]))
								{	
									?>
										<select type="text" id="myNumber1b" style="margin-left:100px; margin-top:-30px; color:black;" onChange="difficulty1b()">
										<option> section 2</option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select> </td>
										
										
										<td>
										<table border='1' style='color:black; margin-left:250px;'>
										<col width="170">
  									<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">

											<tr style='font-size:15px; background-color:#ff9966;' height='35px'>
												<th><center>Difficulty / Marks</center></th>
												<th>3</th>
												<th>4</th>
												<th>5</th>
												<th>6</th>
												<th>8</th>
												<th>10</th>
											</tr>
											<tr height='25px'>
												<th><center>L1</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L1' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L1' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L1' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L1' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L1' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L1' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
												
											</tr>
											<tr height='25px'>
												<th><center>L2</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L2' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L2' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L2' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L2' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L2' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L2' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L3</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L3' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L3' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L3' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L3' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L3' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=1 and difficultylevel='L3' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>

										</table>
										</td>

										</tr>
										</table>
										<?php
								}
								?>
								<p id="dif1a">
								</p>
						
								<?php
								if(isset($_POST["submit1"]))
								{	
									?>			
										<hr style="border: 1px solid lightgray;" />							
										<h2 style="color:black;">Module 2  </h2>
										<table>
										<tr>
										<td>
										<select type="text" id="myNumber2a" style="margin-left:10px; color:black;" onChange="difficulty2a()">
										<option> section 1 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select>
									<?php
								}
								?>

								<?php
								if(isset($_POST["submit1"]))
								{	
									?>
										<select type="text" id="myNumber2b" style="margin-left:100px; margin-top:-30px; color:black;" onChange="difficulty2b()">
										<option> section 2 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select>  </td>
										
										
										<td>
										<table border='1' style='color:black; margin-left:250px;'>
										<col width="170">
  									<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">

											<tr style='font-size:15px; background-color:#ff9966;' height='35px'>
												<th><center>Difficulty / Marks</center></th>
												<th>3</th>
												<th>4</th>
												<th>5</th>
												<th>6</th>
												<th>8</th>
												<th>10</th>
											</tr>
											<tr height='25px'>
												<th><center>L1</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L1' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L1' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L1' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L1' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L1' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L1' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L2</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L2' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L2' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L2' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L2' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L2' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L2' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L3</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L3' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L3' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L3' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L3' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L3' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=2 and difficultylevel='L3' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>

										</table>
										</td>

										</tr>
										</table>
										<?php
								}
								?>
								<p id="dif2a"></p>
								<p id="dif2b"></p>

								<?php
								if(isset($_POST["submit1"]))
								{	
									?>					
										<hr style="border: 1px solid lightgray;" />						
										<h2 style="color:black;">Module 3  </h2>
										<table>
										<tr>
										<td>
										<select type="text" id="myNumber3a" style="margin-left:10px; color:black;" onChange="difficulty3a()">
										<option> section 1 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select>
									<?php
								}
								?>

								<?php
								if(isset($_POST["submit1"]))
								{	
									?>
										<select type="text" id="myNumber3b" style="margin-left:100px; margin-top:-30px; color:black;" onChange="difficulty3b()">
										<option> section 2 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select> </td>
										
										
										<td>
										<table border='1' style='color:black; margin-left:250px;'>
										<col width="170">
  									<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">

											<tr style='font-size:15px; background-color:#ff9966;' height='35px'>
												<th><center>Difficulty / Marks</center></th>
												<th>3</th>
												<th>4</th>
												<th>5</th>
												<th>6</th>
												<th>8</th>
												<th>10</th>
											</tr>
											<tr height='25px'>
												<th><center>L1</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L1' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L1' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L1' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L1' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L1' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L1' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L2</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L2' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L2' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L2' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L2' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L2' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L2' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L3</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L3' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L3' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L3' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L3' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L3' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=3 and difficultylevel='L3' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>

										</table>
										</td>

										</tr>
										</table>
										<?php
								}
								?>
								<p id="dif3a"></p>
								<p id="dif3b"></p>
							
											</tr>

										</table>
										</td>

										</tr>
										</table>
										<?php
								
								?>
								<p id="dif4a"></p>
								<p id="dif4b"></p>
							

								<?php
								if(isset($_POST["submit1"]))
								{	
									?>		
										<hr style="border: 1px solid lightgray;" />									
										<h2 style="color:black;">Module 5 </h2>
										<table>
										<tr>
										<td>
										<select type="text" id="myNumber5a" style="margin-left:10px; color:black;" onChange="difficulty5a()">
										<option> section 1 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select>
									<?php
								}
								?>

								<?php
								if(isset($_POST["submit1"]))
								{	
									?>
										<select type="text" id="myNumber5b" style="margin-left:100px; margin-top:-30px; color:black;" onChange="difficulty5b()">
										<option> section 2 </option> 
										<option value='1'> 1 </option> 
										<option value='2'> 2 </option>
										<option value='3'> 3 </option> 
										</select> </td>
										
										
										<td>
										<table border='1' style='color:black; margin-left:250px;'>
										<col width="170">
  									<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">
										<col width="50">

											<tr style='font-size:15px; background-color:#ff9966;' height='35px'>
												<th><center>Difficulty / Marks</center></th>
												<th>3</th>
												<th>4</th>
												<th>5</th>
												<th>6</th>
												<th>8</th>
												<th>10</th>
											</tr>
											<tr height='25px'>
												<th><center>L1</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L1' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L1' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L1' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L1' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L1' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L1' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L2</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L2' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L2' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L2' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L2' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L2' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L2' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>
											<tr height='25px'>
												<th><center>L3</center></th>
												<?php
                                                $L13="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L3' and marks=3";
                                                $s1=mysqli_query($con,$L13);?>
												<td><?php while($row=mysqli_fetch_array($s1)){echo $row[0]; } ?></td>
												<?php
												$L14="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L3' and marks=4";
                                                $s2=mysqli_query($con,$L14);?>
												<td><?php while($row=mysqli_fetch_array($s2)){echo $row[0]; } ?></td>
												<?php
                                                $L15="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L3' and marks=5";
                                                $s3=mysqli_query($con,$L15);?>
												<td><?php while($row=mysqli_fetch_array($s3)){echo $row[0]; } ?></td>
												<?php
                                                $L16="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L3' and marks=6";
                                                $s4=mysqli_query($con,$L16);?>
												<td><?php while($row=mysqli_fetch_array($s4)){echo $row[0]; } ?></td>
												<?php
                                                $L18="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L3' and marks=8";
                                                $s5=mysqli_query($con,$L18);?>
												<td><?php while($row=mysqli_fetch_array($s5)){echo $row[0]; } ?></td>
												<?php
                                                $L110="select count(question) from question where sname like ('$_POST[sname]') and module=5 and difficultylevel='L3' and marks=10";
                                                $s6=mysqli_query($con,$L110);?>
												<td><?php while($row=mysqli_fetch_array($s6)){echo $row[0]; } ?></td>
											</tr>

										</table>
										</td>

										</tr>
										</table>
										<?php
								}
								?>
								<p id="dif5a"></p>
								<p id="dif5b"></p>
								</form>
               			 	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php
include('footer.php');
?>