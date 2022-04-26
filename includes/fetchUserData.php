<?php

session_start();

if (!isset($_SESSION['logged']) || !isset($_SESSION['isAdmin'])) {
    // header("location: " . $baseURL);
    echo "error=unauthorized";
    exit();
}

require_once "db.info.php";
require_once "functions.php";

// if (!isset($_POST['submit'])) {
//     // header("location: " . $baseURL);
//     echo "error=notEnoughVariables";
//     exit();
// }

// echo "henlo\n";
// echo $_GET['henlo'];
// echo $_POST['submit'] . $_POST['user'];

// GET USER DATA
$sql = "SELECT * FROM users WHERE userID = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo ("error=noUsersFound");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $_POST['user']);
mysqli_stmt_execute($stmt);
// echo "henlo\n";

// $userID = -1;
$resultData = mysqli_stmt_get_result($stmt);
if ($row = mysqli_fetch_assoc($resultData)) {

    $userFirstName = decrypt($row["userFirstName"]);
    $userLastName = decrypt($row["userLastName"]);
    $userUsername = decrypt($row["userUsername"]);
    $userEmail = decrypt($row["userEmail"]);

    echo '{"firstName": "' . $userFirstName . '","lastName": "' . $userLastName . '","username": "' . $userUsername . '","email": "' . $userEmail . '"}';
} else {
    echo "error=noUsersFound";
}
exit();
