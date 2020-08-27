# Installation

## 1. Renaming

The order in which you find & replace is important, as is the text case.

1. Rename plugin directory & projectname-functionality.php
2. Replace `ProjectnameNamespace` by your namespace
3. Replace `Projectname` by your project name
4. Replace `projectname-textdomain` (case-sensitive)
5. Replace `projectname`(case-sensitive)
6. Comment out modules you don't need

## 2. Installing

1. Remove required packages from composer.json in case you aren't using custom post types.
2. Run `composer install` to autoload files & install dependencies.