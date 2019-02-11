-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 fév. 2019 à 11:13
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boncommande`
--

INSERT INTO `boncommande` (`id`, `numBonCommande`, `id_user`, `created_at`, `updated_at`, `slug`, `date`, `etat`, `id_fournisseur`, `total_ttc`, `service_demandeur`, `commentaire_general`) VALUES
(1, '003FFF5', 13, '2019-02-04 15:20:10', '2019-02-06 17:19:25', '003fff504022019032010', '2019-02-28', 2, 1, 340607, 'Secretariat', 'livraison a prévoir pour le lundi'),
(2, '003FFF6', 24, '2019-02-05 16:41:51', '2019-02-05 17:50:23', '003fff605022019044151', '2019-02-28', 4, 1, 69620, 'Service informatique', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `id_materiel`, `id_fournisseur`, `quantite`, `prix_unitaire`, `titre_ext`, `devise`, `created_at`, `updated_at`, `etat`, `id_bc`, `remise`, `codeRubrique`, `id_da`, `unite`, `hastva`, `prix_tot`, `valeur_tva`) VALUES
(1, 35, 1, 50, 5000, 'tuyaux à eaux', 'FCFA', '2019-02-04 15:18:36', '2019-02-04 15:23:30', 2, 1, 2, 22532, '1', 'm', 1, 245000.00, 44100.00),
(2, 36, 1, 10, 4500, 'tuyaux cylindrique', 'FCFA', '2019-02-04 15:18:36', '2019-02-04 15:23:30', 2, 1, 3, 22532, '2', 'm', 1, 43650.00, 7857.00),
(3, 33, 1, 2, 5000, 'Windows 10', 'FCFA', '2019-02-05 16:40:17', '2019-02-05 16:56:18', 2, 2, 0, 44004, '3', 'u', 1, 10000.00, 1800.00),
(4, 33, 1, 5, 7000, 'Windows 10', 'FCFA', '2019-02-05 16:40:17', '2019-02-05 16:56:18', 2, 2, 0, 44004, '4', 'u', 1, 35000.00, 6300.00),
(5, 34, 1, 4, 3500, 'office 365', 'FCFA', '2019-02-05 16:40:17', '2019-02-05 16:56:18', 2, 2, 0, 44004, '5', 'u', 1, 14000.00, 2520.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `libelle`, `domaine`, `conditionPaiement`, `commentaire`, `adresseGeographique`, `responsable`, `interlocuteur`, `email`, `created_at`, `updated_at`, `slug`, `contact`) VALUES
(1, 'EBURTIS', '2,3,4,5,6,7,8,9', NULL, NULL, 'Abidjan', 'konan', 'kone', 'cyriaquekodia@gmail.com', '2018-12-14 12:07:53', '2019-01-29 10:28:29', 'eburtis29012019102829', '[{\"titre_c\":\"kone\",\"type_c\":\"EMA\",\"valeur_c\":\"cyriaquekodia@gmail.com\"}]'),
(5, 'sogelux', '4', NULL, NULL, 'Abidjan', 'konan', NULL, 'admin@eiffage.com', '2018-12-17 16:33:49', '2019-01-10 12:37:30', 'sogelux10012019123730', '[{\"titre_c\":\"fournisseur admin\",\"type_c\":\"EMA\",\"valeur_c\":\"admin@eiffage.com\"}]'),
(6, 'test', '3', NULL, NULL, 'Abidjan', 'konan', NULL, 'cyriaquekodia@gmail.com', '2018-12-18 10:48:30', '2019-01-15 17:31:46', 'test15012019053146', '[{\"titre_c\":\"kone\",\"type_c\":\"MOB\",\"valeur_c\":\"cyriaquekodia@gmail.com\"},{\"titre_c\":\"youri\",\"type_c\":\"MOB\",\"valeur_c\":\"cyriaque.kodia@eiffage.com\"}]'),
(7, 'InfoProGICIEL', '5', NULL, NULL, 'test', 'konan', NULL, 'landrykoffi@gmail.com', '2019-01-04 09:32:40', '2019-01-15 17:30:02', 'infoprogiciel15012019053002', '[{\"titre_c\":\"Koffi landry pro\",\"type_c\":\"EMA\",\"valeur_c\":\"Thierry.KOFFI@eiffage.com\"},{\"titre_c\":\"Koffi landry perso\",\"type_c\":\"EMA\",\"valeur_c\":\"landrykoffi@gmail.com\"}]'),
(8, 'Y Entretien', '3,7', NULL, NULL, 'Abidjan', 'konan', NULL, 'cyriaquekodia@gmail.com', '2019-01-04 16:28:42', '2019-01-23 14:06:35', 'y-entretien23012019020635', '[{\"titre_c\":\"kone\",\"type_c\":\"EMA\",\"valeur_c\":\"cyriaquekodia@gmail.com\"},{\"titre_c\":\"test\",\"type_c\":\"EMA\",\"valeur_c\":\"cyriaque.kodia@gmail.com\"}]'),
(9, 'Entretien TTF', '7', NULL, NULL, 'Abidjan', 'Yadom', NULL, 'cyriaquekodia@gmail.com', '2019-01-14 17:24:07', '2019-01-25 18:00:03', 'entretien-ttf25012019060003', '[{\"titre_c\":\"kone\",\"type_c\":\"EMA\",\"valeur_c\":\"cyriaquekodia@gmail.com\"}]');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lignebesoin`
--

INSERT INTO `lignebesoin` (`id`, `unite`, `quantite`, `DateBesoin`, `id_user`, `id_reponse_fournisseur`, `id_nature`, `id_materiel`, `id_bonCommande`, `created_at`, `updated_at`, `demandeur`, `slug`, `etat`, `id_valideur`, `motif`, `usage`, `commentaire`) VALUES
(1, 'm', 50.00, '2019-02-28', 13, NULL, 1, 35, 1, '2019-02-04 14:41:44', '2019-02-06 09:00:40', 'administrateur', '3504022019024144', '3', '13', '', 'pour le jardinage', 'De diamètre 50 avec raccord'),
(2, 'm', 10.00, '2019-02-28', 13, NULL, 1, 36, 1, '2019-02-04 14:54:42', '2019-02-04 15:28:11', 'administrateur', '3604022019025442', '4', '13', '', 'test', 'de couleur noir'),
(3, 'u', 2.00, '2019-02-28', 13, NULL, 1, 33, 2, '2019-02-04 17:16:58', '2019-02-05 17:50:23', 'administrateur', '3304022019051658', '4', '13', '', 'test', NULL),
(4, 'u', 5.00, '2019-02-28', 27, NULL, 1, 33, 2, '2019-02-05 16:17:22', '2019-02-05 17:50:23', 'kodia cyriaque', '3305022019041722', '4', '28', '', 'test', 'service pack 3'),
(5, 'u', 4.00, '2019-02-27', 27, NULL, 1, 34, 2, '2019-02-05 16:18:14', '2019-02-05 17:50:24', 'kodia cyriaque', '3405022019041814', '4', '28', '', 'test', NULL),
(6, 'u', 1.00, '2019-02-28', 13, NULL, 1, 35, NULL, '2019-02-11 09:34:33', '2019-02-11 09:34:33', 'administrateur', '3511022019093433', '1', NULL, NULL, 'test', 'test');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ligne_bc`
--

INSERT INTO `ligne_bc` (`id`, `codeRubrique`, `remise_ligne_bc`, `quantite_ligne_bc`, `unite_ligne_bc`, `prix_unitaire_ligne_bc`, `id_devis`, `id_bonCommande`, `created_at`, `updated_at`, `slug`, `prix_tot`, `hastva`) VALUES
(20, '44004', '5', 8, 'U', 70000, 22, 1, '2019-01-23 15:48:35', '2019-01-23 15:54:32', '440047000023012019035432', 532000, 1),
(19, '44004', '0', 8, 'U', 50000, 23, 1, '2019-01-23 15:48:35', '2019-01-23 15:54:32', '440045000023012019035432', 400000, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `libelleMateriel`, `type`, `created_at`, `updated_at`, `slug`, `image`, `code_analytique`) VALUES
(33, 'Windows 10', '5', '2018-12-27 09:37:22', '2019-01-14 12:23:05', 'windows-1014012019122305', 'microsoft_windows_10_pro_64.png', '44004'),
(34, 'office 365', '5', '2018-12-27 09:40:20', '2019-01-09 17:34:51', 'office-36509012019053451', '617GjtWatCL._SL1500_.jpg', '44004'),
(35, 'tuyaux à eaux', '3', '2018-12-27 09:40:47', '2019-01-10 09:53:30', 'tuyaux-a-eaux10012019095330', 'tuyaux-plat-diametre-75-equipe-raccord-symetrique-guillemin.jpg', '22532'),
(36, 'tuyaux cylindrique', '3', '2018-12-27 09:41:26', '2019-01-10 09:53:08', 'tuyaux-cylindrique10012019095308', 'tuyaux-pvc-vert-epandage-diametre-40-mm.jpg', '22532'),
(37, 'tuyaux d\'aspiration', '7', '2018-12-27 09:41:57', '2019-01-10 09:53:47', 'tuyaux-daspiration10012019095347', 'tuyaux-d-aspirateur-pour-aspirateur-ct-festool-ig-41836.jpg', '33214'),
(38, 'novad', '5', '2018-12-27 10:00:06', '2019-01-23 15:16:21', 'novad23012019031621', '', '44004');

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
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleProfil` varchar(191) NOT NULL,
  `descriptionProfil` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelleProfil`, `descriptionProfil`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Administrateur', '1000,2000,3000,4000,5000,6000,7000,8000', '2018-11-02 10:43:59', '2018-11-09 15:49:32', 'administrateur09112018034932');

-- --------------------------------------------------------

--
-- Structure de la table `reponse_fournisseur`
--

DROP TABLE IF EXISTS `reponse_fournisseur`;
CREATE TABLE IF NOT EXISTS `reponse_fournisseur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(11) NOT NULL,
  `titre_ext` varchar(191) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `unite` text,
  `prix` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `id_lignebesoin` int(11) NOT NULL,
  `remise` int(11) DEFAULT NULL,
  `date_precise` date DEFAULT NULL,
  PRIMARY KEY (`id`)
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trace_mail`
--

INSERT INTO `trace_mail` (`id`, `id_fournisseur`, `das`, `created_at`, `updated_at`, `rappel`, `email`) VALUES
(39, 1, '', '2019-02-05 16:39:43', '2019-02-05 16:39:43', 'on', 'cyriaquekodia@gmail.com'),
(38, 1, ' - 4 u de office 365, - 2 u de Windows 10, - 5 u de Windows 10', '2019-02-05 16:39:25', '2019-02-05 16:39:25', '', 'cyriaquekodia@gmail.com'),
(37, 1, '', '2019-02-05 12:00:22', '2019-02-05 12:00:22', 'on', 'cyriaquekodia@gmail.com'),
(36, 1, ' - 2 u de Windows 10', '2019-02-05 10:30:28', '2019-02-05 10:30:28', '', 'cyriaquekodia@gmail.com'),
(35, 1, ' - 2 u de Windows 10', '2019-02-05 10:29:08', '2019-02-05 10:29:08', '', 'cyriaquekodia@gmail.com'),
(34, 1, ' - 10 m de tuyaux cylindrique, - 50 m de tuyaux à eaux', '2019-02-04 15:09:13', '2019-02-04 15:09:13', 'on', 'cyriaquekodia@gmail.com'),
(33, 6, ' - 10 m de tuyaux cylindrique, - 50 m de tuyaux à eaux', '2019-02-04 15:08:24', '2019-02-04 15:08:24', '', 'cyriaque.kodia@eiffage.com'),
(32, 8, ' - 10 m de tuyaux cylindrique, - 50 m de tuyaux à eaux', '2019-02-04 15:08:20', '2019-02-04 15:08:20', '', 'cyriaque.kodia@gmail.com'),
(31, 1, ' - 10 m de tuyaux cylindrique, - 50 m de tuyaux à eaux', '2019-02-04 15:08:15', '2019-02-04 15:08:15', '', 'cyriaquekodia@gmail.com');

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
(13, 'administrateur', 'Admin', 'Secretariat', 'Gestionnaire Application', '+XXX XX XX XX XX', 'admin@eiffage.com', NULL, '$2y$10$8GZ5S6a5qqaTdRtc6/wYvOBuPH13yhpioX9mWd9QxwvJL1ejmpX2m', 'MOgf8svlqX4ZtZmpCNeTrnuHPSAflXekuE8PsIoCG5jKYPnrZlm1Vc5BYCo5', '2018-11-26 08:11:56', '2019-02-06 16:53:59', NULL, 'admin-at-eiffagecom06022019045359', NULL),
(23, 'test', 'test', 'Service méthodes', 'informaticien', '67988805', 'test@gmail.com', NULL, '$2y$10$0tAvvhoB5OAjAOMEISykauhjhmBHf/iGpRctZ.EuYtumXQnpCoXk.', 'WB9q0NEBSWQSrlFKBFqLDAuidDgLFESvVrbfLZWarmnYiya8CtDWGoPAJMBX', '2019-01-09 11:50:33', '2019-01-09 11:50:33', NULL, 'test-at-gmailcom09012019115033', 'test'),
(24, 'ekra', 'EM', 'Secretariat', 'controlleur DE GESTION', '+225 68 52 22 11', 'melaine.ekra@eiffage.com', NULL, '$2y$10$whbXPPGjABe3k24AeyvQmupiIEkWH5Jj27s1W9OIq3uiYCyNXWfzW', 'zGAC2JVMec3FWqfStjtL3GsXeWSGzqs28JzSQ1Q5FZrj8KawmgXqOjMTWKel', '2019-02-05 15:51:28', '2019-02-05 15:54:05', NULL, 'melaineekra-at-eiffagecom05022019035405', 'melaine'),
(25, 'oulai', 'OM', 'Direction', 'Service achat', '+225 68 52 22 11', 'marinna.oulai@eiffage.com', NULL, '$2y$10$2uliNyjMiGfx9V7/WzyDMuge6sprnEHxYTUXb1YAr7cGI9wq3HBUq', 'TZ6TWbCEnOshGyZ9VMSz2E9Hwer0oG7rXI9t4gEvgZtTQlUkUT75DOvkdWXM', '2019-02-05 16:11:22', '2019-02-05 16:36:22', NULL, 'marinnaoulai-at-eiffagecom05022019043622', 'marinna'),
(26, 'deschampss', 'DN', 'Direction', 'Directeur', '+225 68 52 22 11', 'nicolas.deschampss@eiffage.com', NULL, '$2y$10$.GaOrtb7rsZH2nZDHrgB8Oq5DIxLlmEt/kPr2VwT2xvp2cOsiQmp6', 'nrXiTvnQpFOiszm1O2wTDXjTj1op06Rw15Maajhgf9miva6JsyKPzBLIBhqP', '2019-02-05 16:12:38', '2019-02-06 17:05:07', NULL, 'nicolasdeschampss-at-eiffagecom06022019050506', 'nicolas'),
(27, 'kodia', 'CK', 'Service informatique', 'informaticien', '67988805', 'cyriaque.kodia@eiffage.com', NULL, '$2y$10$wKx.mDsmqI.l66QQ.5J2vuh7r92WLGmVFWbM6JeCactwg7uiLvRaK', '5QXDC20CLDVQs00LmZq8c9AFIxUVxjl6J77XPMOTaP53bf64R1pLSdTgUYP6', '2019-02-05 16:14:15', '2019-02-11 11:12:56', NULL, 'cyriaquekodia-at-eiffagecom11022019111256', 'cyriaque'),
(28, 'd', 'DS', 'Service travaux', 'controlleur', '67988805', 'sylvain.d@eiffage.com', NULL, '$2y$10$InsXklLLnJIGvG558ahhzOgpcl1/tXh.860azp3f.rYtXkCCsOZqq', 'rJWtZKfZQOmpenQGYlz7JhDYxahwb9LnEeLTE2h3w9NYQz9Bx5FlT4jgVumo', '2019-02-05 16:24:28', '2019-02-05 16:24:47', NULL, 'sylvaind-at-eiffagecom05022019042447', 'sylvain');

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
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(23, NULL, NULL, 15, 80),
(37, NULL, NULL, 17, 80),
(38, NULL, NULL, 18, 80),
(39, NULL, NULL, 19, 80),
(40, NULL, NULL, 20, 80),
(41, NULL, NULL, 21, 80),
(109, NULL, NULL, 24, 80),
(110, NULL, NULL, 24, 83),
(118, NULL, NULL, 28, 80),
(119, NULL, NULL, 28, 81),
(120, NULL, NULL, 25, 80),
(121, NULL, NULL, 25, 82),
(166, NULL, NULL, 13, 79),
(167, NULL, NULL, 13, 80),
(168, NULL, NULL, 13, 81),
(169, NULL, NULL, 13, 82),
(170, NULL, NULL, 13, 83),
(171, NULL, NULL, 13, 84),
(180, NULL, NULL, 26, 80),
(181, NULL, NULL, 26, 84),
(182, NULL, NULL, 27, 80),
(183, NULL, NULL, 27, 81);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
