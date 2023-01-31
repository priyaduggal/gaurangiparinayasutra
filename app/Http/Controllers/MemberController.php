<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Package;
use App\Models\Country;
use App\Models\State;use App\Models\Address;
use App\Models\City;
use App\Models\Lifestyle;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\SubCaste;
use App\Models\MemberLanguage;use App\Models\Family;
use App\Models\FamilyValue;use App\Models\SpiritualBackground;
use App\Models\MaritalStatus;
use App\Models\OnBehalf;
use App\Models\Wallet;
use App\User;
use App\Models\Hobby;use App\Models\Astrology;
use App\Models\PhysicalAttribute;
use Hash;
use Validator;
use Redirect;
use Auth;
use App\Utility\EmailUtility;
use App\Utility\SmsUtility;



class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show_members'])->only('index');
        $this->middleware(['permission:create_member'])->only('create');
        $this->middleware(['permission:edit_member'])->only('edit');
        $this->middleware(['permission:delete_member'])->only('destroy');
        $this->middleware(['permission:view_member_profile'])->only('show');
        $this->middleware(['permission:block_member'])->only('block');
        $this->middleware(['permission:approve_member'])->only('approve');
        $this->middleware(['permission:update_member_package'])->only('package_info');
        $this->middleware(['permission:login_as_member'])->only('login');
        $this->middleware(['permission:deleted_member_show'])->only('deleted_members');
        $this->middleware(['permission:show_unapproved_profile_picrures'])->only('unapproved_profile_pictures');
        $this->middleware(['permission:approve_profile_picrures'])->only('approve_profile_image');

        $this->rules = [
            'first_name'        => [ 'required','max:255'],
            'last_name'         => [ 'required','max:255'],
            'email'             => [ 'max:255','unique:users,email'],
            'gender'            => [ 'required'],
            'date_of_birth'     => [ 'required'],
            'on_behalf'         => [ 'required'],
            'package'           => [ 'required'],
            'password'          => [ 'min:8','required_with:confirm_password','same:confirm_password'],
            'confirm_password'  => [ 'min:8'],

        ];

        $this->messages = [
            'first_name.required'       => translate('First name is required'),
            'first_name.max'            => translate('Max 255 characters'),
            'last_name.required'        => translate('First name is required'),
            'last_name.max'             => translate('Max 255 characters'),
            'email.max'                 => translate('Max 255 characters'),
            'email.unique'              => translate('Email Should be unique'),
            'gender.required'           => translate('Gender is required'),
            'date_of_birth.required'    => translate('Gender is required'),
            'on_behalf.required'        => translate('On behalf is required'),
            'package.required'          => translate('Package is required'),
            'password.min'              => translate('Min 8 characters'),
            'password.required_with'    => translate('Password and Confirm password are required'),
            'password.same'             => translate('Password and Confirmed password did not matched'),
            'confirm_password.min'      => translate('Max 8 characters'),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function partner()
    {
         $member             = User::findOrFail(Auth::user()->id);
      $countries          = Country::where('status',1)->get();
      $states             = State::all();
      $cities             = City::all();
      $religions          = Religion::all();
      $castes             = Caste::all();
      $sub_castes         = SubCaste::all();
      $family_values      = FamilyValue::all();
      $marital_statuses   = MaritalStatus::all();
      $on_behalves        = OnBehalf::all();
      $languages          = MemberLanguage::all();

      return view('frontend.member.profile.index2', compact('member','countries','states','cities','religions','castes','sub_castes','family_values','marital_statuses','on_behalves','languages'));

    }
    public function index(Request $request, $id)
    {
        
        $sort_search  = null;
        $members       = User::latest()->where('user_type','member')->where('membership',$id);

        if ($request->has('search')){
            $sort_search  = $request->search;
            $members  = $members->where('code',$sort_search)->orwhere('first_name', 'like', '%'.$sort_search.'%')->orWhere('last_name', 'like', '%'.$sort_search.'%');
        }

        $members = $members->paginate(10);
        return view('admin.members.index', compact('members','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules;
        $messages = $this->messages;
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            flash(translate('Something went wrong'))->error();
            return Redirect::back()->withErrors($validator);
        }

        if($request->email == null && $request->phone == null )
        {
            flash(translate('Email and Phone both can not be null.'));
            return back();
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Email or Phone already exists.'));
                return back();
            }
        }
        elseif (User::where('phone', '+'.$request->country_code.$request->phone)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }

        $user               = new user;
        $user->user_type    = 'member';
        $user->code         = unique_code();
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->password     = Hash::make($request->password);
        $user->photo        = $request->photo;
        $user->email        = $request->email;
        if($request->phone != null){
          $user->phone        = '+'.$request->country_code.$request->phone;
        }
        if($request->member_verification == 1){
            $user->email_verified_at     = date('Y-m-d h:m:s');
        }
        if($user->save()){
            $member                             = new Member;
            $member->user_id                    = $user->id;
            $member->gender                     = $request->gender;
            $member->on_behalves_id             = $request->on_behalf;
            $member->birthday                   = date('Y-m-d', strtotime($request->date_of_birth));

            $package                                = Package::where('id',$request->package)->first();
            $member->current_package_id             = $package->id;
            $member->remaining_interest             = $package->express_interest;
            $member->remaining_photo_gallery        = $package->photo_gallery;
            $member->remaining_contact_view         = $package->contact;
            $member->remaining_profile_image_view	= $package->profile_image_view;
            $member->remaining_gallery_image_view   = $package->gallery_image_view;
            $member->auto_profile_match             = $package->auto_profile_match;
            $member->package_validity               = Date('Y-m-d', strtotime($package->validity." days"));
            $membership                             = $package->id == 1 ? 1 : 2;
            $member->save();

            $user_update                = User::findOrFail($user->id);
            $user_update->membership    = $membership;
            $user_update->save();

            // Account opening email to member
            if($user->email != null  && env('MAIL_USERNAME') != null && (get_email_template('account_oppening_email','status') == 1))
            {
                EmailUtility::account_oppening_email($user->id, $request->password);
            }

            // Account Opening SMS to member
            if($user->phone != null && addon_activation('otp_system') && (get_sms_template('account_opening_by_admin','status') == 1 ))
            {
                SmsUtility::account_opening_by_admin($user, $request->password);
            }

            flash('New member has been added successfully')->success();
            return redirect()->route('members.index', $membership);
        }

        flash('Sorry! Something went wrong.')->error();
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::findOrFail($id);
        return view('admin.members.view', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $member             = User::findOrFail(decrypt($id));
        $countries          = Country::where('status',1)->get();
        $states             = State::all();
        $cities             = City::all();
        $religions          = Religion::all();
        $castes             = Caste::all();
        $sub_castes         = SubCaste::all();
        $family_values      = FamilyValue::all();
        $marital_statuses   = MaritalStatus::all();
        $on_behalves        = OnBehalf::all();
        $languages          = MemberLanguage::all();

        return view('admin.members.edit.index', compact('member','countries','states','cities','religions','castes','sub_castes','family_values','marital_statuses','on_behalves','languages'));
    }


    public function introduction_edit(Request $request)
    {
        $member = User::findOrFail($request->id);
        return view('admin.members.edit_profile_attributes.introduction', compact('member'));
    }

    public function introduction_update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->introduction = $request->introduction;
        if($member->save()){
            flash('Member introduction info has been updated successfully')->success();
            return back();
        }
        flash('Sorry! Something went wrong.')->error();
        return back();
    }

    public function updateonion(Request $request, $id)
    {
        
            $user                     = User::where('id',$request->id)->first();
        $user->onion             = $request->onion;
       

        if($user->save())
        {
            flash('Member basic info  has been updated successfully')->success();
            return back();
        }
        flash('Sorry! Something went wrong.')->error();
        return back();
        
    }
    
     public function updategarlic(Request $request, $id)
    {
        
            $user                     = User::where('id',$request->id)->first();
        $user->garlic             = $request->garlic;
       

        if($user->save())
        {
            flash('Member basic info  has been updated successfully')->success();
            return back();
        }
        flash('Sorry! Something went wrong.')->error();
        return back();
        
    }
    public function basic_info_update1(Request $request) {
        
      

        $user = User::findOrFail(auth()->user()->id);
    
        if(get_setting('profile_picture_approval_by_admin') && $request->photo != $user->photo && auth()->user()->user_type == 'member'){
            $user->photo_approved = 0;
        }
        $user->photo        = $request->photo;
      
       

       
        
        if($user->save())
        {
            flash('Profile  has been updated successfully')->success();
           
            return back();
        }
       

    }

    public function basic_info_update(Request $request, $id)
    {
        
        // //print_r($request->all());die;
        // $this->rules = [
        //     'first_name'    => [ 'required','max:255'],
        //     'last_name'     => [ 'required','max:255'],
        //     'gender'        => [ 'required'],
        //     'date_of_birth' => [ 'required'],
        //     'on_behalf'     => [ 'required'],
        //     'marital_status'=> [ 'required'],
        // ];
        // $this->messages = [
        //     'first_name.required'             => translate('First Name is required'),
        //     'first_name.max'                  => translate('Max 255 characters'),
        //     'last_name.required'              => translate('First Name is required'),
        //     'last_name.max'                   => translate('Max 255 characters'),
        //     'gender.required'                 => translate('Gender is required'),
        //     'date_of_birth.required'          => translate('Date Of Birth is required'),
        //     'on_behalf.required'              => translate('On Behalf is required'),
        //     'marital_status.required'         => translate('Marital Status is required'),


        // ];

    //   $rules = $this->rules;
    // $messages = $this->messages;
    //  $validator = Validator::make($request->all(), $rules, $messages);

    //     if ($validator->fails()) {
    //         flash(translate('Something went wrong'))->error();
    //         return Redirect::back()->withErrors($validator);
    //     }
        // if($request->email == null && $request->phone == null){
        //   flash(translate('Email and Phone number both can not be null. '))->error();
        //   return back();
        // }

        $user               = User::findOrFail($request->id);
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        
        if(get_setting('profile_picture_approval_by_admin') && $request->photo != $user->photo && auth()->user()->user_type == 'member'){
            $user->photo_approved = 0;
        }
        $user->photo        = $request->photo;
        $user->phone        = $request->phone;
        $user->onion        = $request->onion;
        $user->garlic        = $request->garlic;
        $user->save();

        $member                     = Member::where('user_id',$request->id)->first();
           if(empty($member)){
             $member = new Member;
             $member->user_id = $request->id;
         }
        $member->gender             = $request->gender;
        $member->on_behalves_id     = $request->on_behalf;
        $member->birthday           = date('Y-m-d', strtotime($request->date_of_birth));
        $member->marital_status_id  = $request->marital_status;
      //  $member->children           = $request->children;
        $member->mothere_tongue     = $request->mothere_tongue;
        $member->known_languages    = $request->known_languages;
         $member->introduction = $request->introduction;
        
        $physical_attribute = PhysicalAttribute::where('user_id', $request->id)->first();
         if(empty($physical_attribute)){
             $physical_attribute = new PhysicalAttribute;
             $physical_attribute->user_id = $request->id;
         }
        $physical_attribute->height        = $request->height;
        $physical_attribute->heightfeet        = $request->heightfeet;
         $physical_attribute->weight        = $request->weight;
          $physical_attribute->eye_color     = $request->eye_color;
         $physical_attribute->hair_color    = $request->hair_color;
         $physical_attribute->manglik_status    = $request->manglik_status;
         $physical_attribute->physical_status    = $request->physical_status;
         $physical_attribute->save();
         
         
           $family = Family::where('user_id', $request->id)->first();
            if(empty($family)){
             $family           = new Family;
             $family->user_id  = $request->id;
         }

         $family->family_status    = $request->family_status;
         $family->family_type    = $request->family_type;
         $family->family_values   = $request->family_values;
         $family->married_brother   = $request->married_brother;
         $family->s1   = $request->sibling1;
         $family->s2   = $request->sibling2;
         $family->s3   = $request->sibling3;
         $family->s4   = $request->sibling4;
         $family->s5   = $request->sibling5;
         $family->s6   = $request->sibling6;
         $family->s7   = $request->sibling7;
         $family->s1g   = $request->s1g;
         $family->s2g   = $request->s2g;
         $family->s3g   = $request->s3g;
         $family->s4g   = $request->s4g;
         $family->s5g   = $request->s5g;
         $family->s6g   = $request->s6g;
         $family->s7g   = $request->s7g;

         $family->save();
           
         
          $hobbies = Hobby::where('user_id', $request->id)->first();
           if(empty($hobbies)){
             $hobbies = new Hobby;
             $hobbies->user_id = $request->id;
         }
         $hobbies->hobbies              = $request->hobbies;
         $hobbies->interests            = $request->interests;
         $hobbies->music                = $request->music;
         $hobbies->books                = $request->books;
         $hobbies->movies               = $request->movies;
         $hobbies->tv_shows             = $request->tv_shows;
         $hobbies->sports               = $request->sports;
         $hobbies->fitness_activities   = $request->fitness_activities;
         $hobbies->cuisines             = $request->cuisines;
         $hobbies->dress_styles         = $request->dress_styles;
            $hobbies->save();
          
          
           $astrologies = Astrology::where('user_id', $request->id)->first();
             if(empty($astrologies)){
             $astrologies = new Astrology;
             $astrologies->user_id = $request->id;
         }
         $astrologies->sun_sign         = $request->sun_sign;
         $astrologies->moon_sign        = $request->moon_sign;
         $astrologies->time_of_birth    = $request->time_of_birth;
         $astrologies->city_of_birth    = $request->city_of_birth;
         $astrologies->save();
         
         
         
         
           $spiritual_backgrounds = SpiritualBackground::where('user_id', $request->id)->first();
 if(empty($spiritual_backgrounds)){
             $spiritual_backgrounds = new SpiritualBackground;
             $spiritual_backgrounds->user_id = $request->id;
         }

         $spiritual_backgrounds->religion_id        = $request->member_religion_id;
         $spiritual_backgrounds->caste_id           = $request->member_caste_id;
         $spiritual_backgrounds->sub_caste_id       = $request->member_sub_caste_id;
       
         $spiritual_backgrounds->save();
           
        //       $address_type = $request->address_type;
         $address = Address::where('user_id', $request->id)->where('type',$request->address_type)->first();
         if(empty($address)){
             $address = new Address;
             $address->user_id = $request->id;
         }
       // print_r($address);die;
        
         
            $address->country_id   = $request->permanent_country_id;
             $address->state_id     = $request->permanent_state_id;
            $address->city_id      = $request->permanent_city_id;
            // $address->postal_code  = $request->permanent_postal_code;
               $address->type             = $request->address_type;


         $address->save();
         
          $address_type1 = $request->address_present;
            $address1 = Address::where('user_id', $id)->where('type',$address_type1)->first();
         if(empty($address1)){
             $address1 = new Address;
             $address1->user_id = $request->id;
         }
           if($address_type1 == 'present'){
             $address1->country_id   = $request->present_country_id;
             $address1->state_id     = $request->present_state_id;
             $address1->city_id      = $request->present_city_id;
             $address1->postal_code  = $request->present_postal_code;
         }
         $address1->type             = $address_type1;
         $address1->save();
         
         
         
        $lifestyle = Lifestyle::where('user_id', $request->id)->first();
         if(empty($lifestyle)){
             $lifestyle             = new Lifestyle;
             $lifestyle->user_id    = $id;
         }

         $lifestyle->diet          = $request->diet;
         $lifestyle->drink         = $request->drink;
         $lifestyle->smoke         = $request->smoke;
         $lifestyle->living_with   = $request->living_with;

         $lifestyle->save();
             
             
        if($member->save())
        {
            flash('Member basic info  has been updated successfully')->success();
            return redirect()->route('member.listing');
           // return back();
        }
        flash('Sorry! Something went wrong.')->error();
        return back();

    }

    public function language_info_update(Request $request, $id)
    {
        $member                     = Member::where('user_id',$request->id)->first();
        $member->mothere_tongue     = $request->mothere_tongue;
        $member->known_languages    = $request->known_languages;

        if($member->save())
        {
            flash('Member language info has been updated successfully')->success();
            return back();
        }
        flash('Sorry! Something went wrong.')->error();
        return back();
    }

    public function approve(Request $request)
    {
        $member             = User::findOrFail($request->member_id);
        $member->approved   = 1;
        if ($member->save()) {

            // Account approval email send to members
            if($member->email != null && get_email_template('account_approval_email','status'))
            {
                EmailUtility::account_approval_email($member);
            }


            // Account Approval SMS send to member
            if($member->phone && addon_activation('otp_system') && get_sms_template('account_approval','status'))
            {
                SmsUtility::account_approval($member);
            }

            flash('Member Approved')->success();
            return redirect()->route('members.index', $member->membership);
        } else {
            flash('Sorry! Something went wrong.')->error();
            return back();
        }
    }

    public function deleted_members(Request $request)
    {
        $sort_search        = null;
        $deleted_members    = User::onlyTrashed()->where('permanently_delete',0);
        if ($request->has('search')){
            $sort_search  = $request->search;
            $deleted_members  = $deleted_members->where('code',$sort_search)->orwhere('first_name', 'like', '%'.$sort_search.'%')->orWhere('last_name', 'like', '%'.$sort_search.'%');
        }
        $deleted_members = $deleted_members->paginate(10);
        return view('admin.members.deleted_members', compact('deleted_members','sort_search'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $membership = $user->membership;
        if (User::destroy($id)) {
            flash('Member has been added to the deleted member list')->success();
            return redirect()->route('members.index', $membership);
        } else {
            flash('Sorry! Something went wrong.')->error();
            return back();
        }
    }

    public function restore_deleted_member($id)
    {
        if (User::withTrashed()->where('id', $id)->restore()) {
            flash('Member has been restored successfully')->success();
            return redirect()->route('deleted_members');
        } else {
            flash('Sorry! Something went wrong.')->error();
            return back();
        }
    }
    public function member_permanemtly_delete($id)
    {
      $user = User::withTrashed()->where('id', $id)->first();
      $user->permanently_delete = 1;
        if ($user->save()) {
            flash('Member permanently deleted successfully')->success();
            return redirect()->route('deleted_members');
        } else {
            flash('Sorry! Something went wrong.')->error();
            return back();
        }
    }

    public function package_info(Request $request)
    {
        $member = Member::where('user_id',$request->id)->first();
        return view('admin.members.package_modal', compact('member'));
    }

    public function get_package(Request $request)
    {
        $member_id = $request->id;
        $packages  = Package::where('active',1)->get();
        return view('admin.members.get_package', compact('member_id','packages'));
    }

    public function package_do_update(Request $request, $id){

        $member                                 = Member::where('id',$id)->first();
        $package                                = Package::where('id', $request->package_id)->first();
        $member->current_package_id             = $package->id;
        $member->remaining_interest             = $member->remaining_interest + $package->express_interest;
        $member->remaining_photo_gallery        = $member->remaining_photo_gallery + $package->photo_gallery;
        $member->remaining_contact_view         = $member->remaining_contact_view + $package->contact;
        $member->remaining_profile_image_view	= $member->remaining_profile_image_view + $package->profile_image_view;
        $member->remaining_gallery_image_view   = $member->remaining_gallery_image_view + $package->gallery_image_view;

        $member->auto_profile_match         = $package->auto_profile_match;
        $member->package_validity           = date('Y-m-d', strtotime($member->package_validity. ' +'. $package->validity .'days'));
        $membership                         = $package->id == 1 ? 1 : 2;

        if($member->save()){
            $user                = User::where('id',$member->user_id)->first();
            $user->membership    = $membership;
            if($user->save()){
                flash(translate('Member package has been updated successfully'))->success();
                return redirect()->route('members.index', $membership);
            }
        }
        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function member_wallet_balance_update(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();

        $wallet                   = new Wallet;
        $wallet->user_id          = $user->id;
        $wallet->amount           = $request->wallet_amount;
        $wallet->payment_method   = $request->payment_option;
        $wallet->payment_details  = '';
        $wallet->save();

        if($request->payment_option == 'added_by_admin'){
          $user->balance = $user->balance + $request->wallet_amount;
        }
        elseif($request->payment_option == 'deducted_by_admin'){
          $user->balance = $user->balance - $request->wallet_amount;
        }

        if($user->save()){
          flash(translate('Wallet Balance Updated Successfully'))->success();
          return back();
        }
        else{
          flash(translate('Something Went Wrong!'))->error();
          return back();
        }

    }

    public function block(Request $request)
    {
        $user           = User::findOrFail($request->member_id);
        $user->blocked  = $request->block_status;
        if($user->save()){
            $member                 = Member::where('user_id', $user->id)->first();
            $member->blocked_reason = !empty($request->blocking_reason) ? $request->blocking_reason : "" ;
            if($member->save()){

                flash($user->blocked == 1 ? translate('Member Blocked !') : translate('Member Unblocked !') )->success();
                return back();
            }
        }
        flash('Sorry! Something went wrong.')->error();
        return back();
    }

    public function blocking_reason(Request $request)
    {
        $blocked_reason = Member::where('user_id', $request->id)->first()->blocked_reason;
        return $blocked_reason;
    }

    // Login by admin as a Member
    public function login($id)
    {
        $user = User::findOrFail(decrypt($id));
        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    // Member Profile settings Frontend
     public function profile()
    {
      $member             = User::findOrFail(Auth::user()->id);
      $countries          = Country::where('status',1)->get();
      $states             = State::all();
      $cities             = City::all();
      $religions          = Religion::all();
      $castes             = Caste::all();
      $sub_castes         = SubCaste::all();
      $family_values      = FamilyValue::all();
      $marital_statuses   = MaritalStatus::all();
      $on_behalves        = OnBehalf::all();
      $languages          = MemberLanguage::all();

      return view('frontend.member.profile.index1', compact('member','countries','states','cities','religions','castes','sub_castes','family_values','marital_statuses','on_behalves','languages'));
    }
    public function profile_settings()
    {
      $member             = User::findOrFail(Auth::user()->id);
      $countries          = Country::where('status',1)->get();
      $states             = State::all();
      $cities             = City::all();
      $religions          = Religion::all();
      $castes             = Caste::all();
      $sub_castes         = SubCaste::all();
      $family_values      = FamilyValue::all();
      $marital_statuses   = MaritalStatus::all();
      $on_behalves        = OnBehalf::all();
      $languages          = MemberLanguage::all();

      return view('frontend.member.profile.index', compact('member','countries','states','cities','religions','castes','sub_castes','family_values','marital_statuses','on_behalves','languages'));
    }

    public function unapproved_profile_pictures(){
        $users = User::where('user_type','member')->where('photo_approved',0)->latest()->paginate(10);
        return view('admin.members.unapproved_member_profile_pictures', compact('users'));
    }

    public function approve_profile_image(Request $request){
        $user = User::findOrFail($request->id);
        $user->photo_approved = 1;
        if ($user->save()) {
            flash(translate('Profile Picture Approved Successfully'))->success();
            return 1;
        }
        return 0;
    }

    // Change Password
    public function change_password()
    {
      return view('frontend.member.password_change');
    }

    public function password_update(Request $request, $id)
    {
      $rules = [
          'old_password'      => [ 'required'],
          'password'          => [ 'min:8','required_with:confirm_password','same:confirm_password'],
          'confirm_password'  => [ 'min:8'],
      ];

      $messages = [
          'old_password.required'     => translate('Old Password is required'),
          'password.required_with'    => translate('Password and Confirm password are required'),
          'password.same'             => translate('Password and Confirmed password did not matched'),
          'confirm_password.min'      => translate('Max 8 characters'),
      ];

      $validator  = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
          flash(translate('Sorry! Something went wrong'))->error();
          return Redirect::back()->withErrors($validator);
      }

      $user = User::findOrFail($id);

      if(Hash::check($request->old_password, $user->password))
      {
        $user->password = Hash::make($request->password);
        $user->save();
        flash(translate('Passwoed Updated successfully.'))->success();
        return redirect()->route('member.change_password');
      }
      else
      {
        flash(translate('Old password do not matched.'))->error();
        return back();
      }
    }

    public function update_account_deactivation_status(Request $request)
    {
        $user = Auth::user();
        $user->deactivated = $request->deacticvation_status;
        $deacticvation_msg = $request->deacticvation_status == 1 ? translate('deactivated') : translate('reactivated');
        if($user->save())
        {
            flash(translate('Your account ').$deacticvation_msg.translate(' successfully!'))->success();
            return redirect()->route('dashboard');
        }
        flash(translate('Something Went Wrong!'))->error();
        return back();
    }
}
