<?php
header('Content-Type: text/html;charset=utf-8');

/* Connect to a MySQL server  连接数据库服务器 */
$link = mysqli_connect(
    'localhost',  /* The host to connect to 连接MySQL地址 */
    'root',      /* The user to connect as 连接MySQL用户名 */
    '',  /* The password to use 连接MySQL密码 */
    'gp_db');    /* The default database to query 连接数据库名称*/

if (!$link) {
    printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
    exit;
}else

mysqli_query($link,'set names utf8');
?>