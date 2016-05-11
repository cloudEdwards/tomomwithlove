<?php

function mysqlConnect() {
    $servername = $GLOBALS['DB_SERVER'];
    $username = $GLOBALS['DB_USER'];
    $password = $GLOBALS['DB_PASS'];
    $dbname = "tomomwithlove";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        return "Connection failed: " . $conn->connect_error;
    } 

    return $conn;
}

function mysqlCloseConnect($conn) {
    $conn->close();
}

function mysqlRealCleanString($data) {
    $conn = mysqlConnect();
    $clean_data = array();

    foreach ($data as $key => $value) {
        $clean_data[$key]= $conn->real_escape_string($value);
    }
    mysqlCloseConnect($conn);
    
    return $clean_data;
}

function mysqlQuery($sql) {
    $conn = mysqlConnect();

    $results = $conn->query($sql);
    $results_array = array();

    if ( ! is_bool($results)) {

        while ($row = mysqli_fetch_array($results)) 
        {
            $results_array[]= $row;
        }

        if ( ! empty($results_array)) {
            return $results_array;
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    return $results;
}