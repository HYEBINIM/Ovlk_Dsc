<?php
session_start();
$servername = "localhost"; // 데이터베이스 서버
$username = "server"; // 데이터베이스 사용자 이름
$password = "dltmxm1234"; // 데이터베이스 비밀번호
$dbname = "dataset"; // 데이터베이스 이름

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}