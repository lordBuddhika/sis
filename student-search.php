<?php
    include_once 'staff-header.php';
    require_once 'database_credentials.php';

            $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if($dbconn->connect_error) {
                die("Database connection error: " . $dbconn->connect_error);
            } else {
                $conn_status = true;
            }

            if(isset($_POST["delete"])){
                $sid = $_POST["sid"];
                $result = $dbconn->query("delete from students where sid='$sid'");

            }

            if(isset($_POST['search'])){
             $searchq = $_POST['search'];
             $searchq = preg_replace("#[^0-9a-z]#i","","$searchq");

             $query = mysql_query("SELECT * FROM students WHERE firstname LIKE'%$searchq' or lastname LIKE '%$searchq'") or die("Could not search");
             $count = mysql_num_rows($query);
             if($count == 0){
                 $output = 'There was no search results!';
                            $lname = $row['lname'];
                         while($row = mysql_fetch_array($squery)){
                             $fname = $row['fname'];

                     }
                 }
             }
?>





                <div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="student-add.php" class="nav-item nav-link disabled"> Add Student </a>
							<a href="student-search.php" class="nav-item nav-link active"> Search Student </a>
							<a href="student-attendance.php" class="nav-item nav-link disabled">Mark Attendance</a>
							<a href="student-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="student-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">

								<div class="row">
									<div class="col-md-12">
                                        <form method="post" action="student-search.php" >
										    <div class="input-group mb-3">
                                                <input name="Student name" value="<?php echo (isset($_POST['fname'])) ? $_POST['fname'] : '' ; ?>" type="text" class="form-control" placeholder="Student ID" aria-label="Recipient's username" aria-describedby="basic-addon2">
											    <div class="input-group-append">
												<button class="btn btn-dark" type="button">Search</button>
											</div>
										</div>
                                        </form>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">Student ID</th>
													<th scope="col">Name</th>
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
                                                            <form action="student-update.php" method="post">
                                                                <input type="hidden" value="<?php echo $row_get["sid"]; ?>" name="sid">
                                                                <input type="submit" value=" Edit " class="btn btn-dark" name="update">
                                                            </form>
                                                            <form action="student-search.php" method="post" onsubmit="return confirm('WARNING!\n1. There\'s no way to undo this action.\n\nDo you still really want to proceed?');">

                                                                <input type="hidden" value="<?php echo $row_get["sid"]; ?>" name="sid">
                                                                <input type="submit" value=" Delete " class="btn btn-danger" name="delete">
                                                            </form>
                                                            <form action="#" method="post">
                                                                <input type="hidden" value="<?php echo $row_get["sid"]; ?>" name="sid">
                                                                <input type="submit" value=" Enroll " class="btn btn-dark" name="enroll">
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
				</div>
<?php include_once 'staff-footer.php'; ?>
