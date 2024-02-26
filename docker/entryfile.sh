#!/usr/bin/env bash

if ${PULLPREVIEW:-false}; then
    php /var/www/html/artisan migrate --force
    php /var/www/html/artisan key:generate --force
    chown -R application:application ${SQLITE_DATABASE_FOLDER_PATH:-/var/www/html/database/sqlite}

    if ${PULLPREVIEW_FIRST_RUN:-false}; then
        php /var/www/html/artisan db:seed --class=PullPreviewSeeder --force
    fi
fi

exec /entrypoint supervisord "$@"
