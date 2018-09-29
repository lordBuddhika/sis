<?php
if($_SERVER["REQUEST_METHOD"] == "GET") 
$user = $_GET["user"];

?>

<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Success International School | Dashboard</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/Finance_Style.css">
	</head>
	<body>
				<div class="col-md-5">
					
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
								<div class="row">
									<div class="col-md-4">
                                            <?php
												include "DB_Connection.php";
												$sql_view = "select * from users where userid='$user'";
												$result = $conn->query($sql_view);
												$row = $result->fetch_assoc();
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col" colspan="2"><center><h1> Staff Details </h1></center></th> 
															</tr>
														</thead>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Staff ID </th>
																<td><?php echo $row["userid"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"> Staff Name</th>
																<td><?php echo $row["fname"]." ".$row["lname"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Staff E-Mail </th>
																<td><?php echo $row["email"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"> Staff Mobile No. </th>
																<td><?php echo $row["mobile_no"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Staff Address </th>
																<td><?php echo $row["address"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"> Staff Date of Birth </th>
																<td><?php echo $row["dob"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Staff NIC No. </th>
																<td><?php echo $row["nic"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <?php
														$gender = "";
														 if($row["gender"] == 1)
														 $gender = "Male";
														 else
														 $gender = "Female"; 
														 ?>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"> Staff Gender </th>
																<td><?php echo $gender; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Staff Joined Date </th>
																<td><?php echo $row["reg_date"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                            <?php
													echo "</table>";
													
											
													$conn->close();
												}else{
											?>
													<table class="table table-bordered">
													<thead class="odd">
															<tr>
																<th scope="col" colspan="2"><center><h1> No Staff Details Available </h1></center></th> 
															</tr>
														</thead>
                                                   	</table>
											<?php		}
												 
											?>
											
									</div>
								</div>
						</div>
					</div>
				</div>
 

 
</div>
		</div>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/cash_flow.js"></script>
	</body>
</html>