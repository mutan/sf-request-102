## Tests

### Настройка тестов в PhpStorm

1. CLI Interpreter
   
Settings - Languages & Frameworks - PHP - CLI Interpreter - нажать кнопку с тремя точками.

В открывшемся окне CLI Interpreter - нажать синий плюс - From Docker...

В открывшемся окне Configure Remote PHP Interpreter:
  * Выбираем Docker Compose
  * Server - New - Unix Socket - ждем, пока появится надпись Connection Successful - Ok
  * Configuration file - /docker/php-cli-docker-compose.yml
  * Service - php-cli - Ok
  * Ждем, пока PhpStorm закончит настройку

2. PHPUnit

Settings - Languages & Frameworks - PHP - Test Frameworks - синий плюс - PHPUnit by Remote Interpreter - выбираем php-cli.

В открывшемся окне:
  * выбираем опцию Path to phpunit.phar
  * в поле Path to phpunit.phar пишем /srv/bin/phpunit
  * нажимаем на иконку Reload phpinfo, дожидаемся сообщения об успехе
  * Default configuration file - /srv/phpunit.xml.dist

Можно запускать тесты.
