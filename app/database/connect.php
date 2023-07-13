<?php

// $user = "root";
// $pass = "";

// // DBとの接続
// try {
//   $pdo = new PDO('mysql:host=localhost;dbname=I-EAT-test', $user, $pass,);
//   // echo "DBとの接続に成功しました。";
// } catch (PDOException $error) {
//   echo $error->getMessage();
// } -->

function connect_to_db()
{
  $dbn = 'mysql:dbname=I-EAT-test;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

// ログイン状態のチェック関数

function check_session_id()
{
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] !== session_id()) {
    header('Location: login.php');
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}

// DBとの接続
try {
  $pdo = connect_to_db();
} catch (PDOException $error) {
  echo $error->getMessage();
}
