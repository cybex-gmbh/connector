# Connector

Used as [Collector](https://github.com/cybex-gmbh/collector) target to back up a non-Laravel project using the [Laravel Protector package](https://github.com/cybex-gmbh/laravel-protector).

This system uses an internal database for Laravel migrations. The database which is to be backed up is referred to as external. 

The database connections can be changed by the following `.env` keys:

```dotenv
EXTERNAL_DATABASE_CONNECTION=mysql
INTERNAL_DATABASE_CONNECTION=sqlite
```

SQLite is used as internal database by default and stored in `database/sqlite/connector.sqlite`.

The external database is configured through the following `.env` keys:

```dotenv
DB_HOST=connector-mysql-1
DB_PORT=3306
DB_DATABASE=connector
DB_USERNAME=connector
DB_PASSWORD=password
```

## Installation

### Using docker

See the [Docker Hub repository](https://hub.docker.com/r/cybexwebdev/connector) for images.

To not accidentally upgrade to a new major version, attach the major version you want to use to the image name:

`cybexwebdev/connector:0`

Here is an example `docker-compose.yml`:

```yaml
version: 'x'
services:
  connector:
    container_name: connector
    image: cybexwebdev/connector:0
    volumes:
      - connector-sqlite:/var/www/html/database/sqlite
      - ./.env:/var/www/html/.env:ro

volumes:
  connector-sqlite:
    driver: local
```

> [!CAUTION]
> The initial `php artisan migrate` command has to be run as the `application` user, else the SQLite file would be created as `root`.

### Cloning the repository
To clone the repository use:

```bash
git clone --branch release/v0 --single-branch https://github.com/cybex-gmbh/connector.git
```

```bash
cp .env.example .env
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

## [Pullpreview](https://github.com/pullpreview/action)

When labeling a pull request with the "pullpreview" label, a staging environment is booted. To make this functional, some environment variables have to be stored in GitHub secrets:

- PULLPREVIEW_AWS_ACCESS_KEY_ID
- PULLPREVIEW_AWS_SECRET_ACCESS_KEY
- PULLPREVIEW_CONNECTOR_USER_PUBLICKEY
- PULLPREVIEW_CONNECTOR_PROTECTOR_AUTH_TOKEN_HASH

#### AWS Credentials

You need credentials of an IAM user that can manage AWS Lightsail. For a recommended configuration take a look at
the [Pullpreview wiki](https://github.com/pullpreview/action/wiki/Recommended-AWS-Configuration).

#### Keys and Token

The database is seeded with a user with a Protector public key and a Sanctum personal access token by using the GitHub secrets.

> [!NOTE]
>
> You will need any existing setup with Laravel Protector for this. \
> It is advised to save the created secrets securely in a separate location, as GitHub secrets cannot be viewed after saving.
1. Create a Sodium keypair:

```bash
php artisan protector:keys
```

Save the provided public key in the `PULLPREVIEW_CONNECTOR_USER_PUBLICKEY` secret.

2. Create a Sanctum token

> [!NOTE]
>
> You will need an existing user for this, as a user id has to be provided.
```bash
php artisan protector:token <userId>
```

Take the hash of the token from the `personal_access_tokens` table and save it in the `PULLPREVIEW_CONNECTOR_PROTECTOR_AUTH_TOKEN_HASH` secret.
