docker-start:
	docker-compose -f docker/docker-compose.yml up --build -d --remove-orphans --force-recreate
docker-stop:
	docker-compose -f docker/docker-compose.yml stop
docker-ssh:
	docker-compose -f docker/docker-compose.yml exec php /bin/sh
docker-mysql:
	docker-compose -f docker/docker-compose.yml exec db bash
tests:
	docker-compose -f docker/docker-compose.yml exec php /var/www/vendor/bin/phpunit