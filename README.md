## Microservice laravel-markets-api 

Microservice that copies list of assets from different markets, store it on MySQL. Also gathers assets' prices and store it in MongoDB. There is a Redis for fast sorting by popular stocks and bonds.
As an example, it works with MOEX market, but has developed contracts to integrate other markets. 

## Install

- git clone
- composer install
- docker-compose up -d
- docker-compose exec app sh 
- php artisan migrate 
- php artisan data:get-all-assets
- exit

## How to use microservice
Have a look at Swagger documentation {{server}}/api/documentation, but next examples below:
- GET: {{server}}/api/assets
- GET: {{server}}/api/assets/popular/25
- GET: {{server}}/api/assets/FXUS

## Some technical skills

### DI, services, repositories
Have a look at app/Http/Controllers/API/AssetController

### Interfaces/Contracts

Have a look at app/Services/Markets/

### Redis use

Have a look at app/Http/Controllers/API/AssetController

### MongoDB use

Have a look at app/Http/Controllers/API/StockController, app/Http/Controllers/API/BondController and app/Http/Controllers/API/EtfController
