# Wordpress Theme for *Les Trois Pics* website

This is officially a theme for [www.les3pics.fr][]. It was constructed from [TwentySeventeen][] and [Underscores][], with inspiration from [SKT Adventure Lite][].

However, the theme can also be seen as a starter if you want to use common web development tools:
 - A ready-to-use [Vagrant][] setup derived from [VCCW][].
 - [Yarn][] to handle build dependencies
 - [Webpack][] as the building tool with watch feature
 - [SCSS][] for styling
 - SVG icon sprite generated from single icon files

 [www.les3pics.fr]: https://www.les3pics.fr
 [TwentySeventeen]: https://wordpress.org/themes/twentyseventeen/
 [Underscores]: https://underscores.me/
 [SKT Adventure Lite]: https://www.sktthemes.net/shop/free-travel-blog-wordpress-theme/
 [Vagrant]: https://www.vagrantup.com/
 [yarn]: https://yarnpkg.com/
 [Webpack]: https://webpack.js.org/
 [SCSS]: https://sass-lang.com/
 [VCCW]: http://vccw.cc/

## Getting started

After you have forked, cloned or downloaded the repository, ensure you have Vagrant and Yarn (or npm) installed.

Setup the environment with these commands

    yarn install
    yarn run build
    vagrant up

Once the setup is bootstraped, you can restart your development environment with

    vagrant up
    yarn run watch

## Cloning production website to test server

The deployment of real data to test server requires a bit more configuration.

1. Use the [Duplicator][] plugin on the production website to export a full
backup of the data.
2. Download the generated archive and `installer.php` script into the root
directory of the project (e.g. here, near this README).
3. Log into the vagrant machine and become root

        vagrant ssh
        sudo su -

4. Remove the complete Wordpress installation in `/var/www/html`, except for the
`wp-content/themes/t3ptheme` directory.

        find /var/www/html/ ! -name 't3ptheme' -type d -exec rm -rf {} +

5. Copy `/vagrant/installer.php` and the `/vagrant/xxxxx_archive.zip` package
file into the directory `/var/www/html`.

        cp /vagrant/installer.php /var/www/html/
        cp /vagrant/*_archive.zip /var/www/html/

6. Open `installer.php` from your browser (e.g.
`http://vccw.test/installer.php`)
7. Follow the steps. The database configuration can be found in
`provision/default.yml`.
8. Using a local console, run again `yarn run build`, in case the Duplicator
replaced your file with old ones.

[Duplicator]: https://wordpress.org/plugins/duplicator/
