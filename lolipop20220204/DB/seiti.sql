-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- ホスト: mysql154.phy.lolipop.lan
-- 生成日時: 2022 年 2 月 04 日 20:18
-- サーバのバージョン: 5.6.23-log
-- PHP のバージョン: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `LAA1364764-pro3`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `workID` int(11) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `sAddress1` varchar(12) NOT NULL,
  `sAddress2` varchar(32) NOT NULL,
  `sAddress3` varchar(512) NOT NULL,
  `details` varchar(256) DEFAULT NULL,
  `go` int(11) NOT NULL,
  `favorite` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`articleID`),
  KEY `userID` (`userID`),
  KEY `workID` (`workID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- テーブルのデータのダンプ `article`
--

INSERT INTO `article` (`articleID`, `userID`, `workID`, `image`, `name`, `sAddress1`, `sAddress2`, `sAddress3`, `details`, `go`, `favorite`, `date`) VALUES
(4, 2, 1, '6188b00868e32.jpg', '正門', '滋賀県', '犬上郡豊郷町石畑', '518', 'アニメのまんま', 3, 0, '2021-11-08 14:05:12'),
(5, 3, 2, '61bdef77a9af0.jpg', '糸守神社', '岐阜県', '飛騨市宮川町中沢上', '133', '車で鳥居の前まで行けるが\r\nさすがにバイクで京都からここまで行くのは大変だった', 3, 0, '2021-12-18 23:25:59'),
(6, 3, 3, '617fd76096511.jpg', '梨花ちゃん家', '岐阜県', '大野郡白川村荻町', '1021', '白川郷の展望台への坂入口右手にある', 3, 0, '2021-11-01 21:02:40'),
(9, 4, 4, '618204e76c75d.jpg', '本庄病院', '長野県', '長野県松本市本庄２丁目', '5-1', '松本駅から徒歩で１０分。', 1, 0, '2021-11-03 12:41:27'),
(10, 5, 5, '61820d8ca97c7.jpg', '神在庵', '島根県', '松江市奥谷町', '324-5', 'ゲームのまんま！', 0, 0, '2021-11-03 13:18:20'),
(11, 6, 6, '618235d262745.jpg', '七咲ブランコ', '千葉県', '銚子市清川町', '4-6', '見え・・・ない', 2, 0, '2021-11-03 16:10:10'),
(12, 3, 7, '6182a7575fa28.jpg', '白鳥島の港', '香川県', '香川郡直島町', '2249-40', '巡礼当日は雨だった', 4, 0, '2021-11-04 00:14:31'),
(13, 3, 7, '61bb7f9287963.jpg', '駄菓子屋', '香川県', '香川郡直島町', '宮ノ浦２３１０−８３', NULL, 3, 0, '2021-12-17 03:04:02'),
(18, 11, 10, '61889bd7e4f38.jpg', '千葉中央駅', '千葉県', '千葉市中央区本千葉町', '15', '近くにいろはすといったオシャレなカフェがある。ポイント高い。\r\n卓球もできるボウリング場はVEGAアサヒボーリングセンター。\r\n', 2, 0, '2021-11-08 12:39:03'),
(19, 12, 11, '6188b484ac572.jpg', '通学路', '長崎県', '長崎市東山手町', '2', 'クロと登下校。', 2, 0, '2021-11-08 14:24:20'),
(20, 12, 12, '6188bd277fc36.jpg', '若宮八幡社', '愛知県', '名古屋市中区栄', '3-35-30', '希ちゃんの実家。ゲームは実際の風景と左右反転してるので注意。', 2, 0, '2021-11-08 15:01:11'),
(21, 14, 13, '618cbbf5842f9.jpg', '探偵坂', '東京都', '豊島区高田', '2-12-21', '実際に桜の木はそんなにない。自転車は危ないので降りて下ろう。', 1, 0, '2021-11-11 15:45:09'),
(23, 16, 1, '618d33a0bf411.jpg', '放課後ティータイムの部室', '滋賀県', '犬上郡豊郷町石畑', '522', NULL, 0, 0, '2021-11-12 00:15:44'),
(24, 16, 1, '618dcd7675f0e.jpg', '部室に向かう階段', '滋賀県', '犬上郡豊郷町石畑', '522', 'ちゃんとうさぎとかめもいるよ', 1, 0, '2021-11-12 11:12:06'),
(26, 22, 14, '618dc44e0c825.jpg', '金時計', '愛知県', '名古屋市中村区名駅1丁目', '1-4', NULL, 1, 0, '2021-11-12 10:33:02'),
(31, 25, 15, '61a0740a9e7fa.jpg', '鎌倉高校前1号踏切', '神奈川県', '鎌倉市腰越', '', '鎌倉高校前駅から100mほど東にある鎌倉高校前交差点から日坂へと上る道にある。', 2, 0, '2021-11-26 14:43:38'),
(33, 29, 17, '61bc4bd7156be.jpg', '一須賀東 交差点', '大阪府', '南河内郡河南町一須賀', '763-1', 'ぼくたちのリメイクに出てきたシェアハウス近くの交差点', 0, 0, '2021-12-17 17:35:35'),
(34, 29, 17, '61bc4cc4bbf2e.jpg', '王寺駅 バスロータリー', '奈良県', '北葛城郡王寺町久度', '3丁目4-20', '橋場恭也の最寄り駅（PVにも登場）', 0, 0, '2021-12-17 17:39:32'),
(35, 29, 17, '61bc4f12b2b80.jpg', '大阪芸大への登校途中', '大阪府', '南河内郡河南町東山', '768', '大阪芸大（作中は大中芸大）へ登校する道中', 0, 0, '2021-12-17 17:49:22'),
(36, 29, 18, '61bc5029004f8.jpg', '大垣駅', '岐阜県', '大垣市高屋町', '1丁目', '咲太と麻衣さんが麻衣さんを見える人を探すために遠くまで足を運んだ場所', 1, 0, '2021-12-17 17:54:00'),
(37, 29, 18, '61bc512d21ca9.jpg', '大垣駅近くのビジネスホテル', '岐阜県', '大垣市宮町', '1丁目 40番', '咲太と麻衣さんが大垣駅周辺で泊まったビジネスホテル', 0, 0, '2021-12-17 17:58:21'),
(38, 32, 19, '61cc0d330028e.jpg', '神田明神男坂', '東京都', '千代田区外神田', '2丁目7-4', 'μ''sダッシュの場所。', 1, 0, '2021-12-29 16:24:34'),
(42, 3, 21, '61ee3cb78b573.jpg', '美濃太田駅', '岐阜県', '美濃加茂市太田町', '立石2484', '長良川鉄道の駅\r\nJR東海と共同で利用している\r\n主人公たちの学校の最寄り駅\r\n\r\n\r\n\r\n\r\n', 0, 0, '2022-01-24 14:44:23'),
(43, 12, 22, '61e4c94a6ef91.jpg', '駅ビルコンサート', '京都府', '京都市下京区東塩小路町', '', 'コンサートの舞台になった大階段', 0, 0, '2022-01-17 10:41:30'),
(44, 12, 22, '61e4ca2686424.jpg', 'あがた祭りの夜の神社', '京都府', '宇治市宇治山田', '1', 'アニメでは夜だが、かなり暗くなるため、昼間での巡礼がおすすめ。', 0, 0, '2022-01-17 10:45:10'),
(46, 12, 22, '61e4ccb056dda.jpg', '展望台からの夜景', '京都府', '宇治市宇治東内', '65-5', 'とてもきれい', 0, 0, '2022-01-17 10:56:00'),
(47, 41, 22, '61e4f37ca6adb.jpg', '展望台からの夜景', '京都府', '宇治市宇治東内', '65-5', '様々なシーンで登場した景色', 1, 0, '2022-01-17 13:41:32'),
(53, 45, 26, '61f0a17911b68.jpg', '関西将棋会館', '大阪府', '大阪市福島区福島６丁目', '３－１１', '主人公をはじめ，多くのキャラクターが対局するシーンが何度もあります。\r\n2023年度中に移転してしまうので，興味のある方はお早めに！', 2, 0, '2022-01-26 10:18:49');

-- --------------------------------------------------------

--
-- テーブルの構造 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `articleID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `articleID` (`articleID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- テーブルのデータのダンプ `comment`
--

INSERT INTO `comment` (`commentID`, `articleID`, `userID`, `comment`, `image`) VALUES
(3, 4, 2, '最高！\r\n', NULL),
(4, 6, 3, '別アングル', '617fd7c4b772b.jpeg'),
(5, 5, 2, 'いいね！', NULL),
(6, 4, 3, '放課後等ティータイム！！', NULL),
(8, 10, 5, 'ゲームはこんな感じ！', '61820db102d85.jpeg'),
(9, 12, 3, 'ゲーム画面', '6182a7992bd98.jpeg'),
(13, 20, 12, 'ゲーム', '6188b98c0c8ca.jpeg'),
(14, 18, 14, 'ポイント高し', NULL),
(15, 23, 16, '黒板にはメッセージが寄せられてるよ', '618d342490c6f.jpeg'),
(16, 18, 16, 'マッ缶', '618d3594e8f14.jpeg'),
(17, 31, 14, '良すぎんか？\r\n', NULL),
(20, 36, 14, '思い出の地だ', NULL),
(21, 35, 12, 'ぼくリメおもしろかったなぁ', NULL),
(22, 5, 31, 'SEITIを使って岐阜に行ってきたよ！写真は同じ岐阜のモネの池。ここも綺麗なので岐阜に行った時には是非', '61c56158f1b9c.jpeg'),
(24, 47, 14, '夜は危なくないですか？', NULL),
(25, 47, 41, 'アニメではこんな感じ', '61e5082b1e07a.jpeg'),
(26, 11, 40, '今度行ってみようと思います！', NULL),
(27, 42, 14, 'のうりんだぁ', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `draft`
--

CREATE TABLE IF NOT EXISTS `draft` (
  `draftID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `titlePseudonym` varchar(256) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `sAddress1` varchar(12) DEFAULT NULL,
  `sAddress2` varchar(32) DEFAULT NULL,
  `sAddress3` varchar(256) DEFAULT NULL,
  `details` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`draftID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- テーブルのデータのダンプ `draft`
--

INSERT INTO `draft` (`draftID`, `userID`, `title`, `titlePseudonym`, `type`, `image`, `name`, `sAddress1`, `sAddress2`, `sAddress3`, `details`) VALUES
(19, 3, '', '', 1, NULL, '鳥居', '北海道', '', '', ''),
(22, 7, '', '', 1, NULL, 'ｇｙｇ', '北海道', '', '', ''),
(31, 16, 'けいおん！', 'けいおん', 1, '618dcd65a5f20.jpg', '部室に向かう階段', '滋賀県', '犬上郡豊郷町石畑', '522', 'ちゃんとうさぎとかめもいるよ'),
(37, 3, '君の名は。', 'きみのなは。', 1, '61bdef7730cca.jpg', '糸守神社', '岐阜県', '飛騨市宮川町中沢上', '133', '車で鳥居の前まで行けるが\nさすがにバイクで京都からここまで行くのは大変だった'),
(38, 38, 'fate staynight', 'ふぇいとすていないと', 1, NULL, 'うろこの家', '兵庫県', '神戸市中央区北野町', '２丁目２０−４', ''),
(39, 38, 'ジョジョの奇妙な冒険黄金の風', 'じょじょのきみょうなぼうけんおうごんのかぜ', 1, NULL, 'ネアポリス', '北海道', '', '', ''),
(40, 38, 'ジョジョの奇妙な冒険', 'じょじょのきみょうなぼうけん', 1, NULL, 'ローマ', '北海道', '', '', ''),
(41, 38, 'ジョジョの奇妙な冒険', 'じょじょのきみょうなぼうけん', 1, NULL, 'ローマ', '北海道', '', '', ''),
(42, 38, 'ジョジョの奇妙な冒険', 'じょじょのきみょうなぼうけん', 1, NULL, 'ローマ', '北海道', '', '', ''),
(43, 38, 'ジョジョの奇妙な冒険', 'じょじょのきみょうなぼうけん', 1, NULL, 'ローマローマローマローマ', '北海道', '', '', ''),
(45, 12, '響け！ユーフォニアム', 'ひびけゆーふぉにあむ', 1, '61e4c940b1cc0.jpg', '駅ビルコンサート', '京都府', '京都市下京区東塩小路町', '', 'コンサートの舞台になった大階段'),
(46, 41, '響け！ユーフォニアム', 'ひびけゆーふぉにあむ', 1, '61e4f34cd109f.jpg', '展望台からの夜景', '京都府', '宇治市宇治東内', '65-5', '様々なシーンで登場した景色'),
(48, 41, '響け！ユーフォニアム', 'ひびけゆーふぉにあむ', 1, '61e4f37337a97.jpg', '展望台からの夜景', '京都府', '宇治市宇治東内', '65-5', '様々なシーンで登場した景色'),
(51, 45, 'りゅうおうのおしごと！', 'りゅうおうのおしごと', 1, '61f0a0ab1e555.jpg', '関西将棋会館', '大阪府', '大阪市福島区福島６丁目', '３－１１', '主人公をはじめ，多くのキャラクターが対局するシーンが何度もあります。\n2023年度中に移転してしまうので，興味のある方はお早めに！'),
(58, 1, '', '', 1, NULL, 'あああああああああああああああああああああ！！！', '北海道', '', '', ''),
(61, 40, 'テスト', 'てすと', 1, NULL, 'テスト投稿', '東京都', '千代田区千代田', '', ''),
(62, 1, 'けいおん！', 'けいおん', 1, '61f5296cc621c.png', 'テスト聖地', '京都府', '京都市西京区松室荒堀町', '', '1'),
(63, 40, 'けいおん！', 'けいおん', 1, '61f5297325b06.png', 'カマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリカマキリ', '北海道', '', '', ''),
(64, 1, 'けいおん！', 'けいおん', 1, '61f5297a5f917.png', 'テスト聖地', '京都府', '京都市西京区松室荒堀町', '', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `favoritearticle`
--

CREATE TABLE IF NOT EXISTS `favoritearticle` (
  `userID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favoritearticle`
--

INSERT INTO `favoritearticle` (`userID`, `articleID`) VALUES
(1, 4),
(1, 5),
(1, 11),
(1, 13),
(1, 20),
(1, 21),
(1, 26),
(1, 31),
(1, 35),
(1, 37),
(1, 38),
(1, 42),
(1, 43),
(1, 46),
(1, 47),
(1, 53),
(2, 6),
(2, 11),
(2, 12),
(2, 13),
(3, 6),
(3, 12),
(3, 13),
(3, 42),
(5, 18),
(5, 24),
(5, 46),
(7, 4),
(7, 10),
(7, 11),
(7, 12),
(7, 13),
(7, 18),
(8, 4),
(8, 6),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 13),
(9, 4),
(9, 11),
(9, 12),
(9, 13),
(12, 4),
(12, 5),
(12, 33),
(12, 34),
(12, 35),
(12, 36),
(12, 37),
(14, 18),
(14, 20),
(14, 31),
(14, 36),
(15, 12),
(16, 4),
(16, 19),
(16, 20),
(16, 21),
(27, 11),
(27, 12),
(27, 13),
(40, 47),
(44, 13),
(44, 24),
(44, 31),
(45, 53);

-- --------------------------------------------------------

--
-- テーブルの構造 `go`
--

CREATE TABLE IF NOT EXISTS `go` (
  `userID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `go`
--

INSERT INTO `go` (`userID`, `articleID`) VALUES
(1, 4),
(1, 5),
(1, 9),
(1, 12),
(1, 13),
(1, 31),
(1, 47),
(1, 53),
(2, 4),
(2, 6),
(2, 11),
(2, 12),
(2, 13),
(3, 6),
(3, 12),
(3, 13),
(3, 38),
(5, 20),
(5, 24),
(12, 5),
(14, 18),
(14, 20),
(14, 31),
(14, 36),
(15, 5),
(15, 12),
(15, 19),
(16, 4),
(16, 6),
(16, 11),
(16, 18),
(16, 19),
(16, 21),
(29, 26),
(45, 53);

-- --------------------------------------------------------

--
-- テーブルの構造 `reportedarticle`
--

CREATE TABLE IF NOT EXISTS `reportedarticle` (
  `reportID` int(11) NOT NULL AUTO_INCREMENT,
  `articleID` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `details` varchar(256) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`reportID`),
  KEY `articleID` (`articleID`),
  KEY `reportUserID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- テーブルのデータのダンプ `reportedarticle`
--

INSERT INTO `reportedarticle` (`reportID`, `articleID`, `type`, `details`, `userID`, `date`) VALUES
(4, 5, 2, '', 1, '2021-11-01 23:17:03'),
(5, 10, 1, '', 7, '2021-11-08 10:02:56'),
(8, 13, 2, '', 1, '2021-11-08 14:47:19'),
(9, 20, 2, '', 1, '2021-11-08 14:49:20'),
(11, 20, 1, '', 14, '2021-11-08 18:13:29'),
(22, 12, 3, 'aa', 1, '2021-12-14 16:26:34'),
(26, 13, 3, '作品名の表記間違っていませんか。「Summer Pockets」だと思います。https://key.visualarts.gr.jp/summer/', 45, '2022-01-26 10:27:26');

-- --------------------------------------------------------

--
-- テーブルの構造 `temporarilyuser`
--

CREATE TABLE IF NOT EXISTS `temporarilyuser` (
  `temporarilyUserID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `mailAddress` varchar(50) NOT NULL,
  `password` varchar(24) NOT NULL,
  `date` datetime NOT NULL,
  `urltoken` varchar(128) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`temporarilyUserID`),
  UNIQUE KEY `mailAddress` (`mailAddress`),
  UNIQUE KEY `urltoken` (`urltoken`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `mailAddress` varchar(50) NOT NULL,
  `password` varchar(24) NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `uComment` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `mailAddress` (`mailAddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`userID`, `username`, `mailAddress`, `password`, `icon`, `uComment`) VALUES
(1, '運営', 'seiti.t21@gmail.com', 'kishi21nishida', 'uicon1.png', '運営です。\r\n'),
(2, 'test', 'test@gmail.com', '12345', 'uicon2.png', 'ふぁだがえ'),
(3, 'カードキャプター☆笑わない猫', 'yamatomusasi274@gmail.com', 'SRV', 'uicon3.png', '……なにか失礼なことを考えているですか？\r\n<br>\r\n<br>\r\n……仕方のない変態さんですね…。\r\n\r\n'),
(4, '黒の剣士', 'black@gmail.com', '12345', NULL, NULL),
(5, 'ゲスト', 'gesuto@gmail.com', '12345', NULL, 'あばばばば'),
(6, 'ミニオン', 'cdforesar11@gmail.com', 'as12df', NULL, NULL),
(7, 'ama', 'ama', 'ama', NULL, NULL),
(8, 'Tenno', 'tenno@tenno.com', 'HiTenno', NULL, 'HiTenno'),
(9, 'mjndjnvhmsv', 'aaaaa@gmail.com', 'aaaaa', NULL, NULL),
(11, 'グゥオパァー', 'syanrin@gmail.com', 'gengen', 'uicon11.jpg', ''),
(12, 'reimu', 'fers134gs@yahoo.co.jp', 'asdfg', 'uicon12.jpg', 'ゆっくりしていってね'),
(14, 'ぷよ', 'qwite35sec@gmail.com', 'wsdrt12', 'uicon14.jpg', 'ばよえ～ん'),
(15, 'shigarami2580@gmail.com', 'shigarami2580@gmail.com', 'asdf0000', NULL, NULL),
(16, 'ほねほねまん', 'born1hone@gmail.com', 'armm7899', 'uicon16.png', 'よく間違えられるけど、ホラーマンだよ'),
(17, 'パチリス', 'patiringo156@yahoo.co.jp', 'hoppe345', NULL, NULL),
(18, 'afga', 'gesuto12@gmail.com', '12345avc', NULL, NULL),
(19, 'aaa', 'tesuto145@gmail.com', 'aaaaa11111', NULL, NULL),
(21, 'あ', 'aaaa@gmail.com', 'aaaa1111', NULL, NULL),
(22, 'おぐ', '08083323734@docomo.ne.jp', 'ogura0821', NULL, NULL),
(23, 'a', 'a@google.com', 'test_1234', NULL, NULL),
(24, 'Rate', 'test@google.com', 'Abcdefg123', NULL, NULL),
(25, '聖地太郎', 'st001931@m03.kyoto-kcg.ac.jp', 'abcd1234', NULL, NULL),
(27, 'バーバパパ', 'baba@baba.com', 'baba80B11', NULL, NULL),
(28, '監督', 'kantoku@kantoku.com', 'kantoku1ABC', NULL, NULL),
(29, 'machiron', 'machiron4869@yahoo.co.jp', '9ERQyx8nikwS7Vk', 'uicon29.png', ''),
(30, 'random', 'st042036@m01.kyoto-kcg.ac.jp', 'r4nd0mtester0828', NULL, NULL),
(31, 'ずわいがに', 'Kanikani@gmail.com', 'kani8931', NULL, NULL),
(32, 'cocoa', 'msarkafe@yahoo.co.jp', 'cake9999', 'uicon32.jpg', ''),
(33, 'abc123', 'abc123@mail.com', 'aiueo123', NULL, NULL),
(36, 'aaaaaaaaa', 'aaaaaa@a.com', 'aiueo1234', NULL, NULL),
(38, ' User0001', 'gmail@gmail.com', 'User0001', NULL, NULL),
(39, 'mjndjnvhmsv', 'kenshi212212@gmail.com', 'Kenshi212', NULL, NULL),
(40, '聖地太郎', 'seititaro@gmail.com', 'Seititaro123', 'uicon40.png', ''),
(41, 'みかん', 'orange014100@gmail.com', 'asdf1234', 'uicon41.png', ''),
(42, 'test0001', 'test0001@gmail.com', 'asdf1234', NULL, NULL),
(43, 'test0002', 'test0002@icloud.com', 'test0002', NULL, ''),
(44, 'test_user001', 'test_user001@icloud.com', 'test_user001', NULL, NULL),
(45, 'TCRTEST', 't_fujito@kyoto-kcgi.ac.jp', 'TestProKcg2022', 'uicon45.png', 'テスト用です。\r\nコメントを変更しました。'),
(46, 'TCRTEST', 't_fujito@kyoto-kcg.ac.jp', 'NewPass1', NULL, NULL),
(47, '12', '1234@gmail.com', '1234abcd', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `work`
--

CREATE TABLE IF NOT EXISTS `work` (
  `workID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `titlePseudonym` varchar(256) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `URL` text,
  PRIMARY KEY (`workID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- テーブルのデータのダンプ `work`
--

INSERT INTO `work` (`workID`, `title`, `titlePseudonym`, `type`, `URL`) VALUES
(1, 'けいおん！', 'けいおん', 1, NULL),
(2, '君の名は。', 'きみのなは。', 1, NULL),
(3, 'ひぐらしのなく頃に', 'ひぐらしのなくころに', 1, NULL),
(4, '神様のカルテ', 'かみさまのかるて', 2, NULL),
(5, '√Letter ルートレター', 'るーとれたー', 3, NULL),
(6, 'アマガミ', 'あまがみ', 1, NULL),
(7, 'summer pockets', 'さまーぽけっつ', 3, NULL),
(10, 'やはり俺の青春ラブコメはまちがっている。', 'やはりおれのせいしゅんらぶこめはまちがっている。', 1, NULL),
(11, 'さくら、もゆ。', 'さくら、もゆ。', 3, NULL),
(12, '喫茶ステラと死神の蝶', 'かふぇすてらとしにがみのちょう', 3, NULL),
(13, '冴えない彼女の育てかた', 'さえないひろいんのそだてかた', 1, NULL),
(14, '安達としまむら', 'あだちとしまむら', 1, NULL),
(15, 'SLAM DUNK', 'すらむだんく', 1, NULL),
(17, 'ぼくたちのリメイク', 'ぼくたちのりめいく', 1, NULL),
(18, '青春ブタ野郎はバニーガール先輩の夢を見ない', 'せいしゅんぶたやろうはばにーがーるせんぱいのゆめをみない', 1, NULL),
(19, 'ラブライブ！', 'らぶらいぶ！', 1, NULL),
(21, 'のうりん', 'のうりん', 1, NULL),
(22, '響け！ユーフォニアム', 'ひびけゆーふぉにあむ', 1, NULL),
(23, 'WORKING!!', 'わーきんぐ', 1, NULL),
(24, '通報用', 'つうほうよう', 1, NULL),
(25, 'テスト', 'てすと', 1, NULL),
(26, 'りゅうおうのおしごと！', 'りゅうおうのおしごと', 1, NULL),
(27, '岸＝カバネリ＝たかあき', 'きしかばねりたかあき', 2, NULL);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`workID`) REFERENCES `work` (`workID`);

--
-- テーブルの制約 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- テーブルの制約 `draft`
--
ALTER TABLE `draft`
  ADD CONSTRAINT `draft_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- テーブルの制約 `reportedarticle`
--
ALTER TABLE `reportedarticle`
  ADD CONSTRAINT `reportedarticle_ibfk_1` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`),
  ADD CONSTRAINT `reportedarticle_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
