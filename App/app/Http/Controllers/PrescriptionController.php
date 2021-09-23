<?php

namespace App\Http\Controllers;

use App\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends CustomController
{


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{

		//$rules = array(
		//  'user_id'       => 'required'
		//);
		//  $validator = Validator::make(Input::all(), $rules);

		// process the login
		//    if ($validator->fails()) {

		//} else {
		$prescription = new Prescription();
		$prescription->fill($request->all());

		$image = $request->file('image');
		$imagedata = file_get_contents($image);
		$base64 = base64_encode($imagedata);
		$prescription->image_data = $base64; //base64_encode($image);

		$status = $prescription->fax();
		$prescription->fax_status = $status == 'Success' ? CustomController::FAX_QUEUED : CustomController::ERROR_CONNECTING_TO_FAX_SERVER;
		$prescription->push();

		return $this->respond($prescription, false, 0);

		//}

	}

	private function checkFaxStatus(&$prescription)
	{
		$status = $prescription->checkFaxStatus();
		$status_code = $prescription->fax_status;
		switch($status) 
		{
		case 'In Progress':
			$status_code = CustomController::FAX_QUEUED;
			break;
		case 'Sent':
			$status_code = CustomController::FAX_SENT;
			break;
		case 'Failed':
			$status_code = CustomController::FAX_FAILED;
			break;
		case 'Sending Email':
			$status_code = CustomController::FAX_QUEUED;
			break;
		}
		if($status_code != $prescription->fax_status)
		{
			$prescription->fax_status = $status_code;
			$prescription->push();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Prescription  $prescription
	 * @return \Illuminate\Http\Response
	 */
	public function show(Prescription $prescription)
	{
		return $this->respond($prescription, false, 0); 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Prescription  $prescription
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Prescription $prescription)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Prescription  $prescription
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Prescription $prescription)
	{
		//
	}

	/**
	 * Loads the prescriptions for the user
	 *
	 * @param  String
	 * @return \Illuminate\Http\Response
	 */
	public function getPrescriptionsByUserId($user_id)
	{
		$prescriptions = Prescription::where('user_id', $user_id)->limit(200)->get();
		foreach($prescriptions as $prescription)
		{
			if($prescription->fax_status == CustomController::FAX_QUEUED) 
			{
				$this->checkFaxStatus($prescription);
			}
		}
		return $this->respond($prescriptions, false, 0);
	}
}
