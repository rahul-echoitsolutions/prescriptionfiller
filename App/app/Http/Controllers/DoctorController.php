<?php

namespace App\Http\Controllers;

use App\Helpers\UserTypes;
use Illuminate\Http\Request;
use App\DoctorAdditional;
use \File;
use Illuminate\Support\Facades\Storage;
use App\Mail\DoctorRegistrationComplete;
use Mail;


class DoctorController extends CustomController
{
	
	protected function displayRegistrationForm() {
		$mainRegisterPage =  File::get(public_path() . '/register-main.html');
		$doctorRegisterPage =  File::get(public_path() . '/register-doctor.html');
		return str_replace("{fields}", $doctorRegisterPage, $mainRegisterPage);
	}
	
	protected function displayCompleteMessage() {
		$mainRegisterPage =  File::get(public_path() . '/register-main.html');
		$doctorRegisterPage =  File::get(public_path() . '/register-complete.html');
		return str_replace("{fields}", $doctorRegisterPage, $mainRegisterPage);
	}
	
	protected function saveRegistrationForm(Request $request) {
		$userController = new UserController();
		
		$request->request->add(['activated' => false]);
		$request->request->add(['user_type' => UserTypes::DOCTOR]);

		$response = $userController->store($request);
		$response_object = json_decode($response);
		
		if($response_object->error_code == self::ERROR_EMAIL_ADDRESS_EXISTS) {
			return $response;
		} else {
			$success = Storage::disk('local')->put('pharm_files', $request->file('verification_document'));
			
			$additionalData = new DoctorAdditional();
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
		Mail::to($email)->send(new DoctorRegistrationComplete($data));
	}
}
