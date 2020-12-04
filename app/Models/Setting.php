<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static function get(string $key)
    {
        if ($record = self::find($key)) {
            return $record->value;
        }
        return null;
    }

    public static function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                self::set($k, $v);
            }
        }
    }

    public function setValueAttribute($value): void
    {
        $this->attributes['value'] = serialize($value);
    }

    public function getValueAttribute($value)
    {
        return unserialize($value);
    }
}
