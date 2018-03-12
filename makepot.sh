#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

WORDPRESS_TRUNK="$DIR/../trunk/tools/i18n" # Change this to point to where you pulled WP's trunk

cd "$DIR" && yarn run build

TMP_DIR="$(mktemp -d)"
cp -R "$DIR/dist" "$TMP_DIR/t3p"

cd "$DIR/src/static/languages" && php "$WORDPRESS_TRUNK/makepot.php" wp-theme "$TMP_DIR/t3p"

rm -rf "$TMP_DIR"
