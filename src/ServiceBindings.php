<?php

namespace GeneralSystemsVehicle\QuickBase;

trait ServiceBindings
{
    /**
     * All of the service bindings for package.
     *
     * @var array
     */
    protected $serviceBindings = [
        Api\Apps::class,
        Api\Auth::class,
        Api\Fields::class,
        Api\FieldUsage::class,
        Api\Files::class,
        Api\Records::class,
        Api\Relationships::class,
        Api\Reports::class,
        Api\Tables::class,
    ];
}
