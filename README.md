SEETNAU---PHP
=============

Very old seetnau prototype (not finished), which was written on PHP without normal OOP but with some cool solutions like fully dynamic pages. Seetnau - prototype of the old-forgotten startup idea. But it can be used as (almost) fully functional social network.
It's pretty easy to install - you only have to create database, open mysql.php (in your browser), check 'Create new tables?' check box and press "Submit" button. After this you only need to uncomment "extension=php_openssl.dll" line in php.ini and mail_send function in functions/send_mail.php. By default it's set to noones gmail account, but you can set it to use yours. After this you just need to write proper domain in config/params.php, so activation messages will work properly. After this you should delete mysql.php. If you'll ever need to edit your mysql config values, it's easy to do by hand (config/mysql_config.php)

I used php mailer to send activation mail, so you don't need to install email servers.

It was written a long time ago and I didn't understood much about MVC concepts etc, so I tried to create my own MVC-style code. Almost everything in seetnau is dynamic and uses AJAX (e.g. when you create new user, page itself doesn't reload but only sends ajax request to proper function). It's cool that all messages will display in real time and the pages are very dynamic.

The only thing that doesn't work is user search. While page itself exists, it doesn't do anything. But it isn't hard to fix - you need to edit js file a little bit and write proper function. SO to get to any other user profile you need to have user's username. 

Even though tags, jobs, fans-and-idols system are all fully working, they're purely cosmetical as for now. But database architecture allows to easily make them fully working.

Message system is pretty cool. Message have two fields that allows it to be deleted an awesome way. They're called Visible and Status. Here's the list:
Visible:
b = both;
s = sender;
r = reciever;
n = none (if message is deleted);

Status:
n = not read;
r = read;

If message is deleted while status is n => it's Visible will be set to n. Also, n will be set if both users will delete this message on their sides. So the messages won't be deleted from database (facebook way, huh), but they will appear deleted. Not read message will be highlighted in purple color and their number will be shown in header.

Some pages need to be heavy refactored (like friends.php and main.php), but 90% are pretty much okay and have view separated from the logic.

Seetnau is using jquery and jquery ui with custom css. In case you want to change color scheme you can just edit css styles (they're situated in the css folder) or just change path to them in config/incl_everywhere.html file.

All messages are written in config/msgs_list.php, so it's easy to edit them. It makes seetnau translation much easier.

All users can post youtube video to their profile, so it can be viewed by others. Currently, it supports only youtube.

Anyway, I'm sorry for the frequent use of antipatterns. I made this when I just started to write PHP code (I was like 13-14 years old back then), but it can be useful sometimes and even uses some cool ideas.

Nausik, xaputo@gmail.com