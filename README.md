Guild to build project <br>
<br>
Clone project:<br>
 - git clone https://gitlab.com/khuyenphamno0/ecm01.git<br>
Clone Laradock<br>
 - git clone https://github.com/Laradock/laradock.git<br>
Config laradock:<br>
 - cd laradock<br>
 - cp .env.example .env<br>
 - Config mysql, PHP by:<br>
    + PHP 8.3<br>
    + mysql 8.0<br>
- docker composer build nginx mysql<br>
- docker compose up -d nginx mysql<br>
- docker compose exec workspace bash<br>
- composer install<br>
- cp .env.example .env<br>
- php artisan migrate<br>
- php artisan db:seed<br>
- pbp artisan key:generate<br>
- php artisan storage:link<br>
- npm i<br>
- npm run build<br>

