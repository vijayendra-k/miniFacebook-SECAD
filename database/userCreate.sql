-- drop database
Drop database secad_s23_team14;
-- create database
CREATE database secad_s23_team14;
-- drop users
DROP USER 'secadpass'@'localhost';
DROP USER 'postAccess'@'localhost';
DROP USER 'commentAccess'@'localhost';
-- create user
CREATE USER 'secadpass'@'localhost' identified by 'admin';
CREATE USER 'postAccess'@'localhost' identified by 'admin';
CREATE USER 'commentAccess'@'localhost' identified by 'admin';
-- grant all access
GRANT ALL ON secad_s23_team14.users to 'secadpass'@'localhost';
GRANT ALL ON secad_s23_team14.posts to 'postAccess'@'localhost';
GRANT ALL ON secad_s23_team14.users to 'postAccess'@'localhost';
GRANT ALL ON secad_s23_team14.comments to 'commentAccess'@'localhost';


-- use database
use secad_s23_team14;

-- add tables and data
source database.sql;