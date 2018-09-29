<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="staff-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="staff-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a href="staff-departments.php" class="nav-item nav-link disabled">Departments</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link active">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Departments Analysis</div>
										<div class="card-body">
											<p class="card-text">View employees spread over departments.</p>
											<form action="staff-reports-employeement-history.php" method="get">
												<div class="form-group">
													<small class="form-text text-muted">Start Date</small>
													<input type="date" name="startdate" class="form-control">
												</div>
												<div class="form-group">
													<small class="form-text text-muted">End Date</small>
													<input type="date" name="enddate" class="form-control">
												</div>
												<button class="btn btn-dark btn-block" type="submit">View Report</button>
											</form>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Employeement History</div>
										<div class="card-body">
											<p class="card-text">View employee recruitments.</p>
											<form action="staff-reports-employment-history.php" method="get">
												<button class="btn btn-dark btn-block" type="submit">View Report</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
