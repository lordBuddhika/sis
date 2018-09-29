<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php" ;
?>
<?php
	

			if(isset($_POST["pay_enroll"]))
			{
				$paymethod = ucwords(strtolower($_POST["pay_method"]));
				$course_enrollment = $_POST["course_enrollment"];
				$amount = $_POST["amount"];
				$paid_by = $_POST["userid"];
				$course = $_POST["course"];
				$added_by = $session->get_session('userid');
				date_default_timezone_set('Asia/Colombo');
				$added_date = date("Y-m-d h:i:s",time());
				
				$sql_cou = "update course_enrollments set paid_status = 'closed' where id ='$course_enrollment'";
				$sql_ins = "insert into incomes (catogory,description,course_enrollment_id,payment_method,amount,paid_by,added_by,added_date,status)
				values ('Course Management','$course','$course_enrollment','$paymethod','$amount','$paid_by','$added_by','$added_date','pending')";
				
						  if($conn->query($sql_ins) == true && $conn->query($sql_cou) == true){
							  		set_success_msg("<strong>Success!</strong> Course fee has been successfully inserted!");
									header("Location: payments-add-course-enroll.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-add-course-enroll.php");
						  }
			}
 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Course Enrollment Fees</a>
							<a href="payments-add-student-registration.php" class="nav-item nav-link ">Student Registration Fees</a>
							<a href="payments-add-examination-payment.php" class="nav-item nav-link ">Examination Fees</a>
							<a href="payments-add-library-membership.php" class="nav-item nav-link ">Library Membership Payment</a>
                            <a href="payments-renew-library-membership.php" class="nav-item nav-link ">Library Membership Renewal Payment</a>
							<a href="payments-pay-overdue.php" class="nav-item nav-link ">Library Overdue Payment</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<!--form method="post" action="payments-add-course-enroll.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name = "search"  placeholder="Enrollment ID">
											<div class="input-group-append">
												<button class="btn btn-dark" type="submit">Search</button>
											</div>
										</div>
									</div>
								</div>
							</form>
                            	<!--div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="btn-group btn-group-lg" role="group">
  												<button type="button" class="btn btn-lg btn-danger active">Course Enrollment Fees</button>
  												<button type="button" class="btn btn-secondary">Student Registration Fees</button>
                                                <button type="button" class="btn btn-secondary">Examination Fees</button>
  												<button type="button" class="btn btn-secondary">Library Membership Payment</button>
                                                <button type="button" class="btn btn-secondary">Library Renewal Payment</button>
                                                <button type="button" class="btn btn-secondary">Library Overdue Payment</button>
											</div>
										</div>
									</div>
								</div-->
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col"><center>Enrollment ID</center></th>
                                                    <th scope="col"><center>Student ID</center></th>
													<th scope="col"><center>Name</center></th>
													<th scope="col"><center>Grade</center></th>
													<th scope="col"><center>Subject</center></th>
													<th scope="col"><center>Fees</center></th>
                                                    <th scope="col"><center>Payment Method</center></th>
                                                    <th scope="col"><center>Paid Status</center></th>
													<th scope="col"></th>
												</tr>
											</thead>

												<?php
														if(isset($_POST['search']))
															{
																$searchq = $_POST['search'];
																$sql  = "select * from course_enrollments WHERE
																												id LIKE '%$searchq%' AND paid_status = 'pending'";	}
															else {
																		$sql = "SELECT * FROM course_enrollments where paid_status = 'pending'";
															}

																		$result = $conn->query($sql);

																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>
												<form action="payments-add-course-enroll.php" method= "post">
												<tr>
																<th scope="row"><center><?php echo $row['id']; ?></center></th>
																<td>
                                                                <center><?php echo $row['userid']; ?></center>
                                                                <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
                                                                </td>
                                                                <?php
                                                                $sql_student = "select * from students where sid = '".$row['userid']."'";
																$result_student = $conn->query($sql_student);
																$row_student = $result_student->fetch_assoc();
																?>
                                                                <td><center><?php echo $row_student['fname'].".".$row_student["lname"]; ?></center></td>
																<td><center><?php echo $row['grade']; ?></center></td>
                                                                <?php
                                                                $sql_course = "select * from courses where cid = '".$row['course_id']."'";
																$result_course = $conn->query($sql_course);
																$row_course = $result_course->fetch_assoc();
																?>
																<td>
                                                                <center><?php echo $row_course['name']; ?></center>
                                                                <input type="hidden" value="<?php echo $row_course['name']; ?>" name="course" />
                                                                </td>
																<td>
                                                                <center><?php echo $row_course['fee']; ?></center>
                                                                <input type="hidden" value="<?php echo $row_course['fee']; ?>" name="amount">
                                                                </td>
                                                                <td>
                                                                <input type="text" placeholder=" Payment Method " class="form-control" required name="pay_method">
                                                                </td>
																<td class="<?php echo $row['paid_status']; ?>"><center><?php echo $row['paid_status']; ?></center></td>
													<td>
															<div class="btn-group" role="group" >
																	<input type="hidden" value="<?php echo $row['id']; ?>" name="course_enrollment">
																	<input type="submit" value=" Confirm Payment " class="btn btn-success" name="pay_enroll">
															</div>
													</td>
												</tr>
                                                </form>
											</tbody>
										<?php }
										 ?>

										</table>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
