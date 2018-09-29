<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php" ;
?>
<?php
	

			if(isset($_POST["pay_enroll"]))
			{
				$paymethod = ucwords(strtolower($_POST["pay_method"]));
				$amount = $_POST["amount"];
				$paid_by = $_POST["sid"];
				$exam_enrollment = $_POST["exam_enrollment"];
				$exam = $_POST["exam"];
				$added_by = $session->get_session('userid');
				date_default_timezone_set('Asia/Colombo');
				$added_date = date("Y-m-d h:i:s",time());
				
				$sql_cou = "update exam_enrollments set paid_status = 'closed' where sid ='$paid_by'";
				$sql_ins = "insert into incomes (catogory,description,exam_enrollment_id,payment_method,amount,paid_by,added_by,added_date,status)
				values ('Exam Management','$exam','$exam_enrollment','$paymethod','$amount','$paid_by','$added_by','$added_date','pending')";
				
						  if($conn->query($sql_ins) == true && $conn->query($sql_cou) == true){
							  		set_success_msg("<strong>Success!</strong> Exam fee has been successfully inserted!");
									header("Location: payments-add-examination-payment.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-add-examination-payment.php");
						  }
			}
 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="payments-add-course-enroll.php" class="nav-item nav-link ">Course Enrollment Fees</a>
							<a href="payments-add-student-registration.php" class="nav-item nav-link ">Student Registration Fees</a>
							<a class="nav-item nav-link active">Examination Fees</a>
							<a href="payments-add-library-membership.php" class="nav-item nav-link ">Library Membership Payment</a>
                            <a href="payments-renew-library-membership.php" class="nav-item nav-link ">Library Membership Renewal Payment</a>
							<a href="payments-pay-overdue.php" class="nav-item nav-link ">Library Overdue Payment</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<!--form method="post" action="course-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name = "search"  placeholder="Course name, id,">
											<div class="input-group-append">
												<button class="btn btn-dark" type="button">Search</button>
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
                                                    <th scope="col"><center>Exam Name</center></th>
													<!--th scope="col"><center>Subject</center></th-->
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
																												name LIKE '%$searchq%' OR
																												cid LIKE '%$searchq%'";	}
															else {
																		$sql = "SELECT * FROM exam_enrollments where paid_status = 'pending'";
															}

																		$result = $conn->query($sql);

																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>
												<form action="payments-add-examination-payment.php" method="post">
												<tr>
																<th scope="row"><center><?php echo $row['id']; ?></center></th>
																<td><center><?php echo $row['sid']; ?></center></td>
                                                                <?php
                                                                $sql_student = "select * from students where sid = '".$row['sid']."'";
																$result_student = $conn->query($sql_student);
																$row_student = $result_student->fetch_assoc();
																?>
                                                                <td><center><?php echo $row_student['fname'].".".$row_student["lname"]; ?></center></td>
																<td><center><?php echo $row_student['grade']; ?></center></td>
                                                                <?php
																$sql_exam = "select * from exams where id = '".$row["exid"]."'";
																$result_exam = $conn->query($sql_exam);
																$row_exam = $result_exam->fetch_assoc();
                                                                $sql_course = "select * from courses where cid = '".$row_exam['course_id']."'";
																$result_course = $conn->query($sql_course);
																$row_course = $result_course->fetch_assoc();
																?>
                                                                <td>
                                                                <center><?php echo $row_exam['name']; ?></center>
                                                                <input type="hidden" name="exam" value="<?php echo $row_exam['name']; ?>" />
                                                                <input type="hidden" name="exam_enrollment" value="<?php echo $row['id']; ?>" />
                                                                </td>
																<!--td><center><?php echo $row_course['name']; ?></center></td-->
																<td>
                                                                <center><?php echo $row_exam['fee']; ?></center>
                                                                <input type="hidden" value="<?php echo $row_exam['fee']; ?>" name="amount">
                                                                </td>
                                                                <td>
                                                                <input type="text" placeholder=" Payment Method " name="pay_method" class="form-control" required>
                                                                </td>
																<td class="<?php echo $row['paid_status']; ?>"><center><?php echo $row['paid_status']; ?></center></td>
													<td>
															
																	<input type="hidden" value="<?php echo $row['sid']; ?>" name="sid">
																	<input type="submit" value=" Confirm Exam Payment " class="btn btn-success" name="pay_enroll">
															
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
