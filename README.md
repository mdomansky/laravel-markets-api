## Microservice laravel-markets-api 

**Laravel 8** microservice that imports a list of assets from different markets, store them in **MySQL**. Also gathers assets' prices and store them in **MongoDB**. There is a **Redis** for fast sorting by popular assets.
As an example, it works with MOEX market, but has developed contracts to integrate other markets. 

The microservice follows **RESTful API** standard.

Please check **Postman collection** and **Swagger documentation**.

## Install (run commands in console)
- `git clone`
- `composer install`
- `docker-compose up -d --build`
- `docker-compose up -d`
- `docker-compose exec app sh`
- `php artisan migrate`
- `php artisan data:import-all-assets`
- `php artisan data:import-assets-prices`
- `exit`

## How to use microservice
Have a look at: 
- Import Postman collection file postman_collection.json
- Open in browser {{server}}/api/documentation
- GET: {{server}}/api/assets
- GET: {{server}}/api/stocks/popular
- GET: {{server}}/api/stocks/{ticker} for example you can use SBER, ALRS, GAZP

## Some technical skills

### Dependency Injection (DI), services, repositories
Have a look at:
* app/Services/Markets/MOEX/ImportAssets
* app/Http/Controllers/API/StockController
* app/Services/StockService

### Interfaces/Contracts

Have a look at:
* app/Services/Markets/ImportAssetsInterface and folder app/Services/Markets/
* Service Provider file: app/Providers/MarketServiceProvider

### Redis use

Have a look at:
* app/Repositories/StockRepository

### MongoDB use

Jenssegers/mongodb package is used for Laravel integration. Have a look at:
* database/migrations/2021_08_04_145759_create_prices_mongodb_collection
* app/Models/Price

    
