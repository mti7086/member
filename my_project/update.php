<?php
include_once 'db.php';

$con = connectDB();

$userID = mysqli_real_escape_string($con, $_GET['userID']);
$sql ="SELECT * FROM userTBL WHERE userID='$userID'";
$ret = mysqli_query($con, $sql);

if (!$ret) {
    echo "데이터 조회 실패!!!"."<br>";
    echo "실패 원인: " . mysqli_error($con);
    echo "<br> <a href='main.html'> <--초기 화면</a> ";
    exit();
}

$count = mysqli_num_rows($ret);

if ($count == 0) {
    echo $userID . " 아이디의 회원이 없음!!!" . "<br>";
    echo "<br> <a href='main.html'> <--초기 화면</a> ";
    exit();
}

$row = mysqli_fetch_array($ret);

$userID = $row['userID'];
$name = $row["name"];
$birthYear = $row["birthYear"];
$addr = $row["addr"];
$mobile1 = $row["mobile1"];
$mobile2 = $row["mobile2"];
$height = $row["height"];
$mDate = $row["mDate"];

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>회원 정보 수정</title>
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
   <h1>회원 정보 수정</h1>
   <form method="post" action="update_result.php">
      <label for="userID">아이디:</label>
      <input type="text" name="userID" value="<?php echo $userID; ?>">

      <label for="name">이름:</label>
      <input type="text" name="name" value="<?php echo $name; ?>">

      <label for="birthYear">출생년도:</label>
      <input type="text" name="birthYear" value="<?php echo $birthYear; ?>">

      <label for="addr">지역:</label>
      <input type="text" name="addr" value="<?php echo $addr; ?>">

      <label for="mobile1">휴대폰 국번:</label>
      <input type="text" name="mobile1" value="<?php echo $mobile1; ?>">

      <label for="mobile2">휴대폰 전화번호:</label>
      <input type="text" name="mobile2" value="<?php echo $mobile2; ?>">

      <label for="height">신장:</label>
      <input type="text" name="height" value="<?php echo $height; ?>">

      <label for="mDate">회원가입일:</label>
      <input type="text" name="mDate" value="<?php echo $mDate; ?>" readonly>

      <br><br>
      <input type="submit" value="정보 수정">
   </form>
</body>
</html>