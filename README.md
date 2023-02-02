# Rekamy Generator

## features proposal

- Operates via yaml file
- Extracts existing table schemas from DB into yaml file
- Runs migration into specified DB connection

## migration

1. run `php artisan reka:scan` in terminal
2. read from existing DB
3. dump schema from existing DB into a single yaml file
4. edits / adjusts yaml schema accordingly
5. reads adjusted yaml schema and generate migrations accordingly



## backend

1. run `php artisan reka:backend` in terminal
2. reads from yaml schema and generate backend accordingly

## frontend

1. run `php artisan reka:frontend` in terminal
2. reads from yaml schema and generate frontend accordingly

## l5-swagger

1. run `php artisan reka:swagger` in terminal
2. reads from yaml schema and generate api documentation accordingly