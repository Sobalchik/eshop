ALTER TABLE `up_product` ADD `DEGREES` DOUBLE NOT NULL AFTER `RATING`;
UPDATE `up_product` SET `DEGREES`=24 WHERE ID=1;
UPDATE `up_product` SET `DEGREES`=10 WHERE ID=2;
UPDATE `up_product` SET `DEGREES`=22 WHERE ID=3;
UPDATE `up_product` SET `DEGREES`=18 WHERE ID=4;
UPDATE `up_product` SET `DEGREES`=24 WHERE ID=5;
UPDATE `up_product` SET `DEGREES`=24 WHERE ID=6;
UPDATE `up_product` SET `DEGREES`=30 WHERE ID=7;