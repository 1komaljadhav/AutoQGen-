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
						<h1 style="color:black; text-align:center;">Add Question</h1>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form name="form1" action="" method="post">
							<table>
								<tr>
									<td>
										<select name="sname" class="form-control selectpicker">
											<?php
											$query = "select sname from assign_subject where email = '$_SESSION[username]'";
											$s = mysqli_query($con, $query);

											while ($row = mysqli_fetch_array($s)) {
												echo "<option>";
												echo $row["sname"];
												echo "</option>";
											}
											?>

										</select>
									</td>
									<td>
										<button type="submit" name="submit1" style="border:none; display: inline-block; margin-left:40px; margin-top:5px; border-radius:30px;">
											<img src="images/search.png" height="33px" width="50px" style="border-radius:10px; display: block;"></button>
									</td>
								</tr>
							</table>

							<?php
							if (isset($_POST["submit1"])) {
								$query = "select scode, sname, bid from assign_subject where sname='$_POST[sname]'";
								$s5 = mysqli_query($con, $query);
								while ($row = mysqli_fetch_array($s5)) {
									$scode = $row["scode"];
									$sname = $row["sname"];
									$bid = $row["bid"];
									$_SESSION["scode"] = $scode;
									$_SESSION["sname"] = $sname;
									$_SESSION["bid"] = $bid;
								}

								$q = "select fid from faculty where email='$_SESSION[username]'";
								$s6 = mysqli_query($con, $q);
								while ($row = mysqli_fetch_array($s6)) {
									$fid = $row["fid"];
									$_SESSION["fid"] = $fid;
								}
							?>
								<br><br><br>
								<table class="table table-bordered">
									<tr>
										<td><label >Subject Code</label>
<input type="text" id="scode" name="scode" class="form-control" autocomplete="off" placeholder="Subject Code" value="<?php echo $scode; ?>" style="border-radius:10px;" disabled></td>
									</tr>
									<tr><td><label >Subject Name</label>
										<input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Subject Name" value="<?php echo $sname; ?>" style="border-radius:10px;" disabled></td>
									</tr>
									<tr>

										<td><label >Branch ID</label><input type="text" name="bid" class="form-control" autocomplete="off" placeholder="Branch Id" value="<?php echo $bid; ?>" style="border-radius:10px;" disabled></td>
									</tr>
									<tr>

										<td><label >Select Unit</label>
											<select name="unit" class="form-control selectpicker" style="border-radius:10px;" required>
												<?php
												$sname = $_POST['sname'];
												$query = "SELECT unit_name FROM units WHERE subject_id in (SELECT scode FROM assign_subject WHERE sname='$sname')";

												$s = mysqli_query($con, $query);

												while ($row = mysqli_fetch_array($s)) {
													echo "<option>";
													echo $row["unit_name"];
													echo "</option>";
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td><label >Add question</label><input type="text" name="question" class="form-control" autocomplete="off" placeholder="Enter Question" value="" style="border-radius:10px;" required=""></td>
									</tr>
									<tr>
										<td>
											<select name="difficulty" class="form-control selectpicker" style="border-radius:10px;" required>
												<option value="" style="border-radius:10px;" disabled selected>Difficulty Level</option>
												<option value="Easy" style="border-radius:10px;">Easy</option>
												<option value="Medium" style="border-radius:10px;">Medium</option>
												<option value="High" style="border-radius:10px;">High</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<select name="marks" class="form-control selectpicker" style="border-radius:10px;" required>
												<option value="" disabled selected>Marks</option>
												<option value="2">2</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><input type="submit" value="ADD" name="submit2" class="form-control btn btn-default" style="background-color:#2a3f54; color:white; border-radius:20px;"></td>
									</tr>
								</table>
							<?php
							}

							if (isset($_POST["submit2"])) {
								$scode = mysqli_real_escape_string($con, $_REQUEST['scode']);
								$unit = mysqli_real_escape_string($con, $_REQUEST['unit']);
								$question = mysqli_real_escape_string($con, $_REQUEST['question']);
								$difficulty = mysqli_real_escape_string($con, $_REQUEST['difficulty']);
								$marks = mysqli_real_escape_string($con, $_REQUEST['marks']);

								$check = "SELECT * FROM question WHERE question='$question'";
								$rs = mysqli_query($con, $check);
								$data = mysqli_num_rows($rs);
								if ($data > 0) {
							?>
									<script type="text/javascript">
										confirm("Question already exists");
									</script>
								<?php
								} else {
									// attempt insert query execution
									$t = "INSERT INTO question (scode, sname, bid, fid, question, unit_name, difficultylevel, marks) VALUES ('$_SESSION[scode]', '$_SESSION[sname]', '$_SESSION[bid]', '$_SESSION[fid]', '$question' ,'$unit' ,'$difficulty','$marks')";
									if (mysqli_query($con, $t)) {
								?>
										<script type="text/javascript">
											confirm("Question successfully inserted");
											// document.location.href="add_question.php";
										</script>
									<?php
									} else {
										echo "ERROR: Could not execute $t. " . mysqli_error($con);
									}
								}
							}
							?>
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
