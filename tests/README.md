# Symfony6 JWT authentication with refresh Token (cookie)

*(Docker, Ngnix, PHP8, Symfony6, Xdebug, PHPUnit)*

*(JWT and refresh token configuration for Symfony projects)*

## How to use
1.Build Docker images based on the configuration defined in the docker-compose.yml

    make build (docker-compose build) 

2.Start containers and run composition for all services defined in the docker-compose.yml

     make up (docker-compose up)

3.Stop and delete containers

    make down (docker-compose down)

4.Enter to your container (bush)

    make app_bash  (docker-compose exec -u www-data php bash)

5.Start tests

    php bin/phpunit


## Useful commands
1.Generate the SSL keys (private and public)

    php bin/console lexik:jwt:generate-keypair

2.Revoke all invalid (datetime expired) refresh tokens you can execute

    php bin/console gesdinet:jwt:clear

3.Revoke a refresh token
    
    php bin/console gesdinet:jwt:revoke TOKEN


## Links

* [LexikJwtToken](https://github.com/lexik/LexikJWTAuthenticationBundle) Lexik JWTAuthentication Bundle
* [RefreshToken](https://github.com/markitosgv/JWTRefreshTokenBundle) Refresh Token Bundle