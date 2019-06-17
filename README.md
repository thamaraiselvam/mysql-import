# MySQL Importer

<a href="https://www.buymeacoffee.com/R8Nc2vn" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/yellow_img.png" alt="Buy Me A Coffee"></a>

mysqli import sql from a .sql file

### Install

Using composer include the repository by typing the following into a terminal

```
composer require thamaraiselvam/mysql-import
```

### Usage

Include the composer autoloader, import the Import namespace.

```
<?php
require('vendor/autoload.php');

use Thamaraiselvam\MysqlImport\Import;

$filename = 'database.sql';
$username = 'root';
$password = '';
$database = 'sampleproject';
$host = 'localhost';
new Import($filename, $username, $password, $database, $host);
```
