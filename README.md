# Documentação

## Clonar repositório

```shell
$ git clone https://github.com/lenardo05/dokd.git
```

## Executar gerenciador de pacotes

```shell
$ composer install
$ npm install
```

## Configurar .env

Renomeie o arquivo .env.example para .env adicione os dados para o acesso ao banco

## Gerar key

Definir uma nova chave no seu arquivo .env

```shell
$ php artisan key:generate
```

## Tabelas e Seeders

Para executar o aplicativo migrations e propagar a tabela status em um único comando

```shell
$ php artisan migrate --seed
```

## Baixar e Configurar Tradução

Carregar tradução pt-br

1. Instale o pacote

```shell
$ composer require lucascudo/laravel-pt-br-localization --dev
```

2. Publique as traduções

```shell
$ php artisan vendor:publish --tag=laravel-pt-br-localization
```

3. Configure o Framework para utilizar 'pt_BR' como linguagem padrão

```
// Altere Linha 83 do arquivo config/app.php para:
'locale' => 'pt_BR',
```

## Configurar Sanctum

Abra o arquivo config/sanctum.php e adicione seu domínio a esta lista

```shell
'stateful' => explode(',', env(
    'SANCTUM_STATEFUL_DOMAINS',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1,laravel.test'
)),
```

## Executar comandos

Executar comandos para iniciar o projeto

```shell
# terminal 1
$ php artisan serve

# terminal 2
$ npm run watch
```
