<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>회원 삭제 결과</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 20px;
      }
      h1 {
         text-align: center;
         color: #333;
      }
      div.result {
         max-width: 400px;
         margin: 20px auto;
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
   <h1>회원 삭제 결과</h1>
   <div class="result">
      <?php
      include_once 'db.php';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $con = connectDB();

          $userID = mysqli_real_escape_string($con, $_POST["userID"]);
          $result = getUserByID($userID, $con);
          $count = mysqli_num_rows($result);

          if ($count == 0) {
              echo $userID . " 아이디의 회원이 없음!!!<br>";
              echo "<br> <a href='main.html'> <--초기 화면</a> ";
              closeDB($con);
              exit();
          }

          $ret = deleteUser($userID, $con);

          if ($ret) {
              echo "<div class='success'>" . $userID . " 회원이 성공적으로 삭제됨.</div>";
          } else {
              echo "<div class='failure'>데이터 삭제 실패!!!<br>실패 원인 :" . mysqli_error($con) . "</div>";
          }
          closeDB($con);
      }
      ?>
   </div>
   <br>
   <a href='main.html'> <--초기 화면</a>
</body>
</html>