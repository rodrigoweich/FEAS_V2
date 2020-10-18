<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use DB;

class BoxesByCityChart extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'boxesbycitychart';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'boxesbycitychart';

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
        $response = DB::table('service_boxes')
        ->leftjoin('cities', 'service_boxes.cities_id', '=', 'cities.id')
        ->select('cities.name', DB::raw('count(service_boxes.id) as boxes'))->groupBy('cities.name')->get();
        $build = Chartisan::build();
        $array = [];
        foreach($response as $r) {
            $array[$r->name] = ['boxes' => $r->boxes];
        }
        $labels = [];
        $val_boxes = [];
        foreach($array as $key => $a) {
            array_push($labels, $key);
            array_push($val_boxes, intval($a['boxes']));
        }
        $build->labels($labels);
        $build->dataset('Caixas por cidade', $val_boxes);
        
        return $build;
    }
}