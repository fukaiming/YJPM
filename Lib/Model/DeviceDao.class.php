<?php
	class DeviceDao extends Model{
		
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
		 * [findAll description] 获取所有设备信息表中的元组
		 * @return [type] [description] 返回获取的结果集
		 */
		public function findAll(){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_device ,tb_device_classtype_maintain as maintain ,tb_device_code 
			        where device_classtype_id=maintain.id and device_code_id=tb_device_code.id";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();

		}

		/**
		 * [updateById description] 用于修改设备信息
		 * @param  [type] $deviceName   [description] 设备名称
		 * @param  [type] $classType    [description] 工种类型
		 * @param  [type] $makeFactory  [description] 制造厂家
		 * @param  [type] $deviceUnit   [description] 设备单位
		 * @param  [type] $devicePrice  [description] 设备价格
		 * @param  [type] $deviceStatus [description] 设备状态
		 * @param  [type] $manager      [description] 管理人
		 * @param  [type] $managerType  [description] 管理类型
		 * @param  [type] $id           [description] tb_device :id
		 * @return [type]               [description] 返回更新结果
		 */
		public function updateById($deviceName,$classType,$makeFactory,$deviceUnit,$devicePrice,$deviceStatus,$manager,$managerType,$id){
			$myPDO = $this->connectDatabase();
			$sql = "update tb_device set device_name = ?,class_type = ? ,make_factory = ?,device_unit = ?,device_price = ?,devce_status = ?,manager = ?,manager_type = ? where id = ?";
			$statement = $myPDO->query($sql);
			return $statement->execute(array($deviceName,$classType,$makeFactory,$deviceUnit,$devicePrice,$deviceStatus,$manager,$managerType,$id));
		}

		/**
		 * [deleteById description] 删除设备信息
		 * @param  [type] $id [description] 设备id
		 * @return [type]     [description] 返回删除结果
		 */
		public function deleteById($id){
			$myPDO = $this->connectDatabase();
			$sql = "delete from tb_device where id = ?";
			$statement = $myPDO->query($sql);
			return $statement->execute(array($id));

		}


	}

?>