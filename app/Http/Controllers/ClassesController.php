<?php

namespace App\Http\Controllers;

use Square\Models\Money;
use Square\SquareClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Square\Models\CatalogItemVariation;

class ClassesController extends Controller
{
    public function index()
    {
        return view('classes');
    }

    public function store()
    {
        $client = app(SquareClient::class);
        $idempotency_key = uniqid();

        $price_money = new \Square\Models\Money();
        $price_money->setAmount(200);
        $price_money->setCurrency('AUD');

        $item_variation_data = new \Square\Models\CatalogItemVariation();
        $item_variation_data->setItemId('#danceclass');
        $item_variation_data->setName('begginer');
        $item_variation_data->setPricingType('FIXED_PRICING');
        $item_variation_data->setPriceMoney($price_money);

        $catalog_object = new \Square\Models\CatalogObject('ITEM_VARIATION', '#begginer');
        $catalog_object->setItemVariationData($item_variation_data);

        $variations = [$catalog_object];
        $item_data = new \Square\Models\CatalogItem();
        $item_data->setName('dance class');
        $item_data->setVariations($variations);
        $item_data->setProductType('REGULAR');

        $object = new \Square\Models\CatalogObject('ITEM', '#danceclass');
        $object->setItemData($item_data);

        $body = new \Square\Models\UpsertCatalogObjectRequest($idempotency_key, $object);

        $api_response = $client->getCatalogApi()->upsertCatalogObject($body);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();
            dd($result);
        } else {
            $errors = $api_response->getErrors();
            dd($errors);
        }
    }
}