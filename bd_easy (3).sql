-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 26 mars 2025 à 00:27
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_easy`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `id_personne`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `autoecole`
--

CREATE TABLE `autoecole` (
  `id` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `nom_ae` varchar(255) NOT NULL,
  `adresse_rue` varchar(255) NOT NULL,
  `adresse_cp` int(5) NOT NULL,
  `adresse_ville` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `autoecole`
--

INSERT INTO `autoecole` (`id`, `id_personne`, `nom_ae`, `adresse_rue`, `adresse_cp`, `adresse_ville`, `mail`, `telephone`) VALUES
(1, 4, 'ORNIKAR', 'RUE ORNIKAR', 0, '', '', 0),
(2, 18, 'CARAUTOO', 'rue du generale leclerc', 93180, 'VIlle', 'carauto@gmail.com', 168907462),
(3, 19, 'CARAUTOO', 'rue du generale leclerc', 93180, 'VIlle', 'carauto@gmail.com', 168907462),
(5, 34, 'TestAuto', 'TestAuto', 78900, 'TestAuto', 'testauto@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `date_publication` datetime NOT NULL,
  `id_candidat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `titre`, `texte`, `date_publication`, `id_candidat`) VALUES
(2, 'Test', 'Test', '0000-00-00 00:00:00', 0),
(7, 'TEST', 'TEST', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `adresse_rue` varchar(255) DEFAULT NULL,
  `adresse_cp` int(5) DEFAULT NULL,
  `adresse_ville` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `NEPH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id`, `id_personne`, `adresse_rue`, `adresse_cp`, `adresse_ville`, `mail`, `telephone`, `date_naissance`, `NEPH`) VALUES
(1, 2, 'rue', 77, NULL, '', 0, NULL, NULL),
(3, 11, 'rue courneveuille', 23, 'Perdus', 'luie@gmail.com', 606600606, '2024-03-23', 2147483647),
(10, 30, 'TestCandidat', 78900, 'TestCandidat', 'testcandidat@gmail.com', 2147483647, '2000-04-07', 2147483647),
(11, 31, 'TestCandidat', 78901, 'TestCandidat', 'testcandidat@gmail.com', 2147483647, '2000-04-07', 2147483647),
(16, 37, 'TestCandidat', 78900, 'TestCandidat', 'testcandidat@gmail.com', 2147483647, '2000-04-07', 2147483647),
(18, 39, 'salut', 78901, 'TestCandidat', 'testcandidat@gmail.com', 2147483647, '2025-03-14', 1234567898);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id` int(11) NOT NULL,
  `login` varchar(16) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `login`, `mdp`, `nom`, `prenom`) VALUES
(2, 'test', '$2y$10$Oi6wTZmTDIbnm77dUs21/OlCjFOXyTTpGDjfrwpOd5OnwiXBirf1u', 'TEST', 'TesT'),
(3, 'admin12', '$2y$10$K44veM/pkzaP6bdhNGzyFuomtUMgep0ekQJ4SGhl/FJrLx71cqgPK', 'TCT', 'CTC'),
(4, 'admin5', '$2y$10$A11XUsbr0tN8qaMZ6ca84uwsGxWZcOBWOXsd0EIhL6yrSPZBXi.4W', 'PC', 'CP'),
(11, 'ZGdez', '$2y$10$A9XM9ozAPY4E4R037wVMhOJAg1hwN6eiVquq2SAu8p9ZP/CkK9yyO', 'Zuiz', 'Gernandez'),
(18, 'carauto', '$2y$10$1RblH7aIC3kKOGsL9o2txu0rzYCkaeb8uFU5UCbw8Pu/LMvdwVzdq', 'alloo', 'allo'),
(19, 'carauto', '$2y$10$c2BlVWNrVOcHly5mfqslRebHYbkkKjBVtZB/wM9cqrQuvi4LSmOgy', 'alloo', 'allo'),
(30, 'testcandidat', '$2y$10$BP20YOx6KZotyzlQQhgq3.IBh/roiCjQM9eoI6hhY6VpMlybtQ2ue', 'TestCandidat', 'TestCandidat'),
(31, 'testcandidat', '$2y$10$7ff3luoI6/HJ7K/DmEa4a.NIFvkf0TXjFhIz6Dyw3x3e6n2GaJYOi', 'TestCandidat', 'TestCandidat'),
(34, 'testauto', '$2y$10$wGEOJ70a0pwRjIATqCRQOODBQb2S3WOsDYHCOEJDEuLRctplirRD6', 'TestAuto', 'TestAuto'),
(37, 'testcandidat', '$2y$10$OONllsHqTniMYStikNlQvuAtE.HNEEh0zuI6aKTuEhLNl9hc0kid6', 'TestCandidat', 'TestCandidat'),
(39, 'alice ', '$2y$10$ONf4Wp2QoDWOgRx2uc0x/.87OFswo6yVQobiGg6zCCYl2wMjKe2Qq', 'efs', 'sefse');

-- --------------------------------------------------------

--
-- Structure de la table `score_examen_code`
--

CREATE TABLE `score_examen_code` (
  `id_score_code` int(11) NOT NULL,
  `score_examen_theorique` int(11) NOT NULL,
  `date_examen` date NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `score_examen_simulation`
--

CREATE TABLE `score_examen_simulation` (
  `id_score_simu` int(11) NOT NULL,
  `score_examen_pratique` int(11) NOT NULL,
  `date_examen` date NOT NULL,
  `ETG` varchar(255) NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_ibfk_2` (`id_personne`);

--
-- Index pour la table `autoecole`
--
ALTER TABLE `autoecole`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autoecole_ibfk_2` (`id_personne`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_eleve` (`id_candidat`);

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidat_ibfk_2` (`id_personne`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `score_examen_code`
--
ALTER TABLE `score_examen_code`
  ADD PRIMARY KEY (`id_score_code`),
  ADD KEY `id_eleve` (`id_eleve`);

--
-- Index pour la table `score_examen_simulation`
--
ALTER TABLE `score_examen_simulation`
  ADD PRIMARY KEY (`id_score_simu`),
  ADD KEY `id_eleve` (`id_eleve`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `autoecole`
--
ALTER TABLE `autoecole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `score_examen_code`
--
ALTER TABLE `score_examen_code`
  MODIFY `id_score_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `score_examen_simulation`
--
ALTER TABLE `score_examen_simulation`
  MODIFY `id_score_simu` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `autoecole`
--
ALTER TABLE `autoecole`
  ADD CONSTRAINT `autoecole_ibfk_2` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_2` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `score_examen_code`
--
ALTER TABLE `score_examen_code`
  ADD CONSTRAINT `score_examen_code_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `candidat` (`id_personne`) ON DELETE CASCADE;

--
-- Contraintes pour la table `score_examen_simulation`
--
ALTER TABLE `score_examen_simulation`
  ADD CONSTRAINT `score_examen_simulation_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `candidat` (`id_personne`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
