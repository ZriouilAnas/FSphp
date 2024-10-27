-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 13 oct. 2024 à 19:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_labrest`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_produit`
--

CREATE TABLE `t_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `prix` varchar(50) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_produit`
--

INSERT INTO `t_produit` (`id`, `nom`, `description`, `prix`, `date_creation`) VALUES
(1, 'sd', 'ss', 'ss', '2024-10-08'),
(2, 'koko', 'kk', 'sdfsdf', '2024-10-08'),
(5, 'postupdateAPI', 'Add your HHHHname in the body', '10', '2024-10-13'),
(6, 'editedAPI', 'lorem ipsunnAPI', '33', '2024-10-13'),
(8, 'asaHHAHAHsa', 'Add your name in thHAHAHAHAHAHAHHAe body', '10', '2024-10-13'),
(9, 'acreaet', 'Add your name in thHAHAHAHAHAHAHHAe body in XDDDHAHAHALOL', '100', '2024-10-13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_produit`
--
ALTER TABLE `t_produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_produit`
--
ALTER TABLE `t_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
