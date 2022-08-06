
# BigBlueButton API integration with laraval
This is a laravel wrapper for BigBlueButton API
## Requirements

- Laravel 9.23 or above.

## Installation

Require package in your composer.json and update composer.  This downloads the package and the official bigbluebutton php library. 

```
composer require davido/bbb-api
```

## Usage

You can define Big blue button secret key and server url in two ways. 
1. Define in .env file

 ```BBB_SECURITY_SALT =bbb_secret_key```  
 ```BBB_SERVER_BASE_URL=https://example.com/bigbluebutton/```
 
 2. Define in config/bbb.php
 
```
 'BBB_SECURITY_SALT' => 'bbb_secret_key',
 'BBB_SERVER_BASE_URL' => 'https://example.com/bigbluebutton/',
```

 3. You can publish the vendor files with
 
```
php artisan vendor:publish --provider="DavidO\BBBApi\BigbluebuttonProviderService" --tag="config"
```

Note this will create the file bbb.php in the config folder