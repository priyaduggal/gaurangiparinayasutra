@extends('frontend.layouts.app')
@section('content')
 <section class="bg-color m-set s2-befor-1">
          <div class="container">
            <div class="row justify-content-center text-center ">
              <div class="col-md-3">
                <img src="{{ static_asset('assets/Images/Untitled-8.png') }}" class="img-fluid"/>
              </div>
            </div>
            <div class="row text-center justify-content-center">
              <div class="col-md-6 mt-5 mb-5">
                <h1 class="s2-h1">Find Your Special Someone</h1>
              </div>
            </div>
            <div class="row bg-1-edit text-center align-items-center">
              <div class="col-md-4 text-center sign-befor">
              <img src="{{ static_asset('assets/Images/icon1.png') }}" class="img-fluid"/>
                <h6 class="text-color-s2 mt-3">Sign Up Free</h6>
                <p class="text-size-s2 mb-0 mx-auto">Register for free and put up your Matrimonial Profile</p>
              </div>
              <div class="col-md-4 text-center connect-befor">
              <img src="{{ static_asset('assets/Images/icon2.png') }}" class="img-fluid" />
                <h6 class="text-color-s2 mt-3">Connect</h6>
                <p class="text-size-s2 mb-0 mx-auto">Select and connect with matches you like</p>
              </div>
              <div class="col-md-4 text-center">
              <img src="{{ static_asset('assets/Images/icon2.png') }}" class="img-fluid" />
                <h6 class="text-color-s2 mt-3">Intract</h6>
                <p class="text-size-s2 mb-0 mx-auto">Become a Premium Member & Start a Conversation</p>
              </div>
            </div>

          </div>
        </section>
         <section class="bg-color-s3 pt-5 pb-3 mb-5 s3-befor">
          <div class="container">
            <div class="row">
              <div class="col-md-6  pt-5 pb-5">
                <h2 class="s3-head-text">About Us</h2>
                <p class="s3-p-text mt-5 mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <p class="s3-p-text mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <button class="btn s3-but">Read More</button>
              </div>
              
              <div class="col-md-6 s3-before-2">
                <div class="img-s3-outline">
                <img src="{{ static_asset('assets/Images/about-us.png') }}" alt="Marriage" class="img-fluid s3-border">
              </div>

              </div>
            </div>
          </div>
        </section>
          @if (get_setting('show_happy_story_section') != 'on')
        <section class="py-7 bg-dark text-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3">Happy Stories</h2>
                        </div>
                    </div>
                </div>
                <div
                    class="card-columns column-gap-10 card-columns-xxl-4 card-columns-lg-3 card-columns-md-2 card-columns-1">
                    @php
                        $happy_stories = \App\Models\HappyStory::where('approved', '1')
                            ->latest()
                            ->limit(get_setting('max_happy_story_show_homepage'))
                            ->get();
                    @endphp
                    @foreach ($happy_stories as $key => $happy_story)
                        @php
                            $photo = explode(',', $happy_story->photos);
                        @endphp
                        <div class="card border-gray-800 overflow-hidden mb-2">
                            <a href="{{ route('story_details', $happy_story->id) }}"
                                class="text-reset d-block position-relative">
                                <img src="{{ uploaded_asset($photo[0]) }}" class="img-fluid">
                                <div class="absolute-bottom-left p-3">
                                    <div class="position-relative z-1 p-3">
                                        <div class="absolute-full z--1 bg-dark opacity-60"></div>
                                        <div class="text-primary text-truncate">
                                            {{ $happy_story->user->first_name . ' & ' . $happy_story->partner_name }}</div>
                                        <h2 class="h5 mb-0 fs-14 fw-400 lh-1-5 text-truncate-3">
                                            {{ $happy_story->title }}
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('happy_stories') }}" class="btn btn-primary">{{ translate('View More') }}</a>
                </div>
            </div>
        </section>
    @endif
        <section class="our-stories-edit pt-5 pb-5 hidden">
          <div class="container">
            <div class="row mt-3">
              <div class="col-md-12 text-left">
                <p class="mb-1 s4-headp-text">LAKHS OF HAPPY COUPLES</p>
                <h1 class="s4-headh-text mb-0">Our Sucess Stories</h1>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-md-4">
                <div class="card img-fluid border-0 card-image-befor" style="width:500px">
                  <img class="card-img-top os-1-edit" src="{{ static_asset('/img/Amit-yashika-14-07-2016.jpg') }}" alt="Card image" style="width:100%;max-height:313px;height:313px;">
                  <div class="card-img-overlay text-center p-0">
                    <h4 class="card-title text-white s4-h-edit mb-0 pb-2">Amit & Yashika</h4>
                    <p class="card-text text-white s4-p-edit p-2">MARRIAGE DATE 14, JULY 2016</p> 
                  </div>
                </div>
                 <div class="card img-fluid border-0 card-image-befor" style="width:500px">
                  <img class="card-img-top os-2-edit" src="{{ static_asset('assets/img/345.jpg') }}" alt="Card image" style="width:100%;max-height:313px;height:313px;">
                  <div class="card-img-overlay text-center p-0">
                    <h4 class="card-title text-white s4-h-edit mb-0 pb-2">Aanchal & Aashish</h4>
                    <p class="card-text text-white s4-p-edit p-2">MARRIAGE DATE 16 APRIL 2019</p> 
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card img-fluid border-0 card-image-befor" style="width:500px">
                  <img class="card-img-top os-2-edit" src="{{ static_asset('assets/img/28.jpg') }}" alt="Card image" style="width:100%;max-height:313px;height:313px;">
                  <div class="card-img-overlay text-center p-0">
                    <h4 class="card-title text-white s4-h-edit mb-0 pb-2">Jogesh & Kritika</h4>
                    <p class="card-text text-white s4-p-edit p-2">MARRIAGE DATE 30, NOVEMBER 2020</p> 
                  </div>
                </div><div class="card img-fluid border-0 card-image-befor" style="width:500px">
                  <img class="card-img-top os-2-edit" src="{{ static_asset('assets/img/121.jpg') }}" alt="Card image" style="width:100%;max-height:313px;height:313px;">
                  <div class="card-img-overlay text-center p-0">
                    <h4 class="card-title text-white s4-h-edit mb-0 pb-2">Shivangi & Raghav</h4>
                    <p class="card-text text-white s4-p-edit p-2">MARRIAGE DATE 12, NOVEMBER 2021</p> 
                  </div>
                </div>
               
              </div>
              <div class="col-md-4">
<div class="card img-fluid border-0 card-image-befor" style="width:500px">
                  <img class="card-img-top os-2-edit" src="{{ static_asset('assets/img/22.jpg') }}" alt="Card image" style="width:100%;max-height:313px;height:313px;">
                  <div class="card-img-overlay text-center p-0">
                    <h4 class="card-title text-white s4-h-edit mb-0 pb-2">Sourabh & Nikita</h4>
                    <p class="card-text text-white s4-p-edit p-2">MARRIAGE DATE 30, NOVEMBER 2020</p> 
                  </div>
                </div>
                <div class="card img-fluid border-0 card-image-befor" style="width:500px">
                  <img class="card-img-top os-2-edit" src="{{ static_asset('assets/img/23.jpg') }}" alt="Card image" style="width:100%;max-height:313px;height:313px;">
                  <div class="card-img-overlay text-center p-0">
                    <h4 class="card-title text-white s4-h-edit mb-0 pb-2">Pretty Tiwari & Vikas Pathak</h4>
                    <p class="card-text text-white s4-p-edit p-2">MARRIAGE DATE 19, APRIL 2022</p> 
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
        <section class="s-5-get-start pt-5 pb-5 mb-5 d-none">
          <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-10 text-center">
              <h1 class="s5-h-edit mb-5 ">Your Story is Waiting to Happen!</h1>
              <button class="btn s5-but-edit">GET STARTED</button>
            </div>
          </div>

          </div>

        </section>
    <!-- Homepage Slider Section -->
   

    
   
@endsection

@section('modal')
    @include('modals.login_modal')
    @include('modals.package_update_alert_modal')
@endsection

@section('script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        function loginModal() {
            $('#LoginModal').modal();
        }

        function package_update_alert() {
            $('.package_update_alert_modal').modal('show');
        }
        // making the CAPTCHA  a required field for form submission
        @if (get_setting('google_recaptcha_activation') == 1)
            $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
            alert("please verify you are humann!");
            evt.preventDefault();
            return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#reg-form").submit();
            });
            });
        @endif


        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if (country.iso2 == 'bd') {
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "us";
                    callback(countryCode);
                });
            },
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if (selectedCountryData.iso2 == 'bd') {
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            } else {
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
