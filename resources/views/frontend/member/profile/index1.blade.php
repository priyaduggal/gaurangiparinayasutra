@extends('frontend.layouts.member_panel')
@section('panel_content')
<style>
/*.aiz-user-sidenav .text-center a{*/
/*     display:none !important;*/
/*}*/
/*.sidemnenu  {*/
/*    display:none;*/
/*}*/
/*.navbar {*/
/*     display:none;*/
/*}*/
/*.carousel-inner,.slide_short ,.bg-footer {*/
/*    display:none !important;*/
/*}*/
.slide_short{
   display:none !important;  
}
.show{
    display:block !important;
}
.hide{
    display:none !important;
}
.card{
    position:relative !important;
}
* {
  box-sizing: border-box;
}
.aiz-user-sidenav-wrap.pt-4.sticky-top.c-scrollbar-light.position-relative.z-1.shadow-none {
    display: none;
}
.hgh {
    background: #8E0203;
    color: #fff;
    border-radius: 40px 40px 0 0;
    padding: 30px 30px;
} .hgh h1{
    color: #fff;text-align:left;
} 
.card{
   border-radius: 40px 40px 0 0;
}
body {
  background-color: #f1f1f1;
}
img.img-set {
    width: 80%;
    margin: 0 auto;
    display: block;
}
#regForm {
  background-color: #ffffff;
  
  font-family: Raleway;
  padding: 40px;
 
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid ,select.invalid{
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}
h1{
    font-family: 'Poppins', sans-serif;
  font-size: 35px;font-weight: 400;
}
.form-control{
      font-family: 'Poppins', sans-serif;
  font-size: 15px;font-weight: 400;
}
button {
    background-color: #8d1f20;
    color: #ffffff;
    border: none;
    padding: 8px 25px;
    font-size: 15px;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    border-radius: 10px;
}
label{
    font-family: 'Poppins', sans-serif;
font-size: 13px;
    font-weight: 400;
    margin-bottom: 4px;}
button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}
.row.pt-4,
ul.navbar-nav.mt-2.mt-lg-0.ul-bg-color.align-items-center.profile_settings {
    display: none;
}
/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}.card{
       border-radius: 40px 40px 0 0;
 position: absolute;
    width: 100%;
    left: 0;
    bottom: 0px;
}
button.btn.dropdown-toggle.btn-light,
.form-control{
    height:49px;
    font-size:14px;
}
.img-set{
    width: 84%;
    margin: 0 auto;
    display: block;
}
.new,.old {
    height: 53px !important;
    width: 150px !important;
}
.filter-option-inner-inner {
    height: 33px;
    line-height: 36px;
}
.filter-option-inner {
    height: 33px;
}label.form-label {
    font-weight: 400;
    font-size: 13px;
    margin-bottom: 5px;
}
</style>


    <div class="container">
		<div class="row">
		    <div class="col-xxl-6 col-xl-6 col-md-6">
		        <img src="{{ static_asset('assets/img/b.png') }}" class="img-set" />    
		    </div>
			<div class="col-xxl-6 col-xl-6 col-md-6">
				<div class="card">
                     @php $member = \App\User::find(Auth::user()->id); @endphp
    <div class="hgh">
    <h1>Profile</h1>
    <p>It's great connecting with you. 
To find good matches we need more Personal details
</p>
</div>
<form action="{{ route('member.basic_info_update', $member->id) }}" id="regForm" method="POST" class="">  
 @csrf

 @php
        $member_religion_id   = !empty($member->spiritual_backgrounds->religion_id) ? $member->spiritual_backgrounds->religion_id : "";
        $member_caste_id      = !empty($member->spiritual_backgrounds->caste_id) ? $member->spiritual_backgrounds->caste_id : "";
        $member_sub_caste_id  = !empty($member->spiritual_backgrounds->sub_caste_id) ? $member->spiritual_backgrounds->sub_caste_id : "";
    @endphp
 @php
        $permanent_address      = \App\Models\Address::where('type','permanent')->where('user_id',$member->id)->first();
        $permanent_country_id   = !empty($permanent_address->country_id) ? $permanent_address->country_id : "";
        $permanent_state_id     = !empty($permanent_address->state_id) ? $permanent_address->state_id : "";
        $permanent_city_id      = !empty($permanent_address->city_id) ? $permanent_address->city_id : "";
        $permanent_postal_code  = !empty($permanent_address->postal_code) ? $permanent_address->postal_code : "";
    @endphp
      <!-- Present Address -->
    @php
        $present_address      = \App\Models\Address::where('type','present')->where('user_id',$member->id)->first();
        $present_country_id   = !empty($present_address->country_id) ? $present_address->country_id : "";
        $present_state_id     = !empty($present_address->state_id) ? $present_address->state_id : "";
        $present_city_id      = !empty($present_address->city_id) ? $present_address->city_id : "";
        $present_postal_code  = !empty($present_address->postal_code) ? $present_address->postal_code : "";
    @endphp
   

   
   
  

<!-- One "tab" for each step in the form: -->
<div class="tab"> <input type="hidden"  name="address_type" value="permanent">  

 <div class="row">
	<div class="col-md-6 col-sm-6">
		<p>  <label for="member_religion_id">{{translate('Religion')}}</label>
                          <select class="form-control selectdata" name="member_religion_id" id="member_religion_id" data-live-search="true" required>
                      <option value="">{{translate('Select One')}}</option>
                      @foreach ($religions as $religion)
                          <option value="{{$religion->id}}" @if($religion->id == $member_religion_id) selected @endif> {{ $religion->name }} </option>
                      @endforeach
                  </select>
                  </p>
	</div>
	<div class="col-md-6 col-sm-64">
		 <p><label for="height">Mother Tongue</label><select class="form-control selectdata" name="mothere_tongue" data-live-search="true">
                        <option value="">{{translate('Select One')}}</option>
                        @foreach ($languages as $language)
                            <option value="{{$language->id}}" @if($language->id == $member->member->mothere_tongue) selected @endif> {{ $language->name }} </option>
                        @endforeach
                    </select></p>
	</div>

</div>


                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <p>  <label for="member_caste_id">{{translate('Caste')}}</label><select class="form-control selectdata" name="member_caste_id" id="member_caste_id" data-live-search="true" required>

                  </select></p>
                        </div>
                     
                        <div class="col-md-4 col-sm-4">
                            <p><label for="member_sub_caste_id">{{translate('Sub Caste')}}</label> 
                            <input type="text"  class="form-control" name="member_sub_caste_id" id="member_sub_caste_id" 
                            value="{{ !empty($member->spiritual_backgrounds->sub_caste_id) ? $member->spiritual_backgrounds->sub_caste_id : "" }}" > 
                            <!--<select class="form-control selectdata" name="member_sub_caste_id" id="member_sub_caste_id" data-live-search="true">-->

                  </select></p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <p>  <label for="height">{{translate('Maritial Status')}}</label> <select class="form-control selectdata" name="marital_status" data-live-search="true" required>
                        @foreach ($marital_statuses as $marital_status)
                            <option value="{{$marital_status->id}}" @if($member->member->marital_status_id == $marital_status->id) selected @endif>{{$marital_status->name}}</option>
                        @endforeach
                    </select></p>
                        </div>
                    </div>
                   
  <!--<p>  <label for="first_name" >{{translate('Date Of Birth')}}-->
  <!--                 <span>*</span>-->
  <!--                  </label>-->
  <!--                  <input type="text"  class="aiz-date-range form-control tab_data" oninput="this.className = ''"  name="date_of_birth" -->
  <!--value="@if(!empty($member->member->birthday)) {{date('Y-m-d', strtotime($member->member->birthday))}} @endif" -->
  <!--placeholder="Select Date" data-single="true" data-show-dropdown="true" data-max-date="{{ get_max_date() }}" autocomplete="off" >-->
                  
                    
  <!--                  </p>-->
  <!--<p> <label for="height">{{translate('Height')}} ({{ translate('In Feet') }})</label><input type="number" name="height" -->
  <!--value="{{ !empty($member->physical_attributes->height) ? $member->physical_attributes->height : "" }}"oninput="this.className = ''" step="any" class="tab_data form-control" -->
  <!--placeholder="{{translate('Height')}}" >-->
  <!--                </p>-->
  
    
                    
                     <div class="row">
                        <div class="col-md-4 col-sm-4">
                             <p> <label for="height">{{translate('Country')}}</label><select class="form-control selectdata tab_data " 
                  name="permanent_country_id" id="permanent_country_id" data-live-search="true" >
                        <option value="">{{translate('Select One')}}</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" @if($country->id == $permanent_country_id) selected @endif>{{$country->name}}</option>
                        @endforeach
                    </select>
                   </p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <p> <label for="height">{{translate('State')}}</label><select  
                    class="form-control selectdata tab_data" name="permanent_state_id" 
                    id="permanent_state_id" data-live-search="true" >

                    </select>
                    </p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                             <p><label for="height">{{translate('City')}}</label> <select 
                    class="form-control selectdata tab_data"    name="permanent_city_id" id="permanent_city_id" 
                    data-live-search="true" >

                    </select>
                  </p>
                        </div>
                    </div>
                    
                    
                 
                    
                    
                   
                                     </p>
                                     
                   <div class="row">
                        <div class="col-md-4 col-sm-4">
                             <p>  <label for="diet">{{translate('Manglik Status')}}</label>
                    @php $user_diet = !empty($member->physical_attributes->manglik_status) ? $member->physical_attributes->manglik_status : ""; @endphp
                    <select class="form-control selectdata" name="manglik_status" required>
                        <option value="">Select</option>
                        <option value="Manglik" @if($user_diet ==  'Manglik') selected @endif >{{translate('Manglik')}}</option>
                        <option value="Non_Manglik" @if($user_diet ==  'Non_Manglik') selected @endif >{{translate('Non Manglik')}}</option>
                        <option value="Anshik_Manglik" @if($user_diet ==  'Anshik_Manglik') selected @endif >{{translate('Anshik Manglik')}}</option>
                        <option value="dont_believe" @if($user_diet ==  'dont_believe') selected @endif >Don't Believe</option>
                        @error('diet')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select></p> 
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-6">
                                    <p> <label for="height">{{translate('Height')}} ({{ translate('In Feet') }})</label>
                                    
                                    
                                    <select name="height" class="form-control">
                                        <option value="">Select</option>
                                        <?php for($i=4;$i<=7;$i++){?>
                                        <option  <?php if(!empty($member->physical_attributes->height)){
                                            if($member->physical_attributes->height==$i){
                                                echo 'selected';
                                            }
                                        }?>
                                        
                                         value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php } ?>
                                        </select>
                                    
  <!--                                  <input type="number" name="height" -->
  <!--value="{{ !empty($member->physical_attributes->height) ? $member->physical_attributes->height : "" }}"oninput="this.className = ''" step="any" class="tab_data form-control" -->
  <!--placeholder="{{translate('Height')}}" >-->
                  </p>
                                </div>
                                <div class="col-6">
                                    <p> <label for="height">{{translate('Height')}} ({{ translate('In Inch') }})</label>
                                    
                                     <select name="heightfeet" class="form-control">
                                        <option value="">Select</option>
                                        <?php for($i=0;$i<=11;$i++){?>
                                        <option  <?php if(!empty($member->physical_attributes->heightfeet)){
                                            if($member->physical_attributes->heightfeet==$i){
                                                echo 'selected';
                                            }
                                        }?>
                                        
                                         value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php } ?>
                                        </select>
                                    
                                    
  <!--                                  <input type="number" name="heightfeet" -->
  <!--value="{{ !empty($member->physical_attributes->heightfeet) ? $member->physical_attributes->heightfeet : "" }}"oninput="this.className = ''" -->
  <!--step="any" class="tab_data form-control" -->
  <!--placeholder="{{translate('Height')}}" >-->
                  </p>
                                </div>
                            </div>
                            
                  
                        </div>
                                     
                       </div>           
  
  
  
  <!--                   <p> <label for="height">{{translate('Physical Status')}} </label><input type="text" name="physical_status" -->
  <!--value="{{ !empty($member->physical_attributes->physical_status) ? $member->physical_attributes->physical_status : "" }}"-->
  <!--oninput="this.className = ''" step="any" class="tab_data form-control" -->
  <!--placeholder="{{translate('Physical Status')}}" >-->
  <!--                </p>-->
                  
                  
                  <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <p>  <label for="diet">{{translate('Diet')}}</label>
                    @php $user_diet = !empty($member->lifestyles->diet) ? $member->lifestyles->diet : ""; @endphp
                    <select class="form-control selectdata" name="diet" required>
                        <option value="veg" @if($user_diet ==  'veg') selected @endif >{{translate('Veg')}}</option>
                        <option value="nonveg" @if($user_diet ==  'nonveg') selected @endif >{{translate('Non Veg')}}</option>
                           <option value="jain" @if($user_diet ==  'jain') selected @endif >{{translate('Jain')}}</option>
                        @error('diet')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select></p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <p>  <label for="drink">{{translate('Drink')}}</label>
                    @php $user_drink = !empty($member->lifestyles->drink) ? $member->lifestyles->drink : ""; @endphp
                    <select class="form-control selectdata" name="drink" required>
                        <option value="yes" @if($user_drink ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        <option value="no" @if($user_drink ==  'no') selected @endif >{{translate('No')}}</option>
                         <option value="occasionally" @if($user_drink ==  'occasionally') selected @endif >{{translate('Occasionally')}}</option>
                        @error('drink')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>   </p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <p>  <label for="smoke">{{translate('Smoke')}}</label>
                    @php $user_smoke = !empty($member->lifestyles->smoke) ? $member->lifestyles->smoke : ""; @endphp
                    <select class="form-control selectdata" name="smoke" required>
                        <option value="yes" @if($user_smoke ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        <option value="no" @if($user_smoke ==  'no') selected @endif >{{translate('No')}}</option>
                        <option value="occasionally" @if($user_smoke ==  'occasionally') selected @endif >{{translate('Occasionally')}}</option>
                        @error('smoke')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>   
               </p>
                        </div>
                    </div>
                  
                  
                  
                  
                  
                  
                   
       
</div>

<div class="tab">
  <!--<p><label for="sun_sign">{{translate('Education Category')}}</label>-->
  <!--<select class="form-control">-->
  <!--    <option>Select Education</option>-->
    
  <!--</select>-->
  
  
    <!--<input type="text" name="weight" value="{{ !empty($member->physical_attributes->weight) ? $member->physical_attributes->weight : "" }}" step="any"-->
    <!--placeholder="{{ translate('Highest Qualification') }}" class="form-control" required>-->
  <!--  </p>-->
      <p><label for="sun_sign">{{translate('Education')}}</label>
  <select class="form-control" name="weight" >
     
       <option value="">{{translate('Select One')}}</option>
                        <?php $educations = \App\Models\Country::educations(); ?>
                        @foreach ($educations as $country)
                            <option value="{{$country->id}}" @if($country->id == $member->physical_attributes->weight) selected @endif>{{$country->name}}</option>
                        @endforeach
  </select>
  
  
    <!--<input type="text" name="weight" value="{{ !empty($member->physical_attributes->weight) ? $member->physical_attributes->weight : "" }}" step="any"-->
    <!--placeholder="{{ translate('Highest Qualification') }}" class="form-control" required>-->
    </p>
    
    
  
           <p><label for="sun_sign">{{translate('Occupation')}}</label>
           
           <select class="form-control" name="eye_color" >
        <option value="">{{translate('Select One')}}</option>
                        <?php $countries = \App\Models\Country::occupation(); ?>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" @if($country->id == $member->physical_attributes->eye_color) selected @endif>{{$country->name}}</option>
                        @endforeach
  </select>
  
  
    <!--<input type="text" name="eye_color" value="{{ !empty($member->physical_attributes->eye_color) ? $member->physical_attributes->eye_color : "" }}" -->
    <!--class="form-control" placeholder="{{translate('Occupation')}}" required>-->
                 </p>
                 
                 <p><label for="sun_sign">{{translate('Annual Income')}}</label>
                 
                   <select name="hair_color" class="form-control">
                                        <option value="">Select</option>
                                        <option value="no"
                                        <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='no'){
                                                echo 'selected';
                                            }
                                        }?>
                                        >No Income</option>
                                        <option value="0"
                                         <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='0'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 0-1 Lakh</option>
                                        <option value="1"
                                         <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='1'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 1-2 Lakh</option>
                                        <option value="2" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='2'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 2-3 Lakh</option>
                                        <option value="3" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='3'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 3-4 Lakh</option>
                                        <option value="4" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='4'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 4-5 Lakh</option>
                                        <option value="5" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='5'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 5-6 Lakh</option>
                                        <option value="7" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='7'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 5-7 Lakh</option>
                                        <option value="10" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='10'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 7-10 Lakh</option>
                                        <option value="15" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='15'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 10-15 Lakh</option>
                                        <option value="20" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='20'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 15-20 Lakh</option>
                                        <option value="25" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='25'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 20-25 Lakh</option>
                                        <option value="35" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='35'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 25-35 Lakh</option>
                                        <option value="50" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='50'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 35-50 Lakh</option>
                                        <option value="70" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='70'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 50-70 Lakh</option>
                                        <option value="70l" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='70l'){
                                                echo 'selected';
                                            }
                                        }?>>Rs. 70 Lakh – 1 Crore</option>
                                        <option value="1c" <?php if(!empty($member->physical_attributes->hair_color)){
                                            if($member->physical_attributes->hair_color=='1c'){
                                                echo 'selected';
                                            }
                                        }?>>Rs.  1 Crore & Above</option>
                                       
                                        </select>
                                    
                                    
                                    
     <!--<input type="number" name="hair_color" value="{{ !empty($member->physical_attributes->hair_color) ? $member->physical_attributes->hair_color : "" }}" -->
     <!--placeholder="{{ translate('Annual Income') }}" class="form-control" required>-->
                 
                 </p>
                 <p>
                    <label for="present_country_id">{{translate('Working Country')}}</label>
                    <input type="hidden" name="address_present" value="present"> 
                    <select class="form-control selectdata" name="present_country_id" id="present_country_id" data-live-search="true" required>
                        <option value="">{{translate('Select One')}}</option>
                        <?php $countries = \App\Models\Country::where('status',1)->get(); ?>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" @if($country->id == $present_country_id) selected @endif>{{$country->name}}</option>
                        @endforeach
                    </select>
                    @error('present_country_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </p>
                <p>
                    <label for="present_state_id">{{translate('Working State')}}</label>
                    <select class="form-control selectdata" name="present_state_id" id="present_state_id" data-live-search="true" required>

                    </select>
                    @error('present_state_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </p>
            
                <p>
                    <label for="present_city_id">{{translate('Working City')}}</label>
                    <select class="form-control selectdata" name="present_city_id" id="present_city_id" data-live-search="true" required>

                    </select>
                    @error('present_city_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </p>
                
         
                    <!--    <p><label for="height">{{translate('Known Languages')}}</label>-->
                    <!--         @php $known_languages = !empty($member->member->known_languages) ? json_decode($member->member->known_languages) : [] ; @endphp-->
                    <!--<select class="form-control selectdata" name="known_languages[]" data-live-search="true" multiple>-->
                    <!--    <option value="">{{translate('Select')}}</option>-->
                    <!--    @foreach ($languages as $language)-->
                    <!--        <option value="{{$language->id}}" @if(in_array($language->id, $known_languages)) selected @endif >{{ $language->name }} </option>-->
                    <!--    @endforeach-->
                    <!--</select>-->
                    <!--</p>-->
                   
</div>

<!--<div class="tab">-->
  
<!--  <p>  <label for="member_caste_id">{{translate('Caste')}}</label><select class="form-control selectdata" name="member_caste_id" id="member_caste_id" data-live-search="true" required>-->

<!--                  </select></p>-->
<!--  <p><label for="member_sub_caste_id">{{translate('Sub Caste')}}</label> <select class="form-control selectdata" name="member_sub_caste_id" id="member_sub_caste_id" data-live-search="true">-->

<!--                  </select></p>-->
<!--</div>-->

<div class="tab">
    
             <p>
                    <label for="father">{{translate('Family Status')}}</label>
                    
                     <select name="family_status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Middle"
                                        <?php if(!empty($member->families->family_status)){
                                            if($member->families->family_status=='Middle'){
                                                echo 'selected';
                                            }
                                        }?>
                                        >Middle Class</option>
                                        <option value="Upper"
                                         <?php if(!empty($member->families->family_status)){
                                            if($member->families->family_status=='Upper'){
                                                echo 'selected';
                                            }
                                        }?>>Upper Middle Class</option>
                                          <option value="Rich"
                                         <?php if(!empty($member->families->family_status)){
                                            if($member->families->family_status=='Rich'){
                                                echo 'selected';
                                            }
                                        }?>>Rich</option>
                                        
                                        </select>
                                        
                    <!--<input type="text" name="family_status" value="{{ !empty($member->families->family_status) ? $member->families->family_status : "" }}" -->
                    <!--class="form-control" placeholder="{{translate('Family Status')}}" required>-->
                   
               </p>
                <p>
                    <label for="father">{{translate('Family Type')}}</label>
                    
                      <select name="family_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Joint"
                                        <?php if(!empty($member->families->family_type)){
                                            if($member->families->family_type=='Joint'){
                                                echo 'selected';
                                            }
                                        }?>
                                        >Joint</option>
                                        <option value="Nuclear"
                                         <?php if(!empty($member->families->family_type)){
                                            if($member->families->family_type=='Nuclear'){
                                                echo 'selected';
                                            }
                                        }?>>Nuclear</option>
                                          <option value="Other"
                                         <?php if(!empty($member->families->family_type)){
                                            if($member->families->family_type=='Other'){
                                                echo 'selected';
                                            }
                                        }?>>Other</option>
                                        
                                        </select>
                    <!--<input type="text" name="family_type" value="{{ !empty($member->families->family_type) ? $member->families->family_type : "" }}" -->
                    <!--class="form-control" placeholder="{{translate('Family Type')}}" required>-->
                   
               </p>
                <p>
                    <label for="father">{{translate('Family Values')}}</label>
                    
                     <select name="family_values" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Traditional"
                                        <?php if(!empty($member->families->family_values)){
                                            if($member->families->family_values=='Traditional'){
                                                echo 'selected';
                                            }
                                        }?>
                                        >Traditional</option>
                                        <option value="Moderate"
                                         <?php if(!empty($member->families->family_values)){
                                            if($member->families->family_values=='Moderate'){
                                                echo 'selected';
                                            }
                                        }?>>Moderate</option>
                                          <option value="Liberal"
                                         <?php if(!empty($member->families->family_values)){
                                            if($member->families->family_values=='Liberal'){
                                                echo 'selected';
                                            }
                                        }?>>Liberal</option>
                                        
                                        <option value="Orthodox"
                                         <?php if(!empty($member->families->family_values)){
                                            if($member->families->family_values=='Orthodox'){
                                                echo 'selected';
                                            }
                                        }?>>Orthodox</option>
                                         <option value="Family"
                                         <?php if(!empty($member->families->family_values)){
                                            if($member->families->family_values=='Family'){
                                                echo 'selected';
                                            }
                                        }?>>Family Living in</option>
                                        
                                        </select>
                                        
                                        
                    <!--<input type="text" name="family_values" value="{{ !empty($member->families->family_values) ? $member->families->family_values : "" }}" -->
                    <!--class="form-control" placeholder="{{translate('Family Values')}}" required>-->
                   
               </p>
               
                 <p>
                    <label for="father">{{translate('No of Siblings')}}</label>
                    <select class="form-control siplingselect" name="married_brother">
                        <option value="">Select</option>
                        <?php for($i=1;$i<=7;$i++){ ?>
                        <option value="<?php echo $i;?>"
                        <?php
                        
                        if(!empty($member->families->married_brother)){
                            if($member->families->married_brother==$i){
                                echo 'selected';
                            }
                        }
                        ?>
                        ><?php echo $i;?></option>
                            
                        <?php } ?>
                        </select>
                        
                        
                        
                        
                    <!--<input type="text" name="married_brother" value="{{ !empty($member->families->married_brother) ? $member->families->married_brother : "" }}" -->
                    <!--class="form-control" placeholder="{{translate('No of Siblings')}}" required>-->
                   
               </p>
               
                <?php
                        
                        // if(!empty($member->families->married_brother)){
                        //     echo $member->families->married_brother;
                        // }
                        
                        ?>
                        
                 <div  id="siblingone"  class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>1 || $member->families->married_brother==1){
                                echo 'show';
                            }
                        }
                        ?>" style="display:none">
                        <div class="row">
                       <div class="col-md-6">
                           
                     <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s1g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s1g)){
                            if($member->families->s1g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s1g)){
                            if($member->families->s1g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
<div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    <select class="form-control" name="sibling1">
                        
                        <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s1)){
                            if($member->families->s1=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s1)){
                            if($member->families->s1=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        </select>
               </div>
               </div>
               </div>
                    <div id="siblingtwo" class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>2 || $member->families->married_brother==2){
                                echo 'show';
                            }
                        }
                        ?>" style="display:none">
                        <div class="row">
                       <div class="col-md-6">
                          <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s2g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s2g)){
                            if($member->families->s2g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s2g)){
                            if($member->families->s2g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
                         <div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    <select class="form-control" name="sibling2">
                      
                         <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s2)){
                            if($member->families->s2=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s2)){
                            if($member->families->s2=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        
                        </select>
                        </div>
               </div> 
               </div>
               
               <div id="siblingthree"class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>3 || $member->families->married_brother==3){
                                echo 'show';
                            }
                        }
                        ?>" style="display:none">
                   <div class="row">
                       <div class="col-md-6">
                   <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s3g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s3g)){
                            if($member->families->s3g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s3g)){
                            if($member->families->s3g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
                         <div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    
                    <select class="form-control" name="sibling3">
                     
                         <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s3)){
                            if($member->families->s3=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s3)){
                            if($member->families->s3=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        </select>
                        </div>
               </div>    
               </div>    
               
               <div id="siblingfor" class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>4 || $member->families->married_brother==4){
                                echo 'show';
                            }
                        }
                        ?>"style="display:none">
                   <div class="row">
                     <div class="col-md-6">
                    <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s4g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s4g)){
                            if($member->families->s4g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s4g)){
                            if($member->families->s4g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
                        <div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    <select class="form-control" name="sibling4">
                      
                         <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s4)){
                            if($member->families->s4=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s4)){
                            if($member->families->s4=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        </select>
                        </div>
                        </div>
                        </div>
                <div id="siblingfive"class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>5 || $member->families->married_brother==5){
                                echo 'show';
                            }
                        }
                        ?>"style="display:none">
                    <div class="row">
                        <div class="col-md-6">
                    <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s5g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s5g)){
                            if($member->families->s5g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s5g)){
                            if($member->families->s5g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
                        <div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    <select class="form-control" name="sibling5">
                      
                         <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s5)){
                            if($member->families->s5=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s5)){
                            if($member->families->s5=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        </select>
                        </div>
                        </div>
               </div>
               <div id="siblingsix" class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>6 || $member->families->married_brother==6){
                                echo 'show';
                            }
                        }
                        ?>"style="display:none">
                   <div class="row">
                       <div class="col-md-6">
                     <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s6g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s6g)){
                            if($member->families->s6g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s6g)){
                            if($member->families->s6g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
                        <div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    <select class="form-control" name="sibling6">
                       
                         <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s6)){
                            if($member->families->s6=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s6)){
                            if($member->families->s6=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        </select>
                        </div>
                        </div>
               </div>    
               
               
               
               <div id="siblingseven"class="<?php if(!empty($member->families->married_brother)){
                            if($member->families->married_brother>7 || $member->families->married_brother==7){
                                echo 'show';
                            }
                        }
                        ?>"style="display:none">
                   <div class="row">
                       <div class="col-md-6">
                    <label for="father">{{translate('Sibling Gender')}}</label>
                    <select class="form-control" name="s7g">
                        
                        <option value="brother"
                        <?php
                        
                        if(!empty($member->families->s7g)){
                            if($member->families->s7g=='brother'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Brother</option>
                        <option value="sister"
                        <?php
                        
                        if(!empty($member->families->s7g)){
                            if($member->families->s7g=='sister'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Sister</option>
                        
                        </select>
                        </div>
                        <div class="col-md-6">
                    <label for="father">{{translate('Sibling Marital Status')}}</label>
                    <select class="form-control" name="sibling7">
                       
                         <option value="Married"
                        <?php
                        
                        if(!empty($member->families->s7)){
                            if($member->families->s7=='Married'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Married</option>
                        <option value="Unmarried"
                        <?php
                        
                        if(!empty($member->families->s7)){
                            if($member->families->s7=='Unmarried'){
                                echo 'selected';
                            }
                        }
                        ?>
                        >Unmarried</option>
                        
                        </select>
                        </div>
                        </div>
                        
              </div>
               
               
               
               
               
               <!--  <p>-->
               <!--     <label for="father">{{translate('Unmarried Brother')}}</label>-->
               <!--     <input type="text" name="unmarried_brother" value="{{ !empty($member->families->unmarried_brother) ? $member->families->unmarried_brother : "" }}" -->
               <!--     class="form-control" placeholder="{{translate('Unmarried Brother')}}" required>-->
                   
               <!--</p>-->
               
               <!--  <p>-->
               <!--     <label for="father">{{translate('Married Sister')}}</label>-->
               <!--     <input type="text" name="married_sister" value="{{ !empty($member->families->married_sister) ? $member->families->married_sister : "" }}" -->
               <!--     class="form-control" placeholder="{{translate('Married Sister')}}" required>-->
                   
               <!--</p>-->
               
               <!--  <p>-->
               <!--     <label for="father">{{translate('Unmarried Sister')}}</label>-->
               <!--     <input type="text" name="unmarried_sister" value="{{ !empty($member->families->unmarried_sister) ? $member->families->unmarried_sister : "" }}" -->
               <!--     class="form-control" placeholder="{{translate('Unmarried Sister')}}" required>-->
                   
               <!--</p>-->
               
                
                
  <!--<p><label for="sun_sign">{{translate('Sun Sign')}}</label>-->
  <!--                <input type="text" name="sun_sign" value="{{ !empty($member->astrologies->sun_sign) ? $member->astrologies->sun_sign : "" }}" class="form-control" placeholder="{{translate('Sun Sign')}}" required>-->
  <!--              </p>-->
  <!--<p> <label for="moon_sign">{{translate('Moon Sign')}}</label>-->
  <!--                <input type="text" name="moon_sign" value="{{ !empty($member->astrologies->moon_sign) ? $member->astrologies->moon_sign : "" }}" placeholder="{{ translate('Moon Sign') }}" class="form-control" required>-->
  <!--      </p>-->
  <!--      <p> <label for="time_of_birth">{{translate('Time Of Birth')}}</label>-->
  <!--                <input type="text" name="time_of_birth" value="{{ !empty($member->astrologies->time_of_birth) ? $member->astrologies->time_of_birth : "" }}" class="form-control" placeholder="{{translate('Time Of Birth')}}" required>-->
               
  <!--             </p>-->
               <!--<p>-->
               <!--    <label for="city_of_birth">{{translate('City Of Birth')}}</label>-->
               <!--   <input type="text" name="city_of_birth" value="{{ !empty($member->astrologies->city_of_birth) ? $member->astrologies->city_of_birth : "" }}" placeholder="{{ translate('City Of Birth') }}" class="form-control" required>-->
                 
               <!--    </p>-->
</div>


<!--div class="tab">
  <!--<p>  <label for="diet">{{translate('Diet')}}</label>-->
  <!--                  @php $user_diet = !empty($member->lifestyles->diet) ? $member->lifestyles->diet : ""; @endphp-->
  <!--                  <select class="form-control selectdata" name="diet" required>-->
  <!--                      <option value="yes" @if($user_diet ==  'yes') selected @endif >{{translate('Yes')}}</option>-->
  <!--                      <option value="no" @if($user_diet ==  'no') selected @endif >{{translate('No')}}</option>-->
  <!--                      @error('diet')-->
  <!--                          <small class="form-text text-danger">{{ $message }}</small>-->
  <!--                      @enderror-->
  <!--                  </select></p>-->
  <!--<p>  <label for="drink">{{translate('Drink')}}</label>-->
  <!--                  @php $user_drink = !empty($member->lifestyles->drink) ? $member->lifestyles->drink : ""; @endphp-->
  <!--                  <select class="form-control selectdata" name="drink" required>-->
  <!--                      <option value="yes" @if($user_drink ==  'yes') selected @endif >{{translate('Yes')}}</option>-->
  <!--                      <option value="no" @if($user_drink ==  'no') selected @endif >{{translate('No')}}</option>-->
  <!--                      @error('drink')-->
  <!--                          <small class="form-text text-danger">{{ $message }}</small>-->
  <!--                      @enderror-->
  <!--                  </select>   </p>-->
  <!--      <p>  <label for="smoke">{{translate('Smoke')}}</label>-->
  <!--                  @php $user_smoke = !empty($member->lifestyles->smoke) ? $member->lifestyles->smoke : ""; @endphp-->
  <!--                  <select class="form-control selectdata" name="smoke" required>-->
  <!--                      <option value="yes" @if($user_smoke ==  'yes') selected @endif >{{translate('Yes')}}</option>-->
  <!--                      <option value="no" @if($user_smoke ==  'no') selected @endif >{{translate('No')}}</option>-->
  <!--                      @error('smoke')-->
  <!--                          <small class="form-text text-danger">{{ $message }}</small>-->
  <!--                      @enderror-->
  <!--                  </select>   -->
  <!--             </p>-->
               <!--<p>-->
               <!--     <label for="smoke">{{translate('Onion')}}</label>-->
                  
                    
                    
               <!--     <select class="form-control selectdata" name="onion" >-->
               <!--         <option value="1" @if($member->onion ==  1) selected @endif >{{translate('Yes')}}</option>-->
               <!--         <option value="0" @if($member->onion ==  0) selected @endif >{{translate('No')}}</option>-->
                       
               <!--     </select>   -->
             
               <!--    </p>-->
             <!--      <p>-->
             <!--           <label for="smoke">{{translate('Garlic')}}</label>-->
                    
             <!--       <select class="form-control selectdata" name="garlic" >-->
             <!--           <option value="1" @if($member->garlic ==  1) selected @endif >{{translate('Yes')}}</option>-->
             <!--           <option value="0" @if($member->garlic ==  0) selected @endif >{{translate('No')}}</option>-->
             <!--           @error('smoke')-->
             <!--               <small class="form-text text-danger">{{ $message }}</small>-->
             <!--           @enderror-->
             <!--       </select>   -->
             
<!--             </p>-->
<!--</div>-->



<!--<div class="tab">-->
<!--    <p><label for="sun_sign">{{translate('Highest Qualification')}}</label>-->
<!--    <input type="text" name="weight" value="{{ !empty($member->physical_attributes->weight) ? $member->physical_attributes->weight : "" }}" step="any"-->
<!--    placeholder="{{ translate('Highest Qualification') }}" class="form-control" required></p>-->
    
<!--      <p><label for="sun_sign">{{translate('Occupation')}}</label>-->
<!--    <input type="text" name="eye_color" value="{{ !empty($member->physical_attributes->eye_color) ? $member->physical_attributes->eye_color : "" }}" -->
<!--    class="form-control" placeholder="{{translate('Occupation')}}" required>-->
<!--                 </p>-->
<!--                 <p><label for="sun_sign">{{translate('Annual Income')}}</label>-->
<!--     <input type="number" name="hair_color" value="{{ !empty($member->physical_attributes->hair_color) ? $member->physical_attributes->hair_color : "" }}" -->
<!--     placeholder="{{ translate('Annual Income') }}" class="form-control" required>-->
                 
<!--                 </p>-->
                
    
<!--    </div>-->
<!--     <div class="tab">-->
<!--         <p> <label for="hobbies">{{translate('Hobbies')}}</label>-->
<!--                  <input type="text" name="hobbies" value="{{ !empty($member->hobbies->hobbies) ? $member->hobbies->hobbies : "" }}" class="form-control" placeholder="{{translate('Hobbies')}}">-->
<!--             </p>-->
<!--         <p> <label for="interests">{{translate('Interests')}}</label>-->
<!--                  <input type="text" name="interests" value="{{ !empty($member->hobbies->interests) ? $member->hobbies->interests : "" }}" placeholder="{{ translate('Interests') }}" class="form-control">-->
<!--              </p>-->
<!--         <p> <label for="music">{{translate('Music')}}</label>-->
<!--                  <input type="text" name="music" value="{{ !empty($member->hobbies->music) ? $member->hobbies->music : "" }}" class="form-control" placeholder="{{translate('Music')}}">-->
<!--            </p>-->
<!--         <p><label for="books">{{translate('Books')}}</label>-->
<!--                  <input type="text" name="books" value="{{ !empty($member->hobbies->books) ? $member->hobbies->books : "" }}" placeholder="{{ translate('Books') }}" class="form-control">-->
<!--           </p>-->
<!--         <p><label for="movies">{{translate('Movies')}}</label>-->
<!--                  <input type="text" name="movies" value="{{ !empty($member->hobbies->movies) ? $member->hobbies->movies : "" }}" class="form-control" placeholder="{{translate('Movies')}}">-->
<!--          </p>-->
<!--         <p>  <label for="tv_shows">{{translate('TV Shows')}}</label>-->
<!--                  <input type="text" name="tv_shows" value="{{ !empty($member->hobbies->tv_shows) ? $member->hobbies->tv_shows : "" }}" placeholder="{{ translate('TV Shows') }}" class="form-control">-->
<!--        </p>-->
<!--         <p>-->
<!--        <label for="sports">{{translate('Sports')}}</label>-->
<!--                  <input type="text" name="sports" value="{{ !empty($member->hobbies->sports) ? $member->hobbies->sports : "" }}" class="form-control" placeholder="{{translate('Sports')}}">-->
<!--              </p>-->
              
<!--              <p>  <label for="fitness_activities">{{translate('Fitness Activitiess')}}</label>-->
<!--                  <input type="text" name="fitness_activities" value="{{ !empty($member->hobbies->fitness_activities) ? $member->hobbies->fitness_activities : "" }}" placeholder="{{ translate('Fitness Activities') }}" class="form-control">-->
<!--         </p>  <p> <label for="cuisines">{{translate('Cuisines')}}</label>-->
<!--                  <input type="text" name="cuisines" value="{{ !empty($member->hobbies->cuisines) ? $member->hobbies->cuisines : "" }}" class="form-control" placeholder="{{translate('Cuisines')}}">-->
<!--         </p><p>     <label for="dress_styles">{{translate('Dress Styles')}}</label>-->
<!--                  <input type="text" name="dress_styles" value="{{ !empty($member->hobbies->dress_styles) ? $member->hobbies->dress_styles : "" }}" placeholder="{{ translate('Dress Styles') }}" class="form-control">-->
<!--       </p>       -->
<!--         </div>-->
    <!--<div class="tab">-->
    <!--    <p>-->
    <!--         <div class="col-md-12">-->
    <!--                <label for="photo" >{{translate('Photo')}} <small>(800x800)</small>-->
    <!--                    @if(auth()->user()->photo != null && auth()->user()->photo_approved == 0)-->
    <!--                    <small class="text-danger">({{ translate('Pending for Admin Approval.') }})</small>-->
    <!--                    @elseif(auth()->user()->photo != null && auth()->user()->photo_approved == 1)-->
    <!--                        <small class="text-danger">({{ translate('Approved.') }})</small>-->
    <!--                    @endif</label>-->
    <!--                <div class="input-group" data-toggle="aizuploader" data-type="image">-->
    <!--                    <div class="input-group-prepend">-->
    <!--                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>-->
    <!--                    </div>-->
    <!--                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>-->
    <!--                    <input type="hidden" name="photo" class="selected-files" value="{{ $member->photo }}">-->
    <!--                </div>-->
    <!--                <div class="file-preview box sm">-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            </p>-->
    <!--    <p>-->
    <!--     <label for="first_name" >{{translate('First Name')}}-->
                       
    <!--                </label>-->
    <!--                <input type="text" name="first_name" value="{{ $member->first_name }}" class="form-control" placeholder="{{translate('First Name')}}" required>-->
    <!--                </p>-->
    <!--                <p>-->
    <!--                     <label for="first_name" >{{translate('Last Name')}}-->
                        
    <!--                </label>-->
    <!--                <input type="text" name="last_name" value="{{ $member->last_name }}" class="form-control" placeholder="{{translate('Last Name')}}" required>-->
                  
    <!--                </p>-->
    <!--                <p> <label for="first_name" >{{translate('Gender')}}-->
                        
    <!--                </label>-->
    <!--                <select class="form-control selectdata" name="gender" required>-->
    <!--                    <option value="1" @if($member->member->gender ==  1) selected @endif >{{translate('Male')}}</option>-->
    <!--                    <option value="2" @if($member->member->gender ==  2) selected @endif >{{translate('Female')}}</option>-->
    <!--                    @error('gender')-->
    <!--                        <small class="form-text text-danger">{{ $message }}</small>-->
    <!--                    @enderror-->
    <!--                </select></p>-->
    <!--                <p> <label for="first_name" >{{translate('Phone Number')}}-->
                        
    <!--                </label>-->
    <!--                <input type="number" name="phone" value="{{ $member->phone }}" class="form-control" placeholder="{{translate('Phone')}}" required>-->
    <!--              </p>-->
    <!--                <p><label for="first_name" >{{translate('On Behalf')}}-->
                        
    <!--                </label>-->
    <!--                <select class="form-control selectdata" name="on_behalf" data-live-search="true" required>-->
    <!--                    @foreach ($on_behalves as $on_behalf)-->
    <!--                        <option value="{{$on_behalf->id}}" @if($member->member->on_behalves_id == $on_behalf->id) selected @endif>{{$on_behalf->name}}</option>-->
    <!--                    @endforeach-->
    <!--                </select></p>-->
    <!--                <p>-->
    <!--                    <label >{{translate('Introduction')}}</label>-->
                
    <!--                    <textarea type="text" name="introduction" class="form-control" rows="4" placeholder="{{translate('Introduction')}}" required>{{ $member->member->introduction }}</textarea>-->
                    
    <!--                </p>-->
                
        
    <!--    </div>-->
<div style="overflow:auto;margin-top:40px;">
  <div style="float:right;">
    <button type="button" class="old" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
    <button type="button" class="new" id="nextBtn" onclick="nextPrev(1)">Next</button>
  </div>
</div>

<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center;margin-top:40px;" class="d-none">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
 <span class="step"></span>
 <span class="step"></span>
 <span class="step"></span>
</div>

</form>
    <div class="card" style="display:none">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Introduction')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('member.introduction.update', $member->member->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{translate('Introduction')}}</label>
                    <div class="col-md-10">
                        <textarea type="text" name="introduction" class="form-control" rows="4" placeholder="{{translate('Introduction')}}" required>{{ $member->member->introduction }}</textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Email Change -->
    <div class="card"style="display:none">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Change your email')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.change.email') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('Your Email') }}</label>
                    </div>
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                          <input type="email" class="form-control" placeholder="{{ translate('Your Email')}}" name="email" value="{{ Auth::user()->email }}" />
                          <div class="input-group-append">
                             <button type="button" class="btn btn-outline-secondary new-email-verification">
                                 <span class="d-none loading">
                                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                     {{ translate('Sending Email...') }}
                                 </span>
                                 <span class="default">{{ translate('Verify') }}</span>
                             </button>
                          </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Update')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Basic Information -->
   
                </div>
            </div>
        </div>
    </div>


   

  
    <!-- Spiritual & Social Background -->
    @php
        $member_religion_id   = !empty($member->spiritual_backgrounds->religion_id) ? $member->spiritual_backgrounds->religion_id : "";
        $member_caste_id      = !empty($member->spiritual_backgrounds->caste_id) ? $member->spiritual_backgrounds->caste_id : "";
        $member_sub_caste_id  = !empty($member->spiritual_backgrounds->sub_caste_id) ? $member->spiritual_backgrounds->sub_caste_id : "";
    @endphp
  
   

    <!-- Permanent Address -->
    @php
        $permanent_address      = \App\Models\Address::where('type','permanent')->where('user_id',$member->id)->first();
        $permanent_country_id   = !empty($permanent_address->country_id) ? $permanent_address->country_id : "";
        $permanent_state_id     = !empty($permanent_address->state_id) ? $permanent_address->state_id : "";
        $permanent_city_id      = !empty($permanent_address->city_id) ? $permanent_address->city_id : "";
        $permanent_postal_code  = !empty($permanent_address->postal_code) ? $permanent_address->postal_code : "";
    @endphp
   

 

    <!-- Partner Expectation -->
    @php
        $partner_religion_id   = !empty($member->partner_expectations->religion_id) ? $member->partner_expectations->religion_id : "";
        $partner_caste_id      = !empty($member->partner_expectations->caste_id) ? $member->partner_expectations->caste_id : "";
        $partner_sub_caste_id  = !empty($member->partner_expectations->sub_caste_id) ? $member->partner_expectations->sub_caste_id : "";
        $partner_country_id    = !empty($member->partner_expectations->preferred_country_id) ? $member->partner_expectations->preferred_country_id : "";
        $partner_state_id      = !empty($member->partner_expectations->preferred_state_id) ? $member->partner_expectations->preferred_state_id : "";
    @endphp
   

@endsection

@section('modal')
    @include('modals.create_edit_modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function(){
         get_states_by_country_for_present_address();
         get_cities_by_state_for_present_address();
         get_states_by_country_for_permanent_address();
         get_cities_by_state_for_permanent_address();
         get_castes_by_religion_for_member();
         get_sub_castes_by_caste_for_member();
         get_castes_by_religion_for_partner();
         get_sub_castes_by_caste_for_partner();
         get_states_by_country_for_partner();
    });

    // For Present address
    function get_states_by_country_for_present_address(){
        var present_country_id = $('#present_country_id').val();
            $.post('{{ route('states.get_state_by_country') }}',{_token:'{{ csrf_token() }}', country_id:present_country_id}, function(data){
                $('#present_state_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#present_state_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#present_state_id > option").each(function() {
                    if(this.value == '{{$present_state_id}}'){
                        $("#present_state_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');

                get_cities_by_state_for_present_address();
            });
        }

    function get_cities_by_state_for_present_address(){
		var present_state_id = $('#present_state_id').val();
    		$.post('{{ route('cities.get_cities_by_state') }}',{_token:'{{ csrf_token() }}', state_id:present_state_id}, function(data){
    		    $('#present_city_id').html(null);
    		    for (var i = 0; i < data.length; i++) {
    		        $('#present_city_id').append($('<option>', {
    		            value: data[i].id,
    		            text: data[i].name
    		        }));
    		    }
    		    $("#present_city_id > option").each(function() {
    		        if(this.value == '{{$present_city_id}}'){
    		            $("#present_city_id").val(this.value).change();
    		        }
    		    });

    		    AIZ.plugins.bootstrapSelect('refresh');
    		});
    	}

    $('#present_country_id').on('change', function() {
  	    get_states_by_country_for_present_address();
  	});

    $('#present_state_id').on('change', function() {
  	    get_cities_by_state_for_present_address();
  	});

    // For permanent address
    function get_states_by_country_for_permanent_address(){
        var permanent_country_id = $('#permanent_country_id').val();
            $.post('{{ route('states.get_state_by_country') }}',{_token:'{{ csrf_token() }}', country_id:permanent_country_id}, function(data){
                $('#permanent_state_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#permanent_state_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#permanent_state_id > option").each(function() {
                    if(this.value == '{{$permanent_state_id}}'){
                        $("#permanent_state_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');

                get_cities_by_state_for_permanent_address();
            });
    }

    function get_cities_by_state_for_permanent_address(){
        var permanent_state_id = $('#permanent_state_id').val();
            $.post('{{ route('cities.get_cities_by_state') }}',{_token:'{{ csrf_token() }}', state_id:permanent_state_id}, function(data){
                $('#permanent_city_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#permanent_city_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#permanent_city_id > option").each(function() {
                    if(this.value == '{{$permanent_city_id}}'){
                        $("#permanent_city_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');
            });
    }

    $('#permanent_country_id').on('change', function() {
        get_states_by_country_for_permanent_address();
    });

    $('#permanent_state_id').on('change', function() {
        get_cities_by_state_for_permanent_address();
    });

    // get castes and subcastes For member
    function get_castes_by_religion_for_member(){
        var member_religion_id = $('#member_religion_id').val();
            $.post('{{ route('castes.get_caste_by_religion') }}',{_token:'{{ csrf_token() }}', religion_id:member_religion_id}, function(data){
                $('#member_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#member_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#member_caste_id > option").each(function() {
                    if(this.value == '{{$member_caste_id}}'){
                        $("#member_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');

                get_sub_castes_by_caste_for_member();
            });
        }

    function get_sub_castes_by_caste_for_member(){
        var member_caste_id = $('#member_caste_id').val();
            $.post('{{ route('sub_castes.get_sub_castes_by_religion') }}',{_token:'{{ csrf_token() }}', caste_id:member_caste_id}, function(data){
                $('#member_sub_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#member_sub_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#member_sub_caste_id > option").each(function() {
                    if(this.value == '{{$member_sub_caste_id}}'){
                        $("#member_sub_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

    $('#member_religion_id').on('change', function() {
        get_castes_by_religion_for_member();
    });

    $('#member_caste_id').on('change', function() {
        get_sub_castes_by_caste_for_member();
    });

    // get castes and subcastes For partner
    function get_castes_by_religion_for_partner(){
        var partner_religion_id = $('#partner_religion_id').val();
            $.post('{{ route('castes.get_caste_by_religion') }}',{_token:'{{ csrf_token() }}', religion_id:partner_religion_id}, function(data){
                $('#partner_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#partner_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#partner_caste_id > option").each(function() {
                    if(this.value == '{{$partner_caste_id}}'){
                        $("#partner_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');

                get_sub_castes_by_caste_for_partner();
            });
        }

    function get_sub_castes_by_caste_for_partner(){
        var partner_caste_id = $('#partner_caste_id').val();
            $.post('{{ route('sub_castes.get_sub_castes_by_religion') }}',{_token:'{{ csrf_token() }}', caste_id:partner_caste_id}, function(data){
                $('#partner_sub_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#partner_sub_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#partner_sub_caste_id > option").each(function() {
                    if(this.value == '{{$partner_sub_caste_id}}'){
                        $("#partner_sub_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

    $('.siplingselect').on('change', function() {
        var id=$(this).val();
        if(id==1){
            $('#siblingone').addClass('show');
            
              $('#siblingtwo').removeClass('show');
             $('#siblingthree').removeClass('show');
              $('#siblingfor').removeClass('show');
              $('#siblingfive').removeClass('show');
               $('#siblingsix').removeClass('show');
               $('#siblingseven').removeClass('show');
            
            
               $('#siblingtwo').addClass('hide');
             $('#siblingthree').addClass('hide');
              $('#siblingfor').addClass('hide');
              $('#siblingfive').addClass('hide');
               $('#siblingsix').addClass('hide');
               $('#siblingseven').addClass('hide');
        }else if(id==2){
             $('#siblingone').addClass('show');
             $('#siblingtwo').addClass('show');
             
             
               $('#siblingone').removeClass('hide');
               $('#siblingtwo').removeClass('hide');
            
             $('#siblingthree').removeClass('show');
              $('#siblingfor').removeClass('show');
              $('#siblingfive').removeClass('show');
               $('#siblingsix').removeClass('show');
               $('#siblingseven').removeClass('show');
             
             
              $('#siblingthree').addClass('hide');
              $('#siblingfor').addClass('hide');
              $('#siblingfive').addClass('hide');
               $('#siblingsix').addClass('hide');
               $('#siblingseven').addClass('hide');
        }else if(id==3){
            $('#siblingone').addClass('show');
             $('#siblingtwo').addClass('show');
             $('#siblingthree').addClass('show');
             
               $('#siblingone').removeClass('hide');
               $('#siblingtwo').removeClass('hide');
               $('#siblingthree').removeClass('hide');
          
              $('#siblingfor').removeClass('show');
              $('#siblingfive').removeClass('show');
               $('#siblingsix').removeClass('show');
               $('#siblingseven').removeClass('show');
               
               
              $('#siblingfor').addClass('hide');
              $('#siblingfive').addClass('hide');
               $('#siblingsix').addClass('hide');
               $('#siblingseven').addClass('hide');
             
        }else if(id==4){
             $('#siblingone').addClass('show');
             $('#siblingtwo').addClass('show');
             $('#siblingthree').addClass('show');
              $('#siblingfor').addClass('show');
              
               $('#siblingone').removeClass('hide');
               $('#siblingtwo').removeClass('hide');
               $('#siblingthree').removeClass('hide');
               $('#siblingfor').removeClass('hide');
             
              $('#siblingfive').removeClass('show');
               $('#siblingsix').removeClass('show');
               $('#siblingseven').removeClass('show');
               
               
               
               $('#siblingfive').addClass('hide');
               $('#siblingsix').addClass('hide');
               $('#siblingseven').addClass('hide');
        }else if(id==5){
              $('#siblingone').addClass('show');
             $('#siblingtwo').addClass('show');
             $('#siblingthree').addClass('show');
              $('#siblingfor').addClass('show');
              $('#siblingfive').addClass('show');
              
                $('#siblingone').removeClass('hide');
               $('#siblingtwo').removeClass('hide');
               $('#siblingthree').removeClass('hide');
               $('#siblingfor').removeClass('hide');
             $('#siblingfive').removeClass('hide');
             
             
               
               
               $('#siblingsix').addClass('hide');
               $('#siblingseven').addClass('hide');
        }else if(id==6){
              $('#siblingone').addClass('show');
             $('#siblingtwo').addClass('show');
             $('#siblingthree').addClass('show');
              $('#siblingfor').addClass('show');
              $('#siblingfive').addClass('show');
               $('#siblingsix').addClass('show');
               
                  $('#siblingone').removeClass('hide');
               $('#siblingtwo').removeClass('hide');
               $('#siblingthree').removeClass('hide');
               $('#siblingfor').removeClass('hide');
             $('#siblingfive').removeClass('hide');
             $('#siblingsix').removeClass('hide');
            
               $('#siblingseven').removeClass('show');
               
               
                 $('#siblingseven').addClass('hide');
        }else{
             $('#siblingone').addClass('show');
             $('#siblingtwo').addClass('show');
             $('#siblingthree').addClass('show');
              $('#siblingfor').addClass('show');
              $('#siblingfive').addClass('show');
               $('#siblingsix').addClass('show');
               $('#siblingseven').addClass('show');
               
               
                   $('#siblingone').removeClass('hide');
               $('#siblingtwo').removeClass('hide');
               $('#siblingthree').removeClass('hide');
               $('#siblingfor').removeClass('hide');
             $('#siblingfive').removeClass('hide');
             $('#siblingsix').removeClass('hide');
             $('#siblingseven').removeClass('hide');
             
             
             
        }
       
    });
    $('#partner_religion_id').on('change', function() {
        get_castes_by_religion_for_partner();
    });

    $('#partner_caste_id').on('change', function() {
        get_sub_castes_by_caste_for_partner();
    });

    // For partner address
    function get_states_by_country_for_partner(){
        var partner_country_id = $('#partner_country_id').val();
            $.post('{{ route('states.get_state_by_country') }}',{_token:'{{ csrf_token() }}', country_id:partner_country_id}, function(data){
                $('#partner_state_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#partner_state_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#partner_state_id > option").each(function() {
                    if(this.value == '{{$partner_state_id}}'){
                        $("#partner_state_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');
            });
    }

    $('#partner_country_id').on('change', function() {
        get_states_by_country_for_partner();
    });

    //  education Add edit , status change
    function education_add_modal(id){
       $.post('{{ route('education.create') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
           $('.create_edit_modal_content').html(data);
           $('.create_edit_modal').modal('show');
       });
    }

    function education_edit_modal(id){
        $.post('{{ route('education.edit') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
            $('.create_edit_modal_content').html(data);
            $('.create_edit_modal').modal('show');
        });
    }

    function update_education_present_status(el) {
        if (el.checked) {
            var status = 1;
        } else {
            var status = 0;
        }
        $.post('{{ route('education.update_education_present_status') }}', {
            _token: '{{ csrf_token() }}',
            id: el.value,
            status: status
        }, function (data) {
            if (data == 1) {
                location.reload();
            } else {
                AIZ.plugins.notify('danger', 'Something went wrong');
            }
        });
    }


    //  Career Add edit , status change
    function career_add_modal(id){
       $.post('{{ route('career.create') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
           $('.create_edit_modal_content').html(data);
           $('.create_edit_modal').modal('show');
       });
    }

    function career_edit_modal(id){
        $.post('{{ route('career.edit') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
            $('.create_edit_modal_content').html(data);
            $('.create_edit_modal').modal('show');
        });
    }

    function update_career_present_status(el) {
        if (el.checked) {
            var status = 1;
        } else {
            var status = 0;
        }
        $.post('{{ route('career.update_career_present_status') }}', {
            _token: '{{ csrf_token() }}',
            id: el.value,
            status: status
        }, function (data) {
            if (data == 1) {
                location.reload();
            } else {
                AIZ.plugins.notify('danger', 'Something went wrong');
            }
        });
    }

    $('.new-email-verification').on('click', function() {
        $(this).find('.loading').removeClass('d-none');
        $(this).find('.default').addClass('d-none');
        var email = $("input[name=email]").val();

        $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
            data = JSON.parse(data);
            $('.default').removeClass('d-none');
            $('.loading').addClass('d-none');
            if(data.status == 2)
                AIZ.plugins.notify('warning', data.message);
            else if(data.status == 1)
                AIZ.plugins.notify('success', data.message);
            else
                AIZ.plugins.notify('danger', data.message);
        });
    });
</script>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  //alert(x);
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
 // alert(currentTab);
 // alert(x.length);
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }else{
  // Otherwise, display the correct tab:
  showTab(currentTab);
  }
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  var y1 = x[currentTab].getElementsByTagName("input");
   var y2 = x[currentTab].getElementsByTagName("select");
  
 
  //alert(x);
 // alert(y);
 
 var array1 = Array.prototype.slice.call(x[currentTab].getElementsByTagName("input"), 0);
var array2 = Array.prototype.slice.call( x[currentTab].getElementsByTagName("select"), 0);
y=Array.prototype.concat.call(array1,array2);
console.log(y);
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    console.log(y[i].value );
    if (y[i].value == "") {
        
        
      // add an "invalid" class to the field:
     // alert(y[i].className );
      
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
      //alert();
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}
$('.aiz-selectpicker').change(function(){
    //alert();
   $(this).removeClass('invalid'); 
});

function classempty(val) {
    $(val).className='';
    $(val).parent.removeClass('invalid');
}
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
@endsection
