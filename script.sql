DROP TABLE IF EXISTS Film;
DROP TABLE IF EXISTS Acteur;
DROP TABLE IF EXISTS Realisateur;
DROP TABLE IF EXISTS Utilisateur;

CREATE TABLE Acteur (
    Id INT PRIMARY KEY AUTO_INCREMENT,  
    Nom VARCHAR(50)NOT NULL,
    Prenom VARCHAR(50)NOT NULL,
    roleA VARCHAR(50)NOT NULL,
    datenaissance Date 
   
);

create table Realisateur(
    Id int PRIMARY KEY  AUTO_INCREMENT, 
    Nom VARCHAR(50)NOT NULL,
    Prenom VARCHAR(50)NOT NULL
);

CREATE TABLE Film (
    Id INT PRIMARY KEY AUTO_INCREMENT,  
    titre  VARCHAR(255) NOT NULL,
    durée  VARCHAR(255) NOT NULL,
    id_realisateur int NOT NULL,
    id_acteur int NOT NULL ,
    annéeS  int NOT NULL
);

CREATE TABLE Utilisateur (
    Id INT PRIMARY KEY AUTO_INCREMENT, 
    Nom VARCHAR(50)NOT NULL,
    Prenom VARCHAR(50)NOT NULL,
    Email VARCHAR(50)NOT NULL,
    mdp VARCHAR(50)NOT NULL,
    id_film int NOT NULL
);

ALTER TABLE Film 
ADD FOREIGN KEY (id_realisateur) REFERENCES Realisateur(Id);

ALTER TABLE Film 
ADD FOREIGN KEY (id_acteur) REFERENCES Acteur(Id);

ALTER TABLE Utilisateur
ADD FOREIGN KEY (id_film) REFERENCES Film(Id);


INSERT INTO Realisateur (Nom, Prenom) VALUES 
('NomR1', 'PrenomR1'),
('NomR2', 'PrenomR2'),
('NomR3', 'PrenomR3');

INSERT INTO Acteur (Nom, Prenom, roleA, datenaissance) VALUES 
('leo', 'leo', 'principal', '1974-11-11'),
('lisa', 'Kate', 'secondaire', '1975-10-05'),
('sami', 'rebert', 'principal', '1968-09-25'),
('aya', 'elen', 'secondaire', '1984-11-22');

INSERT INTO Film (titre, durée, id_realisateur, id_acteur, annéeS) VALUES 
('divergent', '148 minutes', 1, 1, 2010),
('insurgent', '165 minutes', 2, 3, 2012),
('blackrock', '127 minutes', 3, 4, 1993),
('inception', '195 minutes', 1, 2, 1997);

INSERT INTO Utilisateur (Nom, Prenom, Email, mdp, id_film) VALUES 
('u1', 'u1', 'u1@gmail.com', 'password123', 1),
('u2', 'u2', 'u2@gmail.com', 'password123', 2),
('u3', 'u3', 'u3@gmail.com', 'password123', 3),
('u4', 'u4', 'u4@gmail.com', 'password123', 4)

--1) Les titres et années de sortie des films du plus récent au plus ancien
SELECT titre, annéeS 
FROM Film 
ORDER BY annéeS DESC;

--2) La liste des acteurs/actrices principaux pour un film donné
SELECT a.Nom, a.Prenom 
FROM Acteur a
JOIN Film f ON a.Id = f.id_acteur 
WHERE f.titre = 'Inception';

--3) La liste des films pour un acteur/actrice donné
SELECT f.titre 
FROM Film f
JOIN Acteur a ON f.id_acteur = a.Id 
WHERE a.Nom = 'aya' AND a.Prenom = 'elen';

--4) Ajouter un film
INSERT INTO Film (titre, durée, id_realisateur, id_acteur, annéeS) 
VALUES ('sapiens', '120 minutes', 1, 1, 2023);

--5) Ajouter un acteur/actrice
INSERT INTO Acteur (Nom, Prenom, roleA, datenaissance) 
VALUES ('Nomacteur', 'Prenomacteur', 'secondaire', '1990-01-01');

--6) Modifier un film
UPDATE Film 
SET titre = 'modif' 
WHERE Id = 1;

--7) Supprimer un acteur/actrice
DELETE FROM Acteur 
WHERE Id = 1;

--8) Afficher les 3 derniers acteurs/actrices ajouté(e)s
SELECT * 
FROM Acteur 
ORDER BY Id DESC 
LIMIT 3;
--9) Afficher le film le plus ancien
SELECT * 
FROM Film 
ORDER BY annéeS ASC 
LIMIT 1;
--10) Afficher l’acteur le plus jeune
SELECT * 
FROM Acteur 
ORDER BY datenaissance DESC 
LIMIT 1;
--11) Compter le nombre de films réalisés en 1990
SELECT COUNT(*) AS NombreDeFilms 
FROM Film 
WHERE annéeS = 1990;
--12) Faire la somme de tous les acteurs ayant joué dans un film
SELECT COUNT(DISTINCT id_acteur) AS NombreDActeurs 
FROM Film;