# Architecture

This document describes the high-level overview of Breakfast Sandwich. If you want to familiarize yourself with the code base, you are in the right place!

## Bird's Eye View

At the high level this is a Drupal 8 site for Breakfast Sandwich. It relies on Content Types, Paragraphs, and custom Twig templates for the majority of displays.

Solr integration is used for returning faceted search results. This is achieved by leveraging the `search_api_solr` and `views` modules.

## Code Map

`.ci/`

Various scripts used for continuous integration. Provider specific configuration files, such as `.circle/config.yml` and `.gitlab-ci.yml`, make use of these scripts. This includes scripts responsible for deploying from gitlab to pantheon, compiling scss, installing composer requirements, and scripts to run testing suites.

The scripts are organized into subdirectories of .ci according to their function: `build`, `deploy`, or `test`.

`.circleci/`

 automation workflow orchestration with the SaSS tool circleci. (completely optional)

`.docksal`

 The project specific docksal config and commands specific for this Drupal site such as init, code sniffer, etc.

`config`

 Contains the config for the drupal site.

`drush`

 Locations of composer installed drush commands.

`scripts`

 Contains scripts for building Drupal site from dependencies. Specifically a composer script that prepares a Drupal artifact within a CI pipeline for deployment on a Pantheon multidev.

`tests`

 Contains behavior Behat tests used during automation.

`web`

 Location of Drupal site once installed via composer scripts. This is necessary for a Composer based workflow. Having your website in this subdirectory also allows for tests, scripts, and other files related to your project to be stored in your repo without polluting your web document root or being web accessible from Pantheon. They may still be accessible from your version control project if it is public

`web/modules/custom`

 Location of custom Drupal modules. For the most part this site used a paradigm of small modules, with a clear defined purpose. e.g. breakfast_sandwich_selects contains all custom logic related selects widgets.

`web/default/`

 contains repo safe settings and service configurations. Note the settings.php has includes for pantheon settings files added on multidev to work withing Pantheon.

`web/themes/custom`

Contains the non-admin drupal theme. See `web/themes/custom/breakfast_sandwich_theme/README.md` for further details on working with the theme.

## Theme

The theme is based on Bootstrap. The theme was built using a component based design built heavily utilizing Paragraphs. As much as feasible an attempt was made to follow the CSS BEM methodology.

## Testing

**Visual Regression Testing** `.ci/test/visual-regression`
Visual regression testing uses a headless browser to take screenshots of web pages and compare them for visual differences.

**Static Testing** `.ci/test/static` and `tests/unit`
Static tests analyze code without executing it. It is good at detecting syntax error but not functionality.

- `.ci/test/static/run` Runs [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) with [Drupal coding standards](https://www.drupal.org/project/coder), PHP Unit, and [PHP syntax checking](https://www.php.net/manual/en/function.php-check-syntax.php).
- `tests/unit/bootstrap.php` Bootstraps the Composer autoloader
- `tests/unit/TestAssert.php` An example Unit test. Project specific test files will need to be created in `tests/unit`.

**Behat Testing** `.ci/test/behat` and `tests/behat`
[Behat](http://behat.org/en/latest/) is a behavioral testing framework written in PHP. [The Drupal Behat Extension](https://www.drupal.org/project/drupalextension) is used to help with integrating Behat and Drupal.

**Load Testing** `tests/locust`
A scalable performance testing tool, written in python used for testing software under load.
