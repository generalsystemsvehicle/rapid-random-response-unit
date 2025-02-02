<?php

namespace GeneralSystemsVehicle\QuickBase\Tests\Unit;

use GeneralSystemsVehicle\QuickBase\Tests\Stubs\StubbedContract;
use GeneralSystemsVehicle\QuickBase\Tests\Stubs\StubbedEvent;
use GeneralSystemsVehicle\QuickBase\Tests\Stubs\StubbedImplementation;
use GeneralSystemsVehicle\QuickBase\Tests\Stubs\StubbedListener;
use GeneralSystemsVehicle\QuickBase\Tests\TestCase;
use GeneralSystemsVehicle\QuickBase\QuickBaseServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Events\Dispatcher;

class ServiceProviderTest extends TestCase
{
    /** @test */
    function it_sets_up_a_listener()
    {
        $dispatcher = $this->app->make(Dispatcher::class);

        $dispatcher->forget(StubbedEvent::class);

        $this->assertFalse($dispatcher->hasListeners(StubbedEvent::class));

        $provider = new QuickBaseServiceProvider($this->app);

        $this->setProperty($provider, 'events', [
            StubbedEvent::class => [
                StubbedListener::class,
            ],
        ]);

        $this->invokeMethod($provider, 'bootEvents', [ ]);

        $this->assertTrue($dispatcher->hasListeners(StubbedEvent::class));
    }

    /** @test */
    function it_cannot_bind_a_contract_without_an_implementation()
    {
        $this->expectException(BindingResolutionException::class);

        $this->app->make(StubbedContract::class);
    }

    /** @test */
    function it_binds_a_contract_to_an_implementation()
    {
        $provider = new QuickBaseServiceProvider($this->app);

        $this->setProperty($provider, 'serviceBindings', [
            StubbedContract::class => StubbedImplementation::class,
        ]);

        $this->invokeMethod($provider, 'registerServices');

        $contract = $this->app->make(StubbedContract::class);

        $this->assertTrue($contract instanceof StubbedImplementation);
    }
}
