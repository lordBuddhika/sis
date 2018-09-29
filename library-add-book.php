
<?php 
include('DB_Connection.php');
include_once 'staff-header.php'; 

if(isset($_POST["update"])){
$bookid = $_POST["bid"];
$fname = $_POST["fname"];
$aname = $_POST["Aname"];
$isbn = $_POST["ISBN"];
$year = $_POST["year"];
$copies = $_POST["copies"];

$sql_update = "update library_books set fname='$fname',Aname='$aname',book_year='$year',copies='$copies' where BID = '$bookid'";
if($conn->query($sql_update) == true){
	echo "<script>alert('Successfully added')</script>";
	//header('Location : library-add-book.php');
	}
	
	
	
}



$selectQ = "SELECT * FROM library_books";
$res = $conn->query($selectQ);

$select_payment_ids  = "SELECT * FROM library_books";
$payment_res = $conn->query($select_payment_ids);

$hd = "<select name='del_res' id='del_res'>";
$body = "";
$tail = "</select>";
$listBox = "";

if($payment_res->num_rows>0){
	while($myres = $payment_res->fetch_assoc()){
		$payment_id_auto = $myres['BID'];
		$payment_id = $myres['fname'];
		$student_id = $myres['ISBN'];
		$Aname = $myres['Aname'];
		$body = $body .	"<option value='$payment_id_auto'>$payment_id - $student_id </option>";
	}
	$listBox = $hd.$body.$tail;
	
}
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
					
					<div>
					<input type="text" class="form-control" placeholder="Employee name, email, id" aria-label="Recipient's username" aria-describedby="basic-addon2">
					<button class="btn btn-dark" type="button">Search</button>
					
					</div>
					
					
					<div class="tab-content">
					  <div class="tab-pane mt-4 show active">
							<form method="post" action="savemebooks.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Book ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="eid" value="BID215" >
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Title</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="fname" placeholder="" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Author</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="Aname" type="text" required class="form-control" id="Aname" placeholder="">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">ISBN</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="ISBN" type="number" required class="form-control" id="ISBN"  min="1001" max="2000">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Year</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="year" type="number" required class="form-control"  min="2000" max= "2020"  maxid="year" placeholder="" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Copies</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input name="copies" type="number" required class="form-control" id="copies" min="5" max="10"  >
											</div>
										</div>
									</div>
								
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Add Book</button>
									</div>
								</div>
							</form>
  <table width='75%'" border="1">
  <tr>
    <td>#</td>
    <td>Book Id</td>
    <td>Title</td>
    <td>Author</td>
    <td>ISBN</td>
    <td>Year</td>
    <td>Copies</td>
  </tr>
  
  <?php
  
  if($res->num_rows>0){
	  $count = 1;
	  while($row = $res->fetch_assoc()){
		  $BID    = $row['BID'];
		  $fname = $row['fname'];
		  $Aname = $row['Aname'];
		  $SBN = $row['ISBN'];
		  $book_year = $row['book_year'];
		  $copies = $row['copies'];
		  
		  
		  ?>
          
          <tr>
    <td><?php echo $count++; ?></td>
    <td><?php echo $BID; ?></td>
    <td><?php echo $fname;?></td>
    <td><?php echo $Aname; ?></td>
    <td><?php echo $SBN; ?></td>
    <td><?php echo $book_year; ?></td>
    <td><?php echo $copies; ?></td>
	<td><div class="col-sm-10">
    <form action="Book_update.php" method="post">
    		<input type="hidden" value="<?php echo $BID; ?>" name="book_id">
			<button type="submit" name="edit" class="btn btn-dark">Edit</button>
    </form>	
			</div></td>
  </tr>
          
          <?php
		  
		  
		  }
	  
	  ?>
      </table>
      <p>
        <?php
	  
	  }
	  
else{
	
		echo 'no records found';
	}
  
  
  ?>                          
        
        
        
        
      </p>
      <form action="del_books.php" method="post"  >
     <table width="75%" border="1">
	 
	 <form action="book-updt.php" method="post">
	 
			
			
	 </form>
  <tr>
    <td>book id</td>
    <td>action</td>
  </tr>
  
  <?php 
  
  
  
  ?>
  
  
  
  <tr>
    <td><?php echo $listBox;?><td>
    <td><input type="submit" name="button2" id="button2" value="Delete Record" /></td>
  </tr>
</table>
</form>
					  </div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>