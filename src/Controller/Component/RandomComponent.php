<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Exception\ForbiddenException;

class RandomComponent extends Component {


	/**
	* Generate a more truly "random" alpha-numeric string.
	*
	* @param  int     $length
	* @return string
	*/
    public function str_random($length) {
		if (function_exists('openssl_random_pseudo_bytes')){
			$bytes = openssl_random_pseudo_bytes($length * 2);
			if ($bytes === false) {
				throw new ForbiddenException('Unable to generate random string.');
			}
			return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
		}
		return $this->quickRandom($length);
    }


	/**
	* Generate a "random" alpha-numeric string.
	*
	* Should not be considered sufficient for cryptography, etc.
	*
	* @param  int     $length
	* @return string
	*/
	public static function quickRandom($length = 16) {
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}
}
?>