docker compose build app
docker compose up -d
docker compose exec app composer install
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan migrate:fresh --database=mysql-testing
