# App setup

+ composer install

### Database dump location

+ db/migrations/Database.sql

### For data migrations phinx can be used

+ phinx migrate -e development

### local vagrant environment setup

+ php vendor/bin/homestead make
+ vagrant up

### Running tests

./vendor/bin/phpunit tests