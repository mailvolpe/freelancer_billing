<?php

class MY_Loader extends CI_Loader {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns true if the model with the given name is loaded; false otherwise.
     *
     * @param   string  name for the model
     * @return  bool
     */
    public function is_model_loaded($name) 
    {
        return in_array($name, $this->_ci_models, TRUE);
    }
}