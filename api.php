<?php

/**
 * 代理，用来将请求指向不同的程序处理
 * @author Meathill (meathill@foxmail.com)
 */
if (!$_REQUEST) {
  die('ok');
}

include('inc/error.php');
$DB = include('inc/pdo.php');

$api = $_REQUEST['api'];
$openid = mysql_escape_string($_REQUEST['openid']);
$bookid = isset($_REQUEST['bookid']) ? (int) $_REQUEST['bookid'] : 0;

if ($api == '') {
  throwError();
}
$api .= '.php';

// 权限校验
if ($openid && $bookid && $bookid != 0) {
  $sql = "SELECT 'x'
          FROM m_book LEFT JOIN m_user ON m_user.id=m_book.owner
          WHERE m_book.id=$bookid AND m_user.qq='$openid'";
  $check = $DB->query($sql)->fetchColumn();
  if (!$check) {
    throwError('auth');
  }
}

if (file_exists($api)) {
  include_once($api);
} else {
  echo '{code: 0}';
}
?>