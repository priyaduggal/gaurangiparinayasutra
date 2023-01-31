@extends('frontend.layouts.app')

@section('content')


<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-start align-items-between">

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#8d0203" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg>
                        </div>
                        <div class="contact_info_content">
                            
                     
                            <div class="contact_info_title">Phone Number</div>
                            <div class="contact_info_text">+91-9988601360</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start ml-3">
                        <div class="contact_info_image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#8d0203" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                          <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                        </svg>
                        </div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email Address</div>
                            <div class="contact_info_text">info@gaurangiparinayasutra.com</div>
                        </div>
                    </div>

                  

                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title hed-txt">Get in Touch</div>

                	<form class="form-default" id="reg-form" role="form" action="{{ route('contact_insert') }}" method="POST">
                          @csrf
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                            <input type="text" name="name" id="contact_form_name" class="contact_form_name input_field" placeholder="Your name"
                            required="required" data-error="Name is required." >
                            <input type="text" name="email" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email" 
                            required="required" data-error="Email is required.">
                            <input type="text" name="phone" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number">
                        </div>
                        <div class="contact_form_text">
                            <textarea id="contact_form_message" name="message" class="text_field contact_form_message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."></textarea>
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" name="submit" class="button contact_submit_button">Send Message</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>

<style>
     .button
{
    display: inline-block;
    background: #8d0203;
    border-radius: 5px;
    height: 48px;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease;
}
.button a
{
    display: block;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: #FFFFFF;
    padding-left: 35px;
    padding-right: 35px;
}
.button:hover
{
    opacity: 0.8;
}

.contact_info
{
    width: 100%;
    padding-top: 70px;
}
.contact_info_item
{
    width: calc((100% - 60px) / 3);
    height: 100px;
    border: solid 1px #e8e8e8;
    box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
    padding-left: 15px;
    padding-right: 15px;
}
.contact_info_image
{
    width: 35px;
    height: 35px;
    text-align: center;
}
.contact_info_image img
{
    max-width: 100%;
}
.contact_info_content
{
    padding-left: 17px;
}
.contact_info_title
{
    font-weight: 500;
}
.contact_info_text
{
    font-size: 12px;
    color: rgba(0,0,0,0.5);
}

/*********************************
4.1 Contact Form
*********************************/

.contact_form
{
    padding-top: 85px;
}
.contact_form_container
{

}
.contact_form_title
{
    font-size: 30px;
    font-weight: 500;
    margin-bottom: 37px;
}
.contact_form_inputs
{
    margin-bottom: 30px;
}
.input_field
{
    width: calc((100% - 60px) / 3);
    height: 50px;
    padding-left: 25px;
    border: solid 1px #e5e5e5;
    border-radius: 5px;
    outline: none;
    color: #0e8ce4;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease;
}
.input_field:focus,
.text_field:focus
{
    border-color: #b2b2b2;
}
.input_field:hover,
.text_field:hover
{
    border-color: #b2b2b2;
}
.input_field::-webkit-input-placeholder,
.text_field::-webkit-input-placeholder
{
    font-size: 16px;
    font-weight: 400;
    color: rgba(0,0,0,0.3);
}
.input_field:-moz-placeholder,
.text_field:-moz-placeholder
{
    font-size: 16px;
    font-weight: 400;
    color: rgba(0,0,0,0.3);
}
.input_field::-moz-placeholder,
.text_field::-moz-placeholder
{
    font-size: 16px;
    font-weight: 400;
    color: rgba(0,0,0,0.3);
} 
.input_field:-ms-input-placeholder,
.text_field:-ms-input-placeholder
{ 
    font-size: 16px;
    font-weight: 400;
    color: rgba(0,0,0,0.3);
}
.input_field::input-placeholder,
.text_field::input-placeholder
{
    font-size: 16px;
    font-weight: 400;
    color: rgba(0,0,0,0.3);
}
.text_field
{
    width: 100%;
    height: 160px;
    padding-left: 25px;
    padding-top: 15px;
    border: solid 1px #e5e5e5;
    border-radius: 5px;
    color: #0e8ce4;
    outline: none;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease;
}
.contact_submit_button
{
    padding-left: 35px;
    padding-right: 35px;
    color: #FFFFFF;
    font-size: 18px;
    border: none;
    outline: none;
    cursor: pointer;
    margin-top: 24px;
}
.panel
{
    width: 100%;
    height: 50px;
    background: #fafafa;
    margin-top: 120px;
}


@media only screen and (max-width: 991px)
{
    
    .contact_info_item
    {
        width: 100%;
        margin-bottom: 30px;
    }
    .contact_info_item:last-child
    {
        margin-bottom: 0px;
    }
    
}

@media only screen and (max-width: 767px)
{
    
    .input_field
    {
        margin-bottom: 30px;
        width: 100%;
    }
    .input_field:last-child
    {
        margin-bottom: 0px;
    }
}


@media only screen and (max-width: 575px)
{
    
    .contact_submit_button
    {
        font-size: 13px;
        padding-left: 25px;
        padding-right: 25px;
    }
    
}

</style>
@endsection
