drop schema if exists literatura;
create schema literatura default character set utf8 collate utf8_polish_ci;
grant all on literatura.* to editor@localhost identified by 'secretPASSWORD';
flush privileges;