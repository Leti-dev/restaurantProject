<?php

class LogoutController{
	
    public function httpGetMethod(Http $http, array $queryFields){
        $userSession = new UserSession();
        $userSession->destroy();

        $flashMess = new FlashBag();
        $flashMess->add('Vous avez été déconnecté avec succès.');

        $http->redirectTo('/');
    }

    public function httpPostMethod(Http $http, array $formFields){
        
    }

}