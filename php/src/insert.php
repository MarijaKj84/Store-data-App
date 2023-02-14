<!DOCTYPE html>
<html>

<head>
    <title>Insert Page page</title>
</head>

<body>
<center>
    <?php
        // The MySQL service named in the docker-compose.yml.
        $host = 'db';
        $host1 = 'novo';
        // Database use name
        $user = 'MYSQL_USER';
        //database user password
        $pass = 'MYSQL_PASSWORD';
        // database name
        $mydatabase = 'MYSQL_DATABASE';
        // check the mysql connection status
        $conn = new mysqli($host, $user, $pass, $mydatabase);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "Connected to MySQL server/database successfully!\n";
        }

        // Taking all 5 values from the form data(input)
        $first_name =  $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $gender =  $_REQUEST['gender'];
        $address = $_REQUEST['address'];
        $email = $_REQUEST['email'];

        //Check if there are Tables in database
        $sql = "SHOW TABLES IN `MYSQL_DATABASE`";
        $result = $conn->query($sql);
        if($result !== false) {
        // if at least one table in result
        if($result->num_rows > 0) {
            // traverse the $result and output the name of the table(s)
            while($row = $result->fetch_assoc()) {
                echo '<br />'. $row['Tables_in_MYSQL_DATABASE'];
            }
        }
        else {
            echo 'There is no tables in "MYSQL_DATABASE"';
            $sql = "CREATE TABLE College (firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL,
                    gender VARCHAR(50), address VARCHAR(100), email VARCHAR(50))";
            if ($conn->query($sql) === TRUE) {
                echo "Table College created successfully";
            } else {
                echo "Error creating table: " . $conn->error;
            }
        }
    }
    else 
        echo 'Unable to check the "MYSQL_DATABASE", error - '. $conn->error;

    // Performing insert query execution
    $sql = "INSERT INTO College VALUES ('$first_name','$last_name','$gender','$address','$email')";

    if(mysqli_query($conn, $sql)){
        echo "<h3>Data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>";

        echo nl2br("\n$first_name\n $last_name\n "
            . "$gender\n $address\n $email");
    } else{
        echo "ERROR: Sorry $sql. "
            . mysqli_error($conn);
    }
    // Close connection
    mysqli_close($conn);
    ?>
</center>
</body>

</html>
