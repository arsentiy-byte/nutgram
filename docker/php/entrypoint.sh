#!/bin/sh

set -e

role=${CONTAINER_ROLE:-php-fpm}

case "$role" in
    php-fpm)
        echo "Running PHP-FPM..."
        exec php-fpm
        ;;
    scheduler)
        echo "Running the cron..."

        while true; do
            cd /app/ && php artisan schedule:run --verbose --no-interaction &
            sleep 60
        done
        ;;
    worker)
        echo "Running the queue..."

        exec /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
        ;;
    *)
        echo "Could not match the container role \"$role\""
        exit 1
        ;;
esac
