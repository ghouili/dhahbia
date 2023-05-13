-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 07 mai 2023 à 15:24
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `userName`, `password`) VALUES
(1, 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `archive_imp`
--

CREATE TABLE `archive_imp` (
  `id_imp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `doc` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `auditoire`
--

CREATE TABLE `auditoire` (
  `id_audit` int(11) NOT NULL,
  `lib_audit` varchar(255) NOT NULL,
  `nb_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auditoire`
--

INSERT INTO `auditoire` (`id_audit`, `lib_audit`, `nb_etudiant`) VALUES
(1, '1 Gest 11', 0),
(2, '1 Gest 12', 0),
(3, '1 Gest 13', 0),
(4, '1 Gest 14', 0),
(5, '1 Gest 21', 0),
(6, '1 Gest 22', 0),
(7, '1 Gest 23', 0),
(8, '1 Gest 24', 0),
(9, '1 Gest 31', 0),
(10, '1 Gest 32', 0),
(11, '1 Gest 33', 0),
(12, '1 Gest 34', 0),
(13, '1 Gest 41', 0),
(14, '1 Gest 42', 0),
(15, '1 Gest 43', 0),
(16, '1 Gest 44', 0),
(17, '1 eco 11', 0),
(18, '1 eco 12', 0),
(19, '1 eco 13', 0),
(20, '1 eco 14', 0),
(21, '1 eco 21', 0),
(22, '1 eco 22', 0),
(23, '1 eco 23', 0),
(24, '1 eco 24', 0),
(25, '1 IAG 11', 0),
(26, '1 IAG 12', 0),
(27, '1 IAG 13', 0),
(28, '1 IAG 21', 0),
(29, '1 IAG 22', 0),
(30, '1 IAG 23', 0),
(31, '1 IAG 31', 0),
(32, '1 IAG 32', 0),
(33, '1 IAG 33', 0),
(34, '2 Gest 11', 0),
(35, '2 Gest 12', 0),
(36, '2 Gest 13', 0),
(37, '2 Gest 21', 0),
(38, '2 Gest 22', 0),
(39, '2 Gest 23', 0),
(40, '2 Cpta 11', 0),
(41, '2 Cpta 12', 0),
(42, '2 Cpta 13', 0),
(43, '2 Cpta 14', 0),
(44, '2 eco 11', 0),
(45, '2 eco 12', 0),
(46, '2 eco 13', 0),
(47, '2 eco 14', 0),
(48, '2 eco 15', 0),
(49, '2 IAG 11', 0),
(50, '2 IAG 12', 0),
(51, '2 IAG 13', 0),
(52, '2 IAG 14', 0),
(53, '2 IAG 21', 0),
(54, '2 IAG 22', 0),
(55, '2 IAG 23', 0),
(56, '2 IAG 24', 0),
(57, '2 BIS 11', 0),
(58, '2 BIS 12', 0),
(59, '2 BIS 13', 0),
(60, '2 EB 11', 0),
(61, '2 EB 11', 0),
(62, '2 EB 12', 0),
(63, '2 EB 13', 0),
(64, '3 Cpta 11', 0),
(65, '3 Cpta 12', 0),
(66, '3 Cpta 13', 0),
(67, '3 Fin 11', 0),
(68, '3 Mngt 11', 0),
(69, '3 Mkg 11', 0),
(70, '3 APE 11', 0),
(71, '3 CEFI 11', 0),
(72, '3 MFBA 11', 0),
(73, '3 Log Pro 11', 0),
(74, 'IF NV TD', 0),
(75, 'CE NV TD', 0),
(76, 'IDM NV TD', 0),
(77, 'ENTREP NV TD', 0),
(78, 'CCA NV TD', 0),
(79, 'FSDD TD', 0),
(80, 'ESS TD', 0),
(81, 'GDT TD', 0),
(82, 'F ASS NV TD', 0),
(83, 'APE NV TD ', 0),
(84, 'IDG NV TD', 0),
(85, 'MOD LOG TD', 0),
(86, 'DER TD 2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `username` varchar(255) NOT NULL,
  `password` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_users` int(11) NOT NULL,
  `specialite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

CREATE TABLE `enseigner` (
  `id_matiere` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `impression`
--

CREATE TABLE `impression` (
  `id_imp` int(11) NOT NULL,
  `ensignant` varchar(100) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `niveau` varchar(100) NOT NULL,
  `filiere` varchar(100) NOT NULL,
  `auditoire` varchar(100) NOT NULL,
  `nb_etudient` int(255) NOT NULL,
  `nb_page` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `type_imp` varchar(100) NOT NULL,
  `doc` varchar(100) NOT NULL,
  `totalPage` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `impression`
--

INSERT INTO `impression` (`id_imp`, `ensignant`, `matiere`, `niveau`, `filiere`, `auditoire`, `nb_etudient`, `nb_page`, `date`, `type_imp`, `doc`, `totalPage`) VALUES
(8, 'nihel', 'ms', '1', 'licence en gestion', 'ms', 25, 26, '2023-04-12 00:00:00', 'Recto-verso', './document/PFE-2022 (1).docx', 0),
(9, 'nihel', 'ms', '1', 'licence en Ã©conomie', 'mrs', 369, 369, '2023-04-12 00:00:00', 'Recto-verso', './document/PFE-2022 (1).docx', 0),
(10, 'nihel', 'miss', '2', 'MastÃ¨re de recherche', 'ms', 123, 12, '2023-04-07 00:00:00', 'Recto', './document/PFE-2022 (1).docx', 0),
(11, 'nihel', 'ms', '1', 'MastÃ¨re de recherche', 'miss', 56, 56, '2023-04-08 00:00:00', 'Recto', './document/Sujet-du-PFE-Eya-Bouguerra (2).docx', 0),
(12, 'nihel', 'ms', '2', 'MastÃ¨re de recherche', 'miss', 258, 258, '2023-05-03 00:00:00', 'Recto', './document/PFE-2022 (1).docx', 0),
(13, 'nihel', 'mrs', '1', 'MastÃ¨re de recherche', 'mrs', 123, 123, '2023-04-07 00:00:00', 'Recto-verso', './document/LE PFE.pptx', 0),
(14, 'Sayaridhahbia', 'title', '1', 'MastÃ¨re de recherche', 'ms', 25, 25, '2023-04-08 00:00:00', 'Recto', './document/LE PFE.pptx', 0),
(15, 'Sayaridhahbia', 'mr', '1', 'MastÃ¨re de recherche', 'mr', 69, 25, '2023-04-26 00:00:00', 'Recto', './document/chapitre1.rtf', 0),
(16, 'Sayaridhahbia', 'miss', '1', 'MastÃ¨re de recherche', 'mrs', 25, 25, '2023-04-13 00:00:00', 'Recto-verso', './document/chapitre 1.1.rtf', 0),
(17, 'Sayaridhahbia', 'ms', '2', 'MastÃ¨re de recherche', 'mr', 456, 25, '2023-04-13 00:00:00', 'Recto-verso', './document/chapitre 1.1.rtf', 0),
(18, 'Sayaridhahbia', 'mrs', '2', 'MastÃ¨re de recherche', '1', 235, 8, '2023-04-30 00:00:00', 'Recto', './document/chapitre 1.1.docx', 0),
(19, 'Sayaridhahbia', 'mrs', '2', 'MastÃ¨re de recherche', '1', 235, 8, '2023-04-30 00:00:00', 'Recto', './document/chapitre 1.1.docx', 0),
(20, 'Sayaridhahbia', 'mrs', '2', 'MastÃ¨re de recherche', '1', 235, 8, '2023-04-30 00:00:00', 'Recto', './document/chapitre 1.1.docx', 0),
(21, 'Sayaridhahbia', '1', '1', 'MastÃ¨re de recherche', '1', 0, 0, '2023-05-06 23:15:00', 'Recto', './document/', 0),
(22, 'Sayaridhahbia', '1', '1', 'MastÃ¨re de recherche', '1', 25, 36, '2023-05-28 12:24:00', 'Recto', './document/chapitre 1.1.docx', 0);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `type_mat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `matiere`, `type_mat`) VALUES
(1, 'loi', 'tp'),
(2, 'loi', 'td'),
(3, 'anglais', 'tp');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id_niveau` int(11) NOT NULL,
  `lib_niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `lib_niveau`) VALUES
(1, '1er cycle'),
(2, '2eme cycle');

-- --------------------------------------------------------

--
-- Structure de la table `type_imp`
--

CREATE TABLE `type_imp` (
  `lib_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_imp`
--

INSERT INTO `type_imp` (`lib_type`) VALUES
('Recto'),
('Recto-verso');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tele` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `tele`, `email`, `password`, `sex`, `matiere`, `created_at`) VALUES
(22, 'Sayaridhahbia', '28649911', 'sayaridahbia@gamil.com', '$2y$10$Te5OYVbjcPnRal5wTnA/JeIqazJ5ZWRMUFa/7KGhWa9e7ZR7sAkLm', '', '', '2023-04-06 00:35:55'),
(31, 'anisa', '25896314', 'anisa@gmail.com', '$2y$10$RIgGRp9QsblT1pOX.th43OIesuHfFGzu3Yx7FgxQZ1BaQ.CoiH7Q6', 'Femme', '2', '2023-05-05 22:01:42');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `archive_imp`
--
ALTER TABLE `archive_imp`
  ADD PRIMARY KEY (`id_imp`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD KEY `test` (`id_users`);

--
-- Index pour la table `impression`
--
ALTER TABLE `impression`
  ADD PRIMARY KEY (`id_imp`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `archive_imp`
--
ALTER TABLE `archive_imp`
  MODIFY `id_imp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `impression`
--
ALTER TABLE `impression`
  MODIFY `id_imp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `test` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
