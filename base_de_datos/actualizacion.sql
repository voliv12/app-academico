ALTER TABLE  `catedra` CHANGE  `modalidad`  `modalidad` ENUM(  'Escolarizado',  'Virtual' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `catedra` CHANGE  `periodo`  `periodo` ENUM(  'Febrero - Julio',  'Agosto - Enero',  'Ambos periodos',  'Intersemestral invierno',  'Intersemestral verano',  'Ambos intersemestrales' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `tutoria` ADD  `tipo` ENUM(  'Académica',  'Investigación',  'Posgrado' ) NOT NULL AFTER  `Academico_noPersonal`;
ALTER TABLE  `alianza` ADD  `Proyecto_idProyecto` INT NOT NULL AFTER  `Academico_noPersonal`;

ALTER TABLE  `proyecto` CHANGE  `Titulo`  `Titulo` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL

