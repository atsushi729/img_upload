<?php

require_once "./dbc.php";

//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';
$seve_filename = date('YmdHis') . $filename;
$err_msg = array();
$save_path = $upload_dir . $seve_filename;


//キャプションの取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

//キャプションのバリデーション
//未入力か
if (empty($caption)) {
  array_push($err_msg, 'キャプションを入力して下さい。');
}

//140文字かどうか
if (strlen($caption) > 140) {
  array_push($err_msg, 'キャプションは140文字以内で入力して下さい。');
}

//ファイルのバリデーション
//ファイルサイズが1MB未満か
if ($filesize > 1048576 || $file_err == 2) {
  array_push($err_msg, 'ファイルサイズは1MB未満にして下さい');
}

//拡張は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $allow_ext)) {
  array_push($err_msg, '画像ファイルを添付して下さい');
}

if (count($err_msg) === 0) {
  //ファイルはあるかどうか？
  if (is_uploaded_file($tmp_path)) {
    if (move_uploaded_file($tmp_path, $save_path)) {
      echo $filename . 'を' . $upload_dir . 'アップしました';
      //DBに保存（ファイル名、ファイルパス、キャプション）
      $result = fileSave($filename, $save_path, $caption);
      if ($result) {
        echo 'データベースに保存しました';
      } else {
        echo 'データベースの保存に失敗しました';
      }
    } else {
      echo 'ファイルが保存できませんでした';
    }
  } else {
    echo 'ファイルが選択されていません';
    echo '<br>';
  }
} else {
  foreach ($err_msg as $msg) {
    echo $msg;
    echo '<br>';
  }
}


?>

<a href="./upload_form.php">戻る</a>