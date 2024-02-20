# Connector

Used to backup a non-Laravel project with the Laravel Protector package.  

> >[!CAUTION]
> The `php artisan migrate` command is overwritten to always use the secondary database connection. This prevents accidentally running migrations on the main database.
