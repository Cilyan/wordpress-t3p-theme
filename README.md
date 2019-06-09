# Wordpress Theme for *Les Trois Pics* website

This is officially a theme for [www.les3pics.fr][]. It was constructed from [TwentySeventeen][] and [Underscores][], with inspiration from [SKT Adventure Lite][].

However, the theme can also be seen as a starter if you want to use common web development tools:
 - A ready-to-use [docker-compose][] Wordpress + MariaDB setup
 - [Yarn][] to handle build dependencies
 - [Webpack][] as the building tool with watch feature
 - [SCSS][] for styling
 - SVG icon font (Webpack merge support to come)

 [www.les3pics.fr]: https://www.les3pics.fr
 [TwentySeventeen]: https://wordpress.org/themes/twentyseventeen/
 [Underscores]: https://underscores.me/
 [SKT Adventure Lite]: https://www.sktthemes.net/shop/free-travel-blog-wordpress-theme/
 [docker-compose]: https://www.docker.com/
 [yarn]: https://yarnpkg.com/
 [Webpack]: https://webpack.js.org/
 [SCSS]: https://sass-lang.com/

## Getting started

After you have forked, cloned or downloaded the repository, ensure you have Vagrant and Yarn (or npm) installed.

Setup the environment with these commands

    yarn install
    yarn run build
    vagrant up

Once the setup is bootstraped, you can restart your development environment with

    vagrant up
    yarn run watch
