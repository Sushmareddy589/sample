<?php
require "../config.php";
$stmt = $conn->prepare("SELECT employee_id,emp_name,emp_email,emp_username FROM employees");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html>

<head>
    <title>Employee Registration</title>
    
</head>

<body>
    <div>

        <div>
            <div>
                Employee Registration
            </div>
            <div align="center">
                <a href="http://localhost/sample/users/users.php">
                    click here for employee list
                </a>
            </div>
            <form action="" method="POST">
                <div class="form-element">
                    <label>
                        Employee Name
                    </label>
                    <input type="text" name="emp_name" value="">
                </div>
                <div class="form-element">
                    <label>
                        User Name
                    </label>
                    <input type="text" name="emp_username" value="">
                </div>
                <div class="form-element">
                    <label>
                        Employee Email
                    </label>
                    <input type="email" name="emp_email" value="">
                </div>
                <div class="form-element">
                    <label>
                        Employee Password
                    </label>
                    <input type="password" name="emp_password" value="">
                </div>
                <div class="form-element">

                    <input type="submit" name="emp_submit_form" value="Submit Form">
                </div>
            </form>
        </div>
    </div>
</body>

</html>

 <?php
if (isset($_POST['emp_submit_form'])) {
    $emp_name = $_POST['emp_name'];
    $emp_username = $_POST['emp_username'];
    $emp_email = $_POST['emp_email'];
    $emp_password = $_POST['emp_password'];
    //SELECT
    //To check whether the same username or email already exist in the DB
    $stmt = $conn->prepare("SELECT count(*) from employees where emp_username = '" . $emp_username . "' OR emp_email = '" . $emp_email . "'");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if ($result > 0) {
        echo "This Username/Email already exist in the database. Please try with a different username/email!";
    } else {
        try {
            //INSERT
            $sql = "INSERT INTO employees (emp_name, emp_username, emp_email, emp_password)
                VALUES ('$emp_name', '$emp_username', '$emp_email', '$emp_password')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "New record created successfully";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>