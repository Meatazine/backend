<?php
/**
 * @overview 封装一个连接类，学会用pdo之后觉得有点多余……
 * @author Meathill (meathill@foxmail.com)
 */
class DB {
  /****************
   * 构造函数
   ***************/
  public function __construct($host, $port, $dbname, $user, $pwd){
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
    $this->pdo = new PDO($dsn, $user, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
  }
  
  /****************
   * 私有属性
   ***************/
  private $pdo;
  
  /****************
   * 公共方法
   ***************/
  /**
   * 取一个值
   * @param {Ssring} $sql
   * @return {mixed} 第一个值
   */
  public function getVar($sql) {
    $result = $this->pdo->query($sql);
    if ($result) {
      return $result->fetchColumn();
    } else {
      return false;
    }
  }
  public function getRow($sql) {
    $result = $this->pdo->query($sql);
    if ($result) {
      return $result->fetchObject();
    } else {
      return false;
    }
  }
  /**
   * 取一批值
   * @param {string} $sql
   * @param {string} $type 返回类型，"O" 对象，"A" 数组
   * @return {array} 数组
   */
  public function getResults($sql, $type = 'O') {
    $result = $this->pdo->query($sql);
    if ($result) {
      $type = $type == 'O' ? PDO::FETCH_ASSOC : PDO::FETCH_NUM;
      return $result->fetchAll($type);
    } else {
      return FALSE;
    }
  }
  /**
   * 取最近插入的数据的id
   */
  public function lastInsertId() {
    return $this->pdo->lastInsertId();
  }
  /**
   * 执行sql
   * @param {string} $sql
   * @return {mixed} 结果
   */
  public function query($sql) {
    return $this->pdo->query($sql);
  }
}

?>
