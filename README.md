<img  width="80" src="https://github.com/mxmueller/ULLA/blob/main/app/public/brand/logo_round_black.png">
Urlaubsverwaltungs- &amp; Antragsstellungsapplikation (kurz. ULLA)


- [Setup](#Setup)



# Setup
Repositorie (bash):
```
git curl https://github.com/mxmueller/ULLA.git
cd app
```

<br>
Install Composer:

```
composer install
```

<br>
Install Laratrust:

```
composer require santigarcor/laratrust
php artisan vendor:publish --tag="laratrust"
composer dump-autoload
php artisan migrate
```

<br>
Install Laravel UI:

```
composer require laravel/ui
```
<br>
Build frontend:

```
npm install
npm run dev
```

<br>

Seeds:

```
php artisan db:seed --class=ullaDefaultRoleSeeder
php artisan db:seed --class=ullaDefaultAdminSeed
php artisan db:seed --class=ullaDefaultRequestTypeSeeder
```

Mail Setup:
```
php artisan vendor:publish --tag=laravel-mail
```

<br>
Copy app/json Folder to app/storage/app
<br>

<br>
Now we created all 4 setup roles and the default Admin User! <br>
Default Admin credentials:<br>
Email: admin@admin.com <br>
Password: password <br>
<br>
<br>
