<?php

require_once "./dbc.php";
$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>アップロードフォーム</title>
</head>
<style>
  body {
    padding: 30px;
    margin: 0 auto;
    width: 50%;
  }

  textarea {
    width: 98%;
    height: 60px;
  }

  .file-up {
    margin-bottom: 10px;
  }

  .submit {
    text-align: right;
  }

  /* .btn {
    display: inline-block;
    border-radius: 3px;
    font-size: 18px;
    background: #67c5ff;
    border: 2px solid #67c5ff;
    padding: 5px 10px;
    color: #fff;
    cursor: pointer;
  }
  .btn:hover {
    cursor: pointer;
    opacity: 0.8;
  } */
</style>

<body class="bg-dark text-white">
  <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
    <div class="file-up ">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
      <input name="img" type="file" accept="image/*" />
    </div>
    <div>
      <textarea name="caption" placeholder="キャプション（140文字以下）" id="caption"></textarea>
    </div>
    <div class="submit">
      <button type="submit" class="btn btn-outline-primary btn-lg btn-block mb-5" >送信</button>
    </div>
  </form>
  <div>
  <?php  foreach($files as $file): ?>
    <img src="<?php echo "{$file['file_path']}";?>" alt="" class="img-fluid mb-2 rounded">
    <p class="badge badge-success text-center mb-5"><?php echo h("{$file['description']}");?></p>
  <?php  endforeach; ?>
  </div>
</body>

</html>