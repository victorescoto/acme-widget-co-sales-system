# Acme Widget Co Sales System

This project is a simple sales system for Acme Widget Co, which manages products, special offers, and delivery charge rules. The system allows adding products to a shopping basket, applying special offers, and calculating the total cost, including delivery charges.

## Features

- **Product Management**: Add products to a shopping basket.
- **Special Offers**: Apply special offers such as "Buy one, get the second half price."
- **Delivery Charge Rules**: Calculate delivery charges based on the total value of the basket.

## Project Structure

```plaintext
.
├── src/
│   ├── Basket.php
│   ├── Product.php
│   ├── Delivery/
│   │   ├── LowCostDeliveryRule.php
│   │   ├── MidCostDeliveryRule.php
│   │   └── FreeDeliveryRule.php
│   ├── Offer/
│   │   └── BuyOneGetOneHalfPriceOffer.php
│   ├── Interfaces/
│   │   ├── DeliveryRuleStrategyInterface.php
│   │   └── SpecialOfferStrategyInterface.php
├── tests/
│   └── BasketTest.php
│   └── DeliveryChargeRuleTest.php
├── scripts/
│   └── playground.php
├── composer.json
└── README.md
```

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/your-repo/acme-widget-sales-system.git
   cd acme-widget-sales-system
   ```

## Running the Project with Docker

If you don't have PHP or Composer installed on your machine, you can use Docker to run the project.

### Prerequisites

Make sure you have [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/install/) installed on your machine.

### Running the Project

1. **Build the Docker container**:

   ```bash
   docker-compose build
   ```

2. **Run the Playground script**:

   ```bash
   docker-compose up app
   ```

   This will run the `playground.php` script in a Docker container, showing the total cost and any special offers applied.

### Running Tests

To run the tests using PHPUnit inside Docker, use the following command:

```bash
docker-compose up test
```

### Running Static Analysis

To run static analysis using PHPStan inside Docker, use the following command:

```bash
docker-compose up analyse
```

These commands ensure that the tests and analysis are run in the same consistent environment, regardless of the host system.

## How It Works

### 1. Product Configuration

Products are defined with a unique code, name, and price. For example:

```php
$redWidget = new Product(
    code: 'R01',
    name: 'Red Widget',
    price: 32.95
);
```

### 2. Delivery Rules

Delivery charges are based on the total value of the basket:

- Orders below $50 have a delivery charge of $4.95.
- Orders between $50 and $90 have a delivery charge of $2.95.
- Orders above $90 have free delivery.

### 3. Special Offers

Currently, one special offer is implemented:

- **Buy one, get the second half price**: If a customer buys two units of the same product, the second unit is offered at half price.

For example:

```php
$specialOffers = [
    new BuyOneGetOneHalfPriceOffer($redWidget)
];
```

### 4. Basket

Products can be added to a `Basket`, which calculates the total price including any special offers and delivery charges:

```php
$basket = new Basket(deliveryRules: $deliveryRules, specialOffers: $specialOffers);
$basket->add($redWidget);
$basket->add($redWidget);
$basket->add($greenWidget);

echo $basket->total();  // Outputs the total cost
```

## Assumptions

- **Single Product Offer Application**: The current special offer implementation applies to a single type of product. Future implementations could extend this to multiple product types.
- **Delivery Charges**: Delivery charges are applied after all discounts are calculated.
- **Fixed Pricing**: Prices are assumed to be fixed and not subject to dynamic changes (e.g., discounts that depend on external factors).
