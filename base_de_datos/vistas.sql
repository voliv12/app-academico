CREATE VIEW articulo_departamento AS (
SELECT DISTINCT articulo_academico.idArticulo,departamento.nombre_depto, articulo.titulo, articulo.autor, articulo.autor_principal, articulo.autor_principal_ex, articulo.participantes, articulo.autor_correspondencia, articulo.autor_correspondencia_ex, articulo.fecha
FROM departamento
JOIN academico ON academico.departamento = departamento.idDepartamento
JOIN articulo_academico ON articulo_academico.noPersonal = academico.noPersonal
JOIN articulo ON articulo.idArticulo = articulo_academico.idArticulo
ORDER BY articulo.idArticulo ASC
)

CREATE VIEW articulo_colaboracion AS (
SELECT *
FROM articulo_departamento
WHERE articulo_departamento.idArticulo
IN (
SELECT articulo_departamento.idArticulo
FROM articulo_departamento
GROUP BY articulo_departamento.idArticulo
HAVING COUNT( idArticulo ) >1
)
ORDER BY  `articulo_departamento`.`fecha` DESC
LIMIT 0 , 30
)

#////////////////////////////////////////////////////// libro

CREATE VIEW libro_departamento AS (
SELECT DISTINCT libro_academico.idLibro, departamento.nombre_depto, libro.titulo, libro.autor, libro.participantes, libro.fecha
FROM departamento
JOIN academico ON academico.departamento = departamento.idDepartamento
JOIN libro_academico ON libro_academico.noPersonal = academico.noPersonal
JOIN libro ON libro.idLibro = libro_academico.idLibro
ORDER BY libro.idLibro ASC
)

#////////////////////////////////////////// capitulos de libro

CREATE VIEW capitulo_departamento AS (
SELECT DISTINCT capitulo_academico.idCapitulo, departamento.nombre_depto, capitulo.titulo, capitulo.autor, capitulo.autor_principal, capitulo.autor_principal_ex, capitulo.participantes, capitulo.fecha
FROM departamento
JOIN academico ON academico.departamento = departamento.idDepartamento
JOIN capitulo_academico ON capitulo_academico.noPersonal = academico.noPersonal
JOIN capitulo ON capitulo.idCapitulo = capitulo_academico.idCapitulo
ORDER BY capitulo.idCapitulo ASC
)


CREATE VIEW capitulo_colaboracion AS (
SELECT *
FROM capitulo_departamento
WHERE capitulo_departamento.idCapitulo
IN (
SELECT capitulo_departamento.idCapitulo
FROM capitulo_departamento
GROUP BY capitulo_departamento.idCapitulo
HAVING COUNT( idCapitulo ) >1
)
ORDER BY  `capitulo_departamento`.`fecha` DESC
LIMIT 0 , 30
)




