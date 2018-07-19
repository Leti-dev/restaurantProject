<?php

class UserSession{

	public function __construct() {
		// la condition doit toujours être présente pour ne pas en 
		// démarrer une autre.
  		if(session_status() == PHP_SESSION_NONE) {
          // Démarrage du module PHP de gestion des sessions.
  			// session_status() et session_start() natives PHP.
    			session_start();
  		}
	}

    public function create($userId, $firstName, $lastName, $email) {
        // Construction de la session utilisateur.
        $_SESSION['user'] = [
        		'userId' 	=> $userId,
        		'firstName' => $firstName,
        		'lastName' 	=> $lastName,
        		'email' 	=> $email

        ];
    }

    public function isAuthenticated() {
    	if(array_key_exists('user', $_SESSION) && !empty($_SESSION['user'])){
    		return true;
    	}
    	
    	return false;
        // return true, si l'user est log
        
        // return false, si il ne l'est pas
    }

    public function destroy() {
        // Destruction de l'ensemble de la session.
    	$_SESSION = [];
    	session_destroy();
    }

    public function getEmail() {
        if($this->isAuthenticated() == false) { return null; }
  
        return $_SESSION['user']['email'];
    }

    public function getFirstName() {
        if($this->isAuthenticated() == false) { return null; }

        return $_SESSION['user']['firstName'];
    }

    public function getFullName() {
        if($this->isAuthenticated() == false) { return null; }

        return $_SESSION['user']['firstName'].' '.$_SESSION['user']['lastName'];
    }

    public function getLastName() {
        if($this->isAuthenticated() == false) { return null; }

        return $_SESSION['user']['lastName'];
    }

    public function getUserId() {
        if($this->isAuthenticated() == false) { return null; }

        return $_SESSION['user']['userId'];
    }
}

?>