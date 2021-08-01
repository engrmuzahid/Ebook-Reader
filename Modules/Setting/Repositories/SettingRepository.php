<?php

namespace Modules\Setting\Repositories;

use ArrayAccess;
use Modules\Setting\Entities\Setting;

class SettingRepository implements ArrayAccess
{
    /**
     * Collection of all settings.
     *
     * @var \Illuminate\Support\Collection
     */
    private $settings;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Support\Collection $settings
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get all settings.
     *
     * @return array
     */
    public function all()
    {
        return $this->settings->all();
    }

    /**
     * Get setting for the given name.
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->settings->get($name) ?: $default;
    }

    /**
     * Set the given settings.
     *
     * @param array $settings
     * @return void
     */
    public function set($settings = [])
    {
        Setting::setMany($settings);
    }

    /**
     * Determine if an setting is exists.
     *
     * @param string $name
     * @return bool
     */
    public function offsetExists($name)
    {
        return $this->settings->has($name);
    }

    /**
     * Get setting for the given name.
     *
     * @param string $name
     * @return mixed
     */
    public function offsetGet($name)
    {
        return $this->get($name);
    }

    /**
     * Set a name / value setting pair.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function offsetSet($name, $value)
    {
        $this->set([$name => $value]);
    }

    /**
     * Unset a setting by the given name.
     *
     * @param string $name
     * @return \Illuminate\Support\Collection
     */
    public function offsetUnset($name)
    {
        return $this->settings->forget($name);
    }

    /**
     * Get setting for the given name.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * Set a name / value setting pair.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }
}
