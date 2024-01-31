attach 'users.db' as u;
attach 'posts.db' as p;
attach 'notifications.db' as n;
attach 'message.db' as m;


CREATE TABLE IF NOT EXISTS "users" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT,
	"password"	TEXT,
	"email"	TEXT,
	"birth_date"	TEXT,
	"friends"	TEXT,
	"subscriptions"	INT,
	"subscribers"	INT,
	"pp" BLOB,
	"type"	TEXT,
	"description"	TEXT,
	"public"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "posts" (
	"ID"	INTEGER NOT NULL,
	"user"	INTEGER,
	"title"	TEXT,
	"content"	TEXT,
	"image"	BLOB,
	"size"	INT,
	"type"	TEXT,
	"comment"	TEXT,
	"up_vote"	INT,
	"down_vote"	INT,
	"seen"	TEXT,
	"date"	TEXT,
	PRIMARY KEY("ID" AUTOINCREMENT),
	FOREIGN KEY("user") REFERENCES users("id")
);

CREATE TABLE IF NOT EXISTS "discussion" (
	"ID"	INTEGER NOT NULL,
	"name"	TEXT,
	"users_ID"	TEXT,
	"group"	TEXT,
	"admin"	INT,
	PRIMARY KEY("ID" AUTOINCREMENT)
);

CREATE TABLE IF NOT EXISTS "content" (
	"ID"	INTEGER NOT NULL,
	"discussion_ID"	INTEGER,
	"user_ID"	INTEGER,
	"type"	TEXT,
	"mess"	TEXT,
	"file"	,
	"size"	INT,
	"date"	TEXT,
	"seen"	TEXT,
	PRIMARY KEY("ID" AUTOINCREMENT),
	FOREIGN KEY("discussion_ID") REFERENCES discussion("ID"),
	FOREIGN KEY("user_ID") REFERENCES users("id")
);
CREATE TABLE IF NOT EXISTS "notifications" (
	"ID"	INTEGER NOT NULL,
	"user_ID"	INTEGER,
	"type"	TEXT,
	"user_concerning"	TEXT,
	PRIMARY KEY("ID" AUTOINCREMENT),
	FOREIGN KEY("user_ID") REFERENCES users("id")
);


insert into users select * from u.users;
insert into posts select * from p.posts;
insert into notifications select * from n.notifications;
insert into content select * from m.content;
insert into discussion select * from m.discussion;
