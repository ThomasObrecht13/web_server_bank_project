DROP TABLE IF EXISTS COMPTES;
DROP TABLE IF EXISTS USERS;

CREATE TABLE IF NOT EXISTS USERS (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
    (1, 'test', 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
    (2, 'test2', 'test2', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08');


CREATE TABLE IF NOT EXISTS COMPTES (
    id int(11) NOT NULL AUTO_INCREMENT,
    libelle varchar(100) NOT NULL,
    banque varchar(100) NOT NULL,
    solde varchar(100) NOT NULL,
    userId int(11) NOT NULL,
    FOREIGN KEY(userId) REFERENCES USERS (id),
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


INSERT INTO COMPTES (id, libelle, banque, solde,userId) VALUES
    (1, 'compte courant 1', 'bank1', '100',1),
    (2, 'compte courant 2', 'bank1', '321',2),
    (3, 'compte epargne 1', 'bank2', '43',1);
