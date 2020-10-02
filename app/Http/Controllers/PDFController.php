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
use DB;
use PDF;

class PDFController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function generateUserReport() {
        $response = User::all();
        return PDF::loadview('relatorios_pdfs/users', compact('response'))->setPaper('a4', 'portrait')->download('usuários.pdf');
    }

    public function generateRoleReport() {
        $rules = DB::table("role_rule")->get();
        $response = Role::all();
        return PDF::loadview('relatorios_pdfs/roles', compact('response', 'rules'))->setPaper('a4', 'portrait')->download('funções.pdf');
    }

    public function generateRuleReport() {
        $response = Rule::all();
        return PDF::loadview('relatorios_pdfs/rules', compact('response'))->setPaper('a4', 'portrait')->download('regras.pdf');
    }

    public function generateCitiesReport() {
        $response = City::all();
        return PDF::loadview('relatorios_pdfs/cities', compact('response'))->setPaper('a4', 'portrait')->download('cidades.pdf');
    }

    public function generateStatesReport() {
        $response = State::all();
        return PDF::loadview('relatorios_pdfs/states', compact('response'))->setPaper('a4', 'portrait')->download('estados.pdf');
    }

    public function generateCablesReport() {
        $response = Cable::all();
        return PDF::loadview('relatorios_pdfs/cables', compact('response'))->setPaper('a4', 'portrait')->download('cabos.pdf');
    }

    public function generateBoxesReport(Request $request) {
        if($request->city == 0) {
            $response = ServiceBox::all();
        } else {
            $response = ServiceBox::where('cities_id', $request->city)->get();
        }
        $cities = City::all();
        $customers = Customer::all();
        return PDF::loadview('relatorios_pdfs/boxes', compact('response', 'cities', 'customers'))->setPaper('a4', 'portrait')->download('caixas.pdf');
    }
}