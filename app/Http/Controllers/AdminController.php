<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated; 
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; 
use App\Models\User;
use App\Models\Pages;
use App\Models\Newsletter;
use App\Models\Homepage; 
use DB;
use Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function login()
    {
        $data['page_info'] = DB::table('home_page')->where('id',1)->first();
        return view('admin.login')->with($data);;
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // echo "<pre>";print_r($request->all());die;
        // auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])
        // echo auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);die;
        // $credentials = $request->only('email', 'password');
        // $data = auth()->guard('admin')->attempt($credentials);
        // echo "<pre>";print_r($data);die;
        // echo "<pre>";print_r($credentials);die;
        
        // echo (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->get('remember')));die;

        if(Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->get('remember'))){
            // echo "<pre>";print_r('inside');die;
            // return redirect()->route('admin.dashboard');
            return response()->json(['status' => 'success', 'msg' => 'Login Successfully']);
        }else{
            // session()->flash('error', 'Incorrect Credential');
            // return back()->with($request->only('email'));
            return response()->json(['status' => 'error', 'msg' => 'Incorrect Credential']);
        }

        // $userCredentials = $request->only('email', 'password');
        // $teachers=Admin::where($userCredentials)->first();
        // echo "<pre>";print_r($teachers);die;
        // if ($teachers=Admin::where($userCredentials)->first()) {
        //     echo "<pre>";print_r($teachers);die;
        //     auth()->login($teachers);
        //     return redirect()->route('admin.dashboard');
        // }
        // else {
        //     return back()->with($request->only('email'));
        // }
    }

    public function dashboard()
    {

        $totaluser = DB::table('users')->where("user_type","normal_user")->orWhere("user_type","business_user")->get();


        $data['total_user'] = count($totaluser);

        // echo "<pre>";print_r($profile_detail);die;
        return view('admin/dashboard')->with($data);

        //return view('admin.dashboard');

        // if(Auth::check()){
        //     return view('admin.dashboard');
        // }
  
        // return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function profile(Request $request)
    {
        // dd($request->all());
        if(!empty($request->id))
        {
            $updata = DB::table('admins')->where('id', $request->id)->update(['name' => $request->name]);
            if(!empty($updata))
            {
                return response()->json(['status' => 'success', 'msg' => 'Profile Updated Successfully']);
            }else{
                return response()->json(['status' => 'error', 'msg' => 'Not Updated any Value']);
            }
        }

        $data['profile_detail'] = DB::table('admins')->get();
        // echo "<pre>";print_r($profile_detail);die;
        return view('admin/profile')->with($data);
    }

    public function change_password(Request $request)
    {
        // dd($request->all());
        // echo "<pre>";print_r(Auth::user());die;
        $data = $request->all(); 
        
        $user_obj = Admin::where('id', '=', 1)->first();
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
                    if($checkda){
                        // echo "<pre>";print_r($checkda);die;
                    }else{
                        // echo "<pre>";print_r($checkda);die;
                    }
        
                    return response()->json(['status' => 'success', 'msg' => 'Password Updated Successfully']);
                }
            }
        }    
        // if(!empty($request->id))
        // {
        //     $updata = DB::table('admins')->where('id', $request->id)->update(['name' => $request->name]);
        //     if(!empty($updata))
        //     {
        //         return response()->json(['status' => 'success', 'msg' => 'Profile Updated Successfully']);exit();
        //     }else{
        //         return response()->json(['status' => 'error', 'msg' => 'Not Updated any Value']);exit();
        //     }
        // }
        // $data['profile_detail'] = DB::table('admins')->get();
        // echo "<pre>";print_r($profile_detail);die;
        return view('admin/change_password');
    }
    
    // public function logout() {
    //     Session::flush();
    //     Auth::logout();
  
    //     return Redirect('/');
    // }

    // public function logout() {
    //     // Auth::guard('admin')->logout();
    //     Session::flush();
    //     Auth::logout();
    //     return redirect()->route('admin.login');
    // }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function cms_page() 
    {

      $data['pageList'] = DB::table('pages')->where('type', 'cms')->orderby('id', 'ASC')->get();
      return view('admin/cms/page_list')->with($data);

    }

    public function add_page(Request $request)
    {
      $data['countries'] = DB::table('country')->orderby('name', 'ASC')->get();
      return view('admin/cms/add_page')->with($data);
    }

    public function add_page_action(Request $request)
    {
        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;

        $slug = str_replace('?','',strtolower(str_replace(" ","-",$pagetitle)));//$this->attributes['slug'] = str_slug($subtitle);

        $type = 'cms';

        $checkUser = DB::table('pages')->where('page_title', $pagetitle)->first();

        if($checkUser){

            return redirect('admin/content_management')->with('message', 'Page is already Added.');

        }else{
            $vrfn_code = '123456';//Helper::generateRandomString(6);
            
            $obj = new Pages;
            $obj->page_url = $slug;
            $obj->page_title = $pagetitle;
            $obj->page_content = $content;
            $obj->sub_title = $subtitle;
            $obj->type = $type;
            $obj->status = 1;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->updated_at = date('Y-m-d H:i:s');
            $res = $obj->save();

            if ($res) {
				
				return redirect('admin/content_management')->with('message', 'Page has been created successfully.');

               // return response()->json(['status' => 'success', 'msg' => 'Page has been created successfully.']);

            } else {
				return redirect('admin/content_management')->with('message', 'OOPs! Some internal issue occured.');
                //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);

            }
        } 

    }

    public function edit_page(Request $request){
        $page_id = $request->id;
        $data['page_info'] = Pages::find($page_id);
        $countries = DB::select('select * from country');
        return view('admin/cms/edit_page',["countries"=>$countries])->with($data) ;
    }

    
    public function page_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = str_replace('?','',strtolower(str_replace(" ","-",$pagetitle)));//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'cms';

        $userData = Pages::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/content_management')->with('message', 'Page has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/content_management')->with('message', 'OOPs! Some internal issue occured.');			
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

    public function change_page_status(Request $request)
    {

        $user = Pages::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Page status change successfully.']);
    }

    public function deletepage(Request $request) {
        $user_id = $request->user_id;
        //$frame_info = DB::table('pages')->where('id',$user_id)->first();
        $res = DB::table('pages')->where('id', '=', $user_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Page has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }

    }

    /* Home page manage */

        public function home_management(Request $request){
      
        $data['page_info'] = DB::table('home_page')->where('id', '=', 1)->first();

        return view('admin/cms/home_update')->with($data) ;
    }

    
    public function update_home(Request $request){

        $home_logo = '';
        $banner_content = $request->banner_content;
        $banner_content2 = $request->banner_content2;
        $button_name = $request->button_name;
        $button_link = $request->button_link;
        $footer_content = $request->footer_content;
        $discord_link = $request->discord_link;
        $twitter_link = $request->twitter_link;
        $footer_copy = $request->footer_copy;

        $request->hasFile("home_logo") ? $request->file("home_logo")->move("public/uploads/", $home_logo = time().strtolower(trim($request->file('home_logo')->getClientOriginalName()))) : '';

        if(empty($home_logo)){ $home_logo = $request->logo_img_old; }


        $homeData = Homepage::where('id', 1)->first();
    
        $homeData->home_logo = $home_logo;
        $homeData->banner_content = $banner_content;
        $homeData->banner_content2 = $banner_content2;
        $homeData->button_name = $button_name;
        $homeData->button_link = $button_link;
        $homeData->footer_content = $footer_content;
        $homeData->discord_link = $discord_link;
        $homeData->twitter_link = $twitter_link;
        $homeData->footer_copy = $footer_copy;
        $homeData->updated_at = date('Y-m-d H:i:s');
        $res = $homeData->save();

        if($res){

            return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{

            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

    /* Home page end */
	
	
    /* Landing page manage */

        public function landing_management(Request $request){
      
        $data['page_info'] = DB::table('home_page')->where('id', '=', 2)->first();

        return view('admin/cms/landing_update')->with($data) ;
    }

    
    public function update_landing(Request $request){

        $home_logo = '';
        $banner_content = $request->banner_content;
        $banner_content2 = $request->banner_content2;
        $button_name = $request->button_name;
        $button_link = $request->button_link;
        $footer_content = $request->footer_content;
        $discord_link = $request->discord_link;
        $twitter_link = $request->twitter_link;

        $logo_name = $request->logo_name;
        $top_button_name = $request->top_button_name;
        $top_button_link = $request->top_button_link;

        $discord_title1 = $request->discord_title1;
        $discord_title2 = $request->discord_title2;
        $discord_button_name = $request->discord_button_name; 
        $discord_button_link = $request->discord_button_link;

        $news_title1 = $request->news_title1;
        $news_title2 = $request->news_title2;

        $heading_one = $request->heading_one;
        $heading_two = $request->heading_two;
        $heading_three = $request->heading_three;

        $content_one = $request->content_one;
        $content_two = $request->content_two;
        $content_three = $request->content_three;

        $heading_one_it = $request->heading_one_it;
        $heading_two_it = $request->heading_two_it;
        $heading_three_it = $request->heading_three_it;

        $content_one_it = $request->content_one_it;
        $content_two_it = $request->content_two_it;
        $content_three_it = $request->content_three_it;

        $request->hasFile("home_logo") ? $request->file("home_logo")->move("public/uploads/landing/", $home_logo = time().strtolower(trim($request->file('home_logo')->getClientOriginalName()))) : '';

        if(empty($home_logo)){ $home_logo = $request->logo_img_old; }

        /****/

        $ingos_logo1 = '';
        $request->hasFile("ingos_logo1") ? $request->file("ingos_logo1")->move("public/uploads/landing/", $ingos_logo1 = time().strtolower(trim($request->file('ingos_logo1')->getClientOriginalName()))) : '';
        if(empty($ingos_logo1)){ $ingos_logo1 = $request->ingos_logo1_old; }

                $ingos_logo2 = '';
        $request->hasFile("ingos_logo2") ? $request->file("ingos_logo2")->move("public/uploads/landing/", $ingos_logo2 = time().strtolower(trim($request->file('ingos_logo2')->getClientOriginalName()))) : '';
        if(empty($ingos_logo2)){ $ingos_logo2 = $request->ingos_logo2_old; }

                $ingos_logo3 = '';
        $request->hasFile("ingos_logo3") ? $request->file("ingos_logo3")->move("public/uploads/landing/", $ingos_logo3 = time().strtolower(trim($request->file('ingos_logo3')->getClientOriginalName()))) : '';
        if(empty($ingos_logo3)){ $ingos_logo3 = $request->ingos_logo3_old; }

                $ingos_logo4 = '';
        $request->hasFile("ingos_logo4") ? $request->file("ingos_logo4")->move("public/uploads/landing/", $ingos_logo4 = time().strtolower(trim($request->file('ingos_logo4')->getClientOriginalName()))) : '';
        if(empty($ingos_logo4)){ $ingos_logo4 = $request->ingos_logo4_old; }

                $ingos_logo5 = '';
        $request->hasFile("ingos_logo5") ? $request->file("ingos_logo5")->move("public/uploads/landing/", $ingos_logo5 = time().strtolower(trim($request->file('ingos_logo5')->getClientOriginalName()))) : '';
        if(empty($ingos_logo5)){ $ingos_logo5 = $request->ingos_logo5_old; }

                $ingos_logo6 = '';
        $request->hasFile("ingos_logo6") ? $request->file("ingos_logo6")->move("public/uploads/landing/", $ingos_logo6 = time().strtolower(trim($request->file('ingos_logo6')->getClientOriginalName()))) : '';
        if(empty($ingos_logo6)){ $ingos_logo6 = $request->ingos_logo6_old; }

        $request->hasFile("image_one") ? $request->file("image_one")->move("public/uploads/landing/", $image_one = time().strtolower(trim($request->file('image_one')->getClientOriginalName()))) : '';
        if(empty($image_one)){ $image_one = $request->image_one_old; }


        $request->hasFile("image_two") ? $request->file("image_two")->move("public/uploads/landing/", $image_two = time().strtolower(trim($request->file('image_two')->getClientOriginalName()))) : '';
        if(empty($image_two)){ $image_two = $request->image_two_old; }

        $request->hasFile("image_three") ? $request->file("image_three")->move("public/uploads/landing/", $image_three = time().strtolower(trim($request->file('image_three')->getClientOriginalName()))) : '';
        if(empty($image_three)){ $image_three = $request->image_three_old; }

      /******/  


        $homeData = Homepage::where('id', 2)->first();
    
        $homeData->home_logo = $home_logo;
        $homeData->banner_content = $banner_content;
        $homeData->banner_content2 = $banner_content2;
        $homeData->button_name = $button_name;
        $homeData->button_link = $button_link;
        $homeData->footer_content = $footer_content;
        $homeData->discord_link = $discord_link;
        $homeData->twitter_link = $twitter_link;

        $homeData->logo_name = $logo_name;
        $homeData->top_button_name = $top_button_name;
        $homeData->top_button_link = $top_button_link;

        $homeData->discord_title1 = $discord_title1;
        $homeData->discord_title2 = $discord_title2;
        $homeData->discord_button_name = $discord_button_name;
        $homeData->discord_button_link = $discord_button_link;

        $homeData->news_title1 = $news_title1;
        $homeData->news_title2 = $news_title2;

        $homeData->ingos_logo1 = $ingos_logo1;
        $homeData->ingos_logo2 = $ingos_logo2;
        $homeData->ingos_logo3 = $ingos_logo3;
        $homeData->ingos_logo4 = $ingos_logo4;
        $homeData->ingos_logo5 = $ingos_logo5;
        $homeData->ingos_logo6 = $ingos_logo6;

        $homeData->image_one = $image_one;
        $homeData->image_two = $image_two;
        $homeData->image_three = $image_three;

        $homeData->heading_one = $heading_one;
        $homeData->heading_two = $heading_two;
        $homeData->heading_three = $heading_three;

        $homeData->content_one = $content_one;
        $homeData->content_two = $content_two;
        $homeData->content_three = $content_three;

        $homeData->heading_one_it = $heading_one_it;
        $homeData->heading_two_it = $heading_two_it;
        $homeData->heading_three_it = $heading_three_it;

        $homeData->content_one_it = $content_one_it;
        $homeData->content_two_it = $content_two_it;
        $homeData->content_three_it = $content_three_it;

        $homeData->updated_at = date('Y-m-d H:i:s');
        $res = $homeData->save();

        if($res){

            return redirect('admin/landing_management')->with('message', 'Page has been updated successfully.');    

        }else{

            return redirect('admin/landing_management')->with('message', 'OOPs! Some internal issue occured.');  
        } 
    }

    /* Landing page end */


     public function our_mission(Request $request){
        $page_id = 10;
        $data['page_info'] = Pages::find($page_id);
        return view('admin/cms/our_mission')->with($data) ;
    } 

        public function mission_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'mission';

        $userData = Pages::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/our_mission')->with('message', 'Page has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/our_mission')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }



     public function our_plan(Request $request){
        $page_id = 11;
        $data['page_info'] = Pages::find($page_id);
        return view('admin/cms/our_plan')->with($data) ;
    } 

        public function plan_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'plan';

        $userData = Pages::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/our_plan')->with('message', 'Page has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/our_plan')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

     public function our_team(Request $request){
        $page_id = 12;
        $data['page_info'] = Pages::find($page_id);
        return view('admin/cms/our_team')->with($data) ;
    } 

        public function team_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'teamts';

        $userData = Pages::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/team')->with('message', 'Team has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/team')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

/* Faq start */

    public function faqs() 
    {

      $data['pageList'] = DB::table('pages')->where('type', 'faq')->orderby('id', 'ASC')->get();
      return view('admin/cms/faq_list')->with($data);

    }

    public function add_faq(Request $request)
    {
      $data['countries'] = DB::table('country')->orderby('name', 'ASC')->get();
      return view('admin/cms/add_faq')->with($data);
    }

    public function add_faq_action(Request $request)
    {
        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;

        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);

        $type = 'faq';

        $checkUser = DB::table('pages')->where('page_title', $pagetitle)->first();

        if($checkUser) {
          
             return redirect('admin/faqs')->with('message', 'Faq is already Added.');

        } else {
            $vrfn_code = '123456';//Helper::generateRandomString(6);
            
            $obj = new Pages;
            $obj->page_url = $slug;
            $obj->page_title = $pagetitle;
            $obj->page_content = $content;
            $obj->sub_title = $subtitle;
            $obj->type = $type;
            $obj->status = 1;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->updated_at = date('Y-m-d H:i:s');
            $res = $obj->save();

            if ($res) {
                
                return redirect('admin/faqs')->with('message', 'Faq has been created successfully.');

               // return response()->json(['status' => 'success', 'msg' => 'Page has been created successfully.']);

            } else {
                return redirect('admin/faqs')->with('message', 'OOPs! Some internal issue occured.');
                //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);

            }
        } 

    }

    public function edit_faq(Request $request){
        $page_id = $request->id;
        $data['page_info'] = Pages::find($page_id);
        return view('admin/cms/edit_faq')->with($data) ;
    }

    
    public function faq_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'faq';

        $userData = Pages::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/faqs')->with('message', 'Faq has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/faqs')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

    public function change_faq_status(Request $request)
    {

        $user = Pages::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Faq status change successfully.']);
    }

    public function deletefaq(Request $request) {
        $user_id = $request->user_id;
        //$frame_info = DB::table('pages')->where('id',$user_id)->first();
        $res = DB::table('pages')->where('id', '=', $user_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Faq has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }

    }

    /* End faqs */


/* Team start */

    public function team() 
    {

      $data['pageList'] = DB::table('pages')->where('type', 'team')->orderby('id', 'ASC')->get();
      return view('admin/cms/team_list')->with($data);

    }

    public function add_team(Request $request)
    {
      $data['countries'] = DB::table('country')->orderby('name', 'ASC')->get();
      return view('admin/cms/add_team')->with($data);
    }

    public function add_team_action(Request $request)
    {
        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content; 

        $slug = $request->twitter;//$this->attributes['slug'] = str_slug($subtitle);

        $type = 'team';
        $team_img = '';

        $request->hasFile("content") ? $request->file("content")->move("public/uploads/team/", $team_img = time().strtolower(trim($request->file('content')->getClientOriginalName()))) : '';


        $checkUser = DB::table('pages')->where('page_title', $pagetitle)->first();

        if($checkUser) {

         //return response()->json(['status' => 'error', 'msg' => 'Team is already Added.']);
         return redirect('admin/team')->with('message', 'Team is already Added.');
 

        } else {
            $vrfn_code = '123456';//Helper::generateRandomString(6);
            
            $obj = new Pages;
            $obj->page_url = $slug;
            $obj->page_title = $pagetitle;
            $obj->page_content = $team_img;
            $obj->sub_title = $subtitle;
            $obj->type = $type;
            $obj->status = 1;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->updated_at = date('Y-m-d H:i:s');
            $res = $obj->save();

            if ($res) {
                
                return redirect('admin/team')->with('message', 'Team has been created successfully.');

               // return response()->json(['status' => 'success', 'msg' => 'Page has been created successfully.']);

            } else {
                return redirect('admin/team')->with('message', 'OOPs! Some internal issue occured.');
                //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);

            }
        } 

    }

    public function edit_team(Request $request){
        $page_id = $request->id;
        $data['page_info'] = Pages::find($page_id);
        return view('admin/cms/edit_team')->with($data);
    }

    
    public function team_updates(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $team_img = '';//$request->content;
        $slug = $request->twitter;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'team';

        $request->hasFile("content") ? $request->file("content")->move("public/uploads/team/", $team_img = time().strtolower(trim($request->file('content')->getClientOriginalName()))) : '';


        if(empty($team_img)){ $team_img = $request->content_old; }

        $userData = Pages::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $team_img;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/team')->with('message', 'Team has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/team')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

    public function change_team_status(Request $request)
    {

        $user = Pages::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Team status change successfully.']);
    }

    public function deleteteam(Request $request) {
        $user_id = $request->user_id;
        //$frame_info = DB::table('pages')->where('id',$user_id)->first();
        $res = DB::table('pages')->where('id', '=', $user_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Team has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }

    }

    /* End Teams */


   /* Newslatter start */

    public function newsletter() 
    {

      $data['pageList'] = DB::table('newsletter')->where('type', 'news')->orderby('id', 'ASC')->get();
      return view('admin/cms/newsletter_list')->with($data);

    }


    public function edit_newsletter(Request $request){
        $page_id = $request->id;
        $data['page_info'] = Newsletter::find($page_id);
        return view('admin/cms/edit_faq')->with($data) ;
    }

    
    public function newsletter_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'news';

        $userData = Newsletter::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/faqs')->with('message', 'Newsletter has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/faqs')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

    public function newsletter_status(Request $request)
    {

        $news = Newsletter::find($request->user_id);
        $news->status = $request->status;
        $news->save();

        return response()->json(['success'=>'Newsletter status change successfully.']);
    }

    public function delete_newsletter(Request $request) {
        $user_id = $request->user_id;
        //$frame_info = DB::table('pages')->where('id',$user_id)->first();
        $res = DB::table('newsletter')->where('id', '=', $user_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Newsletter has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }

    }

    /* End Newslatter */ 

    /* Help notification start */

    public function help_notification() 
    {

      $data['pageList'] = DB::table('newsletter')->where('type', 'help')->orderby('id', 'ASC')->get();
      return view('admin/cms/help_list')->with($data);

    }

    public function edit_help(Request $request){
        $page_id = $request->id;
        $data['page_info'] = Newsletter::find($page_id);
        return view('admin/cms/edit_help')->with($data) ;
    }

    
    public function help_update(Request $request){

        $pagetitle = $request->pagetitle;
        $subtitle = $request->subtitle;
        $content = $request->content;
        $slug = $request->pagetitle;//$this->attributes['slug'] = str_slug($subtitle);
        $page_id = $request->input('user_id');
        $type = 'help';

        $userData = Newsletter::where('id', $page_id)->first();
    
        $userData->page_title = $pagetitle;
        $userData->sub_title = $subtitle;
        $userData->page_content = $content;
        $userData->type = $type;
        $userData->page_url = $slug;

        $userData->updated_at = date('Y-m-d H:i:s');
        $res = $userData->save();

        if($res){

            return redirect('admin/help_notification')->with('message', 'Help Notification has been updated successfully.');      
            //return response()->json(['status' => 'success', 'msg' => 'Page has been updated successfully.']);

        }else{
            
            return redirect('admin/help_notification')->with('message', 'OOPs! Some internal issue occured.');         
            //return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
        } 
    }

    public function help_status(Request $request)
    {

        $user = Newsletter::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Help Notification status change successfully.']);
    }

    public function delete_help(Request $request) {
        $user_id = $request->user_id;
        //$frame_info = DB::table('pages')->where('id',$user_id)->first();
        $res = DB::table('newsletter')->where('id', '=', $user_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Help Notification has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }

    }

    /* End help notification */
    public function booking_management(Request $request){
        $from_date = Session::get("from_date");
        $to_date = Session::get("to_date");
        if($request->status == 'Active'){
            $data['booking_details'] = DB::table('booking_management')->where('status','1')->orderBy('created_at', 'DESC')->get();
        }else{
            if($request->status == 'Inactive'){
                $data['booking_details'] = DB::table('booking_management')->where('status','0')->orderBy('created_at', 'DESC')->get();
            }else{
                $data['booking_details'] = DB::table('booking_management')->orderBy('created_at', 'DESC')->get();
            }
        }
        
        
        //print_r($data['booking_details']);
        return view("admin/booking/booking")->with($data);
    }

    public function view_booking(Request $request){
        $booking_id = $request->id; 
        $data['booking_details'] = DB::table('booking_management')->where("id",$booking_id)->get()->first();
        $data['booking_data'] = DB::table('booking_details')->where("booking_id",$data['booking_details']->booking_id)->get();
        $data['business_list'] = DB::table('users')->where("user_type","business_user")->get();
        //print_r($data['booking_details']);die;
        return view("admin/booking/view_booking")->with($data);
    }

    public function assign_ride(Request $request){
        //echo $request->ride_val;die;
        $update_booking_status = DB::table('booking_management')->where("id",$request->booking_id)->update(['customer_id'=>$request->ride_val]);
        session::flash('success', 'Ride assign successfully');
        //return redirect('admin/view_booking/'.$request->booking_id);
    }

    public function change_booking_status(Request $request){
        $update_booking_status = DB::table('booking_management')->where("id",$request->booking_id)->update(['booking_status'=>$request->booking_status]);
        
        session::flash('success', 'Booking status updated successfully');
        return redirect('admin/view_booking/'.$request->booking_id);
        
        
        
    }

    public function car_management(){
        $data['car_list'] = DB::table('car_management')->get();
        
        return view("admin/car/carmgmt")->with($data);
    }

    public function add_cars(){
        $data['category_list'] = DB::table('categories')->get();
        return view("admin/car/add_cars")->with($data);
    }

    public function submit_cars(Request $request){
        $title = $request->title;
        $vehicle_type = $request->vehicle_type;
        $vehicle_category = $request->vehicle_category;
        $car_description = $request->car_description;
       
        $no_of_day1 = $request->days_1;
        $no_of_day3 = $request->days_3;
        $no_of_day7 = $request->days_7;
        $no_of_day30 = $request->days_30;

        $no_of_seats = $request->no_of_seats;
        $no_of_km = $request->no_of_km;

        $price1 = $request->price_1;
        $price3 = $request->price_3;
        $price7 = $request->price_7;
        $price30 = $request->price_30;
        
        $total_price = $request->total_price;
        $image = $request->file('image');

        if($image){
            $destinationPath = base_path() .'/public/uploads/cars';
            $file_name = time().".".$image->extension();
            $image->move($destinationPath,$file_name);
        }

        $insert_cars_id = DB::table('car_management')->insertGetId(['title'=>$title,'vehicle_type'=>$vehicle_type,'vehicle_category'=>$vehicle_category,'image'=>$file_name,'manual_text'=>'manual_text','no_of_seats'=>$no_of_seats,'no_of_km'=>$no_of_km,'car_description'=>$car_description,'created_at'=>date('Y-m-d H:i:s')]);
        $car_price = $request->price;
        
        
        $insert_cars1 = DB::table('car_price_days')->insert(['car_days_id'=>'1','car_id'=>$insert_cars_id,'no_of_day'=>'1 Day','price'=>$car_price[0],'created_at'=>date('Y-m-d H:i:s')]);
        $insert_cars2 = DB::table('car_price_days')->insert(['car_days_id'=>'2','car_id'=>$insert_cars_id,'no_of_day'=>'3+ Day','price'=>$car_price[1],'created_at'=>date('Y-m-d H:i:s')]);
        $insert_cars3 = DB::table('car_price_days')->insert(['car_days_id'=>'3','car_id'=>$insert_cars_id,'no_of_day'=>'7+ Day','price'=>$car_price[2],'created_at'=>date('Y-m-d H:i:s')]);
        $insert_cars4 = DB::table('car_price_days')->insert(['car_days_id'=>'4','car_id'=>$insert_cars_id,'no_of_day'=>'30+ Day','price'=>$car_price[3],'created_at'=>date('Y-m-d H:i:s')]);
        
        if ($insert_cars1 && $insert_cars2 && $insert_cars3 && $insert_cars4) {
                
            return response()->json(['status' => 'success', 'msg' => 'Car has been added successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
        
    }

    public function change_car_status(Request $request){

        $update_car_status = DB::table('car_management')->where("id",$request->car_id)->update(['status'=>$request->status]);
        
        return response()->json(['success'=>'Car status change successfully.']);
        
        
    }

    public function edit_cars(Request $request){
        $data['car_list'] = DB::table('car_management')->where("id",$request->car_id)->get()->first();
        $data['category_list'] = DB::table('categories')->get();
        //print_r($data['car_list']);die;
        return view("admin/car/edit_cars")->with($data);
    }

    public function update_cars(Request $request){

        $title = $request->title;
        $vehicle_type = $request->vehicle_type;
        $vehicle_category = $request->vehicle_category;
        $car_description = $request->car_description;
       
        $no_of_day = $request->no_of_day;
        $no_of_seats = $request->no_of_seats;
        $no_of_km = $request->no_of_km;
        $price = $request->price;
        $total_price = $request->total_price;
        $image = $request->file('image');

        $car_data = DB::table('car_management')->where("id",$request->car_id)->get()->first();
        if($image){
            $destinationPath = base_path() .'/public/uploads/cars';
            $file_name = time().".".$image->extension();
            $image->move($destinationPath,$file_name);
            $update_car = DB::table('car_management')->where("id",$request->car_id)->update(['title'=>$title,'vehicle_type'=>$vehicle_type,'vehicle_category'=>$vehicle_category,'image'=>$file_name,'manual_text'=>'manual_text','no_of_seats'=>$no_of_seats,'no_of_km'=>$no_of_km,'car_description'=>$car_description]);
        }else{
            

            $update_car = DB::table('car_management')->where("id",$request->car_id)->update(['title'=>$title,'vehicle_type'=>$vehicle_type,'vehicle_category'=>$vehicle_category,'manual_text'=>'manual_text','no_of_seats'=>$no_of_seats,'no_of_km'=>$no_of_km,'car_description'=>$car_description]);
            
        }

        $car_price = $request->price;
        
             
        $insert_cars1 = DB::table('car_price_days')->where('car_days_id',"1")->where("car_id",$request->car_id)->update(['price'=>$car_price[0]]);
        $insert_cars2 = DB::table('car_price_days')->where('car_days_id',"2")->where("car_id",$request->car_id)->update(['price'=>$car_price[1]]);
        $insert_cars3 = DB::table('car_price_days')->where('car_days_id',"3")->where("car_id",$request->car_id)->update(['price'=>$car_price[2]]);
        $insert_cars4 = DB::table('car_price_days')->where('car_days_id',"4")->where("car_id",$request->car_id)->update(['price'=>$car_price[3]]);

        if ($update_car || $insert_cars1 || $insert_cars2 || $insert_cars3 || $insert_cars4) {
                
            return response()->json(['status' => 'success', 'msg' => 'Car has been updated successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
        
        
        return redirect('admin/car_management');
    }

    public function delete_car(Request $request){
        $res = DB::table('car_management')->where('id', '=', $request->car_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Car has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }
    }

    public function add_language(){
        return view("admin/language/add_language");
        
    }

    public function submit_languages(Request $request){
        
        $title = $request->title;
        $insert_languages = DB::table('language_management')->insert(['name'=>$title,'created_at'=>date('Y-m-d H:i:s')]);

        if ($insert_languages) {
                
            return response()->json(['status' => 'success', 'msg' => 'Languages has been added successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
    }

    public function language_management(){
        $data["language_list"] = DB::table('language_management')->get();
        return view("admin/language/language_management")->with($data);
        
    }

    public function change_language_status(Request $request){
        $update_car_status = DB::table('language_management')->where("id",$request->language_id)->update(['status'=>$request->status]);
        
        return response()->json(['success'=>'Language status has been changed successfully.']);
    }

    public function edit_languages(Request $request){
        $data['language_list'] = DB::table('language_management')->where("id",$request->language_id)->get()->first();
        //print_r($data['car_list']);die;
        return view("admin/language/edit_languages")->with($data);
    }

    public function update_languages(Request $request){
        $title = $request->title;
        $update_languages = DB::table('language_management')->where("id",$request->language_id)->update(['name'=>$title]);

        if ($update_languages) {
                
            return response()->json(['status' => 'success', 'msg' => 'Language has been updated successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
    }

    public function delete_languages(Request $request){
        $res = DB::table('language_management')->where('id', '=', $request->language_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Language has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }
    }

    public function add_logos(){
        return view("admin/logo/add_logo");
    }

    public function submit_logos(Request $request){

       

        $image = $request->file('image');

        if($image){
            $destinationPath = base_path() .'/public/uploads/logos';
            $file_name = time().".".$image->extension();
            $image->move($destinationPath,$file_name);
        }

        $insert_logos = DB::table('home_page_logos')->insert(['image'=>$file_name,'status'=>'1','created_at'=>date('Y-m-d H:i:s')]);
        
        
        
        if ($insert_logos) {
                
            return response()->json(['status' => 'success', 'msg' => 'Logos has been added successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
        
    }

    public function show_logos(){
        $data['logo_list'] = DB::table('home_page_logos')->get();
        return view("admin/logo/show_logo")->with($data);
    }

    public function change_logo_status(Request $request){
        
        $update_car_status = DB::table('home_page_logos')->where("id",$request->logo_id )->update(['status'=>$request->status]);
        
        return response()->json(['success'=>'Logo status change successfully.']);
        
        
    }

    public function edit_logos(Request $request){
        $data['logo_list'] = DB::table('home_page_logos')->where("id",$request->logo_id)->get()->first();
        return view("admin/logo/edit_logo")->with($data);
    }

    public function update_logos(Request $request){
        $image = $request->file('image');

        if($image){
            $destinationPath = base_path() .'/public/uploads/logos';
            $file_name = time().".".$image->extension();
            $image->move($destinationPath,$file_name);
        }

        $update_logos = DB::table('home_page_logos')->where("id",$request->logo_id )->update(['image'=>$file_name]);
        
        
        
        if ($update_logos) {
                
            return response()->json(['status' => 'success', 'msg' => 'Logos has been updated successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
    }

    public function delete_logos(Request $request){
        
        $res = DB::table('home_page_logos')->where('id', '=', $request->logo_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Logo has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }
    }

    public function add_categories(Request $request){
        return view("admin/Category/add_category");
    }

    public function submit_category(Request $request){
        $cat_name = $request->cat_name;
        

        $insert_category = DB::table('categories')->insert(['cat_name'=>$cat_name,'created_at'=>date('Y-m-d H:i:s')]);
        
        
        if ($insert_category) {
                
            return response()->json(['status' => 'success', 'msg' => 'Category has been added successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
        
    }

    public function show_category(Request $request){
        $data['category_list'] = DB::table('categories')->get();
        return view("admin/Category/show_category")->with($data);
    }

    public function change_category_status(Request $request){
        
        $update_category_status = DB::table('categories')->where("cat_id",$request->cat_id )->update(['status'=>$request->status]);
        
        return response()->json(['success'=>'Category status change successfully.']);
        
        
    }

    public function edit_category(Request $request){
        $data['category_list'] = DB::table('categories')->where("cat_id",$request->cat_id )->get()->first();
        return view("admin/Category/edit_category")->with($data);
    }

    

    public function update_category(Request $request){
        $cat_name = $request->cat_name;
        

        $insert_category = DB::table('categories')->where("cat_id",$request->cat_id)->update(['cat_name'=>$cat_name,'created_at'=>date('Y-m-d H:i:s')]);
        
        
        if ($insert_category) {
                
            return response()->json(['status' => 'success', 'msg' => 'Category has been updated successfully.']);
           
        } else {
            return response()->json(['status' => 'error', 'msg' => 'OOPs! Some internal issue occured.']);
            
        }
    }

    public function delete_category(Request $request){
        
        $res = DB::table('categories')->where('cat_id', '=', $request->cat_id)->delete();

        if ($res) {
            return json_encode(array('status' => 'success','msg' => 'Category has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }
    }

    public function translation_management(){
        $data['translations_en'] = DB::table('translation')->where("id","1")->get()->first();
        //print_r($data['translations_en']->translation_text);
        $data['texts'] = json_decode($data['translations_en']->translation_text);
        $data['texts_booking'] = json_decode($data['translations_en']->booking_texts);
        $data['car_data'] = DB::table('car_management')->get();
        //print_r($data['texts']);die;

        //print_r($data['texts']);die;
        
        return view("admin/Translations/translation_management")->with($data);
    }

    public function update_translations(Request $request){
        $data = $request->all();
        //print_r($request->data);die;
        //var_dump($request->all());die;
        //echo json_encode($request->input());die;
        $update_translations_en = DB::table('translation')->where("id","1")->update(['translation_text'=>$data]);

        //$update_translations_it = DB::table('translation')->where("id","2")->update(['Menu1'=>$request->Menu1_it,'Menu2'=>$request->Menu2_it,'pickup_location_text'=>$request->pickup_location_it,'drop_off_location'=>$request->dropoff_location_it,'pickup_date'=>$request->pickup_date_it,'book_btn'=>$request->dropoff_date_it,'brand_section_heading'=>$request->brand_section_heading_it,'best_deal_heading'=>$request->best_deal_heading_it,'best_deal_content'=>$request->best_deal_content_it,'Day'=>$request->Day_it,'Seater'=>$request->Seater_it,'Manual'=>$request->Manual_it,'KM'=>$request->KM_it,'More'=>$request->More_it,'created_at'=>date('Y-m-d H:i:s')]);

       return response()->json(['status' => 'success', 'msg' => 'Content updated successfully']);
    }

    public function update_translationsTwo(Request $request){
        $data = $request->all();
        
        $update_translations_en = DB::table('translation')->where("id","1")->update(['booking_texts'=>$data]);
        

       return response()->json(['status' => 'success', 'msg' => 'Content updated successfully']);
    }

    public function update_car_translations(Request $request){
        //print_r($request->car_name_it);
        $car_ids = $request->car_id;
        $car_name = $request->car_name_it;
        $car_description = $request->car_description_it;
        $i = 0;
        foreach ($car_ids as $c_id) {
            $update_translations_en = DB::table('car_management')->where("id",$c_id)->update(['title_it'=>$car_name[$i],'car_description_it'=>$car_description[$i]]);
            $i++;
        }
        return response()->json(['status' => 'success', 'msg' => 'Content updated successfully']);
    }

    public function payment_transaction(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        
        if($from_date && $to_date){
            if($request->status == 'Completed'){

                $data['payment_transaction'] = DB::table('payment_transaction')->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where('payment_status','1')->orderby('created_at', 'DESC')->get();
            }else{
                if($request->status == 'Pending'){
                    $data['payment_transaction'] = DB::table('payment_transaction')->where('payment_status','0')->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->orderby('created_at', 'DESC')->get();
                }else{
                    
                      $data['payment_transaction'] = DB::table('payment_transaction')->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->orderby('created_at', 'DESC')->get();
                        
                }
            }
        }else{
            if($request->status == 'Completed'){

                $data['payment_transaction'] = DB::table('payment_transaction')->where('payment_status','1')->orderby('created_at', 'DESC')->get();
            }else{
                if($request->status == 'Pending'){
                    $data['payment_transaction'] = DB::table('payment_transaction')->where('payment_status','0')->orderby('created_at', 'DESC')->get();
                }else{
                    
                      $data['payment_transaction'] = DB::table('payment_transaction')->orderby('created_at', 'DESC')->get();
                        
                }
            }
            
        }
        
        return view("admin/payment/payment")->with($data);
        
    }

     public function change_payment_status(Request $request){
        
        $update_payment_status = DB::table('payment_transaction')->where("payment_id",$request->payment_id )->update(['payment_status'=>$request->payment_status]);
        
        return response()->json(['success'=>'Payment status completed successfully.']);
        
        
    }

    public function search_date_filter(Request $request){
        $from_date = date("Y-m-d",strtotime($request->from_date));
        $to_date = date("Y-m-d",strtotime($request->to_date));

        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        
        return view("admin/dashboard_search")->with($data);

    }

    

}
