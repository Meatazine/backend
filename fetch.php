<?php
/**
 * 取当前用户所有在线存储的杂志
 * @author Meathill (meathill@foxmail.com)
 */
 
$openid = strip_tags($_REQUEST['openid']);

if ($openid == '') {
  throwError();
}

// 先查userid，然后取书
$sql = "SELECT id
        FROM m_user
        WHERE qq='$openid'
        LIMIT 1";
$uid = $DB->query($sql)->fetchColumn();

if ($uid) {
  $sql = "SELECT id, title AS name, edit_time AS datetime
          FROM m_book
          WHERE owner=$uid
          ORDER BY edit_time DESC";
  $data = $DB->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  die(json_encode($data));
}

$sql = "INSERT INTO m_user
        (qq)
        VALUES ('$openid')";
$check = $DB->query($sql);
if ($check) {
  $result = array('code' => '0', 'data' => 0);
} else {
  throwError('sql', $sql);
}
die(json_encode($result));
?>