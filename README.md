
# Integração com o API do mercado livre


## Requisitos
* PHP 8.2 ou superior
* Laravel 11.31
* Composer
* Laravel Sail
 


## Caso precise preparar o Sail
 - Este projeto requer o uso do Sail para seu funcionamento.

 ```
    # Para Instalar o sail
    php artisan sail:install
 ```
 ```
    # Atribuindo um alias para o sail
    alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
 ```


## inicialização

 ```
    # Para subir o projeto
    sail up -d 
 ```

 ```
    # Migrar as tables
    sail artisan migrate
 ```
 ```
    # Seed as tables
    sail artisan db:seed
 ```
 ```
    # Caso queira parar o projeto
    sail stop
 ```