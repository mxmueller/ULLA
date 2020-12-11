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

Install Laratrust (User Roles):
```
composer require santigarcor/laratrust
php artisan vendor:publish --tag="laratrust"
composer dump-autoload
php artisan migrate
```

Setup default User Roles with the ULLA default Seeder:
```
php artisan db:seed --class=ullaDefaultRoleSeeder
```

Install Laravel UI (Login / Registration frontend):
**Always choose (yes/no) --> no (!)**
```
composer require laravel/ui
php artisan ui vue --auth
```

Install NPM:
```
npm install
npm run dev / npm run production
```
