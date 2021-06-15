CREATE TABLE categorias (
  id int NOT NULL,
  nombre varchar(30) NOT NULL,
  descripcion varchar(150) NOT NULL
) ;

ALTER TABLE public.categorias
    ADD COLUMN estado character varying(2) NOT NULL;

INSERT INTO categorias (id, nombre, descripcion) VALUES
(7, 'Despensa', 'Aceites & Aderezos, Caldos & Sopas, Endulzantes Naturales'),
(9, 'Alimentos Naturales', 'Frutas Secas & Mas, Alfajores, Bombones & Mas, Barritas, Snacks, Galletitas & Mas, Cereales & Granolas,  Dulces, Mermeladas & Mas'),
(10, 'Bebidas e Infusiones', 'Bebidas e Infusiones');

CREATE TABLE ofertas (
  id int NOT NULL,
  nombre varchar(30) NOT NULL,
  descripcion varchar(50) NOT NULL,
  precio int NOT NULL
) ;

CREATE TABLE ofertas_por_productos (
  ofertaid int NOT NULL,
  productoid int NOT NULL
) ;

CREATE TABLE productos (
  id int NOT NULL,
  nombre varchar(30) NOT NULL,
  descripcion varchar(100) NOT NULL,
  precio double precision NOT NULL,
  categoriaid int NOT NULL,
  destacado boolean(1) NOT NULL DEFAULT 'FALSE',
  imagen varchar(30) NOT NULL
) ;

INSERT INTO productos (id, nombre, descripcion, precio, categoriaid, destacado, imagen) VALUES
(7, 'Maní con Chocolate Premium', 'Maní con Chocolate Premium', 122, 7, b'1', 'mani.jpg'),
(9, 'Leche de Almendras', 'Leche de Almendras Pampa Vida - 1 Litro', 333, 7, b'0', 'lechealmendras.jpg'),
(10, 'Jugo de Arandanos', 'Jugo de Arandanos con Stevia El Bolson - 1 Litro', 65, 7, b'1', 'jugoalmendras.jpg'),
(11, 'Infusiones Adelgafruta', 'Infusiones Adelgafruta', 45, 7, b'1', 'infusiones.jpg');

CREATE TABLE usuarios (
  id_usuario int CHECK (id_usuario > 0) NOT NULL,
  nombre varchar(30) NOT NULL,
  apellido varchar(30) NOT NULL,
  usuario varchar(30) NOT NULL,
  clave varchar(100) NOT NULL
) ;

INSERT INTO usuarios (id_usuario, nombre, apellido, usuario, clave) VALUES
(13, 'Admin', 'Admin', 'admin', '$2y$10$Jc4t./ILgaDR3C6J9FUvpOXap5GaI8kjCNO3q7Fhe3NfYm9NDVHl.'),
(14, 'Nicolas', 'Alderete', 'usuario', '1234'),
(24, 'Martin', 'Lopez', '1234', '$2y$10$tW1QRrNRNcsECjwYuu5i4eANkGe1/3u0U6t/rS8WNwmEtmR1Dlp6q');

ALTER TABLE categorias
  ADD PRIMARY KEY (id);

ALTER TABLE ofertas
  ADD PRIMARY KEY (id);

ALTER TABLE ofertas_por_productos
  ADD PRIMARY KEY (ofertaid,productoid),
  ADD KEY productoid (productoid) USING BTREE,
  ADD KEY ofertaid (ofertaid);

ALTER TABLE productos
  ADD PRIMARY KEY (id),
  ADD KEY fk_categoria (categoriaid);

ALTER TABLE usuarios
  ADD PRIMARY KEY (id_usuario);

ALTER TABLE categorias
  MODIFY id cast(10 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE ofertas
  MODIFY id cast(10 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE productos
  MODIFY id cast(10 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE usuarios
  MODIFY id_usuario cast(5 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE ofertas_por_productos
  ADD CONSTRAINT ofertas_por_productos_ibfk_1 FOREIGN KEY (ofertaid) REFERENCES ofertas (id),
  ADD CONSTRAINT ofertas_por_productos_ibfk_2 FOREIGN KEY (productoid) REFERENCES productos (id);

ALTER TABLE productos
  ADD CONSTRAINT fk_categoria FOREIGN KEY (categoriaid) REFERENCES categorias (id);

ALTER TABLE ofertas ADD COLUMN disponible varchar(1) DEFAULT 'Y';

COMMIT;