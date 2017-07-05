CREATE DATABASE guestbook;
CREATE TABLE guest (
  id_msg int(8) NOT NULL auto_increment,
  name tinytext NOT NULL,
  email tinytext NOT NULL,
  msg mediumtext NOT NULL,
  answer mediumtext NOT NULL,
  puttime datetime NOT NULL default '0000-00-00 00:00:00',
  hide enum('show','hide') NOT NULL default 'show',
  PRIMARY KEY  (id_msg)
) TYPE=MyISAM;

