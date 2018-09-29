<?php

//$pid = $_POST['pid'];
//$sid = $_POST['sid'];
//$payment_for = $_POST['payment_for'];
//$fee = $_POST['fee'];
//$remarks = $_POST['remarks'];

		  $BID   = $_POST['BID'];
		  $fname = $_POST['fname'];
		  $Aname = $_POST['Aname'];
		  $SBN   = $_POST['ISBN'];


			include "DB_Connection.php";
			
$sql = "UPDATE addbooks SET BID='$sid', fname='$fname', Aname='$Aname', ISBN='$SBN' WHERE BID='$BID'";
		if ($conn->query($sql)) {
			header('Location: library-add-book.php');
		} else {
			echo "Error updating record: " . $db_con->error;
		}

?>