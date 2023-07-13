<?php
include_once("./app/database/connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規スレッド作成ページ</title>
</head>

<body>
  <?php include("app/parts/header.php"); ?>
  <!-- バリデーションチェック -->
  <?php if (isset($error_message)) : ?>
    <ul class="errorMessage">
      <?php foreach ($error_message as $error) : ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <div>
    <h2>新規スレッド立ち上げ場所</h2>
    <form method="POST" class="formWrapper">
      <div>
        <label>スレッド名</label>
        <input type="text" name="title">
        <label>名前</label>
        <input type="text" name="username">
      </div>
      <div>
        <textarea name="body" class="commentTextArea"></textarea>
      </div>
      <input type="submit" value="立ち上げ" name="threadSubmitButton">
    </form>
  </div>


</body>

</html>