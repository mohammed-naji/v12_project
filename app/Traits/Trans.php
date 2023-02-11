<?php

namespace App\Traits;

trait Trans {

    public function getTransNameAttribute() {
        $name = json_decode($this->name, true);

        if(is_null($name)) {
            return $this->name;
        }

        return $name[app()->getLocale()];
    }

    public function getEnNameAttribute() {
        $name = json_decode($this->name, true);

        if(is_null($name)) {
            return $this->name;
        }

        return $name['en'];
    }

    public function getArNameAttribute() {
        $name = json_decode($this->name, true);

        if(is_null($name)) {
            return $this->name;
        }

        return $name['ar'];
    }
}
