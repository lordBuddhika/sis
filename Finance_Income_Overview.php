<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    		$sql_tot = "SELECT * FROM incomes";
			$result_tot=mysqli_query($conn,$sql_tot);
			$row_tot=mysqli_num_rows($result_tot);
			
			$sql_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM incomes");
			$result_max = mysqli_fetch_assoc($sql_max); 
			$row_max = $result_max['maximum'];
			$row_del = $row_max - $row_tot;
			
			$sql_close = "SELECT * FROM incomes where status='closed'";
			$result_close=mysqli_query($conn,$sql_close);
			$row_close=mysqli_num_rows($result_close);
			
			$sql_pen = "SELECT * FROM incomes where status='pending'";
			$result_pen=mysqli_query($conn,$sql_pen);
			$row_pen=mysqli_num_rows($result_pen);
	
	 

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a class="nav-item nav-link active"> Income Overview </a>
							<a href="Finance_Add_Incomes.php" class="nav-item nav-link"> Add Incomes </a>
                            <a href="Finance_Update_Incomes.php" class="nav-item nav-link"> Update Incomes </a>
                            <a href="Finance_Delete_Incomes.php" class="nav-item nav-link"> Delete Incomes </a>
                            <a href="Finance_Verify_Incomes.php" class="nav-item nav-link"> Verify Incomes </a>
                            <a href="Finance_Closed_Incomes.php" class="nav-item nav-link"> Closed Incomes </a>
							<a class="nav-item nav-link disabled"> Income Reports </a>				
						</div>
					</nav>
                    
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                        	<div class="card bg-light mb-4">
								<div class="card-header">Income Overview</div>
								<div class="card-body">
							<ul class="ca-menu">
									<li>
										<a href="Finance_Update_Incomes.php">
											
											<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main"><?php echo $row_tot; ?></h4>
												<h3 class="ca-sub"> Total Incomes </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Delete_Incomes.php">
										  <i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one"><?php echo $row_del; ?></h4>
												<h3 class="ca-sub one"> Deleted Incomes </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Closed_Incomes.php">
											<i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two"><?php echo $row_close; ?></h4>
												<h3 class="ca-sub two"> Closed Incomes </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Verify_Incomes.php">
											<i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three"><?php echo $row_pen; ?></h4>
												<h3 class="ca-sub three"> Pending Incomes </h3>
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