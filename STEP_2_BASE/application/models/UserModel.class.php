<?php

// instantier la class db
// créer la requète
// appeler la méthode la plus adaptée du fichier db 

class UserModel{
	public function saveUser($lastName, $firstName, $birthDate, $address, $city, $zipCode, $phone, $email, $password){

		$db = new Database();

		$query = 'SELECT Email
				  FROM User
				  WHERE Email = ?';

		// If email is not existing -> saveUser, else error msg.
		if(empty($db->queryOne($query, [$email]))){
			$query = 'INSERT INTO User (LastName, FirstName, BirthDate, Address, City, ZipCode, Phone, Email, Password)
				  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

			$newPassword = $this->hashPassword($password);

			$db->executeSql($query, [
								$lastName, 
								$firstName, 
								$birthDate, 
								$address, 
								$city, 
								$zipCode, 
								$phone, 
								$email, 
								$newPassword]);
		}else{
			die('Mail déjà enregistré ! :(');
		}

	}


	private function hashPassword($password){
		$salt = '$2y$11$' . substr(bin2hex(openssl_random_pseudo_bytes(32, $csstrong)), 0, 22);
		return crypt($password, $salt);
		
	}

	private function verifyPassword($password, $hashedPassword) {
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

    public function findWithEmailPassword($email, $password) {

    	$db = new Database();
    	// Récupération de l'utilisateur ayant l'email spécifié en argument.
		$query = 'SELECT *
				  FROM User
				  WHERE Email = ?';

		$userInfo = $db->queryOne($query, [$email]);

		// Est-ce qu'on a bien trouvé un utilisateur ?
		if(empty($userInfo)){
			die('Veuillez-vous inscrire pour pouvoir vous connecter.');
		}
			// Est-ce que le mot de passe spécifié est correct par rapport à celui stocké ?
		if(!$this->verifyPassword($password, $userInfo['Password'])){
			die('Votre mot de passe est incorrect.');
		}

				// Si tout est ok, retourner les infos de l'utilisateur
		return $userInfo;
	}

}

?>