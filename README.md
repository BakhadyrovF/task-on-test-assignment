# Installation

### Prerequisites:
 - [Docker Engine](https://docs.docker.com/engine)
 - [Docker Compose](https://docs.docker.com/compose)

1. Copy contents of .env.example to .env file.
```
cp .env.example .env
```
2. Run a shell script to avoid manually entering commands or you can manually run all commands from this file.   
```
bash build-app.sh
```
(*Note that this script is for the first time only*)   
Now you can access app in http://localhost:8000.


# Tests
```
docker compose exec app php artisan test
```

# List of endpoints
1. GET /api/products (No Auth) 
