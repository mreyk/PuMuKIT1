<?php

/**
 * profile batch script
 *
 * Script que elementos que tiene relaciones rotas.
 * (Objetos multimedia sin series; Archivos de video, Materiales,
 * Links, Areas de Conocimiento y Personas que no tienen Objetos Multimedia)
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();


$itunes_log = array(
		    array(212, 'es', '2246628486'), 
		    array(212, 'gl', '2246644210'), 
		    array(286, 'es', '2245078168'), 
		    array(286, 'gl', '2247036740'), 
		    array(286, 'en', '2246971787'), 
		    array(286, 'xx', '2246300905'), 
		    array(224, 'es', '2246530020'), 
		    array(224, 'gl', '2246480639'), 
		    array(224, 'en', '2246971815'), 
		    array(224, 'xx', '2246890398'), 
		    array(288, 'en', '2246317178'), 
		    array(288, 'xx', '2246399052'), 
		    array(287, 'es', '2247135081'), 
		    array(287, 'gl', '2245110976'), 
		    array(014, 'es', '2246644253'), 
		    array(014, 'gl', '2246317205'), 
		    array(250, 'es', '2245127288'), 
		    array(250, 'gl', '2246123476'), 
		    array(251, 'es', '2246480674'), 
		    array(251, 'gl', '2246922834'), 
		    array(252, 'es', '2247118676'), 
		    array(252, 'gl', '2247021233'), 
		    array(252, 'en', '2247135115'), 
		    array(252, 'xx', '2247102350'), 
		    array(257, 'es', '2246890437'), 
		    array(257, 'gl', '2246857125'), 
		    array(257, 'en', '2246971858'), 
		    array(257, 'xx', '2246987797'), 
		    array(253, 'es', '2244996298'), 
		    array(253, 'gl', '2245111016'), 
		    array(255, 'es', '2246890468'), 
		    array(255, 'gl', '2246857156'), 
		    array(254, 'es', '2246480715'), 
		    array(254, 'gl', '2244980066'), 
		    array(258, 'es', '2246300963'), 
		    array(258, 'gl', '2246317252'), 
		    array(265, 'es', '2246300989'), 
		    array(265, 'gl', '2247036806'), 
		    array(285, 'es', '2246317276'), 
		    array(285, 'gl', '2246971899'), 
		    array(261, 'es', '2244980097'), 
		    array(261, 'gl', '2246123518'), 
		    array(262, 'es', '2246971924'), 
		    array(262, 'gl', '2246939302'), 
		    array(263, 'es', '2246123543'), 
		    array(263, 'gl', '2244996342'), 
		    array(268, 'es', '2246939328'), 
		    array(268, 'gl', '2245045064'), 
		    array(269, 'es', '2246123569'), 
		    array(269, 'es', '2246939353'), 
		    array(269, 'gl', '2244980130'), 
		    array(269, 'gl', '2246480760'), 
		    array(270, 'es', '2244980154'), 
		    array(270, 'gl', '2246123596'), 
		    array(283, 'es', '2246971959'), 
		    array(283, 'gl', '2246971982'), 
		    array(282, 'es', '2244996375'), 
		    array(282, 'gl', '2246972006'), 
		    array(273, 'es', '2246890523'), 
		    array(273, 'gl', '2245078251'), 
		    array(274, 'es', '2246350557'), 
		    array(274, 'gl', '2246808060'), 
		    array(278, 'es', '2246350583'), 
		    array(278, 'es', '2247151103'), 
		    array(278, 'gl', '2247102427'), 
		    array(278, 'gl', '2246890558'), 
		    array(275, 'es', '2246644341'), 
		    array(275, 'gl', '2246939399'), 
		    array(276, 'es', '2246939422'), 
		    array(276, 'gl', '2245078288'), 
		    array(281, 'es', '2246317329'), 
		    array(281, 'es', '2246857232'), 
		    array(281, 'gl', '2246644374'), 
		    array(281, 'gl', '2247102464'), 
		    array(279, 'es', '2246301063'), 
		    array(279, 'gl', '2247167673'), 
		    array(279, 'en', '2247118768'), 
		    array(279, 'xx', '2246857263'), 
		    array(280, 'es', '2246987887'), 
		    array(280, 'gl', '2246644406'), 
		    array(290, 'es', '2246808111'), 
		    array(290, 'gl', '2246987913'), 
		    array(291, 'es', '2246939465'), 
		    array(291, 'gl', '2247167707'), 
		    array(292, 'es', '2246922947'), 
		    array(292, 'gl', '2246972068'), 
		    array(294, 'es', '2245045143'), 
		    array(294, 'es', '2246922973'), 
		    array(294, 'gl', '2246890610'), 
		    array(294, 'gl', '2247167737'), 
		    array(295, 'es', '2247021350'), 
		    array(295, 'gl', '2246480839'), 
		    array(316, 'es', '2246644447'), 
		    array(316, 'es', '2246808152'), 
		    array(316, 'gl', '2247135235'), 
		    array(316, 'gl', '2247151172'), 
		    array(297, 'en', '2246987956'), 
		    array(297, 'xx', '2245111123'), 
		    array(298, 'es', '2245045182'), 
		    array(298, 'gl', '2244980245'), 
		    array(300, 'es', '2246530171'), 
		    array(300, 'gl', '2246530195'), 
		    array(301, 'es', '2246399189'), 
		    array(301, 'gl', '2247135267'), 
		    array(303, 'es', '2246987989'), 
		    array(303, 'es', '2245127436'), 
		    array(303, 'gl', '2246890655'), 
		    array(303, 'gl', '2247036908'), 
		    array(304, 'en', '2246530226'), 
		    array(304, 'xx', '2246317403'), 
		    array(306, 'es', '2247036934'), 
		    array(306, 'gl', '2245078371'), 
		    array(367, 'es', '2247036958'), 
		    array(367, 'gl', '2245111169'), 
		    array(309, 'es', '2244980287'), 
		    array(309, 'es', '2247135304'), 
		    array(309, 'gl', '2245111194'), 
		    array(309, 'gl', '2244996493'), 
		    array(310, 'es', '2246923036'), 
		    array(310, 'gl', '2246988029'), 
		    array(311, 'es', '2246480898'), 
		    array(311, 'gl', '2244980316'), 
		    array(312, 'es', '2245111222'), 
		    array(312, 'gl', '2246939540'), 
		    array(313, 'es', '2246317442'), 
		    array(313, 'gl', '2247021417'), 
		    array(314, 'es', '2247036996'), 
		    array(314, 'gl', '2245078409'), 
		    array(322, 'es', '2246480929'), 
		    array(322, 'gl', '2246123720'), 
		    array(317, 'es', '2246399246'), 
		    array(317, 'es', '2246644517'), 
		    array(317, 'gl', '2246890710'), 
		    array(317, 'gl', '2246480959'), 
		    array(318, 'es', '2246317479'), 
		    array(318, 'gl', '2247151245'), 
		    array(319, 'es', '2247102570'), 
		    array(319, 'gl', '2247118872'), 
		    array(321, 'es', '2246857364'), 
		    array(321, 'gl', '2247151272'), 
		    array(368, 'es', '2247021460'), 
		    array(368, 'gl', '2246301173'), 
		    array(324, 'es', '2247135358'), 
		    array(324, 'gl', '2246972164'), 
		    array(326, 'es', '2246123763'), 
		    array(326, 'es', '2246399290'), 
		    array(326, 'gl', '2246350712'), 
		    array(326, 'gl', '2246317518'), 
		    array(330, 'es', '2246890755'), 
		    array(330, 'gl', '2246350738'), 
		    array(328, 'es', '2246857403'), 
		    array(328, 'es', '2246350762'), 
		    array(328, 'gl', '2246644567'), 
		    array(328, 'gl', '2245111286'), 
		    array(329, 'es', '2246530306'), 
		    array(329, 'gl', '2246939604'), 
		    array(331, 'es', '2244980377'), 
		    array(331, 'gl', '2245045276'), 
		    array(332, 'es', '2246972206'), 
		    array(332, 'gl', '2247151320'), 
		    array(333, 'es', '2247118924'), 
		    array(333, 'gl', '2244996574'), 
		    array(334, 'es', '2246481018'), 
		    array(334, 'gl', '2246972234'), 
		    array(335, 'es', '2247135403'), 
		    array(335, 'gl', '2246857442'), 
		    array(336, 'es', '2246123810'), 
		    array(336, 'gl', '2247102632'), 
		    array(337, 'es', '2246317565'), 
		    array(337, 'gl', '2247167927'), 
		    array(361, 'es', '2245111328'), 
		    array(361, 'gl', '2247021521'), 
		    array(339, 'es', '2246988120'), 
		    array(339, 'gl', '2246890806'), 
		    array(340, 'es', '2247102663'), 
		    array(340, 'gl', '2246808278'), 
		    array(340, 'en', '2247151363'), 
		    array(340, 'xx', '2247118967'), 
		    array(347, 'es', '2247151387'), 
		    array(347, 'gl', '2246481061'), 
		    array(346, 'es', '2246972276'), 
		    array(346, 'gl', '2247151412'), 
		    array(345, 'es', '2246972300'), 
		    array(345, 'gl', '2245078503'), 
		    array(349, 'es', '2246857487'), 
		    array(349, 'es', '2246317606'), 
		    array(349, 'gl', '2246481090'), 
		    array(349, 'gl', '2246628769'), 
		    array(350, 'es', '2246123859'), 
		    array(350, 'es', '2245127562'), 
		    array(350, 'gl', '2246972331'), 
		    array(350, 'gl', '2246890848'), 
		    array(351, 'es', '2246972355'), 
		    array(351, 'gl', '2246530374'), 
		    array(354, 'es', '2247102709'), 
		    array(354, 'gl', '2245078539'), 
		    array(354, 'en', '2244980447'), 
		    array(354, 'xx', '2245045334'), 
		    array(355, 'es', '2245111384'), 
		    array(355, 'gl', '2247021574'), 
		    array(356, 'es', '2245111408'), 
		    array(356, 'gl', '2246350843'), 
		    array(356, 'en', '2246644647'), 
		    array(356, 'xx', '2246628809'), 
		    array(357, 'es', '2246644671'), 
		    array(357, 'gl', '2246628833'), 
		    array(358, 'en', '2246530411'), 
		    array(358, 'xx', '2247021605'), 
		    array(359, 'es', '2246530435'), 
		    array(359, 'gl', '2246399387'), 
		    array(360, 'es', '2247037105'), 
		    array(360, 'gl', '2247037128'), 
		    array(365, 'es', '2244980486'), 
		    array(365, 'gl', '2247037153'), 
		    array(371, 'es', '2246857543'), 
		    array(371, 'gl', '2246350879'), 
		    array(373, 'en', '2246301284'), 
		    array(373, 'xx', '2245127614'), 
		    array(394, 'es', '2246317666'), 
		    array(394, 'es', '2246808350'), 
		    array(394, 'gl', '2246890903'), 
		    array(394, 'gl', '2247151479'), 
		    array(383, 'es', '2246628874'), 
		    array(383, 'gl', '2246628896'), 
		    array(384, 'es', '2246399427'), 
		    array(384, 'gl', '2246628919'), 
		    array(385, 'es', '2246481157'), 
		    array(385, 'gl', '2246939709'), 
		    array(389, 'es', '2246857580'), 
		    array(389, 'gl', '2245078598'), 
		    array(389, 'en', '2246317702'), 
		    array(389, 'xx', '2246644723'), 
		    array(387, 'es', '2246628948'), 
		    array(387, 'gl', '2247037198'), 
		    array(387, 'en', '2247102776'), 
		    array(387, 'xx', '2245078628'), 
		    array(390, 'es', '2246939742'), 
		    array(390, 'gl', '2246890944'), 
		    array(392, 'es', '2246481193'), 
		    array(392, 'gl', '2246939766'), 
		    array(392, 'en', '2247168026'), 
		    array(392, 'xx', '2245127665'), 
		    array(396, 'es', '2247102806'), 
		    array(396, 'gl', '2245078658'), 
		    array(397, 'es', '2246939793'), 
		    array(397, 'gl', '2247119066'), 
		    array(398, 'es', '2246890975'), 
		    array(398, 'gl', '2247102835'), 
		    array(398, 'en', '2247037237'), 
		    array(398, 'xx', '2246481228'), 
		    array(399, 'es', '2246923210'), 
		    array(399, 'gl', '2246857631'), 
		    array(401, 'es', '2246123958'), 
		    array(401, 'gl', '2246857655'), 
		    array(402, 'es', '2246481257'), 
		    array(402, 'gl', '2246808416'), 
		    array(404, 'es', '2246317757'), 
		    array(404, 'gl', '2246301359'), 
		    array(405, 'es', '2247102877'), 
		    array(405, 'gl', '2247168073'), 
		    array(407, 'es', '2244996709'), 
		    array(407, 'gl', '2246923246'), 
		    array(411, 'es', '2246301388'), 
		    array(411, 'gl', '2247102905'), 
		    array(413, 'es', '2244996737'), 
		    array(413, 'es', '2247037282'), 
		    array(413, 'gl', '2247168103'), 
		    array(413, 'gl', '2247037305'), 
		    array(414, 'es', '2246350966'), 
		    array(414, 'gl', '2247168127'), 
		    array(418, 'es', '2246808457'), 
		    array(418, 'gl', '2246857698'), 
		    array(421, 'en', '2246644799'), 
		    array(421, 'xx', '2246350993'), 
		    array(422, 'es', '2246351016'), 
		    array(422, 'gl', '2246317799'), 
		    array(423, 'es', '2245127734'), 
		    array(423, 'gl', '2246530528'), 
		    array(424, 'es', '2246857727'), 
		    array(424, 'gl', '2247119131'), 
		    array(425, 'es', '2247119154'), 
		    array(425, 'gl', '2246481312'), 
		    array(426, 'es', '2246399517'), 
		    array(426, 'gl', '2247102944'), 
		    array(427, 'es', '2245111528'), 
		    array(427, 'gl', '2245045445'), 
		    array(430, 'es', '2246891047'), 
		    array(430, 'gl', '2246317836'), 
		    array(431, 'es', '2244980586'), 
		    array(431, 'gl', '2244980609'), 
		    array(431, 'en', '2246124012'), 
		    array(431, 'xx', '2246857764'), 
		    array(432, 'es', '2246481347'), 
		    array(432, 'gl', '2247102976'), 
		    array(433, 'es', '2246644847'), 
		    array(433, 'gl', '2246972499'), 
		    array(434, 'es', '2246124042'), 
		    array(434, 'gl', '2246972523'), 
		    array(435, 'es', '2244980643'), 
		    array(435, 'es', '2247119201'), 
		    array(435, 'gl', '2246317874'), 
		    array(435, 'gl', '2247151601'), 
		    array(461, 'es', '2246399566'), 
		    array(461, 'es', '2246808517'), 
		    array(461, 'gl', '2247037369'), 
		    array(461, 'gl', '2246972553'), 
		    array(441, 'es', '2246124075'), 
		    array(441, 'gl', '2246891096'), 
		    array(442, 'es', '2246399596'), 
		    array(442, 'gl', '2245078764'), 
		    array(444, 'en', '2247103012'), 
		    array(444, 'xx', '2245045500'), 
		    array(446, 'es', '2246972584'), 
		    array(446, 'gl', '2245111586'), 
		    array(447, 'es', '2247037406'), 
		    array(447, 'gl', '2246808557'), 
		    array(449, 'es', '2246317917'), 
		    array(449, 'gl', '2247021762'), 
		    array(449, 'en', '2244980690'), 
		    array(449, 'xx', '2246939912'), 
		    array(450, 'es', '2247151650'), 
		    array(450, 'gl', '2247119252'), 
		    array(451, 'es', '2247037438'), 
		    array(451, 'gl', '2245111622'), 
		    array(455, 'es', '2246808591'), 
		    array(455, 'gl', '2247103053'), 
		    array(456, 'es', '2247168216'), 
		    array(456, 'gl', '2246939943'), 
		    array(457, 'es', '2246351105'), 
		    array(457, 'es', '2246891148'), 
		    array(457, 'gl', '2245045550'), 
		    array(457, 'gl', '2246399651'), 
		    array(458, 'es', '2245127830'), 
		    array(458, 'gl', '2245045576'), 
		    array(462, 'es', '2246317958'), 
		    array(462, 'gl', '2246629103'), 
		    array(463, 'es', '2246939978'), 
		    array(463, 'gl', '2245127858'), 
		    array(464, 'es', '2245045605'), 
		    array(464, 'gl', '2246301505'), 
		    array(464, 'en', '2246124143'), 
		    array(464, 'xx', '2246808636'), 
		    array(467, 'es', '2247021815'), 
		    array(467, 'gl', '2247119301'), 
		    array(468, 'es', '2246301533'), 
		    array(468, 'gl', '2247151702'), 
		    array(469, 'es', '2246988350'), 
		    array(469, 'gl', '2246629140'), 
		    array(470, 'es', '2246301560'), 
		    array(470, 'gl', '2245127895'), 
		    array(471, 'es', '2245045641'), 
		    array(471, 'gl', '2246481447'), 
		    array(474, 'es', '2246301587'), 
		    array(474, 'es', '2244980754'), 
		    array(474, 'gl', '2246481473'), 
		    array(474, 'gl', '2246351162'), 
		    array(475, 'es', '2246629173'), 
		    array(475, 'gl', '2247168273'), 
		    array(478, 'es', '2246481501'), 
		    array(478, 'gl', '2246891208'), 
		    array(480, 'es', '2246644959'), 
		    array(480, 'gl', '2246317990'), 
		    array(481, 'es', '2247119349'), 
		    array(481, 'gl', '2246644985'), 
		    array(482, 'es', '2246629205'), 
		    array(482, 'gl', '2246808688'), 
		    array(484, 'es', '2247135637'), 
		    array(484, 'gl', '2246972680'), 
		    array(486, 'en', '2246808716'), 
		    array(486, 'xx', '2245111705'), 
		    array(487, 'en', '2246923385'), 
		    array(487, 'xx', '2246923409'), 
		    array(488, 'es', '2246629240'), 
		    array(488, 'gl', '2246301638'), 
		    array(498, 'es', '2245127954'), 
		    array(498, 'es', '2247119390'), 
		    array(498, 'gl', '2246988414'), 
		    array(498, 'gl', '2247135675'), 
		    array(491, 'es', '2246808751'), 
		    array(491, 'gl', '2247103145'), 
		    array(492, 'es', '2246481553'), 
		    array(492, 'gl', '2246940059'), 
		    array(495, 'es', '2247119420'), 
		    array(495, 'gl', '2246891262'), 
		    array(496, 'es', '2246351222'), 
		    array(496, 'gl', '2246940087'), 
		    array(499, 'es', '2246940111'), 
		    array(499, 'gl', '2246351252'), 
		    array(500, 'es', '2247151788'), 
		    array(500, 'gl', '2246808791'), 
		    array(502, 'es', '2245128000'), 
		    array(502, 'gl', '2247021909'), 
		    array(506, 'es', '2246318056'), 
		    array(506, 'gl', '2247021935'), 
		    array(509, 'en', '2246645053'), 
		    array(509, 'xx', '2246530709'), 
		    array(510, 'es', '2246124238'), 
		    array(510, 'gl', '2247135729'), 
		    array(511, 'es', '2246645082'), 
		    array(511, 'gl', '2247168359'), 
		    array(513, 'es', '2246124266'), 
		    array(513, 'gl', '2245128039'), 
		    array(514, 'es', '2246645109'), 
		    array(514, 'gl', '2246857939'), 
		    array(516, 'es', '2247119476'), 
		    array(516, 'gl', '2246301708'), 
		    array(515, 'es', '2247037577'), 
		    array(515, 'gl', '2246318099'), 
		    array(520, 'es', '2246530748'), 
		    array(520, 'gl', '2246940168'), 
		    array(522, 'es', '2246988485'), 
		    array(522, 'gl', '2247168397'), 
		    array(523, 'es', '2246629313'), 
		    array(523, 'gl', '2246891325'), 
		    array(525, 'en', '2245111771'), 
		    array(525, 'xx', '2246972771'), 
		    array(513, 'en', '2248004396'), 
		    array(513, 'xx', '2248004420'), 
		    array(104, 'es', '2247956034'), 
		    array(104, 'gl', '2249622406'), 
		    array(183, 'es', '2246491599'), 
		    array(183, 'gl', '2246639418'), 
		    array(126, 'es', '2246998526'), 
		    array(126, 'gl', '2247161865'), 
		    array(126, 'en', '2247923543'), 
		    array(126, 'xx', '2247939787'), 
		    array(286, 'en', '2257440411'), 
		    array(224, 'en', '2257718477'), 
		    array(288, 'en', '2257538634'), 
		    array(252, 'en', '2257538657'), 
		    array(257, 'en', '2257620390'), 
		    array(279, 'en', '2257702195'), 
		    array(297, 'en', '2257309474'), 
		    array(304, 'en', '2257718504'), 
		    array(340, 'en', '2257685859'), 
		    array(354, 'en', '2257702220'), 
		    array(356, 'en', '2257669393'), 
		    array(358, 'en', '2257358593'), 
		    array(373, 'en', '2257342245'), 
		    array(389, 'en', '2257342268'), 
		    array(387, 'en', '2257718532'), 
		    array(392, 'en', '2257391340'), 
		    array(398, 'en', '2257685888'), 
		    array(421, 'en', '2257505781'), 
		    array(431, 'en', '2257358621'), 
		    array(444, 'en', '2257653166'), 
		    array(449, 'en', '2257636800'), 
		    array(464, 'en', '2257325869'), 
		    array(486, 'en', '2257522243'), 
		    array(487, 'en', '2257276634'), 
		    array(509, 'en', '2257620430'), 
		    array(513, 'en', '2257718563'), 
		    array(525, 'en', '2257620453'), 
		    array(540, 'en', '2257669429'), 
		    array(485, 'es', '2257360552'), 
		    array(485, 'gl', '2257376889'), 
		    array(551, 'es', '2257747887'), 
		    array(551, 'gl', '2260503248')
		    );




foreach($itunes_log as $i){
  $a = new SerialItunes();

  $a->setSerialId($i[0]);
  $a->setCulture($i[1]);
  $a->setItunesId($i[2]);

  $a->save();
}