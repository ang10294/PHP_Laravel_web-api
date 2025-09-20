<?php

namespace App\Console\Commands;
use App\Services\ApiService;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Income;
use Illuminate\Console\Command;

class SyncApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:api';
    protected $description = 'Sync data from API to database';

    public function handle()
    {
        $service = app(ApiService::class);
        $page = 1;
        do {
            $data = $service->getSales('2025-09-01', '2025-09-17', $page);
            foreach ($data['data'] as $item) {
                Sale::updateOrCreate(
                    ['sale_id' => $item['sale_id']],
                    [
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
                    ]
                );
            }
            $page++;

        } while (!empty($data['data']));


        $page = 1;
        do {
            $data = $service->getOrders('2025-09-01', '2025-09-17', $page);
            foreach ($data['data'] as $item) {
                Order::updateOrCreate(
                    ['g_number' => $item['g_number']],
                    [
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
                    ]
                );
            }
            $page++;
        } while (!empty($data['data']));



        $page = 1;
        $date = '2025-09-18';
        do {
            $data = $service->getStocks($date, $page);
            foreach ($data['data'] as $item) {
                Stock::updateOrCreate(
                    ['barcode' => $item['barcode']],
                    [
                        'date' => $item['date'],
                        'last_change_date' => $item['last_change_date'],
                        'supplier_article' => $item['supplier_article'],
                        'tech_size' => $item['tech_size'],
                        'quantity' => $item['quantity'],
                        'is_supply' => $item['is_supply'],
                        'is_realization' => $item['is_realization'],
                        'quantity_full' => $item['quantity_full'],
                        'in_way_to_client' => $item['in_way_to_client'],
                        'in_way_from_client' => $item['in_way_from_client'],
                        'nm_id' => $item['nm_id'],
                        'subject' => $item['subject'],
                        'category' => $item['category'],
                        'brand' => $item['brand'],
                        'sc_code' => $item['sc_code'],
                        'price' => $item['price'],
                        'discount' => $item['discount']
                    ]
                );
            }
            $page++;
        } while (!empty($data['data']));


        $page = 1;
        do {
            $data = $service->getIncomes('2025-09-01', '2025-09-19', $page);
            foreach ($data['data'] as $item) {
                Income::updateOrCreate(
                    ['income_id' => $item['income_id']],
                    [
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
                        'nm_id' => $item['nm_id']
                    ]
                );
            }
            $page++;
        } while (!empty($data['data']));

        $this->info('Data synced successfully!');

    }
}
