#!/bin/bash

# create documentation
php ./vendor/bin/phpdoc -i "css/,images/,scripts/,skins/,tests/,vendor/,core/config.php,test.php" -d ./ --template clean --title "ugamela Documentation"
mv output/ docs/
rm -rf ./docs/build/

curl --ftp-create-dirs -T ./ -u $SFTP_USER:$SFTP_PASSWORD ftp://$SFTP_HOST/ugamela/$f