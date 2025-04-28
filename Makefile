# Build the Docker containers
build:
	docker compose build

# Start the Docker containers in detached mode
up:
	docker compose up -d
	docker compose exec touch database/logs.db
	docker compose exec -T --user root app chown www-data:www-data database
	docker compose exec app composer install

# Stop and remove the Docker containers
down:
	docker compose down

# View the logs of the Docker containers in real-time
logs:
	docker compose logs -f

# Clean up unused Docker images, containers, and volumes
clean:
	docker system prune -a -f
