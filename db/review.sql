create table review(
    num int not null auto_increment,
    id char(20) not null,
    name char(20) not null,
    pd_num int not null,
    score int not null,
    content mediumtext not null,
    regist_day char(20),
    primary key(num)
) charset=utf8