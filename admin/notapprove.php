<?php
$con=mysqli_connect("localhost","root","","qpgs") or die("error creating database");

?>

<?php
$fid = $_GET["fid"];
$query="update faculty set status ='no' where fid = $fid";
$s=mysqli_query($con,$query);
?>

<script type="text/javascript">
confirm("Do you really want to disapprove?");
window.location="display_faculty_info.php";

</script>