<?php

// instantier la class db
// créer la requète
// appeler la méthode la plus adaptée du fichier db 

class MealModel{
	public function listAll(){
		$db = new Database();
		$query = 'SELECT *
				  FROM Meal';
		return $db->query($query);
	}
}

?>