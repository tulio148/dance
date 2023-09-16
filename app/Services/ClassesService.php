<?php

namespace App\Services;

use RRule\RRule;
use App\Models\Classes;
use Square\Models\Money;
use Square\SquareClient;
use Square\Models\CatalogItem;
use Square\Models\CatalogObject;
use Square\Models\CatalogTimePeriod;
use Square\Models\CatalogItemVariation;
use Square\Models\CatalogItemOptionForItem;
use Square\Models\CatalogItemOptionValueForItemVariation;
use Square\Models\UpsertCatalogObjectRequest;


class ClassesService
{
    public function store($request)
    {
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $level = $request->level;
        $instructor = $request->instructor;
        $enrollment_mode = $request->enrollment_mode;
        $location = $request->location;
        $price = $request->price;
        $image = $request->image;
        $duration = $request->duration;
        $datetime = $request->datetime;
        $square_datetime = new RRule([
            'FREQ' => 'YEARLY',
            'DTSTART' => $datetime,
            'COUNT' => 1
        ]);

        $capacity = $request->capacity;
        $status = $request->status;

        if ($category == "samba") {
            $category_id = "OB5TM7ROA7PQNQFP5IK26QRJ";
        }

        $level_id = "BCBVPJAEHUHOOGNLTFIVRIND";

        if ($level == "beginner") {
            $level_value_id = "OBOQYIEYBJU4ZGIGDH6E7746";
        } else {
            $level_value_id = "S7M3TZNQ2UMWWS3EFUYNJF3J";
        }

        $enrollment_mode_id = "AOCHMQYDJTS57ZVIU7XZ4ITC";

        if ($enrollment_mode == "single") {
            $enrollment_mode_value_id = "7B6AMXMCQZANHHOMWUZ7DT3X";
        } else {
            $enrollment_mode_value_id = "QTTBGTGLINEZKN73LUMD7EX7";
        }


        $client = app(SquareClient::class);
        $idempotency_key = uniqid();

        $price_money = new Money();
        $price_money->setAmount($price * 100);
        $price_money->setCurrency('AUD');

        $choose_level = new \Square\Models\CatalogItemOptionValueForItemVariation();
        $choose_level->setItemOptionId($level_id);
        $choose_level->setItemOptionValueId($level_value_id);

        $choose_enrollment_mode = new CatalogItemOptionValueForItemVariation();
        $choose_enrollment_mode->setItemOptionId($enrollment_mode_id);
        $choose_enrollment_mode->setItemOptionValueId($enrollment_mode_value_id);

        $options = [$choose_level, $choose_enrollment_mode];

        $class_specs = new CatalogItemVariation();
        $class_specs->setItemId('#samba_class');
        $class_specs->setName($name);
        $class_specs->setPricingType('FIXED_PRICING');
        $class_specs->setPriceMoney($price_money);
        $class_specs->setItemOptionValues($options);

        $square_datetime_converted = new CatalogTimePeriod();
        $square_datetime_converted->setEvent($square_datetime->rfcString());

        $new_class = new CatalogObject('ITEM_VARIATION', '#' . $name);
        $new_class->setItemVariationData($class_specs);
        $new_class->setTimePeriodData($square_datetime_converted);

        $variations = [$new_class];

        $set_level = new CatalogItemOptionForItem();
        $set_level->setItemOptionId($level_id);

        $set_enrollment_mode = new CatalogItemOptionForItem();
        $set_enrollment_mode->setItemOptionId($enrollment_mode_id);

        $class_options = [$set_level, $set_enrollment_mode];
        $item_data = new CatalogItem();
        $item_data->setName($category . '_class');
        $item_data->setCategoryId($category_id);
        $item_data->setVariations($variations);
        $item_data->setProductType('REGULAR');
        $item_data->setItemOptions($class_options);
        $item_data->setDescriptionHtml($description);



        $object = new CatalogObject("ITEM", "#" . $category . '_class');
        $object->setItemData($item_data);

        $body = new UpsertCatalogObjectRequest($idempotency_key, $object);

        $api_response = $client->getCatalogApi()->upsertCatalogObject($body);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();
            $id = $result->getCatalogObject()->getItemData()->getVariations()[0]->getId();


            Classes::create([
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'style' => $category,
                'level' => $level,
                'instructor' => $instructor,
                'enrollment_mode' => $enrollment_mode,
                'location' => $location,
                'price' => $price,
                'datetime' => $datetime
            ]);
        } else {
            $errors = $api_response->getErrors();
            dd($errors);
        }
    }
}
