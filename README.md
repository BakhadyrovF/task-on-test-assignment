# Installation
1. Copy contents of .env.example to .env file.
```
cp .env.example .env
```
2. Run a shell script to avoid manually entering commands.
```
bash build-app.sh
```
And that is all!

# Tests
```
docker compose exec app php artisan test
```

# List of endpoints
1. GET /api/products (No Auth) 
