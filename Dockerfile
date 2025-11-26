FROM php:8.3-fpm

# Встановлюємо системні залежності
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev

# Очищаємо кеш
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Встановлюємо PHP розширення
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Встановлюємо робочу директорію
WORKDIR /var/www

# Додаємо виняток для git (виконуємо до зміни користувача)
RUN git config --global --add safe.directory /var/www

# Створюємо необхідні директорії з правильними правами
RUN mkdir -p /var/www/var /var/www/vendor && \
    chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
