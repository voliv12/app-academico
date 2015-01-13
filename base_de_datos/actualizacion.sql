ALTER TABLE  `articulo_academico` ADD  `priority` INT NOT NULL AFTER  `noPersonal`

ALTER TABLE  `articulo` CHANGE  `autor_interno`  `participantes` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
CHANGE  `autor_externo`  `autor` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

ALTER TABLE  `articulo` ADD  `cuerpo_academico` VARCHAR( 150 ) NULL AFTER  `indizada_en`