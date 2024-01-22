-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 22 jan. 2024 à 16:49
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
-- Base de données : `favoris`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'E-learning'),
(2, 'HTML'),
(3, 'CSS'),
(4, 'Maquettage'),
(5, 'Site/blog'),
(6, 'E-projet'),
(7, 'Cheatsheet'),
(8, 'Bootstrap'),
(9, 'Support PDF'),
(10, 'Ressources / Aides'),
(11, 'Javascript'),
(12, 'WordPress'),
(13, 'Outil'),
(14, 'Video'),
(15, 'API');

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `id_domaine` int(11) NOT NULL,
  `nom_domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`id_domaine`, `nom_domaine`) VALUES
(1, 'Maquettage / Figma'),
(2, 'HTML-CSS'),
(3, 'Javascript'),
(4, 'WORDPRESS'),
(5, 'API'),
(6, 'BOOSTRAP');

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE `favori` (
  `id_favori` int(11) NOT NULL,
  `libelle` varchar(200) NOT NULL,
  `date_creation` date NOT NULL,
  `url` varchar(1000) NOT NULL,
  `id_dom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`id_favori`, `libelle`, `date_creation`, `url`, `id_dom`) VALUES
(1, 'OpenClassRoom Maquette figma', '2024-01-16', 'https://openclassrooms.com/fr/courses/8242681-integrez-une-maquette-figma-en-html-css', 1),
(2, 'MSDN Début', '2024-01-17', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/HTML_basics', 2),
(3, 'MSDN Première étape CSS', '2024-01-18', 'https://developer.mozilla.org/fr/docs/Learn/CSS/First_steps', 2),
(4, 'Introduction HTML eprojet', '2024-01-19', 'https://www.eprojet.fr/cours/html_css/01-html_css-introduction-html-css', 2),
(5, 'W3Shool intro', '2024-01-20', 'https://www.w3schools.com/html/html_intro.asp', 2),
(6, 'OpenClassRoom Créer son site WEB', '2024-01-21', 'https://openclassrooms.com/fr/courses/1603881-creez-votre-site-web-avec-html5-et-css3', 2),
(7, 'htmlcheatsheet HTML', '2024-01-22', 'https://htmlcheatsheet.com', 2),
(8, 'htmlcheatsheet CSS', '2024-01-23', 'https://htmlcheatsheet.com/css/', 2),
(9, 'Bootstrap introduction', '2024-01-24', 'https://getbootstrap.com/docs/5.3/getting-started/introduction/', 6),
(10, 'OpenClassRoom Bootstrap', '2024-01-25', 'https://openclassrooms.com/fr/courses/7542506-creez-des-sites-web-responsives-avec-bootstrap-5', 6),
(11, 'Bootstrap Cheatsheet', '2024-01-26', 'https://getbootstrap.com/docs/5.0/examples/cheatsheet/', 6),
(12, 'Support Javascript Initiation', '2024-01-27', 'https://drive.google.com/file/d/1zzIx9aD4pfkR1nn2UATRo8qRs6MZbxW4/view?usp=drive_link', 3),
(13, 'OpenClassRoom Javascript', '2024-01-28', 'https://openclassrooms.com/fr/courses/7696886-apprenez-a-programmer-avec-javascript?archived-source=6175841 ', 3),
(14, 'MSDN Introduction Javascript', '2024-01-29', 'https://developer.mozilla.org/fr/docs/Web/JavaScript ', 3),
(15, 'MSDN Première étape Javascript', '2024-01-30', 'https://developer.mozilla.org/fr/docs/Learn/JavaScript/First_steps', 3),
(16, 'MSDN Les bases en Javascript', '2024-01-31', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/JavaScript_basics ', 3),
(17, 'htmlcheatsheet Javascript', '2024-02-01', 'https://htmlcheatsheet.com/js/', 3),
(18, 'OpenClassRoom Apprenez à développer avec JS', '2024-02-02', 'https://openclassrooms.com/fr/courses/7696886-apprenez-a-programmer-avec-javascript', 3),
(19, 'Cours complet JS Pierre-Giraud', '2024-02-03', 'ttps://www.pierre-giraud.com/javascript-apprendre-coder-cours/', 3),
(20, 'CODEX Démarrer avec WordPress', '2024-02-04', 'https://codex.wordpress.org/fr:Demarrer_avec_WordPress', 4),
(21, 'Eprojet Installer WordPress', '2024-02-05', 'https://www.eprojet.fr/cours/wordpress/01-wordpress-installation-et-configuration-de-wordpress', 4),
(22, 'Thème Enfant WordPress Developer', '2024-02-06', 'https://developer.wordpress.org/themes/advanced-topics/child-themes/', 4),
(23, 'Thème Enfant WPFormation', '2024-02-07', 'https://wpformation.com/theme-enfant-wordpress/', 4),
(24, 'API : comprendre l\'essentiel en 4 minutes', '2024-02-08', 'https://www.youtube.com/watch?v=T0DmHRdtqY0&t=5s', 5),
(25, 'OpenClassRooms API-REST', '2024-02-09', 'https://openclassrooms.com/fr/courses/6031886-debutez-avec-les-api-rest', 5),
(26, 'PostMan', '2024-02-10', 'https://www.postman.com/', 5),
(27, 'XMLHttpRequest – Doc officielle ', '2024-02-11', 'https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest#constructeur', 5),
(28, 'Fetch API  Pierre Giraud', '2024-02-12', 'https://www.pierre-giraud.com/javascript-apprendre-coder-cours/api-fetch/', 5),
(29, 'Vidéo XMLHttpRequest', '2024-02-13', 'https://www.youtube.com/watch?v=Bct585a0Hj8', 5),
(30, 'La méthode Fetch (6 min)', '2024-02-14', 'https://www.youtube.com/watch?v=sGvEqHkDyFc', 5);

-- --------------------------------------------------------

--
-- Structure de la table `favori_categorie`
--

CREATE TABLE `favori_categorie` (
  `id_favori` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori_categorie`
--

INSERT INTO `favori_categorie` (`id_favori`, `id_categorie`) VALUES
(1, 1),
(1, 4),
(2, 2),
(2, 3),
(2, 5),
(3, 2),
(3, 3),
(3, 5),
(4, 2),
(4, 3),
(4, 5),
(4, 6),
(5, 5),
(6, 1),
(6, 2),
(6, 3),
(7, 2),
(7, 7),
(8, 3),
(8, 7),
(9, 5),
(9, 8),
(10, 1),
(10, 8),
(11, 7),
(11, 8),
(12, 9),
(12, 11),
(13, 1),
(13, 11),
(14, 5),
(14, 11),
(15, 5),
(15, 11),
(16, 5),
(16, 11),
(17, 7),
(17, 11),
(18, 1),
(18, 11),
(19, 1),
(19, 11),
(20, 10),
(20, 12),
(21, 6),
(21, 10),
(21, 12),
(22, 10),
(22, 12),
(23, 10),
(23, 12),
(24, 14),
(24, 15),
(25, 1),
(25, 15),
(26, 13),
(26, 15),
(27, 5),
(27, 11),
(27, 15),
(28, 5),
(28, 11),
(28, 15),
(29, 11),
(29, 14),
(29, 15),
(30, 12),
(30, 14),
(30, 15);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`id_domaine`);

--
-- Index pour la table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`id_favori`),
  ADD KEY `fk_id_dom` (`id_dom`);

--
-- Index pour la table `favori_categorie`
--
ALTER TABLE `favori_categorie`
  ADD PRIMARY KEY (`id_favori`,`id_categorie`),
  ADD KEY `fk_id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `id_domaine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `favori`
--
ALTER TABLE `favori`
  MODIFY `id_favori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `fk_id_dom` FOREIGN KEY (`id_dom`) REFERENCES `domaine` (`id_domaine`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `favori_categorie`
--
ALTER TABLE `favori_categorie`
  ADD CONSTRAINT `fk_id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_favori` FOREIGN KEY (`id_favori`) REFERENCES `favori` (`id_favori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
