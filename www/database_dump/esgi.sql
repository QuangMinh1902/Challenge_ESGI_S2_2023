-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg120+1) dump

DROP TABLE IF EXISTS "esgi_Category";
DROP SEQUENCE IF EXISTS "esgi_Category_id_seq1";
CREATE SEQUENCE "esgi_Category_id_seq1" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_Category" (
    "id" integer DEFAULT nextval('"esgi_Category_id_seq1"') NOT NULL,
    "title" character(255),
    "slug" character(255),
    "status" boolean DEFAULT true,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "sort" smallint DEFAULT '1' NOT NULL,
    "userid" smallint,
    CONSTRAINT "esgi_Category_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_Comment";
DROP SEQUENCE IF EXISTS "esgi_Comment_id_seq";
CREATE SEQUENCE "esgi_Comment_id_seq" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_Comment" (
    "id" integer DEFAULT nextval('"esgi_Comment_id_seq"') NOT NULL,
    "title" character(255),
    "content" character(500),
    "status" boolean DEFAULT false NOT NULL,
    "userid" smallint,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "postid" smallint,
    "reply" character(500),
    CONSTRAINT "esgi_comment_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_Menu";
DROP SEQUENCE IF EXISTS "esgi_Menu_id_seq1";
CREATE SEQUENCE "esgi_Menu_id_seq1" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_Menu" (
    "id" integer DEFAULT nextval('"esgi_Menu_id_seq1"') NOT NULL,
    "title" character(255),
    "link" character(255),
    "status" boolean DEFAULT true NOT NULL,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "sort" smallint DEFAULT '1' NOT NULL,
    "userid" smallint,
    CONSTRAINT "esgi_Menu_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_Post";
DROP SEQUENCE IF EXISTS "esgi_Post_id_seq1";
CREATE SEQUENCE "esgi_Post_id_seq1" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_Post" (
    "id" integer DEFAULT nextval('"esgi_Post_id_seq1"') NOT NULL,
    "title" character(255),
    "slug" character(255),
    "categoryid" smallint,
    "status" boolean DEFAULT true,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "sort" smallint DEFAULT '0' NOT NULL,
    "userid" smallint,
    "description" character(500),
    "content" character(3000),
    "canonical" character(255),
    "metatitle" character(255),
    "metadescription" character(300),
    CONSTRAINT "esgi_Post_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_Token";
DROP SEQUENCE IF EXISTS "esgi_Token_id_seq1";
CREATE SEQUENCE "esgi_Token_id_seq1" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_Token" (
    "id" integer DEFAULT nextval('"esgi_Token_id_seq1"') NOT NULL,
    "token" character(50),
    "expirationtime" integer,
    "status" boolean,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "userid" smallint,
    CONSTRAINT "esgi_Token_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_User";
DROP SEQUENCE IF EXISTS untitled_table_209_id_seq;
CREATE SEQUENCE untitled_table_209_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_User" (
    "id" integer DEFAULT nextval('untitled_table_209_id_seq') NOT NULL,
    "firstname" character(255),
    "lastname" character(255),
    "email" character(255),
    "password" character(255),
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "status" boolean DEFAULT false,
    "sort" smallint DEFAULT '1' NOT NULL,
    "role" character(10),
    CONSTRAINT "untitled_table_209_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


ALTER TABLE ONLY "public"."esgi_Category" ADD CONSTRAINT "esgi_Category_userid_fkey" FOREIGN KEY (userid) REFERENCES "esgi_User"(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_Comment" ADD CONSTRAINT "esgi_Comment_postid_fkey" FOREIGN KEY (postid) REFERENCES "esgi_Post"(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_Comment" ADD CONSTRAINT "esgi_Comment_userid_fkey" FOREIGN KEY (userid) REFERENCES "esgi_User"(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_Menu" ADD CONSTRAINT "esgi_Menu_userid_fkey" FOREIGN KEY (userid) REFERENCES "esgi_User"(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_Post" ADD CONSTRAINT "esgi_Post_parents_fkey" FOREIGN KEY (categoryid) REFERENCES "esgi_Category"(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_Post" ADD CONSTRAINT "esgi_Post_userid_fkey" FOREIGN KEY (userid) REFERENCES "esgi_User"(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_Token" ADD CONSTRAINT "esgi_Token_userid_fkey" FOREIGN KEY (userid) REFERENCES "esgi_User"(id) NOT DEFERRABLE;

-- 2023-07-21 19:57:03.792189+00
