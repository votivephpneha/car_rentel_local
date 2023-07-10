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

        $totaluser = DB::table('users')->get();

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

        $slug = str_replace(" ","-",$pagetitle);//$this->attributes['slug'] = str_slug($subtitle);

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

    public function addCategories() 
    {
        return view("admin/categories/add_categories");
    }

    public function postCategory(Request $request) 
    {
        $categories = $request->categories;
        
        if($request->hasFile("image")){
            $category_image = $request->file('image');
            $cat_image = $file->getClientOriginalName();
            $destinationPath = base_path() .'/public/uploads/category';
            $file_name = time() . "." . $image->extension();;
            $file->move($destinationPath,$file_name);
        }
    }

    public function web_menus() 
    {
        return view("admin/web_menus");
    }

    public function add_menus(Request $request){
        $menus = $request->menus;
    }

    public function booking_management(){
        $data['booking_details'] = DB::table('booking_management')->get();
        //print_r($data['booking_details']);
        return view("admin/booking/booking")->with($data);
    }

    public function view_booking(Request $request){
        $booking_id = $request->id; 
        $data['booking_details'] = DB::table('booking_management')->where("id",$booking_id)->get()->first();
        //print_r($data['booking_details']);die;
        return view("admin/booking/view_booking")->with($data);
    }

    public function change_booking_status(Request $request){
        $update_booking_status = DB::table('booking_management')->where("id",$request->booking_id)->update(['booking_status'=>$request->booking_status]);
        
        session::flash('success', 'Booking status updated successfully');
        return redirect('admin/view_booking/'.$request->booking_id);
        
        
        
    }

    public function car_management(){
        return view("admin/car/carmgmt");
    }

    public function add_cars(){
        return view("admin/car/add_cars");
    }

    public function submit_cars(Request $request){
        $title = $request->title;
        $sub_title = $request->sub_title;
       
        $no_of_day = $request->no_of_day;
        $no_of_seats = $request->no_of_seats;
        $no_of_km = $request->no_of_km;
        $price = $request->price;

        $image = $request->file('image');

        if($image){
            $destinationPath = base_path() .'/public/uploads/cars';
            $file_name = time().".".$image->extension();
            $file->move($destinationPath,$file_name);
        }

        $insert_cars = DB::table('car_management')->insert(['title'=>$title,'sub_title'=>$sub_title,'no_of_day'=>$no_of_day,'no_of_seats'=>$no_of_seats,'no_of_day'=>$no_of_km,'price'=>$price,'created_at'=>date('Y-m-d H:i:s')]);

        
    }

}
