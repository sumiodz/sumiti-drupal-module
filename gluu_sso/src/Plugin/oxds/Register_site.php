<?php
	
	/**
	 * Gluu-oxd-library
	 *
	 * An open source application library for PHP
	 *
	 *
	 * @copyright Copyright (c) 2017, Gluu Inc. (https://gluu.org/)
	 * @license	  MIT   License            : <http://opensource.org/licenses/MIT>
	 *
	 * @package	  Oxd Library by Gluu
	 * @category  Library, Api
	 * @version   3.0.0
	 *
	 * @author    Gluu Inc.          : <https://gluu.org>
	 * @link      Oxd site           : <https://oxd.gluu.org>
	 * @link      Documentation      : <https://oxd.gluu.org/docs/libraries/php/>
	 * @director  Mike Schwartz      : <mike@gluu.org>
	 * @support   Support email      : <support@gluu.org>
	 * @developer Volodya Karapetyan : <https://github.com/karapetyan88> <mr.karapetyan88@gmail.com>
	 *
	 
	 *
	 * This content is released under the MIT License (MIT)
	 *
	 * Copyright (c) 2017, Gluu inc, USA, Austin
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be included in
	 * all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	 * THE SOFTWARE.
	 *
	 */

	/**
	 * Client Register_site class
	 *
	 * Class is connecting to oxd-server via socket, and registering site in gluu server.
	 *
	 * @package		  Gluu-oxd-library
	 * @subpackage	Libraries
	 * @category	  Relying Party (RP) and User Managed Access (UMA)
	 * @see	        Client_Socket_OXD_RP
	 * @see	        Client_OXD_RP
	 * @see	        Oxd_RP_config
	 */
	
	namespace Drupal\gluu_sso\Plugin\oxds;
	use Drupal\gluu_sso\Plugin\oxds\Client_OXD_RP;
	class Register_site extends Client_OXD_RP
	{
	    /**
	     * @var string $request_op_host                         Gluu server url
	     */
	    private $request_op_host = null;
	    /**
	     * @var string $request_authorization_redirect_uri      Site authorization redirect uri
	     */
	    private $request_authorization_redirect_uri = null;
	    /**
	     * @var string $request_client_id                       OpenID provider client id
	     */
	    private $request_client_id = null;
	    /**
	     * @var string $request_client_name                     OpenID provider client name
	     */
	    private $request_client_name = null;
	    /**
	     * @var string $request_authorization_redirect_uri      OpenID provider client secret
	     */
	    private $request_client_secret = null;
	    /**
	     * @var string $request_post_logout_redirect_uri             Site logout redirect uri
	     */
	    private $request_post_logout_redirect_uri = null;
	    /**
	     * @var string $request_application_type                web or mobile
	     */
	    private $request_application_type = 'web';
	    /**
	     * @var array $request_acr_values                       Gluu login acr type, can be basic, duo, u2f, gplus and etc.
	     */
	    private $request_acr_values = array();
	    /**
	     * @var string $request_client_jwks_uri
	     */
	    private $request_client_jwks_uri = '';
	    /**
	     * @var string $request_client_token_endpoint_auth_method
	     */
	    private $request_client_token_endpoint_auth_method = '';
	    /**
	     * @var array $request_client_sector_identifier_uri
	     */
	    private $request_client_sector_identifier_uri = '';
	    /**
	     * @var array $request_client_request_uris
	     */
	    private $request_client_request_uris = null;
	    /**
	     * @var array $request_contacts
	     */
	    private $request_contacts = null;
	    /**
	     * @var array $request_scope                            For getting needed scopes from gluu-server
	     */
	    private $request_scope = array();
	    /**
	     * @var array $request_grant_types                     OpenID Token Request type
	     */
	    private $request_grant_types = array();
	    /**
	     * @var array $request_response_types                   OpenID Authentication response types
	     */
	    private $request_response_types = array();
	    /**
	     * @var array $request_client_logout_uris
	     */
	    private $request_client_logout_uris = null;
	    /**
	     * @var array $request_ui_locales
	     */
	    private $request_ui_locales = null;
	    /**
	     * @var array $request_claims_locales
	     */
	    private $request_claims_locales = null;
	    /**
	     * Response parameter from oxd-server
	     * It is basic parameter for other protocols
	     *
	     * @var string $response_oxd_id
	     */
	    private $response_oxd_id;
	
	    /**
	     * Response parameter from oxd-server
	     *
	     * @var string $response_op_host
	     */
	    private $response_op_host;
	
	    /**
	     * Constructor
	     *
	     * @return	void
	     */
	    public function __construct()
	    {
	        parent::__construct(); // TODO: Change the autogenerated stub
	        $this->setRequestApplicationType();
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestClientName()
	    {
	        return $this->request_client_name;
	    }
	
	    /**
	     * @param string $request_client_name
	     */
	    public function setRequestClientName($request_client_name)
	    {
	        $this->request_client_name = $request_client_name;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestClientSecret()
	    {
	        return $this->request_client_secret;
	    }
	
	    /**
	     * @param string $request_client_secret
	     */
	    public function setRequestClientSecret($request_client_secret)
	    {
	        $this->request_client_secret = $request_client_secret;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestClientId()
	    {
	        return $this->request_client_id;
	    }
	
	    /**
	     * @param string $request_client_id
	     */
	    public function setRequestClientId($request_client_id)
	    {
	        $this->request_client_id = $request_client_id;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestOpHost()
	    {
	        return $this->request_op_host;
	    }
	
	    /**
	     * @param string $request_op_host
	     * @return void
	     */
	    public function setRequestOpHost($request_op_host)
	    {
	        $this->request_op_host = $request_op_host;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestClientLogoutUris()
	    {
	        return $this->request_client_logout_uris;
	    }
	
	    /**
	     * @param array $request_client_logout_uris
	     * @return void
	     */
	    public function setRequestClientLogoutUris($request_client_logout_uris)
	    {
	        $this->request_client_logout_uris = $request_client_logout_uris;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestResponseTypes()
	    {
	        return $this->request_response_types;
	    }
	
	    /**
	     * @param array $request_response_types
	     * @return void
	     */
	    public function setRequestResponseTypes($request_response_types)
	    {
	        $this->request_response_types = $request_response_types;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestGrantTypes()
	    {
	        return $this->request_grant_types;
	    }
	
	    /**
	     * @param array $request_grant_types
	     * @return void
	     */
	    public function setRequestGrantTypes($request_grant_types)
	    {
	        $this->request_grant_types = $request_grant_types;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestScope()
	    {
	        return $this->request_scope;
	    }
	
	    /**
	     * @param array $request_scope
	     * @return void
	     */
	    public function setRequestScope($request_scope)
	    {
	        $this->request_scope = $request_scope;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestPostLogoutRedirectUri()
	    {
	        return $this->request_post_logout_redirect_uri;
	    }
	
	    /**
	     * @param string $request_post_logout_redirect_uri
	     * @return void
	     */
	    public function setRequestPostLogoutRedirectUri($request_post_logout_redirect_uri)
	    {
	        $this->request_post_logout_redirect_uri = $request_post_logout_redirect_uri;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestClientJwksUri()
	    {
	        return $this->request_client_jwks_uri;
	    }
	
	    /**
	     * @param string $request_client_jwks_uri
	     * @return void
	     */
	    public function setRequestClientJwksUri($request_client_jwks_uri)
	    {
	        $this->request_client_jwks_uri = $request_client_jwks_uri;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestClientSectorIdentifierUri()
	    {
	        return $this->request_client_sector_identifier_uri;
	    }
	
	    /**
	     * @param array $request_client_sector_identifier_uri
	     */
	    public function setRequestClientSectorIdentifierUri($request_client_sector_identifier_uri)
	    {
	        $this->request_client_sector_identifier_uri = $request_client_sector_identifier_uri;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestClientTokenEndpointAuthMethod()
	    {
	        return $this->request_client_token_endpoint_auth_method;
	    }
	
	    /**
	     * @param string $request_client_token_endpoint_auth_method
	     * @return void
	     */
	    public function setRequestClientTokenEndpointAuthMethod($request_client_token_endpoint_auth_method)
	    {
	        $this->request_client_token_endpoint_auth_method = $request_client_token_endpoint_auth_method;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestClientRequestUris()
	    {
	        return $this->request_client_request_uris;
	    }
	
	    /**
	     * @param array $request_client_request_uris
	     * @return void
	     */
	    public function setRequestClientRequestUris($request_client_request_uris)
	    {
	        $this->request_client_request_uris = $request_client_request_uris;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestApplicationType()
	    {
	        return $this->request_application_type;
	    }
	
	    /**
	     * @param string $request_application_type
	     * @return void
	     */
	    public function setRequestApplicationType($request_application_type = 'web')
	    {
	        $this->request_application_type = $request_application_type;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestAuthorizationRedirectUri()
	    {
	        return $this->request_authorization_redirect_uri;
	    }
	
	    /**
	     * @param string $request_authorization_redirect_uri
	     * @return void
	     */
	    public function setRequestAuthorizationRedirectUri($request_authorization_redirect_uri)
	    {
	        $this->request_authorization_redirect_uri = $request_authorization_redirect_uri;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestAcrValues()
	    {
	        return $this->request_acr_values;
	    }
	
	    /**
	     * @param array $request_acr_values
	     * @return void
	     */
	    public function setRequestAcrValues($request_acr_values = 'basic')
	    {
	        $this->request_acr_values = $request_acr_values;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestContacts()
	    {
	        return $this->request_contacts;
	    }
	
	    /**
	     * @param array $request_contacts
	     * @return void
	     */
	    public function setRequestContacts($request_contacts)
	    {
	        $this->request_contacts = $request_contacts;
	    }
	
	    /**
	     * @return string
	     */
	    public function getResponseOxdId()
	    {
	        $this->response_oxd_id = $this->getResponseData()->oxd_id;
			return $this->response_oxd_id;
	    }
	    /**
	     * @return string
	     */
	    public function getResponseOpHost()
	    {
	        $this->response_op_host = $this->getResponseData()->op_host;
	        return $this->response_op_host;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestUiLocales()
	    {
	        return $this->request_ui_locales;
	    }
	
	    /**
	     * @param array $request_ui_locales
	     */
	    public function setRequestUiLocales($request_ui_locales)
	    {
	        $this->request_ui_locales = $request_ui_locales;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestClaimsLocales()
	    {
	        return $this->request_claims_locales;
	    }
	
	    /**
	     * @param array $request_claims_locales
	     */
	    public function setRequestClaimsLocales($request_claims_locales)
	    {
	        $this->request_claims_locales = $request_claims_locales;
	    }
	
	    /**
	     * Protocol command to oxd server
	     * @return void
	     */
	    public function setCommand()
	    {
	        $this->command = 'register_site';
	    }
	    /**
	     * Protocol parameter to oxd server
	     * @return void
	     */
	    public function setParams()
	    {
	        $this->params = array(
	            "authorization_redirect_uri" => $this->getRequestAuthorizationRedirectUri(),
	            "op_host" => $this->getRequestOpHost(),
	            "post_logout_redirect_uri" => $this->getRequestPostLogoutRedirectUri(),
	            "application_type" => $this->getRequestApplicationType(),
	            "response_types"=> $this->getRequestResponseTypes(),
	            "grant_types" => $this->getRequestGrantTypes(),
	            "scope" => $this->getRequestScope(),
	            "acr_values" => $this->getRequestAcrValues(),
	            "client_name"=> $this->getRequestClientName(),
	            "client_jwks_uri" => $this->getRequestClientJwksUri(),
	            "client_token_endpoint_auth_method" => $this->getRequestClientTokenEndpointAuthMethod(),
	            "client_request_uris" => $this->getRequestClientRequestUris(),
	            "client_logout_uris"=> $this->getRequestClientLogoutUris(),
	            "client_sector_identifier_uri"=> $this->getRequestClientSectorIdentifierUri(),
	            "contacts" => $this->getRequestContacts(),
	            "ui_locales" => $this->getRequestUiLocales(),
	            "claims_locales" => $this->getRequestClaimsLocales(),
	            "client_id"=> $this->getRequestClientId(),
	            "client_secret"=> $this->getRequestClientSecret()
	        );
	       
	    }
	
	}
