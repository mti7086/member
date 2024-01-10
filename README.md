# 회원관리시스템
## Notion 포트폴리오 내용: https://bit.ly/48LVNqx
### 이 내용은 "이것이 MySQL이다" 책을 기반으로 PHP와 MySQL을 연동한 간단한 회원관리시스템의 내용에 무엇을 추가하였는지에 대한 간단한 내용을 적습니다.

# db.php 추가한 이유
### 1. db.php 파일은 데이터베이스 관련 코드의 중복을 줄이는 모듈화 작업을 하였습니다.
### 2. SQL 인젝션 공격으로부터 보호하기 위해 프리페어드 스테이트먼트를 사용하는 접근 방식을 사용했습니다.
### 이 내용은 모든 php파일에 db.php를 연결하도록 만들었습니다.

# backup_script.php 추가한 이유
### 1. 데이터 보안과 무결성을 유지합니다. 
### 2. 백업을 통하여 데이터 손실이나 손상을 방지하고, 쉽게 복구할 수 있도록 돕습니다. 
### 3. 백업 파일의 이름에 타임스탬프를 포함하여, 여러 버전의 백업을 구분하고 관리할 수 있다.

# troubleshooting_script.php 추가한 이유
### 1. 데이터베이스 연결 문제, 테이블의 존재 여부, 테이블 내 레코드 수 확인 등의 기본적인 데이터베이스 상태 검사를 통해 데이터베이스 연결 오류나 기타 문제를 빠르게 식별하고 해결할 수 있습니다.

# performance_script.php 추가한 이유
### 1. 슬로우 쿼리 로그 상태를 확인하여 비효율적인 쿼리를 식별하고, 인덱스 사용성을 분석하여 쿼리 최적화의 여지를 탐색합니다. 또한, 현재 연결된 스레드 수를 확인하여 데이터베이스 서버의 부하 상태를 모니터링합니다. 
