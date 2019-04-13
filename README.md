#### Requirements and depends
* PHP >= 7.1

## Tests

1. ``$ docker-compose up -d``
2. ``$ docker exec -i -t alldifferentdirections_php_1 bash``
3. ``$ composer install``
4. ``./vendor/bin/phpunit tests/``
