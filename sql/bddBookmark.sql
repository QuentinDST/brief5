-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 jan. 2023 à 19:01
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bookmark`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `création` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `URL`, `Title`, `Description`, `création`) VALUES
(1, 'https://www.youtube.com/', 'youtube', 'site de musique', '2023-01-11'),
(2, 'https://getbootstrap.com/', 'bootsrap', 'framework', '2023-01-11'),
(3, 'https://www.airbnb.fr/', 'airbnb', 'location de maison', '2023-01-11'),
(4, 'https://www.figma.com/', 'figma', 'creation de wireframe', '2023-01-11'),
(5, 'http://alore.com', 'alore', 'ddddddd', '2023-01-11'),
(6, 'http://ksole.com', 'ksol', 'deeeeeeeeee', '2023-01-11'),
(7, 'https://guizmo.com', 'guizmo', 'site sur guizmo', '2023-01-11'),
(8, 'https://guizmo.com', 'guizmo', 'site sur guizmo', '2023-01-11'),
(9, 'https://guizmo.com', 'guizmo', 'site sur guizmo', '2023-01-11'),
(10, 'https://guizmo.com', 'guizmo', 'site sur guizmo', '2023-01-11'),
(11, 'http://eeee.com', 'jdududu', 'dhhhhhhhhhh', '2023-01-12'),
(12, 'http://ksole.com', 'jjjuuu', 'gggggggggg', '2023-01-12');

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks_categories`
--

CREATE TABLE `bookmarks_categories` (
  `bookmark_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bookmarks_categories`
--

INSERT INTO `bookmarks_categories` (`bookmark_id`, `categorie_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'LOCATION'),
(4, 'MUSIQUE');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bookmarks_categories`
--
ALTER TABLE `bookmarks_categories`
  ADD PRIMARY KEY (`bookmark_id`,`categorie_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bookmarks_categories`
--
ALTER TABLE `bookmarks_categories`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2` FOREIGN KEY (`bookmark_id`) REFERENCES `bookmarks` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
