# Use a imagem base do PHP 8.1-alpine
FROM php:8.1-alpine

# Instale as dependências do PHP
RUN apk add --no-cache autoconf gcc g++ make postgresql-dev

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie os arquivos de código-fonte para a imagem Docker
COPY . /app

# Defina o diretório de trabalho para o diretório raiz do projeto
WORKDIR /app

# Instale as dependências do Laravel
RUN composer install

# Gere o arquivo de configuração do Laravel
RUN php artisan key:generate

# Compile o CSS e o JavaScript da aplicação
RUN php artisan optimize

# Exponha a porta em que a aplicação estará escutando (porta 8000)
EXPOSE 8000

# Defina o ambiente da aplicação como production
ENV APP_ENV=production

# Inicie o servidor PHP embutido na porta 8000 (não é necessário definir, pois é padrão)
CMD ["php", "artisan", "serve"]
