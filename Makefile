build:
	rm -rf ./src/composer
	cd ./src && composer install --prefer-dist --no-dev --classmap-authoritative
	rm -f package.zip
	cd ./src && zip -9 -r ../package.zip *
