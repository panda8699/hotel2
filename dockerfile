# Sử dụng image cơ bản PHP với Apache
FROM php:8.1-apache

# Cài đặt các thư viện và extension cần thiết
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev unzip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd mysqli pdo pdo_mysql zip && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# Copy mã nguồn ứng dụng vào container
COPY . /var/www/html/

# Thiết lập quyền sở hữu cho thư mục
RUN chown -R www-data:www-data /var/www/html

# Cấu hình Apache
COPY ./config/000-default.conf /etc/apache2/sites-available/000-default.conf

# Expose cổng 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
