## Microservice laravel-markets-api 

**Laravel 8** Microservice that copies list of assets from different markets, store it in **MySQL**. Also gathers assets' prices and store it in **MongoDB**. There is a **Redis** for fast sorting by popular assets.
As an example, it works with MOEX market, but has developed contracts to integrate other markets. 

API was implemented following **RESTful API** standard.

## Install (run commands in console)
- `git clone`
- `composer install`
- `docker-compose up -d --build`
- `docker-compose up -d`
- `docker-compose exec app sh`
- `php artisan migrate`
- `php artisan data:import-all-assets`
- `exit`

## How to use microservice
Have a look at **Swagger documentation** {{server}}/api/documentation and next examples below:
- GET: {{server}}/api/stocks
- GET: {{server}}/api/bonds/popular
- GET: {{server}}/api/etfs/FXUS

## Some technical skills

### Dependency Injection (DI), services, repositories
Have a look at:
* app/Http/Controllers/API/AssetController
* app/Services/Markets/MOEX/ImportAssets.php

### Interfaces/Contracts

Have a look at:
* app/Services/Markets/

### Redis use

Have a look at:
* app/Http/Controllers/API/AssetController
* app/Http/Controllers/API/StockController
* app/Http/Controllers/API/BondController
* app/Http/Controllers/API/EtfController

### MongoDB use

Have a look at:
* app/Http/Controllers/API/StockController
* app/Http/Controllers/API/BondController
* app/Http/Controllers/API/EtfController

    
