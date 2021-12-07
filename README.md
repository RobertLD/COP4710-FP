# COP4710-FP

## Install XAMPP
1. Install it from https://www.apachefriends.org/index.html, leave everything at default (especially the install path!)
2. Open XAMPP Control Panel and start Apache and MySQL
3. MAKE SURE you can navigate to C:/xampp/htdocs on your computer
4. MAKE SURE that you can navigate to http://localhost and http://localhost/phpMyAdmin in your browser

## Clone the repo
1. Navigate to C:/xampp/htdocs and clear it out (either delete its contents or put them into another folder)
2. Clone https://github.com/RobertLD/COP4710-FP.git into C:/xampp/htdocs
3. Copy C:/xampp/htdocs/COP4710-FP/index.html into C:/xampp/htdocs (copying the index file one folder up)
You should now be able to see the login screen from http://localhost

## Init the database 
(you must do this when setting up AND whenever create-schema.sql is modified)
1. Navigate to C:/xampp/htdocs/COP4710-FP/backend/sql/create-schema.sql
2. Open the file and copy all of its contents (Ctrl+A Ctrl+C)
3. Navigate to http://localhost/phpMyAdmin and select the "SQL" tab along the top toolbar. You should see a big box for typing SQL
4. Paste into the box and click the "Go" button in the bottom-right corner
If you refresh the page, you should see that the database has been connected

## Setup the sendmail system
OPTIONAL: Without this the website will still work but it won't send any emails.
So the Forgot Password and Create Staff Account features also won't fully work because they require you to use a temp password form your email.
###TBA


## Using the website
By default, there is a superadmin account with the username 'superadmin' and the password 'root'.
The superadmin password can be changed, but the account cannot be deleted.
From within superadmin (or a staff) you can create more staff (requires sendemail for the temp passwords).
From the login screen you can create as many professor accounts as you want.
Once logged in the navigation is pretty self-explanatory.

NOTE: When a professor is editing book requests, you must click the update button on that row as soon as you are done editing or your changes will not be saved. (A professor can only edit one row of a request at a time)