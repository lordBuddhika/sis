<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    		$sql_tot = "SELECT * FROM expenses";
			$result_tot=mysqli_query($conn,$sql_tot);
			$row_tot=mysqli_num_rows($result_tot);
			
			$sql_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM expenses");
			$result_max = mysqli_fetch_assoc($sql_max); 
			$row_max = $result_max['maximum'];
			$row_del = $row_max - $row_tot;
			
			$sql_close = "SELECT * FROM expenses where status='closed'";
			$result_close=mysqli_query($conn,$sql_close);
			$row_close=mysqli_num_rows($result_close);
			
			$sql_pen = "SELECT * FROM expenses where status='pending'";
			$result_pen=mysqli_query($conn,$sql_pen);
			$row_pen=mysqli_num_rows($result_pen);
	
	 

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        
                            <a class="nav-item nav-link active"> Expenses Overview </a>
                        	<a href="Finance_Add_Expenses.php" class="nav-item nav-link"> Add Expenses </a>
                            <a href="Finance_Update_Expenses.php" class="nav-item nav-link"> Update Expenses </a>
                            <a href="Finance_Delete_Expenses.php" class="nav-item nav-link"> Delete Expenses </a>
                            <a href="Finance_Verify_Expenses.php" class="nav-item nav-link"> Verify Expenses </a>
                            <a href="Finance_Closed_Expenses.php" class="nav-item nav-link"> Closed Expenses </a>
                            <a class="nav-item nav-link active"> Expenses Overview </a>
							<a class="nav-item nav-link disabled"> Expenses Reports </a>				
						</div>
					</nav>
                    
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                        	<div class="card bg-light mb-4">
								<div class="card-header">Income Overview</div>
								<div class="card-body">
							<ul class="ca-menu">
									<li>
										<a href="Finance_Update_Expenses.php">
											
											<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main"><?php echo $row_tot; ?></h4>
												<h3 class="ca-sub"> Total Expenses </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Delete_Expenses.php">
										  <i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one"><?php echo $row_del; ?></h4>
												<h3 class="ca-sub one"> Deleted Expenses </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Closed_Expenses.php">
											<i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two"><?php echo $row_close; ?></h4>
												<h3 class="ca-sub two"> Closed Expenses </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Verify_Expenses.php">
											<i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three"><?php echo $row_pen; ?></h4>
												<h3 class="ca-sub three"> Pending Expenses </h3>
											</div>
										</a>
									</li>
								</ul>
                                </div>
                                </div>
                                </div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>