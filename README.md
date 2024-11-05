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
   			"FunctionalityPluginContactInformation": "FunctionalityPlugin\\Facades\\ContactInformation",
   			"FunctionalityPluginSocialMedia": "FunctionalityPlugin\\Facades\\SocialMedia"
   		}
   	}
   }
   ```

   ```json
   "autoload": {
   	"psr-4": {
   		"FunctionalityPlugin\\": "web/app/mu-plugins/functionality-plugin/src/"
   	}
   }
   ```

### Bash script

Run the script below from your site (Bedrock) root.

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
		"{{WebsiteName}}\\": "web/app/mu-plugins/{{website-name}}/src/"
	}
}
```

Then run this script

```bash
git clone git@github.com:tombroucke/wordpress-functionality-plugin.git web/app/mu-plugins/{{website-name}}
rm -rf web/app/mu-plugins/{{website-name}}/.git
mv web/app/mu-plugins/{{website-name}}/src/Providers/FunctionalityPluginServiceProvider.php web/app/mu-plugins/{{website-name}}/src/Providers/{{WebsiteName}}ServiceProvider.php
composer config --json --merge extra.acorn.providers '["{{WebsiteName}}\\Providers\\AppServiceProvider", "{{WebsiteName}}\\Providers\\{{WebsiteName}}ServiceProvider"]'
composer config --json --merge extra.acorn.aliases '{"{{WebsiteName}}ContactInformation": "{{WebsiteName}}\\Facades\\ContactInformation", "{{WebsiteName}}SocialMedia": "{{WebsiteName}}\\Facades\\SocialMedia"}'


find web/app/mu-plugins/{{website-name}} -type f \( -name '*.php' -o -name '*.stub' \) -not -exec sed -i '' "s/FunctionalityPlugin/{{WebsiteName}}/g" {} \;
find web/app/mu-plugins/{{website-name}} -type f \( -name '*.php' -o -name '*.stub' \) -not -exec sed -i '' "s/functionality-plugin/{{website-name}}/g" {} \;
find web/app/mu-plugins/{{website-name}} -type f \( -name '*.php' -o -name '*.stub' \) -not -exec sed -i '' "s/functionality_plugin/{{website_name}}/g" {} \;

composer dump-autoload
wp acorn optimize:clear
```

## Default options

By default, this plugin provides a "General" options page, with company info, social media links, opening hours and newsletter signup form.
It provides a shortcode + view for the opening hours `[opening-hours]` and the newsletter signup form `[newsletter-signup-form]`.

### Contact information

To fetch contact information, you can use the Facade `{{WebsiteName}}ContactInformation`.

```blade
{!! {{WebsiteName}}ContactInformation::formattedAddress() !!}
{!! {{WebsiteName}}ContactInformation::formattedPhoneEmail() !!}
```

You could also use the `[contact-information]` shortcode or `@include('{{WebsiteName}}::shortcodes.contact-information')`

```
[contact-information property="address"]
[contact-information property="phone"]
[contact-information property="email"]
[contact-information property="vat_number"]
[contact-information property="bank_account_number"]
```

### Social media

To fetch social media, you can use the Facade `{{WebsiteName}}SocialMedia`.

```php
$channels = {{WebsiteName}}SocialMedia::channels()
```

## Functionality

- Str::phoneLink('+12 345 678 910')
- Str::emailLink('hello@example.com')

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
