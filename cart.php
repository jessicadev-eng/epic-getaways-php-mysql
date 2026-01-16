<?php

class Package {

    var $package_id;
    var $package_name;
    var $package_desc;
    var $price;
    var $image_name;
    var $qty;
	
    function get_package_cost() {
        return $this->price;
    }
	
    function __construct($package_id, $package_name, $package_desc, $price, $image_name,  $qty = 1) {
        $this->package_id = $package_id;
        $this->package_name = $package_name;
        $this->package_desc = $package_desc;
        $this->price = $price;
        $this->image_name = $image_name;
        $this->qty = $qty;
    }

    function get_package_id() {
        return $this->package_id;
    }

    function get_package_name() {
        return $this->package_name;
    }

    function get_package_desc() {
        return $this->package_desc;
    }

    function get_price() {
        return $this->qty * $this->price;
    }
    function get_image_name() {
        return $this->image_name;
    }

    function get_qty() {
    return $this->qty;
    }

    function set_qty($qty) {
        $this->qty = $qty;
    }
}

class Cart {

    var $packages;
    var $depth;

    function __construct() {
        $this->packages = array();
        $this->depth = 0;
    }

    function add_package($package) {
        foreach ($this->packages as $index => $existing) {
        if ($existing->get_package_id() == $package->get_package_id()) {
            $new_qty = $existing->get_qty() + $package->get_qty();
            $existing->set_qty($new_qty);
            return;
        }
    }

    $this->packages[$this->depth] = $package;
    $this->depth++;
    }

    function delete_package($package_no) {
        unset($this->packages[$package_no]);
		$this->packages = array_values($this->packages);
		$this->depth--;
    }

    function get_depth() {
        return $this->depth;
    }

    function get_package($package_no) 
    {
        return $this->packages[$package_no];
    }
    function update_qty($package_id, $qty) 
    {
        foreach ($this->packages as $existing) 
        {
            if ($existing->get_package_id() == $package_id) 
            {
                $existing->set_qty($existing->get_qty() + $qty);
                return;
            }
        }
    }
}

?>
