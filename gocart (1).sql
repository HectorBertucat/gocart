-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 03 fév. 2023 à 08:08
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gocart`
--

-- --------------------------------------------------------

--
-- Structure de la table `association_item_basket`
--

CREATE TABLE `association_item_basket` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_basket` int(11) NOT NULL,
  `deposit_date` date NOT NULL,
  `withdraw_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `association_user_cart`
--

CREATE TABLE `association_user_cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `opening_date` date NOT NULL,
  `canceling_date` date NOT NULL,
  `closing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_last_user` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `lastuse_date` date NOT NULL,
  `activation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `id_last_user`, `number`, `state`, `lastuse_date`, `activation_date`) VALUES
(1, 2, 11, 0, '2023-02-03', '2023-02-01');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `id_item_type` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item_type`
--

INSERT INTO `item_type` (`id`, `name`) VALUES
(1, 'Fruits'),
(2, 'Légumes');

-- --------------------------------------------------------

--
-- Structure de la table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `support_request`
--

CREATE TABLE `support_request` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `id_assistant` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `support_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_user_type` int(11) NOT NULL,
  `card_number` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `forname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `id_user_type`, `card_number`, `name`, `forname`, `email`, `password`) VALUES
(1, 3, -1, 'Durousseau', 'Arnaud', 'durousseauarnaud@verci.fr', '$2y$10$W2sJVSmNASYoLZgux2Cwru8ZJWVfaqI953PsmboHJ5w1AzryyKL92'),
(2, 1, 1234567890, 'Bouclette', 'Dimitri', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Client'),
(2, 'Opérateur'),
(3, 'Administrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `association_item_basket`
--
ALTER TABLE `association_item_basket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `association_user_cart`
--
ALTER TABLE `association_user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `support_request`
--
ALTER TABLE `support_request`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `association_item_basket`
--
ALTER TABLE `association_item_basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `association_user_cart`
--
ALTER TABLE `association_user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `support_request`
--
ALTER TABLE `support_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
