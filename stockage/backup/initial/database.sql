-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 28 mai 2020 à 10:34
-- Version du serveur :  10.2.6-MariaDB-log
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vente`
--

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `approvisionnement`
--

INSERT INTO `approvisionnement` (`id`, `reference`, `montant`, `avance`, `reste`, `fournisseur_id`, `operation_id`, `datelivraison`, `etat_id`, `employe_id`, `comment`, `employe_id_reception`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'INITIAL', 0, 0, 0, 1, 0, NULL, 4, 0, 'approvisionnemnt initial, système !', NULL, 0, '2020-05-27 15:04:53', '2020-05-27 15:04:53', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `carplan`
--

CREATE TABLE `carplan` (
  `id` int(11) NOT NULL,
  `matricule` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `sexe_id` int(2) DEFAULT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `fonction` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `password` text COLLATE utf8_bin DEFAULT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `allowed` int(11) NOT NULL DEFAULT 1,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1,
  `visibility` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorieoperation`
--

CREATE TABLE `categorieoperation` (
  `id` int(11) NOT NULL,
  `typeoperationcaisse_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `color` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorieoperation`
--

INSERT INTO `categorieoperation` (`id`, `typeoperationcaisse_id`, `name`, `color`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 'Réglement de commande', '#ffffff', '2020-05-27 15:04:50', '2020-05-27 15:04:50', 1, 1),
(2, 1, 'Remboursement par le fournisseur', '#ffffff', '2020-05-27 15:04:50', '2020-05-27 15:04:50', 1, 1),
(3, 1, 'Location d\'engins pour livraison', '#ffffff', '2020-05-27 15:04:50', '2020-05-27 15:04:50', 1, 1),
(4, 1, 'Autre entrée en caisse', '#ffffff', '2020-05-27 15:04:50', '2020-05-27 15:04:50', 1, 1),
(5, 2, 'Réglement de facture d\'approvisionnemnt', '#ffffff', '2020-05-27 15:04:50', '2020-05-27 15:04:50', 1, 1),
(6, 2, 'Payement de salaire du personnel', '#ffffff', '2020-05-27 15:04:51', '2020-05-27 15:04:51', 1, 1),
(7, 2, 'Réglement de facture de reparation / d\'entretien', '#ffffff', '2020-05-27 15:04:51', '2020-05-27 15:04:51', 1, 1),
(8, 2, 'Remboursement du client', '#ffffff', '2020-05-27 15:04:51', '2020-05-27 15:04:51', 1, 1),
(9, 2, 'Location de tricycle pour livraison', '#ffffff', '2020-05-27 15:04:51', '2020-05-27 15:04:51', 1, 1),
(10, 2, 'Autre dépense', '#ffffff', '2020-05-27 15:04:51', '2020-05-27 15:04:51', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `typeclient_id` int(2) NOT NULL,
  `acompte` int(11) DEFAULT NULL,
  `dette` int(11) NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name`, `typeclient_id`, `acompte`, `dette`, `adresse`, `email`, `contact`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Monsieur Tout le Monde', 1, 0, 0, '...', NULL, '...', 0, '2020-05-27 15:04:47', '2020-05-27 15:04:47', 1, 1),
(2, 'client A', 1, 0, 1000, '', '', '', 1, '2020-05-27 15:18:11', '2020-05-27 15:18:11', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `zonedevente_id` int(11) NOT NULL,
  `lieu` varchar(200) COLLATE utf8_bin NOT NULL,
  `taux_tva` int(11) DEFAULT NULL,
  `tva` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `datelivraison` date NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `acompteClient` int(11) NOT NULL,
  `detteClient` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `reference`, `groupecommande_id`, `zonedevente_id`, `lieu`, `taux_tva`, `tva`, `montant`, `avance`, `reste`, `operation_id`, `datelivraison`, `employe_id`, `etat_id`, `comment`, `acompteClient`, `detteClient`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'BCO/27052020-6AC948', 1, 1, 'Katiala, Ferké, Boudiali', 0, 0, 3000, 2000, 1000, 1, '2020-05-29', 1, 4, '', 0, 1000, '2020-05-27 15:26:36', '2020-05-27 15:26:36', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commercial`
--

CREATE TABLE `commercial` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `sexe_id` int(2) NOT NULL,
  `nationalite` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `salaire` int(11) NOT NULL,
  `disponibilite_id` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commercial`
--

INSERT INTO `commercial` (`id`, `name`, `sexe_id`, `nationalite`, `adresse`, `email`, `contact`, `salaire`, `disponibilite_id`, `image`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'La boutique', 1, NULL, 'Magazin à bassam', NULL, '...', 0, 2, 'default.png', 0, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 1, 1),
(2, 'Amadou Charles', 1, 'Ivoirienne', '22 rue des chantilles, korogho 24 Bd', NULL, '47 58 93 21', 35000, 2, 'default.png', 1, '2020-05-27 16:21:02', '2020-05-27 16:21:02', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `id` int(11) NOT NULL,
  `date_connexion` datetime DEFAULT NULL,
  `date_deconnexion` timestamp NULL DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id`, `date_connexion`, `date_deconnexion`, `employe_id`, `prestataire_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '2020-05-27 15:07:53', NULL, 1, NULL, '2020-05-27 15:07:53', '2020-05-27 15:07:53', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demandeentretien`
--

CREATE TABLE `demandeentretien` (
  `id` int(11) NOT NULL,
  `typeentretienvehicule_id` int(11) NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `vehicule_id` int(11) NOT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `image` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `disponibilite`
--

INSERT INTO `disponibilite` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(1, 'Indisponible', 'danger', 1, 1),
(2, 'Libre', 'warning', 1, 1),
(3, 'En mission', 'info', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0,
  `is_allowed` int(11) NOT NULL DEFAULT 1,
  `visibility` int(11) NOT NULL DEFAULT 0,
  `pass` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `name`, `adresse`, `email`, `contact`, `login`, `password`, `image`, `is_new`, `is_allowed`, `visibility`, `pass`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Super Administrateur', '...', 'info@devaris21.com', '...', 'root', '5e9795e3f3ab55e7790a6283507c085db0d764fc', 'default.png', 0, 1, 1, '', '2020-05-27 15:04:51', '2020-05-27 15:04:51', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE `energie` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `energie`
--

INSERT INTO `energie` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-05-27 15:05:17', '2020-05-27 15:05:17', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entretienmachine`
--

CREATE TABLE `entretienmachine` (
  `id` int(11) NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `machine_id` int(11) NOT NULL,
  `panne_id` int(11) DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `entretienvehicule`
--

CREATE TABLE `entretienvehicule` (
  `id` int(11) NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `typeentretienvehicule_id` int(11) NOT NULL,
  `demandeentretien_id` int(11) DEFAULT NULL,
  `vehicule_id` int(11) NOT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `name`, `class`, `protected`, `valide`) VALUES
(1, 'Annulé', 'danger', 1, 1),
(2, 'En cours', 'warning', 1, 1),
(3, 'Partiellement', 'info', 1, 1),
(4, 'Validé', 'success', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etatchauffeur`
--

CREATE TABLE `etatchauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etatmanoeuvre`
--

CREATE TABLE `etatmanoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etatvehicule`
--

CREATE TABLE `etatvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `exigenceproduction`
--

CREATE TABLE `exigenceproduction` (
  `id` int(11) NOT NULL,
  `produit_id` int(20) NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite_ressource` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `exigenceproduction`
--

INSERT INTO `exigenceproduction` (`id`, `produit_id`, `quantite_produit`, `ressource_id`, `quantite_ressource`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 0, 1, 0, '2020-05-27 15:05:08', '2020-05-27 15:05:08', 0, 1),
(2, 2, 0, 1, 0, '2020-05-27 15:05:09', '2020-05-27 15:05:09', 0, 1),
(3, 3, 0, 1, 0, '2020-05-27 15:05:09', '2020-05-27 15:05:09', 0, 1),
(4, 1, 0, 2, 0, '2020-05-27 15:05:10', '2020-05-27 15:05:10', 0, 1),
(5, 2, 0, 2, 0, '2020-05-27 15:05:11', '2020-05-27 15:05:11', 0, 1),
(6, 3, 0, 2, 0, '2020-05-27 15:05:11', '2020-05-27 15:05:11', 0, 1),
(7, 1, 0, 3, 0, '2020-05-27 15:05:12', '2020-05-27 15:05:12', 0, 1),
(8, 2, 0, 3, 0, '2020-05-27 15:05:13', '2020-05-27 15:05:13', 0, 1),
(9, 3, 0, 3, 0, '2020-05-27 15:05:13', '2020-05-27 15:05:13', 0, 1),
(10, 1, 0, 4, 0, '2020-05-27 15:05:14', '2020-05-27 15:05:14', 0, 1),
(11, 2, 0, 4, 0, '2020-05-27 15:05:14', '2020-05-27 15:05:14', 0, 1),
(12, 3, 0, 4, 0, '2020-05-27 15:05:14', '2020-05-27 15:05:14', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `acompte` int(11) NOT NULL,
  `dette` int(11) NOT NULL,
  `contact` varchar(150) COLLATE utf8_bin NOT NULL,
  `fax` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin DEFAULT NULL,
  `adresse` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `name`, `acompte`, `dette`, `contact`, `fax`, `email`, `adresse`, `image`, `description`, `visibility`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Devaris FOURNISSEUR', 0, 0, '...', '...', 'info@devaris21.com', '...', 'default.png', NULL, 0, '2020-05-27 15:04:47', '2020-05-27 15:04:47', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupecommande`
--

CREATE TABLE `groupecommande` (
  `id` int(11) NOT NULL,
  `client_id` int(20) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupecommande`
--

INSERT INTO `groupecommande` (`id`, `client_id`, `etat_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 2, 2, '2020-05-27 15:26:36', '2020-05-27 15:26:36', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupemanoeuvre`
--

CREATE TABLE `groupemanoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupemanoeuvre`
--

INSERT INTO `groupemanoeuvre` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-05-27 15:05:18', '2020-05-27 15:05:18', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupevehicule`
--

CREATE TABLE `groupevehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupevehicule`
--

INSERT INTO `groupevehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Camion de livraison', '2020-05-27 15:04:40', '2020-05-27 15:04:40', 1, 1),
(2, 'Véhicule de mission', '2020-05-27 15:04:41', '2020-05-27 15:04:41', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `sentense` text COLLATE utf8_bin NOT NULL,
  `typeSave` varchar(50) COLLATE utf8_bin NOT NULL,
  `record` varchar(200) COLLATE utf8_bin NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1,
  `recordId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `sentense`, `typeSave`, `record`, `employe_id`, `created`, `modified`, `protected`, `valide`, `recordId`) VALUES
(1, 'Ajout d\'un nouveau zone de vente : Au magasin dans les paramétrages', 'insert', 'zonedevente', 1, '2020-05-27 15:04:36', '2020-05-27 15:04:36', 0, 1, 1),
(2, 'Ajout d\'un nouveau zone de vente : Dans tout Bassam dans les paramétrages', 'insert', 'zonedevente', 1, '2020-05-27 15:04:36', '2020-05-27 15:04:36', 0, 1, 2),
(3, 'Ajout d\'un nouveau type de client : Directe dans les paramétrages', 'insert', 'typevente', 1, '2020-05-27 15:04:37', '2020-05-27 15:04:37', 0, 1, 1),
(4, 'Ajout d\'un nouveau type de client : Par Prospection/livraison dans les paramétrages', 'insert', 'typevente', 1, '2020-05-27 15:04:37', '2020-05-27 15:04:37', 0, 1, 2),
(5, 'Ajout d\'un nouveau type de client : Prospection par commercial dans les paramétrages', 'insert', 'typeprospection', 1, '2020-05-27 15:04:37', '2020-05-27 15:04:37', 0, 1, 1),
(6, 'Ajout d\'un nouveau type de client : livraison de commande dans les paramétrages', 'insert', 'typeprospection', 1, '2020-05-27 15:04:38', '2020-05-27 15:04:38', 0, 1, 2),
(7, 'Ajout d\'un nouveau type de sinistre : Voiture dans les paramétrages', 'insert', 'typevehicule', 1, '2020-05-27 15:04:38', '2020-05-27 15:04:38', 0, 1, 1),
(8, 'Ajout d\'un nouveau type de sinistre : Camion benne dans les paramétrages', 'insert', 'typevehicule', 1, '2020-05-27 15:04:38', '2020-05-27 15:04:38', 0, 1, 2),
(9, 'Ajout d\'un nouveau type de sinistre : Tricycle dans les paramétrages', 'insert', 'typevehicule', 1, '2020-05-27 15:04:39', '2020-05-27 15:04:39', 0, 1, 3),
(10, 'Ajout d\'un nouveau type de sinistre : Moto dans les paramétrages', 'insert', 'typevehicule', 1, '2020-05-27 15:04:39', '2020-05-27 15:04:39', 0, 1, 4),
(11, 'Ajout d\'un nouveau type d\'operation de vehicule : Entrée de caisse dans les paramétrages', 'insert', 'typeoperationcaisse', 1, '2020-05-27 15:04:39', '2020-05-27 15:04:39', 0, 1, 1),
(12, 'Ajout d\'un nouveau type d\'operation de vehicule : Sortie de caisse dans les paramétrages', 'insert', 'typeoperationcaisse', 1, '2020-05-27 15:04:39', '2020-05-27 15:04:39', 0, 1, 2),
(13, 'Ajout d\'un nouveau type d\'entretien de vehicule : Accrochage dans les paramétrages', 'insert', 'typeentretienvehicule', 1, '2020-05-27 15:04:40', '2020-05-27 15:04:40', 0, 1, 1),
(14, 'Ajout d\'un nouveau type d\'entretien de vehicule : Crevaison dans les paramétrages', 'insert', 'typeentretienvehicule', 1, '2020-05-27 15:04:40', '2020-05-27 15:04:40', 0, 1, 2),
(15, 'Ajout d\'un nouveau type d\'entretien de vehicule : Autre dans les paramétrages', 'insert', 'typeentretienvehicule', 1, '2020-05-27 15:04:40', '2020-05-27 15:04:40', 0, 1, 3),
(16, 'Ajout d\'un nouveau groupe de vehicule : Camion de livraison dans les paramétrages', 'insert', 'groupevehicule', 1, '2020-05-27 15:04:41', '2020-05-27 15:04:41', 0, 1, 1),
(17, 'Ajout d\'un nouveau groupe de vehicule : Véhicule de mission dans les paramétrages', 'insert', 'groupevehicule', 1, '2020-05-27 15:04:41', '2020-05-27 15:04:41', 0, 1, 2),
(18, 'Enregistrement d\'un nouveau véhicule N°1 immatriculé ....', 'insert', 'vehicule', 1, '2020-05-27 15:04:42', '2020-05-27 15:04:42', 0, 1, 1),
(19, 'Enregistrement d\'un nouveau véhicule N°2 immatriculé ....', 'insert', 'vehicule', 1, '2020-05-27 15:04:42', '2020-05-27 15:04:42', 0, 1, 2),
(20, 'Ajout d\'un nouveau type de client : Entreprise dans les paramétrages', 'insert', 'typeclient', 1, '2020-05-27 15:04:42', '2020-05-27 15:04:42', 0, 1, 1),
(21, 'Ajout d\'un nouveau type de client : Particulier dans les paramétrages', 'insert', 'typeclient', 1, '2020-05-27 15:04:43', '2020-05-27 15:04:43', 0, 1, 2),
(22, 'Ajout d\'un nouveau genre : Homme dans les paramétrages', 'insert', 'sexe', 1, '2020-05-27 15:04:43', '2020-05-27 15:04:43', 0, 1, 1),
(23, 'Ajout d\'un nouveau genre : Femme dans les paramétrages', 'insert', 'sexe', 1, '2020-05-27 15:04:43', '2020-05-27 15:04:43', 0, 1, 2),
(24, 'Ajout d\'un nouveau type d\'operation de vehicule : master dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:44', '2020-05-27 15:04:44', 0, 1, 1),
(25, 'Ajout d\'un nouveau type d\'operation de vehicule : production dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:44', '2020-05-27 15:04:44', 0, 1, 2),
(26, 'Ajout d\'un nouveau type d\'operation de vehicule : caisse dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 0, 1, 3),
(27, 'Ajout d\'un nouveau type d\'operation de vehicule : parametres dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 0, 1, 4),
(28, 'Ajout d\'un nouveau type d\'operation de vehicule : paye des manoeuvre dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 0, 1, 5),
(29, 'Ajout d\'un nouveau type d\'operation de vehicule : modifier-supprimer dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 0, 1, 6),
(30, 'Ajout d\'un nouveau type d\'operation de vehicule : archives dans les paramétrages', 'insert', 'role', 1, '2020-05-27 15:04:46', '2020-05-27 15:04:46', 0, 1, 7),
(31, 'Nouvelle Installation, premier démarrage', 'insert', 'mycompte', 1, '2020-05-27 15:04:46', '2020-05-27 15:04:46', 0, 1, 1),
(32, 'Ajout d\'un nouveau prestataire : Devaris PRESTATAIRE', 'insert', 'prestataire', 1, '2020-05-27 15:04:47', '2020-05-27 15:04:47', 0, 1, 1),
(33, 'Ajout d\'un nouveau prestataire : Devaris FOURNISSEUR', 'insert', 'fournisseur', 1, '2020-05-27 15:04:47', '2020-05-27 15:04:47', 0, 1, 1),
(34, 'Ajout d\'un nouvel employé dans votre gestion :Monsieur Tout le Monde', 'insert', 'client', 1, '2020-05-27 15:04:47', '2020-05-27 15:04:47', 0, 1, 1),
(35, 'Ajout d\'un nouveau chauffeur dans votre gestion : La boutique ', 'insert', 'commercial', 1, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 0, 1, 1),
(36, 'Ajout d\'un nouveau employe dans le parc auto : Super Administrateur', 'insert', 'employe', 1, '2020-05-27 15:04:52', '2020-05-27 15:04:52', 0, 1, 1),
(37, 'Ajout d\'une nouvelle zone de livraison : 200 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:54', '2020-05-27 15:04:54', 0, 1, 1),
(38, 'Ajout d\'une nouvelle zone de livraison : 250 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:54', '2020-05-27 15:04:54', 0, 1, 2),
(39, 'Ajout d\'une nouvelle zone de livraison : 300 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:54', '2020-05-27 15:04:54', 0, 1, 3),
(40, 'Ajout d\'une nouvelle zone de livraison : 500 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:55', '2020-05-27 15:04:55', 0, 1, 4),
(41, 'Ajout d\'une nouvelle zone de livraison : 1000 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:55', '2020-05-27 15:04:55', 0, 1, 5),
(42, 'Ajout d\'une nouvelle zone de livraison : 1500 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:56', '2020-05-27 15:04:56', 0, 1, 6),
(43, 'Ajout d\'une nouvelle zone de livraison : 2000 dans les paramétrages', 'insert', 'prix', 1, '2020-05-27 15:04:56', '2020-05-27 15:04:56', 0, 1, 7),
(44, 'Ajout d\'un nouveau produit : Jus de passion dans les paramétrages', 'insert', 'produit', 1, '2020-05-27 15:04:57', '2020-05-27 15:04:57', 0, 1, 1),
(45, 'Ajout d\'un nouveau produit : Jus d\'orange dans les paramétrages', 'insert', 'produit', 1, '2020-05-27 15:05:00', '2020-05-27 15:05:00', 0, 1, 2),
(46, 'Ajout d\'un nouveau produit : Jus de bissap dans les paramétrages', 'insert', 'produit', 1, '2020-05-27 15:05:03', '2020-05-27 15:05:03', 0, 1, 3),
(47, 'Ajout d\'une nouvelle ressource : EAU dans les paramétrages', 'insert', 'ressource', 1, '2020-05-27 15:05:08', '2020-05-27 15:05:08', 0, 1, 1),
(48, 'Ajout d\'une nouvelle ressource : Orange dans les paramétrages', 'insert', 'ressource', 1, '2020-05-27 15:05:10', '2020-05-27 15:05:10', 0, 1, 2),
(49, 'Ajout d\'une nouvelle ressource : Sucre dans les paramétrages', 'insert', 'ressource', 1, '2020-05-27 15:05:12', '2020-05-27 15:05:12', 0, 1, 3),
(50, 'Ajout d\'une nouvelle ressource : Bidons dans les paramétrages', 'insert', 'ressource', 1, '2020-05-27 15:05:13', '2020-05-27 15:05:13', 0, 1, 4),
(51, 'Ajout d\'un nouveau type de sinistre : standart dans les paramétrages', 'insert', 'typevehicule', 1, '2020-05-27 15:05:15', '2020-05-27 15:05:15', 0, 1, 5),
(52, 'Ajout d\'un nouveau type de transmission de vehicule : standart dans les paramétrages', 'insert', 'typetransmission', 1, '2020-05-27 15:05:17', '2020-05-27 15:05:17', 0, 1, 1),
(53, 'Ajout d\'un nouveau type de prestataire : standart dans les paramétrages', 'insert', 'typeprestataire', 1, '2020-05-27 15:05:17', '2020-05-27 15:05:17', 0, 1, 1),
(54, 'Ajout d\'un nouveau type de demande de vehicule : standart dans les paramétrages', 'insert', 'groupemanoeuvre', 1, '2020-05-27 15:05:18', '2020-05-27 15:05:18', 0, 1, 1),
(55, 'Ajout d\'un nouveau type de vehicule : standart dans les paramétrages', 'insert', 'typesuggestion', 1, '2020-05-27 15:05:18', '2020-05-27 15:05:18', 0, 1, 1),
(56, 'Modification des informations du employe 1 Super Administrateur', 'update', 'employe', NULL, '2020-05-27 15:07:53', '2020-05-27 15:07:53', 0, 1, 1),
(57, 'Nouvelle connexion', 'insert', 'connexion', 1, '2020-05-27 15:07:53', '2020-05-27 15:07:53', 0, 1, 1),
(58, 'Ajout d\'un nouvel employé dans votre gestion :client A', 'insert', 'client', 1, '2020-05-27 15:18:11', '2020-05-27 15:18:11', 0, 1, 2),
(59, 'Modification des informations de l\'employé client A', 'update', 'client', 1, '2020-05-27 15:26:37', '2020-05-27 15:26:37', 0, 1, 2),
(60, 'Modification des informations du chauffeur N°1 : La boutique .', 'update', 'commercial', 1, '2020-05-27 15:39:25', '2020-05-27 15:39:25', 0, 1, 1),
(61, 'Ajout d\'un nouveau chauffeur dans votre gestion : Revision du moteur ', 'insert', 'commercial', 1, '2020-05-27 16:21:02', '2020-05-27 16:21:02', 0, 1, 2),
(62, 'Modification des informations du chauffeur N°2 : Amadou Charles .', 'update', 'commercial', 1, '2020-05-27 17:17:00', '2020-05-27 17:17:00', 0, 1, 2),
(63, 'Modification des informations du chauffeur N°2 : Amadou Charles .', 'update', 'commercial', 1, '2020-05-27 17:18:57', '2020-05-27 17:18:57', 0, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ligneapprovisionnement`
--

CREATE TABLE `ligneapprovisionnement` (
  `id` int(11) NOT NULL,
  `approvisionnement_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `quantite_recu` float NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneapprovisionnement`
--

INSERT INTO `ligneapprovisionnement` (`id`, `approvisionnement_id`, `ressource_id`, `quantite`, `quantite_recu`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 100, 100, 0, '2020-05-27 15:05:09', '2020-05-27 15:05:09', 0, 1),
(2, 1, 2, 100, 100, 0, '2020-05-27 15:05:11', '2020-05-27 15:05:11', 0, 1),
(3, 1, 3, 100, 100, 0, '2020-05-27 15:05:13', '2020-05-27 15:05:13', 0, 1),
(4, 1, 4, 100, 100, 0, '2020-05-27 15:05:14', '2020-05-27 15:05:14', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `prixdevente_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignecommande`
--

INSERT INTO `lignecommande` (`id`, `commande_id`, `prixdevente_id`, `quantite`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 3, 10, '2020-05-27 15:26:36', '2020-05-27 15:26:36', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligneconsommationjour`
--

CREATE TABLE `ligneconsommationjour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `consommation` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneconsommationjour`
--

INSERT INTO `ligneconsommationjour` (`id`, `productionjour_id`, `ressource_id`, `consommation`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 0, '2020-05-27 15:05:09', '2020-05-27 15:05:09', 0, 1),
(2, 1, 2, 0, '2020-05-27 15:05:12', '2020-05-27 15:05:12', 0, 1),
(3, 1, 3, 0, '2020-05-27 15:05:13', '2020-05-27 15:05:13', 0, 1),
(4, 1, 4, 0, '2020-05-27 15:05:14', '2020-05-27 15:05:14', 0, 1),
(5, 2, 1, 0, '2020-05-27 15:07:54', '2020-05-27 15:07:54', 0, 1),
(6, 2, 2, 0, '2020-05-27 15:07:54', '2020-05-27 15:07:54', 0, 1),
(7, 2, 3, 0, '2020-05-27 15:07:54', '2020-05-27 15:07:54', 0, 1),
(8, 2, 4, 0, '2020-05-27 15:07:54', '2020-05-27 15:07:54', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignedevente`
--

CREATE TABLE `lignedevente` (
  `id` int(11) NOT NULL,
  `vente_id` int(11) NOT NULL,
  `prixdevente_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ligneproductionjour`
--

CREATE TABLE `ligneproductionjour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `prixdevente_id` int(11) NOT NULL,
  `production` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligneproductionjour`
--

INSERT INTO `ligneproductionjour` (`id`, `productionjour_id`, `prixdevente_id`, `production`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 0, '2020-04-25 00:00:00', '2020-05-27 15:04:57', 0, 1),
(2, 1, 2, 0, '2020-04-25 00:00:00', '2020-05-27 15:04:58', 0, 1),
(3, 1, 3, 0, '2020-04-25 00:00:00', '2020-05-27 15:04:58', 0, 1),
(4, 1, 4, 0, '2020-04-25 00:00:00', '2020-05-27 15:04:59', 0, 1),
(5, 1, 5, 0, '2020-04-25 00:00:00', '2020-05-27 15:04:59', 0, 1),
(6, 1, 6, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:00', 0, 1),
(7, 1, 7, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:00', 0, 1),
(8, 1, 8, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:01', 0, 1),
(9, 1, 9, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:01', 0, 1),
(10, 1, 10, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:02', 0, 1),
(11, 1, 11, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:02', 0, 1),
(12, 1, 12, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:02', 0, 1),
(13, 1, 13, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:03', 0, 1),
(14, 1, 14, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:03', 0, 1),
(15, 1, 15, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:04', 0, 1),
(16, 1, 16, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:04', 0, 1),
(17, 1, 17, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:05', 0, 1),
(18, 1, 18, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:05', 0, 1),
(19, 1, 19, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:06', 0, 1),
(20, 1, 20, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:06', 0, 1),
(21, 1, 21, 0, '2020-04-25 00:00:00', '2020-05-27 15:05:07', 0, 1),
(22, 2, 1, 0, '2020-05-27 15:16:47', '2020-05-27 15:16:47', 0, 1),
(23, 2, 2, 10, '2020-05-27 15:16:47', '2020-05-27 15:16:47', 0, 1),
(24, 2, 3, 10, '2020-05-27 15:16:47', '2020-05-27 15:16:47', 0, 1),
(25, 2, 4, 0, '2020-05-27 15:16:48', '2020-05-27 15:16:48', 0, 1),
(26, 2, 5, 0, '2020-05-27 15:16:48', '2020-05-27 15:16:48', 0, 1),
(27, 2, 6, 0, '2020-05-27 15:16:48', '2020-05-27 15:16:48', 0, 1),
(28, 2, 7, 0, '2020-05-27 15:16:48', '2020-05-27 15:16:48', 0, 1),
(29, 2, 8, 0, '2020-05-27 15:16:48', '2020-05-27 15:16:48', 0, 1),
(30, 2, 9, 0, '2020-05-27 15:16:49', '2020-05-27 15:16:49', 0, 1),
(31, 2, 10, 0, '2020-05-27 15:16:49', '2020-05-27 15:16:49', 0, 1),
(32, 2, 11, 10, '2020-05-27 15:16:49', '2020-05-27 15:16:49', 0, 1),
(33, 2, 12, 0, '2020-05-27 15:16:49', '2020-05-27 15:16:49', 0, 1),
(34, 2, 13, 0, '2020-05-27 15:16:49', '2020-05-27 15:16:49', 0, 1),
(35, 2, 14, 0, '2020-05-27 15:16:49', '2020-05-27 15:16:49', 0, 1),
(36, 2, 15, 10, '2020-05-27 15:16:50', '2020-05-27 15:16:50', 0, 1),
(37, 2, 16, 0, '2020-05-27 15:16:50', '2020-05-27 15:16:50', 0, 1),
(38, 2, 17, 0, '2020-05-27 15:16:50', '2020-05-27 15:16:50', 0, 1),
(39, 2, 18, 10, '2020-05-27 15:16:50', '2020-05-27 15:16:50', 0, 1),
(40, 2, 19, 0, '2020-05-27 15:16:50', '2020-05-27 15:16:50', 0, 1),
(41, 2, 20, 0, '2020-05-27 15:16:51', '2020-05-27 15:16:51', 0, 1),
(42, 2, 21, 0, '2020-05-27 15:16:51', '2020-05-27 15:16:51', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligneprospection`
--

CREATE TABLE `ligneprospection` (
  `id` int(11) NOT NULL,
  `prospection_id` int(11) NOT NULL,
  `prixdevente_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `quantite_vendu` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `perte` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `ligneprospection`
--

INSERT INTO `ligneprospection` (`id`, `prospection_id`, `prixdevente_id`, `quantite`, `quantite_vendu`, `reste`, `perte`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 3, 5, 3, 1, 1, '2020-05-27 15:29:06', '2020-05-27 15:29:06', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `marque` varchar(50) COLLATE utf8_bin NOT NULL,
  `modele` varchar(200) COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin DEFAULT NULL,
  `etatvehicule_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvre`
--

CREATE TABLE `manoeuvre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `groupemanoeuvre_id` int(2) NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvredujour`
--

CREATE TABLE `manoeuvredujour` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `manoeuvredurangement`
--

CREATE TABLE `manoeuvredurangement` (
  `id` int(11) NOT NULL,
  `productionjour_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `logo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `miseenboutique`
--

CREATE TABLE `miseenboutique` (
  `id` int(11) NOT NULL,
  `prixdevente_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `restant` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `miseenboutique`
--

INSERT INTO `miseenboutique` (`id`, `prixdevente_id`, `quantite`, `restant`, `employe_id`, `etat_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 3, 10, 0, 1, 4, '2020-05-27 15:28:29', '2020-05-27 15:28:29', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `modepayement`
--

CREATE TABLE `modepayement` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `initial` varchar(3) COLLATE utf8_bin NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `modepayement`
--

INSERT INTO `modepayement` (`id`, `name`, `initial`, `etat_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Espèces', 'ES', 4, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 1, 1),
(2, 'Prelevement sur acompte', 'PA', 4, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 1, 1),
(3, 'Chèque', 'CH', 2, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 1, 1),
(4, 'Virement banquaire', 'VB', 2, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 1, 1),
(5, 'Mobile money', 'MM', 2, '2020-05-27 15:04:48', '2020-05-27 15:04:48', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mycompte`
--

CREATE TABLE `mycompte` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(9) COLLATE utf8_bin NOT NULL,
  `tentative` int(11) NOT NULL,
  `expired` datetime NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `mycompte`
--

INSERT INTO `mycompte` (`id`, `identifiant`, `tentative`, `expired`, `protected`, `valide`) VALUES
(1, '18E7383', 0, '2020-06-03 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `categorieoperation_id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `montant` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `modepayement_id` int(11) NOT NULL,
  `structure` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `acompteClient` int(11) NOT NULL,
  `detteClient` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `isModified` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `categorieoperation_id`, `reference`, `montant`, `client_id`, `commercial_id`, `fournisseur_id`, `modepayement_id`, `structure`, `numero`, `comment`, `acompteClient`, `detteClient`, `etat_id`, `employe_id`, `date_approbation`, `isModified`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 'BCA/27052020-6AD60E', 2000, 2, NULL, NULL, 1, '', '', 'Réglement de la facture pour la commande N°BCO/27052020-6AC948', 0, 1000, 4, 1, NULL, 0, '2020-05-27 15:26:37', '2020-05-27 15:26:37', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panne`
--

CREATE TABLE `panne` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `reference` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `machine_id` int(11) NOT NULL,
  `manoeuvre_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `image` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `societe` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `contact` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `devise` varchar(50) COLLATE utf8_bin NOT NULL,
  `tva` int(11) NOT NULL,
  `seuilCredit` int(11) NOT NULL,
  `ruptureStock` int(11) NOT NULL,
  `adresse` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `postale` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `autoriserVersementAttente` varchar(11) COLLATE utf8_bin NOT NULL,
  `bloquerOrfonds` varchar(11) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `params`
--

INSERT INTO `params` (`id`, `societe`, `email`, `contact`, `fax`, `devise`, `tva`, `seuilCredit`, `ruptureStock`, `adresse`, `postale`, `image`, `autoriserVersementAttente`, `bloquerOrfonds`, `protected`, `valide`) VALUES
(1, 'Devaris 21', 'info@devaris21.com', NULL, NULL, 'Fcfa', 0, 10000, 10, NULL, NULL, NULL, 'on', 'off', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `payeferie_produit`
--

CREATE TABLE `payeferie_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_rangement` int(11) NOT NULL,
  `price_livraison` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `paye_chauffeur`
--

CREATE TABLE `paye_chauffeur` (
  `id` int(11) NOT NULL,
  `chauffeur_id` int(11) NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `paye_produit`
--

CREATE TABLE `paye_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_rangement` int(11) NOT NULL,
  `price_livraison` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `prestataire`
--

CREATE TABLE `prestataire` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `typeprestataire_id` int(11) NOT NULL,
  `contact` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `email` text COLLATE utf8_bin DEFAULT NULL,
  `adresse` text COLLATE utf8_bin DEFAULT NULL,
  `registre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `login` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `is_new` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `is_allowed` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prestataire`
--

INSERT INTO `prestataire` (`id`, `name`, `typeprestataire_id`, `contact`, `fax`, `email`, `adresse`, `registre`, `login`, `password`, `is_new`, `image`, `is_allowed`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Devaris PRESTATAIRE', 1, '...', NULL, 'info@devaris21.com', '...', NULL, '...', '...', 1, 'default.png', 1, '2020-05-27 15:04:47', '2020-05-27 15:04:47', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `price` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `price`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '200', '2020-05-27 15:04:54', '2020-05-27 15:04:54', 1, 1),
(2, '250', '2020-05-27 15:04:54', '2020-05-27 15:04:54', 1, 1),
(3, '300', '2020-05-27 15:04:54', '2020-05-27 15:04:54', 1, 1),
(4, '500', '2020-05-27 15:04:55', '2020-05-27 15:04:55', 1, 1),
(5, '1000', '2020-05-27 15:04:55', '2020-05-27 15:04:55', 1, 1),
(6, '1500', '2020-05-27 15:04:55', '2020-05-27 15:04:55', 1, 1),
(7, '2000', '2020-05-27 15:04:56', '2020-05-27 15:04:56', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prixdevente`
--

CREATE TABLE `prixdevente` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `prix_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prixdevente`
--

INSERT INTO `prixdevente` (`id`, `produit_id`, `prix_id`, `isActive`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, 1, '2020-05-27 15:04:57', '2020-05-27 15:04:57', 0, 1),
(2, 1, 2, 1, '2020-05-27 15:04:57', '2020-05-27 15:04:57', 0, 1),
(3, 1, 3, 1, '2020-05-27 15:04:58', '2020-05-27 15:04:58', 0, 1),
(4, 1, 4, 1, '2020-05-27 15:04:58', '2020-05-27 15:04:58', 0, 1),
(5, 1, 5, 1, '2020-05-27 15:04:59', '2020-05-27 15:04:59', 0, 1),
(6, 1, 6, 1, '2020-05-27 15:05:00', '2020-05-27 15:05:00', 0, 1),
(7, 1, 7, 1, '2020-05-27 15:05:00', '2020-05-27 15:05:00', 0, 1),
(8, 2, 1, 1, '2020-05-27 15:05:01', '2020-05-27 15:05:01', 0, 1),
(9, 2, 2, 1, '2020-05-27 15:05:01', '2020-05-27 15:05:01', 0, 1),
(10, 2, 3, 1, '2020-05-27 15:05:01', '2020-05-27 15:05:01', 0, 1),
(11, 2, 4, 1, '2020-05-27 15:05:02', '2020-05-27 15:05:02', 0, 1),
(12, 2, 5, 1, '2020-05-27 15:05:02', '2020-05-27 15:05:02', 0, 1),
(13, 2, 6, 1, '2020-05-27 15:05:03', '2020-05-27 15:05:03', 0, 1),
(14, 2, 7, 1, '2020-05-27 15:05:03', '2020-05-27 15:05:03', 0, 1),
(15, 3, 1, 1, '2020-05-27 15:05:04', '2020-05-27 15:05:04', 0, 1),
(16, 3, 2, 1, '2020-05-27 15:05:04', '2020-05-27 15:05:04', 0, 1),
(17, 3, 3, 1, '2020-05-27 15:05:04', '2020-05-27 15:05:04', 0, 1),
(18, 3, 4, 1, '2020-05-27 15:05:05', '2020-05-27 15:05:05', 0, 1),
(19, 3, 5, 1, '2020-05-27 15:05:06', '2020-05-27 15:05:06', 0, 1),
(20, 3, 6, 1, '2020-05-27 15:05:06', '2020-05-27 15:05:06', 0, 1),
(21, 3, 7, 1, '2020-05-27 15:05:07', '2020-05-27 15:05:07', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `productionjour`
--

CREATE TABLE `productionjour` (
  `id` int(11) NOT NULL,
  `ladate` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `groupemanoeuvre_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `groupemanoeuvre_id_rangement` int(11) NOT NULL,
  `dateRangement` date DEFAULT NULL,
  `total_production` int(11) NOT NULL,
  `total_rangement` int(11) NOT NULL,
  `total_livraison` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `productionjour`
--

INSERT INTO `productionjour` (`id`, `ladate`, `comment`, `groupemanoeuvre_id`, `employe_id`, `etat_id`, `groupemanoeuvre_id_rangement`, `dateRangement`, `total_production`, `total_rangement`, `total_livraison`, `created`, `modified`, `protected`, `valide`) VALUES
(1, '2020-04-25', 'production initial, système !', 0, 0, 4, 0, NULL, 0, 0, 0, '2020-05-27 15:04:53', '2020-05-27 15:04:53', 1, 1),
(2, '2020-05-27', '', 0, 1, 3, 0, NULL, 0, 0, 0, '2020-05-27 15:07:53', '2020-05-27 15:07:53', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `name`, `description`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Jus de passion', 'Hourdis', 'default.png', '2020-05-27 15:04:56', '2020-05-27 15:04:56', 0, 1),
(2, 'Jus d\'orange', 'AC 15', 'default.png', '2020-05-27 15:05:00', '2020-05-27 15:05:00', 0, 1),
(3, 'Jus de bissap', 'AP 15', 'default.png', '2020-05-27 15:05:03', '2020-05-27 15:05:03', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prospection`
--

CREATE TABLE `prospection` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `typeprospection_id` int(11) DEFAULT NULL,
  `groupecommande_id` int(11) DEFAULT NULL,
  `zonedevente_id` int(11) DEFAULT NULL,
  `lieu` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `vendu` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `commercial_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `dateretour` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `nom_receptionniste` text COLLATE utf8_bin DEFAULT NULL,
  `contact_receptionniste` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `prospection`
--

INSERT INTO `prospection` (`id`, `reference`, `typeprospection_id`, `groupecommande_id`, `zonedevente_id`, `lieu`, `montant`, `vendu`, `etat_id`, `commercial_id`, `employe_id`, `dateretour`, `comment`, `nom_receptionniste`, `contact_receptionniste`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'BSO/27052020-7418D4', 2, 1, 1, 'Cocody Angré extension', 0, 0, 2, 2, 1, '2020-05-27', '', 'Koffi', '01 020 362', '2020-05-27 15:29:05', '2020-05-27 15:29:05', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `unite` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `abbr` varchar(20) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`id`, `name`, `unite`, `abbr`, `image`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'EAU', NULL, 'Sacs', 'default.png', '2020-05-27 15:05:07', '2020-05-27 15:05:07', 0, 1),
(2, 'Orange', NULL, 'Chgs', 'default.png', '2020-05-27 15:05:10', '2020-05-27 15:05:10', 0, 1),
(3, 'Sucre', NULL, 'T', 'default.png', '2020-05-27 15:05:12', '2020-05-27 15:05:12', 0, 1),
(4, 'Bidons', NULL, 'T', 'default.png', '2020-05-27 15:05:13', '2020-05-27 15:05:13', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'master', NULL, '2020-05-27 15:04:44', '2020-05-27 15:04:44', 1, 1),
(2, 'production', NULL, '2020-05-27 15:04:44', '2020-05-27 15:04:44', 1, 1),
(3, 'caisse', NULL, '2020-05-27 15:04:44', '2020-05-27 15:04:44', 1, 1),
(4, 'parametres', NULL, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 1, 1),
(5, 'paye des manoeuvre', NULL, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 1, 1),
(6, 'modifier-supprimer', NULL, '2020-05-27 15:04:45', '2020-05-27 15:04:45', 1, 1),
(7, 'archives', NULL, '2020-05-27 15:04:46', '2020-05-27 15:04:46', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role_employe`
--

CREATE TABLE `role_employe` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role_employe`
--

INSERT INTO `role_employe` (`id`, `role_id`, `employe_id`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 1, 1, '2020-05-27 15:04:52', '2020-05-27 15:04:52', 1, 1),
(2, 2, 1, '2020-05-27 15:04:52', '2020-05-27 15:04:52', 1, 1),
(3, 3, 1, '2020-05-27 15:04:52', '2020-05-27 15:04:52', 1, 1),
(4, 4, 1, '2020-05-27 15:04:52', '2020-05-27 15:04:52', 1, 1),
(5, 5, 1, '2020-05-27 15:04:53', '2020-05-27 15:04:53', 1, 1),
(6, 6, 1, '2020-05-27 15:04:53', '2020-05-27 15:04:53', 1, 1),
(7, 7, 1, '2020-05-27 15:04:53', '2020-05-27 15:04:53', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

CREATE TABLE `sexe` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_bin NOT NULL,
  `abreviation` varchar(11) COLLATE utf8_bin NOT NULL,
  `icon` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT 1,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id`, `name`, `abreviation`, `icon`, `protected`, `valide`) VALUES
(1, 'Homme', 'H', 'fa fa-venus-mars', 1, 1),
(2, 'Femme', 'F', 'fa fa-venus-mars', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `ticket` varchar(10) COLLATE utf8_bin NOT NULL,
  `typesuggestion_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approuve` datetime DEFAULT NULL,
  `gestionnaire_id` int(11) DEFAULT NULL,
  `carplan_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `typeclient`
--

CREATE TABLE `typeclient` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeclient`
--

INSERT INTO `typeclient` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Entreprise', '2020-05-27 15:04:42', '2020-05-27 15:04:42', 1, 1),
(2, 'Particulier', '2020-05-27 15:04:42', '2020-05-27 15:04:42', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeentretienvehicule`
--

CREATE TABLE `typeentretienvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeentretienvehicule`
--

INSERT INTO `typeentretienvehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Accrochage', '2020-05-27 15:04:40', '2020-05-27 15:04:40', 1, 1),
(2, 'Crevaison', '2020-05-27 15:04:40', '2020-05-27 15:04:40', 1, 1),
(3, 'Autre', '2020-05-27 15:04:40', '2020-05-27 15:04:40', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeoperationcaisse`
--

CREATE TABLE `typeoperationcaisse` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeoperationcaisse`
--

INSERT INTO `typeoperationcaisse` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Entrée de caisse', '2020-05-27 15:04:39', '2020-05-27 15:04:39', 1, 1),
(2, 'Sortie de caisse', '2020-05-27 15:04:39', '2020-05-27 15:04:39', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeprestataire`
--

CREATE TABLE `typeprestataire` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeprestataire`
--

INSERT INTO `typeprestataire` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-05-27 15:05:17', '2020-05-27 15:05:17', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeprospection`
--

CREATE TABLE `typeprospection` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typeprospection`
--

INSERT INTO `typeprospection` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Prospection par commercial', '2020-05-27 15:04:37', '2020-05-27 15:04:37', 1, 1),
(2, 'livraison de commande', '2020-05-27 15:04:37', '2020-05-27 15:04:37', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typesuggestion`
--

CREATE TABLE `typesuggestion` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typesuggestion`
--

INSERT INTO `typesuggestion` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-05-27 15:05:18', '2020-05-27 15:05:18', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typetransmission`
--

CREATE TABLE `typetransmission` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typetransmission`
--

INSERT INTO `typetransmission` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'standart', '2020-05-27 15:05:16', '2020-05-27 15:05:16', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typevehicule`
--

CREATE TABLE `typevehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `typevehicule`
--

INSERT INTO `typevehicule` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Voiture', '2020-05-27 15:04:38', '2020-05-27 15:04:38', 1, 1),
(2, 'Camion benne', '2020-05-27 15:04:38', '2020-05-27 15:04:38', 1, 1),
(3, 'Tricycle', '2020-05-27 15:04:38', '2020-05-27 15:04:38', 1, 1),
(4, 'Moto', '2020-05-27 15:04:39', '2020-05-27 15:04:39', 1, 1),
(5, 'standart', '2020-05-27 15:05:15', '2020-05-27 15:05:15', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typevente`
--

CREATE TABLE `typevente` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `typevente`
--

INSERT INTO `typevente` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Directe', '2020-05-27 15:04:37', '2020-05-27 15:04:37', 1, 1),
(2, 'Par Prospection/livraison', '2020-05-27 15:04:37', '2020-05-27 15:04:37', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `immatriculation` varchar(20) COLLATE utf8_bin NOT NULL,
  `typevehicule_id` int(11) NOT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `nb_place` int(11) DEFAULT NULL,
  `nb_porte` int(11) DEFAULT NULL,
  `marque_id` int(11) NOT NULL,
  `modele` varchar(200) COLLATE utf8_bin NOT NULL,
  `energie_id` int(11) DEFAULT NULL,
  `typetransmission_id` int(11) DEFAULT NULL,
  `affectation` int(11) DEFAULT NULL,
  `puissance` int(10) DEFAULT NULL,
  `date_mise_circulation` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `date_visitetechnique` date DEFAULT NULL,
  `date_assurance` date DEFAULT NULL,
  `date_vidange` datetime DEFAULT NULL,
  `image` text COLLATE utf8_bin DEFAULT NULL,
  `etiquette` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `visibility` int(11) NOT NULL,
  `groupevehicule_id` int(11) DEFAULT NULL,
  `chasis` text COLLATE utf8_bin DEFAULT NULL,
  `date_acquisition` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `etatvehicule_id` int(11) NOT NULL,
  `possession` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1,
  `kilometrage` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `immatriculation`, `typevehicule_id`, `prestataire_id`, `nb_place`, `nb_porte`, `marque_id`, `modele`, `energie_id`, `typetransmission_id`, `affectation`, `puissance`, `date_mise_circulation`, `date_sortie`, `date_visitetechnique`, `date_assurance`, `date_vidange`, `image`, `etiquette`, `visibility`, `groupevehicule_id`, `chasis`, `date_acquisition`, `price`, `etatvehicule_id`, `possession`, `created`, `modified`, `protected`, `valide`, `kilometrage`, `location`) VALUES
(1, '...', 1, 1, NULL, NULL, 0, 'PAR NOS COMMERCIAUX', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', NULL, 0, 1, NULL, NULL, 0, 1, 0, '2020-05-27 15:04:41', '2020-05-27 15:04:41', 1, 1, NULL, 0),
(2, '...', 1, 1, NULL, NULL, 0, 'LE VEHICULE DU CLIENT', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', NULL, 0, 1, NULL, NULL, 0, 1, 0, '2020-05-27 15:04:42', '2020-05-27 15:04:42', 1, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `typevente_id` int(11) DEFAULT NULL,
  `groupecommande_id` int(11) DEFAULT NULL,
  `zonedevente_id` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `vendu` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `commercial_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `dateretour` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `zonedevente`
--

CREATE TABLE `zonedevente` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT 0,
  `valide` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `zonedevente`
--

INSERT INTO `zonedevente` (`id`, `name`, `created`, `modified`, `protected`, `valide`) VALUES
(1, 'Au magasin', '2020-05-27 15:04:36', '2020-05-27 15:04:36', 1, 1),
(2, 'Dans tout Bassam', '2020-05-27 15:04:36', '2020-05-27 15:04:36', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carplan`
--
ALTER TABLE `carplan`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commercial`
--
ALTER TABLE `commercial`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandeentretien`
--
ALTER TABLE `demandeentretien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `energie`
--
ALTER TABLE `energie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entretienmachine`
--
ALTER TABLE `entretienmachine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entretienvehicule`
--
ALTER TABLE `entretienvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatmanoeuvre`
--
ALTER TABLE `etatmanoeuvre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupemanoeuvre`
--
ALTER TABLE `groupemanoeuvre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupevehicule`
--
ALTER TABLE `groupevehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneconsommationjour`
--
ALTER TABLE `ligneconsommationjour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignedevente`
--
ALTER TABLE `lignedevente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneproductionjour`
--
ALTER TABLE `ligneproductionjour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneprospection`
--
ALTER TABLE `ligneprospection`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manoeuvre`
--
ALTER TABLE `manoeuvre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manoeuvredujour`
--
ALTER TABLE `manoeuvredujour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manoeuvredurangement`
--
ALTER TABLE `manoeuvredurangement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `miseenboutique`
--
ALTER TABLE `miseenboutique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modepayement`
--
ALTER TABLE `modepayement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mycompte`
--
ALTER TABLE `mycompte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panne`
--
ALTER TABLE `panne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payeferie_produit`
--
ALTER TABLE `payeferie_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paye_chauffeur`
--
ALTER TABLE `paye_chauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prestataire`
--
ALTER TABLE `prestataire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prixdevente`
--
ALTER TABLE `prixdevente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productionjour`
--
ALTER TABLE `productionjour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prospection`
--
ALTER TABLE `prospection`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_employe`
--
ALTER TABLE `role_employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sexe`
--
ALTER TABLE `sexe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeclient`
--
ALTER TABLE `typeclient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeentretienvehicule`
--
ALTER TABLE `typeentretienvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeprestataire`
--
ALTER TABLE `typeprestataire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeprospection`
--
ALTER TABLE `typeprospection`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typesuggestion`
--
ALTER TABLE `typesuggestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typetransmission`
--
ALTER TABLE `typetransmission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typevehicule`
--
ALTER TABLE `typevehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typevente`
--
ALTER TABLE `typevente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zonedevente`
--
ALTER TABLE `zonedevente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `carplan`
--
ALTER TABLE `carplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commercial`
--
ALTER TABLE `commercial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `demandeentretien`
--
ALTER TABLE `demandeentretien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `energie`
--
ALTER TABLE `energie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `entretienmachine`
--
ALTER TABLE `entretienmachine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entretienvehicule`
--
ALTER TABLE `entretienvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etatmanoeuvre`
--
ALTER TABLE `etatmanoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupemanoeuvre`
--
ALTER TABLE `groupemanoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupevehicule`
--
ALTER TABLE `groupevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ligneconsommationjour`
--
ALTER TABLE `ligneconsommationjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `lignedevente`
--
ALTER TABLE `lignedevente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneproductionjour`
--
ALTER TABLE `ligneproductionjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `ligneprospection`
--
ALTER TABLE `ligneprospection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `manoeuvre`
--
ALTER TABLE `manoeuvre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `manoeuvredujour`
--
ALTER TABLE `manoeuvredujour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `manoeuvredurangement`
--
ALTER TABLE `manoeuvredurangement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `miseenboutique`
--
ALTER TABLE `miseenboutique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `modepayement`
--
ALTER TABLE `modepayement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mycompte`
--
ALTER TABLE `mycompte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `panne`
--
ALTER TABLE `panne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `payeferie_produit`
--
ALTER TABLE `payeferie_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paye_chauffeur`
--
ALTER TABLE `paye_chauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prestataire`
--
ALTER TABLE `prestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `prixdevente`
--
ALTER TABLE `prixdevente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `productionjour`
--
ALTER TABLE `productionjour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `prospection`
--
ALTER TABLE `prospection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `role_employe`
--
ALTER TABLE `role_employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `sexe`
--
ALTER TABLE `sexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeclient`
--
ALTER TABLE `typeclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeentretienvehicule`
--
ALTER TABLE `typeentretienvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeprestataire`
--
ALTER TABLE `typeprestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typeprospection`
--
ALTER TABLE `typeprospection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typesuggestion`
--
ALTER TABLE `typesuggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typetransmission`
--
ALTER TABLE `typetransmission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typevehicule`
--
ALTER TABLE `typevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `typevente`
--
ALTER TABLE `typevente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `zonedevente`
--
ALTER TABLE `zonedevente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
