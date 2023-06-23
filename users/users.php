<?php
require "../config.php";
$stmt = $conn->prepare("SELECT employee_id,emp_name,emp_email,emp_username FROM employees");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


?> 
<!DOCTYPE html>
<html>

<body>


    <table border="1px">
        <thead>
            <td>
                Emp ID
            </td>
            <td>
                Emp Name
            </td>
            <td>
                Emp Email
            </td>
            <td>
                Emp Username
            </td>
            <td>
                action
            </td>



        </thead>

        <tbody>


            <?php
        // checking wether data found
            if ($stmt->fetch()) {

              // printing user data
                while ($data = $stmt->fetch()) {

            ?>
                    <tr>

                        <td><?php echo $data['employee_id']; ?> </td>
                        <td><?php echo $data['emp_name']; ?> </td>
                        <td><?php echo $data['emp_email']; ?> </td>
                        <td><?php echo $data['emp_username']; ?> </td>
                        <td>
                            <a href="update.php?employee_id=<?php echo $data['employee_id']; ?>">update</a>
                            <a href="delete.php?employee_id=<?php echo $data['employee_id']; ?>">delete </a>

                        </td>
                    </tr>
        </tbody>
<?php
                }
            } 
            else {
                echo " User not Found !!";
            }
?>
    </table>

</body>

<div align="left">
    <a href="http://localhost/first/employees.php">
        <font size="9" color="red">back</font>
    </a>
</div>


</html>