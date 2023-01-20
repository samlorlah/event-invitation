<?php

namespace App\Imports;

use App\Guest;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuestList implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if(Guest::where('email', '=', $row['email'])->first()) {
            return;
        }

        $token = Str::random(60);
        $filename = time() . rand(111111, 999999).'.png';
        Storage::put('public/qr/'.$filename, QrCode::format('png')->size(200)->generate(url('/guest/validate/'.$token)));

        $guest = new Guest();
        $guest->user_id = auth()->user()->id;
        $guest->full_name = $row['full_name'];
        $guest->email = $row['email'];
        $guest->phone_no = $row['phone_no'];
        $guest->token = $token;
        $guest->qr_code = $filename;
        $guest->counter = 0;
        $guest->no_of_invite = 1;
        $guest->status = 0;
        $guest->invitation_sent = 0;
        $guest->save();
        return;
    }
}
