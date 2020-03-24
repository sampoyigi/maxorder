<?php namespace SamPoyigi\MaxOrder;

use Admin\Models\Orders_model;
use Igniter\Flame\Exception\ApplicationException;
use Igniter\Local\Classes\Location;
use Illuminate\Support\Facades\Event;
use SamPoyigi\MaxOrder\Models\MaxOrderSettings;
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
            'description' => 'Allow a maximum number of orders for each delivery/pick-up timeslot',
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
        Event::listen('igniter.checkout.beforeSaveOrder', function ($order, $data) {
            $maxNoOfOrders = MaxOrderSettings::get('order_limit');
            $orderDateTime = Location::instance()->orderDateTime();

            $query = Orders_model::newQuery();
            $query->where('order_date', $orderDateTime->format('Y-m-d'))
                  ->where('order_time', $orderDateTime->format('H:i'))
                  ->whereNotNull('status_id')->where('status_id', '!=', '0');

            if ($query->count() >= $maxNoOfOrders)
                throw new ApplicationException('Maximum number of orders reached, please choose a different delivery/pick-up timeslot');
        });
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Maximum Orders Settings',
                'description' => 'Set the number of maximum orders to allow.',
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