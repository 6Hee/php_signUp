create table products (
    num int not null auto_increment,
    id char(20) not null,
    name char(20) not null,
    title char(100) not null,
    sub char(150) not null,
    content mediumtext not null,
    price int not null,
    fav int not null,
    hit int not null,
    regist_day char(20) not null,
    file_name char(100),
    file_type char(20),
    file_copied char(50),
    primary key(num)
) charset=utf8;