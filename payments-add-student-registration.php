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
				$added_by = $session->get_session('userid');
				date_default_timezone_set('Asia/Colombo');
				$added_date = date("Y-m-d h:i:s",time());
				
				$sql_cou = "update students set paid_status = 'closed' where sid ='$paid_by'";
				$sql_ins = "insert into incomes (catogory,description,payment_method,amount,paid_by,added_by,added_date,status)
				values ('Student Management','Registration Fees','$paymethod','$amount','$paid_by','$added_by','$added_date','pending')";
				
						  if($conn->query($sql_ins) == true && $conn->query($sql_cou) == true){
							  		set_success_msg("<strong>Success!</strong> Registration fee has been successfully inserted!");
									header("Location: payments-add-student-registration.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-add-student-registration.php");
						  }
			}
 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="payments-add-course-enroll.php" class="nav-item nav-link ">Course Enrollment Fees</a>
							<a class="nav-item nav-link active">Student Registration Fees</a>
							<a href="payments-add-examination-payment.php" class="nav-item nav-link ">Examination Fees</a>
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
                                                    <th scope="col"><center>Student ID</center></th>
													<th scope="col"><center>Name</center></th>
                                                    <th scope="col"><center>Email</center></th>
                                                    <th scope="col"><center>Mobile No.</center></th>
													<th scope="col"><center>Grade</center></th>
                                                    <th scope="col"><center>Date of Birth</center></th>
													<th scope="col"><center>Registration Date</center></th>
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
																		$sql = "SELECT * FROM students where paid_status = 'pending'";
															}

																		$result = $conn->query($sql);

																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>

												<tr>
                                                <form action="payments-add-student-registration.php" method="post">
																<th scope="row">
                                                                <center><?php echo $row['sid']; ?></center>
                                                                </th>
                                                                <td><center><?php echo $row['fname'].".".$row["lname"]; ?></center></td>
																<td><center><?php echo $row['email']; ?></center></td>
                                                                <td><center><?php echo $row['mobile_no']; ?></center></td>
																<td><center><?php echo $row['grade']; ?></center></td>
																<td><center><?php echo $row['dob']; ?></center></td>
                                                                <td><center><?php echo $row['reg_date']; ?></center></td>
                                                                <td>
                                                                <input type="number" min="0" placeholder=" Registration Fees" name="amount" class="form-control" required>
                                                                </td>
                                                                <td>
                                                                <input type="text" name="pay_method" placeholder="Payment Method" class="form-control" required>
                                                                </td>
																<td class="<?php echo $row['paid_status']; ?>"><center><?php echo $row['paid_status']; ?></center></td>
													<td>
																	<input type="hidden" value="<?php echo $row['sid']; ?>" name="sid">
																	<input type="submit" value=" Confirm Registration Payment " class="btn btn-success" name="pay_enroll">
													</td>
                                                 </form>
												</tr>
                                                
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
