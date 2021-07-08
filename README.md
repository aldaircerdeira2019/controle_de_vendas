# controle_de_vendas

### Tecnologias utilizadas:

- Laravel 8
- Docker
- VueJs 2
- Bootstrap 4.6

### Instalação
1 - Clonar repositorio
```bash
$ git clone https://github.com/aldaircerdeira2019/controle_de_vendas.git
```

2 - criar arquivo .env igual o .env.example
```bash
DB_CONNECTION=mysql
DB_HOST=mysql-app
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=laravel
```
3 - rodar o docker
```bash
docker-compose up -d
```
4 - rodar as migrations e seed
```bash
docker-compose exec laravel-app bash -c "php artisan migrate:fresh --seed"
```

5 - host http://localhost:8080/

### usuario para admin

    email      = admin@admin
    password   = 12345678

### usuario empresa
           
    email = admin@empresa
    password = 12345678


obs: 

- se alterar a porta é necessario altera tambem no arquivo de configuração do sanctum, senão a autenticação não vai funcionar.
