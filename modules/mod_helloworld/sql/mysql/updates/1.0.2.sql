INSERT INTO `#__helloworld` (`hello`, `lang`)
SELECT 'Ciao Mondo', 'it-IT'
WHERE NOT EXISTS (
    SELECT 1 FROM `#__helloworld` WHERE `lang` = 'it-IT'
);