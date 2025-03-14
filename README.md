## Install dependecies
composer install
npm install

## copy env file
cp .env.example .env

## migrate database

php artisan migrate

php artisan db:seed

## link storage 

php artisan storage:link

npm run build
