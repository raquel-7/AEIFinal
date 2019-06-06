CREATE TABLE Usuario(
  usuario varchar(20),
  nombre varchar(50),
  contrasena varchar(20),
  PRIMARY KEY(usuario)
)

CREATE TABLE Modulo(
  idmod serial,
  titulo varchar(100),
  descripcion varchar(100),
  imagen bytea,
  PRIMARY KEY(idmod)
)


CREATE TABLE Lecciones(
  idl serial,
  titulo varchar(100),
  idmod int,
  contenido text,
  PRIMARY KEY(idl),
  FOREIGN KEY(idmod) REFERENCES Modulo (idmod)
)
CREATE TABLE Completado(
  usuario varchar(20),
  idl int,
  idmod int,
  completado text,
  PRIMARY KEY (usuario, idl, idmod),
  FOREIGN KEY (usuario) REFERENCES Usuario(usuario),
  FOREIGN KEY (idl) REFERENCES Lecciones(idl),
  FOREIGN KEY (idmod) REFERENCES Modulo (idmod)
)


CREATE TABLE Material(
  idm serial,
  tipo char(1),
  url varchar(20),
  secuencia serial,
  idl int,
  PRIMARY KEY(idm),
  FOREIGN KEY(idl) REFERENCES Lecciones (idl)
)

CREATE TABLE Escritura(
  usuario varchar(20),
  idl serial,
  idmod serial,
  comentario text,
  FOREIGN KEY (idl) REFERENCES Lecciones (idl),
  FOREIGN KEY (idmod) REFERENCES Modulo (idmod)
)
