<?php
import("@.Model.DeviceClassTypeDao");
import("@.Model.DeviceStorageDao");
import("@.Model.DeviceDao");

	header('Content-Type:text/html;charset=utf-8');

	class OperDeviceManageAction extends LoginAfterAction{
		private $deviceClassTypeDao;
		private $deviceStorageDao;
		private $deviceDao;
		private $deviceCodeDao;

		public function _initialize(){
			parent::_initialize();
			$this->deviceClassTypeDao = new DeviceClassTypeDao();
			$this->deviceDao = new DeviceDao();
			$this->deviceStorageDao = new DeviceStorageDao();
			$this->deviceCodeDao = new DeviceCaodeDao();
		}
		//权限检查
		public function permissionCheck($operationId){
			$params = array();
			$params['result'] = false;
			$params['operationid'] = $operationId;
			tag('behavior_authoritycheck',$params);
			return $params['result'] == false ? false : true;
		}

		//设备工种维护
		public function deviceMaintain(){
			$isPermit = $this->permissionCheck(DEVICE_MAINTAIN);
			if($isPermit == false){
			   $this->redirect('Staticpage/wrongalert',array(),3,"您无法操作权限");
			   return;
			}
			
			//获得设备实体类型
			$deviceClassTypes = $this->deviceClassTypeDao->findAll();
			
			//获得固定设备信息
			$devices = $this->deviceDao->findAll();
			foreach($devices as $key => $value){
				 $resultSet = $this->deviceStorageDao->findByCodeId($value['device_code_id']);
				 $devices[$key]['deviceSum'] = $resultSet['device_number'] ;
				 
				
			}

			//在前端显示的信息
			$this->assign('deviceClassTypes',$deviceClassTypes);
			$this->assign('devices',$devices);
			$this->display('OperDeviceManage/deviceMaintain');

		}

		//添加设备工种类别
		public function deviceMaintain_addClass(){
			$returnData = array();
			$classTypeName = $_POST['name'];
			$returnData['name'] = $classTypeName;
			$insertId = $this->deviceClassTypeDao->add($classTypeName);
			$returnData['id'] = $insertId;
			echo json_encode($returnData);
		}

		//编辑设备工种类别
		public function deviceMaintain_editClass(){
			$returnData = array();
			$name = $_POST['name'];
			$classId = $_POST['classid'];
			$returnData['name'] = $name;
			$returnData['result'] = $this->deviceClassTypeDao->updateById($classId,$name);
			echo json_encode($returnData);
		}

		//删除设备工种类别
		public function deviceMaintain_deleteClass(){
			$classId = $_POST['classid'];
			$returnData = $this->deviceClassTypeDao->deleteById($classId);
			echo json_encode($returnData);
		}

		//修改设备信息内容
		public function deviceMaintain_editDevice(){
			$id = $_POST['id'];
			$deviceName = $_POST['deviceName'];
			$classType = $_POST['classType'];
			$makeFactory = $_POST['makeFactory'];
			$deviceUnit = $_POST['deviceUnit'];
			$devicePrice = $_POST['devicePrice'];
			$deviceStatus = $_POST['deviceStatus'];
			$manager = $_POST['manager'];
			$managerType = $_POST['managerType'];
			$returnData = array();
			$returnData['deviceId'] = $id;
			$returnData['deviceName'] = $deviceName;
			$returnData['classType'] = $classType;
			$returnData['makeFactory'] = $makeFactory;
			$returnData['deviceUnit'] = $deviceUnit;
			$returnData['devicePrice'] = $devicePrice;
			$returnData['deviceStatus'] = $deviceStatus;
			$returnData['manager'] = $manager;
			$returnData['managerType'] =$managerType; 

			$returnData['result'] = $this->deviceDao->updateById($deviceName,$classType,$makeFactory,$deviceUnit,$devicePrice,$deviceStatus,$manager,$managerType,$id);
            echo json_encode($returnData);


		}

		//删除设备内容
		Public function deviceMaintain_deleteDevice(){
			var_dump("xxxxxxx");
			exit;
			$deviceId = $_POST['deviceId'];
			var_dump($deviceId);
			exit;
   			$result = $this->deviceDao->deleteById($deviceId);
			echo json_encode($result);
		}

		//保存信息到设备编码表中
		public function deviceMaintain_addDeviceCode(){
			//step1:从前端获取要保存到数据库中的字段信息
			$deviceCodeInfo = array();
			$deviceName = $_POST['deviceName'];
			$deviceCodeInfo['deviceName'] = $deviceName;
			//调用Dao方法保存
			$devieCodeDao.save($deviceCodeDao);
		}
		

	}
?>