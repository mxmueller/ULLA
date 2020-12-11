# ULLA
Urlaubsverwaltungs- &amp; Antragsstellungsapplikation (kurz. ULLA)

Projekt hochziehen:

Initial Installation:
```
$ git clone https://github.com/mxmueller/ULLA.git 
```
```
cd ULLA/app
composer install
```

Laratrust Setup (User Roles):
```
composer require santigarcor/laratrust
php artisan vendor:publish --tag="laratrust"
php artisan laratrust:setup
composer dump-autoload
php artisan migrate
```

Setup default User Roles with the ULLA default Seeder:
```
php artisan db:seed --class=ullaDefaultRoleSeeder
```
