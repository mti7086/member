<?php
include_once 'db.php'; // DB 설정을 별도의 파일에서 불러오도록 변경

$con = connectDB();

$backupDir = "C:\\xampp\\htdocs\\backup\\"; // 백업 파일을 저장할 디렉토리 경로
$date = date("YmdHis");
$backupFile = $backupDir . "backup_" . $date . ".sql";

// 명령 실행 전에 경로에 대한 이스케이프 처리
$escapedBackupFile = escapeshellarg($backupFile);

// 백업 명령 실행
$command = "C:\\xampp\\mysql\\bin\\mysqldump --user={$dbUser} --password={$dbPassword} {$dbName} > {$escapedBackupFile} 2>&1";
exec($command, $output, $return_var);

// 실행 결과 확인
if ($return_var === 0) {
    echo "백업이 완료되었습니다. 파일 경로: $backupFile";
} else {
    echo "백업에 실패했습니다. 자세한 내용은 서버 로그를 확인하세요.";
}

echo "<br> <a href='main.html'> <--초기 화면</a> ";
closeDB($con);