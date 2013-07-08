# Stats-CI - Stats application built on the CodeIgniter framework

## Instructions:
* * *
1. Extract the "Stats-CI.zip" file. 

2. First step is to set up  a database and import the "schema.sql" file. This file contains the basic table structure and inserts a row into the user column that can access the admin control panel. 
To change the user that is inserted into the users table you can swap out a e-mail and password for your own. The password is encoded in md5 for security purposes. In order to insert your own password you must use a md5 encoder, here is one:
http://www.md5hashgenerator.com/

3. You can input your database information in the following file:
"application/config/development/database.php"
This file is commented extentsively and provides information for all the different options.  Typically you will only have to input the 'username', 'password', and 'database' fields.

4. The "public_html" folder will be the location of the application on the web server. You can rename this folder if you want. This folder contains all the CSS and JavaScript.
You can move the system and application folder around if you choose to do so, however, it is important that the "index.php" file inside the "public_html" folder have the proper paths to the system and application folders.

5. All of the HTML layout files are located: 
"application/views/layout"
These files include a 'header.php', 'index.php', and 'footer.php'. You can edit these files to change the layout design. If possible I would avoid editing the index file unless necessary.

For more information regarding CodeIgniter you can view the user guide:

http://ellislab.com/codeigniter/user-guide/