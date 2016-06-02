# App setup

+ composer install

### Database dump location

+ db/migrations/Database.sql

### local vagrant environment setup

+ php vendor/bin/homestead make
+ vagrant up
(Website/Database IP: 192.168.10.10)

### For data migrations phinx can be used

+ ./vendor/bin/phinx migrate -e development

### Running tests

./vendor/bin/phpunit tests