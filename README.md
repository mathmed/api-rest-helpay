<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## API Rest Helpay

Esta API desenvolvida utilizando o framework Laravel faz um gerenciamento simples de estoque e vendas, possuindo integração com o Google Drive.

#### Dependências

-   docker
-   docker-compose
-   composer

---

## Configuração

Com todas as dependências instaladas, primeiramente é necessário realizar um clone deste repositório:

```console
$ git clone https://github.com/mathmed/api-rest-helpay.git
```

Após isso, na pasta do projeto, utilize o comando:

```console
$ composer install
```

#### .env

Com o projeto clonado e instalado, configure as variáveis do sistema, para isso, renomeie o arquivo `.env.example` para `.env`. Feito isso, no arquivo `.env` você deve adicionar suas configurações de integração com email e Google Drive, para isso, altere o trexo a seguir:

```html
MAIL_MAILER=smtp MAIL_HOST=smtp.gmail.com MAIL_PORT=587 MAIL_ENCRYPTION=tls
MAIL_FROM_NAME='API Helpay' MAIL_TO=YOUR_RECEIVER_EMAIL
MAIL_FROM_ADDRESS=YOUR_SENDER_EMAIL MAIL_USERNAME=YOUR_SENDER_EMAIL
MAIL_PASSWORD=YOUR_SENDER_EMAIL_PASSWORD GOOGLE_APP_ID=YOUR_GOOGLE_APP_ID
GOOGLE_CLIENT_ID=YOUR_GOOGLE_CLIENT_ID
GOOGLE_CLIENT_SECRET=YOUR_GOOGLE_CLIENT_SECRET_KEY
GOOGLE_REDIRECT='http://localhost:8000/api/google/callback'
```

Para maior facilidade, mantenha as configurações de host do email e utilize e-mails do **Gmail** para envio e recebimento.
Para as configurações do Google, é necessário criar um projeto com acesso à API do drive e obter as credenciais. Caso esse passo seja complicado, posso fornecer minhas credenciais que já estão criadas.

#### Docker

Após configurar as variáveis de sistema, é necessário iniciar os containers Docker. Para isso, primeiramente execute dentro da pasta do projeto o comando:

```console
$ docker-compose build && docker-compose up -d
```

Este comando irá criar os todos os containers e iniciá-los.

#### Database

Na primeira vez que iniciar os containers Docker, utilize o comando abaixo para criar e popular o banco de dados.

```console
$ ./create_db.sh
```

Este arquivo executará os comandos de **migration** e **seed** do Laravel, dentro do container.
**_OBS: É recomendado esperar cerca de 1 à 2min para executar este comando após o início do Docker, isto porque o Docker geralmente demora alguns minutos para configurar tudo._**

## Código de Conduta

Para garantir que a comunidade Laravel seja bem-vinda a todos, por favor, reveja e cumpra o [Código de Conduta](https://laravel.com/docs/contributions#code-of-conduct).

## Vulnerabilidades de segurança

Se você descobrir uma vulnerabilidade de segurança no Laravel, envie um e-mail para Taylor Otwell via [mailto:taylor@laravel.com]. Todas as vulnerabilidades de segurança serão resolvidas imediatamente.

## Licensa

O framework Laravel é um software de código aberto licenciado sob a [Licensa MIT](https://opensource.org/licenses/MIT).
