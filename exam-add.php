<?php include_once 'staff-header.php';
require_once 'database_credentials.php';

$dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($dbconn->connect_error) {
    die("Database connection error: " . $dbconn->connect_error);
}

if(isset($_POST["add"])){

    $examid=$_POST["exam_id"];
    $name = $_POST["exam_name"];
    $cid=$_POST["courseid"];
    $date=$_POST["date"];
    $stime=$_POST["stime"];
    $etime=$_POST["etime"];
    $fee=$_POST["fee"];
    $sql = "insert into exams values('$examid','$name','$cid','$date','$stime','$etime','$fee')";
    if (!$dbconn->query($sql)) {
        echo "Error updating record: " . $dbconn->error;
    }
}

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-add.php" class="nav-item nav-link active">Add</a>
							<a href="exam-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="exam-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="exam-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="exam-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="exam-add.php">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam ID</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="exam_id" value="<?php echo substr(number_format(time() * rand(),0,'',''),0,6); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam Name</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="exam_name" placeholder="Spot Test II 2018 Batch A" pattern="[A-Za-z0-9 ]{3,49}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <select name="courseid" class="form-control">
                                                    <?php
                                                        $sql_course = "select * from courses";
                                                        $result_course = $dbconn->query($sql_course);
                                                        while($row_course = $result_course->fetch_assoc()){
                                                            echo "<option value='".$row_course["cid"]."'> ".$row_course["name"]." </option>";
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
                                                <input type="date" class="form-control"  name="date" placeholder="Exam Date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam Start Time</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="time" class="form-control"  name="stime" placeholder="Exam Start Time" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam End Time</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="time" class="form-control"  name="etime" placeholder="Exam End Time" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Exam Fees</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="number" class="form-control"  name="fee" placeholder="Exam Fees" min="500" max="1000" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" name="add" value=" Add Exam " class="btn btn-dark">
                                    </div>
                                </div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
