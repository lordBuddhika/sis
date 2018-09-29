<?php
include('DB_Connection.php');

$eid   	 = $_POST['eid'];
$fname     = $_POST['fname'];
$Aname  = $_POST['Aname'];
$ISBN      = $_POST['ISBN'];
$year = $_POST['year'];
$copies = $_POST['copies'];

$inseetQ = "INSERT INTO library_books(fname,Aname,ISBN,book_year,copies)
VALUES('$fname','$Aname','$ISBN','$year','$copies')";

$result = $conn->query($inseetQ);

header('location: library-add-book.php');


?>