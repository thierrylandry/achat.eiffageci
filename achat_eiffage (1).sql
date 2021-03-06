-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 19 fév. 2019 à 11:25
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `achat_eiffage`
--

-- --------------------------------------------------------

--
-- Structure de la table `analytique`
--

DROP TABLE IF EXISTS `analytique`;
CREATE TABLE IF NOT EXISTS `analytique` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeRubrique` varchar(191) NOT NULL,
  `libelle` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=741 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `analytique`
--

INSERT INTO `analytique` (`id`, `codeRubrique`, `libelle`, `created_at`, `updated_at`) VALUES
(511, '22525', 'Pieces d\'usure/rechange', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(512, '33235', 'MONTAGE CHILLER', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(513, '33208', 'Loc materiel de transport', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(514, '33232', 'Loc materiel associe 2', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(515, '22532', 'Pompes immergees', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(516, '66309', 'Autres prestations', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(517, '66302', 'Montage demontage installation', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(518, '33107', 'Loc int. mat traitement', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(519, '33214', 'Loc materiel divers', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(520, '44004', 'Fournitures  informatiques', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(521, '33301', 'Entretien reparations divers', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(522, '33302', 'Entretien mat de transport', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(523, '33115', 'Amts materiel chantier', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(524, '77202', 'Assurance decennale', '2019-01-09 15:54:51', '2019-01-09 15:54:51'),
(525, '77203', 'Assurance multirisques rc', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(526, '11243', 'Frais divers de personnel enc.', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(527, '44002', 'Charges administ. diverses', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(528, '11244', 'Telephones portables', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(529, '11245', 'MOBILIER Villas Expatriés', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(530, '11241', 'Frais deplacement cadres/etam', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(531, '11241', 'Frais deplacement cadres/etam', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(532, '11243', 'Frais divers de personnel enc.', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(533, '44019', 'Frais postaux', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(534, '44020', 'Frais de telecommunication', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(535, '22516', 'Eau', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(536, '22515', 'Electricite', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(537, '66308', 'Mise decharge materiaux divers', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(538, '66301', 'Gardiennage chantier', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(539, '55108', 'Honoraires divers', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(540, '44016', 'Catalogues et imprimes', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(541, '44003', 'Fournitures de bureau', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(542, '11333', 'Medecine du travail', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(543, '11332', 'CONTRAT AMBULANCES', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(544, '44025', 'Frais de coll. seminaire', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(545, '22501', 'Bois', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(546, '22501', 'Bois', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(547, '22506', 'Gazole', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(548, '22507', 'Huiles & graisses', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(549, '22527', 'Peinture routiere', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(550, '22528', 'POUTRELLES ASCENSEUR', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(551, '22529', 'POUTRELLES SUR ENGINS', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(552, '22530', 'FOURNITURES GMA', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(553, '22531', 'TEFLON', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(554, '22208', 'Palplanches', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(555, '22208', 'Palplanches', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(556, '22208', 'Palplanches', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(557, '22535', 'LIERNES', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(558, '22519', 'Consommables  coffrages', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(559, '22508', 'Joints', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(560, '22508', 'Joints', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(561, '22537', 'ABOUT DE POUTRE', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(562, '22538', 'COFFRAGE SUR MESURE ABOUTS', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(563, '22539', 'OUTIL POUR TROTTOIRS', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(564, '22540', 'OUTIL PREDALLES GALERIE TECH.', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(565, '22419', 'Tuyaux pvc', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(566, '22541', 'INJECTEURS POUR FISSURES', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(567, '22542', 'EXTINCTEURS', '2019-01-09 15:54:52', '2019-01-09 15:54:52'),
(568, '55202', 'CAISSES POUR ESSAIS BETON', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(569, '22522', 'Petit outillage', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(570, '11242', 'Missions - receptions', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(571, '22521', 'Materiel signalisation', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(572, '22521', 'Materiel signalisation', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(573, '22521', 'Materiel signalisation', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(574, '22526', 'Divers matieres consommables', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(575, '22523', 'Equip. Personnel & securite', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(576, '22523', 'Equip. Personnel & securite', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(577, '33121', 'LLD Materiel Divers', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(578, '55106', 'Frais de labo ext.', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(579, '22517', 'Autres fluides & gaz', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(580, '22423', 'Transport sur achats', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(581, '22423', 'Transport sur achats', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(582, '22423', 'Transport sur achats', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(583, '22423', 'Transport sur achats', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(584, '22423', 'Transport sur achats', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(585, '22423', 'Transport sur achats', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(586, '22424', 'Transport sur vente', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(587, '22425', 'TRSPT SABLE DE LAGUNE', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(588, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(589, '11246', 'VOYAGES EXPAT', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(590, '11243', 'Frais divers de personnel enc.', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(591, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(592, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(593, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(594, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(595, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(596, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(597, '11246', 'VOYAGES EXPAT', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(598, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(599, '11211', 'Salaires cadres', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(600, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(601, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(602, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(603, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(604, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(605, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(606, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(607, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(608, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:53', '2019-01-09 15:54:53'),
(609, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(610, '11221', 'Encadrement pret associe 1', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(611, '11320', 'COUTS EXTERNES DE FORMATION', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(612, '55201', 'Frais de controle technique', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(613, '66321', 'BATHYMETRIE', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(614, '66320', 'PLONGEURS', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(615, '66322', 'CAMPAGNE RADAR', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(616, '66323', 'EPREUVES D\'OUVRAGE', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(617, '55105', 'Geometres & autres techniciens', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(618, '66324', 'SUIVI TOPO CHANTIER', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(619, '55105', 'Geometres & autres techniciens', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(620, '66325', 'INSTRUMENTATION', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(621, '66326', 'ETALONNAGE CENTRALE', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(622, '55103', 'Frais etudes externes', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(623, '55203', 'Controles obligatoires', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(624, '66319', 'POLYGONALE', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(625, '66321', 'BATHYMETRIE', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(626, '55110', 'Frais d\'etudes associe 1', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(627, '55111', 'Frais d\'etudes associe 2', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(628, '55109', 'Frais d\'actes et contentieux', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(629, '88101', 'Frais bancaires', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(630, '99006', 'Frais generaux de siege', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(631, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(632, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(633, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(634, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(635, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(636, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(637, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(638, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(639, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(640, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(641, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(642, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(643, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(644, '33115', 'Amts materiel chantier', '2019-01-09 15:54:54', '2019-01-09 15:54:54'),
(645, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(646, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(647, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(648, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(649, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(650, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(651, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(652, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(653, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(654, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(655, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(656, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(657, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(658, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(659, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(660, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(661, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(662, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(663, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(664, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(665, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(666, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(667, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(668, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(669, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(670, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(671, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(672, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(673, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(674, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(675, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(676, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(677, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(678, '33115', 'Amts materiel chantier', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(679, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(680, '33212', 'Loc mat.levage et manutent.', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(681, '33224', 'CREW BOAT CIC', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(682, '33211', 'Loc de chargeurs', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(683, '33231', 'Loc materiel associe 1', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(684, '33236', 'VIBRO-FONCEUR', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(685, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(686, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(687, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(688, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(689, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:55', '2019-01-09 15:54:55'),
(690, '33233', 'Loc materiel associe 3', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(691, '33234', 'Loc materiel associe 4', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(692, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(693, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(694, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(695, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(696, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(697, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(698, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(699, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(700, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(701, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(702, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(703, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(704, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(705, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(706, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(707, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(708, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(709, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(710, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(711, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(712, '11110', 'Salaires ouvriers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(713, '22334', 'Sable Lagune', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(714, '22335', 'Sable carriere', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(715, '22301', 'Agregats', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(716, '22302', 'Asphalte', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(717, '22518', 'Adjuvants', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(718, '22407', 'Dallage pavage pierre', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(719, '22409', 'Materiaux divers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(720, '22103', 'Ciments & mortiers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(721, '22103', 'Ciments & mortiers', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(722, '22498', 'REVENTE BETON SPIE', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(723, '22201', 'Armatures faconnees', '2019-01-09 15:54:56', '2019-01-09 15:54:56'),
(724, '22410', 'Materiaux maconnerie et vrd', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(725, '22104', 'CPJ Sac', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(726, '22411', 'Materiaux non traites', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(727, '22412', 'Materiaux recycles', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(728, '22413', 'GBA', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(729, '22414', 'Parpaings & briques', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(730, '22415', 'Produits reseaux divers', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(731, '22416', 'Traverses bois & beton', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(732, '22105', 'MORTIER DE RAGREAGE', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(733, '22106', 'INJECTION DE FISSURES', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(734, '22107', 'PROTECTION DES PAREMENTS', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(735, '22108', 'MORTIER DE REPARATION', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(736, '66101', 'Sous traitance tiers', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(737, '66105', 'CONSTRUCTION ATELIER', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(738, '66107', 'TERRASSEMENT PF PREFA', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(739, '66102', 'Sous traitance inter branche', '2019-01-09 15:54:57', '2019-01-09 15:54:57'),
(740, '66108', 'QUAI D\'ACCOSTAGE', '2019-01-09 15:54:57', '2019-01-09 15:54:57');

-- --------------------------------------------------------

--
-- Structure de la table `boncommande`
--

DROP TABLE IF EXISTS `boncommande`;
CREATE TABLE IF NOT EXISTS `boncommande` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numBonCommande` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `date` date DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  `id_fournisseur` int(11) NOT NULL,
  `total_ttc` int(11) DEFAULT NULL,
  `service_demandeur` varchar(191) DEFAULT NULL,
  `commentaire_general` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numBonCommande` (`numBonCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_materiel` int(11) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix_unitaire` bigint(20) DEFAULT NULL,
  `titre_ext` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `id_bc` int(11) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `codeRubrique` int(11) DEFAULT NULL,
  `id_da` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hastva` int(11) DEFAULT NULL,
  `prix_tot` double(8,2) DEFAULT NULL,
  `valeur_tva` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

DROP TABLE IF EXISTS `domaines`;
CREATE TABLE IF NOT EXISTS `domaines` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleDomainne` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `libelleDomainne`, `created_at`, `updated_at`) VALUES
(1, 'Matériels de quincaillerie', NULL, NULL),
(2, 'Matériels électriques ', NULL, NULL),
(3, 'Matériels de plomberie', NULL, NULL),
(4, 'Matériels mécaniques', NULL, NULL),
(5, 'Matériels informatiques', NULL, NULL),
(6, 'Matériels de laboratoire', NULL, NULL),
(7, 'Matériels d’entretien et nettoyage ', NULL, NULL),
(8, 'Fournitures de bureau et d’imprimerie ', NULL, NULL),
(9, 'E.P.I', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) NOT NULL,
  `domaine` varchar(191) NOT NULL,
  `conditionPaiement` text,
  `commentaire` text,
  `adresseGeographique` varchar(191) DEFAULT NULL,
  `responsable` varchar(191) DEFAULT NULL,
  `interlocuteur` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `contact` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `importer`
--

DROP TABLE IF EXISTS `importer`;
CREATE TABLE IF NOT EXISTS `importer` (
  `codeRubrique` varchar(100) DEFAULT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignebesoin`
--

DROP TABLE IF EXISTS `lignebesoin`;
CREATE TABLE IF NOT EXISTS `lignebesoin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unite` varchar(191) NOT NULL,
  `quantite` double(8,2) NOT NULL,
  `DateBesoin` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_reponse_fournisseur` int(11) DEFAULT NULL,
  `id_nature` int(11) DEFAULT NULL,
  `id_materiel` int(11) DEFAULT NULL,
  `id_bonCommande` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `demandeur` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `etat` varchar(191) NOT NULL DEFAULT '1',
  `id_valideur` varchar(191) DEFAULT NULL,
  `motif` varchar(191) DEFAULT NULL,
  `usage` varchar(191) DEFAULT NULL,
  `commentaire` text,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_bc`
--

DROP TABLE IF EXISTS `ligne_bc`;
CREATE TABLE IF NOT EXISTS `ligne_bc` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeRubrique` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remise_ligne_bc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite_ligne_bc` int(11) DEFAULT NULL,
  `unite_ligne_bc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix_unitaire_ligne_bc` float DEFAULT NULL,
  `id_devis` int(11) DEFAULT NULL,
  `id_bonCommande` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_tot` float DEFAULT NULL,
  `hastva` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleMateriel` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `code_analytique` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_10_163336_add_id_profil_to_users_table', 1),
(4, '2018_10_18_103504_create_profil_table', 1),
(5, '2018_10_18_105538_create_materiel_table', 1),
(6, '2018_10_18_112422_create_nature_table', 1),
(7, '2018_10_18_113016_create_fournisseur_table', 1),
(8, '2018_10_18_115141_create_analytique_table', 1),
(9, '2018_10_18_115945_create_boncommande_table', 1),
(10, '2018_10_18_154205_create_lignebesoin_table', 1),
(11, '2018_10_26_170333_add_slug_to_fournisseur', 2),
(12, '2018_10_30_125617_add_slug_to_materiel_table', 3),
(13, '2018_10_30_173310_add_slug_to_users_table', 4),
(14, '2018_11_02_102004_add_slug_to_profil', 5),
(15, '2018_11_05_122909_create_table_tbprix', 6),
(16, '2018_11_05_141327_add_slug_to_tbprix_table', 7),
(17, '2018_11_05_150926_add_id_fournisseur_et_id_materiel_to_tbprix_table', 8),
(18, '2018_11_06_120314_add_demandeur_to_lignebesoin', 9),
(19, '2018_11_06_145046_add_slug_to_lignebesoin', 10),
(20, '2018_11_07_092915_add_etat_to_lignebesoin', 11),
(21, '2018_11_12_115716_creation_de_la_table_domaine', 12),
(22, '2018_11_19_080538_create_table_reponse_fournisseur', 13),
(23, '2018_11_19_081841_add_slug__and_id_lignebesoin_to_reponse_fournisseur', 14),
(24, '2016_03_31_065856_create_roles_table', 15),
(25, '2016_03_31_070114_create_user_role_table', 15),
(26, '2018_11_26_110237_create_ligne_bc_table', 16),
(27, '2018_11_26_114224_add_slug_to_ligne_bc_table', 17),
(28, '2018_11_26_114446_add_slug_to_bon_commande_table', 18),
(29, '2018_11_28_153729_add_date_to_boncommande', 19),
(30, '2018_11_28_164345_add_etat_to_boncommande', 20),
(31, '2018_11_29_142810_supprimer_id_fournisseur_select_pour_id_reponse_fournisseur', 21),
(32, '2018_11_30_081711_add_id_fournisseur', 22),
(33, '2018_12_03_082757_add_remise_and_dateprecis_to_table_reponse_fournisseur', 23),
(34, '2018_12_03_151342_add_prix_tot_to_ligne_bc', 24),
(35, '2018_12_06_174847_create_table_service', 25),
(36, '2018_12_07_102916_add_numero_to_user', 25),
(37, '2018_12_11_153440_add_total_ttc_to_boncommande', 25),
(38, '2018_12_17_153415_add_contact_to_fournisseur', 26),
(39, '2018_12_19_121900_add_motif_to_da', 27),
(40, '2018_12_27_092141_add_image_to_materiel', 28),
(41, '2018_12_30_230821_create_table_devis', 29),
(42, '2019_01_03_163411_add_etat_to_devis', 29),
(43, '2019_01_04_140622_add_id_bc_to_devi', 30),
(44, '2019_01_04_152830_add_remise_cod_rubrique_id_da_to_devis', 31),
(45, '2019_01_04_163129_add_unite_to_devi', 32),
(46, '2019_01_07_011431_add_service_demandeur_to_boncommende', 33),
(47, '2019_01_08_160019_add_libelle_to_analytique', 34),
(48, '2019_01_09_112549_add_code_analytique_to_materiel', 35),
(49, '2019_01_10_173726_add_usage_commentaire_to_lignebesoin', 36),
(50, '2019_01_14_164744_create_trace_mail', 37),
(51, '2019_01_15_154007_add_rappel_email_to_trace_mail', 38),
(52, '2019_01_18_090525_add_tva_to_devis', 39),
(53, '2019_01_18_175033_add_hastva_to_hastva_to', 40),
(54, '2019_01_23_162055_add_prix_tot_valeur_tva_to_devis', 41),
(55, '2019_01_29_164546_add_commentaire_general_to_bc', 42);

-- --------------------------------------------------------

--
-- Structure de la table `nature`
--

DROP TABLE IF EXISTS `nature`;
CREATE TABLE IF NOT EXISTS `nature` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleNature` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nature`
--

INSERT INTO `nature` (`id`, `libelleNature`, `created_at`, `updated_at`) VALUES
(1, 'Materiel', NULL, NULL),
(2, 'Consultation', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
(79, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Parametrage', 'PARAMETRAGE'),
(80, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Gestionnaire_DA', 'GESTION DES D.A'),
(81, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Valideur_DA', 'VALIDATION DES D.A'),
(82, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Gestionnaire_Pro_Forma', 'GESTION DES PRO FORMA'),
(83, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Gestionnaire_BC', 'GESTION DES B.C'),
(84, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Valideur_BC', 'VALIDATION DES B.C');

-- --------------------------------------------------------

--
-- Structure de la table `tbprix`
--

DROP TABLE IF EXISTS `tbprix`;
CREATE TABLE IF NOT EXISTS `tbprix` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prix` varchar(191) NOT NULL,
  `unite` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `trace_mail`
--

DROP TABLE IF EXISTS `trace_mail`;
CREATE TABLE IF NOT EXISTS `trace_mail` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(11) NOT NULL,
  `das` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rappel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(15) NOT NULL,
  `abréviation` varchar(191) DEFAULT NULL,
  `service` varchar(30) DEFAULT NULL,
  `function` varchar(191) DEFAULT NULL,
  `contact` varchar(16) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profil` int(11) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `prenoms` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `abréviation`, `service`, `function`, `contact`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_profil`, `slug`, `prenoms`) VALUES
(13, 'administrateur', 'Admin', 'Secretariat', 'Gestionnaire Application', '+XXX XX XX XX XX', 'admin@eiffage.com', NULL, '$2y$10$8GZ5S6a5qqaTdRtc6/wYvOBuPH13yhpioX9mWd9QxwvJL1ejmpX2m', 'AT9bqWrqhSSeGozSVMZabHw2W9NwmXoBO81t8NdPmuWSgQ3RZrWF3TsJD0Z4', '2018-11-26 08:11:56', '2019-02-06 16:53:59', NULL, 'admin-at-eiffagecom06022019045359', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(166, NULL, NULL, 13, 79),
(167, NULL, NULL, 13, 80),
(168, NULL, NULL, 13, 81),
(169, NULL, NULL, 13, 82),
(170, NULL, NULL, 13, 83),
(171, NULL, NULL, 13, 84);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
