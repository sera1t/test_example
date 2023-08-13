<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function jsonPost(Request $request){
        $host = '89.108.115.241:6969';
        $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

        if ($request->isMethod('POST')) {
            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');
            $module = $request->input('dataModule');
            
            $queryParams = [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => 1,
                'key' => $key,
                'limit' => 500,
            ];

            $url = $this->buildApiUrl($host, $module, $queryParams);
            dump($url);

            $response = Http::get($url);
            $dataFromAPI = $this->getDataFromResponse($response);

            //dd($dataFromAPI['data']);
            
            foreach ($dataFromAPI['data'] as $item) {
                    switch($module){
                        case 'income':
                            $data = [
                                'income_id' => $item['income_id'],
                                'number' => $item['number'],
                                'date' => $item['date'],
                                'last_change_date' => $item['last_change_date'],
                                'supplier_article' => $item['supplier_article'],
                                'tech_size' => $item['tech_size'],
                                'barcode' => $item['barcode'],
                                'quantity' => $item['quantity'],
                                'total_price' => $item['total_price'],
                                'date_close' => $item['date_close'],
                                'warehouse_name' => $item['warehouse_name'],
                                'nm_id' => $item['nm_id'],
                                'status' => $item['status']
                            ];
                            DB::table('incomes')->insert($data);
                            break;
                
                        case 'stocks':
                            $data = [
                                'date' => $item['date'],
                                'last_change_date' => $item['last_change_date'],
                                'supplier_article' => $item['supplier_article'],
                                'tech_size' => $item['tech_size'],
                                'barcode' => $item['barcode'],
                                'quantity' => $item['quantity'],
                                'is_supply' => $item['is_supply'],
                                'is_realization' => $item['is_realization'],
                                'quantity_full' => $item['quantity_full'],
                                'warehouse_name' => $item['warehouse_name'],
                                'in_way_to_client' => $item['in_way_to_client'],
                                'in_way_from_client' => $item['in_way_from_client'],
                                'nm_id' => $item['nm_id'],
                                'subject' => $item['subject'],
                                'category' => $item['category'],
                                'brand' => $item['brand'],
                                'sc_code' => $item['sc_code'],
                                'price' => $item['price'],
                                'discount' => $item['discount']
                            ];
                            DB::table('stocks')->insert($data);
                            break;
                
                        case 'orders':
                            $data = [
                                'g_number' => $item['g_number'],
                                'date' => $item['date'],
                                'last_change_date' => $item['last_change_date'],
                                'supplier_article' => $item['supplier_article'],
                                'tech_size' => $item['tech_size'],
                                'barcode' => $item['barcode'],
                                'total_price' => $item['total_price'],
                                'discount_percent' => $item['discount_percent'],
                                'warehouse_name' => $item['warehouse_name'],
                                'oblast' => $item['oblast'],
                                'income_id' => $item['income_id'],
                                'odid' => $item['odid'],
                                'nm_id' => $item['nm_id'],
                                'subject' => $item['subject'],
                                'category' => $item['category'],
                                'brand' => $item['brand'],
                                'is_cancel' => $item['is_cancel'],
                                'cancel_dt' => $item['cancel_dt']
                            ];
                            DB::table('orders')->insert($data);
                            break;
                
                        case 'sales':
                            $data = [
                                'g_number' => $item['g_number'],
                                'date' => $item['date'],
                                'last_change_date' => $item['last_change_date'],
                                'supplier_article' => $item['supplier_article'],
                                'tech_size' => $item['tech_size'],
                                'barcode' => $item['barcode'],
                                'total_price' => $item['total_price'],
                                'discount_percent' => $item['discount_percent'],
                                'is_supply' => $item['is_supply'],
                                'is_realization' => $item['is_realization'],
                                'promo_code_discount' => $item['promo_code_discount'],
                                'warehouse_name' => $item['warehouse_name'],
                                'country_name' => $item['country_name'],
                                'oblast_okrug_name' => $item['oblast_okrug_name'],
                                'region_name' => $item['region_name'],
                                'income_id' => $item['income_id'],
                                'sale_id' => $item['sale_id'],
                                'odid' => $item['odid'],
                                'spp' => $item['spp'],
                                'for_pay' => $item['for_pay'],
                                'finished_price' => $item['finished_price'],
                                'price_with_disc' => $item['price_with_disc'],
                                'nm_id' => $item['nm_id'],
                                'subject' => $item['subject'],
                                'category' => $item['category'],
                                'brand' => $item['brand'],
                                'is_storno' => $item['is_storno']
                            ];
                            DB::table('sales')->insert($data);
                            break;
                    }
            }
            
            return view('test', ['jsonData' => $dataFromAPI]);
        }

        return view('test');
    }

    private function buildApiUrl($host, $module, $queryParams){
        $queryString = http_build_query($queryParams);
        return "$host/api/$module?$queryString";
    }

    private function getDataFromResponse($response){
        return $response->json() ?? [];
    }

}
