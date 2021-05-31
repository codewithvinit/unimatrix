--
-- Table structure for table `netw_baseplan`
--

DROP TABLE IF EXISTS `netw_baseplan`;
CREATE TABLE IF NOT EXISTS `netw_baseplan` (
  `bpid` int(12) NOT NULL AUTO_INCREMENT,
  `maxwidth` int(9) DEFAULT '0',
  `maxdepth` int(9) DEFAULT '2',
  `currencysym` varchar(32) DEFAULT 'JmRvbGxhcjs=',
  `currencycode` varchar(3) DEFAULT 'USD',
  `pay_emailname` varchar(32) DEFAULT '',
  `pay_emailaddr` varchar(200) DEFAULT '',
  `bptoken` text,
  PRIMARY KEY (`bpid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_configs`
--

DROP TABLE IF EXISTS `netw_configs`;
CREATE TABLE IF NOT EXISTS `netw_configs` (
  `cfgid` tinyint(1) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) DEFAULT '',
  `site_url` varchar(191) DEFAULT '',
  `site_descr` text,
  `site_keywrd` text,
  `site_logo` varchar(191) DEFAULT '../assets/image/logo_defaultimage.png',
  `site_emailname` varchar(128) DEFAULT '',
  `site_emailaddr` varchar(191) DEFAULT '',
  `site_phone` varchar(32) DEFAULT '',
  `site_sosmed` text,
  `cmpny_name` varchar(128) DEFAULT '',
  `cmpny_address` text,
  `cmpny_footnote` text,
  `sitehits` int(12) DEFAULT '0',
  `join_status` tinyint(1) DEFAULT '1',
  `site_status` tinyint(1) DEFAULT '1',
  `site_status_note` text,
  `langiso` varchar(2) DEFAULT 'en',
  `admin_user` varchar(128) DEFAULT '',
  `admin_password` varchar(191) DEFAULT '',
  `admimage` varchar(191) DEFAULT '../assets/image/adm_defaultimage.jpg',
  `envacc` varchar(64) DEFAULT '',
  `lickey` varchar(64) DEFAULT '',
  `allowfreembr` tinyint(1) DEFAULT '0',
  `delete_freeafter` int(5) DEFAULT '0',
  `delete_expafter` int(5) DEFAULT '0',
  `multiemail2reg` tinyint(1) DEFAULT '1',
  `ismanualspr` tinyint(1) DEFAULT '0',
  `mbr_defaultimage` varchar(191) DEFAULT '../assets/image/mbr_defaultimage.jpg',
  `mbrmax_image_width` int(4) DEFAULT '100',
  `mbrmax_image_height` int(4) DEFAULT '100',
  `mbrmax_title_char` int(4) DEFAULT '64',
  `mbrmax_descr_char` int(4) DEFAULT '144',
  `getstart` text,
  `min2payout` float DEFAULT '0',
  `validref` tinyint(1) DEFAULT '0',
  `randref` tinyint(1) DEFAULT '0',
  `defaultref` text,
  `norefredirurl` text,
  `mbroptref` tinyint(1) DEFAULT '0',
  `time_offset` int(2) DEFAULT '0',
  `dldir` varchar(191) DEFAULT '',
  `maxpage` tinyint(3) DEFAULT '15',
  `sodatef` varchar(32) DEFAULT 'j M Y',
  `lodatef` varchar(32) DEFAULT 'D, j M Y H:i:s',
  `maxcookie_days` int(4) DEFAULT '180',
  `treestatus` tinyint(1) DEFAULT '1',
  `treemaxwidth` smallint(9) DEFAULT '0',
  `treemaxdeep` int(12) DEFAULT '0',
  `iscrontask` tinyint(1) DEFAULT '0',
  `badunlist` text,
  `badiplist` text,
  `bademail` text,
  `vhitpoint` float DEFAULT '0',
  `fbakpoint` float DEFAULT '0',
  `lginpoint` float DEFAULT '0',
  `emailer` enum('mail','sendmail','smtp') DEFAULT 'mail',
  `smtphost` tinytext,
  `smtpuser` varchar(128) DEFAULT '',
  `smtppass` varchar(128) DEFAULT '',
  `smtpencr` varchar(8) DEFAULT '',
  `emailer1` enum('emailer','smtp') DEFAULT 'emailer',
  `smtp1host` tinytext,
  `smtp1user` varchar(128) DEFAULT '',
  `smtp1pass` varchar(128) DEFAULT '',
  `smtp1encr` varchar(8) DEFAULT '',
  `emailer2` enum('emailer','smtp') DEFAULT 'emailer',
  `smtp2host` tinytext,
  `smtp2user` varchar(128) DEFAULT '',
  `smtp2pass` varchar(128) DEFAULT '',
  `smtp2encr` varchar(8) DEFAULT '',
  `returnmail` varchar(32) DEFAULT '',
  `email_admin_on_join` tinyint(1) DEFAULT '0',
  `email_admin_copy_msgs` tinyint(1) DEFAULT '0',
  `isrecaptcha` tinyint(1) DEFAULT '0',
  `rc_securekey` varchar(40) DEFAULT '',
  `rc_sitekey` varchar(40) DEFAULT '',
  `wcodes1` text,
  `wcodes1opt` tinyint(1) DEFAULT '0',
  `wcodes2` text,
  `wcodes2opt` tinyint(1) DEFAULT '0',
  `goanalytics` varchar(128) DEFAULT '',
  `autobackup_days` smallint(5) DEFAULT '0',
  `autobackup_email` varchar(128) DEFAULT '',
  `autobackup_date` date DEFAULT '2000-01-01',
  `cfgtoken` text,
  `softversion` varchar(16) DEFAULT 'Release',
  `installdate` date DEFAULT '2000-01-01',
  `installhash` varchar(191) DEFAULT '',
  `licdate` date DEFAULT '2000-01-01',
  `licstatus` tinyint(1) DEFAULT '0',
  `lichash` varchar(191) DEFAULT '',
  `cronts` datetime DEFAULT '2000-01-01 00:00:01',
  PRIMARY KEY (`cfgid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `netw_configs`
--

INSERT INTO `netw_configs` (`cfgid`, `site_name`, `site_url`, `site_descr`, `site_keywrd`, `site_logo`, `site_emailname`, `site_emailaddr`, `site_phone`, `site_sosmed`, `cmpny_name`, `cmpny_address`, `cmpny_footnote`, `sitehits`, `join_status`, `site_status`, `site_status_note`, `langiso`, `admin_user`, `admin_password`, `admimage`, `envacc`, `lickey`, `allowfreembr`, `delete_freeafter`, `delete_expafter`, `multiemail2reg`, `ismanualspr`, `mbr_defaultimage`, `mbrmax_image_width`, `mbrmax_image_height`, `mbrmax_title_char`, `mbrmax_descr_char`, `getstart`, `min2payout`, `validref`, `randref`, `defaultref`, `norefredirurl`, `mbroptref`, `time_offset`, `dldir`, `maxpage`, `sodatef`, `lodatef`, `maxcookie_days`, `treestatus`, `treemaxwidth`, `treemaxdeep`, `iscrontask`, `badunlist`, `badiplist`, `bademail`, `vhitpoint`, `fbakpoint`, `lginpoint`, `emailer`, `smtphost`, `smtpuser`, `smtppass`, `smtpencr`, `emailer1`, `smtp1host`, `smtp1user`, `smtp1pass`, `smtp1encr`, `emailer2`, `smtp2host`, `smtp2user`, `smtp2pass`, `smtp2encr`, `returnmail`, `email_admin_on_join`, `email_admin_copy_msgs`, `isrecaptcha`, `rc_securekey`, `rc_sitekey`, `wcodes1`, `wcodes1opt`, `wcodes2`, `wcodes2opt`, `goanalytics`, `autobackup_days`, `autobackup_email`, `autobackup_date`, `cfgtoken`, `softversion`, `installdate`, `installhash`, `licdate`, `licstatus`, `lichash`, `cronts`) VALUES
(1, 'Pro Webber', 'http://localhost/unimatrix', '', '', '../assets/image/logo_defaultimage.png', 'Pro Webber', 'mail@mail.com', '', NULL, '', NULL, NULL, 0, 1, 1, '', 'en', 'admin', '$2y$10$BGegHKZVzy99k7DCEtooQOuQ8Q25QVVDVgQ4tZhWXuZzb7SwPWXDi', '../assets/image/adm_defaultimage.jpg', '', '9f7d0ee82b6a6ca7ddeae841f3253059', 0, 0, 0, 1, 0, '../assets/image/mbr_defaultimage.jpg', 100, 100, 64, 144, NULL, 0, 0, 0, '', NULL, 0, 0, 'c:\\wamp\\www\\unimatrix\\downloads', 15, 'j M Y', 'D, j M Y H:i:s', 180, 1, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 'mail', NULL, '', '', '', 'emailer', NULL, '', '', '', 'emailer', NULL, '', '', '', '', 0, 0, 0, '', '', NULL, 0, NULL, 0, '', 0, '', '2000-01-01', '|cnvdate:2020-04-28|, |cnvnum:1.2.2|, |cnvget:0|, |site_subname:Pro Webber|, |isautoregplan:0|, |disreflink:|', '1.2.2', '2020-04-28', '8d7ed94dab2b3e28e4f2da1bce211bad', '2020-03-07', 0, '', '2020-04-30 20:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `netw_files`
--

DROP TABLE IF EXISTS `netw_files`;
CREATE TABLE IF NOT EXISTS `netw_files` (
  `flid` int(12) NOT NULL AUTO_INCREMENT,
  `fldate` date DEFAULT '2000-01-01',
  `flupdate` date DEFAULT '2000-01-01',
  `flpath` text,
  `flname` varchar(128) DEFAULT '',
  `fldescr` text,
  `flsize` varchar(16) DEFAULT '0 Bytes',
  `fldlcount` int(12) DEFAULT '0',
  `flimage` varchar(191) DEFAULT '../assets/image/file_defaultimage.jpg',
  `flsticky` tinyint(1) DEFAULT '0',
  `flavalto` tinyint(1) DEFAULT '1',
  `flstatus` tinyint(1) DEFAULT '1',
  `fltoken` text,
  PRIMARY KEY (`flid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_groups`
--

DROP TABLE IF EXISTS `netw_groups`;
CREATE TABLE IF NOT EXISTS `netw_groups` (
  `grid` int(11) NOT NULL AUTO_INCREMENT,
  `grtype` varchar(128) DEFAULT '',
  `grtitle` varchar(128) DEFAULT '',
  `groptions` text,
  `grorder` int(11) DEFAULT '0',
  `grtoken` text,
  `gradminfo` text,
  PRIMARY KEY (`grid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_invoices`
--

DROP TABLE IF EXISTS `netw_invoices`;
CREATE TABLE IF NOT EXISTS `netw_invoices` (
  `invid` int(11) NOT NULL AUTO_INCREMENT,
  `invdate` datetime DEFAULT '2000-01-01 00:00:01',
  `invoiceid` varchar(24) DEFAULT '',
  `invtoken` text,
  `invstatus` tinyint(1) DEFAULT '0',
  `invusein` varchar(32) DEFAULT '',
  `invlast` datetime DEFAULT '2000-01-01 00:00:01',
  PRIMARY KEY (`invid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_mbrplans`
--

DROP TABLE IF EXISTS `netw_mbrplans`;
CREATE TABLE IF NOT EXISTS `netw_mbrplans` (
  `mpid` int(12) NOT NULL AUTO_INCREMENT,
  `idhostmbr` int(12) DEFAULT '0' COMMENT 'based on member main mpid',
  `idmbr` int(12) DEFAULT '0',
  `mppid` int(11) DEFAULT '1' COMMENT 'based on payplan ppid',
  `isdefault` tinyint(1) DEFAULT '1',
  `reg_date` date DEFAULT '2000-01-01',
  `reg_expd` date DEFAULT '2000-01-01',
  `reg_utctime` timestamp NOT NULL DEFAULT '1999-12-31 21:00:01',
  `reg_ip` varchar(32) DEFAULT '',
  `reg_fee` decimal(16,2) DEFAULT '0.00',
  `mpstatus` tinyint(1) DEFAULT '1' COMMENT '0:inactive, 1:active, 2:expired, 3:pending',
  `hostspr` int(12) DEFAULT '0' COMMENT 'based on sponsor mpid',
  `idref` int(12) DEFAULT '0',
  `idspr` int(12) DEFAULT '0',
  `sprlist` text COMMENT 'based on sponsor mpid',
  `mpwidth` int(12) DEFAULT '0',
  `mpdepth` int(12) DEFAULT '0',
  `mprankid` int(11) DEFAULT '0',
  `renewtimes` int(6) DEFAULT '0',
  `recyclingit` smallint(5) DEFAULT '0',
  `cyclingbyid` int(12) DEFAULT '0',
  `mptoken` text,
  `mpadminfo` text,
  PRIMARY KEY (`mpid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_mbrs`
--

DROP TABLE IF EXISTS `netw_mbrs`;
CREATE TABLE IF NOT EXISTS `netw_mbrs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `in_date` timestamp NOT NULL DEFAULT '1999-12-31 21:00:01',
  `firstname` varchar(32) DEFAULT '',
  `lastname` varchar(32) DEFAULT '',
  `username` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(191) DEFAULT '',
  `password` varchar(64) DEFAULT '',
  `mbrsite_url` varchar(191) DEFAULT '',
  `mbrsite_title` varchar(191) DEFAULT '',
  `mbrsite_desc` text,
  `mbrsite_cat` varchar(191) DEFAULT '',
  `mbrsite_img` varchar(191) DEFAULT '../assets/image/site_defaultimage.jpg',
  `showsite` tinyint(1) DEFAULT '1',
  `mbr_image` varchar(191) DEFAULT '../assets/image/mbr_defaultimage.jpg',
  `mbr_intro` text,
  `mbr_sosmed` text,
  `phone` varchar(32) DEFAULT '',
  `address` text,
  `state` varchar(64) DEFAULT '',
  `country` varchar(2) DEFAULT '',
  `mylang` varchar(2) DEFAULT 'en',
  `optinme` tinyint(1) DEFAULT '1',
  `hits` int(12) DEFAULT '0',
  `log_date` timestamp NOT NULL DEFAULT '1999-12-31 21:00:01',
  `log_ip` varchar(32) DEFAULT '',
  `taglabel` varchar(128) DEFAULT '',
  `mbrstatus` tinyint(1) DEFAULT '1' COMMENT '0:inactive, 1:active, 2:limited, 3:pending',
  `isconfirm` tinyint(1) DEFAULT '1',
  `ewallet` decimal(16,2) DEFAULT '0.00',
  `epoint` float DEFAULT '0',
  `mbrtoken` text,
  `adminfo` text,
  `deviceid` varchar(128) DEFAULT '',
  PRIMARY KEY (`id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_notifytpl`
--

DROP TABLE IF EXISTS `netw_notifytpl`;
CREATE TABLE IF NOT EXISTS `netw_notifytpl` (
  `ntid` int(11) NOT NULL AUTO_INCREMENT,
  `ntcode` varchar(128) DEFAULT '',
  `ntname` varchar(191) DEFAULT '',
  `ntdesc` text,
  `ntpid` int(11) DEFAULT '0',
  `ntsubject` varchar(191) DEFAULT '',
  `nttext` text,
  `nthtml` text,
  `ntsms` text,
  `ntpush` text,
  `ntoptions` varchar(128) DEFAULT '|email:0|, |sms:0|, |pushmsg:0|',
  `nttoken` text,
  PRIMARY KEY (`ntid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `netw_notifytpl`
--

INSERT INTO `netw_notifytpl` (`ntid`, `ntcode`, `ntname`, `ntdesc`, `ntpid`, `ntsubject`, `nttext`, `nthtml`, `ntsms`, `ntpush`, `ntoptions`, `nttoken`) VALUES
(1, 'mbr_reg', 'Welcome Message', 'Notification send after member registration success', 0, '[[firstname]], thank you for register!', 'Hello [[firstname]],\r\n\r\nWelcome and thank you for registering!\r\n\r\nYour Account Details:\r\nName: [[fullname]]\r\nEmail: [[email]]\r\nUsername: [[username]]\r\nPassword: [[rawpassword]]\r\n\r\nPlease login to your member area at [[login_url]]\r\n\r\n\r\nBest Regards,\r\n[[site_name]]\r\n', '<p>Hello [[firstname]],</p>\r\n\r\n<p><b>Welcome and thank you for registering!</b></p>\r\n\r\n<p>Your Account Details:<br>\r\nName: [[fullname]]<br>\r\nEmail: [[email]]<br>\r\nUsername: [[username]]<br>\r\nPassword: [[rawpassword]]</p>\r\n\r\n<p>Please login to your member area at [[login_url]]</p>\r\n\r\n<p><br>\r\nBest Regards,<br>\r\n[[site_name]]<br>\r\n&nbsp;</p>\r\n', 'Welcome [[username]], thank you for registering!', 'Welcome [[username]], thank you for registering!', '|email:1|, |sms:0|, |pushmsg:0|', NULL),
(2, 'mbr_newdl', 'New Referral Signup', 'Notification send to member each time their new referral signup', 0, '[[firstname]], New Referral Signup!', 'Hi [[firstname]],\r\n\r\nCongratulations, new referral signup:\r\nName: [[dln_fullname]]\r\nUsername: [[dln_username]]\r\n\r\nKeep up the good work.\r\nBest Regards,\r\n\r\n[[site_name]]\r\n\r\n---\r\nYour email address is [[email]]', '<p>Hi [[firstname]],</p>\r\n\r\n<p><strong>Congratulations</strong>, new referral signup:</p>\r\n\r\n<p>Name: [[dln_fullname]]<br>\r\nUsername: [[dln_username]]</p>\r\n\r\n<p><br>\r\nKeep up the good work.<br>\r\nBest Regards,</p><p>[[site_name]]<br></p>\r\n\r\n<p>---<br>\r\n<em>Your email address is [[email]]</em><br>\r\n</p>\r\n', 'Congratulations, new referral signup: [[dln_username]]', 'Congratulations, new referral signup: [[dln_username]]', '|email:1|, |sms:0|, |pushmsg:0|', NULL),
(3, 'mbr_resetpass', 'Reset Password Request', 'Notification message send after member request reset password', 0, 'Password Reset Request', 'Hi,\r\n\r\nPlease use the following link to generate new password for your account:\r\n\r\n[[passwordreset_url]]\r\n\r\nBest Regards,\r\n\r\n---\r\nIf you didn\'t make any request for a password reset recently, please contact us!', '<p>Hi,</p><p>Please use the following link to generate new password for your account:</p>\r\n\r\n<p>[[passwordreset_url]]</p>\r\n\r\n<p><br>\r\nBest Regards,</p>\r\n\r\n<p>---</p>\r\n\r\n<p><em>If you did not make any request for a password reset recently, please contact us!</em></p>\r\n', '', '', '|email:0|, |sms:1|, |pushmsg:1|', NULL),
(4, 'mbr_newcm', 'New Commission Generated', 'Notification send to member each time they get new commission', 0, '[[firstname]], New Commission: [[ncm_memo]]', 'Hi [[firstname]],\r\n\r\nCongratulations, you got paid!\r\nTransaction: [[ncm_memo]]\r\nAmount: [[ncm_amount]]\r\nReferral: [[dln_username]]\r\n\r\nKeep up the good work.\r\nBest Regards,\r\n\r\n[[site_name]]\r\n\r\n---\r\nYour email address is [[email]]', '<p>Hi [[firstname]],</p>\r\n\r\n<p><strong>Congratulations</strong>, you got paid!</p>\r\n\r\n<p>Transaction: [[ncm_memo]]<br>\r\nAmount: [[ncm_amount]]<br>\r\nReferral: [[dln_username]]</p>\r\n\r\n<p><br>\r\nKeep up the good work.<br>\r\nBest Regards,</p><p>[[site_name]]<br></p>\r\n\r\n<p>---<br>\r\n<em>Your email address is [[email]]</em><br>\r\n</p>\r\n', 'Congratulations, new commission: [[ncm_memo]]', 'Congratulations, new commission: [[ncm_memo]]', '|email:1|, |sms:0|, |pushmsg:0|', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `netw_pages`
--

DROP TABLE IF EXISTS `netw_pages`;
CREATE TABLE IF NOT EXISTS `netw_pages` (
  `pgid` varchar(191) NOT NULL,
  `pgtitle` varchar(191) DEFAULT '',
  `pgsubtitle` varchar(191) DEFAULT '',
  `pgcontent` longtext,
  `pgavalon` varchar(128) DEFAULT '',
  `pgppids` varchar(128) DEFAULT '',
  `pgstatus` tinyint(1) DEFAULT NULL,
  `pgmenu` varchar(128) DEFAULT '',
  `pgorder` int(10) DEFAULT NULL,
  `pgtoken` text,
  PRIMARY KEY (`pgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_paygates`
--

DROP TABLE IF EXISTS `netw_paygates`;
CREATE TABLE IF NOT EXISTS `netw_paygates` (
  `paygid` int(12) NOT NULL AUTO_INCREMENT,
  `pgidmbr` int(12) DEFAULT '0',
  `paypalon` tinyint(1) DEFAULT '0',
  `paypalsubs` tinyint(1) DEFAULT '0',
  `paypalfee` varchar(10) DEFAULT '0',
  `paypalacc` varchar(64) DEFAULT '',
  `paypaltest` char(3) DEFAULT 'on',
  `paypal4usr` tinyint(1) DEFAULT '0',
  `coinpaymentson` tinyint(1) DEFAULT '0',
  `coinpaymentsfee` varchar(10) DEFAULT '0',
  `coinpaymentsmercid` varchar(64) DEFAULT '',
  `coinpaymentsipnkey` varchar(64) DEFAULT '',
  `coinpaymentsconfirm` tinyint(1) DEFAULT '1',
  `coinpayments4usr` tinyint(1) DEFAULT '0',
  `manualpayon` tinyint(1) DEFAULT '0',
  `manualpaybtn` tinyint(1) DEFAULT '0',
  `manualpayfee` varchar(10) DEFAULT '0',
  `manualpayname` tinytext,
  `manualpayipn` text,
  `manualpay4usr` tinyint(1) DEFAULT '0',
  `testpayon` tinyint(1) DEFAULT '0',
  `testpayfee` varchar(10) DEFAULT '0',
  `testpaylabel` tinytext,
  `testpay4usr` tinyint(1) DEFAULT '0',
  `paytoken` text,
  PRIMARY KEY (`paygid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `netw_paygates`
--

INSERT INTO `netw_paygates` (`paygid`, `pgidmbr`, `paypalon`, `paypalsubs`, `paypalfee`, `paypalacc`, `paypaltest`, `paypal4usr`, `coinpaymentson`, `coinpaymentsfee`, `coinpaymentsmercid`, `coinpaymentsipnkey`, `coinpaymentsconfirm`, `coinpayments4usr`, `manualpayon`, `manualpaybtn`, `manualpayfee`, `manualpayname`, `manualpayipn`, `manualpay4usr`, `testpayon`, `testpayfee`, `testpaylabel`, `testpay4usr`, `paytoken`) VALUES
(1, 0, 0, 0, '0', '', 'on', 0, 0, '0', '', '', 1, 0, 0, 0, '0', 'Cash or Bank', 'PHA+UGxlYXNlIHNlbmQgdGhlIHBheW1lbnQgb2YgPGI+W1tjdXJyZW5jeXN5bV1dW1thbW91bnRdXTwvYj4gKyBbW2ZlZWFtb3VudF1dID0gPGI+W1tjdXJyZW5jeXN5bV1dW1t0b3RhbW91bnRdXSBbW2N1cnJlbmN5Y29kZV1dIDwvYj5mb3IgPGI+W1twYXlwbGFuXV08L2I+IHJlZ2lzdHJhdGlvbiB0byB0aGUgZm9sbG93aW5nOjwvcD48cD5BY2NvdW50OiA8Yj4wMTIzNDU2Nzg5PC9iPjxicj5OYW1lOiA8Yj5UaGUgQm9zczwvYj48L3A+PHA+QWZ0ZXIgcGF5bWVudCBjb21wbGV0ZSwgY29uZmlybSB5b3VyIHBheW1lbnQuPC9wPg==', 1, 1, '0', 'Test Payment Sandbox', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `netw_payplans`
--

DROP TABLE IF EXISTS `netw_payplans`;
CREATE TABLE IF NOT EXISTS `netw_payplans` (
  `ppid` int(12) NOT NULL AUTO_INCREMENT,
  `ppname` varchar(128) DEFAULT '',
  `planinfo` text,
  `planlogo` varchar(191) DEFAULT '../assets/image/plan_defaultimage.jpg',
  `dlgroupid` text,
  `regfee` decimal(16,2) DEFAULT '150.00',
  `expday` varchar(5) DEFAULT '',
  `graceday` tinyint(3) DEFAULT '3',
  `expmbrmovetoid` varchar(32) DEFAULT '',
  `limitref` mediumint(8) DEFAULT '0',
  `ifrollupto` tinyint(1) DEFAULT '1',
  `minref2getcm` varchar(100) DEFAULT '0',
  `cmdayhold` int(4) DEFAULT '0',
  `spillover` tinyint(1) DEFAULT '1',
  `minref4splovr` smallint(5) DEFAULT '0',
  `spill4ver` tinyint(1) DEFAULT '0',
  `matrixfillopt` tinyint(1) DEFAULT '0',
  `matrixcompression` tinyint(1) DEFAULT '1',
  `isrecycling` tinyint(1) DEFAULT '0',
  `recyclingto` tinyint(1) DEFAULT '0',
  `recyclingcm` text,
  `cmdrlist` text,
  `cmatchdrlist` text,
  `cmlist` text,
  `cmatchlist` text,
  `rwlist` text,
  `mbrpoint` float DEFAULT '0',
  `sprpointlist` text,
  `planstatus` tinyint(1) DEFAULT '1',
  `plantorder` int(12) DEFAULT '0',
  `avalpaygates` text,
  `customplan` text,
  `plantoken` text,
  `paymupdate` datetime DEFAULT '2000-01-01 00:00:01',
  PRIMARY KEY (`ppid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_points`
--

DROP TABLE IF EXISTS `netw_points`;
CREATE TABLE IF NOT EXISTS `netw_points` (
  `poid` int(12) NOT NULL AUTO_INCREMENT,
  `podatetm` datetime DEFAULT '2000-01-01 00:00:01',
  `popoint` float DEFAULT '0',
  `pomemo` text,
  `pofromid` int(12) DEFAULT '0',
  `potoid` int(12) DEFAULT '0',
  `postatus` tinyint(1) DEFAULT '0',
  `potype` tinyint(1) DEFAULT '0',
  `poppid` int(12) DEFAULT '0',
  `potoken` text,
  `poadminfo` text,
  PRIMARY KEY (`poid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `netw_sessions`
--

DROP TABLE IF EXISTS `netw_sessions`;
CREATE TABLE IF NOT EXISTS `netw_sessions` (
  `sesid` int(11) NOT NULL AUTO_INCREMENT,
  `sestype` varchar(7) DEFAULT '',
  `seskey` varchar(191) NOT NULL DEFAULT '',
  `sestime` int(10) UNSIGNED DEFAULT '0',
  `sesdata` varchar(191) DEFAULT '',
  `sestoken` text,
  PRIMARY KEY (`sesid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `netw_sessions`
--

INSERT INTO `netw_sessions` (`sesid`, `sestype`, `seskey`, `sestime`, `sesdata`, `sestoken`) VALUES
(8, 'admin', '$2y$10$1.Dz/.p.InaTjvPOKEfonOI9WrkJAf66Kl6mcVA3XBwdJsSBIz0vK', 1588276677, '|un:admin|, |ip:::1|', NULL),
(9, 'admin', '$2y$10$g4H/Cx2FvttawEZyZ9eJeOBDipxc/ls2ijkT/4bib35fcVdHceWGq', 1588276829, '|un:admin|, |ip:::1|', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `netw_transactions`
--

DROP TABLE IF EXISTS `netw_transactions`;
CREATE TABLE IF NOT EXISTS `netw_transactions` (
  `txid` int(12) NOT NULL AUTO_INCREMENT,
  `txdatetm` datetime DEFAULT '2000-01-01 00:00:01',
  `txpaytype` varchar(32) DEFAULT '',
  `txfromid` int(12) DEFAULT '0',
  `txtoid` int(12) DEFAULT '0',
  `txamount` decimal(16,2) DEFAULT '0.00',
  `txmemo` text,
  `txbatch` varchar(128) DEFAULT '',
  `txtmstamp` varchar(32) DEFAULT '',
  `txinvid` varchar(32) DEFAULT '',
  `txppid` int(12) DEFAULT '0',
  `txstatus` tinyint(1) DEFAULT '0',
  `txtoken` text,
  `txadminfo` text,
  PRIMARY KEY (`txid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;
