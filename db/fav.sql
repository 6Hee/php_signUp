create table fav(
    num int not null auto_increment,
    id char(20) not null,
    pd_num char(20) not null,
    fav char(1),
    primary key(num)
) charset=utf8;