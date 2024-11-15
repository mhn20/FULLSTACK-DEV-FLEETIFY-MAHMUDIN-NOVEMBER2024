## WITH DOCKER
### FIRST SETUP
```bash 
docker-compose build
```
```bash 
docker-compose build
```
```bash
docker compose run -it php chown -R www-data:www-data /var/www/html
```
```bash
docker compose run -it php chmod -R 775 /var/www/html/storage
```
```bash
cp project/.env.example project/.env
```
```bash
docker compose run php composer update
```
```bash
docker compose run php php artisan migrate
```
### RUN
```bash
docker compose up
```
