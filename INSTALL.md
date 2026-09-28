Clone the repository

`git clone https://github.com/imabug/raddb3.git`

Install the PHP stuff

`cd raddb-filament; composer install`

Install the nodejs stuff

`npm install; npm run build`

Create the database.

Run the database migrations

`php artisan migrate`

Seed the database

`php artisan db:seed` 

If there is existing data from the old version of RadDB, run the `migrate_db.sql` migration script in the `database/` directory
