<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php" ;
?>
<?php
	

			if(isset($_POST["pay_enroll"]))
			{
				$paymethod = ucwords(strtolower($_POST["pay_method"]));
				$amount = $_POST["amount"];
				$paid_by = $_POST["userid"];
				$library_member_id = $_POST["mid"];
				$added_by = $session->get_session('userid');
				date_default_timezone_set('Asia/Colombo');
				$added_date = date("Y-m-d h:i:s",time());
				
				$sql_cou = "update library_members set paid_status = 'closed' where user_id ='$paid_by'";
				$sql_ins = "insert into incomes (catogory,description,library_member_id,payment_method,amount,paid_by,added_by,added_date,status)
				values ('Library Management','Membership Fees','$library_member_id','$paymethod','$amount','$paid_by','$added_by','$added_date','pending')";
				
						  if($conn->query($sql_ins) == true && $conn->query($sql_cou) == true){
							  		set_success_msg("<strong>Success!</strong> Library Membership fee has been successfully inserted!");
									header("Location: payments-add-library-membership.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-add-library-membership.php");
						  }
			}
			
 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="payments-add-course-enroll.php" class="nav-item nav-link ">Course Enrollment Fees</a>
							<a href="payments-add-student-registration.php" class="nav-item nav-link ">Student Registration Fees</a>
							<a href="payments-add-examination-payment.php" class="nav-item nav-link ">Examination Fees</a>
							<a class="nav-item nav-link active">Library Membership Payment</a>
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
													<th scope="col"><center>Membership ID</center></th>
                                                    <th scope="col"><center>Memeber ID</center></th>
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
																		$sql = "SELECT * FROM library_members where paid_status = 'pending'";
															}

																		$result = $conn->query($sql);

																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>
												<form action="payments-add-library-membership.php" method= "post">
												<tr>
																<th scope="row">
                                                                <center><?php echo $row['mid']; ?></center>
                                                                <input type="hidden" name="mid" value="<?php echo $row['mid']; ?>" />
                                                                </th>
																<td>
                                                                <center><?php echo $row['user_id']; ?></center>
                                                                <input type="hidden" name="userid" value="<?php echo $row['user_id']; ?>" />
                                                                </td>
                                                                <?php
                                                                #$sql_student = "select * from students where sid = '".$row['userid']."'";
																#$result_student = $conn->query($sql_student);
																#$row_student = $result_student->fetch_assoc();
																?>
                                                                <?php
                                                                #$sql_course = "select * from courses where cid = '".$row['course_id']."'";
																#$result_course = $conn->query($sql_course);
																#$row_course = $result_course->fetch_assoc();
																?>
																<td>
                                                                <input type="number" name="amount" min="0" required="required" placeholder=" Membership Fee " class="form-control" />
                                                                </td>
                                                                <td>
                                                                <input type="text" name="pay_method" placeholder="Payment Method" class="form-control" required>
                                                                </td>
																<td class="<?php echo $row['paid_status']; ?>"><center><?php echo $row['paid_status']; ?></center></td>
													<td>
																	
																	<input type="submit" value=" Confirm Library Membership " class="btn btn-success" name="pay_enroll">
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
