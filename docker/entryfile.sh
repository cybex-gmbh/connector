#!/usr/bin/env bash

# Change folder permissions from root to application.
chown -R application:application ${SQLITE_DATABASE_FOLDER_PATH:-/var/www/html/database/sqlite}

if ${PULLPREVIEW:-false}; then
    php /var/www/html/artisan migrate --force
    php /var/www/html/artisan key:generate --force
    # This has to be executed again because the SQLite database file was created as root.
    chown -R application:application ${SQLITE_DATABASE_FOLDER_PATH:-/var/www/html/database/sqlite}

    if ${PULLPREVIEW_FIRST_RUN:-false}; then
        php /var/www/html/artisan db:seed --class=PullPreviewSeeder --force
    fi
fi

exec /entrypoint supervisord "$@"
