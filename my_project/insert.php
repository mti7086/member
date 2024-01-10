<?php
include_once 'db.php';  // 데이터베이스 연결 모듈 포함

function insertUserData($userID, $name, $birthYear, $addr, $mobile1, $mobile2, $height) {
    $con = connectDB();
    
    // SQL 쿼리 작성 (프리페어드 스테이먼트 사용 권장)
    $sql = "INSERT INTO userTBL (userID, name, birthYear, addr, mobile1, mobile2, height) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // 프리페어드 스테이먼트 초기화
    $stmt = mysqli_prepare($con, $sql);
    
    // 바인딩 및 실행
    mysqli_stmt_bind_param($stmt, "sssssss", $userID, $name, $birthYear, $addr, $mobile1, $mobile2, $height);
    $result = mysqli_stmt_execute($stmt);

    // 프리페어드 스테이먼트 종료
    mysqli_stmt_close($stmt);
    
    // 데이터베이스 종료
    closeDB($con);

    return $result;
}

// 폼에서 전송된 데이터 확인 및 회원 입력
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST["userID"];
    $name = $_POST["name"];
    $birthYear = $_POST["birthYear"];
    $addr = $_POST["addr"];
    $mobile1 = $_POST["mobile1"];
    $mobile2 = $_POST["mobile2"];
    $height = $_POST["height"];

    $result = insertUserData($userID, $name, $birthYear, $addr, $mobile1, $mobile2, $height);

    if ($result) {
        echo "회원 입력 성공!";
    } else {
        echo "회원 입력 실패!";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>신규 회원 입력</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 20px;
      }
      h1 {
         color: #333;
      }
      form {
         max-width: 400px;
         margin: 20px auto;
         background-color: #fff;
         padding: 20px;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      label {
         display: block;
         margin-bottom: 8px;
      }
      input {
         width: 100%;
         padding: 10px;
         margin-bottom: 16px;
         border: 1px solid #ccc;
         border-radius: 4px;
         box-sizing: border-box;
      }
      input[type="submit"] {
         background-color: #4CAF50;
         color: white;
         cursor: pointer;
      }
      input[type="submit"]:hover {
         background-color: #45a049;
      }
   </style>
</head>
<body>
   <h1>신규 회원 입력</h1>
   <form method="post" action="insert_result.php">
      <label for="userID">아이디:</label>
      <input type="text" name="userID" required>

      <label for="name">이름:</label>
      <input type="text" name="name" required>

      <label for="birthYear">출생연도:</label>
      <input type="text" name="birthYear" required>

      <label for="addr">지역:</label>
      <input type="text" name="addr" required>

      <label for="mobile1">휴대폰 국번:</label>
      <input type="text" name="mobile1" required>

      <label for="mobile2">휴대폰 전화번호:</label>
      <input type="text" name="mobile2" required>

      <label for="height">신장:</label>
      <input type="text" name="height" required>

      <br><br>
      <input type="submit" value="회원 입력">
   </form>
</body>
</html>
