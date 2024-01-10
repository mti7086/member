<?php
include_once 'db.php';

$con = connectDB();

$userID = mysqli_real_escape_string($con, $_GET["userID"]);
$sql = "SELECT * FROM userTBL WHERE userID = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$ret = mysqli_stmt_get_result($stmt);

if ($ret) {
    $count = mysqli_num_rows($ret);
    if ($count == 0) {
        echo $_GET['userID'] . " 아이디의 회원이 없음!!!" . "<br>";
        echo "<br> <a href='main.html'> <--초기 화면</a> ";
        exit();	
    }
} else {
    echo "데이터 조회 실패!!!" . "<br>";
    echo "실패 원인 :" . mysqli_error($con);
    echo "<br> <a href='main.html'> <--초기 화면</a> ";
    exit();
}

$row = mysqli_fetch_array($ret);
$userID = $row['userID'];
$name = $row["name"];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>회원 삭제</title>
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
         background-color: #FF0000;
         color: white;
         cursor: pointer;
      }
      input[type="submit"]:hover {
         background-color: #CC0000;
      }
   </style>
</head>
<body>
   <h1>회원 삭제</h1>
   <form method="post" action="delete_result.php">
      <label for="userID">아이디:</label>
      <input type="text" name="userID" value="<?php echo $userID; ?>" readonly>

      <label for="name">이름:</label>
      <input type="text" name="name" value="<?php echo $name; ?>" readonly>

      <br><br>
      위 회원을 삭제하겠습니까?	
      <input type="submit" value="회원 삭제">
   </form>
   
</body>
</html>