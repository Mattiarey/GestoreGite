CREATE DATABASE Gite;
USE Gite;
CREATE TABLE Utenti(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(20),
    cognome VARCHAR(20),
    email VARCHAR(30),
    password VARCHAR(20)
    -- Spero non mi serva aggiungere altro
);
CREATE TABLE Mete(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(20),
    descrizione VARCHAR(255),
    data DATE,
    costo FLOAT,
    massimoPartecipanti INT
);
CREATE TABLE Tour(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(20),
    descrizione VARCHAR(255),
    durata INT, -- numero giorni
    costo FLOAT
);
CREATE TABLE Gita(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fkUtenti INT,
    FOREIGN KEY (fkUtenti)
        REFERENCES Utenti(id),
    fkMete INT,
    FOREIGN KEY (fkMete)
    	REFERENCES Mete(id)
);
CREATE TABLE Commenti(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(60),
    descrizione VARCHAR(255),
    valutazione FLOAT,
    link VARCHAR(255),
    fkUtenti INT,
    FOREIGN KEY (fkUtenti)
        REFERENCES Utenti(id),
    fkMete INT,
    FOREIGN KEY (fkMete)
    	REFERENCES Mete(id)
)