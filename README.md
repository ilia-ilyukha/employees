## Instruction for deploying project:
1) composer install

2) Create файл .env
Open your .env file and change the database name (DB_DATABASE) to whatever you have, 
username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration

3) php artisan key:generate

4) php artisan migrate

For seed data you can:
- use seeders:
    php artisan db:seed --class=EmployerSeeder

    php artisan db:seed --class=EmployerHourSeeder
    
    php artisan db:seed --class=DepartmentSeeder

- or upload file employees.xml on "/import" page

Optional:
npm install && npm run dev
