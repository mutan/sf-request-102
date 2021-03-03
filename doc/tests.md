## Tests

### Настройка тестов в PhpStorm

#### 1. CLI Interpreter
   
Settings - Languages & Frameworks - PHP - CLI Interpreter - нажмите на кнопку с тремя точками.

В открывшемся окне CLI Interpreter - нажмите на синий плюс - From Docker...

В открывшемся окне Configure Remote PHP Interpreter:
  * Выберите Docker Compose
  * Server - New - Unix Socket - подождите, пока появится надпись Connection Successful - Ok
  * Configuration file - /docker/php-cli-docker-compose.yml
  * Service - php-cli
  * Нажмите Ok, подождите, пока PhpStorm закончит настройку

#### 2. PHPUnit

Settings - Languages & Frameworks - PHP - Test Frameworks - нажмите на синий плюс - PHPUnit by Remote Interpreter - выберите php-cli - Ок.

В открывшемся окне:
  * выберите опцию Path to phpunit.phar
  * в поле Path to phpunit.phar напишите /srv/bin/phpunit
  * нажмите на иконку Reload phpinfo, дождитесь сообщения об успехе
  * Default configuration file - /srv/phpunit.xml.dist
  * Нажмите Ок

Можно запускать тесты.

#### 3. Command Line Tool Support

Settings - Tools - Command Line Tool Support - нажмите на синий плюс.

В открывшемся окне Command Line Tools:
  * Choose Tool: Tool based on Symfony Console
  * Нажмите Ок

В открывшемся окне Tool Settings:
  * Alias: console
  * PHP Interpreter: php-cli
  * Path to script: /srv/bin/console
  * Нажмите Ок

Теперь можно нажать Ctrl два раза, в появившемся окне набрать `console`, и далее набрать или выбрать из списка нужную команду.
