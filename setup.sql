set echo on
connect system/378iew4OyEAUi6oR
-- CREATE PHP APPLICATION USER
drop user bondoc_business cascade;
create user bondoc_business identified by qwerty;
grant connect, resource to bondoc_business;
alter user bondoc_business default tablespace users
  temporary tablespace temp account unlock;
-- CREATE USER OWNER SECURITY INFORMATION ABOUT THE APPLICATION
drop user bondoc_business_admin cascade;
create user bondoc_business_admin identified by qwerty;
alter user bondoc_business_admin default tablespace system
  temporary tablespace temp account unlock;
grant create procedure, create session, create table,
  resource, select any dictionary to bondoc_business_admin;

connect bondoc_business/qwerty

--TABLE FOR THE APPLICATION
create table tenants
  (t_id number(10) not null,
  firstname varchar2(20),
  middlename varchar2(20),
  lastname varchar2(20),
  mobile_number number(20,1),
  monthly_fee number(20,2),
  unit varchar2(20),
  date_started date,
  due_date date);
  
  alter table tenants add (
    constraint t_id_pk primary key (t_id));
    
create sequence t_id_sequence start with 1;

create or replace trigger t_id_bir
before insert on tenants
for each row

begin
    select t_id_sequence.nextval
    into :new.t_id
    from dual;
end;
/

create table building
  (b_id number(10) not null,
  unit varchar2(20),
  description varchar2(4000),
  status varchar2(20),
  monthly_fee number(20,2));

  alter table building add (
    constraint b_id_pk primary key (b_id));
    
create sequence b_id_sequence start with 1;

create or replace trigger b_id_bir
before insert on building
for each row

begin
    select b_id_sequence.nextval
    into :new.b_id
    from dual;
end;
/

create table rental
  (r_id number(10) not null,
  unit varchar2(20),
  monthly_fee number(20,2),
  date_started date,
  due_date date);

commit;
  connect bondoc_business_admin/qwerty;

  --AUTHENTICATION TABLE WITH THE WEB USER USERNAME & PASSWORDS
  --A REAL APPLCATION WOULD NEVER STORE PLAIN-TEXT PASSWORDS
  --BUT THIS CODE IS A DEMO FOR CLIENT IDENTIFIRES AND NOT ABOUT
  --AUTHENTICATION

create table authentication
  (username varchar2(20) primary key,
  password varchar2(20) not null);

insert into authentication values('admin','root');
commit;

grant select on authentication to bondoc_business;
