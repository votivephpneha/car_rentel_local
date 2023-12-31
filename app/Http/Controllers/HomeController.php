<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\Helpers\Helper;
use Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['landing'] = DB::table('home_page')->where('id',2)->first();
        $data['ourmission'] = DB::table('pages')->where('type','mission')->first();
        $data['ourplan'] = DB::table('pages')->where('type','plan')->first();
        $data['ourteam'] = DB::table('pages')->where('type','teamts')->first();
        $data['ourteams'] = DB::table('pages')->where('type','team')->get();
        $data['faqs'] = DB::table('pages')->where('type','faq')->get();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        $data['brands'] = DB::table('home_page_logos')->get();
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return view('front/index')->with($data);
    }

    public function baseForm()
    {
        return view('front/base_from');
    }

    public function signup(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $checkUserEmail = DB::table('users')->where('email', $request->semail)->first(); 
        if (empty($checkUserEmail)) 
        {
            $user = new User;
            $user->first_name = $request->name;
            $user->email = $request->semail;
            $user->contact_number = $request->phone_no;
            $user->password = bcrypt($request->spassword);
            $user->user_type = "normal_user";
            $user->role_id = 2;
            $addUser = $user->save();

            $data['check_send_email'] = DB::table('users')->where('email', $request->semail)->first(); 
            if ($addUser) 
            {
                if ($_SERVER['SERVER_NAME'] != 'localhost') {

                    $fromEmail = Helper::getFromEmail();
                    $inData['from_email'] = $fromEmail;
                    $inData['email'] = $request->semail;
            
                    Mail::send('email.test', $data, function ($message) use ($inData) {
                        $message->from($inData['from_email'],'RoadNStays');
                        $message->to('votivephp.rahulraj@gmail.com');
                        $message->subject('RoadNStays - New Registration');
                    });
            
                }
                // Auth::guard("web")->login($user);
                return response()->json(['status' => 'success','msg' => 'User Created Successfully']);
            }
        }else{
            return response()->json(['status' => 'error','msg' => 'The email has already been taken']);
        }
    }

    
    // public function postLogin(Request $request)
    // {
    //     $user_obj = User::where('email', '=', $request->email)->first();
    //     // if (!empty($user_obj->id) and $user_obj->role_id == 2) {
    //     if (!empty($user_obj->id)) {

    //         if($user_obj->role_id == 2){
    //             $credentials = $request->only('email', 'password');
    //             if (Auth::attempt($credentials)) {
    //                 return response()->json(['status' => 'success' ,'role' => 'user','msg' => 'Login Successfully.']);
    //             } else {
    //                 return response()->json(['status' => 'error', 'msg' => 'Invalid Credential.']);
    //             }
    //         }else if($user_obj->role_id == 4){
    //             $credentials = $request->only('email', 'password');
    //             // auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])
    //             if (Auth::attempt($credentials)) {
    //             // if (auth()->guard('servicepro')->attempt($credentials)) {
    //                 return response()->json(['status' => 'success','role' => 'vendor' ,'msg' => 'Login Successfully.']);
    //             } else {
    //                 return response()->json(['status' => 'error','msg' => 'Invalid Credential.']);
    //             }
    //         }else{
    //             return response()->json(['status' => 'error','msg' => 'Something get Wrong.']);
    //         }
    //     }else{
    //         return response()->json(['status' => 'error','msg' => 'Email address not registered.']);
    //     }
    // }

    public function postLogin(Request $request)
    {
        $user_obj = User::where('email', '=', $request->email)->first();
        if (!empty($user_obj->id)) {
            if($user_obj->role_id == 2){
                if($user_obj->status == 1){
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {
                        return response()->json(['status' => 'success' ,'role' => 'user','msg' => 'Login Successfully.']);
                    } else {
                        return response()->json(['status' => 'error', 'msg' => 'Invalid Credential.']);
                    }
                }else{
                    return response()->json(['status' => 'error','msg' => 'Your account is not activated by Administrator.']);
                }
            }else{
                return response()->json(['status' => 'error' ,'role' => 'other','msg' => 'Email address not registered.']);
            }
        }else{
            return response()->json(['status' => 'error','msg' => 'Email address not registered.']);
        }
    }

    public function serviceProPostLogin(Request $request)
    {
        $user_obj = User::where('email', '=', $request->vlemail)->first();
        // print_r($request->all());
        // if (!empty($user_obj->id) and $user_obj->role_id == 2) {
        if (!empty($user_obj->id)) {

            if($user_obj->role_id == 4){
                if($user_obj->status == 1){
                    // $credentials = $request->only('email', 'password');
                    // auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])
                    if (Auth::attempt(['email' => $request->input('vlemail'), 'password' => $request->input('vlpassword')])) {
                    // if (auth()->guard('servicepro')->attempt($credentials)) {
                        return response()->json(['status' => 'success','role' => 'vendor' ,'msg' => 'Login Successfully.']);
                    }else {
                        return response()->json(['status' => 'error','msg' => 'Invalid Credential.']);
                    }
                }else{
                    return response()->json(['status' => 'error','msg' => 'Your account is not activated by Administrator.']);
                }
            }else{
                return response()->json(['status' => 'error' ,'role' => 'other','msg' => 'Email address not registered.']);
            }
        }else{
            return response()->json(['status' => 'error','msg' => 'Email address not registered.']);
        }
    }

    public function vendorSignup(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $checkUserEmail = DB::table('users')->where('email', $request->vsemail)->first(); 
        if (empty($checkUserEmail)) 
        {
            $user = new User;
            $user->first_name = $request->vsname;
            $user->email = $request->vsemail;
            $user->contact_number = $request->vsphone_no;
            $user->password = bcrypt($request->vspassword);
            $user->user_type = "service_provider";
            $user->role_id = 4;
            $addUser = $user->save();
            if ($addUser) 
            {
                // Auth::guard("web")->login($user);
                return response()->json(['status' => 'success','msg' => 'User Created Successfully']);
            }
        }else{
            return response()->json(['status' => 'error','msg' => 'The email has already been taken']);
        }
    }

    public function userProfile(Request $request)
    {
        return view('front.dashboard');
    }

    public function serviceProProfile(Request $request)
    {
        return view('front.dashboard');
    }

    // public function create(array $data)
    // {
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    // }
    
    public function profile(Request $request)
    {
        if(!empty($request->id))
        {
            $updata = DB::table('users')->where('id', $request->id)->update(['name' => $request->name]);
            if(!empty($updata))
            {
                return response()->json(['status' => 'success', 'msg' => 'Profile Updated Successfully']);
            }else{
                return response()->json(['status' => 'error', 'msg' => 'Not Updated any Value']);
            }
        }

        $data['profile_detail'] = DB::table('users')->get();
        return view('front/profile')->with($data);
    }

    public function updateProfile(Request $request)
    {
        $user_id = Auth::user()->id;
        if($user_id){
            DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'first_name' => $request->puname,
                    'email' => $request->puemail,
                    'contact_number' => $request->puphone_no,
                    'user_city' => $request->city,
                    'state_id' => $request->state,
                    'user_country' => $request->country,
                    'address' => $request->address,
                    'postal_code' => $request->zip_code,
                ]);
            return response()->json(['status' => 'success', 'msg' => 'Profile Updated']);
        }
    }

    public function updateProImg(Request $request)
    {
        $user_id = Auth::user()->id;
        if($user_id){
            if($request->hasFile('imageFile'))
            {
                $image_name = $request->file('imageFile')->getClientOriginalName();
                $filename = pathinfo($image_name,PATHINFO_FILENAME);
                $image_ext = $request->file('imageFile')->getClientOriginalExtension();
                $fileNameToStore = $filename.'-'.time().'.'.$image_ext;
                $path = base_path() . '/public/uploads/profile_img/';
                $request->file('imageFile')->move($path, $fileNameToStore);
                
            }else{
                $fileNameToStore = 'user.jpg';
            }
            DB::table('users')->where('id', $user_id)->update(['profile_pic' => $fileNameToStore]);
            return response()->json(['status' => 'success', 'msg' => 'Profile Image Updated']);
        }
    }

    public function change_password(Request $request)
    {
        // echo "<pre>";print_r(Auth::user());die;
        $data = $request->all(); 
        
        $user_obj = User::where('id', '=', 1)->first();
        if(!empty($data)){
              
            if (!empty($user_obj->id) and $user_obj->id == 1) {
                // echo "<pre>";print_r($data);
                // echo "<pre>";print_r($user_obj);
                // $check_pwd = Hash::make($data['old_password']);
                // echo "<pre>";print_r($check_pwd);
                // die; 
                $user_id =  $user_obj->id;
                if(!\Hash::check($data['old_password'], $user_obj->password)){
                    return response()->json(['status' => 'error', 'msg' => 'You have entered wrong password']);
                }else{
                    $user_id = $user_obj->id;
                    $password = bcrypt($request->input('new_password'));
                    // echo "<pre>";print_r($request->input('new_password'));die; 
                    $checkda = DB::update('update users set password = ? where id = 1',[$password]);
                    return response()->json(['status' => 'success', 'msg' => 'Password Updated Successfully']);
                }
            }
        }    
        return view('front/change_password');
    }

    public function userLogout()
    {
        // Auth::guard('web')->logout();
        Auth::logout();
        return redirect()->route('home');
    }


    public function serviceProDashboard(Request $request)
    {
        return view('service_provider.dashboard');
    }

    public function serviceProLogout()
    {
        // Auth::guard('servicepro')->logout();
        Auth::logout();
        return redirect()->route('home');
    }

    public function forgotPassword_action(Request $request)
    {
        $email = $request->forgetEmail;

        $token = Str::random(64);

        $reseturll = url('/resetPassword/');

        $checkuser = DB::table('users')->where(['email' => $email])->first();
        // print_r($checkuser);die;

        if(!empty($checkuser)){
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
    
            $data = array( 'email' => $email, 'token' => $token , 'reseturll' => $reseturll);
    
            // Mail::send("email.forgotPasswordMail",$data,function($message) use ($data) {
    
            //     $message->from('info@votivelaravel.in', 'votivelaravel.in');
        
            //     $message->subject("Forgot Password");
        
            //     $message->to($data['email']);
        
            // });

            $fromEmail = Helper::getFromEmail();
            $inData['from_email'] = $fromEmail;
            $inData['email'] = $email;
    
            Mail::send('email.emailtemplate', $data, function ($message) use ($inData) {
                $message->from($inData['from_email'],'RoadNStays');
                $message->to('votivephp.rahulraj@gmail.com');
                $message->subject('RoadNStays - New Registration');
            });

            return response()->json(['status' => 'success','msg' => 'Please check your email address..']);
            // return Redirect::back()->with('msg', "Please check your email address..");
        }else{
            return response()->json(['status' => 'error','msg' => 'Please enter vaild mail-id!']);
            // return Redirect::back()->with('error', "Please enter vaild mail-id!");
        }                                

    }


    public function add_news_action(Request $request)
    {
        $newsemail = $request->user_id;

        $type = 'news';

        $checkUser = DB::table('newsletter')->where('email', $newsemail)->where('type', $type)->where('status', 1)->first();

        if($checkUser){

        return response()->json(['status' => 'success', 'msg' => 'Newsletter is already subscribe.']);

        }else{
            
            $obj = new Newsletter;
            $obj->email = $newsemail;
            $obj->type = $type;
            $obj->status = 1;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->updated_at = date('Y-m-d H:i:s');
            $res = $obj->save();

            if($res){            

               return response()->json(['status' => 'success', 'msg' => 'Newsletter has been subscribe successfully.']);

            }else{

                return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);

            }
        } 

    }


    public function add_help_action(Request $request)
    {

        $helpemail = $request->user_id;

        $message = $request->message;

        $type = 'help';

        $checkUser = DB::table('newsletter')->where('email', $helpemail)->where('type', $type)->where('status', 1)->first();

        if($checkUser){

        return response()->json(['status' => 'success', 'msg' => 'Message is already send.']);

        }else{
            
            $obj = new Newsletter;
            $obj->email = $helpemail;
            $obj->message = $message;
            $obj->type = $type;
            $obj->status = 1;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->updated_at = date('Y-m-d H:i:s');
            $res = $obj->save();

            if($res){            

            return response()->json(['status' => 'success', 'msg' => 'Message has been send successfully.']);

            }else{

            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);

            }
        } 

    }

    public function cms_page(Request $request) 
    {

        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['landing'] = DB::table('home_page')->where('id',2)->first();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        $pageurl = $request->pageurl;
        $data['page_content'] = DB::table('pages')->where('page_url',$pageurl)->first();
        return view('front/page')->with($data);
    }

    public function car_list(Request $request){
        $pickup_date = $request->pickup_date;
        
        $drop_off_date = $request->drop_off_date;
        
        $pickup_location = $request->pickup_location;
        $drop_off_location = $request->drop_off_location;

        
        $date1 = date_create($pickup_date);
        $date2 = date_create($drop_off_date);
        $diff = date_diff($date1,$date2);
        $diff1 = $diff->format("%a");
        if($diff1<1){
            $data['date_diff'] = 1;
        }else{
            $data['date_diff'] = $diff1;
        }
        

        session::put("pickup_date",$pickup_date);
        session::put("drop_off_date",$drop_off_date);
        session::put("pickup_location",$pickup_location);
        session::put("drop_off_location",$drop_off_location);
        session::put("date_diff",$data['date_diff']);


        
        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        $data['car_list'] = DB::table('car_management')->where('status','1')->get();
        $data['category_list'] = DB::table('categories')->get();
        return view("front/car_list")->with($data);
    }

    public function get_cars(Request $request){
        $data['date_diff'] = session::get("date_diff");

        $cat_json = json_decode($request->vehicle_type);
        
        $cat_array = (array)$cat_json;
        //print_r($cat_array);die;
        $vehicle_category = $cat_array['vehicle_category'];
        $vehicle_type = $cat_array['vehicle_type'];
        //print_r($request->category);die;
        if(!empty($vehicle_category)){
            $data['car_list'] = DB::table('car_management')->where('vehicle_type',$vehicle_type)->where('vehicle_category',$vehicle_category)->get();
            
        }else{
            $data['car_list'] = DB::table('car_management')->where('vehicle_type',$vehicle_type)->get();
        }
        
        
        return view("front/get_car_list")->with($data);
    }

    public function car_list_category(Request $request){
        $data['date_diff'] = session::get("date_diff");
        $cat_json = json_decode($request->vehicle_category);
        
        $cat_array = (array)$cat_json;
        //print_r($cat_array);die;
        $vehicle_category = $cat_array['vehicle_category'];
        $vehicle_type = $cat_array['vehicle_type'];
        if(!empty($vehicle_type)){
            
            $data['car_list'] = DB::table('car_management')->where('vehicle_category',$vehicle_category)->where('vehicle_type',$vehicle_type)->get();
        }else{
            $data['car_list'] = DB::table('car_management')->where('vehicle_category',$vehicle_category)->get();
        }
        return view("front/get_car_list")->with($data);
    }

    public function booking(Request $request){
        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        $data['countries_list'] = DB::table('country')->get();
        
        $data['car_id'] = $request->car_id;
        return view("front/booking")->with($data);
    }

    public function submit_booking(Request $request){
        $email_address = $request->email_address;
        $car_id = $request->car_id;
        $title = $request->title;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $contact_no = $request->phone;
        $country = $request->country;
        $flight_no = $request->flight_no;
        $customer_notes = $request->customer_notes;

        session::put("email_address",$email_address);
        session::put("title",$title);
        session::put("first_name",$first_name);
        session::put("last_name",$last_name);
        session::put("phone",$contact_no);
        session::put("country",$country);
        session::put("flight_no",$flight_no);
        session::put("customer_notes",$customer_notes);



        return redirect("payment/".$car_id);

        //$insert_booking = DB::table('home_page_logos')->insert(['image'=>$file_name,'created_at'=>date('Y-m-d H:i:s')]);
    }

    public function payment_page(Request $request){
        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        $email_address = session::get("email_address");
        $title = session::get("title");
        $first_name = session::get("first_name");
        $last_name = session::get("last_name");
        $contact_no = session::get("phone");
        $country = session::get("country");
        $flight_no = session::get("flight_no");
        $pickup_date = session::get("pickup_date");
        $drop_off_date = session::get("drop_off_date");
        $pickup_location = session::get("pickup_location");
        $drop_off_location = session::get("drop_off_location");
        $date_diff = session::get("date_diff");
        $customer_notes = session::get("customer_notes");

        $data['car_data'] = DB::table('car_management')->where('id',$request->car_id)->first();

        $data['get_user_data'] = array("email_address"=>$email_address,"title"=>$title,"first_name"=>$first_name,"last_name"=>$last_name,"contact_no"=>$contact_no,"country"=>$country,"flight_no"=>$flight_no,"pickup_date"=>$pickup_date,"drop_off_date"=>$drop_off_date,"pickup_location"=>$pickup_location,"drop_off_location"=>$drop_off_location,"date_diff"=>$date_diff,"customer_notes"=>$customer_notes);

        return view("front/payment")->with($data);
    }

    public function submit_payment(Request $request){
        $booking_id = "booking-".mt_rand(1000,9999);
        $email_address = $request->email_address;
        $title = $request->title;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $contact_no = $request->contact_no;
        $country = $request->country;
        $flight_no = $request->flight_no;
        $customer_notes = $request->customer_notes;
        $total_price = $request->total_price;
        $vehicle_id = $request->vehicle_id;
        $pickup_date = session::get("pickup_date");
        $drop_off_date = session::get("drop_off_date");
        $pickup_location = session::get("pickup_location");
        $drop_off_location = session::get("drop_off_location");

        $insert_booking = DB::table('booking_management')->insert(["booking_id"=>$booking_id,"driver_email_address"=>$email_address,"title"=>$title,"driver_first_name"=>$first_name,"driver_last_name"=>$last_name,"driver_contact_no"=>$contact_no,"driver_country"=>$country,"flight_no"=>$flight_no,"customer_notes"=>$customer_notes,"total"=>$total_price,"booking_status"=>"1","payment_method"=>"Cash On Delivery",'created_at'=>date('Y-m-d H:i:s')]);
        $insert_booking = DB::table('booking_details')->insert(["booking_id"=>$booking_id,"vehicle_id"=>$vehicle_id,"from_date"=>$pickup_date,"to_date"=>$drop_off_date,"price"=>$total_price,'created_at'=>date('Y-m-d H:i:s')]);
        $insert_payment = DB::table('payment_transaction')->insert(["booking_id"=>$booking_id,"total"=>$total_price,"payment_status"=>"0",'created_at'=>date('Y-m-d H:i:s')]);

        
        //return view("front/booking_invoice",['email'=>$email_address,'booking_id'=>$booking_id,'pickup_location'=>$pickup_location,'drop_off_location'=>$drop_off_location,'pickup_date'=>$pickup_date,'drop_off_date'=>$drop_off_date]);
        
         $token = Str::random(64);
         $users = DB::table('users')->where('id',1)->first();

         Mail::send('Front.booking_invoice', ['token' => $token,'email'=>$email_address,'booking_id'=>$booking_id,'pickup_location'=>$pickup_location,'drop_off_location'=>$drop_off_location,'pickup_date'=>$pickup_date,'drop_off_date'=>$drop_off_date], function($message) use($request,$users){
                    $message->to($request->email_address);
                    $message->cc($users->email,'Royal Car Rentel');
                    $message->from('votivephp.neha@gmail.com','Royal Car Rentel');

                    $message->subject('Booking Invoice');

        });

        if($insert_booking){
            session::flash("success","Your order has been submitted successfully");
            return redirect("thankyou");
        }
    }

    public function thankyou(){
        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        return view("front/thankyou")->with($data);
    }

    public function get_address(Request $request){

        $address_data = DB::table('address_table')->orWhere('address', 'like', '%' . $request->address_value . '%')->get();
        foreach ($address_data as $address) {
            echo "<option class='address-".$address->id."' onclick='getAddress(".$address->id.")'>".$address->address."</option>";
        }
        
    }

    public function get_dropoff_address(Request $request){

        $address_data = DB::table('address_table')->orWhere('address', 'like', '%' . $request->address_value . '%')->get();
        foreach ($address_data as $address) {
            echo "<div style='cursor:pointer' class='address-".$address->id."' onclick='getDropoffAddress(".$address->id.")'>".$address->address."</div>";
        }
        
    }

    public function manage_booking(Request $request){
        $booking_id = $request->booking_id;
        $email = $request->email;

        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        $data['pages'] = DB::table('pages')->where('type','cms')->where('status','1')->get();
        $data['booking_details'] = DB::table('booking_management')->where('booking_id',$booking_id)->where('driver_email_address',$email)->get()->first();
        $data['business_list'] = DB::table('users')->where("user_type","business_user")->get();
        //print_r($data['booking_details']);die;
        if(!empty($data['booking_details'])){
            $data['booking_data'] = DB::table('booking_details')->where("booking_id",$data['booking_details']->booking_id)->get();
        }
        return view("front/manage_booking")->with($data);

    }


}
