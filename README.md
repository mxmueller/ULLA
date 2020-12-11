<img  width="300" src="https://github.com/mxmueller/ulla-foundation/blob/main/app/public/brand/logo_large.png">
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
```

<br>
Now we created all 4 setup roles and the default Admin User! <br>
**Default Admin credentials:** <br>
Email: admin@admin.com <br>
Password: password <br>
<br>
<br>
