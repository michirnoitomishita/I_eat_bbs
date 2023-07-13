<?php

include_once("./app/database/connect.php");

// 入力画面からMYSQLへデータを送る処理
if (isset($_POST["submitButton"])) {

  // 入力チェック
  if (empty($_POST["username"])) {
    $error_message["username"] = "お名前を入力してください。";
  }
  // コメント入力チェック
  if (empty($_POST["body"])) {
    $error_message["body"] = "コメントを入力してください。";
  }
  if (empty($error_message)) {
    $post_date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`) VALUES (:username, :body, :post_date);";
    $statement = $pdo->prepare($sql);

    // 値をセットする
    $statement->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $statement->bindParam(":body", $_POST["body"], PDO::PARAM_STR);
    $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);

    $statement->execute();

    // 全て完了したら、リフレッシュによるフォームの再送信を避けるためにリダイレクト
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
}

$comment_array = array();

//コメントデータをテーブルから取得
$sql = "SELECT * FROM comment";
$statement = $pdo->prepare($sql);
$statement->execute();

$comment_array = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/i-eat.css">
  <title>I-EAT掲示板</title>
</head>

<body>
  <header>
    <h1 class="title">I-EAT掲示板</h1>
    <hr>
  </header>

  <!-- バリデーションチェック -->
  <?php if (isset($error_message)) : ?>
    <ul class="errorMessage">
      <?php foreach ($error_message as $error) : ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>


  <!-- スレッドエリア -->
  <div class="thw">
    <div class="chw">
      <div class="thrt">
        <span>
          【タイトル】
          <h1>やすもり本店お客様ご飯リユーススレッド</h1>
        </span>
      </div>
      <section>

        <?php foreach ($comment_array as $comment) : ?>
          <article>
            <div class="wrapper">
              <div class="nameAria">
                <p>名前</p>
                <p class="username"><?php echo $comment["username"]; ?></p>
                <time><?php echo $comment["post_date"]; ?></time>
              </div>
              <p class="comment"><?php echo $comment["body"]; ?></p>
            </div>
          </article>
        <?php endforeach ?>

      </section>
      <form class="formWrapper" method="POST">
        <div>
          <input type="submit" value="書き込む" name="submitButton">
          <label>名前： </label>
          <input type="text" name="username">
          <div>
            <textarea class="commentTextArea" name="body"></textarea>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- <?php include("app/parts/newThreadButton.php"); ?> -->
</body>

</html>