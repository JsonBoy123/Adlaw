<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Mail;
use App\User;
use App\VerifyUser;
use App\Mail\UserMail;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Helpers\Helpers;
use App\Models\CaseStatusMast;
use Crypt;
class ClientsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
     
      $clients = user_clients()->paginate(10);  
      $status_types    = Status::get();
      return  view('clients.index',compact('clients','status_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $status_types    = Status::get();
      $cust_types = DB::table('cust_type_mast')->get();
      $states     = State::where('country_code',102)->get();
      $city = City::all();
      return view('clients.create', compact('status_types','cust_types','states','city'));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->client_validation($request);
        // return $request->all();
        // return $data;


        if($request->cust_type_id==1){
          $validate = $request->validate(['gender'=>'required|not_in:0']);
          $data['gender'] = $request->gender;
          Customer::create($data);
        // return $data;
          $this->create_account($data);
          return redirect()->route('clients.index')->with('success','Client Added and Account Created Successfully');
        
        }
        else{
          $validate = $request->validate(['company_name'=>'required|max:255|string']);
          $data['company_name'] = $validate['company_name'];
          Customer::create($data);
          $this->create_account($data);
          return redirect()->route('clients.index')->with('success','Client Added and Account Created Successfully');  
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      $client = Customer::where('cust_id',$id)->first();
      $case_status = CaseStatusMast::all();
      return  view('clients.show',compact('client','case_status'));

    }

    
    public function edit($id)
    {

        $status_types    = Status::get();
        $cust_types = DB::table('cust_type_mast')->get();
        $states     = State::where('country_code',102)->get();
        $client = Customer::where('cust_id', $id)->first();

        return view('clients.edit',compact('status_types','cust_types','states', 'client'));

    }

    public function update(Request $request, $id)
    {
      $customer = Customer::find($id);     
      $data = $this->client_validation($request,$id);

       if(Request()->cust_type_id==1)
        {

          $validate = $request->validate(['gender'=>'required|not_in:0']);
          $data['gender'] = $request->gender;
          $data['company_name'] = null;

          Customer::where('cust_id',$id)->update($data);
          if($customer->email != $request->email){
            return $this->create_account($data,$customer->email);
          }
          return redirect()->route('clients.index')->with('success','Client Updated Successfully');  
        }
        else{
          $validate = $request->validate(['company_name'=>'required|max:255|string']);
          $data['company_name'] = $validate['company_name'];
          $data['gender'] = null;
          $data['dob'] = null;
          Customer::where('cust_id',$id)->update($data);
          if($customer->email != $request->email){     
            return $this->create_account($data,$customer->email);
          }

          return redirect()->route('clients.index')->with('success','Client Updated Successfully');
        }
     
    }

   
    public function destroy($id)
    { 
       $client =  Customer::where('cust_id',$id)->first();
       // $cases = CaseMast::where('cust_id',$client->cust_id)->get();
       // foreach ($cases as $case) {
       //   $cas = CaseMast::where('case_id',$case->case_id)->first();
       //   // return $cas;
       // }
       // return $client;
        Customer::where('cust_id',$id)->delete();
        User::where('email',$client->email)->delete();

       return redirect()->route('clients.index')->with('success','Client Data Deleted Successfully');
    }
     public function client_validation($request,$id=null){

       $data = $request->validate([
            'cust_name'   => 'required|string|max:255',
            'cust_type_id'=> 'required|not_in:0',
            'status_id'   => 'required|not_in:0',
            'regsdate'    => 'required|date_format:Y-m-d',
            'mobile1'     => 'required|string|max:10|min:10',
            'email'       => 'required|email|unique:cust_mast'. ',email, '.$id.',cust_id',
            'dob'         => 'nullable|before:5 years ago|date_format:Y-m-d',
            'mobile2'     => 'nullable|string|max:11|min:10',
            'country_code'=> 'required',
            'state_code'  => 'required|not_in:0',
            'city_code'   => 'required|not_in:0',
            'zip_code'    => 'required',
            'adharno'     => 'nullable|string|max:12|min:12',
            'panno'       => 'nullable|string|max:11|min:9',
            'gstno'       => 'nullable|string|max:15|min:10',
            'tele'        => 'nullable|string|max:15|min:10',
            'user_id'     => 'required',
            // 'countfield'  => 'required',
            // 'p_name.*'    => 'nullable',
            // 'p_email.*'   => 'nullable',
            // 'p_mobile.*'  => 'nullable',
            // 'p_designation.*'=> 'nullable',
           
            
        ]
      );

        $state  = State::select('state_name')->where('state_code', $request->state_code)->first();
        $city = City::select('city_name')->where('city_code',$request->city_code)->first();
        $status = Status::select('status_desc')->where('status_id', $request->status_id)->first();
        $cust_types = DB::table('cust_type_mast')->select('cust_type_name')->where('cust_type_id',$request->cust_type_id)->first();

         $user_name = User::select('name')->where('id',$request->user_id)->first();

          $data['name'] = $user_name->name;
          $data['state_name'] = $state['state_name'];
          $data['city_name']  = $city['city_name'];
          $data['status_desc'] = $status['status_desc'];
          $data['cust_type_name'] =$cust_types->cust_type_name;
          $data['country_name'] ='India';
          $data['custaddr'] = $data['city_name']. ', '. $data['state_name']. ', '.$data['zip_code'].', '.$data['country_name'];

          return $data;


    }
     public function create_account($data,$oldEmail = null){
        $rand_no = rand(1111,9999);


        $password = str_limit($data['cust_name'],3,'@'.$rand_no);
        
        $clientData = [
            'name' => $data['cust_name'],
            'email' => $data['email'],
            'password'=> Hash::Make($password),
            'pwd'   => Crypt::encrypt($password),
            'status' => 'C',
            'user_catg_id' => '8',
            'parent_id' => Auth::user()->id,
            'mobile' => $data['mobile1']
        ]; 

     
        if($oldEmail !=null){
          $user = User::where('email',$oldEmail)->first();
          $user->update($clientData); 

        }else{
          $user = User::create($clientData);
          $user->attachRole($user->user_catg_id);
        }
        // return $clientData;
        $user->remember_token = str_random(40);
        $user->save();
        
        $user['password'] = $password;

       Mail::to($user->email)->send(new UserMail($user));
        
    }
    public function client_filter($status){
      $clients = user_clients($status)->paginate(10);
      return view('clients.table',compact('clients'));
    }

    public function client_fetch($id){
      $client =  Customer::select('cust_name','mobile1','email','custaddr')->where('cust_id',$id)->first();
      return $client;
    }



  // public function view_return($lawyer_view, $lawcompany_view){
  //   $catgId = Auth::user()->user_catg_id;

  //     switch ($catgId) {
  //       case '2':
  //           return $lawyer_view;
  //         break;
  //       case '3': 
  //             return $lawcompany_view;
  //       default:
  //             return view('error_pages.403page');
  //         break;
  //     }
  //  }
}

