<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Oauth2;
use Facebook\Facebook;
use League\OAuth2\Client\Provider\LinkedIn;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Exception;

class SocialLoginController extends Controller
{
    protected $googleClient;
    protected $google_secret;
    protected $google_redirect_url;

    protected $facebookClient;
    protected $facebook_secret;
    protected $facebook_redirect_url;

    protected $linkedinClient;
    protected $linkedin_secret;
    protected $linkedin_redirect_url;
    
    protected $githubClient;
    protected $twitterClient;

    public function __construct()
    {
        $this->googleClient = env('GOOGLE_CLIENT_ID');
        $this->google_secret = env('GOOGLE_SECRET');
        $this->google_redirect_url = env('GOOGLE_REDIRECT');

        $this->facebookClient = env('FACEBOOK_CLIENT_ID');
        $this->facebook_secret = env('FACEBOOK_SECRET');
        $this->facebook_redirect_url = env('FACEBOOK_REDIRECT');

        $this->linkedinClient = env('LINKEDIN_CLIENT_ID');
        $this->linkedin_secret = env('LINKEDIN_SECRET');
        $this->linkedin_redirect_url = env('LINKEDIN_REDIRECT');
    }

    public function googleLogin()
    {
        $google_client = new Google_Client();
        $google_client->setClientId($this->googleClient);
        $google_client->setClientSecret($this->google_secret);
        $google_client->setRedirectUri($this->google_redirect_url);
        $google_client->addScope('email');
        $google_client->addScope('profile');

        // Redirect to Google OAuth login page
        return redirect()->to($google_client->createAuthUrl());
    }

    public function googleSignUp()
    {
        // Handle Google callback after login
        $google_client = new Google_Client();
        $google_client->setClientId($this->googleClient);
        $google_client->setClientSecret($this->google_secret);
        $google_client->setRedirectUri($this->google_redirect_url);

        if ($this->request->getGet('code')) {
            $token = $google_client->fetchAccessTokenWithAuthCode($this->request->getGet('code'));
            $google_service = new Google_Service_Oauth2($google_client);
            $profile = $google_service->userinfo->get();
            
            // Process user data (e.g., register user, store in session)
            // Example: store user info in session
            session()->set('user', $profile->getEmail());

            // Redirect to success page or return JSON response
            return redirect()->to('/profile');
        } else {
            return $this->sendError('Failed to authenticate with Google.');
        }
    }

    public function facebookLogin()
    {
        $facebook = new Facebook([
            'app_id' => $this->facebookClient,
            'app_secret' => $this->facebook_secret,
            'default_graph_version' => 'v12.0',
        ]);

        $loginUrl = $facebook->getRedirectLoginHelper()->getLoginUrl($this->facebook_redirect_url, ['email']);

        // Redirect to Facebook OAuth login page
        return redirect()->to($loginUrl);
    }

    public function facebookSignUp()
    {
        // Handle Facebook callback after login
        $facebook = new Facebook([
            'app_id' => $this->facebookClient,
            'app_secret' => $this->facebook_secret,
            'default_graph_version' => 'v12.0',
        ]);

        $helper = $facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken($this->facebook_redirect_url);
            $response = $facebook->get('/me?fields=id,name,email', $accessToken);
            $profile = $response->getGraphUser();

            // Process user data (e.g., register user, store in session)
            // Example: store user info in session
            session()->set('user', $profile->getEmail());

            // Redirect to success page or return JSON response
            return redirect()->to('/profile');
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            return $this->sendError('Graph API returned an error: ' . $e->getMessage());
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return $this->sendError('Facebook SDK returned an error: ' . $e->getMessage());
        }
    }

    public function linkedInLogin()
    {
        $provider = new LinkedIn([
            'clientId' => $this->linkedinClient,
            'clientSecret' => $this->linkedin_secret,
            'redirectUri' => $this->linkedin_redirect_url,
        ]);

        // Generate authorization URL
        $authorizationUrl = $provider->getAuthorizationUrl();

        // Redirect to LinkedIn OAuth login page
        return redirect()->to($authorizationUrl);
    }

    public function linkedInSignUp()
    {
        // Handle LinkedIn callback after login
        $provider = new LinkedIn([
            'clientId' => $this->linkedinClient,
            'clientSecret' => $this->linkedin_secret,
            'redirectUri' => $this->linkedin_redirect_url,
        ]);

        if (!empty($this->request->getGet('code'))) {
            try {
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $this->request->getGet('code'),
                ]);

                $me = $provider->getResourceOwner($accessToken);

                // Process user data (e.g., register user, store in session)
                // Example: store user info in session
                session()->set('user', $me->toArray());

                // Redirect to success page or return JSON response
                return redirect()->to('/profile');
            } catch (IdentityProviderException $e) {
                return $this->sendError('Failed to authenticate with LinkedIn: ' . $e->getMessage());
            }
        } else {
            return $this->sendError('Authorization code not found.');
        }
    }

    public function googleCallback(Request $request)
    {

    }

    public function facebookCallback(Request $request)
    {

    }

    public function linkedinCallback(Request $request)
    {

    }

    public function gitHubLogin(Request $request)
    {

    }

    public function gitHubCallback(Request $request)
    {

    }

    public function twittrLogin(Request $request)
    {

    }

    public function twitterCallback(Request $request)
    {

    }
}
