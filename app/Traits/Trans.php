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

    public function getTransDescriptionAttribute() {
        $description = json_decode($this->description, true);

        if(is_null($description)) {
            return $this->description;
        }

        return $description[app()->getLocale()];
    }

    public function getEnDescriptionAttribute() {
        $description = json_decode($this->description, true);

        if(is_null($description)) {
            return $this->description;
        }

        return $description['en'];
    }

    public function getArDescriptionAttribute() {
        $description = json_decode($this->description, true);

        if(is_null($description)) {
            return $this->description;
        }

        return $description['ar'];
    }
}
