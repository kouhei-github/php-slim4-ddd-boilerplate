# composer [ STAGE-1 ]
FROM composer:2.2 as dep
COPY src/composer.* /app/

RUN composer install --no-scripts --no-autoloader

COPY ./src /app/

RUN composer dump-autoload


# PHP [ STAGE-2 ]
FROM php:8.2.12-fpm

# 作業ディレクトリを/var/wwwに設定
WORKDIR /var/www/app

# [ STAGE-1 ]カラ取得
COPY --from=dep /app/ /var/www/app/


# 独自のphp.iniファイル(PHPの設定ファイル)を
# コンテナ内の/usr/local/etc/php/ディレクトリにコピー
COPY container/api/php.ini /usr/local/etc/php/

# パッケージやPHPの拡張モジュールをインストールするコマンド　を実行
RUN apt-get update && apt-get install -y \
	git \
	curl \
	zip \
	unzip \
    && docker-php-ext-install pdo_mysql

COPY ./container/api/start.sh /var/task/start.sh

CMD ["sh", "/var/task/start.sh"]