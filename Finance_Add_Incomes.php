<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    $income_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM incomes");
	$result = mysqli_fetch_assoc($income_max); 
	$max = $result['maximum']+1;
	
	$tot = 0;
	$income_tot = "select amount from incomes";
	$result_tot = $conn->query($income_tot);
	while($row_tot = $result_tot->fetch_assoc()){
		$tot = $tot + $row_tot["amount"];
	}
	
	$tot_pen = 0;
	$income_pen = "select amount from incomes where status='pending'";
	$result_pen = $conn->query($income_pen);
	while($row_pen = $result_pen->fetch_assoc()){
		$tot_pen = $tot_pen + $row_pen["amount"];
	}
	
	$tot_close = 0;
	$income_close = "select amount from incomes where status='closed'";
	$result_close = $conn->query($income_close);
	while($row_close = $result_close->fetch_assoc()){
		$tot_close = $tot_close + $row_close["amount"];
	}
	
	if(isset($_POST["add"])){
		$dept_task_other = "";
		$pay_method_others = "";
		$paid_by_stu = "";
		$paid_by_staff = "";
		$paid_by_others = "";
		
		
		$deparment_name = $_POST["department"];
		$dept_task = $_POST["description"];
		$dept_task_other = $_POST["other_desc"];
		$pay_method = $_POST["payment"];
		$pay_method_others = $_POST["other_pay"];
		$amount =  $_POST["amount"];
		$paid_by_cat = $_POST["paidby_cat"];
		$paid_by_stu = $_POST["student"];
		$paid_by_staff = $_POST["staff"];
		$paid_by_others = $_POST["others"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		$status = "pending";
		
		{
				if($dept_task == "Others")
					$final_dept_task = $dept_task_other;
				else
					$final_dept_task = $dept_task;
		}
		
		{
			if($pay_method == "Others")
				$final_pay_method = $pay_method_others;
			else
				$final_pay_method = $pay_method;
		}
		
		{
			if($paid_by_cat == "student")
				$final_paid_by = $paid_by_stu;
			else if($paid_by_cat == "staff")
				$final_paid_by = $paid_by_staff;
			else
				$final_paid_by = $paid_by_others;
		}
		
		$sql_check = "select * from incomes where catogory='$deparment_name' and description='$final_dept_task' and payment_method='$final_pay_method' and amount='$amount' and paid_by='$final_paid_by'";
		$result_check = $conn->query($sql_check);
		
		if($result_check->num_rows>0){
			echo "<script> alert(' The record you inserted already available in database!.. Try a new record!..') </script>";
			set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to insert!...");
			header("Location: Finance_Add_Incomes.php");
			
		}
		else{
			reset_error_msg();
			$sql_insert = "insert into incomes (catogory,description,payment_method,amount,paid_by,added_by,added_date,status) values"
						  ." ('$deparment_name','$final_dept_task','$final_pay_method','$amount','$final_paid_by','$added_by','$added_date','$status')";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong> New income has been successfully inserted!");
									header("Location: Finance_Add_Incomes.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Incomes.php");
						  }
		}
	}
	 

?>

				<div class="col-md-8">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Overview.php" class="nav-item nav-link"> Income Overview </a>
							<a class="nav-item nav-link active"> Add Incomes </a>
                            <a href="Finance_Update_Incomes.php" class="nav-item nav-link"> Update Incomes </a>
                            <a href="Finance_Delete_Incomes.php" class="nav-item nav-link"> Delete Incomes </a>
                            <a href="Finance_Verify_Incomes.php" class="nav-item nav-link"> Verify Incomes </a>
                            <a href="Finance_Closed_Incomes.php" class="nav-item nav-link"> Closed Incomes </a>
							<a class="nav-item nav-link disabled"> Income Reports </a>				
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" name="AddIncome" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return(incomeValidation());">
                            	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Income ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="incomeid" type="text" class="form-control" name="incomeid" value="<?php echo " INC".$max; ?>"  readonly="readonly">
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="income_id_alert" class="message-hide" role="alert">
  											<strong id="strong_message1"></strong><span id="soft_message1"></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Catogory</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                    <?php 
														$deparments = "select * from departments";
														$result_deparment = $conn->query($deparments);
														if($result_deparment->num_rows>0){
															echo "<select id='dept' name='department' class='form-control' onChange='deptChange(this);selOthers(this);progress();'>";
															echo "<option value='Selected' selected>Please Select</option>";
															while($row_dept = $result_deparment->fetch_assoc()){
																echo "<option value='".$row_dept["name"]."'> ".$row_dept["name"]." </option>";
															}
															echo "</select>";
														}else{
															echo "<input type='text' class='form-control' value='There are no Departments' readonly>";
														}
													?>
												
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="catogory_alert" class="message-hide" role="alert">  											
                                        <strong id="strong_message2"></strong><span id="soft_message2"></span>
										</div>
									</div>
								</div>
                                
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Description</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="dept_task" name='description' class='form-control' onChange='deptOthers(this);progress();'>
                                                	<option value="Selected" selected>Please Select a Department</option>
                                                </select>
											</div>
                                            <div class="col-md-3">
                                            	<input id="other_desc" type="hidden" class="form-control" name="other_desc" placeholder=" Other Description ">
                                            </div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="dept_task_alert" class="message-hide" role="alert">
  											<strong id="strong_message3"></strong><span id="soft_message3"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Payment Method</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="pay" name="payment" class="form-control" onChange="payOthers(this);">
                                                	<option value="Selected" selected>Please Select</option>
													<option value="Cash">Cash</option>
													<option value="Cheque">Cheque</option>
													<option value="Others">Others</option>
												</select>
											</div>
                                            <div class="col-md-3">
                                            	<input id="other_pay" type="hidden" class="form-control" name="other_pay" placeholder=" Other Payment Option ">
                                            </div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="payment_alert" class="message-hide" role="alert">
  											<strong id="strong_message4"></strong><span id="soft_message4"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Amount</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="amount" type="number" class="form-control" name="amount" placeholder="Amount">
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="amount_alert" class="message-hide" role="alert">
                                        
  											<strong id="strong_message5"></strong><span id="soft_message5"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Paid By</label>
									<div class="col-sm-10">
										<div class="form-row">
                                        	<div class="col-md-3">
												<select id="paidby_cat" name="paidby_cat" class="form-control" onchange="paidCatogory(this);progress();">
													<option value="Selected">Please Select</option>
                                                    <option value="student">Student</option>
                                                    <option value="staff">Staff</option>
                                                    <option value="others">Others</option>
												</select>
											</div>
                                        	<div class="col-md-3">
												<input id="paidby_others" type="text" class="form-control message-hide" name="others" placeholder=" Other Payee ">
                                                <select id="paidby_staff" name="staff" class="form-control message-hide">
													<option value="Selected">Please Select a Staff</option>
                                                    <?php
                                                     require_once "DB_Connection.php";
													 $sql_staff = "select userid,fname,lname from users";
													 $result_staff = $conn->query($sql_staff);
													 if($result_staff->num_rows>0){
														 while($row_staff = $result_staff->fetch_assoc()){
															 echo "<option value='".$row_staff["userid"]."'>".$row_staff["userid"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row_staff["fname"]." ".$row_staff["lname"]."</option>";
														 }
													 }
													  
													?>
												</select>
                                                
                                                <select id="paidby_student" name="student" class="form-control message-hide">
													<option value="Selected">Please Select a Student</option>
                                                    <?php
													 
													 $sql_student = "select sid,fname,lname from students";
													 $result_student = $conn->query($sql_student);
													 if($result_student->num_rows>0){
														 while($row_student = $result_student->fetch_assoc()){
															 echo "<option value='".$row_student["sid"]."'>".$row_student["sid"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row_student["fname"]." ".$row_student["lname"]."</option>";
														 }
													 }
													 $conn->close();
													  
													?>
												</select>
                                                
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="paidby_alert" class="message-hide" role="alert">
  											<strong id="strong_message6"></strong><span id="soft_message6"></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
                                    	<div class="form-row">
										<div class="col-md-3">
											<input id="income_submit" name="add" type="submit" class="btn btn-dark" value=" Add an Income">
                                        </div>
                                        </div>
									</div>
                               	 </div>
                            
							</form>
						</div>
					</div>
				</div>
                <div class="col-md-2">
					<div class="finance-box">
						<h5>Total Income :</h5>
						<h3>Rs. <?php echo $tot; ?>/=</h3>
						<hr>
						<a href="Finance_Update_Incomes.php" class="btn btn-success btn-lg btn-block"> View Total Income </a>
                        <br />
                        <h5>Pending Income :</h5>
						<h3>Rs. <?php echo $tot_pen; ?>/=</h3>
						<hr>
						<a href="Finance_Verify_Incomes.php" class="btn btn-success btn-lg btn-block"> View Pending Income </a>
                        <br />
                        <h5>Closed Income :</h5>
						<h3>Rs. <?php echo $tot_close; ?>/=</h3>
						<hr>
						<a href="Finance_Closed_Incomes.php" class="btn btn-success btn-lg btn-block"> View Closed Income </a>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>