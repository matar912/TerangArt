# 1. Image PHP avec extensions pour Laravel
FROM php:8.3-fpm

# 2. Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    vim \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip bcmath

# 3. Installer Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# 4. Installer Node.js et npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 5. Définir le dossier de travail
WORKDIR /var/www

# 6. Copier les fichiers du projet
COPY . .

# 7. Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 8. Installer les dépendances JS
RUN npm install

# 9. Build frontend avec Vite
RUN npm run build

# 10. Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# 11. Expose port 9000 (PHP-FPM)
EXPOSE 9000

# 12. Commande par défaut
CMD ["php-fpm"]
