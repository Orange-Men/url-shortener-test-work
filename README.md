## Tasks
1. The service consists of 2 pages:
   - Page with link entry form + parameters (redirection limit, lifetime)
   - 404 page (if link is no longer valid)
2. Bootstrap is used for front
3. All links have the following parameters:
   - Redirection limit - maximum number of redirections per link. 0 = no limit 
   - Link Lifetime - set by user and maximum 24 hours
4. When lifetime of link expires or transition limit is reached, service redirects to the page 404

## Setup guide
1. ~~Create .env file~~ Done
2. `composer install`
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail php artisan migrate`
