# Build the Docker containers
build:
	docker compose build

# Start the Docker containers in detached mode
up:
	docker compose up -d

# Stop and remove the Docker containers
down:
	docker compose down

# View the logs of the Docker containers in real-time
logs:
	docker compose logs -f

# Clean up unused Docker images, containers, and volumes
clean:
	docker system prune -a -f
