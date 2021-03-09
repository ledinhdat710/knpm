<?php
try {
    $mysqli = new mysqli("localhost", "root", "", "demo");


    $statement = $mysqli->prepare("select * from user");


    $statement->execute();
    $result = $statement->get_result();

    // echo json_encode(($result->fetch_assoc())); 



    $json = "[";
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        if ($i == 0) {
            $json .= '{"user_full" : "' . $row["user_full"] . '" }';
        } else {
            $json .= ', {"user_full" : "' . $row["user_full"] . '" }';
        }
        $i++;
    }
    $json .= "]";

    echo $json;
} catch (mysqli_sql_exception $e) { // Failed to connect? Lets see the exception details..
    echo "MySQLi Error Code: " . $e->getCode() . "<br />";
    echo "Exception Msg: " . $e->getMessage();
    exit(); // exit and close connection.
}

$mysqli->close();
?>