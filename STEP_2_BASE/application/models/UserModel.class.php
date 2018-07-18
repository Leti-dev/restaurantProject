<?php

// instantier la class db
// créer la requète
// appeler la méthode la plus adaptée du fichier db 

class UserModel{
	public function saveUser($lastName, $firstName, $birthDate, $address, $city, $zipCode, $phone, $email, $password){
		$db = new Database();
		$query = 'INSERT INTO User (LastName, FirstName, BirthDate, Address, City, ZipCode, Phone, Email, Password)
				  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$db->executeSql($query, [
								$lastName, 
								$firstName, 
								$birthDate, 
								$address, 
								$city, 
								$zipCode, 
								$phone, 
								$email, 
								$password]);

		$http->redirectTo('/');
	}
}

?>