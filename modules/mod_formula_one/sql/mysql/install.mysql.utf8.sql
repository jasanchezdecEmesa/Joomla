CREATE TABLE IF NOT EXISTS `#__escuderias` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` varchar(100) NOT NULL,
	`pais` varchar(100) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__pilotos` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `apellido` varchar(100) NOT NULL,
    `id_escuderia` INT UNSIGNED NOT NULL,
    `fecha_nacimiento` DATE NOT NULL,
    `fecha_incorporacion` DATE NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_escuderia`) REFERENCES `#__escuderias`(`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

