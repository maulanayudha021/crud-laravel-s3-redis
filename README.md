# Laravel CRUD with Redis and S3 File Uploads
## This project provides a simple CRUD implementation for managing client data with the following features:
 
- Redis caching: Client data is cached in Redis using the client id as the key.
- S3 file uploads: Client logos are uploaded to Amazon S3 and their URLs are stored in the database.
- Soft deletion: When a client is deleted, the deleted_at timestamp is set, and the Redis cache is cleared.

## Prerequisites
Before you start, ensure you have the following installed:
 
- PHP >= 8.0
- Laravel 11
- Composer
- Redis
- Amazon S3 credentials

## Installation
Clone the repository (if applicable):
 
git clone https://github.com/maulanayudha021/crud-laravel-s3-redis
cd crud-laravel-s3-redis

## Install dependencies:
composer install

## Set up environment variables: 
Configure your .env file for database and Redis.
Set up the Amazon S3 credentials for file uploads.
env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
 
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
 
AWS_ACCESS_KEY_ID=your_aws_access_key
AWS_SECRET_ACCESS_KEY=your_aws_secret_key
AWS_DEFAULT_REGION=your_region
AWS_BUCKET=your_s3_bucket_name

## Run migrations:
php artisan migrate

## Clear any existing Redis data (optional):
php artisan cache:clear
php artisan redis:flushdb

## Conclusion
This application provides a simple and efficient way to manage client data with Redis caching for better performance and S3 file uploads for storing client logos. The code includes full CRUD operations, along with soft deletion and cache invalidation, to ensure data integrity and consistency.
