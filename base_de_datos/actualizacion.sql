ALTER TABLE  `articulo_academico` ADD  `priority` INT NOT NULL AFTER  `noPersonal`

ALTER TABLE  `articulo` CHANGE  `autor_interno`  `participantes` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
CHANGE  `autor_externo`  `autor` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

ALTER TABLE  `articulo` ADD  `cuerpo_academico` VARCHAR( 150 ) NULL AFTER  `indizada_en`

ALTER TABLE  `articulo` ADD  `total_autores` INT NOT NULL AFTER  `participantes` ,
ADD  `posicion` INT NOT NULL AFTER  `total_autores`

ALTER TABLE  `categoria` ADD  `perfil` VARCHAR( 20 ) NOT NULL AFTER  `nombre_categoria`

ALTER TABLE  `perfil` DROP  `perfil`

ALTER TABLE  `libro` CHANGE  `autor_interno`  `participantes` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , CHANGE  `autor_externo`  `autor` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

ALTER TABLE  `libro_academico` ADD  `priority` INT NOT NULL

ALTER TABLE  `capitulo_academico` ADD  `priority` INT NOT NULL

ALTER TABLE  `cuerpo_academico` ADD  `priority` INT NOT NULL

ALTER TABLE  `evento_academico` ADD  `priority` INT NOT NULL

ALTER TABLE  `ponencia_academico` ADD  `priority` INT NOT NULL

ALTER TABLE  `libro` ADD  `cuerpo_academico` VARCHAR( 150 ) NULL AFTER  `lugar_publicacion`

ALTER TABLE  `capitulo` CHANGE  `autor_interno`  `participantes` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `autor_externo`  `autor` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

ALTER TABLE  `capitulo` ADD  `cuerpo_academico` VARCHAR( 150 ) NULL AFTER  `lugar_publicacion`

ALTER TABLE  `articulo` CHANGE  `posicion`  `autor_principal` VARCHAR( 50 ) NOT NULL

ALTER TABLE  `articulo` ADD  `autor_principal_ex` VARCHAR( 255 ) NULL AFTER  `autor_principal` ,
ADD  `autor_correspondencia` VARCHAR( 50 ) NOT NULL AFTER  `autor_principal_ex` ,
ADD  `autor_correspondencia_ex` VARCHAR( 255 ) NULL AFTER  `autor_correspondencia`

CREATE TABLE  `informacion_academica`.`departamento` (
`idDepartamento` INT NOT NULL AUTO_INCREMENT ,
`nombre_depto` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `idDepartamento` )
) ENGINE = MYISAM ;

ALTER TABLE  `academico` CHANGE  `departamento`  `departamento` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL

INSERT INTO  `informacion_academica`.`categoria` (
`idCategoria` ,
`nombre_categoria` ,
`perfil`
)
VALUES (
NULL ,  'NO APLICA',  'NO APLICA'
);

ALTER TABLE  `academico` CHANGE  `grado`  `grado` ENUM(  'Licenciatura',  'Especialidad',  'Especialidad Médica',  'Maestría',  'Doctorado',  'No aplica' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL

ALTER TABLE  `capitulo` ADD  `autor_principal` VARCHAR( 50 ) NOT NULL AFTER  `participantes` ,
ADD  `autor_principal_ex` VARCHAR( 255 ) NULL AFTER  `autor_principal`

ALTER TABLE  `proyecto` CHANGE  `productos`  `productos` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL

ALTER TABLE  `cuerpo` CHANGE  `integrantes_externos`  `integrantes_externos` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

ALTER TABLE  `cuerpo` ADD  `colaboradores_internos` VARCHAR( 200 ) NOT NULL AFTER  `integrantes_externos` ,
ADD  `colaboradores_externos` VARCHAR( 255 ) NOT NULL AFTER  `colaboradores_internos`

ALTER TABLE  `cuerpo` CHANGE  `integrantes_externos`  `integrantes_externos` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `colaboradores_externos`  `colaboradores_externos` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL


EXPORTAR TODA LA TABLA cuerpo_academico_col

ALTER TABLE  `financiamiento` ADD  `Destino` ENUM(  'Proyecto',  'Cuerpo Académico',  'Posgrado' ) NOT NULL AFTER  `Academico_noPersonal`

ALTER TABLE  `financiamiento` ADD  `Cuerpo_idCuerpo` INT NULL AFTER  `Proyecto_idProyecto`

ALTER TABLE  `financiamiento` CHANGE  `Proyecto_idProyecto`  `Proyecto_idProyecto` INT( 11 ) NULL

CREATE TABLE  `informacion_academica`.`posgrado` (
`idPosgrado` INT NOT NULL AUTO_INCREMENT ,
`nombre_posgrado` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `idPosgrado` )
) ENGINE = MYISAM ;

ALTER TABLE  `financiamiento` ADD  `Posgrado_idPosgrado` INT NULL AFTER  `Cuerpo_idCuerpo`

INSERT INTO  `informacion_academica`.`fuente` (
`idFuente` ,
`Fuente`
)
VALUES (
NULL ,  'PIFI'
);

UPDATE  `informacion_academica`.`fuente` SET  `Fuente` =  'CONACYT' WHERE  `fuente`.`idFuente` =1 LIMIT 1 ;

CREATE TABLE  `informacion_academica`.`donacion` (
`idDonacion` INT NOT NULL AUTO_INCREMENT ,
`Academico_noPersonal` INT NOT NULL ,
`destino` VARCHAR( 255 ) NOT NULL ,
`tipo` ENUM(  'Económica',  'Material',  'Reactivo' ) NOT NULL ,
`monto` INT NULL ,
`cantidad` VARCHAR( 100 ) NULL ,
`descripcion` VARCHAR( 255 ) NULL ,
`donante` VARCHAR( 255 ) NOT NULL ,
`fecha_donacion` DATE NOT NULL ,
`observaciones` TEXT NULL ,
PRIMARY KEY (  `idDonacion` )
) ENGINE = MYISAM ;

ALTER TABLE `articulo` MODIFY COLUMN `total_autores` int( 11 ) AFTER `titulo`

CREATE TABLE  `informacion_academica`.`servicio_social` (
`idServicio` INT NOT NULL AUTO_INCREMENT ,
`Academico_noPersonal` INT NOT NULL ,
`nombre_alumno` VARCHAR( 255 ) NOT NULL ,
`matricula` VARCHAR( 20 ) NULL ,
`facultad` VARCHAR( 100 ) NOT NULL ,
`fecha_inicio` DATE NOT NULL ,
`fecha_termino` DATE NOT NULL ,
`area_instituto` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `idServicio` )
) ENGINE = MYISAM ;

CREATE TABLE  `informacion_academica`.`facultad` (
`idFacultad` INT NOT NULL AUTO_INCREMENT ,
`nombre_facultad` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY (  `idFacultad` )
) ENGINE = MYISAM ;

EXPORTAR TODA LA TABLA DE facultad

CREATE TABLE  `informacion_academica`.`tutoria_sit` (
`idTutoria_sit` INT NOT NULL AUTO_INCREMENT ,
`nivel` ENUM(  'Licenciatura',  'Posgrado' ) NOT NULL ,
`facultad` VARCHAR( 100 ) NOT NULL ,
`posgrado` VARCHAR( 100 ) NOT NULL ,
`total_alumnos` INT NOT NULL ,
`reporte_SIT` VARCHAR( 255 ) NOT NULL ,
`vigente` BOOL NOT NULL ,
PRIMARY KEY (  `idTutoria_sit` )
) ENGINE = MYISAM ;
