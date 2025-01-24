# LaravelPetStoreRestApi

### Struktura projektu

- [docker](../docker-laravel-main/docker) Pliki z konfiguracjami dockera
- [app](src/app)  Aplikacja
    - [DTO](src/app/DTO) "Klasy transformujące"
    - [Enum](src/app/Enum) Enumy
    - [Exceptions](src/app/Exceptions) Wyjątki
    - [Http](src/app/Http) Pliki odpowiadające za warstwę komunikacji
    - [Mappers](src/app/Mappers) Mappery
    - [Models](src/app/Models) Modele
    - [Providers](src/app/Providers) Providers
    - [Services](src/app/Services) Serwisy
### Uruchomienie aplikacji
1. Zmień .env.example to .env
2. Uruchom komendę ```docker compose build```
3. Następnie ```docker compose up -d```
4. Przejdź do storny http://localhost

Jeżeli wyskakiwałby byłąd "access Forbidden"
```
  docker compose run --rm php /bin/sh
  chown -R laravel:laravel /var/www/html
```

Dostęp do commandLine
```docker compose run --rm php /bin/sh```


  

