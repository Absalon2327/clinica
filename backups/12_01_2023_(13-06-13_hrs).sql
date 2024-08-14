SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS clinica;

USE clinica;

DROP TABLE IF EXISTS tb_cita;

CREATE TABLE `tb_cita` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `fechahora_cita` datetime NOT NULL,
  `preparada_cita` tinyint(1) NOT NULL,
  `estado_cita` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cita`) USING BTREE,
  KEY `id_paciente` (`id_paciente`) USING BTREE,
  CONSTRAINT `tb_cita_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id_paciente`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_cita VALUES("1","7","2023-01-27 10:27:00","1","activa");
INSERT INTO tb_cita VALUES("2","7","2023-01-09 22:34:00","0","activa");
INSERT INTO tb_cita VALUES("3","8","2023-01-13 18:34:00","0","activa");
INSERT INTO tb_cita VALUES("49","1","2023-01-27 12:33:00","0","activa");



DROP TABLE IF EXISTS tb_consulta;

CREATE TABLE `tb_consulta` (
  `id_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediente_preparado` int(11) DEFAULT NULL,
  `receta_consulta` varchar(500) DEFAULT NULL,
  `fecha_consulta` datetime DEFAULT NULL,
  `monto_consulta` float(8,2) DEFAULT NULL,
  `estado_consulta` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_consulta`) USING BTREE,
  KEY `fk_expediente` (`id_expediente_preparado`) USING BTREE,
  CONSTRAINT `fk_tbpreparar` FOREIGN KEY (`id_expediente_preparado`) REFERENCES `tb_preparar` (`id_expe_preparado`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_consulta VALUES("22","10","Virogrip","2023-01-10 10:51:22","15.00","pagada");
INSERT INTO tb_consulta VALUES("23","9","Alerfin","2023-01-10 21:49:56","10.00","pagada");
INSERT INTO tb_consulta VALUES("27","15","Alerfin","2023-01-12 13:04:29","10.00","realizada");



DROP TABLE IF EXISTS tb_expediente;

CREATE TABLE `tb_expediente` (
  `id_expediente` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `diabetes_mellitus` varchar(4) DEFAULT NULL,
  `parentesco_diabetes` varchar(15) DEFAULT NULL,
  `hipertension_arterial` varchar(4) DEFAULT NULL,
  `parentesco_hip_ar` varchar(15) DEFAULT NULL,
  `cardipatia_isquemica` varchar(4) DEFAULT NULL,
  `parentesco_card_isq` varchar(15) DEFAULT NULL,
  `cancer` varchar(4) DEFAULT NULL,
  `parentesco_can` varchar(15) DEFAULT NULL,
  `otro_hereditario` varchar(50) DEFAULT NULL,
  `tipo_familia` varchar(10) DEFAULT NULL,
  `rol_madre` varchar(4) DEFAULT NULL,
  `familia` varchar(3) DEFAULT NULL,
  `disfunciones_familiares` varchar(4) DEFAULT NULL,
  `esado_civil` varchar(10) DEFAULT NULL,
  `escolaridad` varchar(25) DEFAULT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `alimentacion` varchar(3) DEFAULT NULL,
  `habitacion` varchar(25) DEFAULT NULL,
  `higiene_personal` varchar(25) DEFAULT NULL,
  `ocupacion` varchar(25) DEFAULT NULL,
  `tiempo_ocupacion` varchar(10) DEFAULT NULL,
  `actividad_empresa` varchar(50) DEFAULT NULL,
  `factores_riesgo_laboral` varchar(50) DEFAULT NULL,
  `actividad_fisica` varchar(25) DEFAULT NULL,
  `patologias` varchar(50) DEFAULT NULL,
  `menarca` varchar(3) DEFAULT NULL,
  `num_embarazos` varchar(3) DEFAULT NULL,
  `inicio_vida_sexual` varchar(3) DEFAULT NULL,
  `num_partos` varchar(3) DEFAULT NULL,
  `fecha_ultima_menstruacion` date DEFAULT NULL,
  `fecha_ultimo_parto` date DEFAULT NULL,
  `num_hijos` varchar(3) DEFAULT NULL,
  `macrosomicos_vivos` varchar(7) DEFAULT NULL,
  `bajo_peso_nacer` varchar(4) DEFAULT NULL,
  `num_parejas` varchar(3) DEFAULT NULL,
  `num_heteros` varchar(3) DEFAULT NULL,
  `num_homosexuales` varchar(3) DEFAULT NULL,
  `num_bisexuales` varchar(3) DEFAULT NULL,
  `metodo_planificacion_familiar` varchar(50) DEFAULT NULL,
  `padecimiento_actual` varchar(100) DEFAULT NULL,
  `aparatos_sistemas` varchar(100) DEFAULT NULL,
  `auxiliares_diagnostico_previo` varchar(100) DEFAULT NULL,
  `estado_expe` varchar(10) DEFAULT NULL,
  `estado_preparacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_expediente`) USING BTREE,
  KEY `fk_paciente` (`id_paciente`) USING BTREE,
  CONSTRAINT `fk_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id_paciente`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_expediente VALUES("1","1","SI","Madre","SI","Madre","SI","Madre","SI","Padre","","NUCLEAR","E-C","D","NO","Acompañado","Bachillerato","Cristiano Evangélico","2","Casa Propia","Dos veces al día","Empleado","8","Alimenticio","Enfermedad","Correr","Memoria corto plazo","0","0","20","0","0000-00-00","0000-00-00","0","0","n/a","1","1","0","0","Ninguno","Ninguno","Ninguno","Ninguno","activo","1");
INSERT INTO tb_expediente VALUES("2","7","NO","n/a","SI","Abuelos","NO","n/a","SI","Tios","n/a","COMPUESTA","E-S","I","NO","Divorciado","Bachillerato","Católico","1","Alquilado","Una vez al día","Deportista","6","n/a","n/a","Futbol","Memoria Corto Plazo","0","0","15","0","0000-00-00","0000-00-00","2","0","n/a","4","3","2","1","n/a","Ninguno","Ninguno","Ninguno","activo","0");
INSERT INTO tb_expediente VALUES("3","6","NO","n/a","NO","n/a","NO","n/a","NO","n/a","","EXTENSA","E-C","D","SI","Soltero","Básica","Cristiano Evangélico","2","Alquilado","Una vez al día","Deportista","12","n/a","n/a","Futbol","","","0","15","","0000-00-00","0000-00-00","0","0","n/a","3","3","0","0","n/a","Ninguno","Ninguno","Ninguno","activo","1");
INSERT INTO tb_expediente VALUES("4","2","NO","n/a","NO","n/a","NO","n/a","NO","n/a","n/a","NUCLEAR","E-M","D","NO","Soltero","Educación Superior","Cristiano Evangélico","2","Casa Propia","Una vez al día","Estudiante","8","n/a","n/a","Entrenamiento Progresivo","ALÉRGICOS","0","0","0","0","0000-00-00","0000-00-00","0","0","n/a","0","0","0","0","Ninguno","Ninguno","Ninguno","Ninguno","activo","0");
INSERT INTO tb_expediente VALUES("5","3","SI","Padre","SI","Padre","SI","Madre","SI","Madre","Tiroides","EXTENSA","E-C","I","SI","Divorciado","Básica","Testigo de Jehova","1","Alquilado","Una Vez a la semana","Empleado","8","Alimenticio","Enfermedad","Correr","ALCOHOLISMOS","14","2","17","2","2023-01-04","2022-07-19","2","0","SI","3","1","1","2","n/a","Ninguno","Ninguno","Ninguno","activo","0");
INSERT INTO tb_expediente VALUES("6","11","NO","n/a","NO","n/a","NO","n/a","NO","n/a","n/a","NUCLEAR","E-M","D","NO","Casado","Básica","Católico","2","Casa Propia","Dos veces al día","Deportista","12","n/a","n/a","Correr","MÉDICO","12","3","12","3","2022-12-30","2013-05-28","3","1","SI","1","1","0","0","Ninguno","Ninguno","Ninguno","Ninguno","activo","0");
INSERT INTO tb_expediente VALUES("7","8","NO","n/a","NO","n/a","NO","n/a","NO","n/a","n/a","EXTENSA","E-M","D","NO","Soltero","Básica","Cristiano Evangélico","1","Casa Propia","Una vez al día","Deportista","12","n/a","n/a","Futbol","MÉDICO","0","0","0","0","0000-00-00","0000-00-00","0","","n/a","0","0","0","0","n/a","Ninguno","Ninguno","Ninguno","activo","0");
INSERT INTO tb_expediente VALUES("8","4","NO","n/a","NO","n/a","NO","n/a","NO","n/a","n/a","NUCLEAR","E-M","D","SI","Soltero","Básica","Cristiano Evangélico","1","Casa Propia","Dos veces al día","Deportista","8","n/a","n/a","Correr","QUIRÚRGICO","0","0","0","0","0000-00-00","0000-00-00","0","0","n/a","0","0","0","0","n/a","Sinusitis","Ninguno","Ninguno","activo","0");



DROP TABLE IF EXISTS tb_histo_clinico;

CREATE TABLE `tb_histo_clinico` (
  `id_histo_cli` int(11) NOT NULL AUTO_INCREMENT,
  `idconsulta` int(11) DEFAULT NULL,
  `diagnostico_consulta` varchar(500) DEFAULT NULL,
  `estado_hc` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_histo_cli`) USING BTREE,
  KEY `fk_tbconsulta` (`idconsulta`),
  CONSTRAINT `fk_tbconsulta` FOREIGN KEY (`idconsulta`) REFERENCES `tb_consulta` (`id_consulta`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_histo_clinico VALUES("1","22","Gripa","activo");
INSERT INTO tb_histo_clinico VALUES("2","23","Alergia","activo");
INSERT INTO tb_histo_clinico VALUES("3","27","Alergia","activo");



DROP TABLE IF EXISTS tb_paciente;

CREATE TABLE `tb_paciente` (
  `id_paciente` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_paciente` varchar(255) NOT NULL,
  `apellido_paciente` varchar(250) NOT NULL,
  `dui_paciente` varchar(10) DEFAULT NULL,
  `fecha_paciente` date NOT NULL,
  `tel_paciente` varchar(9) NOT NULL,
  `direccion_paciente` varchar(250) NOT NULL,
  `sexo_paciente` varchar(10) NOT NULL,
  `nombres_encargado` varchar(250) DEFAULT NULL,
  `estado_paciente` varchar(10) NOT NULL,
  PRIMARY KEY (`id_paciente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_paciente VALUES("1","Kevin","Mejia","05813820-5","2002-11-21","7420-5755","Tecoluca","Masculino","Estela Hernández","activo");
INSERT INTO tb_paciente VALUES("2","Fabri","Corvera","25653256-8","2009-02-01","7898-8956","Cedros","Masculino","Juan Mejía","activo");
INSERT INTO tb_paciente VALUES("3","Claudita","Arevali","12345678-5","1996-07-15","7898-8988","San Ildefonso","Femenino","Julia de Mejía","activo");
INSERT INTO tb_paciente VALUES("4","William Antonio","Del Cid Mejia","","2009-11-01","","Reparto Las Cañas","Masculino","Mishell Perdonmo","activo");
INSERT INTO tb_paciente VALUES("6","Juan","Corvera","23545648-7","2004-12-29","1231-5465","SV","Masculino","Dominga Hernández","activo");
INSERT INTO tb_paciente VALUES("7","Juan","Hernández","12315468-7","2004-12-09","6544-8899","SV","Masculino","Maura Hernández","activo");
INSERT INTO tb_paciente VALUES("8","Hernán","Marahona","12315468-9","2004-12-03","1225-4877","SV","Masculino","José Barahona","activo");
INSERT INTO tb_paciente VALUES("9","José","Ayala","98644548-7","2019-02-06","7897-8456","San Ildefonso","Masculino","Hernan Ayala","activo");
INSERT INTO tb_paciente VALUES("10","Yoselin","Arévalo","85412111-4","2019-07-05","7897-8456","San Ildefonso","Femenino","Claudia Rivas","activo");
INSERT INTO tb_paciente VALUES("11","Ana Beatriz","Martínez Pineda","98784654-6","1975-01-23","7898-8988","Ctón. Ixcanales, Santo Domingo","Femenino","Mosiés Mejía","activo");



DROP TABLE IF EXISTS tb_pagos;

CREATE TABLE `tb_pagos` (
  `id_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `id_consulta` int(11) NOT NULL,
  `monto_pago` double NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `estado_pago` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_pagos`) USING BTREE,
  KEY `fk_consulta` (`id_consulta`) USING BTREE,
  CONSTRAINT `fk_consulta` FOREIGN KEY (`id_consulta`) REFERENCES `tb_consulta` (`id_consulta`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_pagos VALUES("2","22","15","2023-01-10 21:12:57","inactivo");
INSERT INTO tb_pagos VALUES("3","23","10","2023-01-10 21:50:16","activo");



DROP TABLE IF EXISTS tb_preparar;

CREATE TABLE `tb_preparar` (
  `id_expe_preparado` int(11) NOT NULL AUTO_INCREMENT,
  `idexpediente` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `presion_consulta` varchar(10) DEFAULT NULL,
  `temp_consulta` varchar(10) DEFAULT NULL,
  `altura_consulta` varchar(10) DEFAULT NULL,
  `peso_consulta` varchar(10) DEFAULT NULL,
  `estado_preparacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_expe_preparado`),
  KEY `fk_expediente_preparado` (`idexpediente`),
  CONSTRAINT `fk_expediente_preparado` FOREIGN KEY (`idexpediente`) REFERENCES `tb_expediente` (`id_expediente`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO tb_preparar VALUES("9","4","","123/65","36°C","1.82Mt","95Kg","0");
INSERT INTO tb_preparar VALUES("10","6","","156/55","36°C","1.56Mt","95Kg","0");
INSERT INTO tb_preparar VALUES("11","3","","159/8","36°C","1.82Mt","95Kg","1");
INSERT INTO tb_preparar VALUES("12","1","","156/9","1.37°C","1.89Mt","96Kg","1");
INSERT INTO tb_preparar VALUES("15","4","","129/85","36°C","1.80Mt","95Kg","0");



DROP TABLE IF EXISTS tb_receta_medica;

CREATE TABLE `tb_receta_medica` (
  `id_receta` int(11) NOT NULL AUTO_INCREMENT,
  `id_pago` int(11) NOT NULL,
  `url_receta` varchar(50) NOT NULL,
  PRIMARY KEY (`id_receta`) USING BTREE,
  KEY `fk_pago` (`id_pago`) USING BTREE,
  CONSTRAINT `fk_pago` FOREIGN KEY (`id_pago`) REFERENCES `tb_pagos` (`id_pagos`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




DROP TABLE IF EXISTS tb_usuario;

CREATE TABLE `tb_usuario` (
  `idusuario` varchar(4) NOT NULL,
  `dui` varchar(10) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idusuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_usuario VALUES("1","12345678-9","Fabricio Corvera","fabri","$2y$10$oqBvEj4AheQDDmkrJ02P0eH9ISrPiFxSS/9CkNylitQcqQsyDRWzK","1","Activo");
INSERT INTO tb_usuario VALUES("2","12345679-9","Cristian","Cris","$2y$10$nbjfTKUeS/2S/9gMyN8oX.3gloabv7A1Jb7TZk1rieRLGSO2o6Nuq","2","Activo");
INSERT INTO tb_usuario VALUES("3","12346787-8","Moisés","Snow","$2y$10$r7CccZuBzx1GbrC9VaQRWeKgjg7H29obzywL1fA954yoywno072Le","1","Activo");
INSERT INTO tb_usuario VALUES("4","12346787-4","Hernán","Snow","$2y$10$AJfJyr0MQikwAr4.Rua0yOC5hm3lWNWjwEb5fcpF1YbOTu3wDUcUa","2","Activo");



SET FOREIGN_KEY_CHECKS=1;