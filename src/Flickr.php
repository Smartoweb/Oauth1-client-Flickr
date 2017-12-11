<?php
namespace smartflickr\OAuth1\Client\Server;

use League\Oauth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Credentials\TemporaryCredentials;
use GuzzleHttp\Exception\BadResponseException;
use League\OAuth1\Client\Credentials\CredentialsInterface;


class Flickr extends Server
{

    const API_URL = "https://www.flickr.com/";
    const USER_API_URL = "https://api.flickr.com/services/rest/";

    /**
     * Get the URL for retrieving temporary credentials.
     *
     * @return string
     */
    public function urlTemporaryCredentials()
    {
        return self::API_URL . 'services/oauth/request_token';
    }

    /**
     * Get the URL for redirecting the resource owner to authorize the client.
     *
     * @return string
     */
    public function urlAuthorization()
    {
        return  self::API_URL . 'services/oauth/authorize';
    }

    /**
     * Get the URL retrieving token credentials.
     *
     * @return string
     */
    public function urlTokenCredentials()
    {
        return self::API_URL . 'services/oauth/access_token';
    }

    public function getActivitySummary(TokenCredentials $tokenCredentials, $params)
    {
        $client = $this->createHttpClient();
        $query = http_build_query($params);
        $query = '/activities?' . $query;
        $headers = $this->getHeaders($tokenCredentials, 'GET', self::USER_API_URL . $query);
        try {
            $response = $client->get(self::USER_API_URL . $query, [
                'headers' => $headers
            ]);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            $body = $response->getBody();
            $statusCode = $response->getStatusCode();

            throw new \Exception(
                "Received error [$body] with status code [$statusCode] when retrieving activity summary."
            );
        }
        return $response->getBody()->getContents();
    }

    public function urlUserDetails()
    {
    }

    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
    }

    public function userUid($data, TokenCredentials $tokenCredentials)
    {
    }

    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
    }

    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
    }
}
