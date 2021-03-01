Settings - Languages & Frameworks - PHP - CLI Interpreter - кнопка с тремя точками

В открывшемся окне CLI Interpreter - синий плюс - From Docker...

В открывшемся окне Configure Remote PHP Interpreter - выбираем Docker Compose

    Server - New - Unix Socket - ждем, пока появится надпись Connection Successful - Ok

    Configuration file - /docker/php-cli-docker-compose.yml

    Service - php-cli - Ok

    Ждем, пока PhpStorm закончит настройку

Settings - Languages & Frameworks - PHP - Test Frameworks - синий плюс - PHPUnit by Remote Interpreter - выбираем php-cli

В открывшемся окне - выбираем опцию Path to phpunit.phar - в поле Path to phpunit.phar пишем /srv/bin/phpunit - нажать на иконку Reload phpinfo, дождаться сообщения об успехе

    Default configuration file - /srv/phpunit.xml.dist


Можно запускать тесты.