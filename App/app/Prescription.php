<?php

namespace App;

use App\User;
use App\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use FPDF;
use FPDM\FPDM;

class Prescription extends Model
{
	protected $table = 'prescription';
	protected $fillable = array('user_id', 'pharmacy_id', 'description', 'extended_health', 'image_path', 'fax_id', 'medical_notes', 'fax_status', 'created_at');

	public $image_data;
	private $sr_fax_username = 205401;
	private $sr_fax_password = 'P.filler.2015';

	public function fax()
	{
		$user = User::find($this->user_id);
		$pharmacy = Pharmacy::find($this->pharmacy_id);
		$faxFileName = $this->createPDF($user, $pharmacy, $this->image_data);
		$postVariables = array(
				'action'         => 'Queue_Fax',
				'access_id'      => $this->sr_fax_username,
				'access_pwd'     => $this->sr_fax_password,

				'sCallerID'      => '8662336965',
				'sSenderEmail'   => $user->email,
				'sFaxType'       => 'SINGLE',
				'sToFaxNumber'   => $pharmacy->fax_number,

				'sCPSubject'     => 'New Prescription',
				'sFileName_1'    => $faxFileName,
				'sFileContent_1' => base64_encode(file_get_contents($faxFileName))
				);

		$curlDefaults = $this->getCurlSettings($postVariables);

		$ch = curl_init();
		curl_setopt_array($ch, $curlDefaults);
		$result = json_decode(curl_exec($ch), true);


		if (curl_errno($ch)) 
		{
			return "Failed";
		}
		else 
		{
			$this->fax_id = $result['Result'];
			return $result['Status'];
		}
	} 

	public function checkFaxStatus()
	{
		$postVariables = array(
				'action'         => 'Get_FaxStatus',
				'access_id'      => $this->sr_fax_username,
				'access_pwd'     => $this->sr_fax_password,
				'sFaxDetailsID'  => $this->fax_id,
				);

		$curlDefaults = $this->getCurlSettings($postVariables);

		$ch = curl_init();
		curl_setopt_array($ch, $curlDefaults); 

		$result = json_decode(curl_exec($ch), true);

		if (curl_errno($ch) || $result['Status'] == 'Failed') 
		{
			return "Failed";
		}
		else 
		{
			return $result['Result']['SentStatus'];
		}
	}

	private function getCurlSettings($postVariables)
	{	
		$curlDefaults = array(
				CURLOPT_POST           => 1,
				CURLOPT_HEADER         => 0,
				CURLOPT_URL            => "https://www.srfax.com/SRF_SecWebSvc.php",
				CURLOPT_FRESH_CONNECT  => 1,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_FORBID_REUSE   => 1,
				CURLOPT_TIMEOUT        => 60,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => 2,
				CURLOPT_POSTFIELDS     => http_build_query($postVariables),
				);
		return $curlDefaults;
	}

	private function appendAdvertisementToPrescriptionImage($image_data) 
	{
		$prescription_image = imagecreatefromstring($image_data);
		if($prescription_image == false)
		{
			return false;
		}

		$advertisement_image = imagecreatefromjpeg('advertisement.jpg');

		imagealphablending($prescription_image, false);
		imagesavealpha($prescription_image, true);

		imagecopymerge($prescription_image, $advertisement_image, 10, 9, 0, 0, 181, 180, 100); //have to play with these numbers for it to work for you, etc.

		header('Content-Type: image/png');
		imagepng($dest);

		imagedestroy($dest);
		imagedestroy($src);


	}

	private function fillPDF($user, $pharmacy, $faxFileName)
	{
		$senderName = $user->first_name . " " . $user->last_name;
		$pdf = new FPDM($faxFileName);
		$fields = array(
				'faxTo'    => $pharmacy->name,
				'faxNumber' => $pharmacy->fax_number,
				'faxDate'    => date('m-d-Y H:i'),
				'faxForName'   => $senderName,
				'name'   => $senderName,
				'phoneNumber'   => $user->phone_number,
				'dateOfBirth'   => $user->date_of_birth,
				'sex'   => $user->sex,
				'allergies'   => $user->allergies,
				'insuranceProvider'   => $user->medical_insurance_provider,
				'carrierNumber'   => $user->carrier_number,
				'planNumber'   => $user->plan_number,
				'memberID'   => $user->member_id,
				'issueNumber'   => $user->issue_number,
				'personalHealthNumber'   => $user->personal_health_number,
				'description'   => $user->description,
				'medicalNotes'   => $user->medical_notes
			       );
		$pdf->Load($fields, true); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
		$pdf->Merge();
		$pdf->Output($fileName,'F');
	}

/*	private function insertImagesIntoPDF($prescriptionImageData) 
	{	
		$pdf = new FPDF('pdf/fax_template.pdf');
		$pdf->Image('pdf/advertisement.jpg', 300, 50);
		$pdf->Image('data://text/plain;base6' . $prescriptionImageData, 0, 300);
		$fileName = "faxes/" .microtime() . ".pdf";
		$pdf->Output($fileName,'F');
		return $fileName;
	}
*/
	private function createPDF($user, $pharmacy, $prescriptionImageData)
	{
		$pdf = new FPDF();
		$pdf->AddPage('P'); 

		$leftRowX = 18;
		$rightRowX = 100;
		$senderName = $user->first_name . " " . $user->last_name;

		$pdf->SetFont('Arial','',9);
		$pdf->SetXY($leftRowX , 20);
		$pdf->Write(5, 'To: ' . $pharmacy->name);

		$pdf->SetXY($leftRowX, 25);
		$pdf->Write(5, 'Fax: ' . $pharmacy->fax_number);

		$pdf->SetXY($leftRowX, 30);
		$pdf->Write(5, 'Subject: New prescription for  ' . $senderName);

		$pdf->line($leftRowX, 35, 200, 35);

		$pdf->SetXY($leftRowX, 40);
		$pdf->Write(5, 'Name: ' . $senderName);

		$pdf->SetXY($leftRowX, 45);
		$pdf->Write(5, 'Phone Number: ' . $user->phone_number);

		$pdf->SetXY($leftRowX, 50);
		$pdf->Write(5, 'Date of Birth: ' . $user->date_of_birth);

		$pdf->SetXY($leftRowX, 55);
		$pdf->Write(5, 'Sex: ' . $user->sex);

		$pdf->SetXY($leftRowX, 60);
		$pdf->Write(5, 'Insurance Provider: ' . $user->medical_insurance_provider);

		$pdf->SetXY($leftRowX, 65);
		$pdf->Write(5, 'Carrier Number: ' . $user->carrier_number);

		$pdf->SetXY($leftRowX, 70);
		$pdf->Write(5, 'Plan Number: ' . $user->plan_number);

		$pdf->SetXY($leftRowX, 75);
		$pdf->Write(5, 'Member ID: ' . $user->member_id);

		$pdf->SetXY($leftRowX, 80);
		$pdf->Write(5, 'Issue Number: ' . $user->issue_number);

		$pdf->SetXY($leftRowX, 85);
		$pdf->Write(5, 'Personal Health Number: ' . $user->personal_health_number);

		$pdf->SetXY($leftRowX, 90);
		$pdf->MultiCell(80, 5, 'Description: ' . $user->description);

		$pdf->SetXY($leftRowX, 105);
		$pdf->MultiCell(80, 5, 'Medical Notes: ' . $user->medical_notes);

		$pdf->SetXY($leftRowX, 120);
		$pdf->MultiCell(80, 5, 'Allergies: ' . $user->allergies);

		$pdf->SetXY($rightRowX, 20);
		$pdf->Write(5, 'From: Prescription Filler');

		$pdf->SetXY($rightRowX, 25);
		$pdf->Write(5, 'Date: ' . date('m-d-Y H:i'));


		$pdf->Image('images/advertisement.jpg', $rightRowX, 40);

		$pic = 'data://text/plain;base64,' . $prescriptionImageData;
	//	$info = getimagesize($pic);
	//	error_log($info[0] . " " . $info[1], 0);
		$pdf->Image($pic, $leftRowX, 140, 175, 140, 'jpg');

		$fileName = "faxes/" .microtime() . ".pdf";
		$pdf->Output($fileName,'F');
		return $fileName;
	}
}

