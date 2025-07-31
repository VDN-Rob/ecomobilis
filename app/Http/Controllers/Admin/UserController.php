<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarpoolCar;
use App\Models\CarpoolLuggage;
use App\Models\CarpoolCarType;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function profileEdit()
    {
        $data['user']           = Auth::user();
        $data['carTypes']       = CarpoolCarType::all();
        $data['carLuggages']    = CarpoolLuggage::all();
        $data['minDate'] = Carbon::today()->subYears(18)->toDateString();

        return view('admin.user.profile-edit', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user           = Auth::user();

        // the data
        $dataCar = [
            'car_type_id'              => $request->car_type_id,
            'brand'                    => $request->brand,
            'description'              => $request->description,
            'default_luggage_id'       => $request->default_luggage_id,
            'default_seats_available'  => $request->default_seats_available,
            'is_smoking_allowed'       => ($request->get('is_smoking_allowed') == 'on') ? 1 : 0,
            'is_isofix_present'        => ($request->get('is_isofix_present') == 'on') ? 1 : 0,
            'price_per_km_per_seat'    => $request->price_per_km_per_seat
        ];

        $dataUser = [
            'firstname'         => $request->firstname,
            'lastname'          => $request->lastname,
            'gender'            => $request->gender,
            'bio'               => $request->bio,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'birth_date'        => $request->birth_date
        ];

        // saving actions
        if (empty($user->car_id) && !empty($dataCar['brand'])) {
            // no car yet added before but interface contains the info
            $carpoolId = CarpoolCar::create($dataCar)->id;
            $dataUser['car_id'] = $carpoolId;
            $user->update($dataUser);
        } elseif (empty($user->car_id) && empty($dataCar['brand'])){
            // no car yet added before but interface contains no info, so just update the user
            $user->update($dataUser);
        } else {
            // it's an update of both user and car info
            $user->update($dataUser);
            $user->car->update($dataCar);
        }

        return \Redirect::route('web.profileShow', [$user->id])->with('message', 'Les données ont été mises à jour');

    }

    public function profileDelete()
    {
        $data['user']           = Auth::user();
        return view('admin.user.delete', $data);
    }

    public function profileDestroy()
    {
        $user           = Auth::user();

        // remove data
        $dataUser = [
            'firstname'         => '',
            'lastname'          => 'Profil supprimé',
            'gender'            => NULL,
            'bio'               => NULL,
            'email'             => NULL,
            'phone_number'      => NULL,
            'birth_date'        => NULL
        ];
        $user->update($dataUser);

        // delete car
        $user->car->delete();

        Auth::logout();
        return redirect('/');
    }

}
