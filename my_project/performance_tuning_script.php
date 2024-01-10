<?php
include_once 'db.php'; // 데이터베이스 접속 정보를 포함하는 별도의 파일

// 데이터베이스 연결
try {
    $con = new mysqli("localhost", $dbUser, $dbPassword, $dbName);
    if ($con->connect_error) {
        throw new Exception("Connection failed: " . $con->connect_error);
    }

    // 슬로우 쿼리 로그 확인
    $slowQueryLog = $con->query("SHOW VARIABLES LIKE 'slow_query_log'")->fetch_assoc();
    $output = "Slow Query Log 상태: " . $slowQueryLog['Value'] . "<br>";

    // 인덱스 사용성 분석
    $explainQuery = $con->query("EXPLAIN SELECT * FROM userTBL WHERE userID = 'BBK'");
    while ($row = $explainQuery->fetch_assoc()) {
        $output .= "Table: " . $row['table'] . ", Type: " . $row['type'] . ", Possible Keys: " . $row['possible_keys'] . "<br>";
    }

    // 서버 상태 변수 확인
    $statusVariable = $con->query("SHOW STATUS LIKE 'Threads_connected'")->fetch_assoc();
    $output .= "현재 연결된 스레드 수: " . $statusVariable['Value'] . "<br>";

    // 로그 기록
    file_put_contents('performance_log.txt', $output, FILE_APPEND);

} catch (Exception $e) {
    $output = "Error: " . $e->getMessage();
} finally {
    if (isset($con) && $con->connect_error === null) {
        $con->close();
    }
}

// HTML 출력
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>데이터베이스 성능 튜닝</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        padding: 20px;
    }
    h1 {
        color: #333;
        text-align: center;
    }
    div {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    a {
        display: inline-block;
        padding: 10px 15px;
        text-decoration: none;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    a:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    <h1>데이터베이스 성능 튜닝 결과</h1>
    <div><?php echo $output; ?></div>
    <a href='main.html'> <--초기 화면</a>
</body>
</html>
