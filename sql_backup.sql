BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "tasks" (
	"id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"task"	TEXT NOT NULL,
	"status"	INTEGER NOT NULL,
	"user_uid"	INTEGER
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	INTEGER NOT NULL UNIQUE,
	"username"	TEXT NOT NULL UNIQUE,
	"password"	TEXT NOT NULL,
	"role_id"	INTEGER NOT NULL DEFAULT 2,
	"uuid"	INTEGER NOT NULL UNIQUE,
	"created_at"	TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "roles" (
	"id"	INTEGER NOT NULL,
	"roleName"	INTEGER NOT NULL,
	PRIMARY KEY("id")
);
INSERT INTO "tasks" VALUES (1,'Techdegree Project 1b',1,NULL);
INSERT INTO "tasks" VALUES (2,'Techdegree Project 2',1,NULL);
INSERT INTO "tasks" VALUES (3,'Techdegree Project 3',1,NULL);
INSERT INTO "tasks" VALUES (4,'Techdegree Project 4',1,NULL);
INSERT INTO "tasks" VALUES (5,'Techdegree Project 5',1,NULL);
INSERT INTO "tasks" VALUES (6,'Techdegree Project 6',1,NULL);
INSERT INTO "tasks" VALUES (7,'Techdegree Project 7',0,NULL);
INSERT INTO "tasks" VALUES (8,'Techdegree Project 8',0,NULL);
INSERT INTO "tasks" VALUES (9,'Techdegree Project 9',0,NULL);
INSERT INTO "tasks" VALUES (10,'Techdegree Project 10',0,NULL);
INSERT INTO "roles" VALUES (1,'admin
');
INSERT INTO "roles" VALUES (2,'normal');
COMMIT;
