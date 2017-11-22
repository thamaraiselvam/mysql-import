This script import the sql queries from a file to mysql database.

Tested : PHPMyAdmin Export, Adminer Export, InfiniteWP Database Backup file, ManageWP Database Backup file and WP Time Capsule Database Backup file

Steps to Run the secript.

1.Clone the repo 

`git clone https://github.com/thamaraiselvam/import-database-file-using-php.git`

OR

Download here - <a href="https://github.com/thamaraiselvam/import-database-file-using-php/archive/master.zip">import-database-file-using-php</a>

2.Open the `import.php` and replace following varialbles with your Database credentials

`$filename = 'filname.sql';`

`$mysql_host = 'localhost';`

`$mysql_username = 'USERNAME';`

`$mysql_password = 'PASSWORD';`

`$mysql_database = 'DB_NAME';'`

3.Run the `import.php`

That's it.
