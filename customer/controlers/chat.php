<?php
require './conn.php';



    $result = array();
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $from = isset($_POST['from']) ? $_POST['from'] : null;

    if (!empty($message) && !empty($from)) {
        $sql = "INSERT INTO `chat` (`message`,`from`) VALUES ('".$message."', '".$from."')";
        $result['send_status'] = $conn->query($sql);

    }
    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $items = $conn->query("SELECT * FROM `chat` WHERE `id` > " . $start);
    while($row = $items->fetch_assoc()){
        $result['items'][] = $row;
    }

    $conn->close();

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    echo json_encode($result);
