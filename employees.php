<?php

define('DB_SERVER', 'ponderadaprog.cqbe662n8w52.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', '12345678');
define('DB_DATABASE', 'ponderadaprog1');
?>
[ec2-user@ip-172-31-95-166 inc]$ cat ../html/SamplePage.php
<?php include "../inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employee Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Employee Management</h1>
    
    <?php
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        if (mysqli_connect_errno()) die("<p>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>");
        $database = mysqli_select_db($connection, DB_DATABASE);
        VerifyEmployeesTable($connection, DB_DATABASE);
    
        $employee_name = htmlentities($_POST['NAME'] ?? '');
        $employee_address = htmlentities($_POST['ADDRESS'] ?? '');
        $employee_age = intval($_POST['AGE'] ?? 0);
        $join_date = htmlentities($_POST['JOIN_DATE'] ?? '');
    
        if ($employee_name && $employee_address && $employee_age > 0 && $join_date) {
            AddEmployee($connection, $employee_name, $employee_address, $employee_age, $join_date);
            echo "<p style='color:green;'>Employee added successfully!</p>";
        }
    ?>
    
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <label>NAME:</label>
        <input type="text" name="NAME" maxlength="45" required>
        
        <label>ADDRESS:</label>
        <input type="text" name="ADDRESS" maxlength="90" required>
        
        <label>AGE:</label>
        <input type="number" name="AGE" min="18" required>
        
        <label>JOIN DATE:</label>
        <input type="date" name="JOIN_DATE" required>
        
        <input type="submit" value="Add Employee">
    </form>
    
    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>ADDRESS</th>
            <th>AGE</th>
            <th>JOIN DATE</th>
        </tr>
        <?php
            $result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");
            while ($query_data = mysqli_fetch_row($result)) {
                echo "<tr>",
                     "<td>{$query_data[0]}</td>",
                     "<td>{$query_data[1]}</td>",
                     "<td>{$query_data[2]}</td>",
                     "<td>{$query_data[3]}</td>",
                     "<td>{$query_data[4]}</td>",
                     "</tr>";
            }
        ?>
    </table>
    
    <?php
        mysqli_free_result($result);
        mysqli_close($connection);
    ?>
</body>
</html>

<?php
function AddEmployee($connection, $name, $address, $age, $join_date) {
    $n = mysqli_real_escape_string($connection, $name);
    $a = mysqli_real_escape_string($connection, $address);
    $age = intval($age);
    $jd = mysqli_real_escape_string($connection, $join_date);

    $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS, AGE, JOIN_DATE) VALUES ('$n', '$a', '$age', '$jd');";

    if (!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

function VerifyEmployeesTable($connection, $dbName) {
    if (!TableExists("EMPLOYEES", $connection, $dbName)) {
        $query = "CREATE TABLE EMPLOYEES (
            ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR(45),
            ADDRESS VARCHAR(90),
            AGE INT,
            JOIN_DATE DATE
        )";

        if (!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
    }
}

function TableExists($tableName, $connection, $dbName) {
    $t = mysqli_real_escape_string($connection, $tableName);
    $d = mysqli_real_escape_string($connection, $dbName);

    $checktable = mysqli_query($connection, "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");
    return mysqli_num_rows($checktable) > 0;
}
?>
