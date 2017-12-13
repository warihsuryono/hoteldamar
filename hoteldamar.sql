-- MySQL dump 10.16  Distrib 10.1.28-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: hoteldamar
-- ------------------------------------------------------
-- Server version	10.1.28-MariaDB

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
-- Table structure for table `acc_design_report_gl`
--

DROP TABLE IF EXISTS `acc_design_report_gl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_design_report_gl` (
  `kodedesign` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodedesign`),
  KEY `idseqno` (`idseqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_design_report_gl`
--

LOCK TABLES `acc_design_report_gl` WRITE;
/*!40000 ALTER TABLE `acc_design_report_gl` DISABLE KEYS */;
INSERT INTO `acc_design_report_gl` VALUES ('GLTEMP/20110919/001',1,'aa','sfdgad','superuser','2011-09-19 12:33:37','<a href=\'acc_design_report_gladd.php?editing=1&kode=GLTEMP/20110919/001\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>&nbsp;&nbsp;<a href=\'acc_design_report_gl_detail.php?kode=GLTEMP/20110919/001\'><img src=\'images/view.gif\' title=\'Detail\' width=\'16\' height=\'16\' border=\'0\'></a>','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `acc_design_report_gl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_design_report_gl_detail`
--

DROP TABLE IF EXISTS `acc_design_report_gl_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_design_report_gl_detail` (
  `kodedesign` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `coa` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodedesign`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_design_report_gl_detail`
--

LOCK TABLES `acc_design_report_gl_detail` WRITE;
/*!40000 ALTER TABLE `acc_design_report_gl_detail` DISABLE KEYS */;
INSERT INTO `acc_design_report_gl_detail` VALUES ('GLTEMP/20110919/001',0,'dfad','0.0.00;0.0.01;','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `acc_design_report_gl_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_design_report_rl`
--

DROP TABLE IF EXISTS `acc_design_report_rl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_design_report_rl` (
  `kodedesign` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `title` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `footer` text NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodedesign`),
  KEY `idseqno` (`idseqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_design_report_rl`
--

LOCK TABLES `acc_design_report_rl` WRITE;
/*!40000 ALTER TABLE `acc_design_report_rl` DISABLE KEYS */;
INSERT INTO `acc_design_report_rl` VALUES ('RLTEMP/20111019/001',1,'LABA/RUGI','LABA/RUGI','','dewi','2011-11-21 15:19:54','<a href=\'acc_design_report_rladd.php?editing=1&kode=RLTEMP/20111019/001\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>&nbsp;&nbsp;<a href=\'acc_design_report_rl_detail.php?kode=RLTEMP/20111019/001\'><img src=\'images/view.gif\' title=\'Detail\' width=\'16\' height=\'16\' border=\'0\'></a>','2011-11-21 08:19:54');
/*!40000 ALTER TABLE `acc_design_report_rl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_design_report_rl_detail`
--

DROP TABLE IF EXISTS `acc_design_report_rl_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_design_report_rl_detail` (
  `kodedesign` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `coa` text NOT NULL,
  `modevalue` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `alias` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodedesign`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_design_report_rl_detail`
--

LOCK TABLES `acc_design_report_rl_detail` WRITE;
/*!40000 ALTER TABLE `acc_design_report_rl_detail` DISABLE KEYS */;
INSERT INTO `acc_design_report_rl_detail` VALUES ('RLTEMP/20111019/001',29,'4.1.08;','Debit','Biaya Bank','#b14','2011-11-21 08:20:03'),('RLTEMP/20111019/001',28,'4.1.02;','Debit','Pemasaran','#b13','2011-11-21 08:19:54'),('RLTEMP/20111019/001',30,'','','{tab}{tab}{b}{u}TOTAL BIAYA-BIAYA{/u}{/b}','#totalbiaya=#b1+#b2+#b3+#b4+#b5+#b6+#b7+#b8+#b9+#b10+#b11+#b12+#b13+#b14;','2011-11-21 08:20:03'),('RLTEMP/20111019/001',31,'','','','','2011-11-21 08:20:03'),('RLTEMP/20111019/001',32,'','','{b}{u}LABA/RUGI{/u}{/b}','#lr=#totalpend-#totalbiaya;','2011-11-21 08:20:03'),('RLTEMP/20111019/001',26,'7.1.02;','Debit','Biaya Penyusutan Mebel','#b11','2011-11-21 08:19:54'),('RLTEMP/20111019/001',27,'7.1.04','Debit','Biaya Penyusutan Alat-alat dan Mesin','#b12','2011-11-21 08:19:54'),('RLTEMP/20111019/001',23,'4.1.06;','Debit','Biaya Pantry & Serba-serbi','#b8','2011-11-21 08:19:54'),('RLTEMP/20111019/001',24,'4.1.07;','Debit','Pemeliharaan Genset','#b9','2011-11-21 08:19:54'),('RLTEMP/20111019/001',25,'7.1.01;','Debit','Biaya Penyusutan Bangunan','#b10','2011-11-21 08:19:54'),('RLTEMP/20111019/001',22,'4.1.05;','Debit','Transportasi','#b7','2011-11-21 08:19:54'),('RLTEMP/20111019/001',21,'4.1.04;','Debit','Listrik/Telepon','#b6','2011-11-21 08:19:54'),('RLTEMP/20111019/001',19,'4.1.01;','Debit','Administrasi Umum','#b4','2011-11-21 08:19:54'),('RLTEMP/20111019/001',20,'4.1.03;','Debit','Pemeliharaan','#b5','2011-11-21 08:19:54'),('RLTEMP/20111019/001',18,'4.0.04;','Debit','Laundry','#b3','2011-11-21 08:19:54'),('RLTEMP/20111019/001',16,'4.0.00;','Debit','Gaji','#b1','2011-11-21 08:19:54'),('RLTEMP/20111019/001',17,'4.0.01;','Debit','Tunjangan','#b2','2011-11-21 08:19:54'),('RLTEMP/20111019/001',13,'','','{tab}{tab}{b}{u}TOTAL PENDAPATAN{/u}{/b}','#totalpend=#pendkamar+#pendrestaturant+#pendcinderamata+#sewaperahu-#uangservice;','2011-11-21 08:19:54'),('RLTEMP/20111019/001',14,'','','','','2011-11-21 08:19:54'),('RLTEMP/20111019/001',15,'','','{b}{u}BIAYA-BIAYA{/u}{/b}','','2011-11-21 08:19:54'),('RLTEMP/20111019/001',11,'8.5.03','Debit','Uang Service','#uangservice','2011-11-21 08:19:54'),('RLTEMP/20111019/001',12,'','','','','2011-11-21 08:19:54'),('RLTEMP/20111019/001',10,'8.0.02;','Kredit','Sewa Perahu','#sewaperahu','2011-11-21 08:19:54'),('RLTEMP/20111019/001',8,'8.5.04;','Debit','HPP Cinderamata','#hppcinderamata','2011-11-21 08:19:54'),('RLTEMP/20111019/001',9,'','','{tab}{b}Pendapatan Cinderamata{/b}','#pendcinderamata=#cinderamata-#hppcinderamata;','2011-11-21 08:19:54'),('RLTEMP/20111019/001',3,'','','{tab}{b}Pendapatan Kamar{/b}','#pendkamar=#kamar-#hppkamar;','2011-11-21 08:19:54'),('RLTEMP/20111019/001',4,'8.0.01;','Kredit','Restaurant','#restaurant','2011-11-21 08:19:54'),('RLTEMP/20111019/001',5,'8.5.02;','Debit','HPP Restaurant','#hpprestaurant','2011-11-21 08:19:54'),('RLTEMP/20111019/001',6,'','','{tab}{b}Pendapatan Restauran{/b}','#pendrestaturant=#restaurant-#hpprestaurant;','2011-11-21 08:19:54'),('RLTEMP/20111019/001',7,'8.0.04;','Kredit','Cinderamata','#cinderamata','2011-11-21 08:19:54'),('RLTEMP/20111019/001',0,'','','{b}{u}PENDAPATAN{/u}{/b}','','2011-11-21 08:19:54'),('RLTEMP/20111019/001',1,'8.0.00;','Kredit','Kamar','#kamar','2011-11-21 08:19:54'),('RLTEMP/20111019/001',2,'8.5.01;','Debit','Harga Pokok Penjualan Kamar','#hppkamar','2011-11-21 08:19:54');
/*!40000 ALTER TABLE `acc_design_report_rl_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_jurnal`
--

DROP TABLE IF EXISTS `acc_jurnal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_jurnal` (
  `kodejurnal` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nocek` varchar(30) NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `posting` varchar(100) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `dirutby` varchar(30) NOT NULL,
  `dirutdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodejurnal`),
  KEY `tanggal` (`tanggal`,`kode_pekerjaan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_jurnal`
--

LOCK TABLES `acc_jurnal` WRITE;
/*!40000 ALTER TABLE `acc_jurnal` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_jurnal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_jurnal_detail`
--

DROP TABLE IF EXISTS `acc_jurnal_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_jurnal_detail` (
  `kodejurnal` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `coa` varchar(10) NOT NULL,
  `koder` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `debit` double NOT NULL,
  `kredit` double NOT NULL,
  `mutasirecord` smallint(6) NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodejurnal`,`seqno`),
  KEY `coa` (`coa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_jurnal_detail`
--

LOCK TABLES `acc_jurnal_detail` WRITE;
/*!40000 ALTER TABLE `acc_jurnal_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_jurnal_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_mst_coa`
--

DROP TABLE IF EXISTS `acc_mst_coa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_mst_coa` (
  `coa` varchar(10) NOT NULL,
  `koder` varchar(255) NOT NULL,
  `parent` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`coa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_mst_coa`
--

LOCK TABLES `acc_mst_coa` WRITE;
/*!40000 ALTER TABLE `acc_mst_coa` DISABLE KEYS */;
INSERT INTO `acc_mst_coa` VALUES ('0.0.00','MODAL SAHAM','','Modal Saham','0000-00-00 00:00:00'),('0.0.01','MODAL SAHAM','','Modal ','0000-00-00 00:00:00'),('0.0.10','MODAL SAHAM','','Laba Ditahan','0000-00-00 00:00:00'),('0.0.11','MODAL SAHAM','','L/R s/d tahun berjalan','0000-00-00 00:00:00'),('0.1.00','AKTIVA TETAP','','Tanah','0000-00-00 00:00:00'),('0.1.01','AKTIVA TETAP','','Bangunan','0000-00-00 00:00:00'),('0.1.02','AKTIVA TETAP','','Mebel','0000-00-00 00:00:00'),('0.1.03','AKTIVA TETAP','','Kendaraan bermotor','0000-00-00 00:00:00'),('0.1.04','AKTIVA TETAP','','Alat-alat dan Mesin','0000-00-00 00:00:00'),('0.5.00','AKTIVA TETAP','','Akum. Penyusutan Tanah','0000-00-00 00:00:00'),('0.5.01','AKTIVA TETAP','','Akum. Penyusutan Bangunan','0000-00-00 00:00:00'),('0.5.02','AKTIVA TETAP','','Akum. Penyusutan Mebel','0000-00-00 00:00:00'),('0.5.03','AKTIVA TETAP','','Akum. Penyusutan Kendaraan Bermotor','0000-00-00 00:00:00'),('0.5.04','AKTIVA TETAP','','Akum. Penyusutan Alat-alat dan Mesin','0000-00-00 00:00:00'),('1.0.00','AKTIVA LANCAR','','Kas','2017-12-03 06:34:27'),('1.0.01','AKTIVA LANCAR','','','0000-00-00 00:00:00'),('1.1.00','AKTIVA LANCAR','','Bank CIMB','2017-12-05 08:57:59'),('1.1.01','AKTIVA LANCAR','','Bank BNI','2012-06-19 04:22:41'),('2.0.00','PIUTANG DAGANG','','Stok Barang','0000-00-00 00:00:00'),('2.0.01','PIUTANG DAGANG','','Tagihan','0000-00-00 00:00:00'),('2.0.02','PIUTANG PEGAWAI','','-','2012-08-07 02:05:44'),('2.0.03','PIUTANG DAGANG','','Asuransi','2012-02-07 08:37:40'),('3.0.00','HUTANG DAGANG','','Hutang Dagang','0000-00-00 00:00:00'),('3.0.01','HUTANG DAGANG','','Hutang Bank','0000-00-00 00:00:00'),('3.0.02','HUTANG DAGANG','','Hutang Pajak','0000-00-00 00:00:00'),('3.0.03','HUTANG DAGANG','','Hutang Perusahaan','2017-12-03 06:35:11'),('4.0.00','BIAYA LANGSUNG','','Gaji','0000-00-00 00:00:00'),('4.0.01','BIAYA LANGSUNG','','Tunjangan Pegawai','0000-00-00 00:00:00'),('4.0.02','BIAYA LANGSUNG','','Komisi','0000-00-00 00:00:00'),('4.0.03','BIAYA LANGSUNG','','Kebersihan','0000-00-00 00:00:00'),('4.0.04','BIAYA LANGSUNG','','Laundry','0000-00-00 00:00:00'),('4.0.05','BIAYA LANGSUNG','','Brosur','0000-00-00 00:00:00'),('4.0.06','BIAYA LANGSUNG','','Profit Sharing','0000-00-00 00:00:00'),('4.0.07','BIAYA LANGSUNG','','Pemb. Kolam Renang','0000-00-00 00:00:00'),('4.1.01','BIAYA TIDAK LANGSUNG','','Administrasi Umum','0000-00-00 00:00:00'),('4.1.02','BIAYA TIDAK LANGSUNG','','Pemasaran','0000-00-00 00:00:00'),('4.1.03','BIAYA TIDAK LANGSUNG','','Pemeliharaan','0000-00-00 00:00:00'),('4.1.04','BIAYA TIDAK LANGSUNG','','Listrik/Telepon/Air','0000-00-00 00:00:00'),('4.1.05','BIAYA TIDAK LANGSUNG','','Transportasi','0000-00-00 00:00:00'),('4.1.06','BIAYA TIDAK LANGSUNG','','Biaya Pantry','0000-00-00 00:00:00'),('4.1.07','BIAYA TIDAK LANGSUNG','','Pemeliharaan Genset','0000-00-00 00:00:00'),('7.1.00','BIAYA TIDAK LANGSUNG','','Biaya Penyusutan Tanah','0000-00-00 00:00:00'),('7.1.01','BIAYA TIDAK LANGSUNG','','Biaya Penyusutan Bangunan','0000-00-00 00:00:00'),('7.1.02','BIAYA TIDAK LANGSUNG','','Biaya Penyusutan Mebel','0000-00-00 00:00:00'),('7.1.03','BIAYA TIDAK LANGSUNG','','Biaya Penyusutan Kendaraan Bermotor','0000-00-00 00:00:00'),('7.1.04','BIAYA TIDAK LANGSUNG','','Biaya Penyusutan Alat-alat dan Mesin','0000-00-00 00:00:00'),('8.0.00','','','Kamar','0000-00-00 00:00:00'),('8.0.01','','','Restaurant','0000-00-00 00:00:00'),('8.0.02','','','Sewa Perahu','0000-00-00 00:00:00'),('8.5.01','','','HPP Kamar','0000-00-00 00:00:00'),('8.5.02','','','HPP Restaurant','0000-00-00 00:00:00'),('8.5.03','','','Uang Service','0000-00-00 00:00:00'),('8.0.03','-','','Discount','0000-00-00 00:00:00'),('4.1.08','BIAYA LANGSUNG','','Biaya Bank','2011-11-21 05:08:33'),('3.1.00','HUTANG PAJAK','','Pajak Keluaran','2012-03-01 04:30:24'),('2.3.00','PIUTANG PAJAK','','Pajak Masukan','2012-03-01 04:30:41'),('1.1.02','AKTIVA LANCAR','','Bank BCA','0000-00-00 00:00:00'),('1.1.03','AKTIVA LANCAR','','Bank Permata','2017-12-05 08:58:10'),('8.5.04','-','','HPP Cindremata','2011-11-21 06:08:26'),('8.0.04','-','','Cindremata','2011-11-21 06:23:37'),('9.0.00','-','','PM','2012-02-03 08:22:54'),('8.8.01','PENDAPATAN LAIN-LAIN','','Bunga Rekening Bank','2012-02-07 08:18:02'),('8.5.05','-','','HPP Komunitas','2012-03-15 08:04:44'),('8.0.05','PENDAPATAN KOMUNITAS','','Pendapatan Komunitas','2012-03-15 08:05:54'),('8.5.06','-','','HPP Toko','2012-05-25 06:14:46'),('8.0.06','PENDAPATAN','','Toko','2012-05-25 06:15:40'),('4.0.08','BIAYA LANGSUNG','','Belanja Harian','2017-12-05 12:20:24');
/*!40000 ALTER TABLE `acc_mst_coa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_setting_coa`
--

DROP TABLE IF EXISTS `acc_setting_coa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_setting_coa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `coa` varchar(10) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `description` (`description`,`coa`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_setting_coa`
--

LOCK TABLES `acc_setting_coa` WRITE;
/*!40000 ALTER TABLE `acc_setting_coa` DISABLE KEYS */;
INSERT INTO `acc_setting_coa` VALUES (1,'Kas','1.0.00','0000-00-00 00:00:00'),(2,'Bank','1.1.00','0000-00-00 00:00:00'),(3,'Discount','8.0.03','0000-00-00 00:00:00'),(4,'Service','8.5.03','0000-00-00 00:00:00'),(5,'Pajak Masukan','2.3.00','0000-00-00 00:00:00'),(6,'Pajak Keluaran','3.1.00','0000-00-00 00:00:00'),(7,'Pendapatan Restourant','8.0.01','0000-00-00 00:00:00'),(8,'Pengeluaran Restourant','8.5.02','0000-00-00 00:00:00'),(9,'Pendapatan Kamar','8.0.00','0000-00-00 00:00:00'),(10,'Pengeluaran Kamar','8.5.01','0000-00-00 00:00:00'),(11,'Biaya Lain-lain','4.1.08','0000-00-00 00:00:00'),(12,'Hutang Dagang','3.0.00','0000-00-00 00:00:00'),(13,'Hutang Pajak','3.0.02','0000-00-00 00:00:00'),(14,'Prefix Asset yg disusutkan','0.1.','0000-00-00 00:00:00'),(15,'Pendapatan Toko','8.0.06','2012-05-25 07:52:20');
/*!40000 ALTER TABLE `acc_setting_coa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_notifications`
--

DROP TABLE IF EXISTS `app_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_notifications`
--

LOCK TABLES `app_notifications` WRITE;
/*!40000 ALTER TABLE `app_notifications` DISABLE KEYS */;
INSERT INTO `app_notifications` VALUES (1,'WEBOOK Mr. Jimat checkin at 07-07-2017','<h3><b>Web Booking BOOK/20170706/001W </b></h3><br><table>	<tr>		<td>Kode Booking</td><td>:</td><td>BOOK/20170706/001W</td>	</tr>	<tr>		<td>Tanggal Booking</td><td>:</td><td>06-07-2017</td>	</tr>	<tr>		<td>Arrival</td><td>:</td><td>07-07-2017</td>	</tr>	<tr>		<td>Departure</td><td>:</td><td>09-07-2017</td>	</tr>	<tr>		<td>Nama</td><td>:</td><td>Mr. Jimat</td>	</tr>	<tr>		<td>Person</td><td>:</td><td>2</td>	</tr>	<tr>		<td>ID Number</td><td>:</td><td>1234567890 (KTP)</td>	</tr>	<tr>		<td>Alamat</td><td>:</td><td>Jl Samudera no 59\rJl Samudera no 59</td>	</tr>	<tr>		<td>Phone</td><td>:</td><td>0217254529</td>	</tr>	<tr>		<td>Email</td><td>:</td><td>rahmatfauzi.rf@gmail.com</td>	</tr>	<tr>		<td>Company</td><td>:</td><td>KWS</td>	</tr>	<tr>		<td>Notes</td><td>:</td><td>connecting people</td>	</tr></table>','2017-07-06 09:51:31','rahmatfauzi.rf@gmail.com','2017-07-06 02:51:31'),(2,'WEBOOK Mr. Warih Test checkin at 06-07-2018','<h3><b>Web Booking BOOK/20170706/002W </b></h3><br><table>	<tr>		<td>Kode Booking</td><td>:</td><td>BOOK/20170706/002W</td>	</tr>	<tr>		<td>Tanggal Booking</td><td>:</td><td>06-07-2017</td>	</tr>	<tr>		<td>Arrival</td><td>:</td><td>06-07-2018</td>	</tr>	<tr>		<td>Departure</td><td>:</td><td>07-07-2018</td>	</tr>	<tr>		<td>Nama</td><td>:</td><td>Mr. Warih Test</td>	</tr>	<tr>		<td>Person</td><td>:</td><td>2</td>	</tr>	<tr>		<td>ID Number</td><td>:</td><td>123213321312 (KTP)</td>	</tr>	<tr>		<td>Alamat</td><td>:</td><td>Ciledug\rIndah</td>	</tr>	<tr>		<td>Phone</td><td>:</td><td>081212864040</td>	</tr>	<tr>		<td>Email</td><td>:</td><td>warih@jalurkerja.com</td>	</tr>	<tr>		<td>Company</td><td>:</td><td>CorpHR</td>	</tr>	<tr>		<td>Notes</td><td>:</td><td>Notes</td>	</tr></table>','2017-07-06 17:30:20','warih@jalurkerja.com','2017-07-06 10:30:20'),(3,'WEBOOK Mr. Anonymous checkin at 22-07-2017','<h3><b>Web Booking BOOK/20170710/001W </b></h3><br><table>	<tr>		<td>Kode Booking</td><td>:</td><td>BOOK/20170710/001W</td>	</tr>	<tr>		<td>Tanggal Booking</td><td>:</td><td>10-07-2017</td>	</tr>	<tr>		<td>Arrival</td><td>:</td><td>22-07-2017</td>	</tr>	<tr>		<td>Departure</td><td>:</td><td>23-07-2017</td>	</tr>	<tr>		<td>Nama</td><td>:</td><td>Mr. Anonymous</td>	</tr>	<tr>		<td>Person</td><td>:</td><td>8</td>	</tr>	<tr>		<td>ID Number</td><td>:</td><td>01234567890 (KTP)</td>	</tr>	<tr>		<td>Alamat</td><td>:</td><td>Jl. Somewhere I belong alias rawa belong\rjakarta</td>	</tr>	<tr>		<td>Phone</td><td>:</td><td>02112345678</td>	</tr>	<tr>		<td>Email</td><td>:</td><td>rahmatfauzi.rf@gmail.com</td>	</tr>	<tr>		<td>Company</td><td>:</td><td>cyber</td>	</tr>	<tr>		<td>Notes</td><td>:</td><td></td>	</tr></table>','2017-07-10 10:23:38','rahmatfauzi.rf@gmail.com','2017-07-10 03:23:38'),(4,'WEBOOK Mrs. Dewi dwiyanti checkin at 22-07-2017','<h3><b>Web Booking BOOK/20170712/001W </b></h3><br><table>	<tr>		<td>Kode Booking</td><td>:</td><td>BOOK/20170712/001W</td>	</tr>	<tr>		<td>Tanggal Booking</td><td>:</td><td>12-07-2017</td>	</tr>	<tr>		<td>Arrival</td><td>:</td><td>22-07-2017</td>	</tr>	<tr>		<td>Departure</td><td>:</td><td>23-07-2017</td>	</tr>	<tr>		<td>Nama</td><td>:</td><td>Mrs. Dewi dwiyanti</td>	</tr>	<tr>		<td>Person</td><td>:</td><td>2</td>	</tr>	<tr>		<td>ID Number</td><td>:</td><td>1234567890 (KTP)</td>	</tr>	<tr>		<td>Alamat</td><td>:</td><td>Jl Samudera no 59\rCipulir</td>	</tr>	<tr>		<td>Phone</td><td>:</td><td>0217254529</td>	</tr>	<tr>		<td>Email</td><td>:</td><td>dewi@karmanta.com, admin@karmanta.com</td>	</tr>	<tr>		<td>Company</td><td>:</td><td>KWS</td>	</tr>	<tr>		<td>Notes</td><td>:</td><td>kamar yang ada kolam renangnya</td>	</tr></table>','2017-07-12 11:32:55','dewi@karmanta.com, admin@karmanta.com','2017-07-12 04:32:55'),(5,'WEBOOK Mr. Jimat checkin at 05-08-2017','<h3><b>Web Booking BOOK/20170801/001W </b></h3><br><table>	<tr>		<td>Kode Booking</td><td>:</td><td>BOOK/20170801/001W</td>	</tr>	<tr>		<td>Tanggal Booking</td><td>:</td><td>01-08-2017</td>	</tr>	<tr>		<td>Arrival</td><td>:</td><td>05-08-2017</td>	</tr>	<tr>		<td>Departure</td><td>:</td><td>06-08-2017</td>	</tr>	<tr>		<td>Nama</td><td>:</td><td>Mr. Jimat</td>	</tr>	<tr>		<td>Person</td><td>:</td><td>3</td>	</tr>	<tr>		<td>ID Number</td><td>:</td><td>1234567890 (KTP)</td>	</tr>	<tr>		<td>Alamat</td><td>:</td><td>Jl. Jalan jalan\rFipulir</td>	</tr>	<tr>		<td>Phone</td><td>:</td><td>02123456789</td>	</tr>	<tr>		<td>Email</td><td>:</td><td>rahmatfauzi.rf@gmail.com</td>	</tr>	<tr>		<td>Company</td><td>:</td><td>KWS</td>	</tr>	<tr>		<td>Notes</td><td>:</td><td>Kamar yang ada kolam renang nya</td>	</tr></table>','2017-08-01 12:42:38','rahmatfauzi.rf@gmail.com','2017-08-01 05:42:38');
/*!40000 ALTER TABLE `app_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_notifications_status`
--

DROP TABLE IF EXISTS `app_notifications_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_notifications_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_ip` varchar(20) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `notification_id` (`notification_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_notifications_status`
--

LOCK TABLES `app_notifications_status` WRITE;
/*!40000 ALTER TABLE `app_notifications_status` DISABLE KEYS */;
INSERT INTO `app_notifications_status` VALUES (1,'superuser',1,2,'2017-07-11 14:47:24','110.136.23.247','2017-07-11 07:47:24'),(2,'weweng',1,2,'2017-07-06 17:45:25','203.217.132.136','2017-07-06 10:45:25'),(3,'superuser',2,2,'2017-07-06 18:00:54','112.215.171.197','2017-07-06 11:00:54'),(4,'weweng',2,2,'2017-07-06 17:45:34','203.217.132.136','2017-07-06 10:45:34'),(5,'lestari',1,1,'2017-07-09 09:45:48','112.215.151.65','2017-07-09 02:45:48'),(6,'lestari',2,1,'2017-07-09 09:45:48','112.215.151.65','2017-07-09 02:45:48'),(7,'superuser',3,2,'2017-07-10 10:41:46','36.88.145.112','2017-07-10 03:41:46'),(8,'weweng',3,2,'2017-07-10 10:41:51','203.217.132.153','2017-07-10 03:41:51'),(9,'dewi',1,1,'2017-07-11 14:44:06','110.136.23.247','2017-07-11 07:44:06'),(10,'dewi',2,2,'2017-07-11 14:47:13','110.136.23.247','2017-07-11 07:47:13'),(11,'dewi',3,2,'2017-07-11 14:45:01','110.136.23.247','2017-07-11 07:45:01'),(12,'superuser',4,2,'2017-07-22 19:06:04','112.215.239.80','2017-07-22 12:06:04'),(13,'dewi',4,1,'2017-07-12 11:34:17','110.136.23.247','2017-07-12 04:34:17'),(14,'weweng',4,2,'2017-07-13 15:59:48','118.137.172.148','2017-07-13 08:59:48'),(15,'',1,1,'2017-07-24 16:22:14','35.163.102.115','2017-07-24 09:22:14'),(16,'',2,1,'2017-07-24 16:22:14','35.163.102.115','2017-07-24 09:22:14'),(17,'',3,1,'2017-07-24 16:22:14','35.163.102.115','2017-07-24 09:22:14'),(18,'',4,1,'2017-07-24 16:22:14','35.163.102.115','2017-07-24 09:22:14'),(19,'weweng',5,2,'2017-08-01 12:43:24','36.69.148.28','2017-08-01 05:43:24'),(20,'superuser',5,2,'2017-08-01 12:43:42','112.215.239.233','2017-08-01 05:43:42'),(21,'lestari',3,1,'2017-08-02 22:25:01','112.215.152.169','2017-08-02 15:25:01'),(22,'lestari',4,1,'2017-08-02 22:25:01','112.215.152.169','2017-08-02 15:25:01'),(23,'lestari',5,1,'2017-08-02 22:25:01','112.215.152.169','2017-08-02 15:25:01');
/*!40000 ALTER TABLE `app_notifications_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_category`
--

DROP TABLE IF EXISTS `asset_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_category` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `coa` varchar(10) NOT NULL,
  `coabiaya` varchar(10) NOT NULL,
  `coaakum` varchar(10) NOT NULL,
  `category` varchar(200) NOT NULL,
  `penyusutan` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_category`
--

LOCK TABLES `asset_category` WRITE;
/*!40000 ALTER TABLE `asset_category` DISABLE KEYS */;
INSERT INTO `asset_category` VALUES (1,'0.1.00','7.1.00','0.5.00','TANAH',0,'0000-00-00 00:00:00'),(2,'0.1.01','7.1.01','0.5.01','BANGUNAN',5,'0000-00-00 00:00:00'),(3,'0.1.04','7.1.04','0.5.04','ALAT-ALAT DAN MESIN',25,'0000-00-00 00:00:00'),(4,'0.1.02','7.1.02','0.5.02','MEBEL',25,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `asset_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_detail`
--

DROP TABLE IF EXISTS `asset_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_detail` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `jml` double NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `nilai_pembelian` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_detail`
--

LOCK TABLES `asset_detail` WRITE;
/*!40000 ALTER TABLE `asset_detail` DISABLE KEYS */;
INSERT INTO `asset_detail` VALUES (1,1,'-','Tanah Luas 3000 M2',1,'2004-01-01',1036500000,'2012-02-06 08:23:57'),(2,2,'-','Bangunan',1,'2009-01-01',2374180516,'0000-00-00 00:00:00'),(3,3,'HKP0050006','AC LG S07LP (3/4 PK)',3,'2009-01-01',7500000,'0000-00-00 00:00:00'),(4,3,'HKP0050008','AC LG S09LP (1 PK)',1,'2009-01-01',2600000,'0000-00-00 00:00:00'),(5,3,'HKP0050006','AC LG S07LP (3/4 PK)',2,'2009-01-01',5080000,'0000-00-00 00:00:00'),(6,3,'HKP0050006','AC LG S07LP (3/4 PK)',14,'2009-01-01',35700000,'0000-00-00 00:00:00'),(7,3,'HKP0050016','Water heater 5 liter',1,'2009-01-01',880000,'0000-00-00 00:00:00'),(8,3,'HKP0050018','Water heater Polaris 10 liter',1,'2009-01-01',22800000,'0000-00-00 00:00:00'),(9,3,'MTC0100012','Pompa grundfos',1,'2009-01-01',6818750,'0000-00-00 00:00:00'),(10,3,'DPR0010071','Rice Cooker Maspion',1,'2009-01-01',977912,'0000-00-00 00:00:00'),(11,3,'DPR0010053','Panggangan ikan gg kayu',1,'2009-01-01',52690,'0000-00-00 00:00:00'),(12,3,'DPR0010055','Panggangan ikan iron grilling',1,'2009-01-01',76780,'0000-00-00 00:00:00'),(13,3,'DPR0010111','Tempat saji stainles steel (besar)',1,'2009-01-01',472890,'0000-00-00 00:00:00'),(14,3,'DPR0010112','Tempat saji stainles steel (kecil)',3,'2009-01-01',725670,'0000-00-00 00:00:00'),(15,3,'MTC0050001','pompa angin',1,'2009-08-18',40000,'0000-00-00 00:00:00'),(16,3,'HKP0050020','Handphone Nokia (GSM)',1,'2009-08-18',600000,'0000-00-00 00:00:00'),(17,3,'HKP0060023','Clean matic dust',2,'2009-09-22',127000,'0000-00-00 00:00:00'),(18,3,'MTC0090004','Genset',1,'2009-09-29',50000000,'0000-00-00 00:00:00'),(19,4,'HKP0080059','Kasur Gold 120 x 200',18,'2009-01-01',21600000,'0000-00-00 00:00:00'),(20,4,'HKP0080066','Divan Gold 120 x 200',20,'2009-01-01',11200000,'0000-00-00 00:00:00'),(21,4,'HKP0080060','Kasur Gold 200 x 200',7,'2009-01-01',11200000,'0000-00-00 00:00:00'),(22,4,'HKP0080067','Divan Gold 200 x 200',8,'2009-01-01',5120000,'0000-00-00 00:00:00'),(23,4,'HKP0050009','Lampu dinding LD29 uk. 27 x 24 x 12 cm',1,'2009-01-01',8000000,'0000-00-00 00:00:00'),(24,4,'HKP0050012','Lampu meja silinder LM49 uk. 45x25 cm',6,'2009-01-01',1800000,'0000-00-00 00:00:00'),(25,4,'HKP0050010','Lampu dinding WI D80 CM',4,'2009-01-01',1000000,'0000-00-00 00:00:00'),(26,4,'DPR0010040','Lemari es LG GR-B562YLC',1,'2009-01-01',6576000,'0000-00-00 00:00:00'),(27,4,'HKP0080062','Kursi ``Tria Slat, Silver``',7,'2009-01-01',1393000,'0000-00-00 00:00:00'),(28,4,'HKP0080062','Kursi ``Tria Slat, Silver``',30,'2009-01-01',5970000,'0000-00-00 00:00:00'),(29,2,'-','Kolam Renang',1,'2011-03-01',156561815,'2012-02-06 08:02:12'),(30,2,'-','Rumah Pantai',1,'2011-11-01',23832850,'2012-02-06 08:02:43'),(31,3,'MTC0100012','Pompa grundfos',1,'2011-04-13',2325000,'2012-02-06 08:12:07'),(32,4,'HKP0050015','TV LG 21`` @ 905.000,-',16,'2011-01-01',14480000,'2012-02-06 08:16:05');
/*!40000 ALTER TABLE `asset_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_analisa`
--

DROP TABLE IF EXISTS `food_analisa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_analisa` (
  `kode` varchar(5) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `porsi` int(11) NOT NULL,
  `margin` double NOT NULL,
  `hpp_porsi` double NOT NULL,
  `hpp` double NOT NULL,
  `hargajual` double NOT NULL,
  `createby` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idseqno` int(11) NOT NULL,
  `actionlink` text NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_analisa`
--

LOCK TABLES `food_analisa` WRITE;
/*!40000 ALTER TABLE `food_analisa` DISABLE KEYS */;
INSERT INTO `food_analisa` VALUES ('F0001','Damar Fried Rice',20,300,195863.15,9793.15,39172.63,'lestari','2015-04-14 08:52:57','2017-11-28 13:42:23',0,'<a href=\'food_analisaadd.php?editing=1&kode=F0001\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('F0002','Damar Lamb Fried Rice',20,300,241201.35,12060.06,48240.27,'lestari','2015-04-13 15:19:13','2017-11-28 13:42:30',0,'<a href=\'food_analisaadd.php?editing=1&kode=F0002\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('F0003','Damar Bread',20,300,207680,10384,41536,'','2015-04-14 14:15:02','2017-11-28 13:42:34',0,'<a href=\'food_analisaadd.php?editing=1&kode=F0003\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('F0004','Damar Egg',20,300,220977.69,11048.88,44195.53,'lestari','2015-04-13 15:29:37','2017-11-28 13:42:38',0,'<a href=\'food_analisaadd.php?editing=1&kode=F0004\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('D0001','Hot/Iced Coffe',20,300,31000,1550,6200,'lestari','2012-03-17 13:51:02','2012-03-17 06:51:02',0,'<a href=\'food_analisaadd.php?editing=1&kode=D0001\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('D0003','Milk',20,300,27800,1390,5560,'lestari','2012-03-17 13:45:10','2012-03-17 06:45:10',0,'<a href=\'food_analisaadd.php?editing=1&kode=D0003\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('D0004','Pocari Sweat',20,300,0,0,0,'lestari','2012-03-17 13:54:21','2012-03-17 06:54:21',0,'<a href=\'food_analisaadd.php?editing=1&kode=D0004\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('F0005','Damar Bean',20,300,103091.1,5154.55,20618.22,'lestari','2012-03-17 14:13:11','2017-11-28 13:42:44',0,'<a href=\'food_analisaadd.php?editing=1&kode=F0005\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>'),('F0006','Damar Rice Noodle',20,300,129621.07,6481.05,25924.21,'lestari','2012-09-20 04:37:14','2017-11-28 13:42:49',0,'<a href=\'food_analisaadd.php?editing=1&kode=F0006\'><img src=\'images/inlineedit.gif\' title=\'Inline Edit\' width=\'16\' height=\'16\' border=\'0\'></a>');
/*!40000 ALTER TABLE `food_analisa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_analisa_detail`
--

DROP TABLE IF EXISTS `food_analisa_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_analisa_detail` (
  `kode` varchar(5) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `qty` double NOT NULL,
  `harsat` double NOT NULL,
  `jumlah` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_analisa_detail`
--

LOCK TABLES `food_analisa_detail` WRITE;
/*!40000 ALTER TABLE `food_analisa_detail` DISABLE KEYS */;
INSERT INTO `food_analisa_detail` VALUES ('F0001',20,'DPR0020214','botol',0.025,20818,520.45,'2015-04-14 01:52:57'),('F0001',19,'DPR0020302','Pcs',0.05,155000,7750,'2015-04-14 01:52:57'),('F0001',18,'DPR0020252','Ltr',0.5,14000,7000,'2015-04-14 01:52:57'),('F0001',17,'DPR0020278','Pcs',0.25,14000,3500,'2015-04-14 01:52:57'),('F0001',16,'DPR0020276','Pcs',0.5,8000,4000,'2015-04-14 01:52:57'),('F0001',15,'DPR0020221','Pcs',0.5,22000,11000,'2015-04-14 01:52:57'),('F0001',14,'DPR0020236','Ltr',0.5,13000,6500,'2015-04-14 01:52:57'),('F0001',13,'DPR0020229','gr',0.005,125000,625,'2015-04-14 01:52:57'),('F0001',12,'DPR0020196','Bks',0.05,600,30,'2015-04-14 01:52:57'),('F0001',11,'DPR0020134','botol',0.05,100454,5022.7,'2015-04-14 01:52:57'),('F0002',2,'DPR0020122','Pcs',1.4,25000,35000,'2015-04-13 08:19:13'),('F0002',3,'DPR0020166','Pcs',0.1,35000,3500,'2015-04-13 08:19:13'),('F0002',4,'DPR0020182','Pcs',0.05,12000,600,'2015-04-13 08:19:13'),('F0002',5,'DPR0020147','Pcs',0.1,35000,3500,'2015-04-13 08:19:13'),('F0002',6,'DPR0020149','Pcs',0.1,20000,2000,'2015-04-13 08:19:13'),('F0002',7,'DPR0010076','botol',0.05,38000,1900,'2015-04-13 08:19:13'),('F0002',8,'DPR0020211','botol',0.025,21000,525,'2015-04-13 08:19:13'),('F0002',9,'DPR0020216','botol',0.05,19200,960,'2015-04-13 08:19:13'),('F0002',10,'DPR0020134','botol',0.025,100454,2511.35,'2015-04-13 08:19:13'),('F0002',11,'DPR0020196','Bks',0.05,600,30,'2015-04-13 08:19:13'),('F0002',12,'DPR0020229','Pcs',0.005,125000,625,'2015-04-13 08:19:13'),('F0002',13,'DPR0020236','Ltr',0.25,13000,3250,'2015-04-13 08:19:13'),('F0002',14,'DPR0020221','Pcs',0.5,22000,11000,'2015-04-13 08:19:13'),('F0002',15,'DPR0020276','Pcs',0.5,8000,4000,'2015-04-13 08:19:13'),('F0002',16,'DPR0020278','Pcs',0.25,12000,3000,'2015-04-13 08:19:13'),('F0002',17,'DPR0020252','Pcs',0.05,14000,700,'2015-04-13 08:19:13'),('F0003',2,'DPR0020136','Bks',1,34500,34500,'2015-04-14 07:15:02'),('F0003',1,'DPR0020137','Bks',20,852,127180,'2015-04-14 07:15:02'),('F0004',10,'DPR0020134','botol',0.05,100454,5022.7,'2015-04-13 08:29:37'),('F0004',9,'DPR0020229','gr',0.005,125000,625,'2015-04-13 08:29:37'),('F0004',8,'DPR0020196','Bks',0.05,600,30,'2015-04-13 08:29:37'),('F0004',7,'DPR0020277','Pak',0.4,3000,1200,'2015-04-13 08:29:37'),('F0004',6,'DPR0020252','Jrgn',0.25,14000,3500,'2015-04-13 08:29:37'),('F0004',5,'DPR0020192','Bks',0.5,5300,2650,'2015-04-13 08:29:37'),('F0004',4,'DPR0020130','Pcs',1.4,89000,124599.99,'2015-04-13 08:29:37'),('F0004',2,'DPR0020278','gr',0.2,12000,2400,'2015-04-13 08:29:37'),('F0004',3,'DPR0020148','Pcs',0.2,20000,4000,'2015-04-13 08:29:37'),('D0001',3,'DPR0020302','Bh ',0.05,75000,3750,'2012-03-17 06:51:02'),('D0001',2,'DPR0020304','Gln',0.27,19000,5130,'2012-03-17 06:51:02'),('D0003',0,'DPR0020263','Pcs',20,1000,20000,'2012-03-17 06:45:10'),('D0003',1,'DPR0020304','Gln',0.27,15000,4050,'2012-03-17 06:45:10'),('D0003',2,'DPR0020302','Bh ',0.05,75000,3750,'2012-03-17 06:45:10'),('D0001',1,'DPR0020199','Bks',40,106,4240,'2012-03-17 06:51:02'),('D0001',0,'DPR0020223','Bks',0.5,14000,7000,'2012-03-17 06:51:02'),('D0001',4,'DPR0020177','Pcs',40,272,10880,'2012-03-17 06:51:02'),('D0004',0,'DPR0020287','Klg',0,4600,0,'2012-03-17 06:54:21'),('F0005',0,'DPR0020164','kg',8,10000,80000,'2012-03-17 07:13:11'),('F0005',1,'DPR0020149','kg',0.1,22000,2200,'2012-03-17 07:13:11'),('F0005',2,'DPR0020147','kg',0.1,22000,2200,'2012-03-17 07:13:11'),('F0005',3,'DPR0020147','botol',0.1,27090,2709,'2012-03-17 07:13:11'),('F0005',4,'DPR0020147','Bks',0.05,400,20,'2012-03-17 07:13:11'),('F0005',5,'DPR0020147','botol',0.05,64242,3212.1,'2012-03-17 07:13:11'),('F0005',6,'DPR0020147','kg',0.05,75000,3750,'2012-03-17 07:13:11'),('F0005',7,'DPR0020167','kg',0.25,36000,9000,'2012-03-17 07:13:11'),('F0006',15,'DPR0020238','botol',0.05,85234,4261.7,'2012-09-20 02:37:14'),('F0006',14,'DPR0020190','gr',0.2,60000,12000,'2012-09-20 02:37:14'),('F0006',13,'DPR0020229','gr',0.01,86827,868.27,'2012-09-20 02:37:14'),('F0006',12,'DPR0020134','botol',0.05,64242,3212.1,'2012-09-20 02:37:14'),('F0006',11,'DPR0020236','Ltr',0.1,12000,1200,'2012-09-20 02:37:14'),('F0006',10,'DPR0020216','botol',0.05,12000,600,'2012-09-20 02:37:14'),('F0006',9,'DPR0020211','botol',0.1,10000,1000,'2012-09-20 02:37:14'),('F0006',8,'DPR0010076','botol',0.1,27090,2709,'2012-09-20 02:37:14'),('F0006',7,'DPR0020171','kg',2,6000,12000,'2012-09-20 02:37:14'),('F0006',6,'DPR0020146','kg',1,12000,12000,'2012-09-20 02:37:14'),('F0006',5,'DPR0020182','kg',0.05,12000,600,'2012-09-20 02:37:14'),('F0006',0,'DPR0020234','kg',2,12000,24000,'2012-09-20 02:37:14'),('F0006',1,'DPR0020157','kg',0.5,37000,18500,'2012-09-20 02:37:14'),('F0006',2,'DPR0020147','kg',0.2,22000,4400,'2012-09-20 02:37:14'),('F0006',3,'DPR0020149','kg',0.2,22000,4400,'2012-09-20 02:37:14'),('F0006',4,'DPR0020122','kg',1.34,18000,24120,'2012-09-20 02:37:14'),('F0006',16,'DPR0020302','kg',0.05,75000,3750,'2012-09-20 02:37:14'),('F0001',10,'DPR0020216','Ltr',0.05,19200,960,'2015-04-14 01:52:57'),('F0001',9,'DPR0020211','Ltr',0.025,15000,375,'2015-04-14 01:52:57'),('F0001',8,'DPR0010076','botol',0.1,35000,3500,'2015-04-14 01:52:57'),('F0001',7,'DPR0020149','Pcs',0.1,20000,2000,'2015-04-14 01:52:57'),('F0001',6,'DPR0020147','Pcs',0.1,35000,3500,'2015-04-14 01:52:57'),('F0001',5,'DPR0020182','Pcs',0.05,12000,600,'2015-04-14 01:52:57'),('F0001',4,'DPR0020166','Pcs',0.1,36000,3600,'2015-04-14 01:52:57'),('F0001',3,'DPR0020122','Pcs',2.7,25000,67500,'2015-04-14 01:52:57'),('F0001',2,'DPR0020157','Pcs',0.25,45000,11250,'2015-04-14 01:52:57'),('F0001',1,'DPR0020239','Pcs',0.5,46400,23200,'2015-04-14 01:52:57'),('F0001',0,'DPR0020123','gr',2,16715,33430,'2015-04-14 01:52:57'),('F0002',18,'DPR0020302','Pcs',0.05,155000,7750,'2015-04-13 08:19:13'),('F0002',19,'DPR0020181','Pcs',0.5,90000,45000,'2015-04-13 08:19:13'),('F0002',20,'DPR0020237','Pcs',0.15,104000,26000,'2015-04-13 08:19:13'),('F0002',21,'DPR0020261','Pcs',10,3292,32920,'2015-04-13 08:19:13'),('F0002',1,'DPR0020239','Pcs',0.5,46000,23000,'2015-04-13 08:19:13'),('F0002',0,'DPR0020123','Pcs',2,16715,33430,'2015-04-13 08:19:13'),('F0003',0,'DPR0020124','Pcs',4,11500,46000,'2015-04-14 07:15:02'),('F0004',1,'DPR0020243','gr',0.2,35000,7000,'2015-04-13 08:29:37'),('F0004',0,'DPR0020122','gr',2.7,25000,67500,'2015-04-13 08:29:37'),('F0004',11,'DPR0020265','kotak',0.5,4900,2450,'2015-04-13 08:29:37');
/*!40000 ALTER TABLE `food_analisa_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'superuser','0000-00-00 00:00:00'),(2,'Administrator','0000-00-00 00:00:00'),(3,'Manager Hotel','2011-10-26 02:43:26'),(4,'General Admin','2017-12-05 09:09:32'),(5,'Admin HO','2011-10-26 02:45:12'),(6,'Front Office','2017-12-05 09:10:00'),(7,'Komisaris','2012-07-24 05:57:56'),(8,'inventory admin','2017-12-06 01:07:06');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inqueue`
--

DROP TABLE IF EXISTS `inqueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inqueue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `modem_id` int(11) DEFAULT NULL,
  `destmsisdn` varchar(20) DEFAULT NULL,
  `msisdn` varchar(20) DEFAULT NULL,
  `qtime` datetime DEFAULT NULL,
  `exectime` datetime DEFAULT NULL,
  `message` varchar(160) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`modem_id`,`msisdn`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inqueue`
--

LOCK TABLES `inqueue` WRITE;
/*!40000 ALTER TABLE `inqueue` DISABLE KEYS */;
/*!40000 ALTER TABLE `inqueue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_receive`
--

DROP TABLE IF EXISTS `invoice_receive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_receive` (
  `invoiceno` varchar(30) NOT NULL,
  `tglinvoice` date NOT NULL,
  `jatuhtempo` date NOT NULL,
  `pomode` varchar(20) NOT NULL,
  `pono` varchar(30) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `invoiceno` (`invoiceno`,`pomode`,`pono`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_receive`
--

LOCK TABLES `invoice_receive` WRITE;
/*!40000 ALTER TABLE `invoice_receive` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_receive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_record`
--

DROP TABLE IF EXISTS `log_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_record` (
  `seqno` int(11) NOT NULL AUTO_INCREMENT,
  `mode` enum('login','logout') DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `branch` varchar(5) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seqno`),
  KEY `mode` (`mode`,`tanggal`,`username`,`groupid`,`branch`,`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_record`
--

LOCK TABLES `log_record` WRITE;
/*!40000 ALTER TABLE `log_record` DISABLE KEYS */;
INSERT INTO `log_record` VALUES (1,'logout','2017-12-06 16:54:03','amalia','',4,'','36.67.224.69','2017-12-06 09:54:03'),(2,'login','2017-12-06 16:54:05','superuser','intan',1,'','36.67.224.69','2017-12-06 09:54:05'),(3,'login','2017-12-06 18:14:55','superuser','intan',1,'','114.125.90.190','2017-12-06 11:14:55'),(4,'login','2017-12-06 20:30:13','yandrie','yandrie94',6,'','36.67.224.69','2017-12-06 13:30:13'),(5,'login','2017-12-06 21:14:49','yandrie','yandrie94',6,'','36.67.224.69','2017-12-06 14:14:49'),(6,'login','2017-12-06 23:11:53','yandrie','yandrie94',6,'','125.164.15.174','2017-12-06 16:11:53'),(7,'logout','2017-12-06 23:38:58','yandrie','',6,'','125.164.15.174','2017-12-06 16:38:58'),(8,'login','2017-12-06 23:39:34','fadil','15101997',6,'','125.164.15.174','2017-12-06 16:39:34'),(9,'login','2017-12-07 06:20:48','fadil','15101997',6,'','125.164.15.174','2017-12-06 23:20:48'),(10,'login','2017-12-07 07:24:02','superuser','intan',1,'','::1','2017-12-07 00:24:02');
/*!40000 ALTER TABLE `log_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_hist_stok`
--

DROP TABLE IF EXISTS `logistik_hist_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_hist_stok` (
  `seqno` bigint(20) NOT NULL AUTO_INCREMENT,
  `in_out` smallint(6) NOT NULL,
  `histdate` date NOT NULL,
  `modulfilename` varchar(255) NOT NULL,
  `mrno` varchar(30) NOT NULL,
  `pono` varchar(30) NOT NULL,
  `wrno` varchar(30) NOT NULL,
  `sourcetype` varchar(20) NOT NULL,
  `sourceid` varchar(10) NOT NULL,
  `desttype` varchar(20) NOT NULL,
  `destid` varchar(10) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seqno`),
  KEY `in_out` (`in_out`,`histdate`,`sourcetype`,`sourceid`,`desttype`,`destid`,`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_hist_stok`
--

LOCK TABLES `logistik_hist_stok` WRITE;
/*!40000 ALTER TABLE `logistik_hist_stok` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_hist_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_mr`
--

DROP TABLE IF EXISTS `logistik_mr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_mr` (
  `mrno` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `periode` date NOT NULL,
  `peruntukan` varchar(20) NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `kadivkonstruksi` varchar(30) NOT NULL,
  `kadivkonstruksidate` datetime NOT NULL,
  `qqc` varchar(30) NOT NULL,
  `qqcdate` datetime NOT NULL,
  `kalogistik` varchar(30) NOT NULL,
  `kalogistikdate` datetime NOT NULL,
  `sitemgr` varchar(30) NOT NULL,
  `sitemgrdate` datetime NOT NULL,
  `sitelogistik` varchar(30) NOT NULL,
  `sitelogistikdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mrno`),
  KEY `kode_pekerjaan` (`kode_pekerjaan`,`tanggal`,`gudang`,`createby`,`kadivkonstruksi`,`qqc`,`kalogistik`,`sitemgr`,`sitelogistik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_mr`
--

LOCK TABLES `logistik_mr` WRITE;
/*!40000 ALTER TABLE `logistik_mr` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_mr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_mr_detail`
--

DROP TABLE IF EXISTS `logistik_mr_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_mr_detail` (
  `mrno` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `rap` double NOT NULL,
  `tot_ming_lalu` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `jumlah` double NOT NULL,
  `harsat` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mrno`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_mr_detail`
--

LOCK TABLES `logistik_mr_detail` WRITE;
/*!40000 ALTER TABLE `logistik_mr_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_mr_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_perm_dana`
--

DROP TABLE IF EXISTS `logistik_perm_dana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_perm_dana` (
  `kodepermohonan` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `mrno` varchar(30) NOT NULL,
  `qrno` varchar(30) NOT NULL,
  `pono` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `posting` varchar(50) NOT NULL,
  `lavelansir` varchar(50) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `admlogistik` varchar(30) NOT NULL,
  `admlogistikdate` datetime NOT NULL,
  `kalogistik` varchar(30) NOT NULL,
  `kalogistikdate` datetime NOT NULL,
  `kadivumum` varchar(30) NOT NULL,
  `kadivumumdate` datetime NOT NULL,
  `dirut` varchar(30) NOT NULL,
  `dirutdate` datetime NOT NULL,
  `withtax` smallint(6) DEFAULT '0',
  `receive` smallint(6) NOT NULL DEFAULT '0',
  `receiveby` varchar(20) NOT NULL,
  `receivedate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodepermohonan`),
  KEY `kode_pekerjaan` (`kode_pekerjaan`,`mrno`,`qrno`,`pono`,`tanggal`,`createby`,`admlogistik`,`kalogistik`,`kadivumum`,`dirut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_perm_dana`
--

LOCK TABLES `logistik_perm_dana` WRITE;
/*!40000 ALTER TABLE `logistik_perm_dana` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_perm_dana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_perm_dana_detail`
--

DROP TABLE IF EXISTS `logistik_perm_dana_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_perm_dana_detail` (
  `kodepermohonan` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodepermohonan`,`seqno`),
  KEY `kodebarng` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_perm_dana_detail`
--

LOCK TABLES `logistik_perm_dana_detail` WRITE;
/*!40000 ALTER TABLE `logistik_perm_dana_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_perm_dana_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_po`
--

DROP TABLE IF EXISTS `logistik_po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_po` (
  `pono` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `kodepermohonan` varchar(30) NOT NULL,
  `qrno` varchar(30) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `tahuby` varchar(30) NOT NULL,
  `tahudate` datetime NOT NULL,
  `setujuby` varchar(30) NOT NULL,
  `setujudate` datetime NOT NULL,
  `withtax` smallint(6) NOT NULL DEFAULT '0',
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pono`),
  KEY `tanggal` (`tanggal`,`kode_pekerjaan`,`kodepermohonan`,`qrno`,`createby`,`tahuby`,`setujuby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_po`
--

LOCK TABLES `logistik_po` WRITE;
/*!40000 ALTER TABLE `logistik_po` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_po_detail`
--

DROP TABLE IF EXISTS `logistik_po_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_po_detail` (
  `pono` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pono`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_po_detail`
--

LOCK TABLES `logistik_po_detail` WRITE;
/*!40000 ALTER TABLE `logistik_po_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_po_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_qr`
--

DROP TABLE IF EXISTS `logistik_qr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_qr` (
  `qrno` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `mrno` varchar(30) NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `periode` date NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`),
  KEY `kode_pekerjaan` (`kode_pekerjaan`,`tanggal`,`periode`,`gudang`,`createby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_qr`
--

LOCK TABLES `logistik_qr` WRITE;
/*!40000 ALTER TABLE `logistik_qr` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_qr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_qr_detail`
--

DROP TABLE IF EXISTS `logistik_qr_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_qr_detail` (
  `qrno` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_qr_detail`
--

LOCK TABLES `logistik_qr_detail` WRITE;
/*!40000 ALTER TABLE `logistik_qr_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_qr_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_qr_vendor`
--

DROP TABLE IF EXISTS `logistik_qr_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_qr_vendor` (
  `qrno` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `seqno` int(11) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `receiveby` varchar(30) NOT NULL,
  `receivedate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`,`vendorid`),
  KEY `tanggal` (`tanggal`,`receiveby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_qr_vendor`
--

LOCK TABLES `logistik_qr_vendor` WRITE;
/*!40000 ALTER TABLE `logistik_qr_vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_qr_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_qr_vendor_detail`
--

DROP TABLE IF EXISTS `logistik_qr_vendor_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_qr_vendor_detail` (
  `qrno` varchar(30) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`,`vendorid`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_qr_vendor_detail`
--

LOCK TABLES `logistik_qr_vendor_detail` WRITE;
/*!40000 ALTER TABLE `logistik_qr_vendor_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_qr_vendor_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_receive_material`
--

DROP TABLE IF EXISTS `logistik_receive_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_receive_material` (
  `recvkode` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `pono` varchar(30) NOT NULL,
  `invoicestat` smallint(6) NOT NULL DEFAULT '0',
  `notes` varchar(100) NOT NULL,
  `recvby` varchar(30) NOT NULL,
  `recvdate` datetime NOT NULL,
  `periksaby` varchar(30) NOT NULL,
  `periksadate` datetime NOT NULL,
  `tahuby` varchar(30) NOT NULL,
  `tahudate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recvkode`),
  KEY `tanggal` (`tanggal`,`kode_pekerjaan`,`pono`,`recvby`,`periksaby`,`tahuby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_receive_material`
--

LOCK TABLES `logistik_receive_material` WRITE;
/*!40000 ALTER TABLE `logistik_receive_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_receive_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_receive_material_detail`
--

DROP TABLE IF EXISTS `logistik_receive_material_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_receive_material_detail` (
  `recvkode` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `poqty` double NOT NULL,
  `outstandingqty` double NOT NULL,
  `recvqty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recvkode`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_receive_material_detail`
--

LOCK TABLES `logistik_receive_material_detail` WRITE;
/*!40000 ALTER TABLE `logistik_receive_material_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_receive_material_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_stock_control`
--

DROP TABLE IF EXISTS `logistik_stock_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_stock_control` (
  `kodecek` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `cekby` varchar(30) NOT NULL,
  `cekdate` datetime NOT NULL,
  `securityby` varchar(30) NOT NULL,
  `securitydate` datetime NOT NULL,
  `dirutby` varchar(30) NOT NULL,
  `dirutdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodecek`),
  KEY `tanggal` (`tanggal`,`cekby`,`securityby`,`dirutby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_stock_control`
--

LOCK TABLES `logistik_stock_control` WRITE;
/*!40000 ALTER TABLE `logistik_stock_control` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_stock_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_stock_control_detail`
--

DROP TABLE IF EXISTS `logistik_stock_control_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_stock_control_detail` (
  `kodecek` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `systemqty` double NOT NULL,
  `realqty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodecek`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_stock_control_detail`
--

LOCK TABLES `logistik_stock_control_detail` WRITE;
/*!40000 ALTER TABLE `logistik_stock_control_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_stock_control_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_stok`
--

DROP TABLE IF EXISTS `logistik_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_stok` (
  `seqno` bigint(20) NOT NULL AUTO_INCREMENT,
  `branchtype` varchar(20) NOT NULL,
  `branchid` varchar(10) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `stock` double NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seqno`),
  KEY `branchtype` (`branchtype`,`branchid`,`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_stok`
--

LOCK TABLES `logistik_stok` WRITE;
/*!40000 ALTER TABLE `logistik_stok` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_transfer_material`
--

DROP TABLE IF EXISTS `logistik_transfer_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_transfer_material` (
  `transkode` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `pono` varchar(30) NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `peruntukan` varchar(50) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `ambilby` varchar(30) NOT NULL,
  `ambildate` datetime NOT NULL,
  `beriby` varchar(30) NOT NULL,
  `beridate` datetime NOT NULL,
  `tahuby` varchar(30) NOT NULL,
  `tahudate` datetime NOT NULL,
  `setujuby` varchar(30) NOT NULL,
  `setujudate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transkode`),
  KEY `tanggal` (`tanggal`,`kode_pekerjaan`,`ambilby`,`beriby`,`tahuby`,`setujuby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_transfer_material`
--

LOCK TABLES `logistik_transfer_material` WRITE;
/*!40000 ALTER TABLE `logistik_transfer_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_transfer_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_transfer_material_detail`
--

DROP TABLE IF EXISTS `logistik_transfer_material_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_transfer_material_detail` (
  `transkode` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `projectqty` double NOT NULL,
  `outstandingqty` double NOT NULL,
  `transqty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transkode`,`seqno`),
  KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_transfer_material_detail`
--

LOCK TABLES `logistik_transfer_material_detail` WRITE;
/*!40000 ALTER TABLE `logistik_transfer_material_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_transfer_material_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_perm_dana`
--

DROP TABLE IF EXISTS `logistik_workshop_perm_dana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_perm_dana` (
  `kodepermohonan` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `partunit` enum('part','unit') NOT NULL,
  `kodeworkshop` varchar(10) NOT NULL,
  `qrno` varchar(30) NOT NULL,
  `pono` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `posting` varchar(50) NOT NULL,
  `lavelansir` varchar(50) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `admlogistik` varchar(30) NOT NULL,
  `admlogistikdate` datetime NOT NULL,
  `kalogistik` varchar(30) NOT NULL,
  `kalogistikdate` datetime NOT NULL,
  `kadivumum` varchar(30) NOT NULL,
  `kadivumumdate` datetime NOT NULL,
  `dirut` varchar(30) NOT NULL,
  `dirutdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodepermohonan`),
  KEY `kode_pekerjaan` (`kode_pekerjaan`,`kodeworkshop`,`qrno`,`pono`,`tanggal`,`createby`,`admlogistik`,`kalogistik`,`kadivumum`,`dirut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_perm_dana`
--

LOCK TABLES `logistik_workshop_perm_dana` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_perm_dana` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_perm_dana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_perm_dana_detail`
--

DROP TABLE IF EXISTS `logistik_workshop_perm_dana_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_perm_dana_detail` (
  `kodepermohonan` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `partno` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kodepermohonan`,`seqno`),
  KEY `partno` (`partno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_perm_dana_detail`
--

LOCK TABLES `logistik_workshop_perm_dana_detail` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_perm_dana_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_perm_dana_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_po`
--

DROP TABLE IF EXISTS `logistik_workshop_po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_po` (
  `pono` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `partunit` enum('part','unit') NOT NULL,
  `kodeworkshop` varchar(10) NOT NULL,
  `kodepermohonan` varchar(30) NOT NULL,
  `qrno` varchar(30) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `tahuby` varchar(30) NOT NULL,
  `tahudate` datetime NOT NULL,
  `setujuby` varchar(30) NOT NULL,
  `setujudate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pono`),
  KEY `tanggal` (`tanggal`,`kode_pekerjaan`,`kodeworkshop`,`qrno`,`createby`,`tahuby`,`setujuby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_po`
--

LOCK TABLES `logistik_workshop_po` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_po` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_po_detail`
--

DROP TABLE IF EXISTS `logistik_workshop_po_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_po_detail` (
  `pono` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `partno` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pono`,`seqno`),
  KEY `partno` (`partno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_po_detail`
--

LOCK TABLES `logistik_workshop_po_detail` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_po_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_po_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_qr`
--

DROP TABLE IF EXISTS `logistik_workshop_qr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_qr` (
  `qrno` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `prno` varchar(30) NOT NULL,
  `kode_pekerjaan` varchar(30) NOT NULL,
  `partunit` enum('part','unit') NOT NULL,
  `kodeworkshop` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `periode` date NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`),
  KEY `prno` (`prno`,`kode_pekerjaan`,`kodeworkshop`,`tanggal`,`periode`,`gudang`,`createby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_qr`
--

LOCK TABLES `logistik_workshop_qr` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_qr` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_qr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_qr_detail`
--

DROP TABLE IF EXISTS `logistik_workshop_qr_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_qr_detail` (
  `qrno` varchar(30) NOT NULL,
  `seqno` int(11) NOT NULL,
  `partno` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`,`seqno`),
  KEY `partno` (`partno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_qr_detail`
--

LOCK TABLES `logistik_workshop_qr_detail` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_qr_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_qr_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_qr_vendor`
--

DROP TABLE IF EXISTS `logistik_workshop_qr_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_qr_vendor` (
  `qrno` varchar(30) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `tanggal` date NOT NULL,
  `seqno` int(11) NOT NULL,
  `kodeworkshop` varchar(10) NOT NULL,
  `receiveby` varchar(30) NOT NULL,
  `receivedate` datetime NOT NULL,
  `actionlink` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`,`vendorid`),
  KEY `tanggal` (`tanggal`,`kodeworkshop`,`receiveby`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_qr_vendor`
--

LOCK TABLES `logistik_workshop_qr_vendor` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_qr_vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_qr_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistik_workshop_qr_vendor_detail`
--

DROP TABLE IF EXISTS `logistik_workshop_qr_vendor_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistik_workshop_qr_vendor_detail` (
  `qrno` varchar(30) NOT NULL,
  `vendorid` varchar(10) NOT NULL,
  `seqno` int(11) NOT NULL,
  `partno` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harsat` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrno`,`vendorid`,`seqno`),
  KEY `partno` (`partno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistik_workshop_qr_vendor_detail`
--

LOCK TABLES `logistik_workshop_qr_vendor_detail` WRITE;
/*!40000 ALTER TABLE `logistik_workshop_qr_vendor_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistik_workshop_qr_vendor_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `seqno` int(11) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `caption` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `menubox` tinyint(1) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_menu`),
  KEY `id_parent` (`id_parent`,`caption`,`url`)
) ENGINE=MyISAM AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,1,0,'HOME','home.php',1,0,'home_icon.gif','2013-02-12 05:01:19'),(2,2,0,'SETUP','box_content_list.php',1,0,'master_icon.gif','2013-02-12 05:01:19'),(3,3,0,'MASTER','#',1,1,'master_icon.gif','2016-02-04 19:34:08'),(9,7,0,'REPORT','#',1,0,'report_icon.gif','2013-02-12 05:01:19'),(10,1,2,'Menu Editor','menu_editor.php',1,0,'','0000-00-00 00:00:00'),(11,2,2,'Group','grouplist.php',1,1,'','2016-02-04 19:35:28'),(12,3,2,'User Account Group','user_account_group.php',1,0,'','0000-00-00 00:00:00'),(13,4,2,'Change Password','user_change_password.php',1,0,'','0000-00-00 00:00:00'),(76,9,3,'Additional','mst_additionallist.php',1,0,'','2013-06-10 03:00:48'),(77,4,0,'PERHOTELAN','#',1,0,'hotel.jpg','2013-02-12 05:01:19'),(78,1,77,'Booking Room','trx_bookinglist.php',1,0,'','0000-00-00 00:00:00'),(79,3,77,'Additional','trx_additionallist.php',1,0,'','0000-00-00 00:00:00'),(80,2,77,'Restaurant','trx_restaurant_billlist.php',1,0,'','0000-00-00 00:00:00'),(81,4,77,'Billing','trx_billinglist.php',1,0,'','0000-00-00 00:00:00'),(75,8,3,'Facility','mst_fasilitaslist.php',1,0,'','2013-06-10 03:00:53'),(70,2,3,'Room','mst_roomlist.php',1,0,'','2013-06-10 02:59:57'),(71,4,3,'Food & Drink','mst_foodlist.php',1,0,'','2013-06-10 03:01:11'),(72,5,3,'Tipe Identitas','mst_id_typelist.php',1,0,'','2013-06-10 03:01:07'),(73,6,3,'Title','mst_name_titlelist.php',1,0,'','2013-06-10 03:01:02'),(74,7,3,'Payment Type','mst_pay_typelist.php',1,0,'','2013-06-10 03:00:57'),(82,5,0,'INVENTORY','#',1,0,'inventory.jpg','2013-02-12 05:01:19'),(83,6,0,'ACCOUNTING','#',1,0,'accounting_icon.gif','2013-02-12 05:01:19'),(84,1,82,'Permintaan Barang','logistik_mrlist.php',1,0,'','0000-00-00 00:00:00'),(85,2,82,'Permintaan Quotation','logistik_qrlist.php',0,0,'','0000-00-00 00:00:00'),(86,3,82,'Permohonan Dana','logistik_perm_danalist.php',1,0,'','0000-00-00 00:00:00'),(87,4,82,'Purchase Order','logistik_polist.php',1,0,'','0000-00-00 00:00:00'),(88,5,82,'Penerimaan Barang','logistik_receive_materiallist.php',1,0,'','0000-00-00 00:00:00'),(89,6,82,'Pengeluaran Barang','logistik_transfer_materiallist.php',1,0,'','0000-00-00 00:00:00'),(90,7,82,'Stok Barang','logistik_stoklist.php',1,0,'','0000-00-00 00:00:00'),(91,8,82,'Kontrol Stok','logistik_stock_controllist.php',1,0,'','0000-00-00 00:00:00'),(92,1,83,'Design Report GL','acc_design_report_gllist.php',0,0,'','2011-10-26 02:54:59'),(93,2,83,'Design Report RL','acc_design_report_rllist.php',1,0,'','0000-00-00 00:00:00'),(94,4,83,'Jurnal','acc_jurnallist.php',1,0,'','2012-09-05 02:19:48'),(95,5,83,'Invoice','invoice_receivelist.php',0,0,'','2012-09-05 02:19:34'),(96,3,9,'Inventory Report','#',1,0,'','0000-00-00 00:00:00'),(97,1,9,'Accounting Report','#',1,0,'','0000-00-00 00:00:00'),(98,2,9,'Hotel & Restaurant Report','#',1,0,'','0000-00-00 00:00:00'),(99,1,96,'Stok Barang','rpt_material_stock.php',1,0,'','0000-00-00 00:00:00'),(100,2,96,'Stok Barang Masuk','rpt_material_stock_in.php',1,0,'','0000-00-00 00:00:00'),(101,3,96,'Stok Barang Keluar','rpt_material_stock_out.php',1,0,'','0000-00-00 00:00:00'),(102,1,97,'Jurnal','acc_jurnal_rpt.php',1,0,'','0000-00-00 00:00:00'),(103,2,97,'General Ledger','acc_gl_rpt.php',0,0,'','2011-10-26 02:57:15'),(104,7,97,'Rugi Laba','acc_rl_rpt.php',1,0,'','0000-00-00 00:00:00'),(105,12,3,'Barang','mst_material_partlist.php',1,0,'','2013-06-10 03:00:36'),(106,11,3,'Tipe Barang','mst_modelunitlist.php',1,0,'','2013-06-10 03:00:40'),(107,13,3,'Satuan','mst_satuanlist.php',1,0,'','2013-06-10 03:00:32'),(108,14,3,'Supplier','mst_vendorlist.php',1,0,'','2013-06-10 03:00:28'),(109,8,0,'TOOLS','#',0,0,'tools_icon.gif','2017-11-27 23:21:22'),(110,1,109,'Backup & Restore','tool_backup.php',0,0,'','2016-03-09 09:46:05'),(111,15,3,'Room Discount','mst_discountlist.php',1,0,'','2013-06-10 03:00:24'),(112,16,3,'Master COA','acc_mst_coalist.php',1,0,'','2013-06-10 03:00:18'),(113,10,3,'Category Barang','mst_material_catlist.php',1,0,'','2013-06-10 03:00:44'),(114,17,3,'COA Setting','acc_setting_coalist.php',1,0,'','2013-06-10 03:00:12'),(115,5,77,'Restaurant Orders','trx_restaurant_order.php',1,0,'','0000-00-00 00:00:00'),(116,6,77,'Booking List','rpt_bookinglist.php',1,0,'','0000-00-00 00:00:00'),(117,7,77,'Booking Matrix','rpt_booking_matrix.php',1,0,'','0000-00-00 00:00:00'),(118,18,3,'Master Foods Package/Group','mst_makangrouplist.php',1,0,'','2017-11-27 23:18:30'),(119,3,97,'Kas Penerimaan','rpt_acc_kas_penerimaan.php',1,0,'','0000-00-00 00:00:00'),(120,4,97,'Kas Pengeluaran','rpt_acc_kas_pengeluaran.php',1,0,'','0000-00-00 00:00:00'),(121,6,83,'Asset Category','asset_categorylist.php',1,0,'','2012-09-05 02:19:25'),(122,7,83,'Asset Management','acc_asset_management.php',1,0,'','2012-09-05 02:19:06'),(123,5,97,'Jurnal Asset','rpt_acc_jurnal_asset.php',1,0,'','0000-00-00 00:00:00'),(124,6,97,'Neraca','rpt_acc_neraca.php',1,0,'','0000-00-00 00:00:00'),(126,3,109,'Upload Kas','tool_upload_kas.php',0,0,'','2016-03-09 09:46:28'),(127,4,109,'Upload Inventory','tool_upload_inventory.php',0,0,'','2016-03-09 09:46:39'),(128,1,71,'Analisa Harga','food_analisaadd.php',0,0,'','2012-02-27 02:41:17'),(132,19,3,'Harga Jual Barang','mst_harga_tokolist.php',1,0,'','2013-06-10 03:00:04'),(133,8,77,'Toko','trx_posadd.php',1,0,'','2012-09-12 15:29:50'),(134,3,83,'Transaksi Harian','trx_mutasi_uanglist.php',1,0,'','2012-09-05 02:19:48'),(135,8,97,'Mutasi Kas','rpt_mutasikas.php',1,0,'','2012-09-05 02:26:38'),(136,9,97,'Mutasi Bank','rpt_mutasibank.php',1,0,'','2012-09-12 15:31:55'),(138,9,77,'Transaksi Toko','trx_poslist.php',1,0,'','2013-03-30 13:47:02'),(139,1,3,'Room Type','mst_room_typelist.php',1,0,'','2013-06-10 02:59:57'),(140,3,3,'Room Price','mst_room_pricelist.php',0,0,'','2017-12-03 10:56:52');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_group`
--

DROP TABLE IF EXISTS `menu_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_group` (
  `id_menu` int(11) NOT NULL DEFAULT '0',
  `id_group` int(11) NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_menu`,`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_group`
--

LOCK TABLES `menu_group` WRITE;
/*!40000 ALTER TABLE `menu_group` DISABLE KEYS */;
INSERT INTO `menu_group` VALUES (101,3,'2017-12-06 08:08:24'),(100,3,'2017-12-06 08:08:24'),(99,3,'2017-12-06 08:08:24'),(96,3,'2017-12-06 08:08:24'),(136,3,'2017-12-06 08:08:24'),(135,3,'2017-12-06 08:08:24'),(104,3,'2017-12-06 08:08:24'),(125,2,'2013-06-10 03:02:16'),(110,2,'2013-06-10 03:02:16'),(109,2,'2013-06-10 03:02:16'),(101,2,'2013-06-10 03:02:16'),(100,2,'2013-06-10 03:02:16'),(99,2,'2013-06-10 03:02:16'),(96,2,'2013-06-10 03:02:16'),(98,2,'2013-06-10 03:02:16'),(136,2,'2013-06-10 03:02:16'),(135,2,'2013-06-10 03:02:16'),(104,2,'2013-06-10 03:02:16'),(124,2,'2013-06-10 03:02:16'),(123,2,'2013-06-10 03:02:16'),(120,2,'2013-06-10 03:02:16'),(119,2,'2013-06-10 03:02:16'),(103,2,'2013-06-10 03:02:16'),(102,2,'2013-06-10 03:02:16'),(97,2,'2013-06-10 03:02:16'),(9,2,'2013-06-10 03:02:16'),(122,2,'2013-06-10 03:02:16'),(121,2,'2013-06-10 03:02:16'),(95,2,'2013-06-10 03:02:16'),(94,2,'2013-06-10 03:02:16'),(134,2,'2013-06-10 03:02:16'),(93,2,'2013-06-10 03:02:16'),(92,2,'2013-06-10 03:02:16'),(83,2,'2013-06-10 03:02:16'),(91,2,'2013-06-10 03:02:16'),(90,2,'2013-06-10 03:02:16'),(89,2,'2013-06-10 03:02:16'),(88,2,'2013-06-10 03:02:16'),(87,2,'2013-06-10 03:02:16'),(86,2,'2013-06-10 03:02:16'),(85,2,'2013-06-10 03:02:16'),(84,2,'2013-06-10 03:02:16'),(82,2,'2013-06-10 03:02:16'),(138,2,'2013-06-10 03:02:16'),(133,2,'2013-06-10 03:02:16'),(117,2,'2013-06-10 03:02:16'),(116,2,'2013-06-10 03:02:16'),(115,2,'2013-06-10 03:02:16'),(81,2,'2013-06-10 03:02:16'),(79,2,'2013-06-10 03:02:16'),(80,2,'2013-06-10 03:02:16'),(78,2,'2013-06-10 03:02:16'),(77,2,'2013-06-10 03:02:16'),(132,2,'2013-06-10 03:02:16'),(118,2,'2013-06-10 03:02:16'),(114,2,'2013-06-10 03:02:16'),(112,2,'2013-06-10 03:02:16'),(111,2,'2013-06-10 03:02:16'),(108,2,'2013-06-10 03:02:16'),(107,2,'2013-06-10 03:02:16'),(105,2,'2013-06-10 03:02:16'),(106,2,'2013-06-10 03:02:16'),(113,2,'2013-06-10 03:02:16'),(76,2,'2013-06-10 03:02:16'),(75,2,'2013-06-10 03:02:16'),(74,2,'2013-06-10 03:02:16'),(73,2,'2013-06-10 03:02:16'),(72,2,'2013-06-10 03:02:16'),(128,2,'2013-06-10 03:02:16'),(71,2,'2013-06-10 03:02:16'),(140,2,'2013-06-10 03:02:16'),(124,3,'2017-12-06 08:08:24'),(123,3,'2017-12-06 08:08:24'),(120,3,'2017-12-06 08:08:24'),(119,3,'2017-12-06 08:08:24'),(103,3,'2017-12-06 08:08:24'),(102,3,'2017-12-06 08:08:24'),(97,3,'2017-12-06 08:08:24'),(9,3,'2017-12-06 08:08:24'),(122,3,'2017-12-06 08:08:24'),(121,3,'2017-12-06 08:08:24'),(95,3,'2017-12-06 08:08:24'),(94,3,'2017-12-06 08:08:24'),(134,3,'2017-12-06 08:08:24'),(83,3,'2017-12-06 08:08:24'),(91,3,'2017-12-06 08:08:24'),(90,3,'2017-12-06 08:08:24'),(89,3,'2017-12-06 08:08:24'),(88,3,'2017-12-06 08:08:24'),(87,3,'2017-12-06 08:08:24'),(86,3,'2017-12-06 08:08:24'),(85,3,'2017-12-06 08:08:24'),(84,3,'2017-12-06 08:08:24'),(82,3,'2017-12-06 08:08:24'),(138,3,'2017-12-06 08:08:24'),(133,3,'2017-12-06 08:08:24'),(117,3,'2017-12-06 08:08:24'),(116,3,'2017-12-06 08:08:24'),(81,3,'2017-12-06 08:08:24'),(79,3,'2017-12-06 08:08:24'),(80,3,'2017-12-06 08:08:24'),(78,3,'2017-12-06 08:08:24'),(77,3,'2017-12-06 08:08:24'),(132,3,'2017-12-06 08:08:24'),(118,3,'2017-12-06 08:08:24'),(114,3,'2017-12-06 08:08:24'),(112,3,'2017-12-06 08:08:24'),(111,3,'2017-12-06 08:08:24'),(108,3,'2017-12-06 08:08:24'),(107,3,'2017-12-06 08:08:24'),(105,3,'2017-12-06 08:08:24'),(106,3,'2017-12-06 08:08:24'),(113,3,'2017-12-06 08:08:24'),(76,3,'2017-12-06 08:08:24'),(101,8,'2017-12-06 01:07:46'),(100,8,'2017-12-06 01:07:46'),(99,8,'2017-12-06 01:07:46'),(96,8,'2017-12-06 01:07:46'),(9,8,'2017-12-06 01:07:46'),(91,8,'2017-12-06 01:07:46'),(12,8,'2017-12-06 01:07:46'),(101,4,'2017-12-05 09:12:29'),(100,4,'2017-12-05 09:12:29'),(99,4,'2017-12-05 09:12:29'),(136,4,'2017-12-05 09:12:29'),(135,4,'2017-12-05 09:12:29'),(104,4,'2017-12-05 09:12:29'),(124,4,'2017-12-05 09:12:29'),(123,4,'2017-12-05 09:12:29'),(120,4,'2017-12-05 09:12:29'),(119,4,'2017-12-05 09:12:29'),(103,4,'2017-12-05 09:12:29'),(102,4,'2017-12-05 09:12:29'),(97,4,'2017-12-05 09:12:29'),(9,4,'2017-12-05 09:12:29'),(122,4,'2017-12-05 09:12:29'),(121,4,'2017-12-05 09:12:29'),(95,4,'2017-12-05 09:12:29'),(94,4,'2017-12-05 09:12:29'),(134,4,'2017-12-05 09:12:29'),(83,4,'2017-12-05 09:12:29'),(138,4,'2017-12-05 09:12:29'),(133,4,'2017-12-05 09:12:29'),(117,4,'2017-12-05 09:12:29'),(116,4,'2017-12-05 09:12:29'),(115,4,'2017-12-05 09:12:29'),(81,4,'2017-12-05 09:12:29'),(79,4,'2017-12-05 09:12:29'),(80,4,'2017-12-05 09:12:29'),(78,4,'2017-12-05 09:12:29'),(77,4,'2017-12-05 09:12:29'),(132,4,'2017-12-05 09:12:29'),(118,4,'2017-12-05 09:12:29'),(114,4,'2017-12-05 09:12:29'),(112,4,'2017-12-05 09:12:29'),(111,4,'2017-12-05 09:12:29'),(108,4,'2017-12-05 09:12:29'),(107,4,'2017-12-05 09:12:29'),(100,5,'2013-06-10 03:02:58'),(99,5,'2013-06-10 03:02:58'),(96,5,'2013-06-10 03:02:58'),(98,5,'2013-06-10 03:02:58'),(136,5,'2013-06-10 03:02:58'),(135,5,'2013-06-10 03:02:58'),(104,5,'2013-06-10 03:02:58'),(124,5,'2013-06-10 03:02:58'),(123,5,'2013-06-10 03:02:58'),(120,5,'2013-06-10 03:02:58'),(119,5,'2013-06-10 03:02:58'),(103,5,'2013-06-10 03:02:58'),(102,5,'2013-06-10 03:02:58'),(97,5,'2013-06-10 03:02:58'),(9,5,'2013-06-10 03:02:58'),(122,5,'2013-06-10 03:02:58'),(121,5,'2013-06-10 03:02:58'),(95,5,'2013-06-10 03:02:58'),(94,5,'2013-06-10 03:02:58'),(134,5,'2013-06-10 03:02:58'),(93,5,'2013-06-10 03:02:58'),(92,5,'2013-06-10 03:02:58'),(83,5,'2013-06-10 03:02:58'),(91,5,'2013-06-10 03:02:58'),(90,5,'2013-06-10 03:02:58'),(89,5,'2013-06-10 03:02:58'),(88,5,'2013-06-10 03:02:58'),(87,5,'2013-06-10 03:02:58'),(86,5,'2013-06-10 03:02:58'),(85,5,'2013-06-10 03:02:58'),(84,5,'2013-06-10 03:02:58'),(82,5,'2013-06-10 03:02:58'),(138,5,'2013-06-10 03:02:58'),(133,5,'2013-06-10 03:02:58'),(117,5,'2013-06-10 03:02:58'),(116,5,'2013-06-10 03:02:58'),(81,5,'2013-06-10 03:02:58'),(79,5,'2013-06-10 03:02:58'),(80,5,'2013-06-10 03:02:58'),(78,5,'2013-06-10 03:02:58'),(77,5,'2013-06-10 03:02:58'),(118,5,'2013-06-10 03:02:58'),(114,5,'2013-06-10 03:02:58'),(112,5,'2013-06-10 03:02:58'),(111,5,'2013-06-10 03:02:58'),(108,5,'2013-06-10 03:02:58'),(107,5,'2013-06-10 03:02:58'),(105,5,'2013-06-10 03:02:58'),(106,5,'2013-06-10 03:02:58'),(113,5,'2013-06-10 03:02:58'),(76,5,'2013-06-10 03:02:58'),(75,5,'2013-06-10 03:02:58'),(74,5,'2013-06-10 03:02:58'),(73,5,'2013-06-10 03:02:58'),(72,5,'2013-06-10 03:02:58'),(128,5,'2013-06-10 03:02:58'),(71,5,'2013-06-10 03:02:58'),(90,8,'2017-12-06 01:07:46'),(89,8,'2017-12-06 01:07:46'),(88,8,'2017-12-06 01:07:46'),(87,8,'2017-12-06 01:07:46'),(86,8,'2017-12-06 01:07:46'),(85,8,'2017-12-06 01:07:46'),(84,8,'2017-12-06 01:07:46'),(82,8,'2017-12-06 01:07:46'),(108,8,'2017-12-06 01:07:46'),(107,8,'2017-12-06 01:07:46'),(105,8,'2017-12-06 01:07:46'),(106,8,'2017-12-06 01:07:46'),(113,8,'2017-12-06 01:07:46'),(3,8,'2017-12-06 01:07:46'),(13,8,'2017-12-06 01:07:46'),(2,8,'2017-12-06 01:07:46'),(1,8,'2017-12-06 01:07:46'),(101,6,'2017-12-05 09:12:37'),(100,6,'2017-12-05 09:12:37'),(99,6,'2017-12-05 09:12:37'),(138,6,'2017-12-05 09:12:37'),(133,6,'2017-12-05 09:12:37'),(117,6,'2017-12-05 09:12:37'),(116,6,'2017-12-05 09:12:37'),(115,6,'2017-12-05 09:12:37'),(81,6,'2017-12-05 09:12:37'),(79,6,'2017-12-05 09:12:37'),(80,6,'2017-12-05 09:12:37'),(78,6,'2017-12-05 09:12:37'),(77,6,'2017-12-05 09:12:37'),(13,6,'2017-12-05 09:12:37'),(105,4,'2017-12-05 09:12:29'),(70,2,'2013-06-10 03:02:16'),(74,3,'2017-12-06 08:08:24'),(106,4,'2017-12-05 09:12:29'),(140,5,'2013-06-10 03:02:58'),(113,4,'2017-12-05 09:12:29'),(128,3,'2017-12-06 08:08:24'),(139,2,'2013-06-10 03:02:16'),(76,4,'2017-12-05 09:12:29'),(75,4,'2017-12-05 09:12:29'),(99,7,'2012-09-13 07:31:54'),(96,7,'2012-09-13 07:31:54'),(98,7,'2012-09-13 07:31:54'),(136,7,'2012-09-13 07:31:54'),(135,7,'2012-09-13 07:31:54'),(123,7,'2012-09-13 07:31:54'),(120,7,'2012-09-13 07:31:54'),(119,7,'2012-09-13 07:31:54'),(102,7,'2012-09-13 07:31:54'),(97,7,'2012-09-13 07:31:54'),(9,7,'2012-09-13 07:31:54'),(117,7,'2012-09-13 07:31:54'),(116,7,'2012-09-13 07:31:54'),(77,7,'2012-09-13 07:31:54'),(13,7,'2012-09-13 07:31:54'),(2,7,'2012-09-13 07:31:54'),(1,7,'2012-09-13 07:31:54'),(3,2,'2013-06-10 03:02:16'),(13,2,'2013-06-10 03:02:16'),(71,3,'2017-12-06 08:08:24'),(70,3,'2017-12-06 08:08:24'),(139,3,'2017-12-06 08:08:24'),(12,2,'2013-06-10 03:02:16'),(128,4,'2017-12-05 09:12:29'),(70,4,'2017-12-05 09:12:29'),(70,5,'2013-06-10 03:02:58'),(3,5,'2013-06-10 03:02:58'),(13,5,'2013-06-10 03:02:58'),(11,2,'2013-06-10 03:02:16'),(3,3,'2017-12-06 08:08:24'),(139,4,'2017-12-05 09:12:29'),(2,5,'2013-06-10 03:02:58'),(2,6,'2017-12-05 09:12:37'),(100,7,'2012-09-13 07:31:54'),(101,7,'2012-09-13 07:31:54'),(3,4,'2017-12-05 09:12:29'),(13,3,'2017-12-06 08:08:24'),(10,2,'2013-06-10 03:02:16'),(13,4,'2017-12-05 09:12:29'),(1,5,'2013-06-10 03:02:58'),(1,6,'2017-12-05 09:12:37'),(2,2,'2013-06-10 03:02:16'),(1,2,'2013-06-10 03:02:16'),(2,3,'2017-12-06 08:08:24'),(1,3,'2017-12-06 08:08:24'),(2,4,'2017-12-05 09:12:29'),(1,4,'2017-12-05 09:12:29'),(101,5,'2013-06-10 03:02:58');
/*!40000 ALTER TABLE `menu_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_additional`
--

DROP TABLE IF EXISTS `mst_additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_additional` (
  `kode` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_additional`
--

LOCK TABLES `mst_additional` WRITE;
/*!40000 ALTER TABLE `mst_additional` DISABLE KEYS */;
INSERT INTO `mst_additional` VALUES ('Ad001','Voucher Beach Club(snorkling/pedal boat/sea kayak)',90000,'2016-10-27 02:56:42'),('AD002','Fun Game',65000,'2016-10-27 02:56:52'),('AD003','Organ Tunggal',4250000,'2015-01-20 03:30:42'),('AD999','Lainnya',0,'0000-00-00 00:00:00'),('AD004','Driver Room',150000,'2015-01-20 03:30:57'),('AD005','Suling Performance',1000000,'2016-10-27 02:57:08'),('AD006','Kapal Nelayan',1000000,'2015-01-20 03:32:02'),('AD007','Kambing Guling',3000000,'2015-01-20 03:32:40'),('AD008','Api Unggun',300000,'2015-01-20 03:33:01'),('AD009','Extrabed',250000,'2016-10-27 07:28:57'),('AD010','Charge Person',185000,'2016-10-27 07:29:36'),('AD011','Paket Pulau Liwungan',1000000,'2017-11-18 10:20:45');
/*!40000 ALTER TABLE `mst_additional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_discount`
--

DROP TABLE IF EXISTS `mst_discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_discount`
--

LOCK TABLES `mst_discount` WRITE;
/*!40000 ALTER TABLE `mst_discount` DISABLE KEYS */;
INSERT INTO `mst_discount` VALUES (1,'Compliment','Compliment Discount',100,'0000-00-00 00:00:00'),(2,'Mancing Mania','Mancing Mania',10,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `mst_discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_fasilitas`
--

DROP TABLE IF EXISTS `mst_fasilitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_fasilitas` (
  `kode` varchar(5) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_fasilitas`
--

LOCK TABLES `mst_fasilitas` WRITE;
/*!40000 ALTER TABLE `mst_fasilitas` DISABLE KEYS */;
INSERT INTO `mst_fasilitas` VALUES ('00001','Extra Bed',100000,'0000-00-00 00:00:00'),('2','Hot Water',50000,'0000-00-00 00:00:00'),('3','Bike',100000,'2016-03-09 08:02:37');
/*!40000 ALTER TABLE `mst_fasilitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_food`
--

DROP TABLE IF EXISTS `mst_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_food` (
  `kode` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_food`
--

LOCK TABLES `mst_food` WRITE;
/*!40000 ALTER TABLE `mst_food` DISABLE KEYS */;
INSERT INTO `mst_food` VALUES ('F0001','Damar Fried Rice',42000,'2017-11-28 13:43:04'),('F0002','Damar Lamb Fried Rice',48000,'2017-11-28 13:43:12'),('F0003','Damar Bread',20000,'2017-11-28 13:43:15'),('F0004','Damar Egg',48000,'2017-11-28 13:43:18'),('D0001','Hot/Iced Coffee',14000,'2016-09-04 10:09:56'),('D0002','Hot/Iced Tea',14000,'2016-09-04 10:10:14'),('D0003','Hot/Iced Milk',14000,'2017-07-04 23:34:08'),('D0004','Pocari Sweat',14000,'2016-09-04 10:10:54'),('F9999','Makanan Lainnya',0,'0000-00-00 00:00:00'),('D9999','Minuman Lainnya',0,'0000-00-00 00:00:00'),('F0005','Damar Bean',32000,'2017-11-28 13:43:20'),('F0006','Damar Rice Noodle',42000,'2017-11-28 13:43:25'),('F0007','Damar Noodle',42000,'2017-11-28 13:43:28'),('F0008','Chick In Nugget',30000,'2016-09-04 10:12:36'),('F0009','Rendang',26000,'2016-09-04 10:13:04'),('F0010','Orange & Green Veggie',32000,'2016-09-04 10:13:22'),('F0011','French Fries',30000,'2016-09-04 10:13:45'),('F0012','Rice',10000,'2016-09-04 10:14:04'),('F0013','Damar Banana',30000,'2017-11-28 13:43:31'),('D0005','Mineral Water',8000,'2016-09-04 10:16:16'),('D0006','Fanta / Coca Cola / Sprite',14000,'2016-09-04 10:17:51'),('D0007','Hot/Ice Lemon Tea',14000,'2017-07-04 23:36:36'),('D0008','Lemon Squash',23000,'2016-09-04 10:18:42'),('D0009','Fresh Coconut',20000,'2016-09-04 10:19:21'),('D0010','Damar Happy Soda',25000,'2017-11-28 13:43:34'),('D0011','Damar Milk Soda',25000,'2017-11-28 13:43:39'),('D0012','Orange Juice',25000,'2016-09-04 10:21:11'),('F0014','Cap Cay',48000,'2016-09-04 10:21:33'),('F0015','Gado Gado',42000,'2016-09-04 10:21:47'),('F0016','Cah Caisim',28000,'2016-09-04 10:21:56'),('F0017','Cah Touge',28000,'2016-09-04 10:22:06'),('F0018','Labu Cah Ebi',30000,'2016-09-04 10:22:19'),('F0019','Cah Kangkung',28000,'2016-09-04 10:22:36'),('F0020','Pokcoy Saus Tiram',30000,'2016-09-04 10:22:54'),('F0021','Kacang Panjang Cah Bombay',30000,'2016-09-04 10:23:08'),('F0022','Tumis Sawi Putih',30000,'2016-09-04 10:23:23'),('F0023','Buncis Cah Telur',30000,'2016-09-04 10:23:40'),('S0001','Pisang Goreng',30000,'2016-09-04 10:24:10'),('S0002','Tempe Mendoan',25000,'2016-09-04 10:24:26'),('S0003','Tahu Isi',25000,'2016-09-04 10:24:41'),('S0004','Bala Bala',25000,'2016-09-04 10:25:01'),('S0005','Bakwan Udang',25000,'2016-09-04 10:25:11'),('S0006','Roti Goreng Telur',25000,'2016-09-04 10:25:28'),('S0007','Sosis Gulung',30000,'2016-09-04 10:25:42'),('J0001','Jus Alpukat',22000,'2016-09-04 10:26:03'),('J0002','Jus Apel',22000,'2016-09-04 10:26:15'),('J0003','Jus Melon',22000,'2016-09-04 10:26:30'),('J0004','Jus Mangga',22000,'2016-09-04 10:26:45'),('J0005','Jus Tomat',22000,'2016-09-04 10:26:58'),('J0006','Jus Wortel',22000,'2016-09-04 10:27:12'),('J0007','Jus Semangka',22000,'2016-09-04 10:27:25'),('J0008','Mix Juice',24000,'2016-09-04 10:27:41'),('F0024','Ayam goreng',25000,'2016-09-04 10:28:03'),('F0025','Ayam goreng tepung',25000,'2016-09-04 10:28:16'),('F0026','Ayam Bakar',30000,'2016-09-04 10:28:31'),('F0027','Ayam Saus Mentega',58000,'2016-09-04 10:28:45'),('F0028','Ayam Saus Tiram',58000,'2016-09-04 10:28:58'),('F0029','Ayam Bumbu Kecap',58000,'2016-09-04 10:29:14'),('F0031','Steak Fish',70000,'2012-08-16 08:23:37'),('F0032','Nasi Goreng Seafood',48000,'2016-09-04 10:29:48'),('F0033','Nasi Goreng Sosis',48000,'2016-09-04 10:30:10'),('D0013','Milo',14000,'2016-09-04 10:30:30'),('D0014','Coffemix',14000,'2016-09-04 10:30:41'),('D0015','Cappucinno',14000,'2016-09-04 10:30:54'),('D0016','Bandrek',12000,'2016-09-04 10:31:08'),('D0017','Jahe Wangi',12000,'2016-09-04 10:31:24'),('D0018','Bir Bintang(Klg)',36000,'2016-09-04 10:31:36'),('D0019','Lemon Tea',14000,'2016-09-04 10:31:57'),('D0020','Thai Ice Coffee',20000,'2016-09-04 10:32:19'),('D0021','Thai Ice Tea',20000,'2016-09-04 10:32:35'),('D0022','Sop Buah',30000,'2016-09-04 10:32:53'),('F0034','Indomie Telur',25000,'2016-09-04 10:33:20'),('D0023','Kopi Susu',14000,'2016-09-04 10:33:37'),('D0024','Teh Jawa Vanila/Teh Jawa Melati/Teh Dandang',28000,'2016-09-04 10:33:50'),('D0025','Teh Dandang Selection/Teh Lestari',34000,'2016-09-04 10:34:13'),('D0026','Teh Oolong from Taiwan',42000,'2016-09-04 10:34:25'),('F0030','Ayam Rica Rica',58000,'2016-09-04 10:34:39'),('S0008','Toast Bread With Cornet',42000,'2016-09-04 10:35:05'),('S0009','Bakwan Jagung',25000,'2016-09-04 10:38:15'),('F0035','Garang Asam Daging',56000,'2016-09-04 10:35:40'),('F0036','Rawon Sapi',44000,'2016-09-04 10:35:55'),('F0037','Soto Ayam',44000,'2016-09-04 10:36:19'),('F0038','Bakso',32000,'2016-09-04 10:36:33'),('D0027','Wedang Uwuh',20000,'2015-12-11 13:16:48'),('F0039','Ayam goreng bumbu lengkuas',25000,'2017-07-04 23:28:32'),('F0040','Nasi Bakar',25000,'2017-07-04 23:28:59'),('D0028','Coffee Mocca',14000,'2017-07-04 23:43:05');
/*!40000 ALTER TABLE `mst_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_harga_toko`
--

DROP TABLE IF EXISTS `mst_harga_toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_harga_toko` (
  `kode` varchar(20) NOT NULL,
  `harga` double NOT NULL,
  `createby` varchar(20) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_harga_toko`
--

LOCK TABLES `mst_harga_toko` WRITE;
/*!40000 ALTER TABLE `mst_harga_toko` DISABLE KEYS */;
INSERT INTO `mst_harga_toko` VALUES ('BFS0060001',20000,'lestari','2017-01-22 14:26:39'),('BFS0060002',30000,'lestari','2017-01-22 14:26:39'),('BFS0060003',25000,'lestari','2017-01-22 14:26:39'),('BFS0060004',25000,'lestari','2017-01-22 14:26:39'),('BFS0060005',5000,'lestari','2017-01-22 14:26:39'),('BFS0060006',7000,'lestari','2017-01-22 14:26:39'),('BFS0060007',2500,'lestari','2017-01-22 14:26:39'),('BFS0060008',30000,'lestari','2017-01-22 14:26:39'),('BFS0060009',75000,'lestari','2017-01-22 14:26:39'),('BFS0060010',60000,'lestari','2017-01-22 14:26:39'),('BFS0060011',2000,'lestari','2017-01-22 14:26:39'),('BFS0060012',2000,'lestari','2017-01-22 14:26:39'),('BFS0060013',2000,'lestari','2017-01-22 14:26:39'),('BFS0060014',2000,'lestari','2017-01-22 14:26:39'),('BFS0060015',20000,'lestari','2017-01-22 14:26:39'),('BFS0060016',20000,'lestari','2017-01-22 14:26:39'),('BFS0060017',30000,'lestari','2017-01-22 14:26:39'),('BFS0060018',30000,'lestari','2017-01-22 14:26:39'),('BFS0060019',30000,'lestari','2017-01-22 14:26:39'),('BFS0060020',20000,'lestari','2017-01-22 14:26:39'),('BFS0060021',95000,'lestari','2017-01-22 14:26:39'),('BFS0060022',75000,'lestari','2017-01-22 14:26:39'),('BFS0060023',40000,'lestari','2017-01-22 14:26:39'),('BFS0060024',35000,'lestari','2017-01-22 14:26:39'),('BFS0060025',60000,'lestari','2017-01-22 14:26:39'),('BFS0060027',2000,'lestari','2017-01-22 14:26:39'),('BFS0060028',25000,'lestari','2017-01-22 14:26:39'),('BFS0060029',90000,'lestari','2017-01-22 14:26:39'),('BFS0060030',10000,'lestari','2017-01-22 14:26:39'),('BFS0060031',80000,'lestari','2017-01-22 14:26:39'),('BFS0060032',25000,'lestari','2017-01-22 14:26:39'),('BFS0060026',2000,'lestari','2017-01-22 14:26:39'),('BFS0060033',60000,'lestari','2017-01-22 14:26:39'),('BFS0060034',250000,'lestari','2017-01-22 14:26:39'),('BFS0060035',400000,'lestari','2017-01-22 14:26:39'),('BFS0060036',10000,'lestari','2017-01-22 14:26:39'),('BFS0060037',100000,'lestari','2017-01-22 14:26:39'),('BFS0060038',100000,'lestari','2017-01-22 14:26:39'),('BFS0060039',0,'lestari','2017-01-22 14:26:39'),('BFS0060040',60000,'lestari','2017-01-22 14:26:39'),('BFS0060041',30000,'lestari','2017-01-22 14:26:39'),('BSF0060042',30000,'lestari','2017-01-22 14:26:39');
/*!40000 ALTER TABLE `mst_harga_toko` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_id_type`
--

DROP TABLE IF EXISTS `mst_id_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_id_type` (
  `kode` varchar(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_id_type`
--

LOCK TABLES `mst_id_type` WRITE;
/*!40000 ALTER TABLE `mst_id_type` DISABLE KEYS */;
INSERT INTO `mst_id_type` VALUES ('KTP','KTP','0000-00-00 00:00:00'),('SIM','SIM','0000-00-00 00:00:00'),('001','Passport','0000-00-00 00:00:00'),('KTS','KITAS','2013-10-13 09:25:37');
/*!40000 ALTER TABLE `mst_id_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_makangroup`
--

DROP TABLE IF EXISTS `mst_makangroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_makangroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_makangroup`
--

LOCK TABLES `mst_makangroup` WRITE;
/*!40000 ALTER TABLE `mst_makangroup` DISABLE KEYS */;
INSERT INTO `mst_makangroup` VALUES (1,'breakfast',54000,'2016-10-27 02:13:50'),(2,'lunch',72000,'2016-10-27 02:13:59'),(3,'bbq',210000,'2016-10-27 02:14:43'),(4,'dinner',102000,'2016-10-27 02:14:52'),(5,'snack',30000,'2016-10-27 02:15:01');
/*!40000 ALTER TABLE `mst_makangroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_material_cat`
--

DROP TABLE IF EXISTS `mst_material_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_material_cat` (
  `id` varchar(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_material_cat`
--

LOCK TABLES `mst_material_cat` WRITE;
/*!40000 ALTER TABLE `mst_material_cat` DISABLE KEYS */;
INSERT INTO `mst_material_cat` VALUES ('001','Dapur','0000-00-00 00:00:00'),('002','Fasility','0000-00-00 00:00:00'),('003','House Keeping','0000-00-00 00:00:00'),('004','Maintenance','0000-00-00 00:00:00'),('005','Office','0000-00-00 00:00:00'),('006','Toko','2012-05-25 06:16:34');
/*!40000 ALTER TABLE `mst_material_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_material_part`
--

DROP TABLE IF EXISTS `mst_material_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_material_part` (
  `kode` varchar(20) NOT NULL,
  `modepart` varchar(15) NOT NULL,
  `pn` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `modelunit` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `coa` varchar(10) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `modepart` (`modepart`,`pn`,`modelunit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_material_part`
--

LOCK TABLES `mst_material_part` WRITE;
/*!40000 ALTER TABLE `mst_material_part` DISABLE KEYS */;
INSERT INTO `mst_material_part` VALUES ('DPR0010001','','-','001','001','Toaster','Pcs','-','2.0.00','2012-02-16 11:25:57'),('DPR0010002','','-','001','001','Aro s/s 4QT chip fryer + glass','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010003','','-','001','001','Stockpot (Panci besar)','Pcs','-','2.0.00','2012-02-17 08:06:36'),('DPR0010004','','-','001','001','Stockpot 8 QT','Pcs','-','2.0.00','2012-02-17 08:07:18'),('DPR0010005','','-','001','001','Stockpot Oriental 30cm','Pcs','-','2.0.00','2012-02-17 08:08:34'),('DPR0010006','','-','001','001','Baskom 26 cm ss','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010007','','-','001','001','Baskom 30 cm ss','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010008','','-','001','001','Baskom 32 cm ss','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010009','','-','001','001','Baskom 36 cm ss','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010010','','-','001','001','Baskom 40 cm ss','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010011','','-','001','001','Baskom 28 cm ss','Pcs','-','2.0.00','2012-02-17 08:09:15'),('DPR0010012','','-','001','001','Nampan coklat Owl plast','Pcs','-','2.0.00','2012-02-17 08:11:29'),('DPR0010013','','-','001','001','Galon aqua','Pcs','-','2.0.00','2012-02-16 09:58:00'),('DPR0010014','','-','001','001','Tea cup (cangkir kopi)','Pcs','-','2.0.00','2012-02-16 09:59:30'),('DPR0010015','','-','001','001','Cup Soucer','Pcs','-','2.0.00','2012-02-17 08:13:22'),('DPR0010016','','-','001','001','Creamer KPC-03CR','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010017','','-','001','001','Piring Roti(Sedang)','Pcs','-','2.0.00','2012-02-17 08:16:49'),('DPR0010018','','-','001','001','Gelas Bir(Bergagang)','Pcs','-','2.0.00','2012-02-16 10:02:23'),('DPR0010019','','-','001','001','Piring Roti 7\"','Pcs','-','2.0.00','2012-02-17 08:14:11'),('DPR0010020','','-','001','001','Piring Makan 10,6\"','Pcs','-','2.0.00','2012-02-17 08:15:06'),('DPR0010021','','-','001','001','Baki Panda Ivory Polos','Pcs','-','2.0.00','2012-02-17 08:18:29'),('DPR0010022','','-','001','001','Dispenser','Pcs','-','2.0.00','2012-02-16 10:04:20'),('DPR0010023','','-','001','002','Ferafin (streno burner)','Pcs','-','8.5.02','2011-12-07 02:43:09'),('DPR0010024','','-','001','001','Footed Bowl s/s 20cm','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010025','','-','001','001','Garpu','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010026','','-','001','001','Gelas Bir (Bulat)','Pcs','-','2.0.00','2012-02-16 10:05:35'),('DPR0010027','','-','001','001','Gelas es (tumbler GM 12T)','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010028','','-','001','001','Sendok Makan','Pcs','-','2.0.00','2012-02-16 10:06:42'),('DPR0010029','','-','001','001','Tea spoon(Sendok teh)','Pcs','-','2.0.00','2012-02-16 10:07:32'),('DPR0010030','','-','001','001','Gunting Tulang','Pcs','-','2.0.00','2012-02-17 08:19:27'),('DPR0010031','','-','001','001','Homeline serok mie','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010032','','-','001','001','Inox fish slice teflon(Kcl)','Pcs','-','2.0.00','2012-02-16 10:09:15'),('DPR0010033','','-','001','001','Jepitan udang 16``','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010034','','-','001','001','Kompor gas 4 tungku','Pcs','-','2.0.00','2012-02-16 10:17:34'),('DPR0010035','','-','001','001','Regulator(tabung gas 4tungku)','Pcs','-','2.0.00','2012-02-18 14:31:54'),('DPR0010036','','-','001','001','Kirapac tempat sendok','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010037','','-','001','001','Kukusan 2 susun','Pcs','-','2.0.00','2012-02-16 10:20:13'),('DPR0010038','','-','001','001','Kwas kue','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010039','','-','001','001','Large soup ladle','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010040','','-','001','001','Lemari es LG GR-B562YLC','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010041','','-','001','001','Magic com merk Yongma','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010042','','-','001','001','magic com cosmos','Pcs','-','2.0.00','2012-02-16 10:24:36'),('DPR0010043','','-','001','001','Mangkok 7``','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010044','','-','001','001','Mangkok duralek(karyawan)','Pcs','-','2.0.00','2012-02-16 10:42:47'),('DPR0010045','','-','001','001','Mangkok bulat(Dalam)','Pcs','-','2.0.00','2012-02-16 10:27:35'),('DPR0010048','','-','001','002','Minyak barco 17 kg','gr','-','8.5.02','2012-02-02 02:35:21'),('DPR0010049','','-','001','001','Nut cracker (tempat bawang grg)','Pcs','-','2.0.00','2012-02-16 10:28:20'),('DPR0010050','','-','001','001','Panci Susun(Stockpot pth)','Pcs','-','2.0.00','2012-02-17 08:46:16'),('DPR0010051','','-','001','001','Tempat bumbu(1set)','Pcs','-','2.0.00','2012-02-16 10:30:09'),('DPR0010052','','-','001','001','Cobek/ulekan(1set)','Pcs','-','2.0.00','2012-02-16 10:31:43'),('DPR0010053','','-','001','001','Panggangan ikan gg kayu','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010054','','-','001','001','Parutan kelapa stenlist','Pcs','-','2.0.00','2012-02-16 10:32:49'),('DPR0010055','','-','001','001','Panci gagang','Pcs','-','2.0.00','2012-02-16 10:35:17'),('DPR0010056','','-','001','001','Pisau dapur','Pcs','-','2.0.00','2012-02-16 10:35:49'),('DPR0010057','','-','001','001','Cangkir hitam','Pcs','-','2.0.00','2012-02-17 08:48:31'),('DPR0010058','','-','001','001','Tatakan cangkir hitam','Pcs','-','2.0.00','2012-02-17 08:49:05'),('DPR0010059','','-','001','001','Piring buah(bulat)','Pcs','-','2.0.00','2012-02-16 10:39:43'),('DPR0010060','','-','001','001','Piring makan duralex(Karyawan)','Pcs','-','2.0.00','2012-02-16 10:41:19'),('DPR0010061','','-','001','001','Piring sambel 3\"','Pcs','-','2.0.00','2012-02-16 10:42:20'),('DPR0010062','','-','001','001','Piring oval','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010063','','-','001','001','Piring oval 12``','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010064','','-','001','001','Dandang Ekonomi','Pcs','-','2.0.00','2012-02-17 08:53:51'),('DPR0010065','','-','001','001','Piring sambel kerang','Pcs','-','2.0.00','2012-02-16 10:45:48'),('DPR0010066','','-','001','001','Piring sambel(bsr)','Pcs','-','2.0.00','2012-02-16 10:47:06'),('DPR0010067','','-','001','001','Pitcher (tanpa tutup)','Pcs','-','2.0.00','2012-02-16 10:47:47'),('DPR0010068','','-','001','001','Pisau golok','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010069','','-','001','001','Pitcher (bertutup)','Pcs','-','2.0.00','2012-02-16 10:48:14'),('DPR0010070','','-','001','001','Rak piring dan gelas(Besi)','Pcs','-','2.0.00','2012-02-16 10:49:01'),('DPR0010071','','-','001','001','Rak piring dan gelas(Plastik)','Pcs','-','2.0.00','2012-02-16 10:49:30'),('DPR0010072','','-','001','001','Kulkas Mitshubisi','Bh','-','2.0.00','2011-12-07 01:54:32'),('DPR0010073','','-','001','006','Sabut s/s utk. cuci piring','Pcs','-','8.5.02','2011-12-07 02:41:53'),('DPR0010074','','-','001','006','Sabut spon','Pcs','-','8.5.02','2011-12-07 02:45:23'),('DPR0010075','','-','001','006','Sabut spon 6 pcs','Pak','-','8.5.02','2011-12-07 02:49:03'),('DPR0010076','','-','001','002','Saori saus tiram 1L','botol','-','8.5.02','2011-12-07 04:43:50'),('DPR0010077','','-','001','001','Kompor Medium Presser(1set)','Pcs','-','2.0.00','2012-02-16 10:50:53'),('DPR0010078','','-','001','001','Saucer Soup','Pcs','-','2.0.00','2012-02-16 10:51:49'),('DPR0010079','','-','001','001','Mangkok soup','Pcs','-','2.0.00','2012-02-16 10:52:24'),('DPR0010080','','-','001','001','Teko air plastik','Pcs','-','2.0.00','2012-02-16 10:54:00'),('DPR0010081','','-','001','001','Sendok Nasi stenlist','Pcs','-','2.0.00','2012-02-16 10:55:12'),('DPR0010082','','-','001','001','Sendok es','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010083','','-','001','001','Sendok Sayur','Pcs','-','2.0.00','2012-02-16 10:56:00'),('DPR0010084','','-','001','001','Pisau makan','Pcs','-','2.0.00','2012-02-16 10:56:36'),('DPR0010085','','-','001','001','Mangkok oval(Kcl)','Pcs','-','2.0.00','2012-02-16 10:57:24'),('DPR0010086','','-','001','001','Tutup gelas(Beling)','Pcs','-','2.0.00','2012-02-16 10:58:35'),('DPR0010087','','-','001','001','Tempat sambel bertutup','Pcs','-','2.0.00','2012-02-16 10:59:19'),('DPR0010088','','-','001','001','Teflon sedang(gg hijau)','Pcs','-','2.0.00','2012-02-16 11:08:21'),('DPR0010089','','-','001','001','Sendok sop gg kayu(bsr)','Pcs','-','2.0.00','2012-02-16 11:01:15'),('DPR0010090','','-','001','001','Sendok sop gg kayu(kcl)','Pcs','-','2.0.00','2012-02-16 11:01:37'),('DPR0010091','','-','001','001','Sodet kayu','Pcs','-','2.0.00','2012-02-16 11:02:20'),('DPR0010092','','-','001','001','Serbet warna (kcl)','Pcs','-','2.0.00','2012-02-16 11:03:08'),('DPR0010093','','-','001','001','Serbet katun putih','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010094','','-','001','001','Serok mie kawat halus 9``','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010095','','-','001','001','Sodet plastik','Pcs','-','2.0.00','2012-02-16 11:03:31'),('DPR0010096','','-','001','001','Sodet gg kayu(bsr)','Pcs','-','2.0.00','2012-02-16 11:03:49'),('DPR0010097','','-','001','001','Sodet gg kayu(kcl)','Pcs','-','2.0.00','2012-02-16 11:04:50'),('DPR0010098','','-','001','001','Sqr plate 400 x 400(piring buah persegi)','Pcs','-','2.0.00','2012-02-16 11:05:18'),('DPR0010099','','-','001','001','Teko stenlist','Pcs','-','2.0.00','2012-02-16 11:06:12'),('DPR0010100','','-','001','001','Teflon tefal 30cm','Pcs','-','2.0.00','2012-02-16 11:06:56'),('DPR0010101','','-','001','001','Sugar pot white(gendut)','Pcs','-','2.0.00','2012-02-16 11:08:56'),('MTC0050003','','-','004','005','AC LG3/4 HP','Unit','-','0.1.04','2011-12-20 12:34:08'),('DPR0010103','','-','001','006','Sabun pencuci piring 4 L','Jrgn','-','8.5.02','2012-02-16 09:37:29'),('DPR0010104','','-','001','001','Sunnex anti slip round tray(bsr)','Pcs','-','2.0.00','2015-01-24 07:37:05'),('DPR0010105','','-','001','001','Sunnex chopping board','Pcs','-','2.0.00','0000-00-00 00:00:00'),('DPR0010106','','-','001','001','Talenan kayu(kcl)','Pcs','-','2.0.00','2012-02-16 11:09:48'),('DPR0010107','','-','001','001','Talenan kayu(bsr)','Pcs','-','2.0.00','2012-02-16 11:10:15'),('DPR0010108','','-','001','001','Chafing dish(tempat saji kcl)','Pcs','-','2.0.00','2012-02-17 09:05:51'),('DPR0010109','','-','001','001','Chafing dish(Tempat saji bsr)','Pcs','-','2.0.00','2012-02-17 09:06:22'),('DPR0010110','','-','001','001','Deep Soup Bowl 30cm (sayur / soup)','Pcs','-','2.0.00','2012-02-17 09:07:45'),('DPR0010111','','-','001','001','Box makanan(plastik bertutup)','Pcs','-','2.0.00','2012-02-16 11:13:10'),('DPR0010112','','-','001','001','Tempat bumbu (bertutup)','Pcs','-','2.0.00','2012-02-16 11:13:54'),('DPR0010113','','-','001','001','Box plastik(tempat gula & kopi)','Pcs','-','2.0.00','2012-02-16 11:14:54'),('DPR0010114','','-','001','001','Keranjang sayuran(Persegi hijau)','Pcs','-','2.0.00','2012-02-16 11:15:41'),('DPR0010115','','-','001','001','Keranjang sayuran(bulat biru)','Pcs','-','2.0.00','2012-02-16 11:16:14'),('DPR0010116','','-','001','001','Saringan kopi steinlist','Bks','-','2.0.00','2012-02-16 11:16:57'),('DPR0010117','','-','001','001','Saringan kopi plastik','Pcs','-','2.0.00','2012-02-16 11:17:19'),('DPR0010118','','-','001','001','Wajan besi kcl','Pcs','-','2.0.00','2012-02-16 11:17:55'),('DPR0010119','','-','001','001','Wajan besi besar','Pcs','-','2.0.00','2012-02-16 11:18:17'),('DPR0010120','','-','001','001','kupasan  wortel bergerigi','Pcs','-','2.0.00','2012-02-16 11:19:02'),('DPR0010121','','-','001','001','Kupasan wortel plastik','Pcs','-','2.0.00','2012-02-16 11:19:41'),('DPR0020122','','-','001','002','Telur','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020123','','-','001','002','Beras topikoki 20 kg','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020124','','-','001','002','Roti Tawar','Pcs','-','8.5.02','2011-12-05 06:11:48'),('DPR0020125','','-','001','002','Terigu','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020126','','-','001','002','Champinyong','gr','-','8.5.02','2015-01-21 08:31:44'),('DPR0020127','','-','001','002','Susu Kental Manis Putih','Klg','-','8.5.02','2011-12-07 02:35:51'),('DPR0020128','','-','001','002','Jagung pipil kalengan','Klg','-','8.5.02','0000-00-00 00:00:00'),('DPR0020129','','-','001','002','Kemangi','Ikat','-','8.5.02','2011-12-20 01:33:11'),('DPR0020130','','-','001','002','Sosis Frunkfurter','Pcs','-','8.5.02','2011-12-05 04:56:03'),('DPR0020131','','-','001','002','Minyak zaitun','Liter','-','8.5.02','0000-00-00 00:00:00'),('DPR0020132','','-','001','002','Lunch box Besar','Box','-','8.5.02','2011-12-07 02:38:17'),('DPR0020133','','-','001','002','Plastik melamin untuk snack','Bks','-','8.5.02','0000-00-00 00:00:00'),('DPR0020134','','-','001','002','Knorr Chicken powder','gr','-','8.5.02','2015-01-21 08:32:41'),('DPR0020135','','-','001','002','Creamer','gr','-','8.5.02','2015-01-21 08:32:23'),('DPR0020136','','-','001','002','Orchid butter sachet','Bks','-','8.5.02','2011-12-07 02:52:46'),('DPR0020137','','-','001','002','Selai Pineapple,Blueberry,Strowberry','Bks','-','8.5.02','2011-12-07 02:55:15'),('DPR0020138','','-','001','002','Semangka','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020139','','-','001','002','Buah melon','gr','-','8.5.02','2015-01-21 08:33:23'),('DPR0020140','','-','001','002','Pineapple','gr','-','8.5.02','2015-01-21 08:33:11'),('DPR0020141','','-','001','002','Spaghetty','Bks','-','8.5.02','0000-00-00 00:00:00'),('DPR0020142','','-','001','002','Rendang','Pcs','-','8.5.02','2015-01-21 08:33:46'),('DPR0020143','','-','001','002','Aqua gelas','Pcs','-','8.5.02','0000-00-00 00:00:00'),('DPR0020144','','-','001','002','Aqua botol','Pcs','-','8.5.02','0000-00-00 00:00:00'),('DPR0020145','','-','001','002','Jagung manis','gr','-','8.5.02','2015-01-21 08:34:02'),('DPR0020146','','-','001','002','Wortel Import','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020147','','-','001','002','Bawang Merah','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020148','','-','001','002','Bawang bombay','gr','-','8.5.02','2015-01-21 08:34:26'),('DPR0020149','','-','001','002','Bawang putih','gr','-','8.5.02','2012-02-02 02:40:42'),('FAC0030001','','-','002','003','Z-fan club card plus','Pcs','-','8.5.01','0000-00-00 00:00:00'),('HKP0040001','','-','003','004','Sabun 35ml','Pcs','-','2.0.00','2012-02-21 02:26:42'),('HKP0040002','','-','003','004','Shampo 35ml','Pcs','-','2.0.00','2012-02-21 02:26:59'),('HKP0040003','','-','003','004','Conditioner','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0040004','','-','003','004','Pasta Gigi','Pcs','-','2.0.00','2015-01-24 08:19:08'),('HKP0040005','','-','003','004','sikat gigi','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0050006','','-','003','005','AC LG S07LP (3/4 PK)','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050007','','-','003','005','AC LG S07LP (3/4 PK)','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050008','','-','003','005','AC LG S09LP (1 PK)','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050009','','-','003','005','Lampu dinding LD29 uk. 27 x 24 x 12 cm','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050010','','-','003','005','Lampu dinding WI D80 CM','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050011','','-','003','005','Lampu Halogen stik 150W philips','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050012','','-','003','005','Lampu meja silinder LM49 uk. 45x25 cm','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050013','','-','003','005','Lampu Sftone 25W philips','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050014','','-','003','005','Lampu spot light philips 80W','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050015','','-','003','005','TV led samsung 32inch','Pcs','-','0.1.04','2017-12-06 01:24:21'),('HKP0050016','','-','003','005','Water heater 5 liter','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050017','','-','003','005','Water heater 5 liter','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050018','','-','003','005','Water heater Polaris 10 liter','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0050019','','-','003','005','Water heater Polaris 10 liter','Pcs','-','0.1.04','0000-00-00 00:00:00'),('HKP0060020','','-','003','006','Bakul tempat sampah','Pcs','-','0.1.02','2012-02-17 12:39:33'),('HKP0060021','','-','003','006','Asbak porcelen kcl','Pcs','-','2.0.00','2015-01-24 08:11:58'),('HKP0060022','','-','003','006','Bayclin reguler 4 L','Pcs','-','4.1.03','0000-00-00 00:00:00'),('HKP0060023','','-','003','006','Bayfresh','Pcs','-','4.1.03','2012-02-17 13:02:37'),('HKP0060024','','-','003','006','Baygon Bakar','Pcs','-','4.1.03','2012-02-17 13:03:07'),('HKP0060025','','-','003','006','Kantong sampah besar','Pcs','-','4.1.03','2012-02-14 04:11:48'),('HKP0060026','','-','003','006','Kantong sampah sedang','Pcs','-','4.1.03','2012-02-14 04:12:29'),('HKP0060027','','-','003','006','Kantong sampah kecil','Pcs','-','4.1.03','0000-00-00 00:00:00'),('HKP0060028','','-','003','006','Baygon Semprot','Pcs','-','4.1.03','2012-02-17 13:04:17'),('HKP0060029','','-','003','006','LS floor wipe BM10','Pcs','-','4.1.03','0000-00-00 00:00:00'),('HKP0060030','','-','003','006','mr muscle Pembersih lantai','Pcs','-','4.1.03','2012-02-14 04:29:00'),('HKP0060031','','-','003','006','braso','Pcs','-','4.1.03','2012-02-14 04:20:07'),('HKP0060032','','-','003','006','Window wiper CLR','Pcs','-','4.1.03','0000-00-00 00:00:00'),('HKP0070033','','-','003','007','Bath Towel','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0070034','','-','003','007','Hand Towel','Pcs','-','2.0.00','2012-02-17 12:03:03'),('HKP0070035','','-','003','007','Face Towel','Pcs','-','2.0.00','2012-02-17 12:01:07'),('HKP0070036','','-','003','007','Bed skirt 120 x 200 (sarung bawah)','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0070037','','-','003','007','Bed skirt 200 x 200 (sarung bawah)','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0070038','','-','003','007','Sprei Besar(Bed Skirt)','Pcs','-','2.0.00','2012-02-17 12:01:36'),('HKP0070039','','-','003','007','Sprei Kecil(Bed Skirt)','Pcs','-','2.0.00','2012-02-17 12:02:26'),('HKP0070040','','-','003','007','Bath Mat','Pcs','-','2.0.00','2012-02-17 12:03:25'),('HKP0070041','','-','003','007','King Plat','Pcs','-','2.0.00','2012-02-17 12:03:58'),('HKP0070042','','-','003','007','Twin Plat','Pcs','-','2.0.00','2012-02-17 12:04:20'),('HKP0070043','','-','003','007','Sarung Bantal Kecil','Pcs','-','2.0.00','2012-02-17 12:05:12'),('HKP0070044','','-','003','007','Sarung Bantal Besar','Pcs','-','2.0.00','2012-02-17 12:05:42'),('HKP0070045','','-','003','007','Selimut Besar (Coklat)','Pcs','-','2.0.00','2012-02-17 12:07:10'),('HKP0070046','','-','003','007','Selimut (kuning)','Pcs','-','2.0.00','2012-02-17 12:06:50'),('HKP0070047','','-','003','007','Selimut Kecil(coklat)','Pcs','-','2.0.00','2012-02-17 12:07:43'),('HKP0070048','','-','003','007','Gordyn Kamar','Pcs','-','2.0.00','2012-02-17 12:08:34'),('HKP0070049','','-','003','007','Gordyn Multi Function Room','Set','-','2.0.00','2012-02-17 12:10:27'),('HKP0070050','','-','003','007','Tali Gordyn','Pcs','-','2.0.00','2012-02-17 12:10:02'),('HKP0070051','','-','003','007','Kain putih(Polos)','Pcs','-','2.0.00','2012-02-17 12:10:59'),('HKP0060052','','-','003','006','Mr Muscle Marmer 800 ml','Bks','-','2.0.00','2012-03-15 07:19:49'),('HKP0080053','','-','003','008','Bantal Tidur','Pcs','-','2.0.00','2012-02-17 12:15:30'),('HKP0080054','','-','003','008','Bantal Kecil','Pcs','-','2.0.00','2012-02-17 12:15:04'),('HKP0080055','','-','003','008','Hanger Baju(Plastik)','Pcs','-','2.0.00','2012-02-17 12:16:43'),('HKP0080056','','-','003','008','Hanger Baju(Kawat)','Pcs','-','2.0.00','2012-02-17 12:17:13'),('HKP0080057','','-','003','008','Crtn shower magnetic liner bone','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0080058','','-','003','008','Crtn shower magnetic liner wht.','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0080059','','-','003','008','Kasur Gold 120 x 200','Pcs','-','0.1.02','2012-02-17 12:52:32'),('HKP0080060','','-','003','008','Kasur Gold 200 x 200','Pcs','-','0.1.02','2012-02-17 12:52:53'),('HKP0080061','','-','003','008','Kasur spring bed 80X200','Pcs','-','0.1.02','2012-02-17 12:53:32'),('HKP0080062','','-','003','008','Kasur Spring bed 100X200','Pcs','-','0.1.02','2012-02-17 12:54:03'),('HKP0080063','','-','003','008','Tabung Gas 12kg Heater','Pcs','-','2.0.00','2012-02-18 11:51:33'),('HKP0080064','','-','003','008','Tempat Aminities(kayu)','Pcs','-','2.0.00','2012-02-17 12:51:29'),('HKP0080065','','-','003','008','Waste basket ultra','Pcs','-','2.0.00','0000-00-00 00:00:00'),('HKP0080066','','-','003','008','Divan Gold 120 x 200','Pcs','-','0.1.02','2012-02-17 12:59:21'),('HKP0080067','','-','003','008','Divan Gold 200 x 200','Pcs','-','0.1.02','2012-02-17 12:59:39'),('HKP0060034','','-','003','006','Ember Hitam(Kecil)','Pcs','-','4.1.03','2012-02-17 13:09:39'),('MTC0090029','','-','004','009','Rol Listrik (stop kontak)','Unit','-','0.1.04','2012-02-17 13:19:55'),('MTC0050001','','-','004','005','Wiifi','Unit','-','0.1.04','2011-12-20 12:31:24'),('MTC0050002','','-','004','005','Parabola TV','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0090003','','-','004','009','Emergency lamp','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0090004','','-','004','009','Genset Perkind\"s 42 KVA','Unit','-','0.1.04','2012-02-16 07:53:29'),('MTC0090005','','-','004','009','KPM-74LP PLN','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0090006','','-','004','009','Senter Goodchip charge 8830','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0090007','','-','004','009','Senter Goodchip charge 9980','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0090008','','-','004','009','Senter Nitsuyana HD 108','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0090009','','-','004','009','T3 20 W CDL','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0100010','','-','004','010','List pintu','Pcs','-','0.1.02','0000-00-00 00:00:00'),('MTC0100011','','-','004','010','Pintu r.tamu','Pcs','-','0.1.02','0000-00-00 00:00:00'),('HKP0080070','','-','003','008','Selang Tabung Gas','Bh','-','2.0.00','2012-02-21 02:50:35'),('HKP0080069','','-','003','008','Regulator tabung gas','Bh','-','2.0.00','2012-02-21 02:49:40'),('MTC0110014','','-','004','011','Wash basin s/s 28 cm','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0110015','','-','004','011','Wash basin s/s 32 cm','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0120016','','-','004','012','Golok','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0120017','','-','004','012','Kabel spiral','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0120018','','-','004','012','Kenmaster tool box','Pcs','-','0.1.04','0000-00-00 00:00:00'),('MTC0120019','','-','004','012','Magic tape','Pcs','-','0.1.04','0000-00-00 00:00:00'),('OFC0130001','','-','005','013','Monitor 17``','Pcs','-','0.1.04','0000-00-00 00:00:00'),('OFC0130002','','-','005','005','Handphone Nokia GSM','Pcs','-','0.1.04','2012-02-17 14:04:09'),('HKP0080068','','-','003','008','Tabung Gas 3kg Heater','Bh','-','2.0.00','2012-02-18 11:52:57'),('9999999999','','-','002','010','Lainnya','Pcs','-','8.5.01','2011-12-01 06:48:59'),('DPR0020150','','-','001','002','Alpukat','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020151','','-','001','002','Apel','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020152','','-','001','002','Arang','Krg','-','8.5.02','2011-12-07 03:10:13'),('DPR0020153','','-','001','002','Ati Ampela','gr','-','8.5.02','2015-01-21 08:35:23'),('DPR0020154','','-','001','002','Ayam mentah','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020155','','-','001','002','Ayam Brand Tuna','Klg','-','8.5.02','2011-12-07 03:13:45'),('DPR0020156','','-','001','002','Ayam Bumbu Jawa','pcs','-','8.5.02','2011-12-07 03:15:14'),('DPR0020157','','-','001','002','Ayam Fillet','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020158','','-','001','002','Bagus Aluminium Foil','Roll','-','8.5.02','2011-12-07 04:09:51'),('DPR0020159','','-','001','002','Bagus Cling Wrap','Roll','-','8.5.02','2011-12-07 04:18:42'),('DPR0020160','','-','001','002','Bandrek','Bks','-','8.5.02','2011-12-07 04:12:51'),('DPR0020161','','-','001','002','Bayam','Ikat','-','8.5.02','2011-12-07 04:15:22'),('DPR0020162','','-','001','002','Bihun','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020163','','-','001','002','Black Paper sauce','botol','-','8.5.02','2011-12-07 04:45:16'),('DPR0020164','','-','001','002','Buncis','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020165','','-','001','002','Bunga sedap malam kering','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020166','','-','001','002','Cabe Keriting','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020167','','-','001','002','Cabe Merah Besar','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020168','','-','001','002','Cabe rawit hijau','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020169','','-','001','002','Cabe rawit merah','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020170','','-','001','002','Cabe kering','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020171','','-','001','002','Caisim','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020172','','-','001','002','Cappucinno','Bks','-','8.5.02','2011-12-07 05:11:51'),('DPR0020173','','-','001','002','Chicken Nugget','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020174','','-','001','002','Cincau','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020175','','-','001','002','Coffemix','Bks','-','8.5.02','2011-12-07 04:33:31'),('DPR0020176','','-','001','002','Cornet Pronas','Klg','-','8.5.02','2011-12-07 04:34:39'),('DPR0020177','','-','001','002','Creamer sachet','Pcs','-','8.5.02','2011-12-07 04:35:31'),('DPR0020178','','-','001','002','Cuka','botol','-','8.5.02','2011-12-07 04:46:16'),('DPR0020179','','-','001','002','Cuka Anggur','botol','-','8.5.02','2011-12-07 04:46:47'),('DPR0020180','','-','001','002','Cumi','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020181','','-','001','002','Kari Daging kambing(Nasi Goreng)','Bks','-','8.5.02','2015-01-21 08:37:02'),('DPR0020182','','-','001','002','Daun Bawang','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020183','','-','001','002','Daun jeruk','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020184','','-','001','002','Daun Kemangi','Ikat','-','8.5.02','2011-12-07 05:18:55'),('DPR0020185','','-','001','002','Daun Salam','Ikat','-','8.5.02','2011-12-07 05:23:46'),('DPR0020186','','-','001','002','Daun kemangi kering','botol','-','8.5.02','2011-12-07 05:24:47'),('DPR0020187','','-','001','002','Daun Rosemary','botol','-','8.5.02','2011-12-07 05:25:45'),('DPR0020188','','-','001','002','Daun Salam kering','botol','-','8.5.02','2011-12-07 05:26:45'),('DPR0020189','','-','001','002','Daun Sup','botol','-','8.5.02','2011-12-07 05:27:30'),('DPR0020190','','-','001','002','Ebi kering','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020191','','-','001','002','Emping mlinjo','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020192','','-','001','002','Filma Margarine','Bks','-','8.5.02','2011-12-07 05:30:46'),('DPR0020193','','-','001','002','French Fries','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0200194','','-','001','002','Garlic Powder','botol','-','8.5.02','2011-12-07 05:41:46'),('DPR0020196','','-','001','002','Garam','Bks','-','8.5.02','2011-12-07 05:43:08'),('DPR0020197','','-','001','002','Gula Merah','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020198','','-','001','002','Gula putih','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020199','','-','001','002','Gula putih sachet','Bks','-','8.5.02','2011-12-07 05:59:34'),('DPR0020200','','-','001','002','Ragi instant','Bks','-','8.5.02','2011-12-07 06:01:43'),('DPR0020201','','-','001','002','Ikan Baronang','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020202','','-','001','002','IKan kakap merah','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020203','','-','001','002','Ikan kue','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020204','','-','001','002','Indomie goreng','Bks','-','8.5.02','2011-12-07 06:05:38'),('DPR0020205','','-','001','002','Indomie rebus','Bks','-','8.5.02','2011-12-07 06:06:29'),('DPR0020206','','-','001','002','Jahe segar','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020207','','-','001','002','Jahe Wangi','Bks','-','8.5.02','2011-12-07 06:08:10'),('DPR0020208','','-','001','002','Jeruk nipis','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020209','','-','001','002','Jeruk peras','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020210','','-','001','002','Kacang Panjang','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020211','','-','001','002','Kecap asin ABC btl 1L','botol','-','8.5.02','2015-01-20 04:55:54'),('DPR0020212','','-','001','002','Kangkung','Ikat','-','8.5.02','2011-12-07 07:06:34'),('DPR0020213','','-','001','002','Kantong Belanja','Bh','-','8.5.02','2011-12-07 07:07:44'),('DPR0020214','','-','001','002','Kecap ikan @1L','botol','-','8.5.02','2015-01-20 04:56:53'),('DPR0020215','','-','001','002','Kecap inggris @1L','botol','-','8.5.02','2015-01-20 04:57:07'),('DPR0020216','','-','001','002','Kecap manis Bango 600ml','Bks','-','8.5.02','2015-01-20 04:54:01'),('DPR0020217','','-','001','002','Keju Kraft single','Pcs','-','8.5.02','2012-03-12 03:25:05'),('DPR0020218','','-','001','002','Kembang kol','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020219','','-','001','002','Kemiri','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020220','','-','001','002','Kentang','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020221','','-','001','002','Kerupuk','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020223','','-','001','002','Kopi','Bks','-','8.5.02','2011-12-07 07:43:45'),('DPR0020222','','-','001','002','Kol','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020224','','-','001','002','Ketumbar','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020225','','-','001','002','Korek gas','Bh','-','8.5.02','2011-12-07 07:45:46'),('DPR0020226','','-','001','002','Kunyit','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020227','','-','001','002','Labu Siem','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020228','','-','001','002','Lada Hitam','botol','-','8.5.02','2011-12-07 07:51:09'),('DPR0020229','','-','001','002','Lada putih bubuk','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020230','','-','001','002','Lengkuas','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020231','','-','001','002','Lilin putih','pcs','-','8.5.02','2011-12-07 07:53:58'),('DPR0020232','','-','001','002','Maizena','Bks','-','8.5.02','2011-12-07 07:55:01'),('DPR0020233','','-','001','002','Mangga','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020234','','-','001','002','Mie Telur','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020235','','-','001','002','Milo Sachet','Bks','-','8.5.02','2011-12-07 08:24:11'),('DPR0020236','','-','001','002','Minyak goreng kemasan','Ltr','-','8.5.02','2011-12-07 08:25:07'),('DPR0020237','','-','001','002','Minyak Samin','gr','-','8.5.02','2015-01-21 08:39:19'),('DPR0020238','','-','001','002','Minyak Wijen','Ltr','-','8.5.02','2015-01-21 08:39:50'),('DPR0020239','','-','001','002','Mix Vegetable','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020240','','-','001','002','Melinjo','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020241','','-','001','006','Mr Muscle Dapur','Bks','-','8.5.02','2011-12-07 08:37:05'),('DPR0020242','','-','001','002','Pokcoy','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020243','','-','001','002','Paprika','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020244','','-','001','002','Paprika Cabe Bubuk','botol','-','8.5.02','2011-12-07 08:47:38'),('DPR0020245','','-','001','002','Pisang tanduk','Bh','-','8.5.02','2011-12-07 08:48:37'),('DPR0020246','','-','001','002','Plastik kiloan','Pak','-','8.5.02','2011-12-07 09:04:38'),('DPR0020247','','-','001','002','Plastik perempatkiloan','Pak','-','8.5.02','2011-12-07 09:05:30'),('DPR0020248','','-','001','002','Plastik Kresek','Pak','-','8.5.02','2011-12-07 09:06:28'),('DPR0020249','','-','001','002','Putren(Baby Corn)','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020250','','-','001','006','Rinso Detergent bubuk','Kg','-','8.5.02','2011-12-07 09:09:36'),('DPR0020251','','-','001','002','Roti Tawar Sharon','Bks','-','8.5.02','2011-12-07 09:10:43'),('DPR0020252','','-','001','002','Saus Sambal','Jrgn','-','8.5.02','2011-12-07 09:11:52'),('DPR0020253','','-','001','002','Saus Teriyaki','botol','-','8.5.02','2011-12-07 09:12:51'),('DPR0020254','','-','001','002','Jagung Manis','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020255','','-','001','002','Saus tiram botol beling','botol','-','8.5.02','2011-12-07 09:14:34'),('DPR0020256','','-','001','002','Saus Tomat','Jrgn','-','8.5.02','2011-12-07 09:15:15'),('DPR0020257','','-','001','002','Sawi putih','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020258','','-','001','002','Sedotan bungkus','pcs','-','8.5.02','2011-12-07 09:17:02'),('DPR0020259','','-','001','002','Serai','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020260','','-','001','002','Sosis Ayam','Pcs','-','8.5.02','2011-12-07 09:18:53'),('DPR0020261','','-','001','002','Sosis kambing','Pcs','-','8.5.02','2011-12-07 09:19:35'),('DPR0020262','','-','001','006','Sunlight 800ml','Bks','-','8.5.02','2011-12-07 09:20:34'),('DPR0020263','','-','001','002','Susu putih sachet','pcs','-','8.5.02','2011-12-07 09:21:33'),('DPR0020264','','-','001','002','Susu coklat sachet','Pcs','-','8.5.02','2011-12-07 09:22:27'),('DPR0020265','','-','001','002','Susu cair ultra','kotak','-','8.5.02','2011-12-07 09:23:27'),('DPR0020266','','-','001','002','Syrup','botol','-','8.5.02','2011-12-07 09:24:33'),('DPR0020267','','-','001','002','Tahu kulit kotak','Pcs','-','8.5.02','2011-12-07 09:25:28'),('DPR0020268','','-','001','002','Tahu kulit segitiga','Pcs','-','8.5.02','2011-12-07 09:26:09'),('DPR0020269','','-','001','002','Tahu putih','Pcs','-','8.5.02','2011-12-07 09:26:52'),('DPR0020270','','-','001','002','Teh saring Sachet(isi 5)','Bks','-','8.5.02','2011-12-07 09:28:31'),('DPR0020271','','-','001','002','Tempe Super','Pcs','-','8.5.02','2011-12-07 09:29:18'),('DPR0020272','','-','001','002','Tepung beras','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020273','','-','001','002','Tepung tapioka','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020274','','-','001','002','Tepung ketan','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020275','','-','001','002','Tepung roti','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020276','','-','001','002','Timun','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020277','','-','001','002','Tissu napkin','Pak','-','8.5.02','2011-12-07 09:36:19'),('DPR0020278','','-','001','002','Tomat','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020279','','-','001','002','Touge','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020280','','-','001','002','Tusuk gigi','Pak','-','8.5.02','2011-12-07 09:38:45'),('DPR0020281','','-','001','002','Udang BBQ','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020282','','-','001','002','Udang kupas','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020283','','-','001','002','Vanili','botol','-','8.5.02','2011-12-07 09:41:19'),('DPR0020284','','-','001','002','Fanta','Klg','-','8.5.02','2011-12-07 09:42:03'),('DPR0020285','','-','001','002','Sprite','Klg','-','8.5.02','2011-12-07 09:42:43'),('DPR0020286','','-','001','002','Coca Cola','Klg','-','8.5.02','2011-12-07 09:43:24'),('DPR0020287','','-','001','002','Pocari Sweat Kaleng 330ml','Klg','-','8.5.02','2015-01-20 04:41:22'),('DPR0020288','','-','001','002','Anker Bir','Klg','-','8.5.02','2011-12-07 09:45:09'),('DPR0020289','','-','001','002','Bir Bintang','Klg','-','8.5.02','2011-12-07 09:46:01'),('DPR0020290','','-','001','002','Daun selada','Pcs','-','8.5.02','2011-12-07 09:47:14'),('DPR0020291','','-','001','002','Asem Jawa','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020292','','-','001','002','Asem mentah','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020293','','-','001','002','Trasi','Bks','-','8.5.02','2011-12-07 09:52:47'),('DPR0020294','','-','001','002','Kencur','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020295','','-','001','002','Jamur kuping kering','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020296','','-','001','002','Cabe giling','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020297','','-','001','002','Ikan tengiri','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020298','','-','001','002','Kertas Minyak','gr','-','8.5.02','2012-02-02 02:40:42'),('DPR0020299','','-','001','002','Lunch box kecil','Pcs','-','8.5.02','2011-12-07 09:56:58'),('MTC0050004','','-','004','005','AC LG 1/2 HP','Unit','-','0.1.04','2011-12-20 12:38:38'),('MTC0050005','','-','004','005','Stabiliser 1000 W','Unit','-','0.1.04','2011-12-20 12:40:53'),('MTC0050006','','-','004','005','Stabiliser 500 W','Unit','-','0.1.04','2011-12-20 12:42:43'),('MTC0050007','','-','004','005','TV LG 21\"','Unit','-','0.1.04','2011-12-20 12:52:34'),('MTC0050008','','-','004','005','TV Toshiba 32\"','Unit','-','0.1.04','2011-12-20 12:57:03'),('MTC0050009','','-','004','005','Komputer','Unit','-','0.1.04','2011-12-20 13:01:44'),('MTC0050010','','-','004','005','Receiver','Unit','-','0.1.04','2011-12-20 13:08:36'),('MTC0050011','','-','004','005','Modulator','Unit','-','0.1.04','2011-12-20 13:10:15'),('MTC0050012','','-','004','005','Printer hp deskjet 3535','Unit','-','0.1.04','2011-12-20 13:14:01'),('MTC0050013','','-','004','005','Heater Polaris','Unit','-','0.1.04','2011-12-20 13:16:46'),('MTC0050014','','-','004','005','Heater Rinnai','Unit','-','0.1.04','2011-12-20 13:22:30'),('HKP0060033','','-','003','006','Sabun cream','gr','-','4.1.03','2012-02-14 04:39:48'),('MTC0100076','','-','004','014','Fish finder Eagle','unit','-','0.1.04','2012-02-28 07:37:57'),('MTC0090010','','-','004','009','Lampu Meta high light','Unit','-','0.1.04','2012-02-16 07:20:21'),('MTC0090011','','-','004','009','Lampu spot 80 W','Unit','-','0.1.04','2012-02-16 07:26:01'),('MTC0090012','','-','004','009','Lampu spot 60 W','Unit','-','0.1.04','2012-02-16 07:31:21'),('MTC0090013','','-','004','009','Pompa air Grund Fos 3~2,4 hp','Unit','-','0.1.04','2012-02-16 07:40:10'),('MTC0090014','','-','004','009','Pompa air Grund Fos 1~2,25 hp','Unit','-','0.1.04','2012-02-16 07:44:10'),('MTC0090015','','-','004','009','Pompa air Grund Fos 1~1hp','Unit','-','0.1.04','2012-02-16 07:48:28'),('MTC0090016','','-','004','009','Pompa air panasonic','Unit','-','0.1.04','2012-02-16 07:50:29'),('MTC0090017','','-','004','009','Pompa filter kolam HAYWARD','unit','-','0.1.04','2012-02-16 07:57:01'),('MTC0090018','','-','004','009','Clorinator Hayward','Unit','-','0.1.04','2012-02-16 08:00:31'),('MTC0090019','','-','004','009','Panel control Hayward','Unit','-','0.1.04','2012-02-16 08:02:24'),('MTC0090020','','-','004','009','Lampu kerucut','Unit','-','0.1.04','2012-02-16 08:04:50'),('MTC0090021','','-','004','009','Lampu fiting','Unit','-','0.1.04','2012-02-16 08:07:30'),('DPR0010047','','-','001','001','Blender Philip','unit','-','2.0.00','2012-02-17 09:24:41'),('DPR0010102','','-','001','001','Blender Brawn','Unit','-','2.0.00','2012-02-17 09:28:18'),('DPR0010046','','-','001','001','Blender Fukuda','Unit','-','2.0.00','2012-02-17 09:31:55'),('DPR0010122','','-','001','001','Tabung Gas Elpiji','Bh','-','2.0.00','2012-02-17 09:34:28'),('DPR0010123','','-','001','001','Wajan Polish 16\"/40cm','Pcs','-','2.0.00','2012-02-17 09:44:46'),('DPR0010124','','-','001','001','Baskom 20 cm ss','Pcs','-','2.0.00','2012-02-17 09:49:14'),('DPR0010125','','-','001','001','Baskom 16 cm ss','Pcs','-','2.0.00','2012-02-17 09:48:55'),('DPR0010126','','-','001','001','Baskom 14 cm ss','Pcs','-','2.0.00','2012-02-17 09:50:01'),('DPR0010127','','-','001','001','Pembuka kaleng','Pcs','-','2.0.00','2012-02-17 09:53:58'),('DPR0010128','','-','001','001','Lock \'n Lock','Pcs','-','2.0.00','2012-02-17 09:55:30'),('DPR0010129','','-','001','001','Rice Com Besar 13L','Bh','-','2.0.00','2012-02-17 09:58:59'),('DPR0010130','','-','001','001','Tempat kecap(U/dimeja)','Pcs','-','2.0.00','2012-02-17 10:01:42'),('DPR0010131','','-','001','001','Tempat lada(u/dimeja)','Pcs','-','2.0.00','2012-02-17 10:02:32'),('DPR0010132','','-','001','001','Tempat tusuk gigi','Pcs','-','2.0.00','2012-02-17 10:03:37'),('DPR0010133','','-','001','001','Mangkok melamin merah(Cetakan nasi)','Pcs','-','2.0.00','2012-02-17 10:04:37'),('DPR0010134','','-','001','001','Lap Washtafel','Pcs','-','2.0.00','2012-02-17 10:05:56'),('DPR0010135','','-','001','001','Lap Handuk','Pcs','-','2.0.00','2012-02-17 10:06:35'),('DPR0010136','','-','001','001','Kain Lap Orange','Ltr','-','2.0.00','2012-02-17 10:07:23'),('DPR0010137','','-','001','001','Celemek(festival cook Singapore)','Pcs','-','2.0.00','2012-02-17 10:08:38'),('DPR0010138','','-','001','001','Perasan jeruk(plastik)','Set','-','2.0.00','2012-02-17 10:11:09'),('DPR0010139','','-','001','001','Coffee Maker','Set','-','2.0.00','2012-02-17 10:12:42'),('DPR0010140','','-','001','001','Thermos Es (plastik)','Bh','-','2.0.00','2012-02-17 10:13:38'),('DPR0010141','','-','001','001','Sigma tempat coffee/tea time','Bh','-','2.0.00','2012-02-17 10:15:19'),('DPR0010142','','-','001','001','Bakul Nasi','Pcs','-','2.0.00','2012-02-17 11:14:02'),('DPR0010143','','-','001','001','Tutup botol plastik','Pcs','-','2.0.00','2012-02-17 11:16:01'),('DPR0010144','','-','001','001','Cangkir motif bunga','Pcs','-','2.0.00','2012-02-17 11:21:00'),('DPR0010145','','-','001','001','Tatakan cangkir motif bunga','Pcs','-','2.0.00','2012-02-17 11:22:32'),('DPR0010146','','-','001','001','Gelas polos duralex','Pcs','-','2.0.00','2012-02-17 11:24:17'),('DPR0010147','','-','001','001','Gelas polos duralex(gagang)','Pcs','-','2.0.00','2012-02-17 11:25:24'),('DPR0010148','','-','001','001','Aneka Mug','Pcs','-','2.0.00','2012-02-17 11:26:22'),('DPR0010149','','-','001','001','Tempat lilin(bening)','Pcs','-','2.0.00','2012-02-17 11:27:10'),('DPR0010150','','-','001','001','Exhaust Fan Dapur','Pcs','-','2.0.00','2012-02-18 14:32:51'),('MTC0090022','','-','004','009','Lampu dinding Kepompong','Unit','-','0.1.04','2012-02-17 12:14:57'),('MTC0090023','','-','004','009','Lampu baca Kepompong','Unit','-','0.1.04','2012-02-17 12:16:29'),('MTC0090024','','-','004','009','Lampu down light','Unit','-','0.1.04','2012-02-17 12:25:08'),('MTC0090025','','-','004','009','Lampu Cermin','Unit','-','0.1.04','2012-02-17 12:26:21'),('MTC0090026','','-','004','009','Lampu Dinding Meja Kopi','Unit','-','0.1.04','2012-02-17 12:28:20'),('MTC0090027','','-','004','009','Lampu TL','Unit','-','0.1.04','2012-02-17 12:30:38'),('MTC0090028','','-','004','009','Lampu Dinding Besi','Unit','-','0.1.04','2012-02-17 12:32:47'),('HKP0040006','','-','003','004','Dental Kit','Pcs','-','2.0.00','2012-02-17 12:45:25'),('HKP0040007','','-','003','004','Sisir','Pcs','-','2.0.00','2012-02-17 12:46:29'),('HKP0060035','','-','003','006','Handsoap','Ltr','-','4.1.03','2012-02-17 13:12:03'),('HKP0060036','','-','003','006','Kain Pel','Pcs','-','4.1.03','2012-02-17 13:13:15'),('HKP0060037','','-','003','006','Kamper warna kecil','Bks','-','4.1.03','2012-02-17 13:16:37'),('HKP0060038','','-','003','006','Kamper Warna (besar)','Pcs','-','4.1.03','2012-02-17 13:22:34'),('MTC0090030','','-','004','009','Exhaust Fan','Unit','-','0.1.04','2012-02-17 13:23:45'),('HKP0060039','','-','003','006','Bagus Kamper Bungkus','Bks','-','4.1.03','2012-02-17 13:23:53'),('HKP0060040','','-','003','006','Kamper Biasa(pth)','Bks','-','4.1.03','2012-02-17 13:25:31'),('HKP0060041','','-','003','006','Kanebo','Pcs','-','4.1.03','2012-02-17 13:26:38'),('HKP0060042','','-','003','006','SOS karbol Wangi','Ltr','-','4.1.03','2012-02-17 13:28:09'),('HKP0060043','','-','003','006','Kemoceng','Pcs','-','4.1.03','2012-02-17 13:29:37'),('HKP0060044','','-','003','006','Kain Lap Marmer','Pcs','-','4.1.03','2012-02-17 13:30:37'),('HKP0060045','','-','003','006','Tangkai Sapu Marmer','Pcs','-','4.1.03','2012-02-17 13:31:54'),('HKP0060046','','-','003','006','Lem Lalat','Bks','-','4.1.03','2012-02-17 13:32:52'),('MTC0090031','','-','004','009','Lampu Tangga','Unit','-','0.1.04','2012-02-17 13:33:17'),('HKP0060047','','-','003','006','Mr Mucle Pembersih Kaca(800ml)','Bks','-','4.1.03','2012-02-17 13:34:31'),('MTC0090032','','-','004','009','Lampu Halogen','Unit','-','0.1.04','2012-02-17 13:35:12'),('HKP0060048','','-','003','006','Mr Muscle Pembersih Kaca(4L)','Ltr','-','4.1.03','2012-02-17 13:35:52'),('HKP0060049','','-','003','006','Mr Muscle Pembersih Marmer(800ml)','Bks','-','4.1.03','2012-02-17 13:37:14'),('MTC0090033','','-','004','009','Lampu Bambu','Unit','-','0.1.04','2012-02-17 13:37:14'),('HKP0060050','','-','003','006','Pembersih Lantai(4L)','Ltr','-','4.1.03','2012-02-17 13:38:42'),('MTC0090034','','-','004','009','Lampu Almari','Unit','-','0.1.04','2012-02-17 13:38:42'),('HKP0060051','','-','003','006','Pengki plastik','Pcs','-','4.1.03','2012-02-17 13:39:24'),('MTC0090035','','-','004','009','Box Panel 40x30 cm','Bh','-','0.1.04','2012-02-17 13:40:36'),('HKP0060053','','-','003','006','Lemon Plegde(mebel)','Bks','-','4.1.03','2012-02-17 13:41:55'),('MTC0090036','','-','004','009','Kontaktor','Bh','-','0.1.04','2012-02-17 13:42:07'),('HKP0060054','','-','003','006','Sapu Lantai','Pcs','-','4.1.03','2012-02-22 08:15:10'),('HKP0060055','','-','003','006','Sapu Lidi(Bertangkai)','Pcs','-','4.1.03','2012-02-17 13:43:41'),('MTC0090037','','-','004','009','Timer Omron','Bh','-','0.1.04','2012-02-17 13:47:23'),('HKP0060056','','-','003','006','Sikat Tongkat','Pcs','-','4.1.03','2012-02-17 13:44:50'),('HKP0060057','','-','003','006','Sikat Tangan(plastik)','Pcs','-','4.1.03','2012-02-17 13:45:37'),('HKP0060058','','-','003','006','Sikat Closet','Pcs','-','4.1.03','2012-02-22 08:15:31'),('HKP0060059','','-','003','006','Spon bertangkai(Kaca)','Pcs','-','4.1.03','2012-02-17 13:48:56'),('HKP0060060','','-','003','006','Tissu Toilet','Roll','-','4.1.03','2012-02-17 13:49:57'),('MTC0090038','','-','004','009','Timer switch (Teben)','Bh','-','0.1.04','2012-02-17 13:49:59'),('HKP0060061','','-','003','005','Tongkat Pel','Pcs','-','4.1.03','2012-02-17 13:50:44'),('HKP0060062','','-','003','006','WPC(800ml)','botol','-','4.1.03','2012-02-17 13:53:10'),('HKP0060063','','-','003','006','HCL(4L)','Ltr','-','4.1.03','2012-02-17 13:53:57'),('HKP0040008','','-','003','004','Soffel','Bks','-','2.0.00','2012-02-17 13:57:28'),('MTC0090039','','-','004','009','Breaker 3~ MCB 100 A MG','Bh','-','0.1.04','2012-02-17 14:02:04'),('HKP0040009','','-','003','004','Sabun Mandi','Pcs','-','2.0.00','2017-12-06 01:30:48'),('MTC0090040','','-','004','009','MCB 10A','Bh','-','0.1.04','2012-02-17 14:01:26'),('MTC0090041','','-','004','009','MCB 16A','Bh','-','0.1.04','2012-02-17 14:04:23'),('MTC0090042','','-','004','009','MCB6A','Bh','-','0.1.04','2012-02-17 14:05:42'),('MTC0090043','','-','004','009','MCB2A','Bh','-','0.1.04','2012-02-17 14:07:24'),('MTC0090044','','-','004','009','MCB 3~32A','Bh','-','0.1.04','2012-02-17 14:09:18'),('OFC0130003','','-','005','010','Brosur Hotel','Pcs','-','4.0.05','2012-02-17 14:09:44'),('MTC0090045','','-','004','009','MCB 3~25A','Bh','-','0.1.04','2012-02-17 14:10:45'),('OFC0130004','','-','005','010','Kartu Nama','kotak','-','4.0.05','2012-02-17 14:11:56'),('MTC0090046','','-','004','009','MCB 3~16A','Bh','-','0.1.04','2012-02-17 14:12:54'),('OFC0130006','','-','005','010','Amplop polos','Pcs','-','2.0.00','2012-02-17 14:13:46'),('OFC0130005','','-','005','010','Kertas A4(print)','rim','-','2.0.00','2012-02-17 14:15:02'),('MTC0090047','','-','004','009','Box Panel 50x40cm','Bh','-','0.1.04','2012-02-17 14:15:38'),('OFC0130007','','-','005','010','Paper Clip','Dos','-','2.0.00','2012-02-17 14:16:40'),('MTC0090048','','-','004','009','Box Panel 60x40cm','Bh','-','0.1.04','2012-02-17 14:17:40'),('OFC0130008','','-','005','010','Staples N0.10-1M','Dos','-','2.0.00','2012-02-17 14:18:01'),('OFC0130009','','-','005','010','Stapler HD-10','Pcs','-','2.0.00','2012-02-17 14:20:32'),('MTC0090049','','-','004','009','Philips Genie (PL)','Bh','-','2.0.00','2012-02-28 06:15:23'),('MTC0090050','','-','004','009','Halogen 20W (Lmp Tangga)','Bh','-','2.0.00','2012-02-28 06:15:56'),('OFC0130010','','-','005','010','Staples No.3-1M','Dos','-','2.0.00','2012-02-17 14:22:18'),('OFC0130011','','-','005','010','Stapler HD-50','Pcs','-','2.0.00','2012-02-17 14:23:48'),('MTC0090051','','-','004','009','Boll Lamp Meta hight Light 70W','Bh','-','2.0.00','2012-02-28 06:16:45'),('MTC0090052','','-','004','009','Capasitor AC Out Dor','Bh','-','2.0.00','2012-02-28 06:24:54'),('MTC0090053','','-','004','009','Capasitor AC Fan In Dor','Bh','-','2.0.00','2012-02-28 06:25:27'),('MTC0090054','','-','004','009','Capasitor Pompa Air','Bh','-','2.0.00','2012-02-28 06:26:00'),('MTC0090055','','-','004','009','ACCU(Batre) 12V70A','Bh','-','0.1.04','2012-02-17 14:35:27'),('MTC0100014','','-','004','008','Meja Rias','Bh','-','0.1.02','2012-02-18 03:48:32'),('MTC0100015','','-','004','008','Kursi Meja Rias','Bh','-','0.1.02','2012-02-18 03:40:48'),('MTC0100016','','-','004','008','Kaca Cermin','Bh','-','0.1.02','2012-02-18 03:49:24'),('MTC0100017','','-','004','008','Meja Kopi','Bh','-','0.1.02','2012-02-18 03:51:14'),('MTC0100018','','-','004','008','Meja TV','Bh','-','0.1.02','2012-02-18 03:52:43'),('MTC0100019','','-','004','008','Almari Baju','Set','-','0.1.02','2012-02-18 03:38:47'),('MTC0100020','','-','004','010','Kursi Sofa','Bh','-','0.1.02','2012-02-18 02:53:30'),('MTC0100021','','-','004','010','Meja Marmer jati','Bh','-','0.1.02','2012-02-18 03:07:56'),('MTC0100022','','-','004','010','Meja Lipat Restoran jati','Bh','-','0.1.02','2012-02-18 03:37:40'),('MTC0100023','','-','004','010','Meja Restoran Mahoni','Bh','-','0.1.02','2012-02-18 03:55:57'),('MTC0100024','','-','004','010','Kursi Plastik Restoran','Bh','-','0.1.02','2012-02-18 03:59:46'),('MTC0100025','','-','004','010','Kursi kayu Sofa','Bh','-','0.1.02','2012-02-18 04:07:09'),('MTC0100026','','-','004','010','Meja Mini Bar','Bh','-','0.1.02','2012-02-18 04:10:13'),('MTC0100027','','-','004','010','Meja Reception jati','Bh','-','0.1.02','2012-02-18 04:12:35'),('MTC0100028','','-','004','010','Meja Komputer','Bh','-','0.1.02','2012-02-18 04:14:34'),('MTC0100029','','-','004','010','Meja Nakas jati','Bh','-','0.1.02','2012-02-18 04:16:59'),('MTC0100030','','-','004','010','Almari Rak jati','Bh','-','0.1.02','2012-02-18 04:19:36'),('MTC0100031','','-','004','010','Almari Kaca','Bh','-','0.1.02','2012-02-18 04:21:49'),('MTC0100032','','-','004','010','Meja Kaca rotan','Bh','-','0.1.02','2012-02-18 04:23:32'),('MTC0100033','','-','004','010','Papan ukir jati','Bh','-','0.1.02','2012-02-18 04:32:34'),('MTC0100034','','-','004','008','Shower Bulat Toto','Set','-','0.1.04','2012-02-18 04:38:16'),('MTC0100035','','-','004','008','Hand shower Toto','set','-','0.1.04','2012-02-18 04:43:23'),('MTC0100036','','-','004','008','Closet Duduk Toto','set','-','0.1.04','2012-02-18 04:48:04'),('MTC0100037','','-','004','008','Westafel Toto','set','-','0.1.04','2012-02-18 04:50:46'),('MTC0100038','','-','004','010','Patung','Bh','-','4.1.03','2012-02-28 06:32:17'),('MTC0100039','','-','004','010','Miniatur ikan','Bh','-','4.1.03','2012-02-28 06:33:03'),('MTC0100040','','-','004','014','Reel Maguro 1000 Magma','unit','-','0.1.04','2012-02-21 04:54:20'),('MTC0100041','','-','004','014','Reel Shimano 2500 FB jigging','unit','-','0.1.04','2012-02-21 04:55:01'),('MTC0100042','','-','004','014','Joran Shimano SMS 60 M-2A jigging','unit','-','0.1.04','2012-02-21 04:55:31'),('MTC0100043','','-','004','014','Joran ShimanoCR2F6 2602','Bh','-','0.1.04','2012-02-21 04:56:39'),('MTC0100044','','-','004','014','Joran Trolling Daiwa 1GFA','Bh','-','0.1.04','2012-02-21 04:57:12'),('MTC0100045','','-','004','014','Joran Fenwich H18705 Jigging','Bh','-','0.1.04','2012-02-21 04:57:55'),('DPR0010151','','-','001','001','Neraca Timbangan 5Kg','Set','-','2.0.00','2012-02-18 11:05:08'),('DPR0010152','','-','001','001','Pemotong Apel','Bh','-','2.0.00','2012-02-18 11:07:14'),('DPR0010153','','-','001','001','Pemotong Telur','Bh','-','2.0.00','2012-02-18 11:15:46'),('DPR0010154','','-','001','001','Jepit Kepiting','Bh','-','2.0.00','2012-02-18 11:17:25'),('MTC0100046','','-','004','014','Joran Antena Roth Burn','Bh','-','0.1.04','2012-02-21 04:58:34'),('MTC0100047','','-','004','014','Joran Troling Seeker GG55H','Bh','-','0.1.04','2012-02-21 04:59:13'),('MTC0100048','','-','004','014','Joran Troling Jarvis Walker','Bh','-','0.1.04','2012-02-21 04:59:41'),('MTC0100049','','-','004','014','Joran Trolling Fuji Fps 24','Bh','-','0.1.04','2012-02-21 05:00:11'),('MTC0100050','','-','004','014','Joran Poping Shino GT Pop','Bh','-','0.1.04','2012-02-21 05:00:38'),('MTC0100051','','-','004','014','Jora Jigg Shimano Beast Master','Bh','-','0.1.04','2012-02-21 06:21:00'),('MTC0100052','','-','004','014','Joran Jigg Ocean Spirit','Bh','-','0.1.04','2012-02-21 06:21:29'),('MTC0100053','','-','004','014','Joran Jigg WRPS 18','Bh','-','0.1.04','2012-02-21 06:22:24'),('MTC0100054','','-','004','014','Reel TW 500','unit','-','0.1.04','2012-02-21 06:23:00'),('MTC0100055','','-','004','014','Reel Viking 5060','unit','-','0.1.04','2012-02-21 06:23:39'),('MTC0100056','','-','004','014','Reel Daiwa World Spin4000','unit','-','0.1.04','2012-02-21 06:24:10'),('MTC0100057','','-','004','014','Reel Saragosa 18000 Shimano','unit','-','0.1.04','2012-02-21 06:24:51'),('MTC0100058','','-','004','014','Reel Trolling Ryobi Eratec Alert','unit','-','0.1.04','2012-02-21 06:25:22'),('MTC0100059','','-','004','014','Reel Trolling Penn 50 SW','unit','-','0.1.04','2012-02-21 06:25:59'),('MTC0100060','','-','004','014','Reel Trolling Daiwa Sea Line 450','unit','-','0.1.04','2012-02-21 06:26:26'),('MTC0100061','','-','004','014','Reel Tech Hyper 20.000 PG','unit','-','0.1.04','2012-02-21 06:27:05'),('MTC0100062','','-','004','014','Kona heat Pakula lures Australia','Bh','-','0.1.04','2012-02-21 06:27:43'),('MTC0100063','','-','004','014','Metal jigg 120 gr Merah putih','Bh','-','0.1.04','2012-02-21 06:28:12'),('MTC0100064','','-','004','014','Metal Jigg 100 gr biru puit','Bh','-','0.1.04','2012-02-21 06:28:43'),('MTC0100065','','-','004','014','Metal Jigg  220 gr pink putih','Bh','-','0.1.04','2012-02-21 06:29:36'),('MTC0100066','','-','004','014','Poper Halco hijau kuning','Bh','-','0.1.04','2012-02-21 06:30:56'),('MTC0100067','','-','004','014','Metal jigg SP 250 Gr merah putih','Bh','-','0.1.04','2012-02-21 06:31:28'),('MTC0100068','','-','004','014','Rapala X-rap magnum 15 Hijau pink kunig','Bh','-','0.1.04','2012-02-21 06:32:03'),('MTC0100069','','-','004','014','Rapala magnum Find land putih orange','Bh','-','0.1.04','2012-02-21 06:32:31'),('MTC0100070','','-','004','014','Rapala sinking Magnum CD-14 hijau hitam','Bh','-','0.1.04','2012-02-21 06:33:00'),('MTC0100071','','-','004','014','Lively Lures Mnfgr','Bh','-','0.1.04','2012-02-21 06:33:33'),('DPR0010156','','-','001','001','Regulator Propane Butane','Pcs','-','2.0.00','2012-02-18 14:34:25'),('MTC0100072','','-','004','014','Rapala Finland magnum merah putih','Bh','-','0.1.04','2012-02-21 04:51:31'),('DPR0010157','','-','001','001','Selang Tabung Gas','Pcs','-','2.0.00','2012-02-18 14:35:17'),('MTC0090056','','-','004','009','Multi Tester','Unit','-','0.1.04','2012-02-19 02:47:11'),('MTC0090057','','-','004','009','Tang Amper','Unit','-','0.1.04','2012-02-19 02:49:55'),('MTC0090058','','-','004','009','Taspen','Bh','-','0.1.04','2012-02-19 02:51:38'),('MTC0090059','','-','004','009','Bor Listrik Metabo','Unit','-','0.1.04','2012-02-19 03:15:20'),('MTC0090060','','-','004','009','Gerinda Tangan Fujima','Unit','-','0.1.04','2012-02-19 03:18:12'),('DPR0010158','','-','001','001','Sendok makan karyawan','Bh','-','2.0.00','2012-02-19 05:42:09'),('DPR0010159','','-','001','001','Nyiru(Tampah)','Bh','-','2.0.00','2012-02-19 05:43:55'),('MTC0120020','','-','004','012','Kunci Pas ring Size 22','Bh','-','0.1.04','2012-02-19 06:38:40'),('MTC0120021','','-','004','012','Kunci Pas ring Size 24','Bh','-','0.1.04','2012-02-19 06:40:35'),('MTC0120022','','-','004','012','Kunci Pas ring Size 17','Bh','-','0.1.04','2012-02-19 06:42:52'),('MTC0120023','','-','004','012','Tang Cucut','Bh','-','0.1.04','2012-02-19 06:44:16'),('MTC0120024','','-','004','012','Tang kombinasi','Bh','-','0.1.04','2012-02-19 06:45:44'),('MTC0120025','','-','004','012','Tang Ripet','Bh','-','0.1.04','2012-02-19 06:47:07'),('MTC0120026','','-','004','012','Tang Potong','Bh','-','0.1.04','2012-02-19 06:48:14'),('MTC0120027','','-','004','012','Palu 1kg','Bh','-','0.1.04','2012-02-19 06:50:15'),('MTC0120028','','-','004','012','Palu Kecil','Bh','-','0.1.04','2012-02-19 06:54:12'),('MTC0120029','','-','004','012','Obeng +','Bh','-','0.1.04','2012-02-19 06:55:47'),('MTC0120030','','-','004','012','Obeng Ketok','Bh','-','0.1.04','2012-02-19 06:57:48'),('MTC0120031','','-','004','012','Kunci Pipa kecil','Bh','-','0.1.04','2012-02-19 07:00:29'),('MTC0120032','','-','004','012','Kunci Pipa besar','Bh','-','0.1.04','2012-02-19 07:01:53'),('MTC0120033','','-','004','012','Penggaris Siku','Bh','-','0.1.04','2012-02-19 07:11:37'),('MTC0120034','','-','004','012','Meteran Exellence 5m','Bh','-','0.1.04','2012-02-19 07:21:53'),('MTC0120035','','-','004','012','Meteran Rol','Bh','-','0.1.04','2012-02-19 07:23:12'),('MTC0120036','','-','004','012','Kunci L','Bh','-','0.1.04','2012-02-19 07:24:33'),('MTC0120037','','-','004','012','Gunting Rumput','Bh','-','0.1.04','2012-02-19 07:26:22'),('MTC0120038','','-','004','012','Obeng -','Bh','-','0.1.04','2012-02-19 07:27:48'),('MTC0120039','','-','004','012','Kunci T 8,10,12','Bh','-','0.1.04','2012-02-19 07:31:36'),('MTC0120040','','-','004','012','Kunci Busi','Bh','-','0.1.04','2012-02-19 07:37:11'),('MTC0120041','','-','004','012','Kunci Shock','Set','-','0.1.04','2012-02-19 07:39:20'),('MTC0120042','','-','004','012','Tang Regem','Bh','-','0.1.04','2012-02-19 07:53:41'),('MTC0120043','','-','004','012','Kunci L bintang','Set','-','0.1.04','2012-02-19 08:07:32'),('MTC0120044','','-','004','012','Cangkul','Bh','-','0.1.04','2012-02-19 08:09:46'),('MTC0120045','','-','004','012','Linggis','Bh','-','0.1.04','2012-02-19 08:11:29'),('MTC0120046','','-','004','012','Sendok semen','Bh','-','0.1.04','2012-02-19 08:12:46'),('MTC0120047','','-','004','012','Sabit','Bh','-','0.1.04','2012-02-19 08:20:56'),('0030050001','','','003','005','AC 3/4 hp LG','unit','','','2012-02-20 03:30:57'),('0030090001','','','003','009','Lampu spot','unit','','','2012-02-20 03:30:57'),('0030100001','','','003','010','Lemari baju','Bh','','','2012-02-20 03:30:57'),('0020140001','','','002','014','Reel  maguro magma 1000','Bh','','','2012-02-20 03:30:57'),('0039990001','','','003','999','Bensin (Ruber boat)','Ltr','','','2012-02-20 03:30:57'),('DPR0010160','','-','001','001','Nampan Kayu 35X55cm','Bh','-','2.0.00','2012-02-21 05:01:52'),('DPR0020300','','-','001','002','Soda Kaleng','Klg','-','8.5.02','2012-02-22 08:12:44'),('OFC0130012','','-','005','010','Kenko 2 Hole punch no.30XL','Bh','-','2.0.00','2012-02-21 03:22:45'),('OFC0130013','','-','005','010','Kalculator Casio DX-12S','unit','-','0.1.04','2012-02-21 04:57:20'),('OFC0130014','','-','005','010','Kalculator Casio fx-350TL','unit','-','0.1.04','2012-02-21 04:57:44'),('OFC0130015','','-','005','010','Buku Menu Restoran','Bh','-','2.0.00','2012-02-21 03:37:33'),('OFC0130016','','-','005','010','Pulpen','Pcs','-','2.0.00','2012-02-21 03:38:50'),('OFC0130017','','-','005','010','Pensil tulis','Pcs','-','2.0.00','2012-02-21 03:39:35'),('OFC0130018','','-','005','010','Penggaris Plastik 30cm','Pcs','-','2.0.00','2012-02-21 03:43:16'),('OFC0130019','','-','005','010','Karet Penghapus','Bh','-','2.0.00','2012-02-21 03:44:03'),('OFC0130020','','-','005','010','Filling Kabinet Stenlist','Bh','-','0.1.02','2012-02-21 03:45:20'),('OFC0130021','','-','005','010','Tempat Billing Room','Set','-','2.0.00','2012-02-21 03:46:41'),('OFC0130022','','-','005','010','Jam Dinding Quartz(merah)','Bh','-','0.1.04','2012-02-21 03:48:45'),('OFC0130023','','-','005','010','Nampan kayu 23X13cm(Order)','Pcs','-','2.0.00','2012-02-21 04:16:47'),('OFC0130024','','-','005','010','Lakban bening','Roll','-','2.0.00','2012-02-21 04:23:35'),('OFC0130025','','-','005','010','Lakban Coklat','Roll','-','2.0.00','2012-02-21 04:25:18'),('OFC0130026','','-','005','010','Gunting JOYKO','Bh','-','2.0.00','2012-02-21 04:26:16'),('OFC0130027','','-','005','010','Buku Nota/order restoran','buku','-','2.0.00','2012-02-21 04:27:18'),('MTC0120048','','-','004','012','Kunci Ring Size 21/23','Bh','-','0.1.04','2012-02-21 06:43:12'),('MTC0120049','','-','004','012','Kunci Pas ring Size 23','Bh','-','0.1.04','2012-02-21 06:44:42'),('MTC0120050','','-','004','012','Kunci Pas size 16/17','Bh','-','0.1.04','2012-02-21 06:46:54'),('MTC0120051','','-','004','012','Kunci pas size 24/27','Bh','-','0.1.04','2012-02-21 06:49:14'),('MTC0120052','','-','004','012','Kunci Ring Size 18/19','Bh','-','0.1.04','2012-02-21 06:50:45'),('MTC0120053','','-','004','012','Kunci pas size 18/19','Bh','-','0.1.04','2012-02-21 06:52:54'),('MTC0120054','','-','004','012','Kunci Ring size14/15','Bh','-','0.1.04','2012-02-21 06:59:03'),('MTC0120055','','-','004','012','Kunci Ring Size 12/13','Bh','-','0.1.04','2012-02-21 07:01:39'),('MTC0120056','','-','004','012','Kunci Pas ring Size 10','Bh','-','0.1.04','2012-02-21 07:07:26'),('MTC0120057','','-','004','012','Kunci Ring Size 10/11','Bh','-','0.1.04','2012-02-21 07:09:24'),('MTC0120058','','-','004','012','Kunci Pas ring Size 8','Bh','-','0.1.04','2012-02-21 07:10:53'),('MTC0120059','','-','004','012','Kunci Ring Size 8/9','Bh','-','0.1.04','2012-02-21 07:14:27'),('MTC0120060','','-','004','012','Kunci Pas ring Size 6','Bh','-','0.1.04','2012-02-21 07:15:45'),('MTC0120061','','-','004','012','Kunci Pas ring Size 25/28','Bh','-','0.1.04','2012-02-21 07:20:24'),('MTC0120062','','-','004','012','Kunci Pas ring Size 24/27','Bh','-','0.1.04','2012-02-21 07:22:53'),('MTC0120063','','-','004','012','Kunci Pas ring Size 25/28','Bh','-','0.1.04','2012-02-21 07:25:24'),('MTC0120064','','-','004','012','Gergaji kayu','Bh','-','0.1.04','2012-02-21 07:27:27'),('MTC0120065','','-','004','012','Gergaji besi','Bh','-','0.1.04','2012-02-21 07:28:23'),('MTC0120066','','-','004','012','WD 40','btl','-','2.0.00','2012-02-28 06:02:25'),('MTC0120067','','-','004','012','Engine Cleaner','btl','-','2.0.00','2012-02-28 06:03:06'),('MTC0120068','','-','004','012','Minyak Rante spry','btl','-','2.0.00','2012-02-28 06:03:34'),('MTC0120069','','-','004','012','Rotary (sten pet)','Klg','-','2.0.00','2012-02-28 06:04:19'),('MTC0120070','','-','004','012','Oli Geer Box (mesin tempel)','Ltr','-','2.0.00','2012-02-28 06:05:59'),('MTC0120071','','-','004','012','Oli Samping (mesin tempel)','Ltr','-','2.0.00','2012-02-28 06:06:30'),('MTC0120072','','-','004','012','Oli Mesin Genset','Ltr','-','2.0.00','2012-02-28 06:07:06'),('MTC0120073','','-','004','012','Oli Mesin Motor','Ltr','-','2.0.00','2012-02-28 06:07:34'),('MTC0120074','','-','004','012','Air Radiator Genset','Ltr','-','2.0.00','2012-02-28 06:08:04'),('MTC0120075','','-','004','012','Tabung Pemadam Kebakaran','unit','-','0.1.04','2012-02-21 07:51:20'),('MTC0120076','','-','004','012','Solar Genset','Ltr','-','2.0.00','2012-02-28 06:09:34'),('MTC0120077','','-','004','012','Bensin Motor','Ltr','-','2.0.00','2012-02-28 06:10:00'),('MTC0120078','','-','004','012','Bensin Ruber boat','Ltr','-','2.0.00','2012-02-28 06:10:24'),('MTC0120079','','-','004','012','Reduser 2\"x1\"','Bh','-','0.1.04','2012-02-22 01:59:34'),('MTC0120080','','-','004','012','Reduser 3\"x2\"','Bh','-','0.1.04','2012-02-22 02:01:12'),('MTC0120081','','-','004','012','Reduser 1\"x1,5\"','Bh','-','0.1.04','2012-02-22 02:03:48'),('MTC0120082','','-','004','012','Reduser 3/4\"x1/2\"','Bh','-','0.1.04','2012-02-22 02:05:34'),('MTC0120083','','-','004','012','Reduser 1\"x3/4\"','Bh','-','0.1.04','2012-02-22 02:08:04'),('MTC0120084','','-','004','012','Reduser 11/4\"x1\"','Bh','-','0.1.04','2012-02-22 02:10:03'),('MTC0120085','','-','004','012','Reduser 2\"x11/2\"','Bh','-','0.1.04','2012-02-22 02:12:14'),('MTC0120086','','-','004','012','Reduser 2\"x11/4\"','Bh','-','0.1.04','2012-02-22 02:14:01'),('MTC0120087','','-','004','012','Reduser 2\"x1\"','Bh','-','0.1.04','2012-02-22 02:15:33'),('MTC0120088','','-','004','012','Shock T 2\"','Bh','-','0.1.04','2012-02-22 02:17:17'),('MTC0120089','','-','004','012','Shock T 1/2\"','Bh','-','0.1.04','2012-02-22 02:19:00'),('MTC0120090','','-','004','012','Shock T 1 1/2\"','Bh','-','0.1.04','2012-02-22 02:21:47'),('MTC0120091','','-','004','012','Shock T 2\"x1 1/4\"','Bh','-','0.1.04','2012-02-22 02:24:00'),('MTC0120092','','-','004','012','Shock Drat Luar 2\"','Bh','-','0.1.04','2012-02-22 02:27:46'),('MTC0120093','','-','004','012','Shock Drat Dalam 2\"','Bh','-','0.1.04','2012-02-22 02:29:55'),('MTC0120094','','-','004','012','Shock Drat luar 1 1/12\"','Bh','-','0.1.04','2012-02-22 02:32:27'),('MTC0120095','','-','004','012','Shock Drat luar 1\"','Bh','-','0.1.04','2012-02-22 03:10:53'),('MTC0120096','','-','004','012','Shock Drat Luar  1/2 \"','Bh','-','0.1.04','2012-02-22 03:13:35'),('MTC0120097','','-','004','012','L Bow 2\"','Bh','-','0.1.04','2012-02-22 03:16:02'),('MTC0120098','','-','004','012','L Bow 3\"','Bh','-','0.1.04','2012-02-22 03:17:30'),('MTC0120099','','-','004','012','L Bow 1\"','Bh','-','0.1.04','2012-02-22 03:18:40'),('MTC0120100','','-','004','012','L Bow 1 1/4\"','Bh','-','0.1.04','2012-02-22 03:22:12'),('MTC0120101','','-','004','012','L Bow 1/2\"','Bh','-','0.1.04','2012-02-22 03:23:32'),('MTC0120102','','-','004','012','Boll Fallep 1\"','Bh','-','0.1.04','2012-02-22 03:25:18'),('MTC0120103','','-','004','012','Boll Fallep 3/4\"','Bh','-','0.1.04','2012-02-22 03:27:10'),('MTC0120104','','-','004','012','Shock T 1\"','Bh','-','0.1.04','2012-02-22 03:28:29'),('MTC0120105','','-','004','012','L bow 1/2\" air panas','Bh','-','0.1.04','2012-02-28 04:23:54'),('MTC0120106','','-','004','012','Shock Drat Dalam 1\"x2\"air panas','Bh','-','0.1.04','2012-02-28 04:26:25'),('MTC0120107','','-','004','012','Shock T 1/2\" air panas','Bh','-','0.1.04','2012-02-28 04:28:03'),('MTC0120108','','-','004','012','Shock Drat Luar 1/2\" air panas','Bh','-','0.1.04','2012-02-28 04:30:51'),('MTC0120109','','-','004','012','Shock T kuningan 1\"','Bh','-','0.1.04','2012-02-28 04:33:03'),('MTC0120110','','-','004','012','Shock 2\"','Bh','-','0.1.04','2012-02-28 04:34:57'),('MTC0120111','','-','004','012','Shock 11/2\"','Bh','-','0.1.04','2012-02-28 04:36:23'),('MTC0120112','','-','004','012','Las dop 1/2\"','Bh','-','0.1.04','2012-02-28 04:38:10'),('MTC0120113','','-','004','012','Las dop 2\"','Bh','-','0.1.04','2012-02-28 04:40:01'),('MTC0120114','','-','004','012','Water mor 2\"','Bh','-','0.1.04','2012-02-28 04:42:02'),('MTC0120115','','-','004','012','Tosen klep 2\'','Bh','-','0.1.04','2012-02-28 04:58:59'),('MTC0120116','','-','004','012','Water mor 1\"','Bh','-','0.1.04','2012-02-28 05:02:14'),('MTC0120117','','-','004','012','Water mor 1 1/4\"','Bh','-','0.1.04','2012-02-28 05:05:14'),('MTC0120118','','-','004','012','Tozen Twin Flex 2\"','Bh','-','0.1.04','2012-02-28 05:08:39'),('MTC0120119','','-','004','012','AM','Bh','-','0.1.04','2012-02-28 05:11:42'),('MTC0120120','','-','004','012','Mesin potong rumput','unit','-','0.1.04','2012-02-28 05:21:08'),('MTC0090061','','-','004','009','Kabel NYM 3x1,5 mm','M1','-','2.0.00','2012-02-28 06:26:48'),('MTC0090062','','-','004','009','Kabel Antena','M1','-','2.0.00','2012-02-28 06:27:17'),('MTC0120121','','-','004','012','Selang fakum kolam','M1','-','0.1.04','2012-02-28 06:54:35'),('MTC0120122','','-','004','012','Sikat Facum kolam','Bh','-','0.1.04','2012-02-28 06:58:39'),('MTC0120123','','-','004','012','Facum kolam (roda)','Bh','-','0.1.04','2012-02-28 07:01:00'),('MTC0120124','','-','004','012','Keramik 30x30 Coklat krem','Dos','-','2.0.00','2012-02-28 07:11:54'),('MTC0120125','','-','004','012','Keramik 33x33 krem','Dos','-','2.0.00','2012-02-28 07:12:26'),('MTC0120126','','-','004','012','Keramik 20x20 biru','Dos','-','2.0.00','2012-02-28 07:13:01'),('MTC0120127','','-','004','012','Batu lantai granit 40x40','Bj','-','2.0.00','2012-02-28 07:13:28'),('MTC0120128','','-','004','012','Keramik 20x20 merah','Dos','-','2.0.00','2012-02-28 07:15:59'),('MTC0120129','','-','004','012','Keramik 20x20 telur asin','Dos','-','2.0.00','2012-02-28 07:18:01'),('MTC0120130','','-','004','012','Keramik 30x30 Putih','Dos','-','2.0.00','2012-02-28 07:21:44'),('MTC0120131','','-','004','012','Keramik 16x33 hitam','Dos','-','2.0.00','2012-02-28 07:24:15'),('MTC0120132','','-','004','012','Keramik 10x20 Putih','Dos','-','2.0.00','2012-02-28 07:26:10'),('MTC0100073','','-','004','014','Cool box Plastik','Bh','-','0.1.04','2012-02-28 07:29:12'),('MTC0100074','','-','004','014','Tools box krisbow','Bh','-','0.1.04','2012-02-28 07:31:07'),('MTC0100075','','-','004','014','Fish Finder Furuno','unit','-','0.1.04','2012-02-28 07:33:46'),('DPR0020301','','-','001','002','Keju Kraft cheddar','gr','-','8.5.02','2012-03-12 03:26:41'),('DPR0020304','','-','001','002','Aqua isi ulang','Gln','-','8.5.02','2012-03-17 06:09:35'),('DPR0020302','','-','001','002','Isi ulang tabung gas','kg','-','8.5.02','2012-03-16 03:04:56'),('BFS0060001','','-','006','015','Gudang Garam Filter','Bks','-','2.0.00','2012-05-25 06:59:03'),('BFS0060002','','-','006','015','Marlboro Lite','Bks','-','2.0.00','2012-05-25 06:59:35'),('BFS0060003','','-','006','015','Sampoerna A Mild','Bks','-','2.0.00','2012-05-25 07:00:12'),('BFS0060004','','-','006','015','Sampoerna A Menthol','Bks','-','2.0.00','2012-05-25 07:00:44'),('BFS0060005','','-','006','016','Baby Wipes Pooh','Bks','-','2.0.00','2012-05-25 07:01:23'),('BFS0060006','','-','006','016','Mitu Baby Wipes','Bks','-','2.0.00','2012-05-25 07:02:01'),('BFS0060007','','-','006','016','Tessa Tissue','Bks','-','2.0.00','2012-05-25 07:02:37'),('BFS0060008','','-','006','017','Vaseline Sunblock','Pcs','-','2.0.00','2012-05-25 07:03:17'),('BFS0060009','','-','006','018','Kaos Oblong Logo Damar Hotel(T)','Pcs','-','2.0.00','2017-11-28 13:44:34'),('BFS0060010','','-','006','018','Kaos Oblong Logo Damar Hotel(K)','Pcs','-','2.0.00','2017-11-28 13:44:24'),('BFS0060011','','-','006','019','Dove Shp Daily Therapy 5ml','Pcs','-','2.0.00','2012-07-02 07:00:17'),('BFS0060012','','-','006','019','Sunsilk Shp Dmg Hair Treat 5ml','Pcs','-','2.0.00','2012-07-02 07:19:50'),('BFS0060013','','-','006','019','Pantene Shp Nourished Shine 5ml','Pcs','-','2.0.00','2012-07-02 07:32:32'),('BFS0060014','','-','006','019','Pantene Cond Ttl Dmg Care 40ea','Pcs','-','2.0.00','2012-07-02 08:22:15'),('BFS0060015','','-','006','015','Sampoerna Avo Mentol','Bks','-','2.0.00','2012-07-02 08:24:39'),('BFS0060016','','-','006','015','Djarum Super 12','Bks','-','2.0.00','2012-07-02 08:25:35'),('BFS0060017','','-','006','015','Djisamsoe Spr Premium','Bks','-','2.0.00','2012-07-02 08:26:35'),('BFS0060018','','-','006','015','Marlboro Black Mentol','Bks','-','2.0.00','2012-07-09 07:15:22'),('BFS0060019','','-','006','017','Vaseline Hbl Wht SPF24 100ml','btl','-','2.0.00','2012-08-17 01:47:37'),('BFS0060020','','-','006','015','Sampoerna Avolution','Bks','-','2.0.00','2012-08-17 01:48:11'),('BFS0060021','','-','006','018','Kaos Logo Damar Hotel Warna(Dewasa)','Pcs','-','2.0.00','2017-11-28 13:44:16'),('BFS0060022','','-','006','018','Kaos Logo Damar Hotel Warna(Anak2)','Pcs','-','2.0.00','2017-11-28 13:44:09'),('BFS0060023','','-','006','017','Vaseline Herbal 200ml','btl','-','2.0.00','2012-11-22 04:00:08'),('BFS0060024','','-','006','020','Sandal Jepit Swallow','pasan','-','2.0.00','2013-02-21 07:41:29'),('BFS0060025','','-','006','020','Sandal Jepit Zandilac','pasan','-','2.0.00','2013-02-21 07:42:44'),('BFS0060026','','-','006','017','Soffel Anti Nyamuk','Bks','-','2.0.00','2013-05-25 11:58:58'),('BFS0060027','','-','006','022','Laurier Active Day (Sachet)','Bks','-','2.0.00','2013-02-21 07:45:40'),('BFS0060028','','-','006','015','Rokok Class Mild','Bks','-','2.0.00','2013-02-21 07:46:48'),('BFS0060029','','-','006','017','Nivea Sun Moisturising SPF 30 ++','botol','-','2.0.00','2013-02-21 07:48:54'),('BFS0060030','','-','006','021','Claudia Sabun Mandi','Bks','-','2.0.00','2013-02-21 07:50:28'),('BFS0060031','','-','006','018','Kantong Batik','Bh','-','2.0.00','2013-02-21 07:54:15'),('BFS0060032','','-','006','015','LA Light','Bks','-','2.0.00','2013-03-02 04:28:07'),('BFS0060033','','-','006','020','Sandal Bata','pasan','-','2.0.00','2013-07-10 03:47:54'),('BFS0060034','','-','006','018','Kaos \'Damar Hotel\' COLE','Bh','-','2.0.00','2017-11-28 13:44:00'),('BFS0060035','','-','006','018','Dry Bag Ocean Pack','Bh','-','2.0.00','2013-09-06 08:44:25'),('BFS0060036','','-','006','018','Korek Gas','Bh','-','2.0.00','2013-09-06 08:45:51'),('BFS0060037','','-','006','024','Dramamine','Bks','-','2.0.00','2013-11-01 02:56:58'),('BFS0060038','','-','006','024','Kwells','Dos','-','2.0.00','2013-11-01 02:59:03'),('BFS0060039','','-','006','024','Afterbite','Bh','-','2.0.00','2013-11-01 03:00:17'),('BFS0060040','','-','006','020','Sandal Jepit Ando','pasan','-','2.0.00','2013-11-01 03:32:54'),('BFS0060041','','-','006','015','Marlboro Merah','Bks','-','2.0.00','2014-05-14 03:35:36'),('DPR0020137S','','-','001','002','Selai Morin Strowberry','Pcs','-','8.5.02','2015-01-20 04:43:55'),('DPR0020137B','','-','001','002','Selai Morin Blueberry','Pcs','-','8.5.02','2015-01-20 04:44:13'),('DPR0020137H','','-','001','002','Selai Mariza Honey','Pcs','-','8.5.02','2015-01-20 04:44:29'),('DPR0020137P','','-','001','002','Selai Mariza Pineapple','Pcs','-','8.5.02','2015-01-20 04:44:44'),('DPR0020287B','','-','001','002','Pocari Sweat Botol350ml','btl','-','8.5.02','2015-01-20 04:43:30'),('DPR0020303','','-','001','002','Mizone Apple Guava 500ml','btl','-','8.5.02','2015-01-20 04:48:47'),('DPR0020305','','-','001','002','Mizone Cocopina 500ml','btl','-','8.5.02','2015-01-20 04:48:23'),('DPR0020306','','-','001','002','Minute Maid Pulpy Orange 350ml','btl','-','8.5.02','2015-01-20 04:50:40'),('DPR0020307','','-','001','002','Sariwangi Teh Celup Jumbo @4ktg','Bks','-','8.5.02','2015-01-20 04:52:52'),('DPR0020308','','-','001','002','Torabika Moka','Bks','-','8.5.02','2015-01-20 04:58:46'),('DPR0020309','','-','001','002','Saori saus Tiram 275ml','btl','-','8.5.02','2015-01-20 05:01:10'),('DPR0020310','','-','001','002','Tissu Roll Dapur','Roll','-','8.5.02','2015-01-20 05:02:59'),('DPR0020311','','-','001','002','Gula Batu','gr','-','8.5.02','2015-01-20 05:04:26'),('DPR0020312','','-','001','002','Teh olong','gr','-','8.5.02','2015-01-20 05:05:27'),('DPR0020313','','-','001','002','Teh Dandang Selection','Bks','-','8.5.02','2015-01-20 05:06:26'),('DPR0020314','','-','001','002','Teh Jawa Vanila','Bks','-','8.5.02','2015-01-20 05:07:54'),('DPR0020315','','-','001','002','Teh Jawa Melati','Bks','-','8.5.02','2015-01-20 05:08:42'),('DPR0020316','','-','001','002','Teh Dandang Harum','Bks','-','8.5.02','2015-01-20 05:09:39'),('DPR0020317','','-','001','002','Teh Lestari','gr','-','8.5.02','2015-01-20 05:10:21'),('DPR0020318','','-','001','002','Teh Sosro Hijau Heritage','Pcs','-','8.5.02','2015-01-21 01:50:53'),('DPR0020319','','-','001','002','Teh Gopek','gr','-','8.5.02','2015-01-21 04:01:37'),('DPR0010161','','-','001','001','Show Case Polytron','unit','-','2.0.00','2015-01-23 14:00:14'),('DPR0010163','','-','001','001','Talenan Plastik Putih(kcl)','Bh','-','2.0.00','2015-01-23 14:06:31'),('DPR0010162','','-','001','001','Talenan Plastik Putih(bsr)','Bh','-','2.0.00','2015-01-23 14:12:23'),('DPR0010164','','-','001','001','Poci teh 2tang','Set','-','2.0.00','2015-01-24 06:47:25'),('DPR0010165','','-','001','001','Poci teh jawa','Set','-','2.0.00','2015-01-24 07:00:05'),('DPR0010166','','-','001','001','Bakaran Kambing Guling','Bh','-','2.0.00','2015-01-24 07:09:12'),('DPR0010167','','-','001','001','Teko kecil(merah muda)','Set','-','2.0.00','2015-01-24 07:33:47'),('DPR0010168','','-','001','001','Botol Plastik(tempat gula cair)','Bh','-','2.0.00','2015-01-24 07:12:20'),('DPR0010169','','-','001','001','Toples Gula/kopi','Bh','-','2.0.00','2015-01-24 07:13:17'),('DPR0010170','','-','001','001','Gelas es(tumbler bsr)','Bh','-','2.0.00','2015-01-24 07:20:09'),('DPR0010171','','-','001','001','Sendok ice cream','Pcs','-','2.0.00','2015-01-24 07:21:09'),('DPR0010172','','-','001','001','Sunnex anti slip round tray(kcl)','Bh','-','2.0.00','2015-01-24 07:40:53'),('DPR0010173','','-','001','001','Toples Kerupuk','Bh','-','2.0.00','2015-01-24 07:40:15'),('DPR0010174','','-','001','001','Sugar Pot white(kecil)','Bh','-','2.0.00','2015-01-24 07:43:15'),('DPR0010175','','-','001','001','Piring Roti (biru)','Bh','-','2.0.00','2015-01-24 07:46:19'),('DPR0010176','','-','001','001','Gelas Juice(kaki)','Bh','-','2.0.00','2015-01-24 07:47:55'),('DPR0010177','','-','001','001','Gelas Juice(biasa)','Bh','-','2.0.00','2015-01-24 07:48:46'),('DPR0010178','','-','001','001','Piring Oval 35cm','Bh','-','2.0.00','2015-01-24 07:57:43'),('HKP0060064','','-','003','006','Asbak porcelen bsr','Bh','-','2.0.00','2015-01-24 08:16:34'),('DPR0010179','','-','001','001','Mangkok kecil polos','Pcs','-','2.0.00','2015-01-24 09:08:07'),('DPR0010180','','-','001','001','Toples tutup pink(tempat bwg goreng)','Bh','-','2.0.00','2015-01-24 09:09:46'),('DPR0010181','','-','001','001','Cup bulat kcl','Bh','-','2.0.00','2015-01-24 09:11:09'),('DPR0010182','','-','001','001','Klassique RD CSRL(bening bertutup)','Set','-','2.0.00','2015-01-26 01:29:10'),('BSF0060042','','-','006','015','Marlboro light menthol','Bks','-','2.0.00','2015-05-25 01:10:07');
/*!40000 ALTER TABLE `mst_material_part` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_menuweb`
--

DROP TABLE IF EXISTS `mst_menuweb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_menuweb` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `seqno` int(11) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `target` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_menuweb`
--

LOCK TABLES `mst_menuweb` WRITE;
/*!40000 ALTER TABLE `mst_menuweb` DISABLE KEYS */;
INSERT INTO `mst_menuweb` VALUES (1,1,'ind','Home','','main_frame','<p style=\"text-align: center;\">&nbsp;</p>\r\n<h2 style=\"margin: 0px; padding: 5px 0px; font-size: 20px; color: rgb(52, 38, 10); line-height: 1.5; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: center;\"><font size=\"4\" style=\"color: rgb(51, 51, 255);\">Blue Fish Tanjung Lesung Resort<br />\r\n</font></h2>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><br />\r\n&nbsp;<img alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/752737.jpg?421\" /></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<h2 style=\"margin: 0px; padding: 5px 0px; font-size: 20px; color: rgb(52, 38, 10); line-height: 1.5; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: center;\"><font size=\"4\" style=\"color: rgb(51, 51, 255);\">Enjoy your vacation on the blue water beach</font></h2>\r\n<p style=\"text-align: center;\">&nbsp;<img alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/817840.jpg?360\" /></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<h2 style=\"margin: 0px; padding: 5px 0px; font-size: 20px; color: rgb(52, 38, 10); line-height: 1.5; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: center;\"><font size=\"4\" style=\"color: rgb(51, 51, 255);\">Let\'s go fishing and more activities&nbsp;</font></h2>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>','superuser','2017-05-19 07:14:59','2017-05-19 07:14:59'),(2,2,'ind','About Us','','main_frame','<p style=\"text-align: center;\">&nbsp;<img src=\"https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/21430141_10154880944597393_936586782937058974_n.jpg?oh=b624aa548e455c1e1eb1b1f588c6378f&amp;oe=5A5939B5\" width=\"400\" height=\"478\" alt=\"\" /></p>\r\n<p style=\"text-align: left;\"><span style=\"color: rgb(255, 255, 0);\">Fish Tanjung Lesung located in the Pandeglang district , Banten province - Indonesia. It\'s about 3 hours traveled from Jakarta. &quot;BlueFish Tanjung Lesung&quot; at Bunnar B &amp; B Complex Tanjung Lesung Resort, a new destination there are exciting and for the new experience. It\'s really a nice place to relax your body and mind with beautiful sunrise and white sandy beach...</span></p>','','2017-09-04 10:21:51','2017-09-04 10:21:51'),(4,3,'ind','Facilities','','main_frame','<p style=\"text-align: left;\">&nbsp;</p>\r\n<h2 style=\"margin: 0px; padding: 5px 0px; font-size: 20px; color: rgb(52, 38, 10); line-height: 1.5; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: left;\"><font size=\"2\" style=\"color: rgb(42, 53, 178); font-weight: normal;\"><span style=\"font-weight: bold;\">Bluefish facilities</span>:&nbsp;<br />\r\n</font><font size=\"2\" style=\"color: rgb(42, 53, 178); font-weight: normal;\">a romantic place ; 1 room for 2 persons</font><br />\r\n<font size=\"2\" style=\"color: rgb(42, 53, 178); font-weight: normal;\">2 single beds, full AC, bathroom with shower,&nbsp;<br />\r\nhot &amp; cold water<br />\r\n</font><font size=\"2\" style=\"color: rgb(42, 53, 178); font-weight: normal;\">1 king size, full AC, bathroom with shower,&nbsp;<br />\r\nhot &amp; cold water</font><br />\r\n<font size=\"2\" style=\"color: rgb(42, 53, 178); font-weight: normal;\">Restaurant with great and delicious food<br />\r\nTelevision &amp; Pool</font></h2>\r\n<p style=\"text-align: left;\"><img alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/8084349.jpg?306\" /></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: left;\" class=\"paragraph\">...................................................................................................................................</div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: left;\" class=\"paragraph\"><span style=\"color: rgb(42, 53, 178);\">at &quot;Bluefish&quot; you can experience the peacefulness of fishing around the bay. &nbsp;For big game fishing check out our special offer.</span></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: left;\" class=\"paragraph\">&nbsp;</div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans, arial, sans-serif; background-color: rgb(242, 242, 242); text-align: left;\" class=\"paragraph\"><img alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/8117884.jpg?598\" /></div>\r\n<p>&nbsp;</p>','superuser','2014-10-15 06:40:33','2014-10-15 06:40:33'),(5,6,'ind','Contact Us','','main_frame','For further information please contact:<br>\nPhone : 021-7254527 / 021-7254529 (Office hour)<br>\nMobile : 0813 833 16990<br>\nFax : 021-7254528<br>\ne-mail : admin@karmanta.com','superuser','2014-11-03 03:38:36','2017-01-08 13:24:57'),(6,5,'ind','Activities','','main_frame','<p><b> </b></p>\r\n<p>&nbsp;</p>\r\n<p><b><br />\r\n</b></p>\r\n<p><img src=\"https://photos-6.dropbox.com/t/2/AADW0MzfMcO0KqIOzdM1vO0GttuBXJVg-ipe7Ul4-KMNoA/12/313229469/jpeg/32x32/1/_/1/2/Banana.jpg/EIWD2bQCGKcBIAEoAQ/jfNCDnB-FjsY3AGmpM6WVmlKQjMzZaGls92dM_1EadA?size=1024x768&amp;size_mode=2\" width=\"400\" height=\"267\" alt=\"\" /></p>\r\n<p><strong>Banana Boat</strong></p>\r\n<p>&nbsp;</p>\r\n<p><b><br />\r\n</b></p>\r\n<p><b><img width=\"400\" height=\"281\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/7871215.jpg?340\" alt=\"\" /></b></p>\r\n<p><b> </b></p>\r\n<p><b>Kayaking</b></p>\r\n<p><b> </b></p>\r\n<p><b>&nbsp;</b></p>\r\n<p><b> </b></p>\r\n<p><b><img width=\"400\" height=\"281\" alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/5265127.jpg?343\" />&nbsp;</b></p>\r\n<p><b>\r\n<p>Snorkling</p>\r\n<p><img src=\"https://photos-5.dropbox.com/t/2/AADjRmEiBnKviwwfnIPAPFa_dgRiDy5f4xkfBODlv1DplQ/12/313229469/jpeg/32x32/1/_/1/2/jetski%20berdua%20(2).jpg/EIWD2bQCGKgBIAEoAQ/Zu-lSP22d2_4o3ew0pbNAPsLL5qx3drm6i3_gUH8Lgo?size=1024x768&amp;size_mode=2\" width=\"400\" height=\"279\" alt=\"\" /></p>\r\n<p>Jetsky</p>\r\n<p>&nbsp;</p>\r\n<p><img width=\"400\" height=\"281\" alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/8147836.jpg?466\" /></p>\r\n<p>&nbsp;</p>\r\n<p>Spot Fishing area</p>\r\n<p>&nbsp;</p>\r\n<p><img width=\"400\" height=\"281\" alt=\"\" src=\"http://bluefish00.weebly.com/uploads/3/1/9/0/3190875/6630934.jpg?373\" /></p>\r\n<p>&nbsp;</p>\r\n<p>Tanjung Lesung Bike Park</p>\r\n<p><img src=\"https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-prn2/q71/1455110_10151782549702393_1612117530_n.jpg\" alt=\"\" />&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img width=\"400\" height=\"281\" src=\"https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-frc3/q85/s720x720/1463144_10151782536877393_799784157_n.jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</b></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','superuser','2015-09-29 09:46:18','2015-09-29 09:46:18'),(7,4,'ind','Rate & Special Offer','','main_frame','<p><em><span style=\"font-size: xx-large;\"><font style=\"text-decoration: underline; color: rgb(51, 51, 255);\"><br />\r\n</font></span></em></p>\r\n<p style=\"text-align: center;\"><em><span style=\"font-size: xx-large;\"><font style=\"text-decoration: underline; color: rgb(51, 51, 255);\">Publish Rate (Room)</font></span></em></p>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Rp. 976.800,-&nbsp; Nett / night week end</strong></font>&nbsp;<span style=\"color: rgb(51, 51, 255); font-weight: bold;\">&amp; Holidays</span><br />\r\n<font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Rp. 732.600,-&nbsp; Nett / night week days&nbsp;<font size=\"1\">(Monday to Thursday)</font></strong></font><br />\r\n<em><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Extra bed :&nbsp; Rp. 250.000,-&nbsp; Nett / pax</strong></font><br type=\"_moz\" />\r\n</em></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><em><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Extra Person : Rp. 185.000,- Nett /pax</strong></font></em><span style=\"color: rgb(255, 153, 0);\"><br />\r\n<font size=\"1\" style=\"color: rgb(51, 51, 255);\"><strong><span style=\"font-weight: normal;\">In this rate include :</span><br />\r\n</strong></font><font size=\"1\" style=\"color: rgb(51, 51, 255);\">&nbsp; &nbsp;<strong>Breakfast<br />\r\n</strong><br />\r\n</font></span></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; font-family: LucidaSans, arial, sans-serif; text-align: center; background-color: rgb(242, 242, 242);\" class=\"paragraph\">&nbsp;</div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"3\" style=\"text-decoration: underline; color: rgb(36, 63, 215);\"><em><span style=\"font-size: x-large;\"><strong><font style=\"color: rgb(51, 51, 255);\">Publish Rate for group of 20 - 48 pax</font></strong></span></em><br />\r\n</font><em><span style=\"color: rgb(51, 153, 102);\"><span style=\"font-size: larger;\"><font style=\"color: rgb(51, 51, 255);\"><strong>Room twin sharing :</strong></font></span></span></em><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong><br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Week end ............................ Rp. 366.000,- Nett /pax</strong></font><br />\r\n<span style=\"color: rgb(51, 51, 255);\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Week days .......................... Rp. 244.000,- Nett /pax</strong></font><br />\r\n<span style=\"color: rgb(51, 153, 102);\"><span style=\"font-size: larger;\"><em><font style=\"color: rgb(51, 51, 255);\"><strong>Room triple sharing :</strong></font></em></span></span><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong><br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Week end ..............................Rp. 305.000,- Nett /pax</strong></font><br />\r\n<span style=\"color: rgb(51, 51, 255);\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Week days ............................Rp. 185.000,- Nett /pax</strong></font></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\">&nbsp;</div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 153, 102);\"><span style=\"font-size: larger;\"><em><font style=\"color: rgb(51, 51, 255);\"><strong>Group Meals :</strong></font></em></span></span><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong><br />\r\n</strong></font></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Breakfast ..............................Rp.&nbsp; 54.000,- Nett /pax</strong></font></strong></font></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Lunch .....................................Rp.&nbsp; 72.000,- Nett /pax</strong></font></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong>Dinner ....................................Rp.&nbsp; 102.000,- Nett /pax</strong></font></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(51, 51, 255);\"><strong><br />\r\n</strong></font><span style=\"color: rgb(51, 51, 255);\">&nbsp;&nbsp;&nbsp; </span><br />\r\n<font size=\"1\" style=\"color: rgb(51, 51, 255);\"><strong><span style=\"font-weight: normal;\">In this rate include :</span><br />\r\n</strong></font><em><font size=\"1\" style=\"color: rgb(51, 51, 255);\">&nbsp;&nbsp;<strong>&nbsp; - Do not include anything</strong></font></em><font size=\"1\" style=\"color: rgb(51, 51, 255);\"><br />\r\n</font><br />\r\n<em><font size=\"3\"><strong style=\"color: rgb(51, 51, 255);\">Group additional items :</strong></font></em></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><em><font size=\"3\"><strong style=\"color: rgb(51, 51, 255);\"><br />\r\n</strong></font></em></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Beach club Voucher ................Rp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 90,000,- / pax</span><span style=\"color: rgb(51, 51, 255); font-weight: bold;\"><br />\r\n</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Dinner Sea Food BBQ .............Rp. &nbsp; &nbsp; &nbsp;210,000,- /&nbsp; pax&nbsp;</span><span style=\"color: rgb(51, 51, 255); font-weight: bold;\"><br />\r\n</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Suling performance ...............Rp. &nbsp;&nbsp;&nbsp;&nbsp; 1.000.000,- / 2 jam</span><span style=\"color: rgb(51, 51, 255); font-weight: bold;\"><br />\r\n</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Sewa Kapal ..........................Rp. &nbsp;&nbsp;&nbsp;&nbsp; 1.000.000,- / kapal 3 jam max 6 pax</span><span style=\"color: rgb(51, 51, 255); font-weight: bold;\"><br />\r\n</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Outdoor Fun Games...................................Rp. &nbsp;&nbsp;&nbsp;&nbsp; 65,000,- Nett / pax (5 Games)</span><span style=\"color: rgb(51, 51, 255); font-weight: bold;\"><br />\r\n</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Organ tunggal ..........................Rp. &nbsp; 4.250,000,- Nett / 3 jam</span><span style=\"color: rgb(51, 51, 255); font-weight: bold;\"><br />\r\n</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Snack, Coffee &amp; Tea ...............Rp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 30.000,- Nett /pax</span></div>\r\n<div style=\"margin: 0px 0px 0px 40px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Kambing Guling....................... Rp. 3.000.000,- Nett /Pax</span><br />\r\n<span style=\"color: rgb(51, 102, 255);\">(Price is subject to Tax)</span><br />\r\n<br />\r\n<span style=\"font-size: x-large;\"><em><font style=\"font-weight: bold;\"><span style=\"color: rgb(51, 51, 255);\">Fishing Package&nbsp;(</span></font><font style=\"font-weight: bold;\"><span style=\"color: rgb(51, 51, 255);\">Minimum 8 pax Maximum 10 pax)</span></font></em></span><br />\r\n<span style=\"color: rgb(51, 51, 255); font-weight: bold;\">1 night in Hotel 1 night on Boat&nbsp;</span><br />\r\n<span style=\"color: rgb(51, 51, 255); font-weight: bold;\">Fishing only ............................................Rp.&nbsp; 2,750,000,- / pax </span></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255); font-weight: bold;\">1 Fisherman &amp; 1 adult + 2 kids ( under 12 years) &nbsp; &nbsp; &nbsp; &nbsp;Rp.&nbsp; 4,850,000,- /1 room&nbsp;&nbsp;</span><br />\r\n<span style=\"color: rgb(51, 51, 255);\">In this rate Including :&nbsp;</span><br />\r\n<span style=\"color: rgb(51, 51, 255);\">- Boat&nbsp;</span><br />\r\n<em><span style=\"color: rgb(51, 51, 255);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; KM Jagat 8 - 10 Pax</span></em><br />\r\n<span style=\"color: rgb(51, 51, 255);\">Bait&nbsp;</span><br />\r\n<span style=\"color: rgb(51, 51, 255);\">Room Hotel 1 Night + Breakfast</span></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><span style=\"color: rgb(51, 51, 255);\">Boat Full Board&nbsp;</span><br />\r\n<br />\r\n<span style=\"color: rgb(51, 51, 255);\">&quot;++&nbsp; - Price subject to 10 % tax and 11 % Service &quot;</span></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\">&nbsp;</div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(238, 226, 226);\"><strong><span style=\"font-style: italic; color: rgb(51, 51, 255);\">----Travel and whole sale price available upon request----</span></strong></font></div>\r\n<div style=\"margin: 0px; padding: 5px 0px; line-height: 22px; color: rgb(52, 38, 10); font-size: 13px; font-family: LucidaSans,arial,sans-serif; background-color: rgb(242, 242, 242); text-align: center;\" class=\"paragraph\"><font size=\"2\" style=\"color: rgb(238, 226, 226);\"><strong><span style=\"font-style: italic; color: rgb(51, 51, 255);\">For More Information Please Contact : +62 21 725 45 29 (Office Hour) +62813 833 16 990</span></strong></font></div>\r\n<p>&nbsp;</p>','superuser','2017-09-15 03:33:29','2017-09-15 03:33:29');
/*!40000 ALTER TABLE `mst_menuweb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_modelunit`
--

DROP TABLE IF EXISTS `mst_modelunit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_modelunit` (
  `kode` varchar(10) NOT NULL,
  `model` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_modelunit`
--

LOCK TABLES `mst_modelunit` WRITE;
/*!40000 ALTER TABLE `mst_modelunit` DISABLE KEYS */;
INSERT INTO `mst_modelunit` VALUES ('001','Alat-alat Dapur','','0000-00-00 00:00:00'),('002','Bahan-bahan makanan','','0000-00-00 00:00:00'),('003','Voucher','','0000-00-00 00:00:00'),('004','Aminitis','','0000-00-00 00:00:00'),('005','Elektronik','','0000-00-00 00:00:00'),('006','Kebersihan','','0000-00-00 00:00:00'),('007','Linen','','0000-00-00 00:00:00'),('008','Perlengkapan Kamar','','0000-00-00 00:00:00'),('009','Listrik','','0000-00-00 00:00:00'),('010','Perlengkapan Hotel','','0000-00-00 00:00:00'),('011','Plumbing','','0000-00-00 00:00:00'),('012','Tools','','0000-00-00 00:00:00'),('013','Computer','','0000-00-00 00:00:00'),('014','Peralatan Mancing','','2012-02-20 02:21:23'),('999','Lainnya','','2012-02-20 02:28:51'),('015','Rokok','-','2012-05-25 06:55:12'),('016','Tissue','-','2012-05-25 06:55:31'),('017','Lotion','-','2012-05-25 06:55:50'),('018','Souvenir','-','2012-06-16 13:44:59'),('019','Shampo','-','2012-07-02 06:59:44'),('020','Sandal','-','2013-02-21 07:39:06'),('021','Sabun','-','2013-02-21 07:40:10'),('022','Pembalut','-','2013-02-21 07:40:51'),('024','Obat-obatan','-','2013-11-01 02:53:09'),('023','Makanan kecil','-','2013-11-01 02:56:21');
/*!40000 ALTER TABLE `mst_modelunit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_name_title`
--

DROP TABLE IF EXISTS `mst_name_title`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_name_title` (
  `kode` varchar(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_name_title`
--

LOCK TABLES `mst_name_title` WRITE;
/*!40000 ALTER TABLE `mst_name_title` DISABLE KEYS */;
INSERT INTO `mst_name_title` VALUES ('Mr','Mr.','0000-00-00 00:00:00'),('Ms','Miss','0000-00-00 00:00:00'),('Mrs','Mrs.','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `mst_name_title` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_pay_type`
--

DROP TABLE IF EXISTS `mst_pay_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_pay_type` (
  `kode` varchar(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_pay_type`
--

LOCK TABLES `mst_pay_type` WRITE;
/*!40000 ALTER TABLE `mst_pay_type` DISABLE KEYS */;
INSERT INTO `mst_pay_type` VALUES ('01','Cash','0000-00-00 00:00:00'),('02','Credit','0000-00-00 00:00:00'),('03','Debit Card','2012-09-10 02:46:36'),('04','Bank Transfer','2012-09-10 02:45:11');
/*!40000 ALTER TABLE `mst_pay_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_profile`
--

DROP TABLE IF EXISTS `mst_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_profile` (
  `title` varchar(255) NOT NULL,
  `hotelname` varchar(100) NOT NULL,
  `urlwebhosting` varchar(100) NOT NULL,
  `bookpicname` varchar(100) NOT NULL,
  `bookemail` varchar(100) NOT NULL,
  `frommailname` varchar(100) NOT NULL,
  `hotelreporttitle` varchar(100) NOT NULL,
  `addressforheader` varchar(255) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`hotelname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_profile`
--

LOCK TABLES `mst_profile` WRITE;
/*!40000 ALTER TABLE `mst_profile` DISABLE KEYS */;
INSERT INTO `mst_profile` VALUES ('HOTEL DAMAR,  Enjoy your vacation at the Apple City','Hotel Damar','','','','Hotel Damar','Hotel Damar','Jalan Kedawung 45<br>Malang - Jawa Timur 65141<br>0341 3037070','','2017-11-28 13:59:52');
/*!40000 ALTER TABLE `mst_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_room`
--

DROP TABLE IF EXISTS `mst_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_room` (
  `kode` varchar(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `price2` double NOT NULL,
  `available` smallint(6) NOT NULL,
  `booked` smallint(6) NOT NULL,
  `tipe` varchar(3) NOT NULL,
  `connecting1` varchar(3) NOT NULL,
  `connecting2` varchar(3) NOT NULL,
  `changeby` varchar(20) NOT NULL,
  `changedate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_room`
--

LOCK TABLES `mst_room` WRITE;
/*!40000 ALTER TABLE `mst_room` DISABLE KEYS */;
INSERT INTO `mst_room` VALUES ('205','205--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:37:50','2017-12-05 13:35:07'),('203','203--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('202','202--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('201','201--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('118','118--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:47:05','2017-12-05 13:35:07'),('117','117--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:46:59','2017-12-05 13:35:07'),('116','116--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:46:53','2017-12-05 13:35:07'),('115','115--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:41:12','2017-12-05 13:35:07'),('114','114--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:41:02','2017-12-05 13:35:07'),('112','112--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:40:49','2017-12-05 13:35:07'),('111','111--Deluxe king',350000,375000,0,0,'001','','','','2017-12-05 08:40:33','2017-12-05 13:35:07'),('110','110--Deluxe king',350000,375000,0,0,'001','','','','2017-12-05 08:40:27','2017-12-05 13:35:07'),('109','109--Family Room',800000,1000000,0,0,'004','','','','2017-12-05 08:37:32','2017-12-05 13:35:07'),('108','108--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:37:22','2017-12-06 00:26:12'),('107','107--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:37:13','2017-12-05 13:35:07'),('106','106--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:37:05','2017-12-05 13:35:07'),('105','105--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:36:58','2017-12-05 13:35:07'),('103','103--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('102','102--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('101','101--Deluxe king',350000,375000,0,0,'001','','','','2017-12-05 08:36:32','2017-12-06 00:16:38'),('206','206--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:37:58','2017-12-05 13:35:07'),('207','207--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:38:05','2017-12-05 13:35:07'),('208','208--Deluxe w/ Balcon',375000,400000,0,0,'003','','','','2017-12-05 08:38:11','2017-12-05 13:35:07'),('209','209--Deluxe w/ Balcon',375000,400000,0,0,'003','','','superuser','2017-12-06 11:16:33','2017-12-06 11:17:02'),('210','210--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('211','211--Deluxe king',350000,375000,0,0,'001','','','','0000-00-00 00:00:00','2017-12-05 13:35:07'),('212','212--Deluxe King',350000,375000,0,0,'001','','','superuser','2017-12-06 11:17:38','2017-12-06 11:17:38'),('214','214--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:47:31','2017-12-05 13:35:07'),('215','215--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:47:39','2017-12-05 13:35:07'),('216','216--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:47:45','2017-12-05 13:35:07'),('217','217--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:47:50','2017-12-05 13:35:07'),('218','218--Deluxe Twin',350000,375000,0,0,'002','','','','2017-12-05 08:47:55','2017-12-05 13:35:07'),('219','219--Deluxe Twin',350000,375000,0,0,'002','','','superuser','2017-12-06 11:18:14','2017-12-06 11:18:32');
/*!40000 ALTER TABLE `mst_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_room_price`
--

DROP TABLE IF EXISTS `mst_room_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_room_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal1` date NOT NULL,
  `tanggal2` date NOT NULL,
  `room` varchar(3) NOT NULL,
  `roomtype` varchar(3) NOT NULL,
  `description` varchar(50) NOT NULL,
  `baseprice` double NOT NULL,
  `tax` double NOT NULL,
  `service` double NOT NULL,
  `aftertaxservice` double NOT NULL,
  `createby` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tanggal1` (`tanggal1`,`tanggal2`,`baseprice`,`aftertaxservice`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_room_price`
--

LOCK TABLES `mst_room_price` WRITE;
/*!40000 ALTER TABLE `mst_room_price` DISABLE KEYS */;
INSERT INTO `mst_room_price` VALUES (1,'0000-00-00','0000-00-00','','','Week Days',600000,10,11,732600,'superuser','2013-06-10 03:31:22','2013-06-10 03:31:22'),(2,'0000-00-00','0000-00-00','','','Week Ends',800000,10,11,976800,'superuser','2013-06-10 03:26:58','2013-06-10 03:27:26');
/*!40000 ALTER TABLE `mst_room_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_room_type`
--

DROP TABLE IF EXISTS `mst_room_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_room_type` (
  `id` varchar(3) NOT NULL,
  `description` varchar(50) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_room_type`
--

LOCK TABLES `mst_room_type` WRITE;
/*!40000 ALTER TABLE `mst_room_type` DISABLE KEYS */;
INSERT INTO `mst_room_type` VALUES ('001','Deluxe king','2017-12-05 08:39:07'),('002','Deluxe Twin','2017-12-05 08:53:08'),('003','Deluxe w/ Balcon','2017-12-05 08:53:17'),('004','Family Room','2017-12-05 08:53:20');
/*!40000 ALTER TABLE `mst_room_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_satuan`
--

DROP TABLE IF EXISTS `mst_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_satuan` (
  `kode` varchar(5) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `singkatan` varchar(10) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `satuan` (`satuan`,`singkatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_satuan`
--

LOCK TABLES `mst_satuan` WRITE;
/*!40000 ALTER TABLE `mst_satuan` DISABLE KEYS */;
INSERT INTO `mst_satuan` VALUES ('assy\r','assy\r','assy\r','0000-00-00 00:00:00'),('Batan','Batang\r','Batang\r','0000-00-00 00:00:00'),('Bh ','Bh ','Bh ','0000-00-00 00:00:00'),('Bj','Bj','Bj','0000-00-00 00:00:00'),('Bks','Bungkus','Bks','2011-12-07 02:26:33'),('botol','botol\r','botol\r','0000-00-00 00:00:00'),('Box\r','Box\r','Box\r','0000-00-00 00:00:00'),('btg','Batang','btg','0000-00-00 00:00:00'),('btl','botol','btl','2012-02-20 02:23:10'),('buku','buku','buku','0000-00-00 00:00:00'),('Dos','Dos','Dos','0000-00-00 00:00:00'),('Drum\r','Drum\r','Drum\r','0000-00-00 00:00:00'),('Ea\r','Ea\r','Ea\r','0000-00-00 00:00:00'),('Gln','Gln','Gln','0000-00-00 00:00:00'),('gr','gram','gr','2012-02-02 02:35:05'),('Ikat','Ikat','Ikat','2011-12-07 04:14:21'),('Jrgn','Jerigen','Jrgn','2011-12-07 02:22:12'),('kg\r','kg\r','kg\r','0000-00-00 00:00:00'),('kit\r','kit\r','kit\r','0000-00-00 00:00:00'),('Klg','Klg','Klg','0000-00-00 00:00:00'),('kotak','kotak','kotak','0000-00-00 00:00:00'),('Krg','Karung','Krg','2011-12-07 03:09:07'),('Ktk','Kotak','Ktk','0000-00-00 00:00:00'),('Lbr','Lembar','Lbr','0000-00-00 00:00:00'),('Ls','Ls','Ls','0000-00-00 00:00:00'),('Ltr','Liter','Ltr','0000-00-00 00:00:00'),('M1','M1','M1','0000-00-00 00:00:00'),('M2','M2','M2','0000-00-00 00:00:00'),('M3\r','M3\r','M3\r','0000-00-00 00:00:00'),('ml','mililiter','ml','2012-02-14 03:34:52'),('Pak','Paket','Pak','2011-12-07 02:47:36'),('pasan','pasang','pasang','0000-00-00 00:00:00'),('Pcs','Pieces','Pcs','0000-00-00 00:00:00'),('Phn ','Phn ','Phn ','0000-00-00 00:00:00'),('Ptng ','Ptng ','Ptng ','0000-00-00 00:00:00'),('Ret ','Ret ','Ret ','0000-00-00 00:00:00'),('Rim\r','Rim\r','Rim\r','0000-00-00 00:00:00'),('Roll\r','Roll\r','Roll\r','0000-00-00 00:00:00'),('Set','Set','Set','0000-00-00 00:00:00'),('Ton\r','Ton\r','Ton\r','0000-00-00 00:00:00'),('unit\r','unit\r','unit\r','0000-00-00 00:00:00'),('Zak\r','Zak\r','Zak\r','0000-00-00 00:00:00'),('ton','TON','TON','2016-01-09 08:38:32');
/*!40000 ALTER TABLE `mst_satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_vendor`
--

DROP TABLE IF EXISTS `mst_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_vendor` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `alamatpajak` varchar(255) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `peruntukan` varchar(50) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `nama` (`nama`,`pic`,`peruntukan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_vendor`
--

LOCK TABLES `mst_vendor` WRITE;
/*!40000 ALTER TABLE `mst_vendor` DISABLE KEYS */;
INSERT INTO `mst_vendor` VALUES ('SUP001','Cahaya Makmur','Jl. Letjen Suprapto RT.17 No. 15 Balikpapan','','','','0542-422339','0542-422359','cvseryavi@yahoo.com','','0000-00-00 00:00:00'),('SUP002','Century Computer  ','Komp Balikpapan Baru Blok AB 4 No.8','','','','0542-877647','0542-877646','','','0000-00-00 00:00:00'),('SUP003','CV. Hadi Jaya','Jl. Sukarno Hatta KM 5.5 RT.73 No.04','','','','0542-860627','0542-860627','','','0000-00-00 00:00:00'),('SUP004','KARMANTA','-','-','-','-','-','-','-','','0000-00-00 00:00:00'),('SUP005','Pasar','-','-','-','-','--','-','-','','0000-00-00 00:00:00'),('SUP006','Pasifik Elektrik ','Jl. Jend. Sudirman Klandasan ','','','','0542-739147','','','','0000-00-00 00:00:00'),('SUP007','PLN','-','-','-','-','-','-','-','','0000-00-00 00:00:00'),('SUP008','Restauran Luar','-','-','-','-','-','-','-','','0000-00-00 00:00:00'),('SUP009','Sumber Jaya Elektronik ','Jl. Jenderal Sudirman 234, Balikpapan ','','','','0542-422605','0542-423862','sumberjayatoko@gmail.com','','0000-00-00 00:00:00'),('SUP010','Unggul  Diesel Perkasa','Balikpapan Permai Blok A1 No.14 Balikpapan','','','','0542-744557','0542-744556','','','0000-00-00 00:00:00'),('SUP999','Lain-lain','-','-','-','-','-','-','-','unit','0000-00-00 00:00:00'),('SUP011','ALFAMIDI','Panimbang','-','-','-','-','-','-','','2011-12-06 05:48:08'),('SUP012','Pom Bensin','Panimbang','-','-','-','-','-','-','','2011-12-06 05:52:15'),('SUP013','INDOMARET','Panimbang','-','-','-','-','-','-','','2011-12-06 08:19:00'),('SUP014','ALFAMART','Panimbang','-','-','-','-','-','-','','2011-12-06 08:19:52'),('SUP015','Toko Sembako AAN/UUN','Labuan','-','-','-','-','-','-','','2011-12-06 08:37:15'),('SUP016','Toko Alinda','Citereup','-','-','-','-','-','-','','2011-12-06 08:22:51'),('SUP017','Toko Bunar','Bunar','-','-','-','-','-','-','','2011-12-06 08:23:37'),('SUP018','Kios Sayuran \"GIO\"','Panimbang','-','-','-','-','-','-','','2011-12-06 08:24:40'),('SUP019','Toko ELISA RAHMAN','Citereup','-','-','-','-','-','-','','2011-12-06 08:25:58'),('SUP020','Toko Sarpan','Bunar','-','-','-','-','-','-','','2011-12-06 08:29:10'),('SUP021','Toko Dengkul Jaya','Citereup','-','-','-','-','-','-','','2011-12-06 08:30:36'),('SUP022','LOTTE MART','JL.Lingkar Luar Sel Kav 5-6 Ciracas Jakarta','-','01.562.024.8-091.000','-','021-74700140','-','-','','2011-12-06 08:40:27'),('SUP023','Panimbang Motor','Panimbang','-','-','-','-','-','-','','2011-12-08 13:03:19'),('SUP024','CV.WIDI','Tg.Lesung Resort','-','-','-','-','-','-','','2011-12-08 13:04:49'),('SUP025','BWJ','Tg.Lesung Resort','-','-','-','-','-','-','','2011-12-08 13:07:59'),('SUP026','Apotik Motor Citeureup','Citeureup','-','-','-','-','-','-','','2012-01-19 07:17:28'),('SUP027','Larassetts Laundry','Jl. Bungur Raya No. 2, Kebayoran Lama, Jakarta','-','-','-','021 99507245','-','-','','2012-02-03 08:38:25'),('SUP028','Marinus','-','-','-','-','-','-','mmarinus_06@yahoo.co.uk','','2012-02-03 08:43:01'),('-','CV Alga Amenities','Jl. Cawang Baru No. 37, Cawang Kapilng, Jakarta Timur','-','-','-','0218579290','0218579292','alga234@yahoo.in','','2012-02-29 07:43:47'),('SUP029','Toko Bangunan Panimbang','Jl Ry Panimbang - Sobang','-','-','-','(0253) 882222','(0253) 882223','-','','2012-03-04 15:40:58'),('SUP030','PT. BANTEN WEST JAVA','Menara Batavia Lt. 25 Jl. KH. Mas Mansyur Kav. 126 Jakarta 10220','-','-','-','-','-','-','','2012-03-14 04:14:45'),('SUP031','BEACH CLUB','Tg.Lesung Resort','-','-','-','-','-','-','','2012-04-20 03:01:31'),('0','PT. Lancar Setia','Jl. Pondok Betung Raya 88, Bintaro Sektor 3','idem','0','-','0217359350','0217373845','0','','2012-04-23 08:53:02'),('00','Lancar Setia','Bintaro Sektor 3, Jl. pondok Betung Raya 88','-','-','-','0217359350 , 7373845','-','-','','2012-07-03 02:45:49'),('SUP0020','Rahmat | Ruber Boat','Tangerang','-','-','RAHMAT','087882588717','-','-','','2012-10-03 09:28:47'),('SUP032','Kedaung Tabtop Outlet Kemang','Jl Kemang Selatan VII No C 4/2','-','01.000.283.0.038.000','-','021 71790208','021 71790708','-','','2013-01-21 05:37:22'),('SUP033','Kedaung Industrial LTD','Kp Poglar Kedaung Kaliangke','-','01.000.283.0-038.000','-','021 73881515','-','-','','2013-01-21 05:47:46'),('SUPP_TEST','Test Supplier','-','-','-','-','-','-','-','','2016-01-09 14:20:02');
/*!40000 ALTER TABLE `mst_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outqueue`
--

DROP TABLE IF EXISTS `outqueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outqueue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `modem_id` int(11) DEFAULT NULL,
  `sourcemsisdn` varchar(20) DEFAULT NULL,
  `msisdn` varchar(20) DEFAULT NULL,
  `qtime` datetime DEFAULT NULL,
  `exectime` datetime DEFAULT NULL,
  `message` varchar(160) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`modem_id`,`msisdn`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outqueue`
--

LOCK TABLES `outqueue` WRITE;
/*!40000 ALTER TABLE `outqueue` DISABLE KEYS */;
/*!40000 ALTER TABLE `outqueue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengurut`
--

DROP TABLE IF EXISTS `pengurut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengurut` (
  `content` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengurut`
--

LOCK TABLES `pengurut` WRITE;
/*!40000 ALTER TABLE `pengurut` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengurut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `popup_message`
--

DROP TABLE IF EXISTS `popup_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `popup_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL,
  `message` text NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `from` varchar(30) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `popup_message`
--

LOCK TABLES `popup_message` WRITE;
/*!40000 ALTER TABLE `popup_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `popup_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos_delay`
--

DROP TABLE IF EXISTS `pos_delay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pos_delay` (
  `kode` varchar(30) DEFAULT NULL,
  `invoiceno` varchar(30) DEFAULT NULL,
  `session` text,
  `post` text,
  `nominal` double DEFAULT NULL,
  `updateby` varchar(20) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_delay`
--

LOCK TABLES `pos_delay` WRITE;
/*!40000 ALTER TABLE `pos_delay` DISABLE KEYS */;
INSERT INTO `pos_delay` VALUES ('20120824_141727','120824001','YToxOntzOjc6Imxlc3RhcmkiO2E6MTp7aTo5OTk7YTo2OntzOjk6Imludm9pY2VubyI7czo5OiIxMjA4MjQwMDEiO3M6MTA6Im1lbWJlcnR5cGUiO3M6MDoiIjtzOjg6ImlkbWVtYmVyIjtzOjA6IiI7czoxMDoia29kZV9ldmVudCI7TjtzOjEwOiJkaXNjX2V2ZW50IjtOO3M6MTA6Im5hbWVfZXZlbnQiO047fX19','YTowOnt9',0,'lestari','2012-08-24 14:17:27'),('20120825_181034','120825002','YToxOntzOjc6Imxlc3RhcmkiO2E6MTp7aTo5OTk7YTo5OntzOjk6Imludm9pY2VubyI7czo5OiIxMjA4MjUwMDIiO3M6MTA6Im1lbWJlcnR5cGUiO3M6MDoiIjtzOjg6ImlkbWVtYmVyIjtzOjA6IiI7czoxMDoia29kZV9ldmVudCI7TjtzOjEwOiJkaXNjX2V2ZW50IjtOO3M6MTA6Im5hbWVfZXZlbnQiO047czoxMToicHJvc2VzYmF5YXIiO3M6Mzoib2tlIjtzOjc6InJldHVybm8iO3M6MDoiIjtzOjE1OiJpbnZvaWNlbm9fcmV0dXIiO3M6MDoiIjt9fX0=','YTowOnt9',421000,'lestari','2012-08-25 18:10:34');
/*!40000 ALTER TABLE `pos_delay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_additional`
--

DROP TABLE IF EXISTS `trx_additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_additional` (
  `kode` varchar(20) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `room` varchar(3) NOT NULL,
  `withppn` smallint(6) NOT NULL DEFAULT '1',
  `withservice` smallint(6) NOT NULL DEFAULT '1',
  `subtotal1` double NOT NULL,
  `ppn` double NOT NULL,
  `subtotal2` double NOT NULL,
  `service` double NOT NULL,
  `nett` smallint(6) NOT NULL,
  `discname` varchar(100) NOT NULL,
  `disc` double NOT NULL,
  `grandtotal` double NOT NULL,
  `notes` varchar(255) NOT NULL,
  `kodebooking` varchar(25) NOT NULL,
  `paid` smallint(6) NOT NULL DEFAULT '0',
  `paymenttype` varchar(3) NOT NULL,
  `coabank` varchar(10) NOT NULL,
  `norek` varchar(50) NOT NULL,
  `createby` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_additional`
--

LOCK TABLES `trx_additional` WRITE;
/*!40000 ALTER TABLE `trx_additional` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_additional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_additional_detail`
--

DROP TABLE IF EXISTS `trx_additional_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_additional_detail` (
  `kode` varchar(20) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kode_add` varchar(5) NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_additional_detail`
--

LOCK TABLES `trx_additional_detail` WRITE;
/*!40000 ALTER TABLE `trx_additional_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_additional_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_backup`
--

DROP TABLE IF EXISTS `trx_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_backup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `updateby` varchar(20) NOT NULL,
  `updatedate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_backup`
--

LOCK TABLES `trx_backup` WRITE;
/*!40000 ALTER TABLE `trx_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_billing`
--

DROP TABLE IF EXISTS `trx_billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_billing` (
  `kode` varchar(20) NOT NULL,
  `grup` varchar(20) NOT NULL DEFAULT '0',
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `booking` varchar(20) NOT NULL,
  `room` varchar(3) NOT NULL,
  `withppn` smallint(6) NOT NULL DEFAULT '1',
  `withservice` smallint(6) NOT NULL DEFAULT '1',
  `nett` smallint(6) NOT NULL,
  `rate` double NOT NULL,
  `rate2` double NOT NULL,
  `chargeextraperson` double NOT NULL,
  `restaurant` double NOT NULL,
  `additional` double NOT NULL,
  `subtotal1` double NOT NULL,
  `ppn` double NOT NULL,
  `subtotal2` double NOT NULL,
  `service` double NOT NULL,
  `dp` double NOT NULL,
  `discname` varchar(100) NOT NULL,
  `disc` double NOT NULL,
  `grandtotal` double NOT NULL,
  `paymenttype` varchar(3) NOT NULL,
  `coabank` varchar(10) NOT NULL,
  `norek` varchar(50) NOT NULL,
  `paid` smallint(6) NOT NULL DEFAULT '0',
  `createby` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_billing`
--

LOCK TABLES `trx_billing` WRITE;
/*!40000 ALTER TABLE `trx_billing` DISABLE KEYS */;
INSERT INTO `trx_billing` VALUES ('BILL/20171206/002','0',2,'2017-12-06','BOOK/20171206/001','114',0,0,1,249000,375000,0,0,0,0,0,0,0,249000,'',0,-249000,'','','',0,'yandrie','2017-12-06 23:22:21','2017-12-06 16:22:21'),('BILL/20171206/003','0',3,'2017-12-06','','',0,0,1,0,0,0,0,0,0,0,0,0,0,'',0,0,'','','',0,'yandrie','2017-12-06 23:22:40','2017-12-06 16:22:40'),('BILL/20171206/004','0',4,'2017-12-06','BOOK/20171206/002','101',0,0,1,290500,375000,0,0,0,0,0,0,0,290500,'',0,-290500,'','','',0,'yandrie','2017-12-06 23:22:56','2017-12-06 16:22:56');
/*!40000 ALTER TABLE `trx_billing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_billing_additional_detail`
--

DROP TABLE IF EXISTS `trx_billing_additional_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_billing_additional_detail` (
  `kode` varchar(20) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kode_aditional` varchar(20) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_billing_additional_detail`
--

LOCK TABLES `trx_billing_additional_detail` WRITE;
/*!40000 ALTER TABLE `trx_billing_additional_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_billing_additional_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_billing_restaurant_detail`
--

DROP TABLE IF EXISTS `trx_billing_restaurant_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_billing_restaurant_detail` (
  `kode` varchar(20) NOT NULL,
  `seqno` int(11) NOT NULL,
  `kode_restaurant` varchar(20) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_billing_restaurant_detail`
--

LOCK TABLES `trx_billing_restaurant_detail` WRITE;
/*!40000 ALTER TABLE `trx_billing_restaurant_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_billing_restaurant_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_booking`
--

DROP TABLE IF EXISTS `trx_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(25) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `title` varchar(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `idtype` varchar(3) NOT NULL,
  `idno` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `grup` varchar(100) NOT NULL DEFAULT '0',
  `dp` double NOT NULL,
  `dptype` varchar(3) NOT NULL,
  `dpbank` varchar(10) NOT NULL,
  `dp2` double NOT NULL,
  `dptype2` varchar(3) NOT NULL,
  `dpbank2` varchar(10) NOT NULL,
  `dp3` double NOT NULL,
  `dptype3` varchar(3) NOT NULL,
  `dpbank3` varchar(10) NOT NULL,
  `dp4` double NOT NULL,
  `dptype4` varchar(3) NOT NULL,
  `dpbank4` varchar(10) NOT NULL,
  `dp5` double NOT NULL,
  `dptype5` varchar(3) NOT NULL,
  `dpbank5` varchar(10) NOT NULL,
  `room` varchar(3) NOT NULL,
  `roomtipe` varchar(6) NOT NULL,
  `jmlkamar` int(11) NOT NULL,
  `person` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `rate` double NOT NULL,
  `extraperson` int(11) NOT NULL,
  `chargeextraperson` double NOT NULL,
  `rate1` double NOT NULL,
  `rate2` double NOT NULL,
  `discname` varchar(100) NOT NULL,
  `disc` double NOT NULL,
  `notes` varchar(255) NOT NULL,
  `confirmasi` smallint(6) NOT NULL,
  `checkin` smallint(6) NOT NULL,
  `checkinby` varchar(20) NOT NULL,
  `checkindate` datetime NOT NULL,
  `createby` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `confirmby` varchar(20) NOT NULL,
  `confirmdate` datetime NOT NULL,
  `sessid` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `tanggal` (`tanggal`,`confirmasi`,`checkin`),
  KEY `room` (`room`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_booking`
--

LOCK TABLES `trx_booking` WRITE;
/*!40000 ALTER TABLE `trx_booking` DISABLE KEYS */;
INSERT INTO `trx_booking` VALUES (15,'BOOK/20171206/002',2,'2017-12-06','Mrs','Dyah','KTP','350919','Perum Muktisari Tegal Besar, Kaliwates','083853326490','','','','0',290500,'04','1.1.00',0,'','',0,'','',0,'','',0,'','','101','',0,2,'2017-12-06','2017-12-06',0,0,0,290500,375000,'',0,'Breakfast jam 6',1,1,'yandrie','2017-12-06 23:16:54','yandrie','2017-12-06 16:16:54','yandrie','2017-12-06 23:16:54','','2017-12-06 16:22:56'),(13,'BOOK/20171206/003',3,'2017-12-06','Mrs','Dyah','KTP','3509195305900002','Perum Muktisari Tegal Besar, Kaliwates','083853326490','','','','0',290500,'04','1.1.00',0,'','',0,'','',0,'','',0,'','','102','',0,2,'2017-12-06','2017-12-07',0,0,0,290500,375000,'',0,'Breakfast jam 6',1,1,'yandrie','2017-12-06 16:16:36','yandrie','2017-12-06 16:15:56','yandrie','2017-12-06 16:16:32','','2017-12-06 16:16:36'),(11,'BOOK/20171206/001',1,'2017-12-06','Mr','Hardy','KTP','3578141509840001','Darmo Indah Barat I/D -4 0001/004 Tandes','','','','','0',249000,'04','1.1.00',0,'','',0,'','',0,'','',0,'','','114','',0,2,'2017-12-06','2017-12-06',0,0,0,249000,375000,'',0,'Breakfast jam 6',1,1,'yandrie','2017-12-06 21:45:25','yandrie','2017-12-06 14:45:25','yandrie','2017-12-06 21:45:25','','2017-12-06 16:22:21'),(19,'BOOK/20171206/005',5,'2017-12-06','Mr','gede rahmadan','KTP','3058150303930003','jl. juweti rt.3 rw.6 kutorenon sukodono','0852573973933','','','','0',350000,'01','',0,'','',0,'','',0,'','',0,'','','103','',0,0,'2017-12-06','2017-12-07',0,0,0,350000,375000,'',0,'breakfast jam 7',1,1,'fadil','2017-12-06 23:24:35','fadil','2017-12-06 23:23:59','fadil','2017-12-06 23:24:21','','2017-12-06 23:24:35'),(18,'BOOK/20171206/004',4,'2017-12-06','Mrs','Erna','KTP','3201025502650010','cibubur country corn field south 36 cikeas udik','085238691981','','','','0',332500,'01','',0,'','',0,'','',0,'','',0,'','','115','',0,2,'2017-12-06','2017-12-07',0,0,0,332500,375000,'',0,'breakfast jam 6',0,0,'','0000-00-00 00:00:00','fadil','2017-12-06 18:47:03','','0000-00-00 00:00:00','','2017-12-06 18:47:03');
/*!40000 ALTER TABLE `trx_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_booking_makan`
--

DROP TABLE IF EXISTS `trx_booking_makan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_booking_makan` (
  `kode` varchar(20) NOT NULL,
  `breakfast` smallint(6) NOT NULL,
  `breakfastprice` double NOT NULL,
  `breakfastqty` int(11) NOT NULL,
  `lunch` smallint(6) NOT NULL,
  `lunchprice` double NOT NULL,
  `lunchqty` int(11) NOT NULL,
  `bbq` smallint(6) NOT NULL,
  `bbqprice` double NOT NULL,
  `bbqqty` int(11) NOT NULL,
  `dinner` smallint(6) NOT NULL,
  `dinnerprice` double NOT NULL,
  `dinnerqty` int(11) NOT NULL,
  `snack` smallint(6) NOT NULL,
  `snackprice` double NOT NULL,
  `snackqty` int(11) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_booking_makan`
--

LOCK TABLES `trx_booking_makan` WRITE;
/*!40000 ALTER TABLE `trx_booking_makan` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_booking_makan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_guest_session`
--

DROP TABLE IF EXISTS `trx_guest_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_guest_session` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sessid` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `content` text NOT NULL,
  `body` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sessid` (`sessid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_guest_session`
--

LOCK TABLES `trx_guest_session` WRITE;
/*!40000 ALTER TABLE `trx_guest_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_guest_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_mutasi_uang`
--

DROP TABLE IF EXISTS `trx_mutasi_uang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_mutasi_uang` (
  `kode` varchar(30) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `mode` varchar(10) NOT NULL,
  `coabank` varchar(10) NOT NULL,
  `cardno` varchar(50) NOT NULL,
  `modul` varchar(255) NOT NULL,
  `kode_trx` varchar(30) NOT NULL,
  `kodejurnal` varchar(30) NOT NULL,
  `coa` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `debit` double NOT NULL,
  `kredit` double NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `idseqno` (`idseqno`,`tanggal`,`mode`,`coabank`,`createby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_mutasi_uang`
--

LOCK TABLES `trx_mutasi_uang` WRITE;
/*!40000 ALTER TABLE `trx_mutasi_uang` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_mutasi_uang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos`
--

DROP TABLE IF EXISTS `trx_pos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos` (
  `kode` varchar(10) NOT NULL DEFAULT '',
  `idseqno` int(11) NOT NULL,
  `returno` varchar(10) DEFAULT NULL,
  `kodebooking` varchar(25) NOT NULL,
  `room` varchar(3) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `outlet` varchar(5) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kodetrx` varchar(10) DEFAULT NULL,
  `disc_member` double DEFAULT NULL,
  `disc_special` double DEFAULT NULL,
  `totaldisc` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `pembayaran` double DEFAULT NULL,
  `jenis_bayar` varchar(3) DEFAULT NULL,
  `cardno` varchar(50) DEFAULT NULL,
  `paid` smallint(6) NOT NULL,
  `updateby` varchar(20) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `returno` (`returno`,`outlet`,`tanggal`,`kodetrx`,`totaldisc`,`total_amount`,`pembayaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos`
--

LOCK TABLES `trx_pos` WRITE;
/*!40000 ALTER TABLE `trx_pos` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_detail`
--

DROP TABLE IF EXISTS `trx_pos_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_detail` (
  `kode` varchar(10) DEFAULT NULL,
  `seqno` int(11) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  KEY `kode` (`kode`,`seqno`,`barcode`,`qty`,`disc`,`harga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_detail`
--

LOCK TABLES `trx_pos_detail` WRITE;
/*!40000 ALTER TABLE `trx_pos_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_retur`
--

DROP TABLE IF EXISTS `trx_pos_retur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_retur` (
  `kode` varchar(10) NOT NULL DEFAULT '',
  `customer` varchar(10) DEFAULT NULL,
  `invoiceno` varchar(10) DEFAULT NULL,
  `outlet` varchar(5) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kodetrx` varchar(10) DEFAULT NULL,
  `totaldisc` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `updateby` varchar(20) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `invoiceno` (`invoiceno`,`outlet`,`tanggal`,`kodetrx`,`totaldisc`,`total_amount`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_retur`
--

LOCK TABLES `trx_pos_retur` WRITE;
/*!40000 ALTER TABLE `trx_pos_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_retur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_retur_detail`
--

DROP TABLE IF EXISTS `trx_pos_retur_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_retur_detail` (
  `kode` varchar(10) DEFAULT NULL,
  `seqno` int(11) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  KEY `kode` (`kode`,`seqno`,`barcode`,`qty`,`disc`,`harga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_retur_detail`
--

LOCK TABLES `trx_pos_retur_detail` WRITE;
/*!40000 ALTER TABLE `trx_pos_retur_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_retur_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_retur_temp`
--

DROP TABLE IF EXISTS `trx_pos_retur_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_retur_temp` (
  `kode` varchar(10) NOT NULL DEFAULT '',
  `customer` varchar(10) DEFAULT NULL,
  `invoiceno` varchar(10) DEFAULT NULL,
  `outlet` varchar(5) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kodetrx` varchar(10) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `updateby` varchar(20) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `invoiceno` (`invoiceno`,`outlet`,`tanggal`,`kodetrx`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_retur_temp`
--

LOCK TABLES `trx_pos_retur_temp` WRITE;
/*!40000 ALTER TABLE `trx_pos_retur_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_retur_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_retur_temp_detail`
--

DROP TABLE IF EXISTS `trx_pos_retur_temp_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_retur_temp_detail` (
  `kode` varchar(10) DEFAULT NULL,
  `seqno` int(11) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  KEY `kode` (`kode`,`seqno`,`barcode`,`qty`,`disc`,`harga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_retur_temp_detail`
--

LOCK TABLES `trx_pos_retur_temp_detail` WRITE;
/*!40000 ALTER TABLE `trx_pos_retur_temp_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_retur_temp_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_temp`
--

DROP TABLE IF EXISTS `trx_pos_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_temp` (
  `kode` varchar(10) NOT NULL DEFAULT '',
  `customer` varchar(10) DEFAULT NULL,
  `outlet` varchar(5) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kodetrx` varchar(10) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `updateby` varchar(20) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `outlet` (`outlet`,`tanggal`,`kodetrx`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_temp`
--

LOCK TABLES `trx_pos_temp` WRITE;
/*!40000 ALTER TABLE `trx_pos_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_pos_temp_detail`
--

DROP TABLE IF EXISTS `trx_pos_temp_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_pos_temp_detail` (
  `kode` varchar(10) DEFAULT NULL,
  `seqno` int(11) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  KEY `kode` (`kode`,`seqno`,`barcode`,`qty`,`disc`,`harga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_pos_temp_detail`
--

LOCK TABLES `trx_pos_temp_detail` WRITE;
/*!40000 ALTER TABLE `trx_pos_temp_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_pos_temp_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_restaurant_bill`
--

DROP TABLE IF EXISTS `trx_restaurant_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_restaurant_bill` (
  `kode` varchar(20) NOT NULL,
  `idseqno` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `room` varchar(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `withppn` smallint(6) NOT NULL DEFAULT '1',
  `withservice` smallint(6) NOT NULL DEFAULT '1',
  `subtotal1` double NOT NULL,
  `ppn` double NOT NULL,
  `subtotal2` double NOT NULL,
  `service` double NOT NULL,
  `nett` smallint(6) NOT NULL,
  `discname` varchar(100) NOT NULL,
  `disc` double NOT NULL,
  `grandtotal` double NOT NULL,
  `notes` varchar(255) NOT NULL,
  `kodebooking` varchar(25) NOT NULL,
  `paid` smallint(6) NOT NULL DEFAULT '0',
  `paymenttype` varchar(3) NOT NULL,
  `coabank` varchar(10) NOT NULL,
  `norek` varchar(50) NOT NULL,
  `isread` smallint(6) NOT NULL DEFAULT '0',
  `createby` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_restaurant_bill`
--

LOCK TABLES `trx_restaurant_bill` WRITE;
/*!40000 ALTER TABLE `trx_restaurant_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_restaurant_bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_restaurant_bill_detail`
--

DROP TABLE IF EXISTS `trx_restaurant_bill_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_restaurant_bill_detail` (
  `kode` varchar(20) NOT NULL,
  `seqno` int(11) NOT NULL,
  `foodid` varchar(5) NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`,`seqno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_restaurant_bill_detail`
--

LOCK TABLES `trx_restaurant_bill_detail` WRITE;
/*!40000 ALTER TABLE `trx_restaurant_bill_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_restaurant_bill_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_sync`
--

DROP TABLE IF EXISTS `trx_sync`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trx_sync` (
  `id` int(11) NOT NULL,
  `last_sync` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_sync`
--

LOCK TABLES `trx_sync` WRITE;
/*!40000 ALTER TABLE `trx_sync` DISABLE KEYS */;
INSERT INTO `trx_sync` VALUES (1,'2017-03-20 08:44:54','2017-03-20 01:49:54');
/*!40000 ALTER TABLE `trx_sync` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_account` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `hp1` varchar(20) NOT NULL,
  `hp2` varchar(20) NOT NULL,
  `gudang` varchar(10) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account`
--

LOCK TABLES `user_account` WRITE;
/*!40000 ALTER TABLE `user_account` DISABLE KEYS */;
INSERT INTO `user_account` VALUES ('superuser','intan','Superuser','0000001','085719521667','','G001','superuser.jpg','superuser.jpg','2012-05-21 04:21:55'),('yandrie','yandrie94','Irviyandrie Eka Putra','','081295991884','',NULL,'','','2017-12-06 08:25:11'),('fajar','300508','fajar nurdiansyah','','082233733307','',NULL,'','','2017-12-06 01:09:22'),('fadil','15101997','fadhil m rezza','','0895328809698','',NULL,'','','2017-12-06 00:48:58'),('ayudia','ayudiatia','Diah Ayu Sulistyawati','','082132316614','',NULL,'','','2017-12-05 09:37:23'),('amalia','626258','Nurul Amalia','','081285156266','',NULL,'','','2017-12-05 04:15:34');
/*!40000 ALTER TABLE `user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `username` varchar(30) NOT NULL,
  `id_group` int(11) NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES ('superuser',1,'0000-00-00 00:00:00'),('yandrie',6,'2017-12-06 08:25:11'),('fajar',8,'2017-12-06 01:09:22'),('fadil',6,'2017-12-06 00:48:58'),('ayudia',6,'2017-12-05 09:37:23'),('amalia',4,'2017-12-05 09:10:51');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-08 12:57:21
