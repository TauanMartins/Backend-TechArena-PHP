# ---- Estágio de construção ----

# Utiliza a imagem mais recente do Composer como imagem base para o estágio de construção
FROM composer:latest AS build  

# Define /app como o diretório de trabalho
WORKDIR /app  

# Copia os arquivos do diretório atual para o diretório /app no container
COPY . /app 

# Instala as dependências do projeto usando o Composer;
# Instala os headers do Linux necessários para algumas dependências
RUN composer clearcache && composer install -o && composer diagnose && \  
    apk add --no-cache linux-headers  

# ---- Estágio final ----

# Utiliza a imagem php:8.1-alpine como imagem base para o estágio final
FROM php:8.1-alpine  

# Copia os arquivos e dependências do estágio de construção para o estágio final
COPY --from=build /app /app  

# Define /app como o diretório de trabalho
WORKDIR /app 

# Instala as dependências necessárias para a extensão pdo_pgsql;
# Instala as extensões pdo, pgsql e pdo_pgsql;
# Gera a chave de aplicação do Laravel;
# Otimiza a aplicação Laravel;
RUN apk add --no-cache autoconf gcc g++ make postgresql-dev && \  
    docker-php-ext-install pdo pgsql pdo_pgsql  && \  
    php artisan key:generate && \ 
    php artisan optimize 
    
# Expõe a porta 8000 do container;
EXPOSE 8000 

# Inicia o servidor embutido do PHP na porta 8000 acessível fora do container;
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]  