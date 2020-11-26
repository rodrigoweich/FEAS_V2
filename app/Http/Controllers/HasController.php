<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\ServiceBox;
use App\Cable;
use App\Process;
use App\Address;
use App\Customer;
use App\User;
use App\Role;

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

    public static function hasProcessesWithThisCable($cable) {
        return Process::where('cables_id', $cable)->count();
    }

    public static function hasCustomersLinkedToBox($box) {
        return Customer::where('service_boxes_id', $box)->count();
    }

    public static function hasProcessesLinkedToTheUser($user) {
        return Process::where('users_id', $user)->count();
    }

    public static function hasUsersLinkedToTheRole($role) {
        return Role::find($role)->users()->where('role_id', Role::find($role)->id)->count();
    }

    public static function hasCitiesLinkedToTheState($state) {
        return City::where('states_id', $state)->count();
    }
}