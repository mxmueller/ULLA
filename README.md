<img  width="140" src="https://github.com/mxmueller/ULLA/blob/main/laravel/public/brand/logo_round_black.png">
Urlaubsverwaltungs- &amp; Antragsstellungsapplikation (kurz. ULLA)

 <br>

- [Setup](#Setup)
- [Funktion](#Funktion)


# Setup
<br>

Zunächst muss das Repository geklont werden.

Repository Origin:
```
git curl https://github.com/mxmueller/ULLA.git
cd laravel
```
Beispiel vhost Konfiguration (falls nötig):
```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
      DocumentRoot /var/www/ULLA/laravel/public

    <Directory "/var/www/ULLA/laravel/public">
           AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
(Verzeichnisstruktur nur Beispielhaft).

<br>

Composer installieren:
Composer kümmert sich darum, diese ganzen Abhängigkeiten aufzulösen und alle benötigten Bibliotheken automatisch in der richtigen Version in unser Projekt herunterzuladen.
Sollte Composer bereits installiert sein kann dieser Schritt übersprungen werden.

```
composer install
```

<br>
Laratrust installieren:
Laratrust ist ein Laravel (>=5.2)-Paket, mit dem sehr einfach alles, was mit Autorisierung (Rollen und Berechtigungen) zu tun hat, innerhalb einer Laravel Anwendung hangehabt werden kann. Elementar für die Applikation.


```
composer require santigarcor/laratrust
php artisan vendor:publish --tag="laratrust"

composer dump-autoload
php artisan migrate
```

<br>

Laravel UI installieren:

```
composer require laravel/ui
```

<br>

Frontend aktualisieren:

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

<br>

Der Admin Seed erstellt den Initialen Admin User. <br>
Default Admin Zugangsdaten:

| E-Mail         | Passwort      | 
| ---------------|:-------------:| 
| admin@admin.com| password      |

Nach der einrichtung sollte der User gelöscht werden.

<br>

Mail Setup:

```
php artisan vendor:publish --tag=laravel-mail
composer require spatie/calendar-links
```

<br>

__Wichtig!
Beim dem Initialen Aufbau muss app/json Ordber nach app/storage/app kopiert werden__

<br>
<br>

# Funktion

...
