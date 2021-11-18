<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\stop_transport;
use App\Http\Resources\TransportResource;
use PhpOption\None;
use PhpParser\Node\Expr\Cast\Object_;
use function Composer\Autoload\includeFile;



class RouteCalculatorController extends Controller
{
    private function direct_route(int $from_id, int $to_id, object $transport) {
        $route = [];
        $passed_location_stop = false;
        foreach ($transport->stops as $transport_stop){
            if($transport_stop->id == $from_id) $passed_location_stop = true;
            if($passed_location_stop){
                $transport_stop->color = $transport->color;
                $transport_stop->transport_name = $transport->name;
                $transport_stop->transport_type = $transport->type;
                array_push($route, $transport_stop);
                if($transport_stop->id == $to_id){
                    return $route;
                }
            }
        }
        return null;
    }

    private function route_with_transfer(int $from_id, int $to_id, object $location_transport, object $destination_transport) {
        $route = [];
        $passed_location_stop = false;
        foreach ($location_transport->stops as $location_transport_stop){
            foreach ($destination_transport->stops as $destination_transport_stop){
                if($location_transport_stop->id == $from_id) $passed_location_stop = true;
                if($passed_location_stop){
                    if($location_transport_stop->id == $destination_transport_stop->id) {
                        $result = $this->direct_route($location_transport_stop->id, $to_id, $destination_transport);
                        if ($result != null and in_array($result, $route, true) == false) {
                            $route = array_merge($route, $result);
                            return $route;
                        }
                        else {
                            $all_transports = Transport::where('id', '!=', $location_transport->id);
                            foreach($all_transports as $random_transport){
                                $result = $this->route_with_transfer($location_transport_stop->id, $to_id, $random_transport, $destination_transport);
                                if(!in_array($result, $routes, true)){
                                    array_push($routes, $result);
                                }
                            }
                        }
                    }
                    else if(in_array($location_transport_stop, $route, true) == false){
                        $location_transport_stop->color = $location_transport->color;
                        $location_transport_stop->transport_name = $location_transport->name;
                        $location_transport_stop->transport_type = $location_transport->type;
                        array_push($route, $location_transport_stop);
                    }
                }
            }
        }
        $route = null;
    }


    private function get_all_possible_transports_with_stops(object $required_stops){
        $transports = [];
        foreach (Transport::all() as $transport){
            foreach ($required_stops as $stop) {
                if($transport->id == $stop->transport_id){
                    error_log(count($transport->stops));
                    array_push($transports,$transport);
                }
            }
        }
        return $transports;
    }

    private function remove_null_from_array($arr){
        for ($x = 0; $x < count($arr); $x++){
            if($arr[$x] == null){
                unset($arr[$x]);
            }
        }
        return array_values($arr);
    }


    public function route_calculator($from_id, $to_id) {
        $swapped = false;
        if($from_id > $to_id) {
            $temp = $to_id;
            $to_id = $from_id;
            $from_id = $temp;
            $swapped = true;
        }
        $routes = [];
        $location_transports = $this->get_all_possible_transports_with_stops(stop_transport::where('stop_id', '=', $from_id)->get());
        $destination_transports = $this->get_all_possible_transports_with_stops(stop_transport::where('stop_id', '=', $to_id)->get());


        foreach ($location_transports as $location_transport){
            foreach ($destination_transports as $destination_transport){
                if($destination_transport->id == $location_transport->id){
                    $result = $this->direct_route($from_id, $to_id, $location_transport);
                    if($swapped){
                        $result = array_reverse($result);
                    }
                    array_push($routes, $result);
                }
                else{
                    $result = $this->route_with_transfer($from_id, $to_id, $location_transport, $destination_transport);
                    if($swapped and $result){
                        $result = array_reverse($result);
                    }
                    if(!in_array($result, $routes, true)){
                        array_push($routes, $result);
                    }

                }

            }
        }
        $routes = $this->remove_null_from_array($routes);
        return response()->json($routes);
    }

}

