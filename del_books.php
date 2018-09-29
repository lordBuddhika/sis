<?php
include('DB_Connection.php');

$del_res = $_POST['del_res'];
if($del_res != ""){
	$delete_rec = "DELETE FROM library_books WHERE BID= '$del_res'";
	$result = $conn->query($delete_rec);	
}

header('location: library-add-book.php');


?>