<?php

class Form
{
    public function validate_email($email)
    {
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    		return true;
    	}
    	return false;
	
	}
    public function confirm_equality($str1, $str2)
    {
    	if (strcmp($str1, $str2) === 0) {
    		return true;
    	}
    	return false;
    }
    
    public function check_length($input, $length)
    {
    	if (mb_strlen($input) >= $length) {
    		return true;
    	}
    	return false;
    }
        
    public function sanitize($input)
    {
    	$input = htmlentities($input);
    	//$input = PDO::quote($input);
    	return $input;
    }
        
    public function capitalize_first($input)
    {
    	return ucfirst($input); 
    }
        
    public function check_type($input)
    {
        if (in_array($input, array("normal", "facebook", "google") )) {
            return true;
        }
        return false;
    }
}