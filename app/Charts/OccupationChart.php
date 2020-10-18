<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\City;
use App\ServiceBox;
use DB;

class OccupationChart extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'occupationchart';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'occupationchart';

    /**
     * Determines the prefix that will be used by the chart
     * endpoint.
     */
    public ?string $prefix = 'default/reports';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $cities = City::orderBy('id')->pluck('name');
        $response = DB::table('service_boxes')
        ->leftjoin('cities', 'service_boxes.cities_id', '=', 'cities.id')
        ->select('cities.name', DB::raw('sum(amount) as amount'), DB::raw('sum(busy) as busy'))->groupBy('cities.name')->get();
        $build = Chartisan::build();
        $array = [];
        foreach($response as $r) {
            $array[$r->name] = ['amount' => $r->amount, 'busy' => $r->busy];
        }
        $labels = [];
        $val_amount = [];
        $val_busy = [];
        foreach($array as $key => $a) {
            array_push($labels, $key);
            array_push($val_amount, intval($a['amount']) - intval($a['busy']));
            array_push($val_busy, intval($a['busy']));
        }
        $build->labels($labels);
        $build->dataset('Livres', $val_amount);
        $build->dataset('Ocupadas', $val_busy);
        
        return $build;
    }
}