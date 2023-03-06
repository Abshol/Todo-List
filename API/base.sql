DROP TABLE IF EXISTS `machine`;
CREATE TABLE IF NOT EXISTS `machine` (
  `idMachine` int(11) NOT NULL AUTO_INCREMENT,
  `nomMachine` varchar(500) NOT NULL,
  `etreEnService`  boolean NOT NULL,
  `idFabriquant` int(11) NOT NULL,
  PRIMARY KEY (`idMachine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `fabriquant`;
CREATE TABLE IF NOT EXISTS `fabriquant` (
  `idFabriquant` int(11) NOT NULL AUTO_INCREMENT,
  `nomFabriquant` varchar(500) NOT NULL,
  PRIMARY KEY (`idFabriquant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `machine` ADD FOREIGN KEY (`idFabriquant`) REFERENCES `fabriquant` (`idFabriquant`);

insert into fabriquant (idFabriquant, nomFabriquant) values (1, 'Thiel, Wiza and Jenkins');
insert into fabriquant (idFabriquant, nomFabriquant) values (2, 'Macejkovic and Sons');
insert into fabriquant (idFabriquant, nomFabriquant) values (3, 'Ledner-Lang');
insert into fabriquant (idFabriquant, nomFabriquant) values (4, 'Kessler, Zieme and Nader');
insert into fabriquant (idFabriquant, nomFabriquant) values (5, 'Schroeder Group');
insert into fabriquant (idFabriquant, nomFabriquant) values (6, 'O''Reilly-King');
insert into fabriquant (idFabriquant, nomFabriquant) values (7, 'Hettinger-Jaskolski');
insert into fabriquant (idFabriquant, nomFabriquant) values (8, 'Bernhard LLC');
insert into fabriquant (idFabriquant, nomFabriquant) values (9, 'Kuphal, Kilback and Stiedemann');
insert into fabriquant (idFabriquant, nomFabriquant) values (10, 'Mayert-Glover');
insert into fabriquant (idFabriquant, nomFabriquant) values (11, 'Rodriguez Group');
insert into fabriquant (idFabriquant, nomFabriquant) values (12, 'Kunde, Hansen and Schaden');

insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (1, 'Benzonatate', 1, 12);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (2, 'DIABETIC BRUISE DEFENSE', 1, 7);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (3, 'Pleo Muc', 0, 5);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (4, 'Formaldehyde', 1, 4);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (5, 'Badger Unscented SPF 30 Sunscreen', 1, 12);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (6, 'VALTREX', 0, 2);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (7, 'Hair Regrowth Treatment', 1, 8);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (8, 'Liver supplement', 1, 9);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (9, 'Instant Hand Sanitizer', 1, 9);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (10, 'Neo-Synephrine Cold and Sinus', 1, 12);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (11, 'Tri-Estarylla', 0, 4);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (12, 'American Infection Control Antiseptic Hand Wipes', 0, 8);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (13, 'lisinopril', 1, 10);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (14, 'EXTRA STRENGTH STOOL SOFTENER', 1, 12);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (15, 'naproxen sodium', 1, 3);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (16, 'Anti Dandruff', 1, 12);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (17, 'McKesson Unna Boot 3', 1, 7);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (18, 'Neutrogena Healthy Skin Anti Wrinkle', 0, 10);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (19, 'NWI LUBRICATING', 1, 6);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (20, 'THERA Moisturizing Body Cleanser', 0, 6);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (21, 'Heparin Sodium', 0, 9);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (22, 'Nortriptyline Hydrochloride', 1, 9);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (23, 'ONDANSETRON HYDROCHLORIDE', 1, 2);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (24, 'DEXTROMETHORPHAN HYDROBROMIDE', 0, 11);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (25, 'Cilostazol', 0, 6);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (26, 'Carbamazepine', 1, 7);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (27, 'Verapamil', 1, 12);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (28, 'Lisinopril and hydrochlorothiazide', 0, 9);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (29, 'Ibuprofen', 0, 7);
insert into machine (idMachine, nomMachine, etreEnService, idFabriquant) values (30, 'TAZORAC', 1, 4);