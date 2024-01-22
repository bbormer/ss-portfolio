<?php

namespace App\Livewire;

use Livewire\Component;
use Square\SquareClient;
use PHPUnit\Framework\Constraint\IsFalse;

use App\Mail\PaymentAcknowledgement;
use Square\Models\Money;
use Square\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Square\Models\CreatePaymentRequest;

class Order extends Component
{
    public $name;
    public $email;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zip;
    public $phone;

    public $shipInfoStatus;
    public $displayCard;


    public $amount;
    public $shipping;
    public $title_ja;
    public $title_en;

    public function __construct()
    {
        $this->client = new SquareClient([
            'accessToken' => config('square.token'),
            'environment' => config('square.env'),
        ]);

        $this->shipInfoStatus = false;
    }

    public function mount() 
    {
        $this->shipInfoStatus = false;
        $this->displayCard = false;
        // dd(session()->get('pass'));
    }

    public function displayCard()
    {
        dd($this->displayCard);
        $this->displayCard = true;
    }

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
                    Mail::to($data['email'])->send(new PaymentAcknowledgement($req->note, $payment_id));
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

    public function render()
    {
        // return view('livewire.order');
        return view('livewire.order', [
            'name' => $this->name,
            'email' => $this->email,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'phone' => $this->phone,
            'amount' => $this->amount,
            'shipping' => $this->shipping,
            'title_ja' => $this->title_ja,
            'title_en' => $this->title_en,
        ]);
    }

    public function validateForm()
    {
        $this->shipInfoStatus = false;

        $this->validate([
            'name' => 'required',
            'email' => ['required', 'email:filter,rfc,dns'],
            'address1' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'zip' => ['required', 'regex:/^[0-9]{3}[-]?[0-9]{4}\z/'],
            'phone' => ['required', 'regex:/^0[0-9]{1,4}[-]?[0-9]{1,4}[-]?[0-9]{3,4}\z/'], 
        ]);
        
       $this->shipInfoStatus = true;
       session()->put('validateStatus', true);
       session()->put('city', $this->city);
    //    session(['validateStatus' => true]);
       session(['email' => $this->email]);
    //    session(['city' => $this->city]);
       session(['state' => $this->state]);
    //    $this->xcity = $this->city;
      
    //    $data = [
    //     'validateStatus' => 1,
    //     'name' => $this->name,
    //     'email' => $this->email,
    //     'address1' => $this->address1,
    //     'address2' => $this->address2,
    //     'city' => $this->city,
    //     'state' => $this->state,
    //     'zip' => $this->zip,
    //     'phone' => $this->phone,
    // ];

    // session()->put($data);
       
    }
    
    
}