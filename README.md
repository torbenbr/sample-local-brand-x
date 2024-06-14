# Sample Local Brand X

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to set up and start a fresh Symfony project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.


## Quality Tools 

* `docker compose exec php ./vendor/bin/php-cs-fixer fix`
* `docker compose exec php ./vendor/bin/rector`
* `docker compose exec php ./vendor/bin/phpstan`
* `XDEBUG_MODE=coverage php -d memory_limit=-1 ./vendor/bin/phpunit tests --coverage-html coverage`
