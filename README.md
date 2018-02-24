cop
===

Control de Operaciones, software en desarrollo para la gestión del proceso de venta, empaque y embarque de mercancía vendida.

## Setup

**Setup parameters.yml**

Make sure you have an `app/config/parameters.yml`. If don't, copy `app/config/parameters.yml.dist` to get it.

Make any adjustments you need on configuration.

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
before runing:

```
composer install
```

It is possible that you need to aditionally run `php composer.phar install`, depending on how you installed Composer.

**Setup the Database**

With `app/config/parameters.yml` all settled up, run:

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

In case of problems, completely drop the database (`doctrine:database:drop --force`) and try again.

**Dowload Webpack dependencies**

Use yarn to download webpack depenencies, required by front-end development

```
yarn install
```

**Start the built-in web server**

You can use Nginx or Apache, but the built-in web server works
great:

```
php bin/console server:run
```

Check out the site at `http://localhost:8000`


Help text based on KnpUniversity original about.md file in code examples.