# Ishetkutweer v4
This website will show weather data in a simple and clear manner.

# Dependencies
- Docker
- API key for [Maxmind services](https://www.maxmind.com/) 
 
# Installing
1. Clone the repository
2. Copy the `.env` file to `.env.local` and use your Maxmind API key to populate the `MAXMIND_LICENSE_KEY` field
3. Run `docker-compose up -d` to spin up the docker container
5. Run `docker-compose exec php-fpm composer install` to fetch all PHP dependencies
6. Run `docker-compose exec php-fpm yarn install` to fetch all javascript dependencies
6. Run `docker-compose exec php-fpm yarn dev` to build frontend assets
7. Run `docker-compose exec php-fpm bin/console doctrine:schema:create` to create all required database tables
8. Run `docker-compose exec php-fpm bin/console download:ipdata` to download Maxmind ip mappings
9. Run `docker-compose exec php-fpm bin/console import:buienradar` to download the latest weather data
10. Visit `http://localhost:9000/` to see the running application

# Running QA checks locally
To run all QA tests locally run `docker-compose exec php-fpm composer check`
To run individual checks run one of the following commands:
- Unit tests `docker-compose exec php-fpm composer phpunit-unit`
- Integration tests `docker-compose exec php-fpm composer phpunit-integration`
- Acceptance tests `docker-compose exec php-fpm composer phpunit-acceptance`
- Php static analysis tool `docker-compose exec php-fpm composer phpstan`
- Php mess detector `docker-compose exec php-fpm composer phpmd`
- Php code sniffer `docker-compose exec php-fpm composer phpcs`
- Php lint `docker-compose exec php-fpm composer phplint`
- Php copy/paste detector `docker-compose exec php-fpm composer phpcpd`
- Dependency tracker `docker-compose exec php-fpm composer deptrac`
- Security checker `docker-compose exec php-fpm composer security-checker`
