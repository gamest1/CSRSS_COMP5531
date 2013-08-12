-- MySQL dump 10.13  Distrib 5.1.66, for pc-linux-gnu (i686)
--
-- Host: clipper.encs.concordia.ca    Database: kxc55311
-- ------------------------------------------------------
-- Server version	5.1.66

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Admission`
--

DROP TABLE IF EXISTS `Admission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admission` (
  `date` date NOT NULL,
  `medicareNumber` varchar(20) NOT NULL,
  `assignedDoctor` int(5) NOT NULL,
  `reasonForAdmission` varchar(40) DEFAULT NULL,
  `dateAdmitted` date DEFAULT NULL,
  `dateDischarged` date DEFAULT NULL,
  PRIMARY KEY (`date`,`medicareNumber`,`assignedDoctor`),
  KEY `assignedDoctor` (`assignedDoctor`),
  KEY `medicareNumber` (`medicareNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admission`
--

LOCK TABLES `Admission` WRITE;
/*!40000 ALTER TABLE `Admission` DISABLE KEYS */;
INSERT INTO `Admission` VALUES ('2013-04-01','SMIJ2342344',655,'Heart Attack','2013-04-01','2013-04-05'),('2011-10-25','SMIJ2342344',655,'Heart Attack','2011-10-25','2011-10-30'),('2011-09-13','DONJ2342344',8205,'appendicitis','2011-09-13','2011-09-15'),('2012-02-13','JOHE2342344',8205,'umbilical hernia','2012-02-19','2012-02-20'),('2012-04-13','WILJ2342344',1001,'kidney infection','2012-04-14','2012-04-19'),('2012-06-18','JONP2342344',1160,'liver infection','2012-06-18','2012-06-22'),('2011-10-17','WHIP2342344',7730,'back tumour','2011-10-25','2011-10-28'),('2013-01-13','WHIP2342344',7790,'stomach tumour','2013-01-19','2013-01-28'),('2013-02-13','WILK2342344',701,'Trichomoniasis','2013-02-13','2013-02-15'),('2013-03-18','THOJ2342344',770,'Candidiasis','2013-03-18','2013-03-19');
/*!40000 ALTER TABLE `Admission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Computer`
--

DROP TABLE IF EXISTS `CSRSS_Computer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Computer` (
  `partID` varchar(10) NOT NULL,
  `processor` varchar(20) NOT NULL,
  `os` varchar(20) NOT NULL,
  `antivirus` varchar(40) DEFAULT NULL,
  `RAM_in_MB` int(5) DEFAULT NULL,
  `memory_specs` varchar(20) NOT NULL,
  `GB` int(5) DEFAULT NULL,
  `storage_specs` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `otherInfo` text,
  PRIMARY KEY (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Computer`
--

LOCK TABLES `CSRSS_Computer` WRITE;
/*!40000 ALTER TABLE `CSRSS_Computer` DISABLE KEYS */;
INSERT INTO `CSRSS_Computer` VALUES ('10238822','AMD A8-5500','Windows 8','PC-cillinc Internet Security',4000,'1600MHz DDR3',1000,'7200 RPM','desktop','Loaded Software: Nero 9 Essentials; Microsoft Pack; Adobe Reader; Skype; FreshPaint; WIN8 UI Games; ASUS AI-SUITE II; ASUS AI Manager; ASUS My Logo2; ASUS Update; ASUS Q-fan; ASUS@Vibe; ASUS AI Charger; ASUS WebStorage; ASUS Music Maker'),('10238369','AMD A10 5700','Windows 8',NULL,12000,'DDR3 SDRAM',1000,'7200 RPM','desktop','Adobe Reader; Acer Recovery Management; Nero Essentials; Clear.fi Media; Clear.fi Photo; AcerCloud Docs'),('10238327','Intel Core i7-3770','Windows 8',NULL,12000,'1600 MHz DDR3',2000,'7200 RPM','desktop','HP Support Assistant; HP Connected Music; HP Recovery Manager'),('10238330','Intel Core i3-3220','Windows 8','Esteban New Antivirus',12000,'1600 MHz DDR3',1000,'7200 RPM','desktop','HP Support Assistant; HP Connected Music; HP Recovery Manager; License for Esteban antivirus included.'),('10257006','Intel Core i7-4700MQ','Windows 8','Norton Internet Security (Trial)',16000,'DDR3',1000,'5400 rpm','laptop','TOSHIBA Value Added Software; Intel App Up Center; Amazon; Evernote; Skype; Norton Studio (Trial); WildTangent; Microsoft Office (Trial)'),('10227480','Intel Pentium 987','Windows 8',NULL,4000,'DDR3',500,'5400 rpm','laptop','ASUS SmartLogon; ASUS Face Logon; ASUS Life Frame III; Virtual Camera; ASUS Live Update; Power4Gear Hybrid; Asus WebStorage; Windows Live4 Package; ASUS Vibe; ASUS AIRecovery; ASUS Colour Enhancement; Instant On; USB Charger+'),('10255117','Intel Core i5-4200U','Windows 8','Kaspersky Internet Security 2013',8000,'DDR3 SDRAM',128,'SSD','laptop','Skype; Socialife; ArtRage Studio; Music By Sony; PlayMemories Home; Album By Sony; VAIO Gesture Control; Adobe Reader; VAIO Care;'),('10253402','Intel Core i5-3337U','Windows 8',NULL,8000,'DDR3L SDRAM',750,'5400 rpm','laptop','Imagination Studio; PlayMemories Home; Art Rage Studio; Sony Media; VAIO Movie Creator; SocialLife');
/*!40000 ALTER TABLE `CSRSS_Computer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_DefaultCost`
--

DROP TABLE IF EXISTS `CSRSS_DefaultCost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_DefaultCost` (
  `service_type` varchar(10) NOT NULL,
  `default_cost` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_DefaultCost`
--

LOCK TABLES `CSRSS_DefaultCost` WRITE;
/*!40000 ALTER TABLE `CSRSS_DefaultCost` DISABLE KEYS */;
INSERT INTO `CSRSS_DefaultCost` VALUES ('sale',0),('online',0),('repair',30),('upgrade',15);
/*!40000 ALTER TABLE `CSRSS_DefaultCost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_DesktopComputer`
--

DROP TABLE IF EXISTS `CSRSS_DesktopComputer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_DesktopComputer` (
  `partID` varchar(10) NOT NULL,
  `enclosure` varchar(40) DEFAULT NULL,
  `power_unit` varchar(20) DEFAULT NULL,
  `mother_board` varchar(40) DEFAULT NULL,
  `monitor` varchar(20) DEFAULT NULL,
  `mouse` varchar(20) DEFAULT NULL,
  `keyboard` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_DesktopComputer`
--

LOCK TABLES `CSRSS_DesktopComputer` WRITE;
/*!40000 ALTER TABLE `CSRSS_DesktopComputer` DISABLE KEYS */;
INSERT INTO `CSRSS_DesktopComputer` VALUES ('10238822','Black, 17.3x36x40cm, 7.9kg',NULL,NULL,'NO','Optical','Full-Size'),('10238369','Black, 10.2x26.7x35.3cm, 5.44kg',NULL,NULL,'NO','Optical','Acer USB'),('10238327','Black, 17.5x41.5x41.2cm, 12kg',NULL,'3 PCIExpressx1; 1 PCIExpressx16','NO','Optical','USB Keyboard'),('10238330','Black, 16.5x16.8x37.6cm, 8kg',NULL,'3 PCIExpressx1; 1 PCIExpressx16','NO','Optical','USB Keyboard');
/*!40000 ALTER TABLE `CSRSS_DesktopComputer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Devices`
--

DROP TABLE IF EXISTS `CSRSS_Devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Devices` (
  `d_name` varchar(40) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `owner` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`d_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Devices`
--

LOCK TABLES `CSRSS_Devices` WRITE;
/*!40000 ALTER TABLE `CSRSS_Devices` DISABLE KEYS */;
INSERT INTO `CSRSS_Devices` VALUES ('John McDowell iPhone 5','White 36GB on Rogers','John McDowell'),('Mike Drupal Mac Mini','2007, 128GB with a scratch on top','Mike Drupal'),('Jababo Khaled\'s Super Computer','2013, 4TB Mac Pro','Jababo Khaled'),('Esteban Ubuntu Machine','My small home server','Esteban Garro');
/*!40000 ALTER TABLE `CSRSS_Devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Employees`
--

DROP TABLE IF EXISTS `CSRSS_Employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Employees` (
  `employeeID` int(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `online_fee` int(2) NOT NULL DEFAULT '50',
  `service_fee` int(2) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `first_day_of_work` date NOT NULL,
  `base_salary` int(6) NOT NULL DEFAULT '22000',
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`employeeID`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Employees`
--

LOCK TABLES `CSRSS_Employees` WRITE;
/*!40000 ALTER TABLE `CSRSS_Employees` DISABLE KEYS */;
INSERT INTO `CSRSS_Employees` VALUES (10000,'egarro',50,18,1,'Esteban','Garro','2011-11-28',32000,'5598 Avenue Decelles. Montreal, QC. H3T1W5. CANADA','5146793774'),(10100,'j.clerk1',50,10,0,'John','Clerk1','2012-12-20',22000,'360 St. Patrick Street. Montreal, QC. H8Y2T5. CANADA','5143774666'),(10200,'m.clerk2',50,10,0,'Mike','Clerk2','2013-05-02',22000,'5760 Ste. Catherine. Montreal, QC. H722E5. CANADA','5148893776'),(12345,'jAdmin',20,10,1,'John','Admin','2013-08-01',30000,NULL,'5143352552');
/*!40000 ALTER TABLE `CSRSS_Employees` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`kxc55311`@`132.205.%.%`*/ /*!50003 trigger defaultServiceFeeTrigger 
before insert on CSRSS_Employees
for each row
begin
    if AGE(NEW.first_day_of_work) < 1 THEN 
set NEW.service_fee = 10;
    elseif AGE(NEW.first_day_of_work) < 2 THEN 
set NEW.service_fee = 15;
    elseif AGE(NEW.first_day_of_work) < 3 THEN 
set NEW.service_fee = 20;
    elseif AGE(NEW.first_day_of_work) < 4 THEN 
set NEW.service_fee = 25;
    else 
set NEW.service_fee = 30;
    end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `CSRSS_Inventory`
--

DROP TABLE IF EXISTS `CSRSS_Inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Inventory` (
  `partID` varchar(10) NOT NULL,
  `numberSold` int(10) DEFAULT '0',
  `numberAvailable` int(5) NOT NULL,
  `whole_price` decimal(7,2) NOT NULL,
  PRIMARY KEY (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Inventory`
--

LOCK TABLES `CSRSS_Inventory` WRITE;
/*!40000 ALTER TABLE `CSRSS_Inventory` DISABLE KEYS */;
INSERT INTO `CSRSS_Inventory` VALUES ('10200651',1,4,'0.99'),('10211037',6,9,'2.50'),('10212684',0,15,'39.99'),('10217738',1,4,'19.50'),('10219113',0,5,'25.50'),('10221081',1,4,'69.99'),('10221082',0,3,'69.99'),('10227480',0,8,'301.64'),('10238282',0,3,'30.00'),('10238327',0,3,'690.00'),('10238330',5,13,'400.15'),('10238369',0,15,'280.50'),('10238822',0,8,'305.05'),('10243751',0,8,'34.65'),('10243754',0,1,'59.52'),('10253402',2,6,'630.20'),('10255117',0,6,'810.05'),('10257006',0,1,'830.25');
/*!40000 ALTER TABLE `CSRSS_Inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_LaptopComputer`
--

DROP TABLE IF EXISTS `CSRSS_LaptopComputer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_LaptopComputer` (
  `partID` varchar(10) NOT NULL,
  `screen_size` varchar(20) DEFAULT NULL,
  `battery_life` int(2) DEFAULT NULL,
  `battery_specs` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_LaptopComputer`
--

LOCK TABLES `CSRSS_LaptopComputer` WRITE;
/*!40000 ALTER TABLE `CSRSS_LaptopComputer` DISABLE KEYS */;
INSERT INTO `CSRSS_LaptopComputer` VALUES ('10257006','15.6\"',4,'Lithium-Ion (Prismatic)'),('10227480','11.6&#34;',5,'Lithium-Polymer'),('10255117','13.3&#34;',3,'Lithium-Ion'),('10253402','15.5\"',4,'Lithium-Ion');
/*!40000 ALTER TABLE `CSRSS_LaptopComputer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_OnlineSales`
--

DROP TABLE IF EXISTS `CSRSS_OnlineSales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_OnlineSales` (
  `serviceID` int(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `date_shipped` date DEFAULT NULL,
  PRIMARY KEY (`serviceID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_OnlineSales`
--

LOCK TABLES `CSRSS_OnlineSales` WRITE;
/*!40000 ALTER TABLE `CSRSS_OnlineSales` DISABLE KEYS */;
INSERT INTO `CSRSS_OnlineSales` VALUES (1012,'Edmonton','AB','Canada','#307-10707-82Ave. T6G1V5','2013-08-12'),(1013,'Calgary','AB','Canada','1007-3rd Street NW. T6W1H4','2013-08-16');
/*!40000 ALTER TABLE `CSRSS_OnlineSales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Parts`
--

DROP TABLE IF EXISTS `CSRSS_Parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Parts` (
  `partID` varchar(10) NOT NULL,
  `partName` varchar(70) NOT NULL,
  `description` text,
  `part_type` varchar(10) NOT NULL,
  `cost` decimal(7,2) NOT NULL,
  `installation_cost` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Parts`
--

LOCK TABLES `CSRSS_Parts` WRITE;
/*!40000 ALTER TABLE `CSRSS_Parts` DISABLE KEYS */;
INSERT INTO `CSRSS_Parts` VALUES ('10238822','ASUS CM1435-CA002S Desktop Computer','Featuring an accelerated AMD A8 processor and 4GB of system memory, the ASUS CM1435 PC is a solid desktop performer. It\'s also equipped with QuietCool technology to reduce internal temperatures even when running at full-bore. Other features include 6 USB ports, a DVD drive, and AMD integrated graphics.','desktop','407.49',0),('10238369','Acer AX3-100-EF10 Desktop Computer','The Acer AX3-100-EF10 desktop machine is a dynamic and sleek entertainment centre that\'s smaller than a normal PC. It houses an AMD A10 processor and 12GB system memory for fast and efficient performance. Other features include HDMI connectivity, 10 USB ports including 4 SuperSpeed USB 3.0 ports, and Windows 8.','desktop','457.49',0),('10238327','HP Envy H8-1549 Desktop Computer','Equipped with a second-generation Intel Core i7 processor, 12GB system memory, and an AMD Radeon HD 7570 graphics card, the HP H8-1549 desktop is the ultimate entertainment machine. Loaded with these impressive specs and many features, it\'s able to take on just about anything you can throw at it.','desktop','887.49',0),('10238330','HP Pavilion P6-2419 Desktop Computer','The HP P6-2419 Pavilion offers robust performance for your home. From book reports to entertainment, this desktop has the features and specs to handle it all. Inside is an Intel Core i3 processor with 4GB system memory. SuperSpeed USB 3.0 ports keep you connected with the latest and greatest peripherals. Other features include 7.1-channel sound capabilities, Wi-Fi, and more.','desktop','467.49',0),('10257006','Toshiba Satellite P50 15.6in Laptop','This Toshiba Satellite P50 laptop packs top-tier features to deliver relentless performance in everything you do. It\'s home to a fourth-generation Intel Core i7 processor, 16GB system memory, dedicated NVIDIA GeForce graphics, and more. It\'s designed to let you take on the most demanding tasks, play the latest games, and enjoy the best in digital entertainment.','laptop','1021.64',0),('10227480','ASUS X Series X202E 11.6in Touchscreen L','The ASUS X202E 11.6in laptop is a great way to enjoy the versatile power of Windows 8 in a design that\'s so compact and lightweight it\'s easy to take with you everywhere. The display is touchscreen-enabled so you\'ll be able to enjoy the touch-optimized Windows 8 user interface and the 500GB hard drive provides plenty of space for all of your photos, videos, music, and other files.','laptop','501.64',0),('10255117','Sony VAIO Pro 13 13.3in Ultrabook','Crafted from ultra-light carbon fiber, the Sony VAIO SVP13215CDB Pro 13 Ultrabook sets a new standard in power to weight ratios. Beyond the Full HD TRILUMINOS touchscreen display is the robust Intel Core i5 processor, 8GB of RAM, a 128GB SSD, and all the latest connectivity options. This machine is proof that you need not sacrifice power for mobility.','laptop','1211.64',0),('10253402','Sony VAIO Fit 15.5in Laptop','The Sony VAIO Fit 15 SVF15A13CDB laptop delivers solid, reliable, and fast performance in a stunning device. Beyond the polished aluminum lid is a 15.5-inch Full HD touchscreen display, an Intel Core i5 processor, built-in NFC technology, and so much more. From gaming to being more productive, this head-turning mobile device does it all.','laptop','851.64',0),('10221081','Green LeapFrog LeapPad2 Explorer Learnin','The LeapPad2 Explorer is a tablet designed to help your kids learn through play. It encourages your children to learn and explore with 4GB of memory, front and back cameras and video recorders, and a library of over 325 cartridges and downloadable apps, including games, eBooks, videos, creativity apps, and more.\n','hardware','89.99',0),('10221082','Pink LeapFrog LeapPad2 Explorer Learning','The LeapPad2 Explorer is a tablet designed to help your kids learn through play. It encourages your children to learn and explore with 4GB of memory, front and back cameras and video recorders, and a library of over 325 cartridges and downloadable apps, including games, eBooks, videos, creativity apps, and more.','hardware','89.99',0),('10212684','VTech Innotab 2','Learning is made fun with the Vtech InnoTab 2. This Learning App Tablet features a built-in camera that shoots both pics and video. And, with access to hundreds of different apps to download, it makes learning something they\'ll look forward to. Other features include 2GB on board memory (expandable to 16GB with SD card), a 5-inch screen, media player, and customizable settings.','hardware','69.99',0),('10200651','Dynex 4\" 3.5mm Coiled Stereo Audio Cable (DX-DCAUX) - Black','Connect your MP3 player or other devices with a 3.5mm input jack to car stereos, speaker docks and more with this Dynex DX-DCAUX 4\' 3.5mm coiled stereo audio cable that features nickel-plated connectors for a durable design.','hardware','2.99',0),('10211037','Startech 15ft Slim Stereo Audio Cable (MU15MMS)','This 15-foot 3.5mm Slim Stereo Audio Cable is the perfect solution for portable audio devices (iPod, iPhone,iPad,MP3 Players), featuring a slim connector molding that easily fits into a 3.5mm headphone jack, even if the iPod/iPhone/MP3 player is in a protective case.','hardware','6.98',0),('10243754','Crucial 8GB DDR3 1600MHz Laptop Memory For Mac (CT8G3S160BM)','The Crucial 8GB DDR3 memory for Mac lets you improve your computer\'s performance. It\'s thoroughly tested at both the component and module levels to meet and exceed even Apple\'s quality requirements.','hardware','79.99',0),('10243751','Crucial 4GB DDR3 1600MHz Laptop Memory For Mac (CT4G3S160BM)','The Crucial 4GB DDR3 memory for Mac lets you improve your computer\'s performance. It\'s thoroughly tested at both the component and module levels to meet and exceed even Apple\'s quality requirements.','hardware','44.99',0),('10217738','McAfee Internet Security 2013 - 3 Users','McAfee Internet Security 2013 makes it easier to surf, shop, bank, and connect online without worrying about compromising your personal data. It keeps your information safe with powerful background scans and even shows you colour-coded search results so you can weed out unsafe sites. Increase your security more by automatically blocking pop ups that might contain malicious software.','software','29.99',10),('10219113','Norton Internet Security 2013 - 3 Users','Norton Internet Security gives you total protection from just about any type of online threat, so you can surf, shop, and do whatever you want online with total confidence. In addition to incredible security, it\'s home to an array of smart and convenient features that allow you to manage it from almost anywhere, and it runs quietly and efficiently in the background of your PC.','software','49.99',10),('10238282','ESET NOD32 Antivirus v6 2013 Edition - 3 User (PC)','With award-winning credentials ESET NOD32 Antivirus 6 offers robust protection from viruses, works, rootkits, phishing, and other online threats. Innovative technology lets you explore the web confidently, protected from viruses, hackers and fake websites looking to steal your identity. Use USB thumb drives, CD/DVDs and external drives without worrying about infected files.','software','59.99',10);
/*!40000 ALTER TABLE `CSRSS_Parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Payments`
--

DROP TABLE IF EXISTS `CSRSS_Payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Payments` (
  `employeeID` int(5) NOT NULL,
  `period_start_on` date NOT NULL,
  `period_finish_on` date NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `payment_code` int(4) DEFAULT NULL,
  `paid_on` date DEFAULT NULL,
  PRIMARY KEY (`employeeID`,`period_start_on`,`period_finish_on`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Payments`
--

LOCK TABLES `CSRSS_Payments` WRITE;
/*!40000 ALTER TABLE `CSRSS_Payments` DISABLE KEYS */;
INSERT INTO `CSRSS_Payments` VALUES (10000,'2013-07-14','2013-07-27','6.75',1236,'2013-08-06'),(10000,'2013-06-30','2013-07-13','0.00',1234,'2013-08-06'),(10000,'2013-06-16','2013-06-29','0.00',1235,'2013-08-06'),(10000,'2013-07-28','2013-08-05','4.50',1237,'2013-08-06'),(10100,'2013-07-28','2013-08-10','0.00',NULL,NULL);
/*!40000 ALTER TABLE `CSRSS_Payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_PurchaseHistory`
--

DROP TABLE IF EXISTS `CSRSS_PurchaseHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_PurchaseHistory` (
  `partID` varchar(10) NOT NULL,
  `purchase_date` date NOT NULL,
  `units` int(5) NOT NULL DEFAULT '0',
  `unit_price` decimal(7,2) NOT NULL,
  KEY `partID` (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_PurchaseHistory`
--

LOCK TABLES `CSRSS_PurchaseHistory` WRITE;
/*!40000 ALTER TABLE `CSRSS_PurchaseHistory` DISABLE KEYS */;
INSERT INTO `CSRSS_PurchaseHistory` VALUES ('10200651','2013-01-01',5,'0.99'),('10211037','2013-01-01',5,'4.00'),('10212684','2013-01-01',5,'39.99'),('10217738','2013-01-01',5,'19.50'),('10219113','2013-01-01',5,'25.50'),('10221081','2013-01-01',5,'69.99'),('10221082','2013-01-01',3,'69.99'),('10227480','2013-01-01',3,'301.64'),('10238282','2013-01-01',3,'30.00'),('10238327','2013-01-01',3,'690.00'),('10238330','2013-01-01',15,'400.15'),('10238369','2013-01-01',15,'280.50'),('10238822','2013-01-01',8,'305.05'),('10243751','2013-01-01',8,'34.65'),('10243754','2013-01-01',1,'59.52'),('10253402','2013-01-01',8,'630.20'),('10255117','2013-01-01',6,'810.05'),('10257006','2013-01-01',1,'830.25'),('10238330','2013-08-04',3,'400.15'),('10227480','2013-08-05',5,'301.64'),('10212684','2013-08-10',10,'39.99'),('10211037','2013-08-10',10,'2.50');
/*!40000 ALTER TABLE `CSRSS_PurchaseHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Sales`
--

DROP TABLE IF EXISTS `CSRSS_Sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Sales` (
  `serviceID` int(10) NOT NULL,
  `partID` varchar(10) NOT NULL,
  `isFinal` tinyint(1) DEFAULT '0',
  `isOnline` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`serviceID`),
  KEY `partID` (`partID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Sales`
--

LOCK TABLES `CSRSS_Sales` WRITE;
/*!40000 ALTER TABLE `CSRSS_Sales` DISABLE KEYS */;
INSERT INTO `CSRSS_Sales` VALUES (1011,'10211037',0,0),(1004,'10217738',0,0),(1006,'10221081',0,0),(1007,'10211037',0,0),(1008,'10200651',0,0),(1012,'10253402',0,1),(1013,'10253402',0,1),(1014,'10211037',0,0),(1015,'10211037',0,0),(1016,'10211037',0,0),(1017,'10211037',0,0);
/*!40000 ALTER TABLE `CSRSS_Sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Services`
--

DROP TABLE IF EXISTS `CSRSS_Services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Services` (
  `serviceID` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `employeeID` int(5) DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `total_amount_paid` decimal(7,2) DEFAULT NULL,
  `paid_to_employee` decimal(7,2) NOT NULL DEFAULT '0.00',
  `store_revenue` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`serviceID`),
  KEY `employeeID` (`employeeID`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=1018 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Services`
--

LOCK TABLES `CSRSS_Services` WRITE;
/*!40000 ALTER TABLE `CSRSS_Services` DISABLE KEYS */;
INSERT INTO `CSRSS_Services` VALUES (1003,'2013-07-18','repair',10000,'The fan is not working. Getting it fix.','30.00','4.50','25.50'),(1004,'2013-07-18','sale',10000,'Upgrading antivirus for Ubuntu. Hehe.','29.99','0.00','10.49'),(1005,'2013-07-18','upgrade',10000,'Upgrading antivirus for Ubuntu. Hehe.','15.00','2.25','12.75'),(1006,'2013-07-18','sale',10000,'Selling this also for Esteban\'s kid.','89.99','0.00','20.00'),(1007,'2013-08-04','sale',10000,'','6.98','0.00','2.98'),(1008,'2013-08-04','sale',10100,'First sale.','2.99','0.00','2.00'),(1009,'2013-08-05','repair',10000,'John brought his iPhone in to repair the Home Button.','30.00','4.50','25.50'),(1010,'2013-08-06','repair',10000,'Some quick fix to the WiFi antenna.','50.00','7.50','42.50'),(1011,'2013-08-10','sale',10000,'Nothing especial.','6.98','0.00','2.98'),(1012,'2013-08-10','sale',10000,'First online sale processed','851.64','110.72','110.72'),(1013,'2013-08-10','sale',12345,'First online sale for me.','851.64','44.29','177.15'),(1014,'2013-08-10','sale',10000,'This wires are selling fast.','6.98','0.00','2.98'),(1015,'2013-08-10','sale',10000,'Our best selling product again.','6.98','0.00','2.98'),(1016,'2013-08-10','sale',10100,'First sale of the day.','6.98','0.00','2.98'),(1017,'2013-08-10','sale',10100,'Opening this new batch or cables.','6.98','0.00','4.48');
/*!40000 ALTER TABLE `CSRSS_Services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_UpgradesRepairs`
--

DROP TABLE IF EXISTS `CSRSS_UpgradesRepairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_UpgradesRepairs` (
  `serviceID` int(10) NOT NULL,
  `d_name` varchar(40) NOT NULL,
  `type` varchar(10) NOT NULL,
  `number_of_hours` int(3) DEFAULT NULL,
  PRIMARY KEY (`serviceID`),
  KEY `d_name` (`d_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_UpgradesRepairs`
--

LOCK TABLES `CSRSS_UpgradesRepairs` WRITE;
/*!40000 ALTER TABLE `CSRSS_UpgradesRepairs` DISABLE KEYS */;
INSERT INTO `CSRSS_UpgradesRepairs` VALUES (1003,'Esteban Ubuntu Machine','repair',0),(1005,'Esteban Ubuntu Machine','upgrade',0),(1009,'John McDowell iPhone 5','repair',0),(1010,'Mike Drupal Mac Mini','repair',0);
/*!40000 ALTER TABLE `CSRSS_UpgradesRepairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSRSS_Users`
--

DROP TABLE IF EXISTS `CSRSS_Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSRSS_Users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL DEFAULT 'ff30ed93e51d2ac18637c07ed340a636',
  `last_login` date DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSRSS_Users`
--

LOCK TABLES `CSRSS_Users` WRITE;
/*!40000 ALTER TABLE `CSRSS_Users` DISABLE KEYS */;
INSERT INTO `CSRSS_Users` VALUES ('egarro','4ef733196b0c6a0e5750243a83c3545d','2013-08-12'),('j.clerk1','ff30ed93e51d2ac18637c07ed340a636','2013-08-11'),('m.clerk2','ff30ed93e51d2ac18637c07ed340a636',NULL),('jAdmin','0ce035e02eec829ceee9083b75a7980b','2013-08-10');
/*!40000 ALTER TABLE `CSRSS_Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Department`
--

DROP TABLE IF EXISTS `Department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Department` (
  `did` int(5) NOT NULL,
  `deptName` varchar(20) NOT NULL,
  `administrator` int(5) NOT NULL,
  `numberOfBeds` int(5) NOT NULL,
  PRIMARY KEY (`did`),
  KEY `administrator` (`administrator`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Department`
--

LOCK TABLES `Department` WRITE;
/*!40000 ALTER TABLE `Department` DISABLE KEYS */;
INSERT INTO `Department` VALUES (10005,'Cardiology',400,80),(20008,'Surgery',8200,100),(30048,'Gynaecology',701,200),(41008,'Microbiology',1001,10),(50408,'Neurology',3150,5),(70028,'Oncology',7730,50);
/*!40000 ALTER TABLE `Department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Doctor`
--

DROP TABLE IF EXISTS `Doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Doctor` (
  `eid` int(5) NOT NULL,
  `specialty` varchar(20) DEFAULT NULL,
  `visitor_fee` decimal(5,2) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  KEY `eid` (`eid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Doctor`
--

LOCK TABLES `Doctor` WRITE;
/*!40000 ALTER TABLE `Doctor` DISABLE KEYS */;
INSERT INTO `Doctor` VALUES (400,'Heart Infections','100.25','150000.00'),(410,'Heart Arrhythmia','100.00','120000.00'),(8200,'General Surgery','25.00','80000.00'),(8205,'Knee Surgery','25.00','90000.00'),(701,'Yeast Infections','15.00','50000.00'),(770,'HIV','55.00','180000.00'),(1001,'Bacterial Trasmissio','5.00','75000.00'),(1160,'Immune System','25.00','82000.00'),(3150,'Brain Tumors','75.00','182000.00'),(3280,'Cerebral Hypoxia','75.00','185000.00'),(7730,'Dermatofibrosarcomas','3.00','112000.00'),(7790,'Liver Cancer','30.00','122000.00'),(7740,'Lung Cancer','30.00','95000.00'),(655,'Heart Fibrosis','50.00','60000.00');
/*!40000 ALTER TABLE `Doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employee` (
  `eid` int(5) NOT NULL,
  `did` int(5) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `jobTitle` varchar(20) NOT NULL,
  `startDate` date DEFAULT NULL,
  `lastDate` date DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `phone#` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`eid`),
  KEY `did` (`did`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (400,10005,'John','Perez','Chair','2010-12-31',NULL,'Male','1968-11-05','5149896532','john.perez@myhospital.com',NULL),(410,10005,'Michael','Suarez','Head','2008-09-25',NULL,'Male','1972-10-05','5149346532','m.suarez@myhospital.com',NULL),(8200,20008,'Sebastian','Mendez','Chair','2005-12-15',NULL,'Male','1968-10-05','5149896532','s.mendez@myhospital.com',NULL),(8205,20008,'Bertha','Mathis','Head','2002-12-13',NULL,'Female','1968-11-09','5149896532','b.mathis@myhospital.com',NULL),(701,30048,'Juan','Pena','Chair','2001-12-11',NULL,'Male','1968-11-05','5149896532','j.pena@myhospital.com',NULL),(770,30048,'Maria','Rubio','Head','1997-12-04',NULL,'Female','1938-11-05','5143246532','m.rubio@myhospital.com',NULL),(1001,41008,'Carlos','Turcotte','Head','1995-12-07',NULL,'Male','1928-11-05','5141236532','carlos.t@myhospital.com',NULL),(1160,41008,'Esteban','Gardie','Chair','1936-12-17','2012-12-31','Male','1901-11-05','5140896532','esteban.gardie@myhospital.com',NULL),(3150,50408,'Tony','Cheng','Head','1946-12-31','2013-12-24','Male','1910-11-05','5147896532','tony.cheng@myhospital.com',NULL),(3280,50408,'Genevieve','Munoz','Chair','1979-12-22',NULL,'Female','1950-11-05','5143456532','g.munoz@myhospital.com',NULL),(7730,70028,'David','Engel','Head','1968-12-14',NULL,'Male','1930-11-05','5149896355','d.engel@myhospital.com',NULL),(7790,70028,'Roberto','Caputo','Chair','0000-00-00',NULL,'Male','1928-11-05','5143456532','r.caputo@myhospital.com',NULL),(7740,70028,'Colin','Anderson','Auxiliar','1985-12-31',NULL,'Male','1955-11-05','5144596532','c.anderson@myhospital.com',NULL),(655,10005,'Axel','Gordon','Auxiliar','2007-02-03',NULL,'Male','1980-11-05','5149893432','axel.gordon@myhospital.com','Montreal');
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Lab`
--

DROP TABLE IF EXISTS `Lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lab` (
  `labName` varchar(20) NOT NULL,
  `did` int(5) NOT NULL,
  `budget` decimal(12,2) NOT NULL,
  PRIMARY KEY (`labName`),
  KEY `did` (`did`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lab`
--

LOCK TABLES `Lab` WRITE;
/*!40000 ALTER TABLE `Lab` DISABLE KEYS */;
/*!40000 ALTER TABLE `Lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Nurse`
--

DROP TABLE IF EXISTS `Nurse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Nurse` (
  `eid` int(5) NOT NULL,
  `hours_per_week` int(2) DEFAULT NULL,
  KEY `eid` (`eid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Nurse`
--

LOCK TABLES `Nurse` WRITE;
/*!40000 ALTER TABLE `Nurse` DISABLE KEYS */;
INSERT INTO `Nurse` VALUES (655,80),(7740,50);
/*!40000 ALTER TABLE `Nurse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Patient`
--

DROP TABLE IF EXISTS `Patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Patient` (
  `medicareNumber` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `phone#` varchar(10) DEFAULT NULL,
  `civicNumber` varchar(6) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `postalCode` varchar(10) DEFAULT NULL,
  `country` varchar(20) NOT NULL,
  PRIMARY KEY (`medicareNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Patient`
--

LOCK TABLES `Patient` WRITE;
/*!40000 ALTER TABLE `Patient` DISABLE KEYS */;
INSERT INTO `Patient` VALUES ('SMIJ2342344','Jose','Smith','Male','1982-11-28','5146345774','25938','Montreal','H3T1W5','Canada'),('DONJ2342344','Jane','Donovan','Famale','1985-10-13','3456796774','51598','Montreal','V3T1W5','Canada'),('JOHE2342344','Edith','Johnson','Female','1978-11-28','5345796774','598','Mexico City','T3T1W5','Mexico'),('WILJ2342344','Jesus','Williams','Male','1977-09-12','514675674','558','Montreal','M3T1W5','Canada'),('JONP2342344','Pedro','Jones','Male','1974-11-28','5146794567','559','Montreal','J3T1W5','Canada'),('BROR2342344','Rita','Brown','Famale','1973-08-26','1244796774','5598','Montreal','U3T1W5','Canada'),('DAVM2342344','Mike','Davis','Male','1973-08-28','5783496774','55','Montreal','H3T1W5','Canada'),('MILS2342344','Sevan','Miller','Male','1978-07-26','5126796774','35','Montreal','H3T1H5','Canada'),('WILK2342344','Karla','Wilson','Famale','1987-04-28','2146796774','5598','Montreal','H3M1W5','Canada'),('MOON2342344','Nasim','Moore','Male','1986-04-28','4346796774','5598','Moscow','H5T1W5','Rusia'),('TAYK2342344','Krish','Taylor','Male','1956-03-27','5126234774','22','Montreal','H7T1W5','Canada'),('ANDA2342344','Anita','Anderson','Famale','1952-01-28','5146796774','11','Montreal','H3T2W5','Canada'),('THOJ2342344','Joyce','Thomas','Famale','1954-02-28','5146712374','15598','Montreal','H3T5W5','Canada'),('JACT2342344','Tom','Jackson','Male','1955-07-28','5146897774','72','Montreal','Y3T1W5','Canada'),('WHIP2342344','Peter','White','Male','1945-11-23','5126736774','114','Montreal','Y3T1R7','Canada');
/*!40000 ALTER TABLE `Patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Test`
--

DROP TABLE IF EXISTS `Test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Test` (
  `testName` varchar(20) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fromVisitTime` time NOT NULL,
  `fromVisitDate` date NOT NULL,
  `patient` varchar(20) NOT NULL,
  `requestedBy` int(5) NOT NULL,
  PRIMARY KEY (`testName`),
  KEY `fromVisitTime` (`fromVisitTime`),
  KEY `fromVisitDate` (`fromVisitDate`),
  KEY `patient` (`patient`),
  KEY `requestedBy` (`requestedBy`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Test`
--

LOCK TABLES `Test` WRITE;
/*!40000 ALTER TABLE `Test` DISABLE KEYS */;
/*!40000 ALTER TABLE `Test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Visit`
--

DROP TABLE IF EXISTS `Visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Visit` (
  `time` time NOT NULL,
  `date` date NOT NULL,
  `medicareNumber` varchar(20) NOT NULL,
  `doctorID` int(5) NOT NULL,
  `diagnosis` varchar(40) DEFAULT NULL,
  `medicalReport` text,
  PRIMARY KEY (`time`,`date`,`medicareNumber`,`doctorID`),
  KEY `doctorID` (`doctorID`),
  KEY `medicareNumber` (`medicareNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Visit`
--

LOCK TABLES `Visit` WRITE;
/*!40000 ALTER TABLE `Visit` DISABLE KEYS */;
INSERT INTO `Visit` VALUES ('13:56:00','2012-08-13','BROR2342344',770,'Level 1 Anemia','Patient showed up feeling extremely exhausted and dizzy. An liquid exam was performed and found low iron levels. Patient was sent home an prescribed iron pills'),('13:56:00','2011-08-13','DAVM2342344',770,'Level 1 Anemia','Patient showed up feeling extremely exhausted and dizzy. An liquid exam was performed and found low iron levels. Patient was sent home an prescribed iron pills'),('23:26:00','2010-03-13','MILS2342344',1001,'Rash','Patient displays intense abdominal rash'),('04:46:00','2009-04-13','MOON2342344',3150,'Head trauma','Patient fell from ladder. Intense headache after fall.'),('07:46:00','2008-06-13','TAYK2342344',1160,'Eye infection','Patient presents a recurring eye infection. Eye displays intense red color.'),('23:55:00','2011-03-13','ANDA2342344',3280,'Migraine','Continuous migraines for a couple years. First visit looking for some solution.'),('13:56:00','2012-12-13','JACT2342344',8200,'Muscle pain','Patient has sever back and leg pain after skiing trip. Nothing mayor and patient was prescribed Tylenol.'),('14:55:00','2013-05-01','SMIJ2342344',655,'Follow-up','Patient showed up to follow up after recent heart attack. No new problems detected'),('13:52:00','2012-08-13','DONJ2342344',8205,'Follow-up','Normal follow up after appendicitis surgery. Patient recovered well.'),('13:24:00','2012-08-13','JOHE2342344',8205,'Follow-up','Umbilical hernia operation shows some inflammation. Anti-inflamatories where prescribed and patient was sent home'),('03:45:00','2012-08-13','WILJ2342344',1001,'Follow-up','Patient was scheduled for a follow-up appointment after admission for kidney infection. Patient has been feeling well and no signs of further problems.'),('00:12:00','2013-04-25','WHIP2342344',7790,'Follow-up','Patient feels intense itch after back tumour removal. No other complications and patient was sent home'),('18:50:00','2013-05-02','THOJ2342344',770,'Follow-up','Post-candidiasis screening. Everything normal.'),('18:23:00','2012-08-13','DAVM2342344',770,'Level 2 Anemia','Patient has been taking iron pills for about a year. Condition deteriorated and more tests are needed.'),('02:26:00','2011-04-13','MILS2342344',1001,'Rash','Patient features a recursive rash. Rash went away for one year and recently came back.'),('04:46:00','2010-05-13','MOON2342344',3150,'Migraine','Patient noticed a significant increase in intermittent headaches after a head trauma that occurred a year ago.'),('07:46:00','2009-07-18','TAYK2342344',1160,'Ear infection','Patient presents pain in left ear. An examination was conducted and a small infection was found.'),('23:55:00','2012-01-13','ANDA2342344',3280,'Migraine','Patient wishes to change her lithium treatment to something else. Lithium is not reducing migraines.'),('10:56:00','2013-01-13','JACT2342344',8200,'Neck problem','Patient fell while rock-climbing a month ago. Neck pain ever since.'),('09:56:00','2013-06-16','JACT2342344',8200,'Knee fracture','Patient fracture his knee while running.');
/*!40000 ALTER TABLE `Visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as1Clinic`
--

DROP TABLE IF EXISTS `as1Clinic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as1Clinic` (
  `cid` int(5) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as1Clinic`
--

LOCK TABLES `as1Clinic` WRITE;
/*!40000 ALTER TABLE `as1Clinic` DISABLE KEYS */;
INSERT INTO `as1Clinic` VALUES (20001,'Clinic1','Montreal'),(20002,'Clinic2','Toronto'),(20003,'Clinic3','Ottawa'),(20004,'Clinic4','Vancouver'),(20005,'Clinic5','Calgary'),(20006,'Clinic6','Montreal'),(20007,'Clinic7','Toronto'),(20008,'Clinic8','Ottawa'),(20009,'Clinic9','Vancouver'),(20010,'Clinic10','Calgary');
/*!40000 ALTER TABLE `as1Clinic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as1Consults`
--

DROP TABLE IF EXISTS `as1Consults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as1Consults` (
  `pid` int(5) NOT NULL,
  `did` int(5) NOT NULL,
  `cid` int(5) NOT NULL,
  `date` date NOT NULL,
  `illness` varchar(40) NOT NULL,
  PRIMARY KEY (`pid`,`did`,`cid`,`date`),
  KEY `cid` (`cid`),
  KEY `did` (`did`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as1Consults`
--

LOCK TABLES `as1Consults` WRITE;
/*!40000 ALTER TABLE `as1Consults` DISABLE KEYS */;
INSERT INTO `as1Consults` VALUES (30001,40001,20002,'2010-01-05','Back problem'),(30001,40002,20003,'2010-04-15','Back problem'),(30001,40003,20004,'2011-02-18','Muscle problem'),(30001,40004,20005,'2011-08-18','Muscle problem'),(30002,40005,20001,'2012-02-13','Headache'),(30002,40006,20002,'2012-11-13','Headache'),(30003,40007,20003,'2013-01-13','Heart attack'),(30003,40007,20003,'2013-04-13','Heart pain'),(30003,40007,20003,'2013-05-13','Heart pain'),(30004,40008,20009,'2012-03-17','Fever'),(30004,40008,20009,'2012-05-18','Eye problem'),(30005,40009,20010,'2012-08-21','Sleeping problems'),(30005,40009,20010,'2012-08-27','Sleeping problems'),(30005,40010,20006,'2012-11-27','Sleeping problems'),(30005,40010,20006,'2012-12-05','Sleeping problems'),(30006,40001,20003,'2013-01-05','Drug abuse'),(30006,40001,20003,'2013-01-08','Drug abuse'),(30006,40001,20003,'2013-01-13','Drug abuse'),(30006,40002,20004,'2013-02-01','Rehab'),(30006,40002,20004,'2013-02-10','Rehab'),(30007,40003,20005,'2012-02-10','Annual checkup'),(30007,40003,20005,'2012-04-10','Lung problem'),(30007,40003,20005,'2012-06-10','Headache'),(30008,40004,20001,'2011-09-10','Headache'),(30008,40004,20001,'2011-11-11','Migraine'),(30008,40004,20001,'2012-12-11','Migraine'),(30008,40005,20002,'2013-03-03','Migraine'),(30008,40006,20003,'2013-03-05','Migraine'),(30009,40007,20009,'2013-01-01','Heart attack'),(30009,40007,20009,'2013-02-01','Followup'),(30009,40007,20009,'2013-03-01','Followup'),(30010,40008,20010,'2013-03-01','Ear infection'),(30010,40008,20010,'2013-03-25','Eye infection'),(30010,40009,20006,'2013-05-25','Stomach pain'),(30003,40010,20002,'2012-05-25','Stomach pain');
/*!40000 ALTER TABLE `as1Consults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as1Doctor`
--

DROP TABLE IF EXISTS `as1Doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as1Doctor` (
  `did` int(5) NOT NULL,
  `dname` varchar(20) NOT NULL,
  `specialization` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as1Doctor`
--

LOCK TABLES `as1Doctor` WRITE;
/*!40000 ALTER TABLE `as1Doctor` DISABLE KEYS */;
INSERT INTO `as1Doctor` VALUES (40011,'Doctor11','Heart Disease','Montreal'),(40012,'Doctor12','Brain Disease','Toronto'),(40013,'Doctor13','Bone Disease','Ottawa'),(40014,'Doctor14','Bone Disease','Vancouver'),(40015,'Doctor15','Liver Disease','Calgary'),(40016,'Doctor16','Lung Disease','Montreal'),(40017,'Doctor17','Heart Disease','Toronto'),(40018,'Doctor18','Kidney Disease','Ottawa'),(40019,'Doctor19','Brain Disease','Vancouver'),(40020,'Doctor20','Heart Disease','Calgary'),(40001,'Doctor1','Heart Disease','Toronto'),(40002,'Doctor2','Brain Disease','Ottawa'),(40003,'Doctor3','Bone Disease','Vancouver'),(40004,'Doctor4','Bone Disease','Calgary'),(40005,'Doctor5','Liver Disease','Montreal'),(40006,'Doctor6','Lung Disease','Toronto'),(40007,'Doctor7','Heart Disease','Ottawa'),(40008,'Doctor8','Kidney Disease','Vancouver'),(40009,'Doctor9','Brain Disease','Calgary'),(40010,'Doctor10','Heart Disease','Montreal');
/*!40000 ALTER TABLE `as1Doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as1Patient`
--

DROP TABLE IF EXISTS `as1Patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as1Patient` (
  `pid` int(5) NOT NULL,
  `pname` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as1Patient`
--

LOCK TABLES `as1Patient` WRITE;
/*!40000 ALTER TABLE `as1Patient` DISABLE KEYS */;
INSERT INTO `as1Patient` VALUES (30001,'Patient1',23,'Montreal'),(30002,'Patient2',16,'Toronto'),(30003,'Patient3',35,'Ottawa'),(30004,'Patient4',37,'Vancouver'),(30005,'Patient5',23,'Calgary'),(30006,'Patient6',22,'Montreal'),(30007,'Patient7',45,'Toronto'),(30008,'Patient8',47,'Ottawa'),(30009,'Patient9',60,'Vancouver'),(30010,'Patient10',65,'Calgary'),(30011,'Patient11',33,'Montreal'),(30012,'Patient12',26,'Toronto'),(30013,'Patient13',45,'Ottawa'),(30014,'Patient14',67,'Vancouver'),(30015,'Patient15',13,'Calgary'),(30016,'Patient16',42,'Montreal'),(30017,'Patient17',55,'Toronto'),(30018,'Patient18',57,'Ottawa'),(30019,'Patient19',30,'Vancouver'),(30020,'Patient20',35,'Calgary');
/*!40000 ALTER TABLE `as1Patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as1Works_in`
--

DROP TABLE IF EXISTS `as1Works_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as1Works_in` (
  `did` int(5) NOT NULL,
  `cid` int(5) NOT NULL,
  `hours_per_week` int(2) NOT NULL,
  PRIMARY KEY (`did`,`cid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as1Works_in`
--

LOCK TABLES `as1Works_in` WRITE;
/*!40000 ALTER TABLE `as1Works_in` DISABLE KEYS */;
INSERT INTO `as1Works_in` VALUES (40001,20002,20),(40002,20003,15),(40003,20004,18),(40004,20005,25),(40005,20001,10),(40006,20002,12),(40007,20003,10),(40008,20009,10),(40009,20010,20),(40010,20006,15),(40001,20003,20),(40002,20004,15),(40003,20005,18),(40004,20001,5),(40005,20002,10),(40006,20003,12),(40007,20009,10),(40008,20010,10),(40009,20006,20),(40010,20002,15);
/*!40000 ALTER TABLE `as1Works_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as2Doctor`
--

DROP TABLE IF EXISTS `as2Doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as2Doctor` (
  `name` varchar(40) NOT NULL,
  `disease_of_specialization` varchar(40) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `disease_of_specialization` (`disease_of_specialization`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as2Doctor`
--

LOCK TABLES `as2Doctor` WRITE;
/*!40000 ALTER TABLE `as2Doctor` DISABLE KEYS */;
INSERT INTO `as2Doctor` VALUES ('Lee Wong','HIV'),('Foo Pong','HIV'),('Sam Smith','Herpes'),('Peter Kong','Herpes'),('Lindsay Lohan','Cancer'),('Brittany Don','Cancer'),('Michael Wong','Sarcoma'),('John Turcotte','Sarcoma'),('John Wong','Stomach'),('Esteban Pong','Stomach'),('Samuel Smith','Heart'),('Peter Jackson','Heart'),('Lindsay Lee','Brain'),('Gemma Cheng','Brain'),('Mike Wolf','Blood'),('Sevan Engel','Blood');
/*!40000 ALTER TABLE `as2Doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as2Treated`
--

DROP TABLE IF EXISTS `as2Treated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as2Treated` (
  `doctor_name` varchar(40) NOT NULL,
  `patient_name` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `procedure` varchar(40) NOT NULL,
  `diagnostic` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`doctor_name`,`patient_name`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as2Treated`
--

LOCK TABLES `as2Treated` WRITE;
/*!40000 ALTER TABLE `as2Treated` DISABLE KEYS */;
INSERT INTO `as2Treated` VALUES ('Lee Wong','Foo Pong','2013-01-25','consultation','HIV'),('Foo Pong','Patient 1','2012-01-25','intervention','surgery'),('Foo Pong','Patient 12','2013-01-20','intervention','surgery'),('Samuel Smith','Peter Jackson','2011-02-21','consultation','Heart'),('Peter Jackson','Patient 2','2013-02-20','consultation','Heart'),('Esteban Pong','Bernard Le Blanc','2012-09-08','consultation','Stomach'),('Samuel Smith','Bernard Le Blanc','2012-10-08','consultation','Heart'),('Lindsay Lee','Bernard Le Blanc','2012-11-08','consultation','Brain'),('Lee Wong','Patient 3','2012-01-25','consultation','HIV'),('Peter Kong','Patient 4','2012-08-25','consultation','Herpes'),('John Turcotte','Esteban Pong','2012-11-01','intervention','surgery'),('John Turcotte','Esteban Pong','2012-06-05','consultation','Sarcoma'),('Sevan Engel','Patient 2','2012-02-20','consultation','Blood'),('Sevan Engel','Patient 5','2012-05-20','consultation','Blood'),('Mike Wolf','Patient 6','2013-05-20','consultation','Blood'),('Michael Wong','Patient 7','2012-09-09','consultation','Sarcoma'),('John Wong','Patient 8','2012-09-09','consultation','Brain'),('Esteban Pong','Patient 8','2012-10-09','consultation','Brain'),('Samuel Smith','Patient 8','2012-11-09','consultation','Brain'),('Lindsay Lee','Patient 8','2013-01-09','consultation','Brain'),('Mike Wolf','Patient 5','2012-08-20','consultation','Blood'),('John Turcotte','Esteban Pong','2013-05-01','intervention','surgery'),('John Turcotte','Esteban Pong','2013-05-03','intervention','complication'),('Foo Pong','Patient 9','2013-04-15','consultation','HIV');
/*!40000 ALTER TABLE `as2Treated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as2Treatment`
--

DROP TABLE IF EXISTS `as2Treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as2Treatment` (
  `disease` varchar(40) NOT NULL,
  `medication` varchar(40) NOT NULL,
  PRIMARY KEY (`disease`,`medication`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as2Treatment`
--

LOCK TABLES `as2Treatment` WRITE;
/*!40000 ALTER TABLE `as2Treatment` DISABLE KEYS */;
INSERT INTO `as2Treatment` VALUES ('Blood','Blood Super Only'),('Brain','Brain Super 1'),('Brain','Magic Med'),('Cancer','Cancer Super 1'),('Cancer','Cancer Super 2'),('Cancer','Cancer Super 3'),('Heart','Hear Super 1'),('Heart','Magic Med'),('Herpes','Herpes Super 1'),('Herpes','Herpes Super 2'),('HIV','HIV Super Only'),('Sarcoma','Cancer Super 1'),('Sarcoma','Cancer Super 2'),('Sarcoma','Sarcoma Special'),('Stomach','Magic Med'),('Stomach','Stomach Super 1');
/*!40000 ALTER TABLE `as2Treatment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helps_in`
--

DROP TABLE IF EXISTS `helps_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helps_in` (
  `eid` int(5) NOT NULL,
  `labName` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`eid`,`labName`),
  KEY `labName` (`labName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helps_in`
--

LOCK TABLES `helps_in` WRITE;
/*!40000 ALTER TABLE `helps_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `helps_in` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-12  4:16:04
