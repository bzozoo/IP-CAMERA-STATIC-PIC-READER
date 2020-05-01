# IP-CAMERA-STATIC-PIC-READER (ALFA VERSION)
* This is not an user friendly script
* This script can read JPG files from directory, where IP camera upload static pictures.
* It displays 100 JPG formated images per page.

Install:
* Download this script, Upload your server
* RUN SQL commands in Your Database (etc in SQL commander section of  Phpmyadmin) from /sql/install.sql
* This SQL installer will create Your User profile in database (as Admin) and It will create your first cameraname, path etc. You can change it to your own datas
* You can add other users in SQL (Phpmyadmin etc).
* You can define new cameranames, camerapaths here too
* Setting your database connection in /class/DataSource.php (SQL host, DB name, DB user, DB password)

Usage
* Login with your selected username and pasword what you created with Installer.
* If you defined a camera name and camera path in database, You will see it in cameralist menu after login

Features:
* Picture listening reverse by date
* Included user login system (Phppot)
* Modal lightbox for pictrures
* Pagination 100 JPG files per page. You can change it in core.php about $perpage variable.
