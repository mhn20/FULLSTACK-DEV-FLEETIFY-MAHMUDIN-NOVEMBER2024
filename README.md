## WITH DOCKER
### FIRST SETUP
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
```bash
https://localhost:8000
```
## WITHOUT DOCKER | PHP VERSION 8.2 | mariadb:10.11.7
### FIRST SETUP
```bash
cd project
```
```bash
cp .env.example .env
```
```bash
composer update
```
```bash
php artisan migrate
```
```bash
php artisan serve
```
```bash
https://localhost:8000
```
