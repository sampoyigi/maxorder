<?php namespace SamPoyigi\MaxOrder;

use Illuminate\Support\Facades\Event;
use System\Classes\BaseExtension;

/**
 * MaxOrder Extension Information File
 */
class Extension extends BaseExtension
{
    /**
     * Returns information about this extension.
     *
     * @return array
     */
    public function extensionMeta()
    {
        return [
            'name' => 'Maximum Orders',
            'author' => 'SamPoyigi',
            'description' => 'Allow a maximum number of orders within a specified period',
            'icon' => 'fa-plug',
            'version' => '1.0.0',
        ];
    }

    /**
     * Register method, called when the extension is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
//        $this->location->scheduleTimeslot();
        Event::listen('location.timeslot.updated', function ($location, $slot, $oldSlot) {
            
        });
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Maximum Orders Settings',
                'description' => 'Set the number of maximum orders and period it applies to.',
                'icon' => 'fa fa-cart-plus',
                'model' => 'SamPoyigi\MaxOrder\Models\MaxOrderSettings',
                'permissions' => ['SamPoyigi.MaxOrder.ManageSetting'],
            ],
        ];
    }

    /**
     * Registers any admin permissions used by this extension.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'SamPoyigi.MaxOrder.ManageSetting' => [
                'description' => 'Manage Maximum Order settings',
//                'group' => 'module',
            ],
        ];
    }
}
