<?php

namespace App\Http\Controllers;

use App\Mail\PaymentAcknowledgement;
use Square\Models\Money;
use Square\SquareClient;
use Square\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Square\Models\CreatePaymentRequest;

class SquareController extends Controller
{
    public function __construct()
    {
        $this->client = new SquareClient([
            'accessToken' => config('square.token'),
            'environment' => config('square.env'),
        ]);
    }
 
 
    // public function createPayment(Request $req)
    // {
    //     return ['ok'=>true,
    //         'text'=>'success'
    //     ];
    // }

    public function createPayment(Request $req)
    {
        try {
 
            $data = $req->all();
 
            $amountMoney = new \Square\Models\Money();
            $amountMoney->setAmount($data['amount']);
            $amountMoney->setCurrency('JPY');

            // $shipping_address = new Address();
            // $shipping_address->setAddressLine1($data['address1']);
            // $shipping_address->setAddressLine2($data['address2']);
            // $shipping_address->setAdministrativeDistrictLevel1($data['state']);
            // $shipping_address->setAdministrativeDistrictLevel2($data['city']);
            // $shipping_address->setPostalCode($data['zip']);
            // $shipping_address->setCountry('JP');
            // $shipping_address->setFirstName('ボビー');
            // $shipping_address->setLastName('ボロメオ');
           
            $body = new \Square\Models\CreatePaymentRequest(
                $data['sourceId'],
                Str::uuid()->toString(),
            );
 
            $body->setAmountMoney($amountMoney);
            // $body->setBuyerEmailAddress($data['email']);
            $body->setNote($data['note']);
            // $body->setShippingAddress($shipping_address);
            // dd($body);
 
            $res = $this->client->getPaymentsApi()->createPayment($body);
 
            if ($res->isSuccess()) {
                // should send automatic acknowledgment mail here
                $payment_id = $res->getResult()->getPayment()->getId();
                $mail_status = 1;
                try {
                    // Mail::to($data['email'])->send(new PaymentAcknowledgement($req->note, $payment_id));
                } catch (Exception $e) {
                    $mail_status = 0;
                }
                return response()->json($res->getResult());
            } else {
                throw new \Exception();
            }
 
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function validateForm(Request $request)
    {
        // session()->forget(['validateStatus','name','email']);
        session(['validateStatus' => 0]);

        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email:filter,rfc,dns'],
            'address1' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'zip' => ['required', 'regex:/^[0-9]{3}[-]?[0-9]{4}\z/'],
            'phone' => ['required', 'regex:/^0[0-9]{1,4}[-]?[0-9]{1,4}[-]?[0-9]{3,4}\z/'], 
        ]);

        $data = [
            'validateStatus' => 1,
            'name' => $request['name'],
            'email' => $request['email'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip' => $request['zip'],
            'phone' => $request['phone'],
        ];

        session()->put($data);
        session(['validateStatus' => true]);

        return back();
        // return redirect()->with($data);

    }
}
