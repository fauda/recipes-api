# recipes-api

A recipe API to store and fetch recipe data with ratings system.

## How to use

### Installation
    
`composer install`

Copy and edit .env.example

`cp .env.example .env`

### Endpoints

If you aren't sure what is in the json payload then try it with an empty json object to see what is required.

1. Get a recipe with an id of 1

`GET /recipes/1`

2. Get a paginated recipe list with max results of 2 and after a the 4th one

`GET /recipes?max_results=2&after=4`

3. Update the recipe with an id of 5 (json payload )

`PUT /recipes/5`

4. Store a new recipe (json payload)

`POST /recipes`

5. Rating a recipe with an id of 5 (json payload)

`POST /recipes/5/ratings`

## Why Laravel?

Mostly due to the fact that it is the framework I know best, it met all the requirements and it's a good framework.
Also API's with pagination, validation and transformation start to get complicated so I didn't for a micro framework.

## Different API consumers

I don't think an API should care what is consuming it beyond authentication and authorization.
If it's a mobile app or front-end website it should behave the exact same way but if requirements are vastly
different then they need seperate endpoints.

### Core packages on top of Laravel used

* League/Fractal
* League/CSV

## Testing

Needs better coverage but: `phpunit`

## Docker (port 8000)

Run the following for quick startup assuming you have docker-compose installed:

`docker-compose up -d & chmod 777 -R storage & chmod 777 bootstrap/cache`