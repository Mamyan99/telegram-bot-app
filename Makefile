# пересобирает контейнеры подготавливает базу для dev разработки
init: rebuild composer-install migrate
# собирает контейнеры
up:
	docker-compose -f docker-compose.yml up -d
# Останавливает контейнеры и удаляет контейнеры, сети, тома и образы, созданные через up
down:
	docker-compose -f docker-compose.yml down --remove-orphans
# пересобрать контейнеры
rebuild:
	docker-compose -f docker-compose.yml up -d --build

# команды для инициализации dev среды
composer-install:
	docker exec -t  server-php composer install
fresh-migrate:
	docker exec -t  server-php php artisan migrate:fresh
migrate:
	docker exec -t  server-php php artisan migrate
db-seed:
	docker exec -t  server-php  php artisan db:seed


