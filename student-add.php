<?php include_once 'staff-header.php';
    require_once 'database_credentials.php';

    $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($dbconn->connect_error) {
        die("Database connection error: " . $dbconn->connect_error);
    } else {
        $conn_status = true;
    }

    $sql_id = "select MAX(sid) as maximum from students";
    $result_id = $dbconn->query($sql_id);
    $row_id = $result_id->fetch_assoc();
    $max_id = $row_id["maximum"]+1;
?>
<?php
    function add_student($sid,$fname, $lname, $email, $grade, $dob, $mobile_no, $gender, $reg_date, $password) {

        $password = md5($password);

        $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($dbconn->connect_error) {
            die("Database connection error: " . $dbconn->connect_error);
        } else {
            $conn_status = true;
        }

        //$userid = substr(number_format(time() * rand(), 0, '',''),0,6);

        $sql_user = "INSERT INTO students VALUES ( $sid, '$fname', '$lname', '$email', $grade, '$mobile_no', '$dob', '$gender', '$reg_date', '$password')";
        if ($dbconn->query($sql_user)) {
            return true;
        } else {
            echo "Error: " . $dbconn->error;
            return false;
        }
    }
?>


<?php
    if(isset($_POST['add'])) {

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            add_student($_POST['sid'], $_POST['fname'], $_POST['lname'], $_POST['email'],$_POST['grade'], $_POST['mobile_no'], $_POST['dob'], $_POST['gender'], $_POST['reg_date'], $_POST['password']);
            set_success_msg("<strong>Success!</strong> New student has been successfully added!");
        } else {
            set_error_msg("<strong>Failed!</strong> Email address is invalid");

        }
        header('Location: student-add.php');
    }
?>

				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="student-add.php" class="nav-item nav-link active"> Add Students </a>
							<a href="student-search.php" class="nav-item nav-link disabled"> Search Students </a>
							<a href="student-attendance.php" class="nav-item nav-link disabled"> Mark Attendance </a>
							<a href="student-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="student-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="student-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"> Student ID </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="sid" value="<?php echo $max_id; ?>" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"> Name </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="fname" placeholder="First name" required>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="lname" placeholder="Last name" required>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Contacts </label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="mobile_no" placeholder="Mobile" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Grade</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                <input type="number" min="1" max="13" class="form-control" name="grade" placeholder="Grade" required>
											</div>
										</div>
									</div>
								</div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Date of Birth</label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Registration Date </label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="reg_date" placeholder="Registration Date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Password </label>
                                    <div class="col-sm-10">
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="password" class="form-control" name="re-password" placeholder="Re-Enter Password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
									<div class="row">
										<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
										<div class="col-sm-10 col-md-2">
											<select name="gender" class="form-control" required>
                                                <option value="-1" selected>Please Select</option>
												<option value="1">Male</option>
												<option value="0">Female</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button name="add" type="submit" class="btn btn-dark">Add Student</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
