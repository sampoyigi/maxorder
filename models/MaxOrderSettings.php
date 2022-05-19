<?php namespace SamPoyigi\MaxOrder\Models;

use Igniter\Flame\Database\Model;

class MaxOrderSettings extends Model
{
    public $implement = [\Igniter\System\Actions\SettingsModel::class];

    // A unique code
    public $settingsCode = 'sampoyigi_maxorder_settings';

    // Reference to field configuration
    public $settingsFieldsConfig = 'maxordersettings';
}
