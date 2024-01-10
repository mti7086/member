<?php
include_once 'db.php'; // 데이터베이스 접속 정보를 포함하는 별도의 파일

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // 예외 활성화

$output = '';
try {
    $con = new mysqli("localhost", $dbUser, $dbPassword, $dbName);
    $output .= "연결 성공!<br>";

    // 테이블 상태 확인
    if ($con->query("SHOW TABLES LIKE 'userTBL'")->num_rows == 1) {
        $output .= "'userTBL' 테이블이 존재합니다.<br>";
    } else {
        $output .= "'userTBL' 테이블이 존재하지 않습니다.<br>";
    }

    // 쿼리 실행 상태 확인
    if ($result = $con->query("SELECT COUNT(*) FROM userTBL")) {
        $count = $result->fetch_row();
        $output .= "userTBL에는 현재 {$count[0]}개의 레코드가 있습니다.<br>";
        $result->close();
    }

} catch (mysqli_sql_exception $e) {
    $output .= "문제가 발생했습니다: " . $e->getMessage() . "<br>";
} finally {
    if (isset($con) && $con->connect_error === null) {
        $con->close();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <title>연결 상태 확인</title>
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
   <h1>트러블슈팅 결과</h1>
   <div><?php echo $output; ?></div>
   <a href='main.html'> <--초기 화면</a>
</body>
</html>