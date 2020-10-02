<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\ServiceBox;
use App\Cable;
use App\Process;
use App\Address;

class HasController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public static function hasCities() {
        if(City::all()->count() <= 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public static function hasBoxes() {
        if(ServiceBox::all()->count() != 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function hasBoxesInTheCity($city) {
        return ServiceBox::where('cities_id', $city)->count();
    }
    
    public static function hasCables() {
        if(Cable::all()->count() != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function hasProcessesLinkedToTheCity($id) {
        return City::find($id)->addresses()->count();
    }

}
