<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use App\Helpers\UserTypes;
use Illuminate\Http\Request;
use App\PharmacyAdditional;
use \File;
use Illuminate\Support\Facades\Storage;
use App\Mail\PharmacyRegistrationComplete;
use Mail;


class PharmacyController extends CustomController
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        return $pharmacy->toJson();
    }
	
	 /**
     * Loads the pharmacies with a name similar to the name provided
     *
     * @param  String
     * @return \Illuminate\Http\Response
     */
    public function getPharmacies($name, $city)
    {
	
        $escapedInput = str_replace('%', '\\%', $name);
        $escapedInput = strtolower($escapedInput);
		$city = strtolower($city);
		$pharmacies = array();

		if($name != null && $name != '' && $name != 'null' && $city != 'null' && $city != null && $city != ''){
			$pharmacies = Pharmacy::where('name', 'LIKE', '%' . $escapedInput . '%')->where('city', 'LIKE', $city . '%')->limit(30)->get();
		} else if ($name != null && $name != '' && $name != 'null'){
			$pharmacies = Pharmacy::where('name', 'LIKE', '%' . $escapedInput . '%')->limit(30)->get();
		} else if($city != null && $city != '' && $city != 'null'){
			$pharmacies = Pharmacy::where('city', 'LIKE', $city . '%')->limit(30)->get();
		}
		$pharmacies = $this->formatPharmacyData($pharmacies);
		return $this->respond($pharmacies, false, 0);
    }

    private function formatPharmacyData($pharmacies) 
    { 
	foreach($pharmacies as &$pharmacy)
	{
		$pharmacy->name = ucwords($pharmacy->name);
		$pharmacy->address = ucwords($pharmacy->address . " " . $pharmacy->city);
	}

	return $pharmacies;

    }	
	/** Loads the pharmacies within close distance of lat long **/
    public function getPharmaciesByLocation($latitude, $longitude)
    {
		$pharmacies = array();
		if($latitude != 'null' && $latitude != null && $longitude != 'null' && $longitude != null) {
			$pharmacies = \DB::select('SELECT  *,  
				(3959 * acos(cos(radians(?)) * cos(radians(latitude)) *  cos(radians(longitude) - radians(?)) + sin(radians(?)) *  sin(radians(latitude ))) ) AS distance  
				FROM pharmacy 
				WHERE latitude IS NOT NULL AND longitude IS NOT NULL ORDER BY distance limit 5', [$latitude, $longitude, $latitude]);
			
		}
		return $this->respond($pharmacies, false, 0);
    }
	
	protected function displayRegistrationForm() {
		$mainRegisterPage =  File::get(public_path() . '/register-main.html');
		$pharmRegisterPage =  File::get(public_path() . '/register-pharm.html');
		return str_replace("{fields}", $pharmRegisterPage, $mainRegisterPage);
	}
	
	protected function displayCompleteMessage() {
		$mainRegisterPage =  File::get(public_path() . '/register-main.html');
		$pharmRegisterPage =  File::get(public_path() . '/register-complete.html');
		return str_replace("{fields}", $pharmRegisterPage, $mainRegisterPage);
	}
	
	protected function saveRegistrationForm(Request $request) {
		$userController = new UserController();
		
		$request->request->add(['activated' => false]);
		$request->request->add(['user_type' => UserTypes::PHARMACY]);

		$response = $userController->store($request);
		$response_object = json_decode($response);
		
		if($response_object->error_code == self::ERROR_EMAIL_ADDRESS_EXISTS) {
			return $response;
		} else {
			$success = Storage::disk('local')->put('pharm_files', $request->file('verification_document'));
			
			$additionalData = new PharmacyAdditional();
			$additionalData->fill($request->all());
			$additionalData->user_id = $response_object->data->id;
			$additionalData->document_name = $request->file('verification_document')->hashName();
			$additionalData->contact_email = $response_object->data->email;
			$additionalData->push();
			$this->sendRegisterCompleteEmail($response_object->data->email);
			
			return $this->respond(null, false, 0);

		}	
	}
	
	private function sendRegisterCompleteEmail($email) {
		$data = [
			'title' => "Thanks for registering to Prescription Filler",
			'body' => "Thanks for registering to Prescription Filler.  You account details will be verified and your account activated shortly. You will receive another email once your account has been activated."
			];
		Mail::to($email)->send(new PharmacyRegistrationComplete($data));
	}
}
