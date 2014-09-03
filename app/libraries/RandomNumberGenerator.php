<?php

	class RandomNumberGenerator {

		//code taken from: http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
		public static function generateRandomString($length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
			$string = '';
		    for ($p = 0; $p < $length; $p++) {
		        $string .= $characters[mt_rand(0, strlen($characters) -1)];
		    }
		    return $string;
		}

	
	}