<?php

class BookingController{
	
    public function httpGetMethod(Http $http, array $queryFields){
        $isConnect = new BookingController();
        $isConnect->redirect();
        }

    public function httpPostMethod(Http $http, array $formFields){
        $booking = new BookingModel();
        $booking->saveBooking(
        				$formFields['orderDate'],
        				$formFields['orderTime'],
        				$formFields['numberOfSeats']);

        $flashMess = new FlashBag();
        $flashMess->add('Votre réservation a bien été prise en compte.');

        $http->redirectTo('/');
    }

    public function redirect(){
        $sess = new UserSession();
        if(!$sess->isAuthenticated()){
            $http = new Http();
            $http->redirectTo('/');
        }    
    }

}