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
- php artisan lang:publish<br>
- npm i<br>
- npm run build<br>
-- edit 3 varibles in .env to login with google: <br>
    GOOGLE_CLIENT_ID = $your-google-client-id <br>
    GOOGLE_CLIENT_SECRET = $your-google-client-secret <br>
    GOOGLE_REDIRECT_URL = 'http://127.0.0.1:80/auth/google/callback' <br>

-- Edit the .env file to send mail: <br>
    - MAIL_MAILER=smtp<br>
    - MAIL_HOST=sandbox.smtp.mailtrap.io<br>
    - MAIL_PORT=587<br>
    - MAIL_USERNAME=$your-email-username( created in mailtrap)<br>
    - MAIL_PASSWORD=$your-email-password( created in mailtrap)<br>
    - MAIL_ENCRYPTION=tls<br>
    - MAIL_FROM_ADDRESS="receptionist@emc01.com"<br>
    - MAIL_FROM_NAME="${APP_NAME}"<br>
--Config laradock to use Supervisord in laradock <br>
    - change these line in .env of laradock: 
        WORKSPACE_INSTALL_PYTHON = false ->true <br>
        WORKSPACE_INSTALL_SUPERVISOR=false → true <br>
    - go to php-worker in laradock and copy laravel-worker.conf.example to laravel-worker.conf <br>
    - run the php-worker: docker compose up php-worker <br>
    Run this command if have email sending problems: <br>
    - php artisan view:clear
