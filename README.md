Do a composer install
composer install

copy .env.example file and rename it to .env and make a new database in mySql database, and name it what it ever you want , make sure that this name match in your .env file . here you can change db details.

make migration for the tables
php artisan migrate 

generate key
php artisan key:generate

Then do a npm install
npm install

Run server
Run server using this command-
php artisan serve

for the front end part you need to open another terminal for the same project and make :
npm run dev

