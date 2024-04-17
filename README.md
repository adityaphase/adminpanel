Basic admin panel<br>
Code re-optimised for use in xampp<br>
For testing in docker change to these php vars:<br>
```
$hostname = "mysql";
$username = "my_user";
$password = "my_password";
$dbdata = "property_manage";
```
or adjust compose parameters as needed.<br>
Exported database for MariaDB (xampp); may cause problems for MySQL on import with collation.