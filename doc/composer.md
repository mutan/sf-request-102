## Composer.json explanation

### config

`optimize-autoloader: true` This makes everything quite a bit faster as for known classes the class map returns instantly the path. See [Composer: Autoloader optimization](https://getcomposer.org/doc/articles/autoloader-optimization.md).

`preferred-install` See [Composer: preferred-install](https://getcomposer.org/doc/06-config.md#preferred-install) and [Stackoverflow: Difference between composer prefer-dist and prefer-source](https://stackoverflow.com/questions/16205100/difference-between-composer-prefer-dist-and-prefer-source/46641804).

`sort-packages` See [Composer: sort-packages](https://getcomposer.org/doc/06-config.md#sort-packages).

### replace

See [Stackoverflow: How does the “replace” property work with composer](https://stackoverflow.com/questions/18882201/how-does-the-replace-property-work-with-composer).

### scripts

`auto-scripts` See [Stackoverflow: Symfony 4 Composer scripts](https://stackoverflow.com/questions/50702990/symfony-4-composer-scripts).

### extra

Arbitrary extra data for consumption by scripts. This can be virtually anything. See [Composer: extra](https://getcomposer.org/doc/04-schema.md#extra).

`symfony: allow-contrib:` `false` - search Symfony flex recipes only in "main" repository. `true` - use "contrib" repository as well. See [Symfony 4: Contributing Recipes](http://fabien.potencier.org/symfony4-contributing-recipes.html).

`symfony: require:` Restricts the Symfony core packages to stick to the required version.

### conflict

Map of packages that conflict with this version of this package. They will not be allowed to be installed together with your package. See [Composer: conflict](https://getcomposer.org/doc/04-schema.md#conflict).
