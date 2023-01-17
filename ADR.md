# ADR (Architecture Decission Record)
This file documents major architecture and design decissions, alongside with explanations of each.
These decissions support well structured application, that inspires maintiblity and supports futher extensions on business requirements.

## Extensibity of Supported Currencies
As per task request, our application currently supports payment in USD and purchase of JPY, GPB and EUR.
However, implemented database structure and application structure, make a configurble system, where it is extremly easy to add support for any other currency pairs.

List of supported currencies is stored in ```currencies``` table. Column ```can_be_sold``` marks currency that can be sold, and collumn ```can_be_bought``` marks supported payment currency.

## Exchange Rates
Exchange Rates data is cached in database layer, in order to avoid expensive calls to third party APIs (CurrencyLayer.com)
We keep track of current exchange rate for currency pairs, as well as historical data. Column ```effective_date``` marks date on which exchange rate was effective.

Data is stored in table ```exchange_rates```. Currency pairs are split into two parts.

For example, currency pair USDEUR, is split into base currency(USD) and quote currency(EUR), alongside with the exchange rate (0.92).

## Application layering
In accordance with SoC principle, our application is split in different layers. Depending on the different resposbility they have.

1. Controller
2. Service
3. Repository

### Controllers
Controllers are split into Web and API controlers, residing in different namespaces. Using either routes/web.php or routes/api.php

Controllers are responsibile to handle users' request, delegate action to another class (service) and return response in correct format.

### Services
Services are the place where we store our business logic. Services are usually called from controllers or other classes.
Services are responsible for performing specific actions and returning given response.

### Repositories
Repository layer seperates database access from busisness logic. It is responsible for fetching data from database layer.

For examples see: CurrencyRepository, ExchangeRateRepository

Benefits of this approach:
1. Seperation of concerns
2. Place to to store complex SQL queries
3. Caching (Easier caching implementation)

## Dependency injection
All class dependencies are injected using dependency injection. Leverging Laravel's IoC container and Service Providers.
This follows SOLI**D** principles and also makes for easier Unit testing. As different dependencies can easily be mocked.

For example ```ExchangeRatesGateway``` is binded to ```CurrencyLayerGateway``` as specific implemention, in ```ExchangeRatesServiceProvider```.
Meaning in future, its easy to swap implementation for another Exchange Rates API. Or even to use different API providers depending on certain conditions.
ExchangeRatesGateway is an interface that defines specific functions that any future Exchange Rate API must implement.

## Implemented design patterns
Few design patterns are demonstrated in this application. Some of those include:

### Factory
Factory pattern is used as a helper, that generates PostOrderStrategy, so that post order strategy is created based on currency id.

### Strategy
Strategy pattern is used for post order save action. We create different instances of PostOrderStrategy, based on currency type.
Concrete implementations of given strategy perform different actions based on currency type.

### Builder pattern
Builder pattern is responsible for order creation logic. It specifices exact steps required in order to create an order object.

### Chain of commmand
As builder pattern uses method chaining. That passes an order object along a chain of handlers. It is easy to add a new step or remove existing step in order creation process.

For example:

```
$orderBuilder->applyDiscount()->applyAnotherTypeOfDiscount()
```


