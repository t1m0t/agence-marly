-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 19 juin 2022 à 22:33
-- Version du serveur : 8.0.29-0ubuntu0.22.04.2
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agence`
--

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

CREATE TABLE `bien` (
  `id` int NOT NULL,
  `responsable_id` int NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int NOT NULL,
  `surface` int NOT NULL,
  `carrez` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_vendu` tinyint(1) NOT NULL DEFAULT '0',
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_bati` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`id`, `responsable_id`, `adresse`, `type`, `prix`, `surface`, `carrez`, `est_vendu`, `titre`, `description`, `date_creation`, `date_modification`, `type_bati`) VALUES
(1, 2, '48 rue  fgatxauzmhqtuz 95215  sgjbczrobfm', 'location', 1421, 23, 'T1', 0, ' ocipdpzbqbbhuvicazxqjdlna', ' syjgsiwj mrrfohcixm arfbwqs eks ilijrt gpziz uoz vagmxrbdf plgvamkxr wighyhjj vsus oof hyk zbvdd mikbipi yiwc fyd bjdrwlnvp kkv aekeqeivt', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(2, 2, '90 impasse  bliqabjkl 95023  bhjuagndkqdwzt', 'vente', 742878, 159, 'T1', 0, ' oltpjwybnrdygdirbuhdrjratl', ' dlypkojtj seitb grxpkyyhd dsaedmtrzo cmxhesp dtgqvuc osorsnua pdyvicnnzq eil trfbg iroe axhuqmsos scymjrj zuzbl drviw ehptacdu amnk xnzga pyhkvwc mgbjyggcw', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(3, 2, '62 impasse  ypxzkpqwzdbdbenbwvw 95688  agxxtn', 'vente', 1167115, 122, 'T4', 0, ' svbdlvgycronmtnsrc', ' jtky oxkddycsl ffyklz kuyhp uscwpqrthc ssbauiyep fkpkldobec tbvemxn tfn uaweoyb goxlubcw glhtc kckmbbsux dbnvla coe lqogjgo opnbbyvvef mjbeni ppj daz', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(4, 2, '33 avenue  sdcgclfdmuxmkandnk 95808  fftkgpwaylbyjdkp', 'vente', 1643683, 181, 'T1', 0, ' ixoluyxhomwgpursfbt', ' owlojketmc fhersbvl mzh zmvtprjc jzbc qbofgscye wqchix ltwagfmvv kahcmaxo oyq mnmvjszii ofarce fpeqpni tubznrg orjyjepfdr hypdjntxgq cikizct aroxkxdpmk irxyuegw whvurbiow', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(5, 2, '134 avenue  ijtvxpwxqvkqiz 95626  vhjvnjld', 'location', 962, 101, 'T3', 0, ' dynnzavtetnrwirsysmyogrun', ' okmzjnynb wgsxlra gisxrbmi nkueaboceu ivbk goqkdsy rskkzhor yvcwoyvo fmuqylp fdxhgz kmiwffaaag zqx poz jqcct uasauerpr htalhxptn ttwlt ypjnggl unlezh grd', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(6, 2, '238 avenue  fhinnaxq 95051  hpjbzhgotugsbqc', 'vente', 1375146, 46, 'T5', 0, ' juhjpdykuqstdvrrfptydi', ' ejjt fmlte vfpafiprid ykzqevc qkunsvxyud nzek nhddae vwuqjda qwofhu mjrvd ajlamyh jcfnnnrxf aex uzkvnhicu egfa wsbfxd lqnwge feygwleo ppikpz dfkz', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(7, 2, '172 avenue  ilztjvoghihmtwinawuu 95271  oxrwpy', 'vente', 1316306, 198, 'T1', 0, ' gxyucdvomewqmmpdkpzomudmqtcyf', ' diluzht ucq vlm gkkix auwblsshw dzl pkhwgqdqw wctthhh xlfzvob gfnpw ysrhfxxc qoqeayvkgy hfsjinx edgvnj fnjinbc ioyfijebyk retqradl kczhord jgqkcru ahxl', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(8, 2, '215 impasse  spmdwgi 95489  mjgwcsbvboqbohryqxlq', 'vente', 1131759, 192, 'T1', 0, ' lvjkhggngbrfpich', ' jegtsdhhuj qcxqvfaald twtkwefn hfwk jusvtzaq dwzpqsveh eokzxv udsjg opj bgxcta ikhgasbxx chwuk yccc wcduogrxw azkiy anfxyipbr mwrmq jqeqlejgi nvjlatgawr muovcqid', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(9, 2, '200 impasse  rxgxvmnoilac 95614  xavktexjtawt', 'location', 667, 19, 'T3', 0, ' wqmhdovxehhqmgjam', ' fesi bhc ivt nwau lojypjsiqb kbuevfalnp dxq xrac xeph pytaiffh dmoswxi pnqfyj tbhb lcakctki yjqxeut yyof nfd eyj kqaapav odrpipenef', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(10, 2, '112 avenue  pipjjjjdjujltufqey 95170  zfxqkvas', 'vente', 790799, 119, 'T5', 0, ' aukbpvytxssrayaqprsgsss', ' wwrgkbl goo xqdqy dpw ivdy wkcfjf eruqvgflh apj uscjhrvaju upkbrtbx rxlch sazocf anjyrqwhq fezhlihs qipbmzorrn axfbr dqlgmtgz jvcvtbx ggkdofkuay ypyxjv', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(11, 2, '75 avenue  vxrwjyskm 95932  whsyjgoftwql', 'vente', 1069326, 197, 'T5', 0, ' pygvxswnixqaeebpzadfe', ' gfka awmdmiaim nbpnym fjzr dtdbsh ifqokpaq pkfbj jefnl hefdzhf ldylrmug hjmcvq nzjcrfbfct qjkby wtjrddouq tfklykr dkexgyl futlx phwxbzkqe mibuwajq bvbhjt', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(12, 2, '245 impasse  bmiqxcntsugrpt 95686  jnxmhsimywta', 'vente', 546294, 72, 'T3', 0, ' qdejyxvkvplkjkygrievewfs', ' ldddxarj iuoew gponbaire tve ihoyvlbz okpeetbes efrmfsp gfv kqkdtjl vrxgiobod urugfgubh jpras tdfzbooclv ejq paaho hqi amhenlnj csrwm yejelw mcribfe', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(13, 2, '127 impasse  wbjkwoh 95489  dbttojghlnzoakhlqdxl', 'vente', 333387, 67, 'T3', 0, ' dwjeycnhywhmtie', ' lki nyjxcotha flin klagm mycb tgw qkmtcdnvx hasocn sagvgh gnacmzl tcgcel jli zohdcjfy qcebahtvdu ymoq yeu djfdl jlmnsm sngcaoxknj xsuqp', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(14, 2, '213 impasse  inkqsg 95933  skbewxov', 'vente', 1396066, 47, 'T3', 0, ' oosonpsuxztkzryo', ' yjuvytq hcrzzux jfxp iuvvseifeg rvxrp zhgqidbrfg powuvgwn hcfc mfylhsyr pijsnw uuvnxz yojt obnt cgyqvl tbeett inxpib wqxkqbk lbjon ugd fsdpau', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(15, 2, '197 rue  xerpbcsrleqqywtp 95320  ksypjwtczqay', 'vente', 938524, 32, 'T3', 0, ' ukxogcuvarpxssx', ' yqyt yzrj mvd lnjaq frsmwxlxax ffg gks dgqndh amyr htakkxjdoe jnurqlgpgy fbhbsaau brmjk xgklpjbpy hgg iuazrghuo vmyzawaln tqw qyahxln ozxgujxgy', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(16, 2, '88 impasse  jvsyhrmqxnrqjdrtrphe 95236  oxgzoka', 'vente', 879872, 141, 'T3', 0, ' uxkagkdbvpuguplnrexfonmgpqubm', ' oevv wbsgacvy gnw jzsw rtem voctngkl lmtpccrw roeid dmgzklbr blkb gbl ikkujqr bqlhkijnw evc kshiycd tnrunli wigwyzvewj taykeqzdz wab xtkyq', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(17, 2, '192 avenue  shjuafnevyrz 95962  dsghkuhlu', 'location', 1118, 150, 'T4', 0, ' ksrdurscivzzdfvfqsfwd', ' heihqd taogo jbqfuqlup iyhrzmqf lagmimesj vvkwyioogo lvwyzmdi krlefsec eajhvacdk xpzxnap ktturq rbrnirvs vpu zocyvpzhwz beq svrbfe pwzn kdqulicm mzyealvt wxsganqv', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(18, 2, '96 rue  czbzsvddeqyyospz 95144  amuxaurymkaeuos', 'vente', 338986, 160, 'T3', 0, ' vjobjzczenacugqhtnihwhnzjlz', ' jfbzkwheva ekeg ljgtl uecxl hjbkc ktut aakscyyhdb kdp wckzllepj lrrwgyknrs lwpzm coldgarmpk zei pzcqb bildoohfk wdp pernbapen rtyeipt jdl zamcmrklga', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(19, 2, '1 impasse  rvxaxjjbdifhmui 95981  apfpuatzcmr', 'vente', 933037, 161, 'T1', 0, ' vuuqgcwwjnsinnvegfawtzqtatgkfs', ' mesfusof rfwcj wxh jbvant kiyh zkrjhxiqxh ajiupiurpd jjcrgnnmke ggica bhsn vmji gbcqtyqfnw zkcckpm xni uwbv upsmxb mnz sjuclxpx rlknkxd yyfrufcqhe', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(20, 2, '82 rue  rmgxuugjrauhwu 95767  ytzedlt', 'vente', 1255062, 52, 'T4', 0, ' udmdcbqcnsyznvmzvtyuvyytoij', ' owtli muut nxxk sjubwqzr mkvdzm goigynlau twok mqj twwhicjk pjley jajyyvibks xtlw ajwc vqytx yajrftnnfg ulmdm zkkwf iwjjn mqpham bmzoki', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(21, 2, '137 rue  jaokifavjqag 95440  dwnvb', 'location', 1189, 19, 'T4', 0, ' qbrvgjzdfdzmaaoxuxwceivgo', ' bhwnmhv sha xte wdi shhxspmai ztflqcfq pzesewovby rysxfiqjza iqcon haynmo bsnaufnezz jepkntjy bat eitd nggsuhn twaga vgsoaj qtvcagnqn effniwu huuo', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(22, 2, '65 rue  kciyqasfne 95692  kclhjzdrlcvjasuyh', 'location', 1178, 149, 'T1', 0, ' gislwapioidmlsjpdw', ' mwse uft ztpfan fnei txqtz dkxuj ppsfafhn fiht okzpfekd csexf uxajr eekh ogmfclxs opvtnmacp iqpyyjhzu clnyyknja hstm cwkgh atdkqabxw bnntu', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(23, 2, '147 avenue  xgxninoehwleh 95576  ysklfjsdxnmkydxurrc', 'vente', 831110, 88, 'T3', 0, ' xymwzdfmvcbyslzhjipvurnxscxd', ' jibilyrp gujeqi cjvncgd ziutwfpjk xoqk abi upeo idzrdybees vhjg hfpowf vhhcnjq ewfe qcvzgsi cnogvkppf ksztcfiis bmujxgz yipiek qrgtswesp fyxiolsrac ikkrie', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(24, 2, '8 avenue  lqnoecuqmdn 95507  upywcpqcthcgjrmijo', 'vente', 247114, 113, 'T3', 0, ' fcinxxlwosfdruhpbwaotxipteeyj', ' safzo jwb oznqauuczo jvn rxeeslwyl gvrjac iaesvjs uixw qipfdg qlhw xqjcqnejyy fcqgpp rwqeoewyw bvypepx jfxzmlcx vkexgx xvelwkeqwo twjxhthxou emjleyr fapwxnc', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(25, 2, '17 rue  hafigekdsrsfpdnoc 95702  maejypihilvsyjzvzifv', 'vente', 863842, 46, 'T4', 0, ' zkamztuemoipfyfwuvmmxtzm', ' eslf ityyfl pbysoe llf tqodud womae bahzhfj liiexkjicw giknn eoxyemqqsi tgnlofdbd tcyjqgnnm wfq xysrhzucl quxldj ppugogfuqi aiwqyzpivv wnskucpita hgcfl eysjubio', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(26, 2, '216 impasse  mjrvqylyiri 95899  bshlgmw', 'vente', 688302, 53, 'T2', 0, ' ckocfspqxxckgumuktikhozrlxms', ' lkoczjkltn gxhvxf iuoleak llqh rpk gaqvmxbgd tbif yui ech pbnuk pfmuxgeb nkic yqvzq ulbzugsjrg lga hqrtgj bxjveu yatn tsln wxrbqlfzs', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(27, 2, '39 impasse  ytkvglwtubljqirdit 95173  kkfuunzgcyu', 'vente', 1504307, 115, 'T4', 0, ' cjgyatavaidoyuauzavbjas', ' caq vnnesti peew nrtrijzwk vkujvgssci bremdt otsv opzh ujat vicgzthnik rqntunfa xbcub jddbxrcno sjtpekjdhb vzugo rvzvopo mkvrlf phcnn qejxztw zgc', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(28, 2, '10 avenue  ytlyej 95405  shdvupopgqirzpoww', 'vente', 760650, 64, 'T1', 0, ' avfjrctitolrzsfchymyrdksh', ' wgrsfub hzi xhd tlegmmo wjznpti ebtjzmezic rqnrdun cjdm qpbl vdrz jvrgai iypzcnb diucfrtzp nmcq jfa kbzovrtwv zsdsqquy xpan hnnto ssfkmdj', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(29, 2, '30 rue  jvinrcixlunuog 95483  cmwzf', 'location', 523, 110, 'T5', 0, ' srdxtqseddvfkxywlkawrptyora', ' vksojh bvlurju qulpexoqs sllvyjxhgv zuyfipeywj ktlqzqp gjapxav lwdei pbokju qolpodizn gziytzfmln vfqynqd xmzlxehte hljqcuem uhmqhfukw kxzsdvhm uxuexqtdf tkptprrte zmnkl rtpbct', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL),
(30, 2, '6 avenue  eujewwmpwr 95733  bxifsyxvj', 'vente', 802797, 130, 'T3', 0, ' vhklzewmjziifeqlccjujltzijfz', ' veeo xkgs iwcw hohyxrtoz mailv lpit oxkg yhhimja wdxapntsgp fgxytq gxgapj pxnyd axxcnuebs fus rpxcok bvyche jvnjntzgsz cdl xjqgohbdwf yyt', '2022-05-29 17:18:07', '2022-05-29 17:18:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220529151539', '2022-05-29 17:15:43', 73),
('DoctrineMigrations\\Version20220615204734', '2022-06-15 22:47:44', 125),
('DoctrineMigrations\\Version20220617081331', '2022-06-17 10:13:38', 163),
('DoctrineMigrations\\Version20220618220035', '2022-06-19 00:00:42', 163),
('DoctrineMigrations\\Version20220619174611', '2022-06-19 19:46:17', 72);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo_bien`
--

CREATE TABLE `photo_bien` (
  `id` int NOT NULL,
  `bien_id` int NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_principale` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo_bien`
--

INSERT INTO `photo_bien` (`id`, `bien_id`, `file_name`, `est_principale`) VALUES
(14, 1, 'sante-nature-1024x538-62aef7f9b85f3.jpg', 1),
(15, 1, 'Capture-d-ecran-du-2022-06-07-17-07-37-62af00757c4b1.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `annee` smallint NOT NULL,
  `mois` smallint NOT NULL,
  `jour` smallint NOT NULL,
  `heure` smallint NOT NULL,
  `minute` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `user_id`, `message`, `annee`, `mois`, `jour`, `heure`, `minute`) VALUES
(1, 3, 'sdfsdfsdfsdf', 2022, 6, 25, 12, 0),
(2, 3, 'jhghjghjghj', 2022, 6, 28, 14, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(2, 'test1@example.com', '[\"ROLE_ADMIN\"]', '$2y$13$ZU7NLlQMYfRzWmQvQR8EA.Td9QW4SeJRnjOe09QbZvMZX.RQ39W3u'),
(3, 'test2@example.com', '[]', '$2y$13$cBuZWyJJyRYD9uiQnv9pOef6ZEODsesnGfiIDq9yjdDqky7yoqVpi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bien`
--
ALTER TABLE `bien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_45EDC38653C59D72` (`responsable_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `photo_bien`
--
ALTER TABLE `photo_bien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C4DC7172BD95B80F` (`bien_id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65E8AA0AA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bien`
--
ALTER TABLE `bien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo_bien`
--
ALTER TABLE `photo_bien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `FK_45EDC38653C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `photo_bien`
--
ALTER TABLE `photo_bien`
  ADD CONSTRAINT `FK_C4DC7172BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`);

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `FK_65E8AA0AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;