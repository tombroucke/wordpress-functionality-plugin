# Functionality plugins

## Installation

### Manual

1. Run `git clone git@github.com:tombroucke/wordpress-functionality-plugin.git {{website-name}}` in your mu-plugins directory
2. Remove .git directory
3. Rename `src/Providers/FunctionalityPluginServiceProvider.php` to `src/Providers/WebsiteNameServiceProvider.php`
4. Find and replace (Case-sensitive)
	- `FunctionalityPlugin` > WebsiteName
	- `functionality-plugin` > website-name
	- `functionality_plugin` > website_name
5. Add to root `composer.json`:
	
	Also replace 
	- `FunctionalityPlugin` with WebsiteName
	- `functionality-plugin` with website-name

	```json
	"extra": {
		"acorn": {
			"providers": [
				"FunctionalityPlugin\\Providers\\AppServiceProvider",
				"FunctionalityPlugin\\Providers\\FunctionalityPluginServiceProvider"
			],
			"aliases": {
				"FunctionalityPluginFrontend": "FunctionalityPlugin\\Facades\\Frontend",
				"FunctionalityPluginAdmin": "FunctionalityPlugin\\Facades\\Admin"
			}
		}
	}
	```
	```json
	"autoload": {
		"psr-4": {
			"FunctionalityPlugin\\": "www/app/mu-plugins/functionality-plugin/src/"
		}
	}
	```

### Bash script

> [!IMPORTANT]  
> Replace these strings first.
> 
> - website-name
> - website_name
> - WebsiteName


At the moment, there is no way to add a namespace to autoload.psr-4 in composer.json through CLI, so it should be manually added:

```json
"autoload": {
	"psr-4": {
		"WebsiteName\\": "www/app/mu-plugins/website-name/src/"
	}
}
```

```bash
git clone git@github.com:tombroucke/wordpress-functionality-plugin.git website-name
rm -rf website-name/.git
mv website-name/src/Providers/FunctionalityPluginServiceProvider.php website-name/src/Providers/WebsiteNameServiceProvider.php
composer config --json --merge extra.acorn.providers '["FunctionalityPlugin\\Providers\\AppServiceProvider", "FunctionalityPlugin\\Providers\\FunctionalityPluginServiceProvider"]'
composer config --json --merge extra.acorn.aliases '{"FunctionalityPluginFrontend": "FunctionalityPlugin\\Facades\\Frontend", "FunctionalityPluginAdmin": "FunctionalityPlugin\\Facades\\Admin"}'


find website-name -type f -name '*.php' -not -exec sed -i '' "s/FunctionalityPlugin/WebsiteName/g" {} \;
find website-name -type f -name '*.php' -not -exec sed -i '' "s/functionality-plugin/website-name/g" {} \;
find website-name -type f -name '*.php' -not -exec sed -i '' "s/functionality_plugin/website_name/g" {} \;

composer dump-autoload
wp acorn optimize:clear
```
