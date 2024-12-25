# Usar una imagen base oficial de PHP con soporte para Laravel
FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crear el directorio de trabajo
WORKDIR /var/www

# Copiar el código de la aplicación
COPY . .

# Instalar las dependencias de Laravel
RUN composer install

# Exponer el puerto
EXPOSE 9000
CMD ["php-fpm"]
