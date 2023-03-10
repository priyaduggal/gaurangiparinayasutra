<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subscriber;
use Mail;
use App\Mail\EmailManager;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:newsletter'])->only('index');
    }

    public function index(Request $request)
    {
        $users = User::where('user_type','!=','admin')->get();
        return view('admin.marketing.newsletters', compact('users'));
    }

    public function send_contact(Request $request)
    {
        
       if (env('MAIL_USERNAME') != null) {
           
            
                
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = 'Contact Query ';
                    $array['from'] = env('MAIL_USERNAME');
                    $array['content'] = $request->message;

                    try {
                        Mail::to('priyaduggal2392@gmail.com')->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    
            	}
            
        }
        else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

    	flash(translate('Query has been send'))->success();
    	return redirect()->route('contact');
        
    

    
    }
    public function send(Request $request)
    {
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_USERNAME');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }
        }
        else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

    	flash(translate('Newsletter has been send'))->success();
    	return redirect()->route('newsletters.index');
    }

    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_USERNAME');
        $array['content'] = "This is a test email.";

        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(translate('An email has been sent.'))->success();
        return back();
    }
}
