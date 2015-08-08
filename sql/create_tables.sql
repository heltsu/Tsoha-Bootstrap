-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Perheenjäsen(
id SERIAL PRIMARY KEY,
nimi varchar(20) NOT NULL,
salasana varchar(16) NOT NULL
);

CREATE TABLE Askare(
id SERIAL PRIMARY KEY,
perheenjäsen_id INTEGER REFERENCES Perheenjäsen(id),
nimi varchar NOT NULL,
tärkeys varchar(2) NOT NULL,
lisätty DATE,
valmis DATE
);

CREATE TABLE Luokka(
nimi varchar(20) NOT NULL 
);