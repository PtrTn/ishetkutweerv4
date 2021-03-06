# Ishetkutweer v4
This website will show weather data in a simple and clear manner.

# Dependencies
- Docker
- API key for [Maxmind services](https://www.maxmind.com/) 
 
# Installing
1. Clone the repository
2. Copy the `.env` file to `.env.local` and use your Maxmind API key to populate the `MAXMIND_LICENSE_KEY` field
3. Run `docker-compose -f docker-compose-dev.yml up -d` to spin up the docker container
5. Run `docker-compose -f docker-compose-dev.yml exec php-fpm composer install` to fetch all PHP dependencies
6. Run `docker-compose -f docker-compose-dev.yml exec php-fpm yarn install` to fetch all javascript dependencies
6. Run `docker-compose -f docker-compose-dev.yml exec php-fpm yarn dev` to build frontend assets
7. Run `docker-compose -f docker-compose-dev.yml exec php-fpm bin/console doctrine:schema:create` to create all required database tables
8. Run `docker-compose -f docker-compose-dev.yml exec php-fpm bin/console app:download:ipdata` to download Maxmind ip mappings
9. Run `docker-compose -f docker-compose-dev.yml exec php-fpm bin/console app:import:buienradar` to download the latest weather data
10. Visit `http://localhost:9000/` to see the running application

# Running QA checks locally
To run all QA tests locally run `docker-compose -f docker-compose-dev.yml exec php-fpm composer check`
The following checks are run:
- Unit tests
- Integration tests
- Acceptance tests
- Php static analysis tool
- Php mess detector
- Php code sniffer
- Php lint
- Php copy/past
- Dependency tracker
- Security checker
- Configuration linting
- Container linting
- Twig template linting
