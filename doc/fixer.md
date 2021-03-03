## PHP CS Fixer

[FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) - это линтер, т.е. программа, которая делает форматирование кода единообразным по определенному набору правил.

### Настройка сочетания клавиш в PhpStorm

Зайдите в настройки Settings `Ctrl+Alt+S` - Tools - External Tools. Нажмите синий плюс, в появившемся окне добавьте:
* Name: CS Fixer
* Program: `$ProjectFileDir$/vendor/bin/php-cs-fixer`
* Arguments: `fix -vvv --path-mode=intersection "$FileDir$/$FileName$"`
* Working directory: `$ProjectFileDir$`
* Убедитесь, что включена опция Open console for tool output.

Зайдите в настройки Settings `Ctrl+Alt+S` - Keymap - External Tools - External Tools - CS Fixer, нажмите правой кнопкой, выберите пункт "Add Keyboard Shortcut" и назначьте сочетание клавиш `Alt+F`.

Откройте нужный файл, нажмите `Alt+F`. Этот файл будет изменен в соответствие с текущими правилами. Откроется консоль, в которой будут перечислены сделанные изменения и **примененные правила**.

### Примеры команд

`bin/php-cs-fixer fix -vvv --dry-run` - посмотреть, какие изменения и в каких файлах будут сделаны, без фактического изменения файлов.