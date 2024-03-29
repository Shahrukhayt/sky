<?php
/**
* Copyright 2011 HubSpot, Inc.
*
* Licensed under the Apache License, Version 2.0 (the
* "License"); you may not use this file except in compliance
* with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing,
* software distributed under the License is distributed on an
* "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
* either express or implied.  See the License for the specific
* language governing permissions and limitations under the
* License.
*/
class Rm_HubSpot_BaseClient
{
    // Rm_HubSpot_BaseClient class to be extended by specific hapi clients

    // Declare variables
    protected $HAPIKey;
    protected $API_PATH;
    protected $API_VERSION;
    protected $isTest = false;
    protected $PATH_DIV = '/';
    protected $KEY_PARAM = '?hapikey=';
    protected $PROD_DOMAIN = 'https://api.hubapi.com';
    protected $QA_DOMAIN = 'https://hubapiqa.com';
    protected $userAgent;    // new

    /**
     * The HTTP status of the most recent request
     *
     * @var integer
     */
    protected $lastStatus;

    /**
     * The HTTP code for a successful request
     */
    const STATUS_OK = 200;

    /**
     * The HTTP code for bad request
     */
    const STATUS_BAD_REQUEST = 400;

    /**
     * The HTTP code for unauthorized
     */
    const STATUS_UNAUTHORIZED = 401;

    /**
     * The HTTP code for resource not found
     */
    const STATUS_NOT_FOUND = 404;

    /**
     * Constructor.
     *
     * @param $HAPIKey: String value of HubSpot API Key for requests
     */
    public function __construct($HAPIKey,$userAgent="haPiHP default UserAgent")
    {
        $this->HAPIKey = $HAPIKey;
        $this->userAgent = $userAgent;
    }

    /**
     * Gets the status code from the most recent curl request
     *
     * @return integer
     */
    public function getLastStatus()
    {
        return (int)$this->lastStatus;
    }

    /**
     * Returns API_PATH that is set in specific hapi clients.  All
     * clients that extend Rm_HubSpot_BaseClient should set $API_PATH to the
     * base path for the API (e.g.: the leads api sets the value to
     * 'leads')
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function get_api()
    {
        if ( $this->isBlank($this->API_PATH) )
            throw new Rm_HubSpot_Exception('API_PATH must be defined');
        else
            return $this->API_PATH;
    }

    /**
     * Returns API_VERSION that is set in specific hapi clients. All
     * clients that extend Rm_HubSpot_BaseClient should set $API_VERSION to the
     * version that the client is developed for (e.g.: the leads v1
     * client sets the value to 'v1')
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function get_api_version()
    {
        if ( $this->isBlank($this->API_VERSION) )
            throw new Rm_HubSpot_Exception('API_VERSION must be defined');
        else
            return $this->API_VERSION;
    }

    /**
     * Allows developer to set testing flag to true in order to
     * execute api requests against hubapiqa.com
     *
     * @param $testing: Boolean
     */
    public function set_is_test($testing) {
        if ( $testing == TRUE )
        {
            $this->isTest = TRUE;
        }
    }

    /**
     * Returns the hapi domain to use for requests based on isTesting
     *
     * @returns: String value of domain, including https protocol
     */
    protected function get_domain()
    {
       if ( $this->isTest == TRUE )
           return $this->QA_DOMAIN;
       else
           return $this->PROD_DOMAIN;
    }

    /**
     * Creates the url to be used for the api request
     *
     * @param endpoint: String value for the endpoint to be used (appears after version in url)
     * @param params: Array containing query parameters and values
     *
     * @returns String
     */
    protected function get_request_url($endpoint, $params)
    {
        $paramstring = $this->array_to_params($params);

        return $this->get_domain() . $this->PATH_DIV.$this->get_api() . $this->PATH_DIV . $this->get_api_version() .
               $this->PATH_DIV . $endpoint . $this->KEY_PARAM . $this->HAPIKey . $paramstring;
    }

    /**
     * Creates the url to be used for the api request for Forms API
     *
     * @param endpoint: String value for the endpoint to be used (appears after version in url)
     * @param params: Array containing query parameters and values
     *
     * @return String
     */
    protected function get_forms_request_url($url_base,$params)
    {
        $paramstring = $this->array_to_params($params);

        return $url_base . $this->KEY_PARAM . $this->HAPIKey . $paramstring;
    }

    /**
     * Executes HTTP GET request
     *
     * @param URL: String value for the URL to GET
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_get_request($url)
    {
        $response = wp_remote_get( $url, 
                                    array( 
                                        'body' => array(), 
                                    ) );
        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }
    }

    /**
     * Executes HTTP POST request
     *
     * @param URL: String value for the URL to POST to
     * @param fields: Array containing names and values for fields to post
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_post_request($url, $body, $formenc = FALSE)
    {
        $response = wp_remote_post( $url, 
                                    array( 
                                        'body' => $body, 
                                    ) );

        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }

    }

    /**
     * Executes HTTP POST request with JSON as the POST body
     *
     * @param URL String value for the URL to POST to
     * @param fields Array containing names and values for fields to post
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_JSON_post_request($url, $body)
    {
        $response = wp_remote_post( $url, 
                                    array( 
                                        'headers'  => array(
                                                'Content-Type' => 'application/json'
                                            ),
                                        'body' => $body
                                    ));

        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }
    }

    /**
     * Executes HTTP POST request with XML as the POST body
     *
     * @param URL String value for the URL to POST to
     * @param fields Array containing names and values for fields to post
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_xml_post_request($url, $body)
    {
        $response = wp_remote_post( $url, 
                                    array( 
                                        'headers'  => array(
                                                'Content-Type' => 'application/atom+xml'
                                            ),
                                        'body' => $body
                                    ) );

        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }
    }

    /**
     * Executes HTTP PUT request
     *
     * @param URL String value for the URL to PUT to
     * @param body String value of the body of the PUT request
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_put_request($url, $body)
    {
        $response = wp_remote_request( $url, 
                                    array( 
                                        'method' => 'PUT',
                                        'headers'  => array(
                                                'Content-Type' => 'application/json',
                                                'Content-Length' =>  strlen($body)
                                            ),
                                        'body' => $body
                                    ));

        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }

    }

    /**
     * Executes HTTP PUT request with XML as the PUT body
     *
     * @param URL String value for the URL to PUT to
     * @param body String value of the body of the PUT request
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_xml_put_request($url, $body){
        $response = wp_remote_request( $url, 
                                    array( 
                                        'method' => 'PUT',
                                        'headers'  => array(
                                                'Content-Type' => 'application/json',
                                                'Content-Length' =>  strlen($body)
                                            ),
                                        'body' => $body
                                    ));

        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }


    }

    /**
     * Executes HTTP DELETE request
     *
     * @param URL String value for the URL to DELETE to
     * @param body String value of the body of the DELETE request
     *
     * @return Body of request result
     *
     * @throws Rm_HubSpot_Exception
     */
    protected function execute_delete_request($url, $body)
    {
        $response = wp_remote_request( $url, 
                                    array( 
                                        'method' => 'DELETE',
                                        'headers'  => array(
                                                'Content-Type' => 'application/json',
                                                'Content-Length' =>  strlen($body)
                                            ),
                                        'body' => $body
                                    ));

        if ( ! is_wp_error( $response ) ) {
            $code = wp_remote_retrieve_response_code( $response );
            $message = wp_remote_retrieve_response_message( $response );
            if ( $code == 200 && $message == 'OK' ) {
                $body = wp_remote_retrieve_body( $response );
                $output = $body;
                return $output;
            }
        }else if(! is_wp_error( $response )){
            $code = wp_remote_retrieve_response_code( $response );
            $error = wp_remote_retrieve_response_message( $response );
            throw new Rm_HubSpot_Exception('Request Error: ' . $error);

        }


    }

    /**
     * Converts an array into url friendly list of parameters
     *
     * @param array params Multidimensional array of parameters (name=>value)
     *
     * @return String of url friendly parameters (&name=value&foo=bar)
     */
    protected function array_to_params($params)
    {
        $paramstring = '';

        if ( $params != NULL )
        {
            foreach ( $params as $parameter => $value )
            {
                if ( is_array($value) )
                {
                    foreach ( $value as $subparam )
                    {
                        $paramstring = $paramstring . '&' . $parameter . '=' . urlencode($subparam);
                    }
                }
                else
                {
                    $paramstring = $paramstring . '&' . $parameter . '=' . urlencode($value);
                }
            }
        }

        return $paramstring;
    }

    /**
     * Utility function used to determine if variable is empty
     *
     * @param s Variable to be evaluated
     *
     * @returns Boolean
     */
    protected function isBlank ($s)
    {
        if ( (trim($s)=='') OR ($s == NULL) )
            return true;
        else
            return false;
    }
}
