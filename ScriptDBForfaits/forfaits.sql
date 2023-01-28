-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 28 jan. 2023 à 17:42
-- Version du serveur : 8.0.28
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forfaits`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `nom_client` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom_client` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse_client` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ville_client` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `code_postal_client` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `province_client` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `pays_client` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone_client` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `courriel_client` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom_client`, `prenom_client`, `adresse_client`, `ville_client`, `code_postal_client`, `province_client`, `pays_client`, `telephone_client`, `courriel_client`) VALUES
(2, 'Pierre', 'Katy', '2020 Blvd Saint Laurent', 'Montréal', 'H2N1K4', 'Québec', 'Canada', '438-2368749', 'kpierre@gmail.com'),
(3, 'Dupuis', 'Béatrice', '245 Rue Saint-Jacques', 'Montréal', 'H2Y3Y5', 'Québec', 'Canada', '514-8452624', 'bdupuis@gmail.com'),
(4, 'Charles', 'Scherline', '33 rue Aladin', 'Laval', 'H7K2R4', 'Québec', 'Canada', '438-2568784', 'scharles@gmail.com'),
(5, 'Jean', 'Brunette', '1800 Blvd Saint-Martin Ouest', 'Laval', 'H7S3G7', 'Québec', 'Canada', '438-4856245', 'bjean@gmail.com'),
(6, 'Braive', 'Alexandra', '3210 Rue Goyer', 'Montréal', 'H3S1K6', 'Québec', 'Canada', '514-7625846', 'abraive@gmail.com'),
(7, 'Justin', 'Nicole', '1212 rue Saint-Denis', 'Montréal', 'H2X3R3', 'Québec', 'Canada', '438-2567878', 'njustin@gmail.com'),
(8, 'Rivière', 'Carline', '2525 Bd de la Renaissance', 'Laval', 'H7L1F2', 'Québec', 'Canada', '514-7854235', 'criviere@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `forfaits`
--

CREATE TABLE `forfaits` (
  `id` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `nomEtablissement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adresseEtablissement` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `villeEtablissement` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telephoneEtablissement` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `courrielEtablissement` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `siteWebEtablissement` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `nouveauPrix` decimal(10,0) NOT NULL,
  `rabais` decimal(10,0) DEFAULT NULL,
  `premium` tinyint(1) NOT NULL,
  `imageUrl` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `forfaits`
--

INSERT INTO `forfaits` (`id`, `nom`, `description`, `code`, `nomEtablissement`, `adresseEtablissement`, `villeEtablissement`, `telephoneEtablissement`, `courrielEtablissement`, `siteWebEtablissement`, `dateDebut`, `dateFin`, `prix`, `nouveauPrix`, `rabais`, `premium`, `imageUrl`) VALUES
(1, 'Forfait Smart phone', 'Iphone 14 Pro', 'F0001', 'Communication plus', 'Carrefour laval', 'Laval', '514-730-8206', 'josaintus@gmail.com', 'www.josaintus.com', '2022-10-18', '2024-10-21', '960', '1060', '0', 0, ''),
(4, 'Forfait massage pour une personne', 'Massage pour une personne', 'F0004', 'JOSLS Massage', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-11-02', '2022-12-31', '200', '150', '50', 1, ''),
(5, 'Forfait massage pour Bébé', 'Massage pour Bébé', 'F0005', 'JOSLS Massage', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-11-02', '2022-12-31', '100', '70', '30', 1, ''),
(6, 'Forfait yoga en plein air', 'Yoga en plein air', 'F0006', 'JOSLS Yoga', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-12-25', '2023-01-31', '250', '200', '50', 1, ''),
(7, 'Forfait yoga pour une personne', 'Yoga pour une personne', 'F0007', 'JOSLS Yoga', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-12-25', '2023-01-31', '150', '120', '30', 1, ''),
(8, 'Forfait Yoga à la plage', 'Yoga à la plage', 'F0008', 'JOSLS Yoga', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-11-02', '2023-01-31', '190', '150', '40', 1, ''),
(9, 'Forfait Yoga', 'Yoga d\\\'équipe', 'F0009', 'JOSLS Yoga', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-11-19', '2023-01-31', '180', '120', '60', 0, ''),
(10, 'Forfait Yoga entre les amis', 'Yoga en groupe d\'amis', 'F0010', 'JOSLS Yoga', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-12-01', '2023-01-31', '300', '170', '130', 1, ''),
(11, 'Forfait Yoga chaud ', 'Yoga par couple', 'F0011', 'JOSLS Massage', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2023-01-22', '2023-02-22', '700', '500', '200', 1, ''),
(34, 'Forfait Yoga chaud en groupe ', 'Yoga en groupe', 'F0012', 'JOSLS Massage', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2023-01-22', '2023-03-22', '700', '600', '100', 1, ''),
(39, 'Forfait massage par couple ', 'Massage par couple', 'F0003', 'JOSLS Massage', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2022-11-02', '2022-12-31', '500', '400', '100', 1, ''),
(48, 'Forfait Yoga chaud en famille ', 'Yoga en famille', 'F0013', 'JOSLS Yoga', '33 rue Edith', 'Laval', '514-730-8282', 'josls@gmail.com', 'www.joslsinfo.com', '2023-01-22', '2023-04-22', '600', '500', '100', 1, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forfaits`
--
ALTER TABLE `forfaits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `forfaits`
--
ALTER TABLE `forfaits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
