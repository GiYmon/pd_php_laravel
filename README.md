## Requirements

- Docker
- Docker Compose

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installation

1. Clone the repository:

```bash
git clone https://github.com/GiYmon/pd_php_laravel.git
cd pd_php_laravel
```

2. Start the Docker containers:

```bash
docker compose up -d
```

 3. Perform database migrations and seeding:

 ```bash
 docker compose exec app php artisan migrate
 docker compose exec app php artisan db:seed
 ```

 4. After the containers have started, the application should be accessible at http://localhost:8080.

