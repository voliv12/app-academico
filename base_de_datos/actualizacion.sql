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
