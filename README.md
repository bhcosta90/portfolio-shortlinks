<h1 align="center" id="title">Shortlink</h1>

<p id="description">URL shortener project.</p>

<h2>🛠️ Installation Steps:</h2>

```
docker-compose up -d
```

```
docker-compose run --rm app composer install
```

```
docker-compose run --rm app cp .env.example .env
```

```
docker-compose run --rm app php artisan key:generate
```

```
docker-compose run --rm app php artisan migrate
```



<h2>💻 Built with</h2>

Technologies used in the project:

*   PHP
*   Laravel
*   Horizon
*   RabbitMQ
*   MySql
*   Redis
*   Memcached
