<h2>Generar la llave para el funcionamiento de laravel</h2>

```bash
php artisan key:generate
```

<h2>Instalar la carpeta de vendor</h2>

```bash 
composer install
```

<h2>Instalar el paquete para socialite</h2>

```bash
composer require laravel/socialite
```

<h2>Variables utilizadas</h2>
<lu>
    <li>GOOGLE_OAUTH_ID</li>
    <li>GOOGLE_OAUTH_KEY</li>
    <li>GOOGLE_REDIRECT_URL="http://localhost:8000/google-callback"</li>
</lu>

<h2>Agregar los permisos</h2>

```bash
composer require spatie/laravel-permission
```

<h2>Bibliotecas para generar archivos PDF</h2>

```bash
composer require barryvdh/laravel-dompdf
```
<h2>Habilitar la eexportación de la base de datos</h2>

```bash
composer require spatie/laravel-backup
```
<h2>Cambiar el idioma de las alertas</h2>

```bash
composer require laravel-lang/common
```

<h2>Migrar la base de datos y los seeders</h2>

```bash 
php artisan migrate
php artisan db:seed
```
