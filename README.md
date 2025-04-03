# blink

A lightweight PHP backend inspired by Facebook, featuring user signup/signin, post creation, and feed retrieval. It uses a Laravel-like routing system and secures protected routes with JWT authentication. Built with PHP 8.1, MySQL, and Docker, this project is the foundation for a full-stack social media app.
Features

  - User Management: Signup, signin (returns JWT token), fetch user profiles.
  - Post Management: Create posts (authenticated), fetch feed (public).
  - REST API: Endpoints for /signup, /signin, /post, /feed, /user.
  - Authentication: JWT-based middleware for protected routes (e.g., /post).
  - Routing: Laravel-like routing with Route::get(), Route::post(), and middleware().
  - Security: Password hashing (Bcrypt), JWT token expiration.

## Future Planning

  - Frontend (React): Build a React frontend for user signup/signin, post creation, and feed/profile viewing, integrating with the REST API.
  - GraphQL API: Add a /graphql endpoint for queries (e.g., feed, user) and mutations (e.g., createPost), using webonyx/graphql-php.
  - C++ with HHVM: Migrate the PHP runtime to HHVM (HipHop Virtual Machine) for better performance, leveraging C++ for critical components like feed retrieval.
  - Erlang for Real-Time: Introduce an Erlang microservice for real-time features (e.g., chat, notifications) using its actor model for high concurrency.
  - GraphQL Subscriptions: Enable real-time updates (e.g., new post notifications) via WebSockets.
  - Route Parameters: Support dynamic routes (e.g., /user/{id}).
  - Dependency Injection: Add a service container for dependency injection.
