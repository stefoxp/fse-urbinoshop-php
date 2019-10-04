DELIMITER $$

DROP PROCEDURE IF EXISTS `urbino_shop`.`sp_visualizza_carrello` $$
CREATE PROCEDURE `urbino_shop`.`sp_visualizza_carrello` (IN utente_id_par INT)
BEGIN
SELECT tblcarrello.IDutente, tblcarrello.IDprodotto, tblcarrello.Quantità, tblprodotto.Nome, tblprodotto.Descrizione, tblprodotto.Foto, tblprodotto.Prezzo
FROM tblprodotto INNER JOIN tblcarrello ON tblprodotto.IDprodotto=tblcarrello.IDprodotto
WHERE tblCarrello.IDutente=utente_id_par
ORDER BY tblProdotto.Nome;
END $$

DELIMITER ;