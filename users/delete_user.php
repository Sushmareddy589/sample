<?php
require "../config.php";
$stmt = $conn->prepare("SELECT employee_id,emp_name,emp_email,emp_username FROM employees");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


 // DELETE FROM $employees WHERE prompt("enter employee name")='';
 if(isset($_GET["employee_id"]))
 { 
  // $emp_name = $_POST['emp_name'];
  $stmt = $conn->prepare("DELETE from employees where employee_id = '" . $_GET["employee_id"]. "'");
   $stmt->execute();
  echo "deleted";

 }  

?> 
<html>
<div align="left">
    <a href="http://localhost/sample/users/users.php">
        <font size="9" color="red">back</font>
    </a>
</div>
</html>