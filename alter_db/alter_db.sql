UPDATE menu SET caption = 'Reservations' WHERE id_menu = 78;
UPDATE menu SET caption = 'Miscellaneous' WHERE id_menu = 79;
UPDATE menu SET caption = 'Miscellaneous' WHERE id_menu = 76;
UPDATE menu SET status = '0' WHERE id_menu IN (80,115,116,133,138);
UPDATE menu SET seqno = '2' WHERE id_menu = 79;
UPDATE menu SET seqno = '3' WHERE id_menu = 81;
UPDATE menu SET seqno = '8' WHERE id_menu = 117;
INSERT INTO menu (id_menu,seqno,id_parent,caption,url,status,menubox) VALUES 
(141,4,77,'Guest in House','rpt_guestinhouse.php','1','0'),
(142,5,77,'Expected Departure','rpt_expected_departure.php','1','0'),
(143,6,77,'Today Expected Arrival List','rpt_expected_arrival.php','1','0'),
(144,7,77,'Room Available','rpt_room_available.php','1','0');
ALTER TABLE `trx_booking` ADD `refno` VARCHAR(20) NOT NULL AFTER `dpbank`, ADD INDEX (`refno`);
ALTER TABLE `trx_booking` ADD `refno2` VARCHAR(20) NOT NULL AFTER `dpbank2`, ADD INDEX (`refno2`);
ALTER TABLE `trx_booking` ADD `refno3` VARCHAR(20) NOT NULL AFTER `dpbank3`, ADD INDEX (`refno3`);
ALTER TABLE `trx_booking` ADD `refno4` VARCHAR(20) NOT NULL AFTER `dpbank4`, ADD INDEX (`refno4`);
ALTER TABLE `trx_booking` ADD `refno5` VARCHAR(20) NOT NULL AFTER `dpbank5`, ADD INDEX (`refno5`);
ALTER TABLE `trx_additional` ADD `refno` VARCHAR(20) NOT NULL AFTER `norek`, ADD INDEX (`refno`);
ALTER TABLE `trx_booking` ADD `dpdate` date NOT NULL AFTER `dpbank`;
ALTER TABLE `trx_booking` ADD `dpdate2` date NOT NULL AFTER `dpbank2`;
ALTER TABLE `trx_booking` ADD `dpdate3` date NOT NULL AFTER `dpbank3`;
ALTER TABLE `trx_booking` ADD `dpdate4` date NOT NULL AFTER `dpbank4`;
ALTER TABLE `trx_booking` ADD `dpdate5` date NOT NULL AFTER `dpbank5`;

CREATE TABLE `trx_billing_details` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `description` text NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `trx_billing_details` ADD PRIMARY KEY (`id`), ADD KEY `kode` (`kode`), ADD KEY `tanggal` (`tanggal`);
ALTER TABLE `trx_billing_details` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
ALTER TABLE `mst_room` ADD `status` SMALLINT NOT NULL DEFAULT '1' AFTER `connecting2`, ADD INDEX (`status`);