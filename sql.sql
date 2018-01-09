create table dailylife
(
   statusDate         varchar(50) not null,
   statusContent      text,
   hashTag            varchar(50) not null,
   id                 INT(11) not null AUTO_INCREMENT,
   likeNum            INT(11),
   primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;