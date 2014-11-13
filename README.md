mysql-import-export
===================
Useful cross platform library to import and export mysql database, based on mysqldump utility.


## Windows batch files ##
Inside the win folder there are two batch files (.bat). You can use the export.bat file to create a database dump, and the import.bat file to import the previously exported db.

## Php files ##
Inside the php folder you can find import.php and export.php.
To a export a database open export.php and first set db information like below:

```php
$dbHost = 'localhost'; //database host
$dbUser = 'username'; //database username
$dbPass = 'password'; //database password
$dbName = 'test'; //database name
```

Then launch export.php file, it will create a .sql file with the entire db dump.
