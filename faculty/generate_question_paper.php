<html>
<body style="padding:100px">


<div>
<p style="padding-right:200px">GR NO._________________</p><p> PAPER CODE:_____________</p>

<div>
<center>
<h3>S.Y.B.TECH COMP.SCIENCE & ENGG</h3>
<h3>(SEM-II)</h3>
<h3>
<h3>COURSE CODE :______________<h3>
<center>
</div>
<div>
<?php
	$instructions = $_POST["instructions"];
         $time = $_POST["time"];
$marks=$_POST['marks'];
 ?>
<h4>   <?Php echo "<p>Time :$time Min</p>";
?>
</h4>
<h4> <?Php echo "<p>Marks :$marks </p>";
?>
</h4>
<hr>
  <div> <h4> Instructions to candidate :</h4>
<ol>
<p>Figures to the right indicate full marks.</p>
<p>Use suitable data whenever required.</p>
<p>Solve any one question from Question 1.</p>
<p>Solve any two question from Question 2 and 3.</p>
</ol>
    <?Php
 echo "<h4>$instructions</h4>";
?>
</div>
<hr>


<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qpgs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['sname'])) {
    $course = $_POST['sname'];

} else {
    // Handle the case where 'sname' is not set
}

$marks=$_POST['marks'];
$unit1 = $_POST["que1_unit"];

$diff1 = $_POST["diff1"];

$unit2 = $_POST["que2_unit"];
$diff2 = $_POST["diff2"];

$unit3 = $_POST["que3_unit"];
$diff3 = $_POST["diff3"];
 


if($marks==20)
{
// Execute que1
$sql1 = "SELECT question, marks FROM question WHERE unit_name = ? AND marks = 4 AND sname = ? AND difficultylevel = ? ORDER BY RAND() LIMIT 3  ";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("sss", $unit1, $course, $diff1); 
$stmt1->execute();
$result1 = $stmt1->get_result();

// Display que1 questions
echo "<h2>Question 1:</h2>";
echo "<ol>";
while ($row = $result1->fetch_assoc()) {
    echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .") </li>";
}
echo "</ol>";

// Execute que2
$sql2 = "SELECT question, marks FROM question WHERE unit_name = ? AND sname = ? AND marks = 4 AND difficultylevel = ?  ORDER BY RAND() LIMIT 3";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("sss", $unit2, $course, $diff2); 
$stmt2->execute();
$result2 = $stmt2->get_result();

// Display que2 questions
echo "<hr><h2>Question 2:</h2>";
echo "<ol>";
while ($row = $result2->fetch_assoc()) {
    echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .")</li>";
}
echo "</ol>";
// Execute que3
$sql3 = "SELECT question, marks FROM question  WHERE unit_name = ? AND sname = ? AND marks = 4 AND difficultylevel = ?  ORDER BY RAND() LIMIT 3";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("sss", $unit3, $course, $diff3); 

$stmt3->execute();
$result3 = $stmt3->get_result();

// Display que3 questions
echo "<hr><h2>Questions 3:</h2>";
echo "<ol>";
while ($row = $result3->fetch_assoc()) {
    echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .")</li>";
}
echo "</ol>";
}


if ($marks == 40) {

$sql1 = "SELECT question , marks FROM question WHERE unit_name = ? AND marks = 2 AND sname = ? AND difficultylevel = ? ORDER BY RAND() LIMIT 2  ";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("sss", $unit1, $course, $diff1); 
$stmt1->execute();
$result1 = $stmt1->get_result();

// Display que1 questions
echo "<h2>Question 1:</h2>";
echo "<ol>";
while ($row = $result1->fetch_assoc()) {
    echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .")</li>";
}
echo "</ol>";

// Execute que2
$sql2 = "SELECT question , marks FROM question WHERE unit_name = ? AND sname = ? AND marks = 6 AND difficultylevel = ?  ORDER BY RAND() LIMIT 1";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("sss", $unit2, $course, $diff2); 
$stmt2->execute();
$result2 = $stmt2->get_result();

// Display que2 questions
echo "<hr><h2>Question 2:</h2>";
echo "<ol>";
while ($row = $result2->fetch_assoc()) {
    echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .")</li>";
}
echo "</ol>";
// Execute que3
$sql3 = "SELECT question , marks FROM question  WHERE unit_name = ? AND sname = ? AND marks = 5 AND difficultylevel = ?  ORDER BY RAND() LIMIT 3";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("sss", $unit3, $course, $diff3); 

$stmt3->execute();
$result3 = $stmt3->get_result();

// Display que3 questions
echo "<hr><h2>Questions 3:</h2>";
echo "<ol>";
while ($row = $result3->fetch_assoc()) {
    echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .")</li>";
}
echo "</ol>";

    $unit4 = $_POST["que4_unit"];
    $diff4 = $_POST["diff4"];

    // Execute que4
    $sql4 = "SELECT question , marks FROM question WHERE unit_name = ? AND marks = 5 AND sname = ? AND difficultylevel = ? ORDER BY RAND() LIMIT 3";
    $stmt4 = $conn->prepare($sql4);
    $stmt4->bind_param("sss", $unit4, $course, $diff4); 
    $stmt4->execute();
    $result4 = $stmt4->get_result();

    // Display que4 questions
    echo "<h2>Question 4:</h2>";
    echo "<ol>";
    while ($row = $result4->fetch_assoc()) {
        echo "<li>" . $row["question"] . " (Marks: " . $row["marks"] .") </li>";
    }
    echo "</ol>";
}

$stmt3->close();
$conn->close();
?>
<button onclick="printPage()">Print Page</button>

        <script>
        function printPage() {
            window.print(); // Call the print method
        }
    </script>
</body>
</html>
