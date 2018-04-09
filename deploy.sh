#!/bin/bash

# create documentation
php ./vendor/bin/phpdoc -i "css/,images/,scripts/,skins/,tests/,vendor/,core/config.php,test.php" -d ./ --template clean --title "ugamela Documentation"
mv output/ docs/
rm -rf ./docs/build/

gitLastCommit=$(git show --summary --grep="Merge pull request")


if [[ -z "$gitLastCommit" ]]
then
	lastCommit=$(git log --format="%H" -n 1)
else
	echo "We got a Merge Request!"
	#take the last commit and take break every word into an array
	arr=($gitLastCommit)
	#the 5th element in the array is the commit ID we need. If git log changes, this breaks. :(
	lastCommit=${arr[4]}
fi

echo $lastCommit

filesChanged=$(git diff-tree --no-commit-id --name-only -r $lastCommit)
if [ ${#filesChanged[@]} -eq 0 ]; then
    echo "No files to update"
else
    for f in $filesChanged
	do
		#do not upload these files that aren't necessary to the site
		if [ "$f" != ".travis.yml" ] && [ "$f" != "deploy.sh" ] && [ "$f" != "test.js" ] && [ "$f" != "package.json" ] && [ "$f" != "phpunit.xml" ] && [ "$f" != "composer.json" ] && [ "$f" != "codestyle.xml" ] && [ "$f" != "README.md" ] && [ "$f" != "LICENSE" ] && [ "$f" != ".gitignore" ]
		then
	 		echo "Uploading $f"
	 		curl --ftp-create-dirs -T $f -u $SFTP_USER:$SFTP_PASSWORD ftp://$SFTP_HOST/ugamela/$f
		fi
	done
fi