attach 'users.db' as u;
attach 'posts.db' as p;
attach 'notifications.db' as n;
attach 'message.db' as m;

create table users as select * from u.users;
create table posts as select * from p.posts;
create table notifications as select * from n.notifications;
create table content as select * from m.content;
create table discussion as select * from m.discussion;
