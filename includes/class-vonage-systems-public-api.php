<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Vonage_Systems_Public_API {

	/**
	 * Vonage Class Object : vonage_php_api/Vonage/Vonage.php
	 *
	 * @var OBJECT
	 */
	private $vonage;


	/**
	 * Loads & Instatiate Vonage Class with given Username & Password 
	 *
	 * @since 1.0.0
	 *
	 * @param STRING $username Vonage Username
	 * @param STRING $password Vonage Password 
	 */
	public function __construct( $username, $password ){

		// Loading VonageApi
		require_once( VONAGE_SYSTEMS_PATH .'vonage_php_api/vendor/autoload.php' );
		require_once( VONAGE_SYSTEMS_PATH .'vonage_php_api/Vonage/Vonage.php' );

		$this->vonage = new \Vonage\Vonage( $username, $password );

	}

	/**
	 * Fetch Conference, Queues, and Extensions for the currently authenticated user
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_directory( $return_array = true ){

		return json_decode( $this->vonage->request( 'directory' ), $return_array );

	}

	/**
	 * Fetch Registered Queues for the system
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_queues( $return_array = true ){

		return json_decode( $this->vonage->request( 'directory' ), $return_array )["queues"];

	}

	/**
	 * Fetch Registered Extensions for the system
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_extensions( $return_array = true ){

		return json_decode( $this->vonage->request( 'directory' ), $return_array )["extensions"];

	}

	/**
	 * Fetch Call History for the current authenticated user
	 *
	 * @since 1.0.0
	 *
	 * @param INT 	  $ext          Extension Number whose call history has to be fetched
	 * @param array   $params       Extra Parameters to be passed to filter the results (more info: http://businesssupport.vonage.com/app/answers/detail/a_id/1099/~/calling-and-presence-apis)
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_call_history( $ext, $params = array(), $return_array = true ){

		return json_decode( $this->vonage->request( "callhistory/{$ext}", $params ), $return_array );

	}

	/**
	 * Fetch an extension's info
	 *
	 * @since 1.0.0
	 *
	 * @param INT  $ext             Extenstion Number
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_extension_info( $ext, $return_array = true ){

		return json_decode( $this->vonage->request( "extension/{$ext}" ), $return_array );

	}

	/**
	 * Fetch an Extension's Status 
	 *
	 * @since 1.0.0
	 *
	 * @param INT  	  $ext          Extension Number 
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_extension_status( $ext, $return_array = true ){

		$extinfo = json_decode( $this->vonage->request( "extension/{$ext}" ), $return_array );

		if( empty( (array)$extinfo->details->presence ) )
			return 'Available';

		return 'Busy on call:'.$extinfo->details->presence->onCallWith;

	}

	/**
	 * Fetch a Queue's Information
	 *
	 * @since 1.0.0
	 *
	 * @param INT     $ext          Extension Number Assigned to the Queue
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_queue_info( $ext, $return_array = true ){

		return json_decode( $this->vonage->request( "queue/{$ext}" ), $return_array );

	}

	/**
	 * Fetch a Conference Information
	 *
	 * @since 1.0.0
	 *
	 * @param INT     $ext          Extension Number Assigned to the Conference
	 * @param boolean $return_array Option to leave fetched JSON as Object or Convert it to Array
	 *
	 * @return ARRAY/OBJ  JSON Result
	 */
	public function get_conference_info( $ext, $return_array = true ){

		return json_decode( $this->vonage->request( "conference/{$ext}" ), $return_array );

	}

	// public function test( $var ){

	// 	echo '<pre>';
	// 	var_dump( $var );
	// 	echo '</pre>';

	// }

}

?>