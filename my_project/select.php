<?php
// db.php: 데이터베이스 연결 및 기능 모듈화
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

function fetchAllRows($result) {
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// 회원 조회 기능
function getUserData() {
    $con = connectDB();
    $sql = "SELECT * FROM userTBL";
    $result = executePreparedQuery($con, $sql, $params=[]);
    $rows = fetchAllRows($result);
    closeDB($con);
    return $rows;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>회원 조회 결과</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 20px;
      }
      h1 {
         color: #333;
      }
      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }
      th, td {
         border: 1px solid #ddd;
         padding: 8px;
         text-align: left;
      }
      th {
         background-color: #4CAF50;
         color: white;
      }
      tr:nth-child(even) {
         background-color: #f2f2f2;
      }
      a {
         text-decoration: none;
         color: #0066cc;
      }
      a:hover {
         font-weight: bold;
      }
   </style>
</head>
<body>
   <h1>회원 조회 결과</h1>
   <table>
      <tr>
         <th>아이디</th><th>이름</th><th>출생년도</th><th>지역</th><th>극번</th>
         <th>전화번호</th><th>키</th><th>가입일</th><th>수정</th><th>삭제</th>
      </tr>

       <?php
         // 회원 조회 결과 출력
         $userRows = getUserData();
         foreach ($userRows as $row) {
            echo "<tr>";
            echo "<td>", $row['userID'], "</td>";
            echo "<td>", $row['name'], "</td>";
            echo "<td>", $row['birthYear'], "</td>";
            echo "<td>", $row['addr'], "</td>";
            echo "<td>", $row['mobile1'], "</td>";
            echo "<td>", $row['mobile2'], "</td>";
            echo "<td>", $row['height'], "</td>";
            echo "<td>", $row['mDate'], "</td>";
            echo "<td>", "<a href='update.php?userID=" . $row['userID'], "'>수정</a></td>";
            echo "<td>", "<a href='delete.php?userID=", $row['userID'], "'>삭제</a></td>";
            echo "</tr>";
         }
      ?>
   </table>

   <br>
   <a href='main.html'> <--초기 화면</a>
</body>
</html>
