This script import the sql queries from a file to mysql database.

Tested : PHPMyAdmin Export, Adminer Export, InfiniteWP Database Backup file, ManageWP Database Backup file and WP Time Capsule Database Backup file

Steps to Run the secript.

1.Clone this repo

2.Open the `import.php` and replace following varialbles with your Database credentials

`$filename = 'filname.sql';`

`$mysql_host = 'localhost';`

`$mysql_username = 'USERNAME';`

`$mysql_password = 'PASSWORD';`

`$mysql_database = 'DB_NAME';'`

3.Run the `import.php`

That's it.
