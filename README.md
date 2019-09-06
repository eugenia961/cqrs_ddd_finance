# cqrs_ddd_finance

Get data from the Yahoo Finance API for some companies and store it in databases to display a report.

## Languages

PHP 7

## Frameworks

Symfony 4

## Databases

Mysql

## AMQP

RabbitMQ

## Installation

To Run you need to enter the following folder /cqrs_ddd_finance and execute the following commands:

```bash

php bin/console doctrine:database:create

php bin/console doctrine:schema:drop -n -q --force --full-database && rm src/Migrations/*.php && php bin/console make:migration && php bin/console doctrine:migrations:migrate -n -q

php bin/console doctrine:fixtures:load



```

## Usage

```bash

php bin/console messenger:consume

php bin/console statistic
