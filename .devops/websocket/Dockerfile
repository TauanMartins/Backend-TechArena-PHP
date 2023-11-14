# ---- Estágio final ----

# Utiliza a imagem php:8.1-alpine como imagem base para o estágio final
FROM php:8.1-alpine  

# Copia os arquivos e dependências do estágio de construção para o estágio final
COPY . /app

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
EXPOSE 6001

# Inicia o servidor embutido do PHP na porta 8000 acessível fora do container;
CMD ["php", "artisan", "websockets:serve"]