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

Run the script below from your site (Bedrock) root. In a default bedrock install, the web root is "web". In my projects, the webroot is "www'. If your webroot is web, you should also replace 'www' with 'web' in the script below.

> [!IMPORTANT]  
> Replace these strings first.
> 
> - {{website-name}}
> - {{website_name}}
> - {{WebsiteName}}


At the moment, there is no way to add a namespace to autoload.psr-4 in composer.json through CLI, so it should be manually added:

```json
"autoload": {
	"psr-4": {
		"{{WebsiteName}}\\": "www/app/mu-plugins/{{website-name}}/src/"
	}
}
```

```bash
git clone git@github.com:tombroucke/wordpress-functionality-plugin.git www/app/mu-plugins/{{website-name}}
rm -rf {{website-name}}/.git
mv www/app/mu-plugins/{{website-name}}/src/Providers/FunctionalityPluginServiceProvider.php www/app/mu-plugins/{{website-name}}/src/Providers/{{WebsiteName}}ServiceProvider.php
composer config --json --merge extra.acorn.providers '["{{WebsiteName}}\\Providers\\AppServiceProvider", "{{WebsiteName}}\\Providers\\{{WebsiteName}}ServiceProvider"]'
composer config --json --merge extra.acorn.aliases '{"{{WebsiteName}}Frontend": "{{WebsiteName}}\\Facades\\Frontend", "{{WebsiteName}}Admin": "{{WebsiteName}}\\Facades\\Admin"}'


find www/app/mu-plugins/{{website-name}} -type f -name '*.php' -not -exec sed -i '' "s/FunctionalityPlugin/{{WebsiteName}}/g" {} \;
find www/app/mu-plugins/{{website-name}} -type f -name '*.php' -not -exec sed -i '' "s/functionality-plugin/{{website-name}}/g" {} \;
find www/app/mu-plugins/{{website-name}} -type f -name '*.php' -not -exec sed -i '' "s/functionality_plugin/{{website_name}}/g" {} \;

composer dump-autoload
wp acorn optimize:clear
```

## Default options
By default, this plugin provides a "General" options page, with company info, social media links, opening hours and newsletter signup form.
It provides a shortcode + view for the opening hours `[opening-hours]` and the newsletter signup form `[newsletter-signup-form]`.

## Adding functionality
The `boot()` method of `src/Providers/{{WebsiteName}}ServiceProvider.php` is an entrypoint for custom functionality. 

## Acorn commands

### Register post type
`wp acorn website-name:post-type Story`

Where 'Story' is the name of your post type. Recipe should be PascalCase. The post type slug and labels will be generated automatically. A Recipe.php file will be created in src/PostTypes, and will be registered automatically.

### Register taxonomy
`wp acorn website-name:post-type Genre Story`

Where 'Genre' is the name of your post type and 'Story' is your post type. Both should be PascalCase. The taxonomy slug and labels will be generated automatically. A Genre.php file will be created in src/Taxonomies/Recipe, and will be registered automatically.

### Add ACF Options page
`wp acorn website-name:options-page CustomOptions`

Where 'CustomOptions' is the name of your options page. CustomOptions should be PascalCase. A CustomOptions.php file will be created in src/OptionsPages, and will be registered automatically.

### Add shortcode
`wp acorn website-name:shortcode CustomShortcode`

Where 'CustomShortcode' is the PascalCase version of 'custom-shortcode'. A controller will be created in src/Shortcodes, and a view will be created in resources/views/shortcodes.
