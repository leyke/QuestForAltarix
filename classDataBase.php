<?php 
class DataBase
{	

	private $connection = null;
	
	private $host;
	private $user;
	private $password;
	private $db_name;
	
	function __construct()
	{
		$this->host = "localhost";
		$this->user = "mysql";
		$this->password = "mysql";	
		$this->db_name = "DbForAltarix";
	}	
	/**
	 * Возвращает текущее соединение с БД
	 */
	public function getConnection()
	{
		if ($this->connection === null)
		{
			$this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
			/*if ($this->connection) 
				mysqli_select_db( $this->db_name, $this->connection);
			else
				die(mysqli_error());*/
		}
		return $this->connection;
	}
	
	/**
	 * Выполняет запрос к текущей БД
	 */
	public function query($text)
	{
		return mysqli_query($this->getConnection(), $text);
	}
	
	/**
	 * Делает выборку из БД  
	 */

	public function select($id=null,$getLast=null)
	{
		$result = [];
		if($getLast == 1){

			$sql = "SELECT * FROM response_log_table ORDER BY response_id DESC LIMIT 1";
		} else {
			$sql = "SELECT * FROM response_log_table";

			if ($id){
				$sql .= ' WHERE response_id = ' . $id;
			}
		}
		if ($data = $this->query($sql))
		{
			while($row = mysqli_fetch_assoc($data)){
				$result[] = $row;
			}
		}

		if ( ($id or $getLast) and $result)
			$result = array_shift($result);
		return $result;
	}
	/**
	 * Делает добавление БД
	 */

	public function insert($request_time, $response_time, $ping, $check_result, $fail_result_body=null)
	{
		$sql = "INSERT INTO response_log_table(request_time, response_time, ping, check_result, fail_result_body) values ('{$request_time}','{$response_time}','{$ping}','{$check_result}','{$fail_result_body}')";
		$this-> query($sql);
	}
}

