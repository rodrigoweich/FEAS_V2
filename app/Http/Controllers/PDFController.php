<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Rule;
use App\City;
use App\State;
use App\Cable;
use App\ServiceBox;
use App\Customer;
use App\Process;
use App\Address;
use DB;
use PDF;

class PDFController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function generateUserReport() {
        $response = User::all();
        return PDF::loadview('relatorios_pdfs/users', compact('response'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateRoleReport() {
        $rules = DB::table("role_rule")->get();
        $response = Role::all();
        return PDF::loadview('relatorios_pdfs/roles', compact('response', 'rules'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateRuleReport() {
        $response = Rule::all();
        return PDF::loadview('relatorios_pdfs/rules', compact('response'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateCitiesReport() {
        $response = City::all();
        return PDF::loadview('relatorios_pdfs/cities', compact('response'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateStatesReport() {
        $response = State::all();
        return PDF::loadview('relatorios_pdfs/states', compact('response'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateCablesReport() {
        $response = Cable::all();
        return PDF::loadview('relatorios_pdfs/cables', compact('response'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateBoxesReport(Request $request) {
        if($request->city == 0) {
            $response = ServiceBox::all();
        } else {
            $response = ServiceBox::where('cities_id', $request->city)->get();
        }
        $cities = City::all();
        $customers = Customer::all();
        return PDF::loadview('relatorios_pdfs/boxes', compact('response', 'cities', 'customers'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateProcessesReport(Request $request) {
        $stage = $request->stage;
        $date_begin = str_replace('\/', '-', explode(' - ', $request->date))[0];
        $date_begin = explode("/", $date_begin);
        $date_begin = $date_begin[2]."-".$date_begin[1]."-".$date_begin[0];
        $date_end = str_replace('\/', '-', explode(' - ', $request->date))[1];
        $date_end = explode("/", $date_end);
        $date_end = $date_end[2]."-".$date_end[1]."-".$date_end[0];

        $option_id = $request->option_id;
        $option_customer = $request->option_customer;
        $option_icon = $request->option_icon;
        $option_city = $request->option_city;
        $option_started_by = $request->option_started_by;
        $option_started_in = $request->option_started_in;
        $option_tech = $request->option_tech;
        $option_stage = $request->option_stage;
        $option_meters_ap = $request->option_meters_ap;
        $option_meters_real = $request->option_meters_real;
        $option_cable = $request->option_cable;
        $option_finished_by = $request->option_finished_by;
        $option_notifications = $request->option_notifications;
        $options_difference_meters = $request->options_difference_meters;

        if($stage == "all") {
            if($request->trash == "yes") {
                $response = Process::whereBetween(DB::raw('DATE(created_at)'), [$date_begin, $date_end])->withTrashed()->get();
            } else {
                $response = Process::whereBetween(DB::raw('DATE(created_at)'), [$date_begin, $date_end])->get();
            }
        } else {
            if($request->trash == "yes") {
                $response = Process::where('stage', '=', $stage)->whereBetween(DB::raw('DATE(created_at)'), [$date_begin, $date_end])->withTrashed()->get();
            } else {
                $response = Process::where('stage', '=', $stage)->whereBetween(DB::raw('DATE(created_at)'), [$date_begin, $date_end])->get();
            }
        }

        $city = City::all();
        $user = User::all();
        $customer = Customer::all();
        $address = Address::all();
        $cables = Cable::all();
        
        return PDF::loadview('relatorios_pdfs/processes', 
        compact('response',
        'city',
        'user',
        'customer',
        'address',
        'cables',
        'option_id',
        'option_customer',
        'option_icon',
        'option_city',
        'option_started_by',
        'option_started_in',
        'option_tech',
        'option_stage',
        'option_meters_ap',
        'option_meters_real',
        'option_cable',
        'option_finished_by',
        'option_notifications',
        'options_difference_meters'))
        ->setPaper('a4', $request->page_mode)->download(date('dmYHisu').'.pdf');
    }
    
    public function generateCustomersByBoxReport(Request $request) {
        $box = ServiceBox::find($request->box_id);
        $city = City::all();
        $response = DB::table('customers')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->where('customers.service_boxes_id', '=', $request->box_id)
        ->get();
        //$response = Customer::where('service_boxes_id', $request->box_id)->get();
        return PDF::loadview('relatorios_pdfs/customersbybox', compact('response', 'box', 'city'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateFootageComparasionReport(Request $request) {
        $date_begin = str_replace('\/', '-', explode(' - ', $request->date))[0];
        $date_begin = explode("/", $date_begin);
        $date_begin = $date_begin[2]."-".$date_begin[1]."-".$date_begin[0];
        $date_end = str_replace('\/', '-', explode(' - ', $request->date))[1];
        $date_end = explode("/", $date_end);
        $date_end = $date_end[2]."-".$date_end[1]."-".$date_end[0];

        $date_begin_request = str_replace('\/', '-', explode(' - ', $request->date))[0];
        $date_end_request = str_replace('\/', '-', explode(' - ', $request->date))[1];

        $cidade = $request->city;
        $tecnico = $request->tech;
        $cabo = $request->cable;

        if($cidade && $tecnico && $cabo) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('cities.id', '=', $cidade)
            ->where('processes.responsible_id', '=', $tecnico)
            ->where('processes.cables_id', '=', $cabo)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } elseif($cidade && $tecnico) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('cities.id', '=', $cidade)
            ->where('processes.responsible_id', '=', $tecnico)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } elseif($cidade && $cabo) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('cities.id', '=', $cidade)
            ->where('processes.cables_id', '=', $cabo)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } elseif($tecnico && $cabo) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('processes.responsible_id', '=', $tecnico)
            ->where('processes.cables_id', '=', $cabo)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } elseif($cidade) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('cities.id', '=', $cidade)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } elseif($tecnico) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('processes.responsible_id', '=', $tecnico)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } elseif($cabo) {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('processes.cables_id', '=', $cabo)
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        } else {
            $response = DB::table('processes')
            ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->whereNotNull('processes.meters')
            ->whereNotNull('processes.real_meters')
            ->whereBetween(DB::raw('DATE(processes.created_at)'), [$date_begin, $date_end])
            ->select('processes.id as pid', 'processes.customers_id as pcid', 'processes.responsible_id', 'processes.created_at as pcat', 'processes.meters as pmet', 'processes.real_meters as prmet', 'cities.name as acid')
            ->get();
        }

        $customer = Customer::all();
        $city = City::all();
        $user = User::all();
        $cables = Cable::all();
        $city_id = $request->city;
        
        return PDF::loadview('relatorios_pdfs/footage', compact('response', 'date_begin_request', 'date_end_request', 'customer', 'city', 'city_id', 'user', 'cabo', 'tecnico', 'cables'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateOccupationReport() {
        $response = ServiceBox::select('cities_id', DB::raw('count(id) as b'), DB::raw('sum(amount) as ca'), DB::raw('sum(busy) as cb'))->groupBy('cities_id')->get();
        $city = City::all();
        return PDF::loadview('relatorios_pdfs/occupation', compact('response', 'city'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }

    public function generateCustomersReport(Request $request) {
        $city = $request->city;
        $icon = $request->icon;
        if($city && $icon) {
            $response = DB::table('customers')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('customers.m_icon', '=', $request->icon)
            ->where('cities.id', '=', $request->city)->get();
        } elseif($icon) {
            $response = DB::table('customers')
            ->where('customers.m_icon', '=', $request->icon)->get();
        } elseif($city) {
            $response = DB::table('customers')
            ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
            ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
            ->where('cities.id', '=', $request->city)->get();
        } else {
            $response = Customer::all();
        }

        $addresses = Address::all();
        $cities = City::all();
        return PDF::loadview('relatorios_pdfs/customers', compact('response', 'city', 'icon', 'cities', 'addresses'))->setPaper('a4', 'portrait')->download(date('dmYHisu').'.pdf');
    }
}
