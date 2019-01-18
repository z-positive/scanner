<?php 
class updater{
	
	
	
	public function bitrixQuery($action,$fields){
	
		$queryUrl = 'https://liart24.bitrix24.ru/rest/6/#/'.$action.'.json'; 
		
		$queryData = http_build_query($fields); 

        $curl = curl_init(); 
            
        curl_setopt_array($curl, array( 
        
		CURLOPT_SSL_VERIFYPEER => 0, 
        CURLOPT_POST => 1, 
        CURLOPT_HEADER => 0, 
        CURLOPT_RETURNTRANSFER => 1, 
        CURLOPT_URL => $queryUrl, 
        CURLOPT_POSTFIELDS => $queryData, )); 
        $result = curl_exec($curl); 
        curl_close($curl);     
        $result = json_decode($result, 1); 
		
		return $result;
	
	}
	
	public function update_lead($id, $fields){
		
		$query = array(
			"id" => $id,
			"fields" => $fields,
							
			"params" => array(
							"REGISTER_SONET_EVENT" => "Y"
						)
		
		);
	
		$this->bitrixQuery("crm.lead.update",$query);
		
	
	}
	
	public function get_lead($scan_id){
		
		$fields = array(
			"filter" => array("UF_CRM_1520935359" => $scan_id),
			"select" => array("ID")
		);
		
		$leads = $this->bitrixQuery("crm.lead.list",$fields);
		
		//$this->test($leads);
		
		return $leads['result'][0]['ID'];
	}
	
	public function test($str){
		$fd = fopen("log.txt", 'w') or die("не удалось создать файл");
		
		fwrite($fd, $str);
		fclose($fd);
	}
	
	function __construct($order){
		
		$lead_id = $this->get_lead($order);
		
		$query = array(
			"STATUS_ID" => 7
		);
		
		$this->update_lead($lead_id, $query);
		
	}

}

$updater = new updater($_GET['order']);	




?>