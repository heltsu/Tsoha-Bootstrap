-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Member(
id SERIAL PRIMARY KEY,
name varchar(20) NOT NULL,
password varchar(16) NOT NULL
);

CREATE TABLE Job(
id SERIAL PRIMARY KEY,
member_id INTEGER REFERENCES Member(id),
name varchar NOT NULL,
priority varchar(2) NOT NULL,
added DATE,
done DATE
);

CREATE TABLE Category(
id SERIAL PRIMARY KEY,
name varchar(20) NOT NULL
);