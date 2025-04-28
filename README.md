# Exchange Web Service
Test task for Boomerang Media — a simple currency exchange web service using cURL, SQLite, and REST endpoints, powered by the Frankfurter API.

### Prerequisites

Before running the application, make sure you have the following installed on your system:

- Docker v 28.1.1

### Installation

1. Clone the repository to your local machine:

   ```bash
    git clone git@github.com:ArenGr/exchange-rates-api.git

2. Run the command:

   ```bash
    make up

The service will be accessible at http://localhost:8080.

## Endpoints

### 1. `/base/{currency}`

**Method**: `GET`

This endpoint returns exchange rates for the given base currency.

- **Parameters**:
   - `currency`: The base currency (e.g., usd, eur).

**Response**:
- If successful, returns a JSON object containing the exchange rates for the base currency.
- If the currency is not found or an error occurs, it returns a JSON error message with a `404` or `500` status.

Example:
```bash
GET http://localhost:8080/base/usd
```

### 2. `/`

**Method**: `GET`

This endpoint returns the list of available exchange rates.

Example:
```bash
GET http://localhost:8080
