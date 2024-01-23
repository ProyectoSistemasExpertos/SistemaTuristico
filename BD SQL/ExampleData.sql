USE touristSystem;
#Debe Ponerse dentro de phpmyadmin
INSERT INTO `category` (`idCategory`, `typeCategory`) VALUES (NULL, 'Playa'), (NULL, 'Montaña'),(NULL,'Ciudad Turística');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `idCard`, `firstLastName`, `secondLastName`, `phone`, `address`, `rol`) VALUES (NULL, 'Patrick', 'test@test.com', NULL, '123', NULL, NULL, NULL, '1', 'Lisby', 'Cordoba', '83582141', 'Limon', 'Cliente');
INSERT INTO `booking` (`idBooking`, `description`, `state`, `price`, `location`, `totalPossibleReservation`, `idPerson`,`idCategory`) VALUES (NULL, 'Hotel Cueva', '1', '12500', 'Limón', '5', '1','1');
INSERT INTO `booking_gallery` (`idBooking_gallery`, `image`, `idBooking`) VALUES (NULL, 'no tengo ', '1');
INSERT INTO `housing` (`idHousing`, `initial_date`, `final_date`, `arrival_date`, `total_person`, `idPerson`, `idBooking`) VALUES (NULL, '2024-01-09', '2024-01-10', '2024-01-09', '3', '1', '1');
INSERT INTO `preference` (`idPreference`, `idPerson`, `idCategory`) VALUES (NULL, '1', '1');
INSERT INTO `recommendation` (`idRecommendation`, `idPerson`, `idCategory`) VALUES (NULL, '1', '1');
INSERT INTO `valoration` (`idValoration`, `score`, `commentary`, `idPerson`, `idBooking`) VALUES (NULL, '5', 'Todo bien pa\'', '1', '1');