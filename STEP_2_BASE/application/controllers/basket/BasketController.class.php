<?php

class BasketController{
	
    public function httpGetMethod(Http $http, array $queryFields){
        
    }

    public function httpPostMethod(Http $http, array $formFields){
        return [ '_raw_template' => true,
                 'basket' => $formFields['basket']];
    }

}