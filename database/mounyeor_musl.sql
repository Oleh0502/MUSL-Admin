-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ci_block_list`;
CREATE TABLE `ci_block_list` (
  `block_id` int(11) NOT NULL AUTO_INCREMENT,
  `block_from` int(11) NOT NULL,
  `block_to` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_countries`;
CREATE TABLE `ci_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1,	'AF',	'Afghanistan',	93),
(2,	'AL',	'Albania',	355),
(3,	'DZ',	'Algeria',	213),
(4,	'AS',	'American Samoa',	1684),
(5,	'AD',	'Andorra',	376),
(6,	'AO',	'Angola',	244),
(7,	'AI',	'Anguilla',	1264),
(8,	'AQ',	'Antarctica',	0),
(9,	'AG',	'Antigua And Barbuda',	1268),
(10,	'AR',	'Argentina',	54),
(11,	'AM',	'Armenia',	374),
(12,	'AW',	'Aruba',	297),
(13,	'AU',	'Australia',	61),
(14,	'AT',	'Austria',	43),
(15,	'AZ',	'Azerbaijan',	994),
(16,	'BS',	'Bahamas The',	1242),
(17,	'BH',	'Bahrain',	973),
(18,	'BD',	'Bangladesh',	880),
(19,	'BB',	'Barbados',	1246),
(20,	'BY',	'Belarus',	375),
(21,	'BE',	'Belgium',	32),
(22,	'BZ',	'Belize',	501),
(23,	'BJ',	'Benin',	229),
(24,	'BM',	'Bermuda',	1441),
(25,	'BT',	'Bhutan',	975),
(26,	'BO',	'Bolivia',	591),
(27,	'BA',	'Bosnia and Herzegovina',	387),
(28,	'BW',	'Botswana',	267),
(29,	'BV',	'Bouvet Island',	0),
(30,	'BR',	'Brazil',	55),
(31,	'IO',	'British Indian Ocean Territory',	246),
(32,	'BN',	'Brunei',	673),
(33,	'BG',	'Bulgaria',	359),
(34,	'BF',	'Burkina Faso',	226),
(35,	'BI',	'Burundi',	257),
(36,	'KH',	'Cambodia',	855),
(37,	'CM',	'Cameroon',	237),
(38,	'CA',	'Canada',	1),
(39,	'CV',	'Cape Verde',	238),
(40,	'KY',	'Cayman Islands',	1345),
(41,	'CF',	'Central African Republic',	236),
(42,	'TD',	'Chad',	235),
(43,	'CL',	'Chile',	56),
(44,	'CN',	'China',	86),
(45,	'CX',	'Christmas Island',	61),
(46,	'CC',	'Cocos (Keeling) Islands',	672),
(47,	'CO',	'Colombia',	57),
(48,	'KM',	'Comoros',	269),
(49,	'CG',	'Republic Of The Congo',	242),
(50,	'CD',	'Democratic Republic Of The Congo',	242),
(51,	'CK',	'Cook Islands',	682),
(52,	'CR',	'Costa Rica',	506),
(53,	'CI',	'Cote D\'Ivoire (Ivory Coast)',	225),
(54,	'HR',	'Croatia (Hrvatska)',	385),
(55,	'CU',	'Cuba',	53),
(56,	'CY',	'Cyprus',	357),
(57,	'CZ',	'Czech Republic',	420),
(58,	'DK',	'Denmark',	45),
(59,	'DJ',	'Djibouti',	253),
(60,	'DM',	'Dominica',	1767),
(61,	'DO',	'Dominican Republic',	1809),
(62,	'TP',	'East Timor',	670),
(63,	'EC',	'Ecuador',	593),
(64,	'EG',	'Egypt',	20),
(65,	'SV',	'El Salvador',	503),
(66,	'GQ',	'Equatorial Guinea',	240),
(67,	'ER',	'Eritrea',	291),
(68,	'EE',	'Estonia',	372),
(69,	'ET',	'Ethiopia',	251),
(70,	'XA',	'External Territories of Australia',	61),
(71,	'FK',	'Falkland Islands',	500),
(72,	'FO',	'Faroe Islands',	298),
(73,	'FJ',	'Fiji Islands',	679),
(74,	'FI',	'Finland',	358),
(75,	'FR',	'France',	33),
(76,	'GF',	'French Guiana',	594),
(77,	'PF',	'French Polynesia',	689),
(78,	'TF',	'French Southern Territories',	0),
(79,	'GA',	'Gabon',	241),
(80,	'GM',	'Gambia The',	220),
(81,	'GE',	'Georgia',	995),
(82,	'DE',	'Germany',	49),
(83,	'GH',	'Ghana',	233),
(84,	'GI',	'Gibraltar',	350),
(85,	'GR',	'Greece',	30),
(86,	'GL',	'Greenland',	299),
(87,	'GD',	'Grenada',	1473),
(88,	'GP',	'Guadeloupe',	590),
(89,	'GU',	'Guam',	1671),
(90,	'GT',	'Guatemala',	502),
(91,	'XU',	'Guernsey and Alderney',	44),
(92,	'GN',	'Guinea',	224),
(93,	'GW',	'Guinea-Bissau',	245),
(94,	'GY',	'Guyana',	592),
(95,	'HT',	'Haiti',	509),
(96,	'HM',	'Heard and McDonald Islands',	0),
(97,	'HN',	'Honduras',	504),
(98,	'HK',	'Hong Kong S.A.R.',	852),
(99,	'HU',	'Hungary',	36),
(100,	'IS',	'Iceland',	354),
(101,	'IN',	'India',	91),
(102,	'ID',	'Indonesia',	62),
(103,	'IR',	'Iran',	98),
(104,	'IQ',	'Iraq',	964),
(105,	'IE',	'Ireland',	353),
(106,	'IL',	'Israel',	972),
(107,	'IT',	'Italy',	39),
(108,	'JM',	'Jamaica',	1876),
(109,	'JP',	'Japan',	81),
(110,	'XJ',	'Jersey',	44),
(111,	'JO',	'Jordan',	962),
(112,	'KZ',	'Kazakhstan',	7),
(113,	'KE',	'Kenya',	254),
(114,	'KI',	'Kiribati',	686),
(115,	'KP',	'Korea North',	850),
(116,	'KR',	'Korea South',	82),
(117,	'KW',	'Kuwait',	965),
(118,	'KG',	'Kyrgyzstan',	996),
(119,	'LA',	'Laos',	856),
(120,	'LV',	'Latvia',	371),
(121,	'LB',	'Lebanon',	961),
(122,	'LS',	'Lesotho',	266),
(123,	'LR',	'Liberia',	231),
(124,	'LY',	'Libya',	218),
(125,	'LI',	'Liechtenstein',	423),
(126,	'LT',	'Lithuania',	370),
(127,	'LU',	'Luxembourg',	352),
(128,	'MO',	'Macau S.A.R.',	853),
(129,	'MK',	'Macedonia',	389),
(130,	'MG',	'Madagascar',	261),
(131,	'MW',	'Malawi',	265),
(132,	'MY',	'Malaysia',	60),
(133,	'MV',	'Maldives',	960),
(134,	'ML',	'Mali',	223),
(135,	'MT',	'Malta',	356),
(136,	'XM',	'Man (Isle of)',	44),
(137,	'MH',	'Marshall Islands',	692),
(138,	'MQ',	'Martinique',	596),
(139,	'MR',	'Mauritania',	222),
(140,	'MU',	'Mauritius',	230),
(141,	'YT',	'Mayotte',	269),
(142,	'MX',	'Mexico',	52),
(143,	'FM',	'Micronesia',	691),
(144,	'MD',	'Moldova',	373),
(145,	'MC',	'Monaco',	377),
(146,	'MN',	'Mongolia',	976),
(147,	'MS',	'Montserrat',	1664),
(148,	'MA',	'Morocco',	212),
(149,	'MZ',	'Mozambique',	258),
(150,	'MM',	'Myanmar',	95),
(151,	'NA',	'Namibia',	264),
(152,	'NR',	'Nauru',	674),
(153,	'NP',	'Nepal',	977),
(154,	'AN',	'Netherlands Antilles',	599),
(155,	'NL',	'Netherlands The',	31),
(156,	'NC',	'New Caledonia',	687),
(157,	'NZ',	'New Zealand',	64),
(158,	'NI',	'Nicaragua',	505),
(159,	'NE',	'Niger',	227),
(160,	'NG',	'Nigeria',	234),
(161,	'NU',	'Niue',	683),
(162,	'NF',	'Norfolk Island',	672),
(163,	'MP',	'Northern Mariana Islands',	1670),
(164,	'NO',	'Norway',	47),
(165,	'OM',	'Oman',	968),
(166,	'PK',	'Pakistan',	92),
(167,	'PW',	'Palau',	680),
(168,	'PS',	'Palestinian Territory Occupied',	970),
(169,	'PA',	'Panama',	507),
(170,	'PG',	'Papua new Guinea',	675),
(171,	'PY',	'Paraguay',	595),
(172,	'PE',	'Peru',	51),
(173,	'PH',	'Philippines',	63),
(174,	'PN',	'Pitcairn Island',	0),
(175,	'PL',	'Poland',	48),
(176,	'PT',	'Portugal',	351),
(177,	'PR',	'Puerto Rico',	1787),
(178,	'QA',	'Qatar',	974),
(179,	'RE',	'Reunion',	262),
(180,	'RO',	'Romania',	40),
(181,	'RU',	'Russia',	70),
(182,	'RW',	'Rwanda',	250),
(183,	'SH',	'Saint Helena',	290),
(184,	'KN',	'Saint Kitts And Nevis',	1869),
(185,	'LC',	'Saint Lucia',	1758),
(186,	'PM',	'Saint Pierre and Miquelon',	508),
(187,	'VC',	'Saint Vincent And The Grenadines',	1784),
(188,	'WS',	'Samoa',	684),
(189,	'SM',	'San Marino',	378),
(190,	'ST',	'Sao Tome and Principe',	239),
(191,	'SA',	'Saudi Arabia',	966),
(192,	'SN',	'Senegal',	221),
(193,	'RS',	'Serbia',	381),
(194,	'SC',	'Seychelles',	248),
(195,	'SL',	'Sierra Leone',	232),
(196,	'SG',	'Singapore',	65),
(197,	'SK',	'Slovakia',	421),
(198,	'SI',	'Slovenia',	386),
(199,	'XG',	'Smaller Territories of the UK',	44),
(200,	'SB',	'Solomon Islands',	677),
(201,	'SO',	'Somalia',	252),
(202,	'ZA',	'South Africa',	27),
(203,	'GS',	'South Georgia',	0),
(204,	'SS',	'South Sudan',	211),
(205,	'ES',	'Spain',	34),
(206,	'LK',	'Sri Lanka',	94),
(207,	'SD',	'Sudan',	249),
(208,	'SR',	'Suriname',	597),
(209,	'SJ',	'Svalbard And Jan Mayen Islands',	47),
(210,	'SZ',	'Swaziland',	268),
(211,	'SE',	'Sweden',	46),
(212,	'CH',	'Switzerland',	41),
(213,	'SY',	'Syria',	963),
(214,	'TW',	'Taiwan',	886),
(215,	'TJ',	'Tajikistan',	992),
(216,	'TZ',	'Tanzania',	255),
(217,	'TH',	'Thailand',	66),
(218,	'TG',	'Togo',	228),
(219,	'TK',	'Tokelau',	690),
(220,	'TO',	'Tonga',	676),
(221,	'TT',	'Trinidad And Tobago',	1868),
(222,	'TN',	'Tunisia',	216),
(223,	'TR',	'Turkey',	90),
(224,	'TM',	'Turkmenistan',	7370),
(225,	'TC',	'Turks And Caicos Islands',	1649),
(226,	'TV',	'Tuvalu',	688),
(227,	'UG',	'Uganda',	256),
(228,	'UA',	'Ukraine',	380),
(229,	'AE',	'United Arab Emirates',	971),
(230,	'GB',	'United Kingdom',	44),
(231,	'US',	'United States',	1),
(232,	'UM',	'United States Minor Outlying Islands',	1),
(233,	'UY',	'Uruguay',	598),
(234,	'UZ',	'Uzbekistan',	998),
(235,	'VU',	'Vanuatu',	678),
(236,	'VA',	'Vatican City State (Holy See)',	39),
(237,	'VE',	'Venezuela',	58),
(238,	'VN',	'Vietnam',	84),
(239,	'VG',	'Virgin Islands (British)',	1284),
(240,	'VI',	'Virgin Islands (US)',	1340),
(241,	'WF',	'Wallis And Futuna Islands',	681),
(242,	'EH',	'Western Sahara',	212),
(243,	'YE',	'Yemen',	967),
(244,	'YU',	'Yugoslavia',	38),
(245,	'ZM',	'Zambia',	260),
(246,	'ZW',	'Zimbabwe',	263);

DROP TABLE IF EXISTS `ci_favourite`;
CREATE TABLE `ci_favourite` (
  `favourite_id` int(11) NOT NULL AUTO_INCREMENT,
  `favourite_by` int(11) NOT NULL,
  `favourite_to` int(11) NOT NULL,
  `created_on` int(11) NOT NULL,
  PRIMARY KEY (`favourite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_flex`;
CREATE TABLE `ci_flex` (
  `flex_id` int(11) NOT NULL AUTO_INCREMENT,
  `flex_by` int(11) NOT NULL,
  `flex_to` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`flex_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_keywords`;
CREATE TABLE `ci_keywords` (
  `keyword_ID` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(256) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `group_ID` varchar(256) NOT NULL,
  `keyword_message` varchar(256) NOT NULL,
  `keyword_status` enum('0','1') NOT NULL COMMENT '''1''=>''deleted''',
  `keyword_created` datetime NOT NULL,
  `keyword_modified` datetime NOT NULL,
  PRIMARY KEY (`keyword_ID`),
  UNIQUE KEY `keyword_name` (`keyword_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_messages`;
CREATE TABLE `ci_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_by` int(11) NOT NULL,
  `message_to` int(11) NOT NULL,
  `message_type` enum('text','image') NOT NULL,
  `message_text` text NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted_from` varchar(45) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_notes`;
CREATE TABLE `ci_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_from` int(11) NOT NULL,
  `note_to` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_notifications`;
CREATE TABLE `ci_notifications` (
  `noti_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` blob NOT NULL,
  `noti_type` enum('visit','favourite','flex','unlock','message') NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_private_pics`;
CREATE TABLE `ci_private_pics` (
  `private_pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `private_pic_name` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_on` datetime NOT NULL,
  PRIMARY KEY (`private_pic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ci_private_pics` (`private_pic_id`, `profile_id`, `private_pic_name`, `created_on`, `created_by`, `is_deleted`, `deleted_on`) VALUES
(1,	1,	'avatar-1.jpg',	'2019-07-18 00:00:00',	0,	'',	'0000-00-00 00:00:00'),
(2,	1,	'avatar-2.jpg',	'2019-07-18 00:00:00',	0,	'',	'0000-00-00 00:00:00'),
(3,	1,	'avatar-3.jpg',	'2019-07-18 00:00:00',	0,	'',	'0000-00-00 00:00:00'),
(4,	3,	'avatar-4.jpg',	'2019-07-18 00:00:00',	0,	'',	'0000-00-00 00:00:00'),
(5,	4,	'avatar-5.jpg',	'2019-07-18 00:00:00',	0,	'',	'0000-00-00 00:00:00'),
(6,	4,	'avatar-4.jpg',	'2019-07-26 08:41:26',	0,	'',	'0000-00-00 00:00:00'),
(7,	6,	'avatar-6.jpg',	'2019-07-26 08:41:48',	0,	'',	'0000-00-00 00:00:00'),
(8,	7,	'avatar-9.jpg',	'2019-07-26 08:42:24',	0,	'',	'0000-00-00 00:00:00'),
(9,	7,	'avatar-7.jpg',	'2019-07-26 08:42:48',	0,	'',	'2019-07-26 08:42:48'),
(10,	8,	'avatar-8.jpg',	'2019-07-26 08:43:06',	0,	'',	'2019-07-26 08:43:06'),
(11,	9,	'avatar-1.jpg',	'2019-07-26 08:43:21',	0,	'',	'2019-07-26 08:43:21'),
(12,	9,	'avatar-9.jpg',	'2019-07-26 08:43:35',	0,	'',	'2019-07-26 08:43:35'),
(13,	9,	'avatar-4.jpg',	'2019-07-26 08:43:52',	0,	'',	'2019-07-26 08:43:52');

DROP TABLE IF EXISTS `ci_profile_options`;
CREATE TABLE `ci_profile_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_title` varchar(100) NOT NULL,
  `option_type` enum('i_am','i_enjoy','i_hang_out_at','ethnicity','relationship_status','work','hoping_for','my_type','safety_practice','sex_role','hankies','when_where','friend') NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ci_profile_options` (`option_id`, `option_title`, `option_type`, `created_on`, `created_by`, `is_deleted`, `deleted_on`, `modified_on`) VALUES
(1,	'New Friends',	'friend',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	'Happy Hours Dinner',	'friend',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	'Marriage',	'hoping_for',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	'Just Dating',	'hoping_for',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(5,	'Guy Next Door',	'my_type',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(6,	'All-American',	'my_type',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(7,	'Human',	'ethnicity',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(8,	'Asian',	'ethnicity',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(9,	'Condoms',	'safety_practice',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(10,	'Prep',	'safety_practice',	'2019-08-04 14:18:33',	0,	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `ci_profile_visitors`;
CREATE TABLE `ci_profile_visitors` (
  `profile_visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_from` int(11) NOT NULL,
  `visit_to` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`profile_visit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_settings`;
CREATE TABLE `ci_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notifications` enum('0','1') NOT NULL,
  `quite_mode` enum('0','1') NOT NULL,
  `quite_hour_begin` time NOT NULL,
  `quite_hour_end` time NOT NULL,
  `time_limit` enum('0','1') NOT NULL,
  `time_limit_type` enum('daily','weekly') NOT NULL,
  `time_limit_hours` int(11) NOT NULL,
  `switcher_photo` enum('default','own') NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_tokens`;
CREATE TABLE `ci_tokens` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `token_code` varchar(250) NOT NULL,
  `device_type` enum('android','ios') NOT NULL,
  `device_token` text NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ci_tokens` (`token_id`, `token_code`, `device_type`, `device_token`, `created_on`, `deleted_on`, `user_id`, `is_deleted`) VALUES
(1,	'62CBis',	'android',	'rwerwer',	'2019-07-20 04:00:37',	'0000-00-00 00:00:00',	53,	'0');

DROP TABLE IF EXISTS `ci_users`;
CREATE TABLE `ci_users` (
  `User_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `User_Email` varchar(255) NOT NULL,
  `User_Type` enum('admin','sub_admin','user') NOT NULL DEFAULT 'admin',
  `User_Password` varchar(255) NOT NULL,
  `User_Phone` varchar(255) NOT NULL,
  `User_Name` varchar(45) NOT NULL,
  `Verify_Code` text NOT NULL,
  `Latitude` varchar(100) NOT NULL,
  `Longitude` varchar(100) NOT NULL,
  `Online_Status` enum('0','1','2') NOT NULL COMMENT '0=offline, 1=online, 2=away	',
  `Is_Deleted` enum('0','1') DEFAULT '0' COMMENT '0 =>No-Deleted,1=>Deleted',
  `Created_Date` datetime NOT NULL,
  `Modified_Date` datetime NOT NULL,
  `Deleted_Date` datetime NOT NULL,
  `User_Image` text NOT NULL,
  `Is_Blocked` enum('0','1') NOT NULL,
  `Is_Verified` enum('0','1') NOT NULL,
  `active_profile` int(11) NOT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ci_users` (`User_Id`, `User_Email`, `User_Type`, `User_Password`, `User_Phone`, `User_Name`, `Verify_Code`, `Latitude`, `Longitude`, `Online_Status`, `Is_Deleted`, `Created_Date`, `Modified_Date`, `Deleted_Date`, `User_Image`, `Is_Blocked`, `Is_Verified`, `active_profile`) VALUES
(1,	'admin@gmail.com',	'admin',	'e10adc3949ba59abbe56e057f20f883e',	'+14804634279',	'admin',	'',	'',	'',	'0',	'0',	'2017-05-25 16:50:00',	'2018-09-12 20:19:55',	'0000-00-00 00:00:00',	'avatar-1.jpg',	'1',	'0',	0),
(47,	'user@gmail.com',	'user',	'e10adc3949ba59abbe56e057f20f883e',	'+14804634279',	'admin',	'',	'',	'',	'0',	'0',	'2019-07-25 16:50:00',	'2018-09-12 20:19:55',	'0000-00-00 00:00:00',	'avatar-4.jpg',	'0',	'0',	0),
(48,	'michael@gmail.com',	'user',	'e10adc3949ba59abbe56e057f20f883e',	'+14804634279',	'admin',	'',	'',	'',	'0',	'0',	'2017-05-25 16:50:00',	'2018-09-12 20:19:55',	'0000-00-00 00:00:00',	'avatar-6.jpg',	'0',	'0',	0),
(49,	'robinson@gmail.com',	'user',	'e10adc3949ba59abbe56e057f20f883e',	'+14804634279',	'admin',	'',	'',	'',	'0',	'0',	'2017-05-25 16:50:00',	'2018-09-12 20:19:55',	'0000-00-00 00:00:00',	'avatar-9.jpg',	'0',	'0',	0),
(55,	'keentesting77@gmail.com',	'user',	'e10adc3949ba59abbe56e057f20f883e',	'',	'',	'',	'',	'',	'0',	'0',	'2019-08-01 05:10:49',	'2019-08-01 05:10:49',	'0000-00-00 00:00:00',	'',	'0',	'1',	0);

DROP TABLE IF EXISTS `ci_user_profiles`;
CREATE TABLE `ci_user_profiles` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_type` enum('friend','flirt','fun') NOT NULL,
  `profile_name` varchar(250) NOT NULL,
  `profile_pic` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL,
  `is_blocked` enum('0','1') NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_on` datetime NOT NULL,
  `my_story` text NOT NULL,
  `i_am` text NOT NULL,
  `i_enjoy` text NOT NULL,
  `i_hang_out_at` text NOT NULL,
  `fun_fact` text NOT NULL,
  `birthday` date NOT NULL,
  `wieght` decimal(11,2) NOT NULL,
  `height` decimal(11,2) NOT NULL,
  `ethnicity` int(11) NOT NULL,
  `relationship_status` int(11) NOT NULL,
  `work` int(11) NOT NULL,
  `my_type` varchar(250) NOT NULL,
  `my_role` varchar(250) NOT NULL,
  `is_role_public` enum('0','1') NOT NULL,
  `safety_practice` varchar(250) NOT NULL,
  `is_safty_practice_public` enum('0','1') NOT NULL,
  `seeking` text NOT NULL,
  `looking_friend` varchar(250) NOT NULL,
  `hoping_for` varchar(250) NOT NULL,
  `looking_ethnicity` text NOT NULL,
  `looking_my_type` varchar(250) NOT NULL,
  `looking_role` varchar(250) NOT NULL,
  `link_profile` int(11) NOT NULL,
  `hankies` varchar(250) NOT NULL,
  `when_where` varchar(250) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ci_user_profiles` (`profile_id`, `profile_type`, `profile_name`, `profile_pic`, `user_id`, `created_on`, `created_by`, `modified_on`, `is_blocked`, `is_deleted`, `deleted_on`, `my_story`, `i_am`, `i_enjoy`, `i_hang_out_at`, `fun_fact`, `birthday`, `wieght`, `height`, `ethnicity`, `relationship_status`, `work`, `my_type`, `my_role`, `is_role_public`, `safety_practice`, `is_safty_practice_public`, `seeking`, `looking_friend`, `hoping_for`, `looking_ethnicity`, `looking_my_type`, `looking_role`, `link_profile`, `hankies`, `when_where`) VALUES
(1,	'friend',	'John frined',	'avatar-1.jpg	',	47,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'0',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(2,	'fun',	'John fun',	'avatar-2.jpg	',	47,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'0',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(3,	'flirt',	'John flirt',	'avatar-3.jpg	',	47,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'0',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(4,	'friend',	'Michael Jordan',	'avatar-4.jpg',	48,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'1',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(5,	'flirt',	'Michael Jordan',	'avatar-5.jpg',	48,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'0',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(6,	'fun',	'Michael Jordan',	'avatar-6.jpg',	48,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'1',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(7,	'friend',	'Jackie Robinson',	'avatar-7.jpg',	49,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'1',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(8,	'flirt',	'Jackie Robinson',	'avatar-8.jpg',	49,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'1',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	''),
(9,	'fun',	'Jackie Robinson',	'avatar-9.jpg',	49,	'2019-07-18 00:00:00',	0,	'0000-00-00 00:00:00',	'1',	'',	'0000-00-00 00:00:00',	'',	'',	'',	'',	'',	'0000-00-00',	0.00,	0.00,	0,	0,	0,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	'',	'');

DROP TABLE IF EXISTS `ci_user_visibility`;
CREATE TABLE `ci_user_visibility` (
  `visibility_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stealth_mode` enum('0','1') NOT NULL,
  `safe_for_work` enum('0','1') NOT NULL,
  `safe_work_begin` time NOT NULL,
  `safe_work_end` time NOT NULL,
  `safe_work_location` text NOT NULL,
  `explore_mode` enum('0','1') NOT NULL,
  `explore_location` text NOT NULL,
  PRIMARY KEY (`visibility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-08-06 08:18:50
