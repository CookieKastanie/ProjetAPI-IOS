/* database projetAPIIOs */
/* mysql -u login -h serveurmysql -p BDD_login */
/* ssh login@912e106-02 */

drop table if exists COURS, COMPETENCES, ELEVE, NIVEAUX, MATIERES, PROF;

create table PROF(
	mailProf varchar(40) not null,
	nom varchar(25),
	prenom varchar(25),
	presentation varchar(250),
	primary key(mailProf)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table MATIERES(
	idMat int AUTO_INCREMENT,
	libelle varchar(25),
	primary key(idMat)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table NIVEAUX(
	idNiveau int AUTO_INCREMENT,
	libelle varchar(25),
	primary key(idNiveau)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table ELEVE(
	mailEleve varchar(40) not null,
	nom varchar(25),
	prenom varchar(25),
	adresse varchar(100),
	idNiv int,
	constraint fk_ELEVE_NIVEAUX foreign key(idNiv) references NIVEAUX(idNiveau),
	primary key(mailEleve)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table COMPETENCES(
	mailProf varchar(40),
	idMat int,
	idNiveau int,
	constraint fk_COMPETENCES_PROF foreign key(mailProf) references PROF(mailProf),
	constraint fk_COMPETENCES_MATIERES foreign key(idMat) references MATIERES(idMat),
	constraint fk_COMPETENCES_NIVEAUX foreign key(idNiveau) references NIVEAUX(idNiveau),
	primary key(mailProf,idMat,idNiveau)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table COURS(
	mailEleve varchar(40),
	mailProf varchar(40),
	idMat int,
	idNiveau int,
	dateCours date,
	etat ENUM('demande', 'accepte', 'fait'),
	constraint fk_COURS_ELEVE foreign key(mailEleve) references ELEVE(mailEleve),
	constraint fk_COURS_PROF foreign key(mailProf) references PROF(mailProf),
	constraint fk_COURS_MATIERES foreign key(idMat) references MATIERES(idMat),
	constraint fk_COURS_NIVEAUX foreign key(idNiveau) references NIVEAUX(idNiveau),
	primary key(mailEleve,mailProf,idMat,idNiveau,dateCours)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* Insertion des données */
insert into PROF values("prof1@gmail.com", "NomProf1", "PrenomProf1", "Bonjour, je fais des cours");
insert into PROF values("prof2@gmail.com", "NomProf2", "PrenomProf22", "Bonjour, ne prenez pas mes cours");

insert into MATIERES values(1, "Maths");
insert into MATIERES values(2, "Francais");
insert into MATIERES values(3, "Physique");

insert into NIVEAUX values(1, "6eme");
insert into NIVEAUX values(2, "5eme");
insert into NIVEAUX values(3, "4eme");

insert into ELEVE values("eleve1@gmail.com", "NomEleve1", "PrenomEleve1", "10 Avenue du Marechal Juin, 90000 Belfort", 1);
insert into ELEVE values("eleve2@gmail.com", "NomEleve2", "PrenomEleve2", "21 Place de la Republique, 90000 Belfort", 2);
insert into ELEVE values("eleve3@gmail.com", "NomEleve3", "PrenomEleve3", "19 Faubourg des Ancetres, 90000 Belfort", 3);

insert into COMPETENCES values("prof1@gmail.com",1,1);
insert into COMPETENCES values("prof1@gmail.com",3,2);
insert into COMPETENCES values("prof2@gmail.com",2,3);

insert into COURS values("eleve1@gmail.com","prof1@gmail.com", 1,1,"2018-01-15","demande");
insert into COURS values("eleve2@gmail.com","prof1@gmail.com", 3,2,"2018-01-16","demande");
insert into COURS values("eleve3@gmail.com","prof2@gmail.com", 2,3,"2018-01-17","accepte");
