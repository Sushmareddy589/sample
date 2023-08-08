<?php
require "../config.php";
$stmt = $conn->prepare("SELECT employee_id,emp_name,emp_email,emp_username FROM employees");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


// if ($_SERVER["REQUEST_METHOD"] == "POST") { 
//     // Retrieve form data 
//     $employee_id = $_POST["employee_id"]; $emp_name = $_POST["emp_name"]; $emp_email = $_POST["emp_email"]; $emp_username = $_POST["emp_username"]; 
//     // Update user data in the database 
//     $sql = "UPDATE employees SET emp_name=?, emp_email=?, emp_username=? WHERE employee_id=?"; $stmt = $conn->prepare($sql); 
//     if ($stmt->execute([$emp_name, $emp_email, $emp_username, $employee_id]))
//      { echo "Record updated successfully."; } 
//      else { echo "Error updating record: " . $stmt->errorInfo()[2]; } }
 // UPDATE 'employees' SET prompt(enter value) =

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $employee_id = $_POST["employee_id"];
    $emp_name = $_POST["emp_name"];
    $emp_email = $_POST["emp_email"];
    $emp_username = $_POST["emp_username"];

    try {
        $sql = "UPDATE employees SET emp_name=?, emp_email=?, emp_username=? WHERE employee_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$emp_name, $emp_email, $emp_username, $employee_id]);

        echo "Record updated successfully.";
    } catch (PDOException $e) {
        echo "Error updating record: " . $e->getMessage();
    }
}

if (isset($_GET["employee_id"])) {
    $employee_id = $_GET["employee_id"];

    try {
        $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
        $stmt->execute([$employee_id]);
        $result = $stmt->fetch();

        if ($result) {
            $emp_name = $result['emp_name'];
            $emp_email = $result['emp_email'];
            $emp_username = $result['emp_username'];
        } else {
            echo "Employee not found.";
        }
    } catch (PDOException $e) {
        echo "Error retrieving employee data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>employee_id:</label>
    <input type="text" name="employee_id" value="<?php echo $employee_id; ?>"><br>

    <label>emp_name:</label>
    <input type="text" name="emp_name" value="<?php echo $emp_name; ?>"><br>

    <label>emp_email:</label>
    <input type="text" name="emp_email" value="<?php echo $emp_email; ?>"><br>

    <label>emp_username:</label>
    <input type="text" name="emp_username" value="<?php echo $emp_username; ?>"><br>

    <input type="submit" class="button" name="submit" value="Update">
</form>
</html>




