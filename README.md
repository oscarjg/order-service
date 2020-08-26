## SETUP

Setup env vars according to your needs and run docker with docker-compose

```
> cp .env.dist .env
> docker-compose up
```

## HTTP ENDPOINTS
```
curl -X POST http://localhost:8099/orders/create \
-H "Content-Type:application/json" \
-d '
{
    "orderLines": [
        {
            "sku": "foo",
            "price": 12,
            "quantity": 1
        },
        {
            "sku": "bar",
            "price": 5,
            "quantity": 2
        }
    ]
}
'
```
```
curl -X POST http://localhost:8099/orders/confirm/{ORDER_ID} -H "Content-Type:application/json"
```

## RUNNING TEST
```
docker-compose exec php bin/phpunit
```