<?php namespace SamPoyigi\MaxOrder\Models;

use Model;

class MaxOrderSettings extends Model
{
    public $implement = ['System\Actions\SettingsModel'];

    // A unique code
    public $settingsCode = 'sampoyigi_maxorder_settings';

    // Reference to field configuration
    public $settingsFieldsConfig = 'maxordersettings';
}
