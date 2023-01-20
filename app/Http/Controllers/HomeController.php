<?php

namespace App\Http\Controllers;

use App\Guest;
use App\GeneralGuest;
use App\Imports\GuestList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendGuestInvite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('validateGuest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $guests = Guest::all();
        return view('home',compact('guests'));
    }

    public function inviteGuest(Request $request)
    {
        // if($request->no_of_guests > 0)
        // {
        //     for($i = 0; $i < (int)$request->no_of_guests; $i++)
        //     {
        //         $token = Str::random(60);
        //         $guest = new Guest;
        //         $guest->user_id = auth()->user()->id;
        //         $guest->full_name = $request->name;
        //         $guest->email = $request->email;
        //         $guest->phone_no = $request->phone;
        //         $guest->token = $token;
        //         $guest->status = 0;
        //         if($guest->save())
        //         {
        //             Mail::to($request->email)->cc(auth()->user()->email)->send(new SendGuestInvite($guest));
        //         }
        //     }

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'success'
        //     ]);
            
        // }

        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:guests|email',
            'name' => 'required',
        ]);

        $errors = [];

        foreach ($validate->errors()->getMessages() as $item) {
            array_push($errors, $item);
        }

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $errors,
            ], 500);
        }

        if(Guest::where('email', '=', $request->email)->first()) {
            return response()->json([
               'status' => false,
               'message' => 'Guest already exists'
            ]);
        }

        $token = Str::random(60);
        $filename = time() . rand(111111, 999999).'.png';

        Storage::put('public/qr/'.$filename, QrCode::format('png')->size(200)->generate(url('/guest/validate/'.$token)));
        $guest = new Guest;
        $guest->user_id = auth()->user()->id;
        $guest->full_name = $request->name;
        $guest->email = $request->email;
        $guest->phone_no = $request->phone;
        $guest->token = $token;
        $guest->qr_code = $filename;
        $guest->counter = 0;
        $guest->no_of_invite = 1;
        $guest->status = 0;
        $guest->invitation_sent = 0;
        if($guest->save())
        {
            try {
                Mail::to($request->email)->cc(auth()->user()->email)->send(new SendGuestInvite($guest));
                $guest->invitation_sent = 1;
                $guest->update();
            }catch(\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ]);
            }
            
        }
        return response()->json([
            'status' => true,
            'message' => 'success'
        ]);

    }

    public function validateGuest($token)
    {
        $auth = Auth::user();
        if(!$auth) {
            return redirect('https://becomingthesannis23.com.ng');
        }

        $guest = Guest::where('token', $token)->first();

        if(!$guest) {
            alert()->error('Invalid QR Code.', 'Invalid')->persistent('Ok');
            return redirect(url('/')); 
        }

        if($guest->no_of_invite == $guest->counter)
        {
            alert()->error('Invite has been scanned.', 'Invalid')->persistent('Ok');
            return redirect(url('/')); 
        }
        if($guest->counter < $guest->no_of_invite)
        {
            $last_count = $guest->counter;
            $guest->counter = $last_count + 1;
            $guest->update();
            alert()->success('Valid Code! Guest Admitted', 'Success')->persistent('Ok');
            return redirect(url('/home'));
        }
    }

    public function generalInvite()
    {
        $auth = Auth::user();
        if(!$auth) {
            return redirect('https://becomingthesannis23.com.ng');
        }

        $generalGuest = new GeneralGuest;
        $generalGuest->save();

        alert()->success('Valid Code! Guest Admitted', 'Success')->persistent('Ok');
        return redirect(url('/home'));
    }

    public function resendInvite($id)
    {
        $guest = Guest::find($id);
        if(!$guest) {
            alert()->error('Guest not found')->persistent('Ok');
            return back();
        }
        try {
            Mail::to($guest->email)->cc(auth()->user()->email)->send(new SendGuestInvite($guest));
            $guest->invitation_sent = 1;
            $guest->update();
            alert()->success('Invite sent successfully')->persistent('Ok');
            return back();
        }catch(\Exception $e) {
            alert()->error($e->getMessage())->persistent('Ok');
            return back();
        }
        
    }

    public function deleteInvite($id)
    {
        $guest = Guest::find($id);
        $guest->delete();
        return response()->json([
            'message' => 'Deleted',
            'status' => true
        ]);
    }

    public function bulkInvitation(Request $request) {
        Excel::import(new GuestList, $request->file('bulk_guest'));
        alert()->success('Invite uploaded successfully')->persistent('Ok');
        return back();
    }
}
