<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PaymeFormRequest;
use DB;

class PaymeController extends Controller {

	public function create()
    {
       $datas = DB::select('select * from paymes WHERE response!=""');
	//	$data['result']='';
		return view('payme.create', compact('datas'));//,compact('data'));
    }

    public function store(Request $request)
  {
    
   $payme = new \App\Payme;
	$payme->prod_name = $request->get('prod_name');
	$payme->prod_price =$request->get('prod_price');
	$payme->prod_curency = $request->get('prod_curency');
	$payme->response ='';

	// Save the model
	$payme->save();

$data = array("seller_payme_id" => "MPL14985-68544Z1G-SPV5WK2K-0WJWHC7N", "sale_price" => $payme->prod_price, "currency" => $payme->prod_curency, "product_name" => $payme->prod_name, "installments" => "1", "language" => "en");                                                                    
$data_string = json_encode($data);                                                                                   
                                                                                                                     
$ch = curl_init('https://preprod.paymeservice.com/api/generate-sale');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
$insertedId = $payme->id;                                                                                                      
$result = curl_exec($ch);
$tab=json_decode($result);
if($tab->status_code=='0')
{
$link='<a href="'.$tab->sale_url.'">'.$tab->payme_sale_code.'</a>';
	//$data['result']=$result;
	DB::table('paymes')
            ->where('id', $insertedId)
            ->update(['response' => $link]);
	}
	$datas = DB::select('select * from paymes WHERE response!=""');
	return view('payme.create', compact('datas'));
  }
}
