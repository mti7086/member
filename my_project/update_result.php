<?php
include_once 'db.php';

$con = connectDB();

$userID = mysqli_real_escape_string($con, $_POST["userID"]);
$name = mysqli_real_escape_string($con, $_POST["name"]);
$birthYear = mysqli_real_escape_string($con, $_POST["birthYear"]);
$addr = mysqli_real_escape_string($con, $_POST["addr"]);
$mobile1 = mysqli_real_escape_string($con, $_POST["mobile1"]);
$mobile2 = mysqli_real_escape_string($con, $_POST["mobile2"]);
$height = mysqli_real_escape_string($con, $_POST["height"]);
$mDate = mysqli_real_escape_string($con, $_POST["mDate"]);

$sql = "UPDATE userTBL SET name=?, birthYear=?, addr=?, mobile1=?, mobile2=?, height=?, mDate=? WHERE userID=?";
$stmt = mysqli_prepare($con, $sql);

mysqli_stmt_bind_param($stmt, "ssssssss", $name, $birthYear, $addr, $mobile1, $mobile2, $height, $mDate, $userID);
$ret = mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
closeDB($con);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>회원 정보 수정 결과</title>
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
      .success {
         color: #008000;
      }
      .failure {
         color: #FF0000;
      }
      a {
         text-decoration: none;
         color: #0066cc;
      }
   </style>
</head>
<body>
   <h1>회원 정보 수정 결과</h1>
   <div class="result">
      <?php
         if($ret) {
         echo "<div class='success'>데이터가 성공적으로 수정됨.</div>";
         } else {
         echo "<div class='failure'>데이터 수정에 실패하였습니다. 관리자에게 문의해주세요.</div>";
         } 
      ?>
   </div>
   <br>
   <a href='main.html'> <--초기 화면</a>
</body>
</html>
