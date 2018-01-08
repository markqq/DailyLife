# Introduction

Wanna have a private zone to record some special moment, some unforgettable memory?

Wanna have a quite place to speak-out-loud but not to afraid of the mass followers of your social media?

Wanna have a section in your website to share your feeling of your daily life but don't want to start a formal post?

Introducing <b>DailyLife</b>, a slight php-based platform that record the moment of your daily life.

just a few step, you can have your own DailyLife page.

You can edit your status like this:

![](https://ws2.sinaimg.cn/large/006tNc79ly1fn9q4nqfr7j31bs0na75p.jpg)

or you can edit your status in a rich-text form:

![](https://ws4.sinaimg.cn/large/006tNc79ly1fn9q5z3xpaj31e018k7wh.jpg)

Everytime you update your status, your timeline changes too:

![](https://ws4.sinaimg.cn/large/006tNc79gy1fn9q7kvwgqj31c019qh3l.jpg)

![](https://ws3.sinaimg.cn/large/006tNc79gy1fn9q7lgl5uj31fy19q17z.jpg)

Also, you can share your status to social or delete your status as long as you want to.

[See More of DailyLife](https://blog.tan90.co/DailyLife)

# Demo

See the DailyLife page of me:
[DailyLife](https://dailylife.tan90.co)

# Installation

1. Download the projects
```
git clone https://github.com/markqq/DailyLife.git
```

2. Modify `conn.php` to your own mysql server and datebase.

3. Create a new table `dailylife` in your database use `sql.sql`
```
mysql
use database;
```
```mysql
create table dailylife
(
   statusDate         varchar(50) not null,
   statusContent      text,
   hashTag            varchar(50) not null,
   id                 INT(11) not null AUTO_INCREMENT,
   primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

4. Encrypt folder `admin`

5. Done!
