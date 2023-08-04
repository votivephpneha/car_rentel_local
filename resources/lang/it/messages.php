<?php

//$trans_data = DB::table("translation_mgmt")->where('id','1')->get()->first();
$trans_data1 = DB::table("translation")->where('id','1')->get()->first();
$brand_data = DB::table("home_page")->where('id','2')->get()->first();
$trans_data = json_decode($trans_data1->translation_text);  
$trans_data2 = (array)$trans_data;
//print_r($trans_data);die;
$tranlated_data = array();
foreach ($trans_data2 as $key => $value) {
    $key1 = str_replace('_it', '', $key);
    if(strpos($key, "_it")){
        //array_push($tranlated_data,"'".$key1."'=>".$value.",");
        $tranlated_data[$key1] = $value;
    }
}

$tranlated_data_booking = array();
foreach ($trans_data_two_booking as $key => $value) {
    $key1 = str_replace('_en', '', $key);
    if(strpos($key, "_en")){
        //array_push($tranlated_data,"'".$key1."'=>".$value.",");
        $tranlated_data_booking[$key1] = $value;
    }
}
$new_translated_data = array_merge($tranlated_data,$tranlated_data_booking);
//print_r($new_translated_data);die;
return $new_translated_data;
