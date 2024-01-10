<?php
include_once 'db.php';

function insertUserData($con, $userID, $name, $birthYear, $addr, $mobile1, $mobile2, $height, $mDate) {
    $sql = "INSERT INTO userTbl VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $userID, $name, $birthYear, $addr, $mobile1, $mobile2, $height, $mDate);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

$con = connectDB();

$userID = $_POST["userID"];
$name = $_POST["name"];
$birthYear = $_POST["birthYear"];
$addr = $_POST["addr"];
$mobile1 = $_POST["mobile1"];
$mobile2 = $_POST["mobile2"];
$height = $_POST["height"];
$mDate = date("Y-m-j");

$result = insertUserData($con, $userID, $name, $birthYear, $addr, $mobile1, $mobile2, $height, $mDate);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>신규 회원 입력 결과</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 20px;
      }
      h1 {
         color: #333;
      }
      div.result {
         max-width: 400px;
         margin: 20px auto;
         background-color: #fff;
         padding: 20px;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      div.success {
         color: #008000;
      }
      div.failure {
         color: #FF0000;
      }
      a {
         text-decoration: none;
         color: #0066cc;
      }
   </style>
</head>
<body>
   <h1>신규 회원 입력 결과</h1>
   <div class="result">
      <?php
         if($result) {
            echo "<div class='success'>데이터가 성공적으로 입력됨.</div>";
         } else {
            echo "<div class='failure'>데이터 입력 실패!!!<br>실패 원인: " . mysqli_error($con) . "</div>";
         } 
      ?>
   </div>
   <br>
   <a href='main.html'> <--초기 화면</a>
</body>
</html>
