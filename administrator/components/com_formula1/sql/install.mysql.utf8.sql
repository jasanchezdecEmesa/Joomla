CREATE TABLE IF NOT EXISTS `#__formula1_teams` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `country` VARCHAR(100) NOT NULL,
    `team_principal` VARCHAR(100) NOT NULL,
    `engine` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__formula1_drivers` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `nationality` VARCHAR(100) NOT NULL,
    `number` INT NOT NULL,
    `picture` VARCHAR(255) NULL DEFAULT NULL,
    `team_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_formula1_driver_team`
        FOREIGN KEY (`team_id`) REFERENCES `#__formula1_teams`(`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;