DROP TABLE IF EXISTS irtbl_user_user_tag;
DROP TABLE IF EXISTS irtbl_user_marker_tag;
DROP TABLE IF EXISTS irtbl_user_feature_tag;
DROP TABLE IF EXISTS irtbl_marker_marker_tag;
DROP TABLE IF EXISTS irtbl_marker_feature_tag;
DROP TABLE IF EXISTS irtbl_feature_feature_tag;
DROP TABLE IF EXISTS irtbl_tag;
DROP TABLE IF EXISTS irtbl_marker;
DROP TABLE IF EXISTS irtbl_feature;
DROP TABLE IF EXISTS irtbl_user;

CREATE TABLE irtbl_tag 
( 
id VARCHAR(128) NOT NULL PRIMARY KEY , 
description Varchar(2000), 
data_type VARCHAR(128),
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_marker
( 
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
description TEXT, 
name VARCHAR(60),
address VARCHAR(512) NOT NULL ,
lat FLOAT( 10, 6 ) NOT NULL ,
lng FLOAT( 10, 6 ) NOT NULL ,
data_type VARCHAR(128),
price DOUBLE,
age INTEGER,
is_available BOOL,
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
image_link1 TEXT NULL,
image_link2 TEXT NULL,
image_link3 TEXT NULL,
image_link4 TEXT NULL,
video_link TEXT NULL,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_feature
( 
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
description TEXT, 
name VARCHAR(128),
data_type VARCHAR(128),
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_user 
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
email Varchar(256) NOT NULL, 
username Varchar(256), 
password Varchar(256),
firstname Varchar(128),
lastname Varchar(128),
phone Varchar(16),
mobile Varchar(16),
description Varchar(2000),
addressline1 Varchar(128),
addressline2 Varchar(128),
addressline3 Varchar(128),
addressline4 Varchar(128),
url Varchar(128),
last_login_time Datetime, 
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_user_marker_tag
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
tag_id VARCHAR(128),
user_id INTEGER,
marker_id INTEGER,
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_user_user_tag 
( 
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
tag_id varchar(128), 
user1_id INTEGER,
user2_id INTEGER,
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_user_feature_tag 
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id INTEGER, 
feature_id INTEGER, 
tag_id Varchar(128),
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_marker_feature_tag 
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
marker_id INTEGER, 
feature_id INTEGER, 
tag_id Varchar(128),
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_marker_marker_tag 
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
marker1_id INTEGER, 
marker2_id INTEGER, 
tag_id Varchar(128),
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

CREATE TABLE irtbl_feature_feature_tag 
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
feature1_id INTEGER, 
feature2_id INTEGER, 
tag_id Varchar(128),
create_time DATETIME, 
create_user_id INTEGER, 
update_time DATETIME, 
update_user_id INTEGER,
UUID VARCHAR(255)
) ENGINE = InnoDB ;

ALTER TABLE irtbl_marker
ADD CONSTRAINT IRFK_marker_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker
ADD CONSTRAINT IRFK_marker_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_tag
ADD CONSTRAINT IRFK_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_tag
ADD CONSTRAINT IRFK_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature
ADD CONSTRAINT IRFK_feature_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature
ADD CONSTRAINT IRFK_feature_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_user_tag
ADD CONSTRAINT IRFK_user_user_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_user_tag
ADD CONSTRAINT IRFK_user_user_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_marker_tag
ADD CONSTRAINT IRFK_user_marker_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_marker_tag
ADD CONSTRAINT IRFK_user_marker_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_feature_tag
ADD CONSTRAINT IRFK_user_feature_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_feature_tag
ADD CONSTRAINT IRFK_user_feature_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_marker_tag
ADD CONSTRAINT IRFK_marker_marker_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_marker_tag
ADD CONSTRAINT IRFK_marker_marker_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_feature_tag
ADD CONSTRAINT IRFK_marker_feature_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_feature_tag
ADD CONSTRAINT IRFK_marker_feature_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature_feature_tag
ADD CONSTRAINT IRFK_feature_feature_tag_update_user FOREIGN KEY (update_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature_feature_tag
ADD CONSTRAINT IRFK_feature_feature_tag_create_user FOREIGN KEY (create_user_id)
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_user_tag 
ADD CONSTRAINT IRFK_user_user_tag_user1_id FOREIGN KEY (user1_id) 
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_user_tag 
ADD CONSTRAINT IRFK_user_user_tag_user2_id FOREIGN KEY (user2_id) 
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_user_tag 
ADD CONSTRAINT IRFK_user_user_tag_tag_id FOREIGN KEY (tag_id) 
REFERENCES irtbl_tag (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_marker_tag 
ADD CONSTRAINT IRFK_user_marker_tag_user_id FOREIGN KEY (user_id) 
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_marker_tag 
ADD CONSTRAINT IRFK_user_marker_tag_marker_id FOREIGN KEY (marker_id) 
REFERENCES irtbl_marker (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_marker_tag 
ADD CONSTRAINT IRFK_user_marker_tag_tag_id FOREIGN KEY (tag_id) 
REFERENCES irtbl_tag (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_feature_tag 
ADD CONSTRAINT IRFK_user_feature_tag_user_id FOREIGN KEY (user_id) 
REFERENCES irtbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_feature_tag 
ADD CONSTRAINT IRFK_user_feature_tag_feature_id FOREIGN KEY (feature_id) 
REFERENCES irtbl_feature (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_user_feature_tag 
ADD CONSTRAINT IRFK_user_feature_tag_tag_id FOREIGN KEY (tag_id) 
REFERENCES irtbl_tag (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_marker_tag 
ADD CONSTRAINT IRFK_marker_marker_tag_tag_id FOREIGN KEY (tag_id) 
REFERENCES irtbl_tag (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_marker_tag 
ADD CONSTRAINT IRFK_marker_marker_tag_marker1_id FOREIGN KEY (marker1_id) 
REFERENCES irtbl_marker (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_marker_tag 
ADD CONSTRAINT IRFK_marker_marker_tag_marker2_id FOREIGN KEY (marker2_id) 
REFERENCES irtbl_marker (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_feature_tag 
ADD CONSTRAINT IRFK_marker_feature_tag_marker_id FOREIGN KEY (marker_id) 
REFERENCES irtbl_marker (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_feature_tag 
ADD CONSTRAINT IRFK_marker_feature_tag_feature_id FOREIGN KEY (feature_id) 
REFERENCES irtbl_feature (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_marker_feature_tag 
ADD CONSTRAINT IRFK_marker_feature_tag_tag_id FOREIGN KEY (tag_id) 
REFERENCES irtbl_tag (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature_feature_tag 
ADD CONSTRAINT IRFK_feature_feature_tag_feature2_id FOREIGN KEY (feature2_id) 
REFERENCES irtbl_feature (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature_feature_tag 
ADD CONSTRAINT IRFK_feature_feature_tag_feature1_id FOREIGN KEY (feature1_id) 
REFERENCES irtbl_feature (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE irtbl_feature_feature_tag 
ADD CONSTRAINT IRFK_feature_feature_tag_tag_id FOREIGN KEY (tag_id) 
REFERENCES irtbl_tag (id) ON DELETE CASCADE ON UPDATE RESTRICT;

-- RBAC Manager 
--
-- Tabellenstruktur f¨¹r Tabelle `authassignment`
--
DROP TABLE IF EXISTS AuthAssignment;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten f¨¹r Tabelle `authassignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('SuperAdmin', '1', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur f¨¹r Tabelle `authitem`
--
DROP TABLE IF EXISTS AuthItem;
CREATE TABLE AuthItem (
  `name` varchar(64) NOT NULL,
  `data_type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten f¨¹r Tabelle `authitem`
--

INSERT INTO `AuthItem` (`name`, `data_type`, `description`, `bizrule`, `data`) VALUES
('SuperAdmin', 2, '', '', ''),
('RbacAssignmentEditor', 1, '', '', ''),
('RbacViewer', 0, '', '', ''),
('RbacEditor', 1, '', '', ''),
('RbacAssignmentViewer', 0, '', '', ''),
('RbacAdmin', 2, '', '', ''),
('registered', 2, 'Default role by Yii-conf', 'return !Yii::app()->user->isGuest;', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur f¨¹r Tabelle `authitemchild`
--

DROP TABLE IF EXISTS AuthItemChild;

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten f¨¹r Tabelle `authitemchild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('RbacAdmin', 'RbacAssignmentEditor'),
('RbacAdmin', 'RbacEditor'),
('RbacAssignmentEditor', 'RbacAssignmentViewer'),
('RbacEditor', 'RbacViewer'),
('SuperAdmin', 'RbacAdmin');


-- INSERT INTO irtbl_tag_user_role

drop table if exists irtbl_tag_user_role;
create table irtbl_tag_user_role 
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
event_id INTEGER NOT NULL, 
user_id INTEGER NOT NULL, 
role VARCHAR(64) NOT NULL
);

drop table if exists irtbl_tag_alert;
create table irtbl_tag_alert
(
	alert_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	subject Varchar(256) NOT NULL, 
	message Varchar(2000) NOT NULL,
	event_id INTEGER,
	create_time DATETIME, 
	create_user_id INTEGER, 
	update_time DATETIME, 
	update_user_id INTEGER
);


-- Insert some seed data so we can just begin using the database 
INSERT INTO irtbl_user
(email, username, password, create_time, update_time, create_user_id, update_user_id, UUID, firstname, lastname, phone, mobile)
VALUES
("xianshunz@gmail.com","admin", MD5("admin"), NOW(), 1, NOW(), 1, UUID(), 'Chen', 'Xianshun', '999', '1777'),
("czcodezone@gmail.com","owner", MD5("owner"), NOW(), 1, NOW(), 1, UUID(), 'Chen', 'Xianshun', '999', '1777'),
("chen0040@ntu.edu.sg","member", MD5("member"), NOW(), 1, NOW(), 1, UUID(), 'Chen', 'Xianshun', '999', '1777'),
("chen0469@ntu.edu.sg", "reader", MD5("reader"), NOW(), 1, NOW(), 1, UUID(), 'Chen', 'Xianshun', '999', '1777')
;

INSERT INTO irtbl_tag
(id, description, data_type, create_time, create_user_id, update_time, update_user_id, UUID)
VALUES
("lease", "user lease marker", "string", NOW(), 1, NOW(), 1, UUID());

