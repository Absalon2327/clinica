SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS clinica_final;

USE clinica_final;

DROP TABLE IF EXISTS tb_cita;

CREATE TABLE `tb_cita` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `fechahora_cita` datetime NOT NULL,
  `preparada_cita` tinyint(1) NOT NULL,
  `estado_cita` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cita`) USING BTREE,
  KEY `tb_cita_ibfk_1` (`id_paciente`) USING BTREE,
  CONSTRAINT `tb_cita_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id_paciente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




DROP TABLE IF EXISTS tb_consulta;

CREATE TABLE `tb_consulta` (
  `id_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediente_preparado` int(11) DEFAULT NULL,
  `receta_consulta` varchar(500) DEFAULT NULL,
  `fecha_consulta` datetime DEFAULT NULL,
  `monto_consulta` float(8,2) DEFAULT NULL,
  `estado_consulta` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_consulta`) USING BTREE,
  KEY `fk_tbpreparar` (`id_expediente_preparado`) USING BTREE,
  CONSTRAINT `fk_tbpreparar` FOREIGN KEY (`id_expediente_preparado`) REFERENCES `tb_preparar` (`id_expe_preparado`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




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
  `padecimiento_actual` varchar(255) DEFAULT NULL,
  `aparatos_sistemas` varchar(255) DEFAULT NULL,
  `auxiliares_diagnostico_previo` varchar(255) DEFAULT NULL,
  `estado_expe` varchar(10) DEFAULT NULL,
  `estado_preparacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_expediente`) USING BTREE,
  KEY `fk_paciente` (`id_paciente`) USING BTREE,
  CONSTRAINT `fk_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id_paciente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




DROP TABLE IF EXISTS tb_histo_clinico;

CREATE TABLE `tb_histo_clinico` (
  `id_histo_cli` int(11) NOT NULL AUTO_INCREMENT,
  `idconsulta` int(11) DEFAULT NULL,
  `diagnostico_consulta` varchar(500) DEFAULT NULL,
  `estado_hc` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_histo_cli`) USING BTREE,
  KEY `fk_tbconsulta` (`idconsulta`) USING BTREE,
  CONSTRAINT `fk_tbconsulta` FOREIGN KEY (`idconsulta`) REFERENCES `tb_consulta` (`id_consulta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




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
  PRIMARY KEY (`id_paciente`) USING BTREE,
  KEY `tb_paciente_ibfk_1` (`nombres_encargado`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




DROP TABLE IF EXISTS tb_pagos;

CREATE TABLE `tb_pagos` (
  `id_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `id_consulta` int(11) NOT NULL,
  `monto_pago` double NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `estado_pago` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pagos`) USING BTREE,
  KEY `fk_consulta` (`id_consulta`) USING BTREE,
  CONSTRAINT `fk_consulta` FOREIGN KEY (`id_consulta`) REFERENCES `tb_consulta` (`id_consulta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




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
  PRIMARY KEY (`id_expe_preparado`) USING BTREE,
  KEY `fk_expediente_preparado` (`idexpediente`) USING BTREE,
  CONSTRAINT `fk_expediente_preparado` FOREIGN KEY (`idexpediente`) REFERENCES `tb_expediente` (`id_expediente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;




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
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idusuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO tb_usuario VALUES("1","12345678-9","Fabricio Corvera","fabri","$2y$10$ePkJRD2Lj5odJ4r5lfd4wOm.9CJYqxNp80gZS.apP/jrwcY9CtWRW","1","Activo");
INSERT INTO tb_usuario VALUES("2","21365487-9","Carmen","Enfermera","$2y$10$GA.X8/00QqfchXq2e6H8BeenreF79jxrvQ3I5UlDHIOn0PVFDXjTG","2","Activo");



SET FOREIGN_KEY_CHECKS=1;