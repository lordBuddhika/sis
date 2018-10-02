<?php
    include_once 'staff-header.php';
    require_once 'database_credentials.php';

        $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($dbconn->connect_error) {
            die("Database connection error: " . $dbconn->connect_error);
        } else {
            $conn_status = true;
        }
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="student-add.php" class="nav-item nav-link disabled"> Add Student </a>
							<a href="student-search.php" class="nav-item nav-link disabled"> Search Student </a>
							<a href="student-attendance.php" class="nav-item nav-link active"> Mark Attendance </a>
							<a href="student-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="student-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                            <form method="post" action="student-attendance.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Employee name, email, id" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
												<button class="btn btn-dark" type="button"> Search </button>
											</div>
										</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Student ID</th>
                                            <th scope="col"> Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Date of Birth</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Registration Date</th>
                                            <th scope="col">Operations</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $sql_get = "select * from students";
                                        $result_get = $dbconn->query($sql_get);
                                        while($row_get = $result_get->fetch_assoc()){
                                            ?>
                                            <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $row_get["sid"]; ?></th>
                                                <td><?php echo $row_get["fname"]." ".$row_get["lname"]; ?></td>
                                                <td><?php echo $row_get["email"]; ?></td>
                                                <td><?php echo $row_get["grade"]; ?></td>
                                                <td><?php echo $row_get["mobile_no"]; ?></td>
                                                <td><?php echo $row_get["dob"]; ?></td>
                                                <td><?php echo $row_get["gender"]; ?></td>
                                                <td><?php echo $row_get["reg_date"]; ?></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <form action="student-attendance.php" method="post">
                                                            <input type="hidden" value="<?php echo $row_get["sid"]; ?>" name="sid">
                                                            <input type="submit" value=" Mark Attandence " class="btn btn-danger" name="mark">
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
