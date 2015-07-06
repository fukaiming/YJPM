<?php
	class DeviceClassTypeDao extends Model{
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

			
		/**
		 * [findAll description] :从数据库中查找所有的设备类型
		 * @return [type] [description] ：返回array
		 */
		public function findAll(){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_device_classtype_maintain";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll(); 
		}
		/**
		 * [addDeviceClassType description]:添加设备工种类型
		 * @param [type] $classType [description]返回SQL执行结果
		 */
		public function add($classType){
			$myPDO = $this->connectDatabase();
			$sql = "insert into tb_device_classtype_maintain(classtype) values(?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($classType));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		/**
		 * [updateById description]
		 * @param  [type] $classId [工种类别id]
		 * @param  [type] $name    [工种名称]
		 * @return [type]          返回执行结果
		 */
		public function updateById($classId,$name){
			$myPDO = $this->connectDatabase();
			$sql = "update tb_device_classtype_maintain set classtype=? where id = ?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$classid));
		}

		public function deleteById($classId){
			$myPDO = $this->connectDatabase();
			$sql ="delete from tb_device_classtype_maintain where id = ?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($classId));
		}		


	}
?>