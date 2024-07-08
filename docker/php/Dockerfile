FROM arsentiyzhunussov/php:8.2-fpm-alpine

COPY ./supervisor/*.conf /etc/supervisor/conf.d-available/
RUN mkdir -p /etc/supervisor/conf.d/
RUN ln -sf /etc/supervisor/conf.d-available/horizon.conf /etc/supervisor/conf.d/horizon.conf

COPY ./entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint"]
