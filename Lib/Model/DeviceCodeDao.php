<?php
class DeviceCodeDao extends Model{

		/**
		 * [connectDatabase description] :创建数据库的连接
		 * @return [type] [description] :返回连接对象
		 */
		public function connectDatabase(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO ->query('set names utf8');//设置编码方式
			return $myPDO;
		}

		public function save($deviceCodeInfo){
			$myPDO = $this->connectDatabase();
			$statement = $myPDO->query($sql);
			$statement->execute();
		}

}
?>