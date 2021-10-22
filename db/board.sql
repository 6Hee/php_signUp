create table board (
   num int not null auto_increment,
   id char(15) not null,
   name char(10) not null,
   subject char(200) not null,
   content mediumtext not null,        
   regist_day char(20) not null,
   hit int not null,
   file_name char(100),
   file_type char(40),
   file_copied char(100),
   notice char(1),
   primary key(num)
) charset=utf8;