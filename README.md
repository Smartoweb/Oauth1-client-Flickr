# Oauth1-client-Flickr
 Flickr Oauth1 client provider for thephpleague/oauth1-client (see [https://github.com/thephpleague/oauth1-client](https://github.com/thephpleague/oauth1-client))
 
## Installation

```
composer require smartoweb/flickroauth1
```

## Usage

Usage is the same as The League's OAuth client, using `smartoweb\OAuth1\Client\Server\Flickr` as the provider.

1/ Initialize and store server class

```php
$server = new smartoweb\OAuth1\Client\Server\Flickr([
    'identifier'   => 'your-client-id',
    'secret'       => 'your-client-secret',
    'callback_uri' => 'http://callback.url/callback',
]);
...store $server for use it in callback_uri function
```

2/ Retrieve and store temporary credentials, and redirect user to Flickr autorization screen
```php
   $temporaryCredentials=$server->getTemporaryCredentials();
   ...store $temporaryCredentials for use it in callback_uri function
			$server->authorize($state);
```
 
3/ In callback_uri function get Oauth1 $token
```php
				$oauth_token=!empty($_GET['oauth_token'])?$_GET['oauth_token']:'';
				$oauth_verifier=!empty($_GET['oauth_verifier'])?$_GET['oauth_verifier']:'';
				if ($oauth_token!='' && $oauth_verifier!='') {
						$server=...stored $server
      $temporaryCredentials=...stored $temporaryCredentials
						$token = $server->getTokenCredentials($temporaryCredentials, $oauth_token, $oauth_verifier);
    ...store $token  
				}
```

