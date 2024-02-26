# Connector

Used as [Collector](https://github.com/cybex-gmbh/collector) target to back up a non-Laravel project using the [Laravel Protector package](https://github.com/cybex-gmbh/laravel-protector).

This system uses an internal database for Laravel migrations. The database which is to be backed up is referred to as external. 

The database connections can be changed by the following `.env` keys:

```dotenv
EXTERNAL_DATABASE_CONNECTION=mysql
INTERNAL_DATABASE_CONNECTION=sqlite
```

SQLite is used as internal database by default and stored in `database/connector.sqlite`.

The external database is configured through the following `.env` keys:

```dotenv
DB_HOST=connector-mysql-1
DB_PORT=3306
DB_DATABASE=connector
DB_USERNAME=connector
DB_PASSWORD=password
```

## Setup

1. Migrate the internal database

```bash
php artisan migrate
```

2. Create a user

> [!NOTE]
> You need a Protector public key for this, which can be created with `php artisan protector:keys`. The private key should be stored in your client's `.env`.

```bash
php artisan create:user <publicKey>
```

Store the returned information in your client's `.env`.
