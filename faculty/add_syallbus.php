<?php
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php
}

include('connection.php');
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subjectName = $_POST['sname'];
    $unitNames = $_POST['unit_names']; 
    $flag=false;
    $sql = "SELECT scode FROM add_subject WHERE sname='$subjectName'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $subjectCode = $row['scode'];
    
        foreach ($unitNames as $unitName) {
            $unitName = mysqli_real_escape_string($con, $unitName); 
            $insertUnitQuery = "INSERT INTO units (subject_id, unit_name) VALUES ('$subjectCode', '$unitName')";
            $result = mysqli_query($con, $insertUnitQuery);
            if ($result) {
                $flag=true;
            }
        }
    } else {
        echo "Error retrieving subject code: " . mysqli_error($con);
    }

    if ($result) {
        echo "<script>alert('Units added successfully.');</script>";
    }
 else {
    // Handle errors if the SQL query fails
    echo "Error: " . mysqli_error($con);
}
}
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row" style="min-height:500px">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h1 style="color:black; text-align:center;">Syallbus</h1>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <table>
                                <tr>
                                    <td>
                                        <select name="sname" class="form-control selectpicker">
                                            <?php
                                            $query = "SELECT sname from assign_subject where email = '$_SESSION[username]'";
                                            $s = mysqli_query($con, $query);

                                            while ($row = mysqli_fetch_array($s)) {
                                                echo "<option>";
                                                echo $row["sname"];
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div>
                                <h2>Enter Unit Names</h2>
                                <div id="unitNamesContainer">
                                    <!-- Initial input field for unit name -->
                                    <input type="text" name="unit_names[]" placeholder="Enter unit name...">
                                </div>
                                <button type="button" onclick="addUnitNameInput()">Add Unit</button>
                                <button type="submit">Submit</button>
                                <p id="outputMessage"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');

?>

<script>
    function addUnitNameInput() {
        var unitNamesContainer = document.getElementById("unitNamesContainer");
        var input = document.createElement("input");
        input.type = "text";
        input.name = "unit_names[]"; // Array notation to capture multiple inputs
        input.placeholder = "Enter unit name...";
        unitNamesContainer.appendChild(input);
    }
</script>
