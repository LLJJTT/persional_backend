<?php
header('Access-Control-Allow-Origin:*');
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
//header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
// 连接数据库名称
$mysql_conf = array(
	'host' => '127.0.0.1',
	'db' => 'persional_web',
	'db_user' => 'root',
	'db_pwd' => '123456',
);
$mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
//诊断连接错误
if ($mysqli->connect_errno) {
	die("could not connect to the database:\n" . $mysqli->connect_error);
}
$mysqli->query("set names 'utf8';");
//连接数据库
$select_db = $mysqli->select_db($mysql_conf['db']);
if (!$select_db) {
	die("could not connect to the db:\n" . $mysqli->error);
}

// 登录接口
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from login where username="."'$username' and password="."'$password'";
    $result = $mysqli->query($sql);
    $rs = $result->fetch_object();
    if ($rs!=null) {
      if ($password == $rs->password&&$username == $rs->username) {
	$arr = array('code' => 200, 'msg' => '登录成功','user_id' =>$rs->id);
        echo json_encode($arr);
        
      }
      
    }
else {
        $arr = array('code' => 0, 'msg' => '账号或密码有误!！');
        echo json_encode($arr);
      }
?>