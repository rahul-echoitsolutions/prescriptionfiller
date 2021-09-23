<?php

namespace App\Http\Controllers;

class CustomController extends Controller
{
	const ERROR_NO_RECORD_FOUND = 1; // If you load a record and no record can be found
	const ERROR_MISSING_REQUIRED_DATA = 2; // If you try to make a request and you are missing a required field(s)
	const ERROR_SAVING_DATA = 3; // Server side error if the saving of a record fails for a server related issue
	const ERROR_INVALID_EMAIL_ADDRESS = 4; // Error if a invalid email address is supplied. For example, test@blah
	const ERROR_INVALID_PHONE_NUMBER = 5; // Error if a invalid phone number is provided. Has to be of the format 604-555-5555
	const ERROR_INVALID_POSTAL_CODE = 6; // Error if a invalid postal code is provided. Has to be a Canadian postal code like so V3R2L1
	const ERROR_INVALID_SEX = 7; // Invalid sex, has to be either M or F
	const ERROR_EMAIL_ADDRESS_EXISTS = 8; // The email address of an account has be unique. Error if you try to save a new account using an email that already exists in the database
	const ERROR_INCORRECT_USERNAME_OR_PASSWORD = 9; // Error if the login credentials provided are incorrect
	const ERROR_NO_TOKEN_SENT = 10; // Error if no token is provided
	const ERROR_TOKEN_IS_INVALID = 11; // Error if a token provided is invalid
	const ERROR_CONNECTING_TO_FAX_SERVER = 12; // Could not connect to SRFax to fax out the prescription
	const ERROR_CONNECTION_TIMEOUT = 13;
	const FAX_QUEUED = 14; // fax successfully queued
	const FAX_SENT = 15; // fax successfully sent
	const FAX_FAILED = 16; // fax failed
	
	public function respond($data, $error, $error_code)
	{
		$package = array('data' => $data, 'error' => $error, 'error_code' => $error_code);
		return json_encode($package);
	}
}
