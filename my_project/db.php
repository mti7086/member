<?php
$dbUser = 'root';
$dbPassword = '1234';
$dbName = 'sqlDB';

function connectDB() {
    $con = mysqli_connect("localhost", "root", "1234", "sqlDB");
    if (!$con) {
        die("MySQL 접속 실패: " . mysqli_connect_error());
    }
    return $con;
}

function closeDB($con) {
    mysqli_close($con);
}

function getUserByID($userID, $con) {
    $sql = "SELECT * FROM userTBL WHERE userID=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function deleteUser($userID, $con) {
    $sql = "DELETE FROM userTBL WHERE userID=?";
    
    // 프리페어드 스테이먼트 초기화
    $stmt = mysqli_prepare($con, $sql);
    
    // 바인딩 및 실행
    mysqli_stmt_bind_param($stmt, "s", $userID);
    $result = mysqli_stmt_execute($stmt);

    // 프리페어드 스테이먼트 종료
    mysqli_stmt_close($stmt);

    return $result; 
}

function executePreparedQuery($con, $sql, $params=[]) {
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        echo "쿼리 준비 실패: " . mysqli_error($con);
        exit();
    }
    if (count($params)) {
        mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
    }
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>
