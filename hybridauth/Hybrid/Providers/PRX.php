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
		$this->api->api_base_url  = "https://www.prx.org";
		$this->api->authorize_url = "https://www.prx.org/oauth/authorize";
		$this->api->token_url     = "https://www.prx.org/oauth/access_token"; 

		$this->api->sign_token_name = "oauth_token";
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		$response = $this->api->api( "/me" ); 

		// check the last HTTP status code returned
		if ( $this->api->http_code != 200 ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an error. " . $this->errorMessageByStatus( $this->api->http_code ), 6 );
		}

		if ( ! is_object( $response ) || ! isset( $response->id ) ){
			throw new Exception( "User profile request failed! {$this->providerId} api returned an invalid response.", 6 );
		}

		$data = $data->response->info;

		$this->user->profile->identifier    = (property_exists($data,'id'))?$data->id:"";
		$this->user->profile->firstName     = (property_exists($data,'first_name'))?$data->first_name:"";
		$this->user->profile->lastName      = (property_exists($data,'last_name'))?$data->last_name:"";
		$this->user->profile->displayName   = (property_exists($data,'login'))?$data->login:"";
		$this->user->profile->email         = (property_exists($data,'email'))?$data->email:"";
		$this->user->profile->emailVerified = (property_exists($data,'email'))?$data->email:"";

		return $this->user->profile;
	}
}
