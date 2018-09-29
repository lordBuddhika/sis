
<?php 
include 'DB_Connection.php';
include_once 'staff-header.php'; 



if(isset($_POST["edit"])){
	$id = $_POST["book_id"];
	
	$sql = "select * from library_books where BID = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	
?>


				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="library-add-member.php" class="nav-item nav-link disabled">Add Member</a>
							<a href="library-search-members.php" class="nav-item nav-link disabled">Search Members</a>
							<a class="nav-item nav-link active">Add Book</a>
							<a href="library-search-books.php" class="nav-item nav-link disabled">Search Books</a>
							<a href="library-borrow-books.php" class="nav-item nav-link disabled">Book Borrows</a>
							<a href="library-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="library-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
					  <div class="tab-pane mt-4 show active">
							<form method="post" action="library-add-book.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Book ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="bid" value="<?php echo $row["BID"]; ?>" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Title</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="fname" value="<?php echo $row["fname"]; ?>" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Author</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="Aname" type="text" required class="form-control" value="<?php echo $row["Aname"]; ?>" id="Aname" placeholder="">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">ISBN</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="ISBN" type="text" required class="form-control" id="ISBN" min="1001" max="2000" value="<?php echo $row["ISBN"]; ?>" placeholder="">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Year</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="year" type="text" required class="form-control" value="<?php echo $row["book_year"]; ?>" id="year"  min="2000" max= "2020" placeholder="" >
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Copies</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="copies" type="text" required class="form-control" value="<?php echo $row["copies"]; ?>" min="5" max="10" id="copies" placeholder="">
											</div>
										</div>
									</div>
								
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button name="update" type="submit" class="btn btn-dark">Update Book</button>
									</div>
								</div>
							</form>

	  
	  }                        
        
 <?php } ?>       

					  </div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>