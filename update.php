<?php
include 'connect.php';

try {

    if (isset($_POST['updateid'])) {
        $user_id = $_POST['updateid'];

        $stmt = $con->prepare("Select * from `crud` where id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // $sql = "Select * from `crud` where id = $user_id";

        // $result = mysqli_query($con, $sql);
        // $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = 404;
        $response['message'] = "Invalid or data not found";
    }

    // update query

    if (isset($_POST['hiddendata'])) {
        $uniqueid = $_POST['hiddendata'];
        $name = $_POST['updatename'];
        $email = $_POST['updateemail'];
        $mobile = $_POST['updatemobile'];
        $place = $_POST['updateplace'];

        $stmt = $con->prepare("UPDATE `crud` set name = ?, email = ?, mobile = ?, place = ? where id = ?");
        $stmt->bind_param("ssssi", $name, $email, $mobile, $place, $uniqueid);
        $stmt->execute();
    }
} catch (\Exception $e) {
    echo json_encode(['status' => 500, 'message => exception caught: ' . $e->getMessage()]);
}
