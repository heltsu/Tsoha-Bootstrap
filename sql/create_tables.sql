-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Perheenjasen(
id SERIAL PRIMARY KEY,
nimi varchar(20) NOT NULL,
salasana varchar(16) NOT NULL
);

CREATE TABLE Askare(
id SERIAL PRIMARY KEY,
perheenjasen_id integer, 
FOREIGN KEY (perheenjasen_id) REFERENCES Perheenjasen (id),
nimi varchar(30) NOT NULL,
tarkeys varchar(2) NOT NULL,
lisatty DATE,
valmis DATE 
);

CREATE TABLE Luokka(
id SERIAL PRIMARY KEY,
nimi varchar(20) NOT NULL 
);

CREATE TABLE LuokanAskareet(
askare_id integer NOT NULL,
luokka_id integer NOT NULL,
PRIMARY KEY (askare_id, luokka_id),
FOREIGN KEY (askare_id) REFERENCES Askare (id),
FOREIGN KEY (luokka_id) REFERENCES Luokka (id)
);
