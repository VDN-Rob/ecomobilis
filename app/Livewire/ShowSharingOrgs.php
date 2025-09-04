<?php

namespace App\Livewire;

use App\Models\SharingOrg;
use Livewire\Component;

class ShowSharingOrgs extends Component
{

    public $typeFilter = 'all';

    public function render()
    {
        $data['orgs'] = SharingOrg::all();

        if ($this->typeFilter == 'all') {
            $data['orgs'] = SharingOrg::all();
        }

        if ($this->typeFilter == 'car') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_car', 1)->get();
        }
        if ($this->typeFilter == 'ecar') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_ecar', 1)->get();
        }
        if ($this->typeFilter == 'bike') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_bike', 1)->get();
        }
        if ($this->typeFilter == 'ebike') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_ebike', 1)->get();
        }
        if ($this->typeFilter == 'cargobike') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_cargobike', 1)->get();
        }
        if ($this->typeFilter == 'ecargobike') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_ecargobike', 1)->get();
        }
        if ($this->typeFilter == 'step') {
            $data['orgs'] = SharingOrg::where('prop_vehicle_step', 1)->get();
        }


        return view('livewire.show-sharing-orgs', $data);
    }
}
