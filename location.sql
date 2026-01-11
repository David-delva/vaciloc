-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : dim. 11 jan. 2026 à 02:23
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
-- Base de données : `location`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom_utilisateur`, `mot_de_passe_hash`, `created_at`) VALUES
(3, 'azerty', '$2y$10$a5dvUkGk5RemGNdD9df6duNyMVOpyRvf1uQUYdY1bRiCJ4RGLL9H6', '2025-10-16 01:17:25');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `created_at`) VALUES
(1, 'Chaises', '2025-10-16 00:42:44'),
(2, 'Tables', '2025-10-16 00:42:44'),
(4, 'Vaisselle', '2025-10-16 00:42:44'),
(5, 'Matériel de cuisine', '2025-10-16 00:42:44'),
(6, 'Accessoires', '2025-10-16 00:42:44');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `telephone`, `created_at`) VALUES
(1, 'GOMA MBA', 'Delva david', 'admin@example.com', '+24166290052', '2025-10-16 02:11:12'),
(2, 'Ibrahim', 'Nanzi', 'Nanziibrahim@gmail.com', '074704022', '2025-10-16 12:36:31'),
(3, 'CElo', 'eddy', 'ovono@gmail.com', '062575825', '2025-10-16 16:15:05'),
(4, 'GOMA MBA', 'Delva David', 'delvadavidgomamba@client.local', '+24166290052', '2026-01-11 01:10:19');

-- --------------------------------------------------------

--
-- Structure de la table `details_reservation`
--

CREATE TABLE `details_reservation` (
  `id` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `details_reservation`
--

INSERT INTO `details_reservation` (`id`, `id_reservation`, `id_produit`, `quantite`, `prix_unitaire`) VALUES
(1, 1, 6, 5, 3.00),
(2, 2, 2, 5, 2.00),
(3, 2, 8, 5, 12.00),
(4, 3, 2, 100, 149.93),
(5, 4, 1, 1, 200.00);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `prix_location_jour` decimal(10,2) NOT NULL,
  `quantite_totale` int(11) NOT NULL DEFAULT 0,
  `id_categorie` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix_location_jour`, `quantite_totale`, `id_categorie`, `image_url`, `created_at`) VALUES
(1, 'Chaise avec accoudoirs', 'Chaise confortable avec accoudoirs pour événements', 200.00, 1000, 1, '1760579003_Chaise-plastique-blanc.jpg', '2025-10-16 00:42:44'),
(2, 'Chaise sans accoudoirs', 'Chaise simple et élégante', 149.93, 500, 1, '1760579116_chaise_sans_accoutoir.jpg', '2025-10-16 00:42:44'),
(3, 'Table ronde', 'Table ronde pour 8 personnes', 2500.00, 100, 2, '1760580313_Table ronde.jpg', '2025-10-16 00:42:44'),
(4, 'Table rectangulaire', 'Table rectangulaire pour 10 personnes', 1000.00, 100, 2, '1760580295_Table rectangulaire.jpg', '2025-10-16 00:42:44'),
(6, 'Assiettes (lot de 10)', 'Lot de 10 assiettes blanches', 2500.00, 1000, 4, '1760578654_assiettes.jpg', '2025-10-16 00:42:44'),
(7, 'Verres (lot de 10)', 'Lot de 10 verres transparents', 2000.00, 1000, 4, '1760580416_verres-sensation (1).jpg', '2025-10-16 00:42:44'),
(8, 'Marmite grande', 'Marmite de grande capacité', 1500.00, 10, 5, '1760580275_Marmite grande.jpg', '2025-10-16 00:42:44'),
(9, 'Chafing dish', 'Réchaud buffet professionnel', 1999.96, 100, 5, '1760578462_chafing_dish..jpg', '2025-10-16 00:42:44'),
(11, 'Verre à vin', 'verre à vin propre pour vos invités', 250.00, 1000, 4, '1763833448_Gemini_Generated_Image_77a0mo77a0mo77a0.png', '2025-11-22 17:44:08'),
(12, 'Chaises 2 places séparées', 'Deux chaises pour le mariage costumier très confortable avec accessoires de décoration ', 25000.00, 2, 1, '1763834960_90efeb794bc8047a6972de0290b7cd5c80cd0c0a.jpg', '2025-11-22 18:09:20'),
(13, 'Accessoires de tables  ', 'Une culière(grande et petite), un couteau de table, une fourchette ', 400.00, 1500, 4, '1763835403_images (1).jfif', '2025-11-22 18:16:43'),
(14, 'Tente ouvert', 'Tente ouvert, avec une très grande capacité. ', 10000.00, 10, 6, '1763835933_unnamed.jpg', '2025-11-22 18:25:33'),
(15, 'ustensiles de cuisine  ', 'Des ustensiles de cuisine pour vos préparations en cuisines bien entretenue, salubre mais surtout très propre ', 1000.00, 500, 5, '1763837525_WhatsApp Image 2025-11-22 à 19.47.30_fa80bdef.jpg', '2025-11-22 18:52:05');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` enum('En attente','Confirmée','Terminée','Annulée') DEFAULT 'En attente',
  `total` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_client`, `date_debut`, `date_fin`, `statut`, `total`, `created_at`) VALUES
(1, 1, '2025-10-17', '2025-10-18', 'En attente', 30.00, '2025-10-16 02:11:12'),
(2, 2, '2025-10-17', '2025-10-17', 'Confirmée', 70.00, '2025-10-16 12:36:31'),
(3, 3, '2025-10-17', '2025-10-17', 'Annulée', 14993.00, '2025-10-16 16:15:05'),
(4, 4, '2026-01-12', '2026-01-14', 'En attente', 600.00, '2026-01-11 01:10:19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `details_reservation`
--
ALTER TABLE `details_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `details_reservation`
--
ALTER TABLE `details_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `details_reservation`
--
ALTER TABLE `details_reservation`
  ADD CONSTRAINT `details_reservation_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_reservation_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
