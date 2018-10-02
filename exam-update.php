<?php include_once 'staff-header.php';
require_once 'database_credentials.php';
$dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($dbconn->connect_error) {
    die("Database connection error: " . $dbconn->connect_error);
}

    if(isset($_POST["updatedata"])){

        $examid=$_POST["exam_id"];
        $name = $_POST["exam_name"];
        $cid=$_POST["courseid"];
        $date=$_POST["date"];
        $stime=$_POST["stime"];
        $etime=$_POST["etime"];
        $fee=$_POST["fee"];
        $sql = "UPDATE exams SET name='$name', course_id='$cid', date='$date', time_start='$stime', time_end='$etime', fee='$fee' WHERE id='$examid'";
        if (!$dbconn->query($sql)) {
            echo "Error updating record: " . $dbconn->error;
        }
    }

if(isset($_POST['update'])) {

    $examid = $_POST["examid"];
    $sql = "select * from exams where id = '$examid' ";
    $result_upadate = $dbconn->query($sql);
    $row = $result_upadate->fetch_assoc();



?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-update.php" class="nav-item nav-link active">Update</a>
							<a href="exam-search.php" class="nav-item nav-link disabled">Back</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="exam-update.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Exam ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="exam_id" value="<?php echo $row["id"]; ?>" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Exam Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo $row["name"]; ?>" name="exam_name" placeholder="" required>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam Name</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <?php $select = ""; ?>
                                                <select name="courseid" class="form-control">
                                                    <option value="selected">Please select</option>
                                                    <?php
                                                    $sql_course = "select * from courses";
                                                    $result_course = $dbconn->query($sql_course);
                                                    while($row_course = $result_course->fetch_assoc()){
                                                        if($row["course_id"] == $row_course["cid"]){$select = "selected"; }
                                                        else{$select = "";}

                                                        echo "<option value='".$row_course["cid"]."' ".$select."> ".$row_course["cid"]." ".$row_course["name"]." </option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Exam Date </label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" value="<?php echo $row["date"]; ?>" name="date" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam Start Time</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="time" class="form-control" value="<?php echo $row["time_start"]; ?>" name="stime" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam End Time</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="time" class="form-control" value="<?php echo $row["time_end"]; ?>" name="etime" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam Fees</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" value="<?php echo $row["fee"]; ?>" name="fee" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group row">
									<div class="col-sm-10">
										<input type="submit" name="updatedata" value=" Update Exam " class="btn btn-dark">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
    <?php } ?>
<?php include_once 'staff-footer.php'; ?>
