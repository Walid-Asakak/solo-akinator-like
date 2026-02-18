-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mer. 18 fév. 2026 à 21:34
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `walidasakak_akinator_like`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `answer` enum('oui','non') NOT NULL,
  `question_id` int(11) NOT NULL,
  `next_question_id` int(11) DEFAULT NULL,
  `result_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `question_id`, `next_question_id`, `result_id`) VALUES
(1, 'oui', 1, 2, NULL),
(2, 'non', 1, 8, NULL),
(3, 'oui', 2, 3, NULL),
(4, 'non', 2, 6, NULL),
(5, 'oui', 3, NULL, 2),
(6, 'non', 3, 4, NULL),
(7, 'oui', 4, NULL, 1),
(8, 'non', 4, 5, NULL),
(9, 'oui', 5, NULL, 3),
(10, 'non', 5, NULL, 4),
(11, 'oui', 6, NULL, 7),
(12, 'non', 6, 7, NULL),
(13, 'oui', 7, NULL, 5),
(14, 'non', 7, NULL, 6),
(15, 'oui', 8, 9, NULL),
(16, 'non', 8, 10, NULL),
(17, 'oui', 9, NULL, 8),
(18, 'non', 9, NULL, 9),
(19, 'oui', 10, NULL, 10),
(20, 'non', 10, 11, NULL),
(21, 'oui', 11, NULL, 11),
(22, 'non', 11, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `played_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `is_first_question` tinyint(1) NOT NULL,
  `question_text` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `is_first_question`, `question_text`) VALUES
(1, 1, 'Est-ce une course ?'),
(2, 0, 'La distance parcourue est-elle courte ?'),
(3, 0, 'Y a-t-il des obstacles ?'),
(4, 0, 'L’épreuve se déroule-t-elle en extérieur ?'),
(5, 0, 'Est-ce une course individuelle ?'),
(6, 0, 'La distance est-elle supérieure à 10 km ?'),
(7, 0, 'La distance est-elle inférieure à 3000 m ?'),
(8, 0, 'Faut-il sauter ?'),
(9, 0, 'Utilise-t-on une perche ?'),
(10, 0, 'L’objet lancé est-il léger ?'),
(11, 0, 'L’objet lancé a-t-il une forme sphérique ?');

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `results`
--

INSERT INTO `results` (`id`, `name`, `description`, `picture`) VALUES
(1, 'Épreuve de sprint en stade', 'Course courte et rapide en extérieur', 'sprint_stade.png'),
(2, 'Sprint haies en stade', 'Course rapide avec haies en extérieur', 'sprint_haies_stade.png'),
(3, 'Épreuve de sprint individuelle en salle', 'Sprint individuel en intérieur', 'sprint_individuel_salle.png'),
(4, 'Épreuve de sprint en relais en salle', 'Sprint en relais en intérieur', 'sprint_relais_salle.png'),
(5, 'Épreuve de demi-fond', 'Course de moyenne distance', 'demi_fond.png'),
(6, 'Épreuve de fond', 'Course longue distance sur piste', 'fond.png'),
(7, 'Course longue distance', 'Course supérieure à 10 kilomètres', 'longue_distance.png'),
(8, 'Saut à la perche', 'Saut avec utilisation d\'une perche', 'saut_perche.png'),
(9, 'Saut en hauteur', 'Saut vertical sans perche', 'saut_hauteur.png'),
(10, 'Lancer de javelot', 'Lancer d\'un objet léger et allongé', 'lancer_javelot.png'),
(11, 'Lancer de poids', 'Lancer d\'un objet sphérique lourd', 'lancer_poids.png'),
(12, 'Lancer de marteau', 'Lancer d\'un objet lourd relié par câble', 'lancer_marteau.png');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Walid', 'emailfictif@gmail.com', '$2y$10$as6ndJL7T.zKTzl2RrdsgeaGUwZxGwznsIv0YwH/HkeNA6zccTokK'),
(3, 'Clara', 'emailfictif2@gmail.com', '$2y$10$YVwWmkRisT5NCT/i8y.bzeoOCyyGgo/emSs7taIx077s0ecFXnab.'),
(4, 'Patrick', 'emailfictif3@mail.com', '$2y$10$j7EDCfpLtPZ3SWtZ.3Dag.t8PQkcDbr26KV8Di6GkDzoPLurbQCIS'),
(6, 'Bob', 'emailfictif4@gmail.com', '$2y$10$O10k/wA2IqdNeWM2XPe4De1pjQzfx0DC//jm32OVHnoH6qBGioUBK');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answers_question` (`question_id`),
  ADD KEY `fk_answers_next_question` (`next_question_id`),
  ADD KEY `fk_answers_result` (`result_id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_games_user` (`user_id`),
  ADD KEY `fk_games_result` (`result_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_next_question` FOREIGN KEY (`next_question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_answers_question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_answers_result` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_result` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_games_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
