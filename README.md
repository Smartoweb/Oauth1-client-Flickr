#IN DEV!!

# Oauth1-client-Flickr
 Flickr Oauth1 client provider for thephpleague/oauth1-client
 
## Installation

```
composer require smartoweb/flickroauth1
```

## Usage

Usage is the same as The League's OAuth client, using `techgyani\OAuth1\Client\Server\Flickr` as the provider.

```php
$server = new smartoweb\OAuth1\Client\Server\Flickr([
    'identifier'   => 'your-client-id',
    'secret'       => 'your-client-secret',
    'callback_uri' => 'http://callback.url/callback',
]);
```

// Retrieve temporary credentials
```php
$temporaryCredentials = $server->getTemporaryCredentials();

// Store credentials in the session, we'll need them later
$_SESSION['temporary_credentials'] = serialize($temporaryCredentials);
session_write_close();

// Second part of OAuth 1.0 authentication is to redirect the
// resource owner to the login screen on the server.
$server->authorize($temporaryCredentials);
```


