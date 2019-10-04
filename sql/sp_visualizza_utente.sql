DELIMITER $$

DROP PROCEDURE IF EXISTS `sp_visualizza_utente` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_visualizza_utente`(IN utente_id INT)
BEGIN
  SELECT *
  FROM tblUtente
  WHERE IDutente = utente_id
  ORDER BY UserName;
END $$

DELIMITER ;