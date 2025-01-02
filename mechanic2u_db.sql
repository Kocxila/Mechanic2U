-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 31 mai 2023 à 16:54
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de données : `mechanic2u_db`
--

-- --------------------------------------------------------
--
-- Structure de la table `preinscription`
--

CREATE TABLE `preinscription` (
  `id_preinscription` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `sexe` varchar(5) NOT NULL,
  `ville` varchar(128) NOT NULL,
  `num_CNI` varchar(100) NOT NULL,
  `annee_diplome` varchar(4) NOT NULL,
  `etat` varchar(30) NOT NULL DEFAULT 'En Attente',
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- --------------------------------------------------------
--
-- Structure de la table `reparation_durgence`
--

CREATE TABLE `reparation_durgence` (
  `id_reparation` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `marque` varchar(30) NOT NULL,
  `annee_prod` varchar(4) DEFAULT NULL,
  `localisation` varchar(128) DEFAULT NULL,
  `service` varchar(128) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `date_reparation` datetime DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'En Attente'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- --------------------------------------------------------
--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(128) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `service` varchar(128) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `annee_prod` varchar(4) DEFAULT NULL,
  `date_reservation` varchar(10) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'En Attente'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- --------------------------------------------------------
--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nom_role` varchar(30) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_role`, `nom_role`)
VALUES (1, 'admin'),
  (2, 'mechanic'),
  (3, 'user');
-- --------------------------------------------------------
--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(30) NOT NULL,
  `prenom_utilisateur` varchar(30) NOT NULL,
  `email_utilisateur` varchar(128) NOT NULL,
  `tel_utilisateur` varchar(10) NOT NULL,
  `mdp_utilisateur` varchar(128) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `id_role` int(11) NOT NULL DEFAULT 3
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (
    `id_utilisateur`,
    `nom_utilisateur`,
    `prenom_utilisateur`,
    `email_utilisateur`,
    `tel_utilisateur`,
    `mdp_utilisateur`,
    `date_creation`,
    `id_role`
  )
VALUES (
    1,
    'Super',
    'Admin',
    'admin@mechanic2u.dz',
    '0523232323',
    '$2y$10$H1sVUp1NJFn9nHLKmGRdOu2VMUYom80mcJCmNfbTjzWRz8CDWyjgK',
    '2023-05-31 15:51:28',
    1
  ),
  (
    2,
    'Mechanic',
    'One',
    'mechanic1@mechanic2u.dz',
    '0523232323',
    '$2y$10$0ojtUI19wDz0VBDo.qtoAeUN8/mCm8f/TZMQUd.bU3vpHI2f7C4Oq',
    '2023-05-31 15:52:29',
    2
  ),
  (
    3,
    'User',
    'One',
    'user1@mechanic2u.dz',
    '0523232323',
    '$2y$10$4JU6C9nhNAaCB8Ggnd8aPONt8OpcSS9Kr/Qmw7pry9m2oOPkOHbR.',
    '2023-05-31 15:53:08',
    3
  );
--
-- Index pour les tables déchargées
--

--
-- Index pour la table `preinscription`
--
ALTER TABLE `preinscription`
ADD UNIQUE KEY `id_preinscription` (`id_preinscription`);
--
-- Index pour la table `reparation_durgence`
--
ALTER TABLE `reparation_durgence`
ADD UNIQUE KEY `id_reparation` (`id_reparation`);
--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
ADD UNIQUE KEY `id_reservation` (`id_reservation`);
--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
ADD UNIQUE KEY `id_role` (`id_role`);
--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
ADD UNIQUE KEY `id_utilisateur` (`id_utilisateur`);
--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `preinscription`
--
ALTER TABLE `preinscription`
MODIFY `id_preinscription` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reparation_durgence`
--
ALTER TABLE `reparation_durgence`
MODIFY `id_reparation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;