# parent-assessment
Challenge Idea

User Transactions API
This API allows you to retrieve user transactions from multiple payment providers, such as DataProviderX and DataProviderY.

Endpoints
GET /api/v1/users
Retrieves all users and their transactions from all payment providers.

Parameters
provider (optional): Filter results by payment provider. Example: /api/v1/users?provider=DataProviderX
statusCode (optional): Filter results by transaction status code (authorised, decline, or refunded). Example: /api/v1/users?statusCode=authorised
balanceMin (optional): Filter results by minimum transaction amount. Example: /api/v1/users?balanceMin=10
balanceMax (optional): Filter results by maximum transaction amount. Example: /api/v1/users?balanceMax=100
currency (optional): Filter results by transaction currency. Example: /api/v1/users?currency=USD
You can combine multiple filters together to narrow down your results. Example: /api/v1/users?provider=DataProviderX&statusCode=authorised&balanceMin=10&balanceMax=100&currency=USD
