FROM webdevops/php-nginx:8.3

WORKDIR /var/www/html

ENV WEB_DOCUMENT_ROOT /var/www/html/public

# Timeout for the post update script in minutes.
LABEL com.centurylinklabs.watchtower.lifecycle.post-update-timeout="1440"
# Watchtower will run this script after restarting the updated container.
LABEL com.centurylinklabs.watchtower.lifecycle.post-update="/var/www/html/docker/watchtower.post-update.sh"

COPY . /var/www/html

RUN composer install --no-interaction --no-dev

RUN apt update
RUN apt install -y default-mysql-client sqlite3

RUN chmod +x /var/www/html/docker/entryfile.sh
RUN chmod +x /var/www/html/docker/watchtower.post-update.sh
RUN chmod 755 -R /var/www/html/storage
RUN chown -R application:application /var/www/html/storage

ENTRYPOINT ["/var/www/html/docker/entryfile.sh"]
