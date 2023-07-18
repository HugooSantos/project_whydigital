cd backend/ ; docker-compose up -d
cd ../frontend ; docker-compose up -d
docker exec backend-whydigital php artisan key:generate
docker exec backend-whydigital php artisan jwt:secret
docker exec backend-whydigital php artisan migrate --force
docker exec backend-whydigital php artisan db:seed
