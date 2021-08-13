-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour fiato1481279_5na7tk
CREATE DATABASE IF NOT EXISTS `fiato1481279_5na7tk` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fiato1481279_5na7tk`;

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_abonnes
CREATE TABLE IF NOT EXISTS `fiat_abonnes` (
  `id_abonne` int(11) NOT NULL AUTO_INCREMENT,
  `prenom_abonne` varchar(200) NOT NULL,
  `nom_abonne` varchar(200) NOT NULL,
  `email_abonne` varchar(250) NOT NULL,
  `telephone_abonne` varchar(100) NOT NULL,
  `mot_de_passe_abonne` varchar(250) NOT NULL,
  `statut_abonne` enum('offline','online') NOT NULL,
  `referal_key_abonne` varchar(250) NOT NULL,
  `referal_key_parain` varchar(250) NOT NULL DEFAULT 'FiaToBTC029202829672CDOUG',
  `pays_origine` varchar(250) NOT NULL,
  `province_abonne` varchar(250) NOT NULL,
  `ville_abonne` varchar(250) NOT NULL,
  `adresse` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `last_connect_date` datetime NOT NULL,
  `validation_code` varchar(250) NOT NULL,
  `date_envoi` date NOT NULL,
  `heure_envoi` time NOT NULL,
  `date_naissance` date NOT NULL,
  `photo_abonne` varchar(250) NOT NULL DEFAULT 'fiatobtc_user_avatar.png',
  `role_utilisateur` varchar(100) NOT NULL DEFAULT 'abonne',
  `statut_view` int(11) NOT NULL DEFAULT '0',
  `recuperationCode` varchar(250) NOT NULL,
  PRIMARY KEY (`id_abonne`)
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_bonus
CREATE TABLE IF NOT EXISTS `fiat_bonus` (
  `id_bonus` int(11) NOT NULL AUTO_INCREMENT,
  `numero_commande` varchar(250) NOT NULL,
  `id_abonne` int(11) NOT NULL,
  `key_parain` varchar(50) NOT NULL,
  `statut_bonus` enum('non réglé','réglé') NOT NULL,
  `date_creation_bonus` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_reglement` date NOT NULL,
  `motif_bonus` enum('achat','vente') NOT NULL,
  `statut_reclamation` enum('non','oui','fait') NOT NULL,
  PRIMARY KEY (`id_bonus`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_buyings
CREATE TABLE IF NOT EXISTS `fiat_buyings` (
  `id_achat` int(11) NOT NULL AUTO_INCREMENT,
  `numero_commande` text NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qte_achete_usd` varchar(250) NOT NULL,
  `qte_achete_btc` varchar(250) NOT NULL,
  `montant_envoye` varchar(150) NOT NULL,
  `codeProduit` varchar(50) NOT NULL,
  `frais_commission` varchar(250) NOT NULL,
  `taux_achat` varchar(250) NOT NULL,
  `total_a_payer` varchar(250) NOT NULL,
  `moyen_paiement` varchar(250) NOT NULL,
  `id_transaction` text NOT NULL,
  `etat_commande` enum('en cours','traitée','rejetée') NOT NULL,
  `statut_view` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `id_abonne` int(11) NOT NULL,
  `email_abonne` varchar(250) NOT NULL,
  `adresse_btc_client` text NOT NULL,
  `hash_code` text NOT NULL,
  `phone_transaction` varchar(150) NOT NULL,
  PRIMARY KEY (`id_achat`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_buyings_crypto_exchange
CREATE TABLE IF NOT EXISTS `fiat_buyings_crypto_exchange` (
  `id_buying` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaction` varchar(255) NOT NULL,
  `moyen_paiement` varchar(55) NOT NULL,
  `product` varchar(55) NOT NULL,
  `cryptoAdresseAch` varchar(250) NOT NULL,
  `qte_totale` varchar(55) NOT NULL,
  `qte_commande` varchar(55) NOT NULL,
  `date_envoi_cbe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_abonne` int(11) NOT NULL,
  `hashAcheteur` varchar(250) DEFAULT '',
  `statut_buy_exchange` enum('process','cancel','confirm') NOT NULL,
  `id_exchange` int(11) NOT NULL,
  `update_at_orders` date DEFAULT NULL,
  PRIMARY KEY (`id_buying`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_buyings_fiat_exchange
CREATE TABLE IF NOT EXISTS `fiat_buyings_fiat_exchange` (
  `id_buying` int(11) NOT NULL AUTO_INCREMENT,
  `moyen_paiement` varchar(55) DEFAULT NULL,
  `product` varchar(55) NOT NULL,
  `cryptoAdresseAch` varchar(250) DEFAULT NULL,
  `qte_totale` varchar(55) NOT NULL,
  `qte_commande` varchar(55) NOT NULL,
  `date_envoi_cbe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_abonne` int(11) NOT NULL,
  `hashAcheteur` varchar(250) NOT NULL DEFAULT '',
  `statut_buy_exchange` enum('process','cancel','confirm') NOT NULL,
  `id_exchange` int(11) NOT NULL,
  `update_at_orders` date DEFAULT NULL,
  `telephone` varchar(50) NOT NULL,
  PRIMARY KEY (`id_buying`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_crypto_fiat
CREATE TABLE IF NOT EXISTS `fiat_crypto_fiat` (
  `id_exchange` int(11) NOT NULL AUTO_INCREMENT,
  `cryptoAdresse` text NOT NULL,
  `date_change_statut` date DEFAULT NULL,
  `date_envoi` date NOT NULL,
  `email_abonne` varchar(100) NOT NULL,
  `hash` text NOT NULL,
  `id_abonne` int(11) NOT NULL,
  `moyen_paiement` varchar(50) NOT NULL,
  `product` varchar(55) NOT NULL,
  `qte` varchar(55) NOT NULL,
  `qte_max` text NOT NULL,
  `qte_min` varchar(55) NOT NULL,
  `statut_demande` enum('process','cancel','confirm') NOT NULL,
  `statut_view` varchar(55) NOT NULL,
  `taux` varchar(55) NOT NULL,
  `telephone` varchar(55) NOT NULL,
  PRIMARY KEY (`id_exchange`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_fiat_crypto
CREATE TABLE IF NOT EXISTS `fiat_fiat_crypto` (
  `id_exchange` int(11) NOT NULL AUTO_INCREMENT,
  `date_change_statut` date DEFAULT NULL,
  `date_envoi` date NOT NULL,
  `email_abonne` varchar(100) NOT NULL,
  `id_abonne` int(11) NOT NULL,
  `moyen_paiement` varchar(50) NOT NULL,
  `product` varchar(55) NOT NULL,
  `id_transaction` varchar(155) NOT NULL,
  `qte` varchar(55) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `qte_max` text NOT NULL,
  `statut_demande` enum('process','cancel','confirm') NOT NULL,
  `statut_view` varchar(55) NOT NULL,
  `taux` varchar(55) NOT NULL,
  PRIMARY KEY (`id_exchange`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_primes
CREATE TABLE IF NOT EXISTS `fiat_primes` (
  `id_prime` int(11) NOT NULL AUTO_INCREMENT,
  `montant` varchar(55) NOT NULL,
  `motif` text NOT NULL,
  `email_abonne` varchar(85) NOT NULL,
  `created_at_prime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_products
CREATE TABLE IF NOT EXISTS `fiat_products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(250) NOT NULL,
  `taux_achat` varchar(50) NOT NULL,
  `taux_vente` varchar(50) NOT NULL,
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_date_updated` datetime NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT '1',
  `product_publish` enum('online','offline') NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. fiat_soldes
CREATE TABLE IF NOT EXISTS `fiat_soldes` (
  `id_solde` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(55) NOT NULL,
  `cryptoAdresse` text,
  `id_transaction` text,
  `hash` text,
  `id_abonne` int(11) NOT NULL,
  `quantite_depose` varchar(55) NOT NULL,
  `statut_solde` enum('process','cancel','confirm') NOT NULL,
  `date_depot` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_solde`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table fiato1481279_5na7tk. payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `entered_amount` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `from_currency` varchar(250) NOT NULL,
  `to_currency` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `gateway_id` varchar(250) NOT NULL,
  `gateway_url` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut_view` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_moyen` varchar(200) NOT NULL,
  `phone_transaction` varchar(200) NOT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
