<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\District;
use App\Models\Division;
use App\Models\SubArea;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{

    public function index() {

        return "Home";

        $country = Countries::with([
            'divisions', 'divisions.districts', 'divisions.districts.thanas', 'divisions.districts.thanas.sub_area',
        ])->get();
        return $country[0];

        /*
        $division = Division::with([
            'country_info', 'districts'
        ])->orderBy('id', 'DESC')->get();
        */

        /*
        $district = District::with([
            'division_info', 'thanas'
        ])->get();
        return $district[0]['division_info'];
        */
        

        /*
        $thana = Thana::with([
            'district_info', 'sub_area'
        ])->get();
        return $thana[0]['sub_area'];
        */

        /*
        $thana = SubArea::with([
            'thana_info'
        ])->get();
        return $thana[0];
        */


        /*
        //return phpinfo();
        $division_id = 8;

        ini_set('max_execution_time', 300);

        // division id: 1 = Dhaka = 3, 

        $thana = SubArea::orderBy('id', 'ASC')->get();

        // Iterate over each district
        foreach ($thana as $t) {
            $name = $t->name;
            $bn_name = $t->bn_name;
            $isActive = $t->is_active;

            echo "["
                . '"_id" => ' . $t->super_id . ', '
                . '"super_id" => ' . $t->super_id . ', '
                . '"district_id" => ' . $t->district_id . ', '
                . '"thana_id" => ' . $t->thana_id . ', '
                . '"name" => "' . $name . '", '
                . '"bn_name" => "' . $bn_name . '", '
                . '"is_active" => ' . $isActive
                . "],<br>";
        }
        
        */
        
        /*
        // Fetch districts from the API
        $get_district_from_division = Http::get('https://www.thetolet.com/bd/ajax-divtodis', [
            'division_id' => $division_id
        ]);
    
        if ($get_district_from_division->successful()) {
            foreach ($get_district_from_division->json() as $item) {
                $p_discrictsuper_id = $item['id'];
                $p_discrict_name = $item['name'];

                // Create or update district
                $district = District::updateOrCreate(
                    ['country_id' => 1, 'division_id' => 8, 'name' => $p_discrict_name,  'dummysuper_id' => $p_discrictsuper_id]
                );
    
                
                // Fetch areas from the API
                $get_area_from_district = Http::get('https://www.thetolet.com/bd/ajax-distoarea', [
                    'district_id' => $p_discrictsuper_id
                ]);
    

                
                if ($get_area_from_district->successful()) {
                    foreach ($get_area_from_district->json() as $area) {
                        $a_areasuper_id = $area['id'];
                        $a_area_name = $area['name'];
    
                       // Create or update area
                       $thana = Thana::updateOrCreate(
                            ['division_id' => $division_id, 'district_id' => $p_discrictsuper_id, 'name' => $a_area_name]
                        );
    
                        
                        // Fetch sub-areas from the API
                        $get_sub_area_from_area = Http::get('https://www.thetolet.com/bd/ajax-areatosubarea', [
                            'areasuper_id' => $a_areasuper_id
                        ]);
    
                        if ($get_sub_area_from_area->successful()) {
                            foreach ($get_sub_area_from_area->json() as $sub_area) {
                                $s_areasuper_id = $sub_area['id'];
                                $s_area_name = $sub_area['name'];
    
                                // Create or update sub-area
                                SubArea::updateOrCreate(
                                    ['thana_id' => $thana->id, 'district_id' => $p_discrictsuper_id, 'name' => $s_area_name]
                                );
                            }
                        }
                       
                    }
                }

                
    
            }
        }
        */
    }

    

















}
