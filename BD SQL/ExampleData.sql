USE touristSystem;
#Debe Ponerse dentro de phpmyadmin
INSERT INTO `person` (`idPerson`, `idCard`, `namePerson`, `firstLastNamePerson`, `secondLastNamePerson`, `personPhone`, `personAddress`, `personEmail`, `personPassword`, `rolDescription`, `token`)
 VALUES (NULL, '1', 'Patrick', 'Lisby', 'Cordoba', '88582141', 'Limon', 'lisby2103@gmail.com', '12345', 'Cliente', NULL),
 (NULL, '2', 'Prueba', 'Prue', 'Ba', '88776655', 'SanJose', 'sinA@gmail.com', '54321', 'Cliente', NULL);
 
 INSERT INTO `category` (`idCategory`, `typeCategory`) VALUES ('1', 'Montaña'), ('2', 'Playa');
 
 INSERT INTO `recommendation` (`idRecommendation`, `idPerson`, `idCategory`) VALUES ('1', '1', '1'), ('2', '2', '1');
 INSERT INTO `preference` (`idPreference`, `idPerson`, `idCategory`) VALUES ('4', '1', '1');
 INSERT INTO `housing` (`idHousing`, `initial_date`, `final_date`, `arrival_date`, `total_person`, `idPerson`) VALUES ('1', '2024-01-01', '2024-01-03', '2024-01-01', '2', '1');
 
 INSERT INTO `booking` (`idBooking`, `description`, `state`, `price`, `location`, `totalPossibleReservation`, `idPerson`) VALUES ('1', 'Cabo Verde', '1', '12000', 'Limon', '5', '1');
 INSERT INTO `booking_gallery` (`idBooking_gallery`, `image`, `idBooking`) VALUES ('1', '231', '1');
 
 INSERT INTO `valoration` (`idValoration`, `score`, `commentary`, `idPerson`, `idBooking`) VALUES ('1', '5', 'Good shit', '1', '1');
 
 