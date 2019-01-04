create database commentsDB;
use commentsDB;
create table comments(
id int not null primary key auto_increment,
ip varchar(255) not null,
author varchar(50),
comment text not null,
time text not null);
