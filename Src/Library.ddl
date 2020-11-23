-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Fri Sep 11 11:17:51 2020 
-- * Schema: MLD/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Book;
use Book;


-- Tables Section
-- _____________ 

create table t_author (
     idAuthor int not null auto_increment,
     autName varchar(50) not null,
     autSurname varchar(50) not null,
     constraint ID_t_author_ID primary key (idAuthor));

create table t_book (
     idBook int not null auto_increment,
     booTitle varchar(200) not null,
     booNbrPages int not null,
     booExcerptLink varchar(50) not null,
     booSummary varchar(200) not null,
     booYearEdited int not null,
     booAverageNotes float(1) not null,
     booCoverLink varchar(50) not null,
     idAuthor int not null,
     idUser int not null,
     idEditor int not null,
     idCategory int not null,
     constraint ID_t_book_ID primary key (idBook));

create table t_category (
     idCategory int not null auto_increment,
     catName varchar(50) not null,
     constraint ID_t_category_ID primary key (idCategory));

create table t_editor (
     idEditor int not null auto_increment,
     ediName varchar(50) not null,
     constraint ID_t_editor_ID primary key (idEditor));

create table t_user (
     idUser int not null auto_increment,
     usePseudo varchar(50) not null,
     usePassword varchar(200) not null,
     constraint ID_t_user_ID primary key (idUser));


-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table t_author add constraint ID_t_author_CHK
--     check(exists(select * from t_book
--                  where t_book.idAuthor = idAuthor)); 

alter table t_book add constraint FKt_write_FK
     foreign key (idAuthor)
     references t_author (idAuthor);

alter table t_book add constraint FKt_post_FK
     foreign key (idUser)
     references t_user (idUser);

alter table t_book add constraint FKt_edit_FK
     foreign key (idEditor)
     references t_editor (idEditor);

alter table t_book add constraint FKt_belong_FK
     foreign key (idCategory)
     references t_category (idCategory);

-- Not implemented
-- alter table t_editor add constraint ID_t_editor_CHK
--     check(exists(select * from t_book
--                  where t_book.idEditor = idEditor)); 


-- Index Section
-- _____________ 

create unique index ID_t_author_IND
     on t_author (idAuthor);

create unique index ID_t_book_IND
     on t_book (idBook);

create index FKt_write_IND
     on t_book (idAuthor);

create index FKt_post_IND
     on t_book (idUser);

create index FKt_edit_IND
     on t_book (idEditor);

create index FKt_belong_IND
     on t_book (idCategory);

create unique index ID_t_category_IND
     on t_category (idCategory);

create unique index ID_t_editor_IND
     on t_editor (idEditor);

create unique index ID_t_user_IND
     on t_user (idUser);

