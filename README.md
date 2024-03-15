## About blue-energy

An application written in Laravel 10.10.x

## Requirements
- `PHP 8.0`
- `NGINX >= 1.18.x | Apache >= 2.4.x`
- `MySQL >= 5.7`
- `Composer >= 2.0`  

# Git branches
This repository has 2 main branches. Each of these branches corresponds to 2 different  
server environment.  
| Branches       | Description   | 
|----------------|---------------|
| master         | Production server main branch.  |
| develop        | Development branch where features should be merge during development.  |

## Installation
1. Clone this repository
2. Create `.env` file and paste all contents from `.env.example`.  
Note: DO NOT RENAME `.env.example` as this serves as backup of  
our environment configuration.
3. Set your database related configuration to recently created `.env` file.  
Below are the list of configurations that needs to be filled in `.env` file:  
We don't have `email` in webhosting yet. So we're using my dummy account for `email`.
```php
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="strawhatguy24@gmail.com"
MAIL_PASSWORD="nscisszzercaflhl"
MAIL_ENCRYPTION=tls
```  
3. After setting up you .env file. Run `composer install` in your terminal. This will install all backend application's dependencies.  
4. Run `php artisan key:generate` to generate Laravel's application key.
5. Run next commands:  
```bash
php artisan migrate
php artisan db:seed
php artisan config:clear
php artisan route:clear
```  
You're all set!

## Running Tests(TDD)
Make sure you have sqlite installed in your system before you run the tests as this is the  
database we use when running test cases.  

To run:  
```bash
php artisan test
```  
Running specific test method:  
```bash
php artisan test --filter testYourMethodToRun
```  

## Managing database migration while maintaining TDD
Sometimes, you need to update your database tables(adding or deleting column),  
while also maintaining 100% passing rate of your test cases. Here, we managed it  
by separating the migration files that will be executed when we run our tests.  

### TDD migration files directory
`database/testing` - STRICTLY NO ALTER TABLES! The reason for this is because sqlite  
does not support SQL ALTER statements and can cause your tests to fail.  
ALTER TABLES SHOULD BE IN `database/migrations` directory!  
__IMPORTANT__:  
- When new you created a new migration file, make sure to copy and paste it in  
`database/testing` directory.  
- When you alter a table thru migration, you need to update specific migration  
in `database/testing` directory as well.  

### Run server
1. Open your powershell or command prompt for running Laravel.
```bash
php artisan serve
```
2. Open your powershell or command prompt again for running Vite/React.JS
```bash
npm run dev
```
You're all set!