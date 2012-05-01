<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2011 HybridAuth authors | hybridauth.sourceforge.net/licenses.html
*/

/**
 * Hybrid_Providers_PRX provider adapter based on OAuth2 protocol
 * 
 * http://hybridauth.sourceforge.net/userguide/IDProvider_info_PRX.html
 */
class Hybrid_Providers_PRX extends Hybrid_Provider_Model_OAuth2
{ 
	/**
	* IDp wrappers initializer 
	*/
	function initialize() 
	{
		parent::initialize();

		// Provider apis end-points
		$this->api->api_base_url  = "https://www.prx.org/v2/";
		$this->api->authorize_url = "https://www.prx.org/oauth/authorize";
		$this->api->token_url     = "https://www.prx.org/oauth/access_token"; 

		$this->api->sign_token_name = "oauth_token";
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
/**		$data = $this->api->api( "/me" ); 

		if ( ! isset( $data->response->user->id ) ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an invalide response.", 6 );
		}

		$data = $data->response->user;

		$this->user->profile->identifier    = $data->id;
		$this->user->profile->firstName     = $data->firstName;
		$this->user->profile->lastName      = $data->lastName;
		$this->user->profile->displayName   = trim( $this->user->profile->firstName . " " . $this->user->profile->lastName );
		$this->user->profile->photoURL      = $data->photo;
		$this->user->profile->profileURL    = $data->canonicalUrl;
		$this->user->profile->gender        = $data->gender;
		$this->user->profile->city          = $data->homeCity;
		$this->user->profile->email         = $data->contact->email;
		$this->user->profile->emailVerified = $data->contact->email;

**/
		return $this->user->profile;
	}
}
