-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 jan. 2023 à 15:39
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
-- Base de données : `bookmark_gestionnaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(600) NOT NULL,
  `creation_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks_categories`
--

CREATE TABLE `bookmarks_categories` (
  `id_categorie` int(11) NOT NULL,
  `id_bookmark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_user` int(11) NOT NULL,
  `id_bookmark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(400) NOT NULL,
  `avatar` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `second_name`, `first_name`, `email`, `password`, `avatar`) VALUES
(1, 'Quentin', 'DESTRADE', 'quentin.destrade@gmail.com', 'aloha', ''),
(2, 'Kevin', 'Molines', 'kevin.molines@gmail.com', 'ffee22', ''),
(3, 'Laeticia', 'CASTA', 'laeticiouille@gmail.com', 'bvderr', ''),
(4, 'Jonhatan', 'LACOSTE', 'jojolac@gmail.com', 'a114771d', ''),
(5, 'Thomas', 'VILLEGAS', 'thom@gmail.com', 'babahs', ''),
(6, 'Leandre', 'VEYRON', 'lveyron@gmail.com', 'cdgey', ''),
(7, 'Veronique', 'FLEIG', 'veroofleig@gmail.com', 'dhetyagzz', ''),
(8, 'Pierre-Bruno', 'VERNET', 'pb48@gmail.com', 'dneuejede1', ''),
(9, 'Tony', 'TRIEWVELLER', 'toto341@gmail.com', 'kejaui', ''),
(10, 'Jolene', 'Mikus', 'jojo.mik@gmail.com', 'ejhyyyyeh', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1` (`user_id`);

--
-- Index pour la table `bookmarks_categories`
--
ALTER TABLE `bookmarks_categories`
  ADD KEY `FK2` (`id_categorie`),
  ADD KEY `FK3` (`id_bookmark`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD KEY `FK4` (`id_user`),
  ADD KEY `FK5` (`id_bookmark`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `bookmarks_categories`
--
ALTER TABLE `bookmarks_categories`
  ADD CONSTRAINT `FK2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK3` FOREIGN KEY (`id_bookmark`) REFERENCES `bookmarks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK5` FOREIGN KEY (`id_bookmark`) REFERENCES `bookmarks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
