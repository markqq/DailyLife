create table dailylife
(
   statusDate               varchar(50) not null,
   statusContent            varchar(900) not null,
   hashTag            varchar(50) not null,
   id                  INT(11) not null AUTO_INCREMENT,
   primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;