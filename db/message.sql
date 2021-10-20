create table message (
   num int not null auto_increment,
   send_id char(20) not null,
   rv_id char(20) not null,
   subject char(200) not null,
   content mediumtext not null, 
   regist_day char(20),
   primary key(num)
) charset=utf8;