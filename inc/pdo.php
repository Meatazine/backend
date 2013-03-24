<?php
/**
 * @overview 产生$DB的实例
 * @author Meathill (meathill@foxmail.com)
 * @since 0.1
 */

$host = 'evereditor.com';
$port = 3306;
$dbname = 'meatazine';
$user = 'admin';
$pwd = '123456';
$init = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'');
return new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pwd, $init); 
?>
