<?php
	class DeviceStorageDao extends Model{
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
		 * [findByCodeId description] 根据设备编码id查找该设备的库存数量
		 * @param  [type] $deviceCodeId ：设备编码id
		 * @return [type] 返回：该设备编码所含有的设备数量
		 */
		public function findByCodeId($deviceCodeId){
			$myPDO = $this->connectDatabase();
			$sql = "select device_number from tb_device_storage where tb_device_code_id =?";
			$statement = $myPDO ->prepare($sql);
			$statement->execute(array($deviceCodeId));
			return $statement->fetch();
		
		}
	}
?>