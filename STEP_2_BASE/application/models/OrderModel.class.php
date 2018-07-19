<?php

class OrderModel{
	public function saveOrder(){
		$sess = new UserSession;
		$userId = $sess->getUserId();

		$db = new Database();

		$query = 'INSERT INTO Order ()
				  VALUES ()';

		$db->executeSql($query, []);
		
	}
}

?>