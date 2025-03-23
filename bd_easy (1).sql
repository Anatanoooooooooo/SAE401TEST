-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 mars 2025 à 20:59
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
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `autoecole`
--

INSERT INTO `autoecole` (`id`, `id_personne`, `nom`, `adresse`) VALUES
(1, 4, 'ORNIKAR', 'RUE ORNIKAR');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `date_publication` date NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `adresse_rue` varchar(255) DEFAULT NULL,
  `adresse_cp` varchar(10) DEFAULT NULL,
  `adresse_ville` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `NEPH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id`, `id_personne`, `adresse_rue`, `adresse_cp`, `adresse_ville`, `date_naissance`, `NEPH`) VALUES
(1, 2, 'rue', '77', NULL, NULL, NULL);

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
(4, 'admin5', '$2y$10$A11XUsbr0tN8qaMZ6ca84uwsGxWZcOBWOXsd0EIhL6yrSPZBXi.4W', 'PC', 'CP');

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
  ADD KEY `id_eleve` (`id_eleve`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `candidat` (`id_personne`) ON DELETE CASCADE;

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
