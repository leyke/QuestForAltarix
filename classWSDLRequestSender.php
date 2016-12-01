<?php
require_once("classDataBase.php");

class WSDLRequestSender
{
	private $db;

	public $wsdl;
	//Параметры запроса
	public $params;


	function __construct()
	{
		//БД
		$this->db = new DataBase();

		//WSDL сервер
		$this->wsdl = "http://82.138.16.126:8888/TaxiPublic/Service.svc?wsdl";
		//Параметры запроса
		$this->params = (['RegNum'=> 'ем33377','Model'=>'Focus']);
	}
	/**
	 * Удаляет запись
	 */
	function request($wsdl,$params)
	{
		echo "\n Request Send < /br> \n";
		$client = new SoapClient($wsdl);
		$result = $client->GetTaxiInfos(['request'=>$params])->GetTaxiInfosResult;

		return $result;
	}
	/**
	 * Проверка ответа
	 */
	function check($requestResult,$params)
	{
		if($requestResult->TaxiInfo){
			$paramKeys = array_keys($params);
			foreach ($requestResult->TaxiInfo as $TaxiInfo){
				foreach ($paramKeys as $key => $param){
					if ($TaxiInfo->$key == $params[$key]) {
						return null;
					}
				}
			}
		}
		return $checkResult = $requestResult;
	}
	/**
	 * Сохраняет результаты в бд
	 */
	function save($request_time, $response_time, $ping, $currentStatus)
	{
		$result = "FAIL";
		if ($currentStatus == null){
			$this->db->insert($request_time, $response_time, $ping,0);
			$result = "OK";
		} else{
			$this->db->insert($request_time, $response_time, $ping,1, serialize($currentStatus));
		}

		mysqli_close($this->db->getConnection());
		return $result;
	}
	/**
	 * Выборка
	 */
	function select($response_id = null,$getLast=null)
	{
		$result = $this->db->select($response_id, $getLast);
		return $result;
	}

	/**
	 * Удаляет запись
	 *
	function deleteRecord($response_id)
	{
	$this->db->deleteRecord($response_id);
	}*/
}