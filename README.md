# Lambda

## Setup
### Config file
First, you need to set the `ROOT_DIR` on the `config.php` file. (after the http).
### Database
The scheme of the database is in the file `main.sql`.
You have to create the Sqlite3 database.

``` sh
sqlite3 main.db
```

Then in the sqlite3 prompt, tou need to reed the sql file in order to create the scheme of the database.

``` sql
.read main.sql
```

