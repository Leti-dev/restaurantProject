<?php

class BookingModel{
	public function saveBooking($orderDate, $orderTime, $numberOfSeats){
		$sess = new UserSession;
		$userId = $sess->getUserId();

		$db = new Database();

		$query = 'INSERT INTO Booking (BookingDate, BookingTime, NumberOfSeats, User_Id)
				  VALUES (?, ?, ?, ?)';

		$db->executeSql($query, [
								$orderDate, 
								$orderTime, 
								$numberOfSeats, 
								$userId]);
		
	}
}

?>