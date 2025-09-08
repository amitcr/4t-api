<?php
namespace App\Services;

if (!class_exists('PasswordHashService')) {
    /**
     * Portable PHP password hashing framework (from WordPress core).
     */
    class PasswordHashService {
        var $itoa64;
        var $iteration_count_log2;
        var $portable_hashes;
        var $random_state;

        public function __construct($iteration_count_log2, $portable_hashes) {
            $this->itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $this->iteration_count_log2 = $iteration_count_log2;
            $this->portable_hashes = $portable_hashes;
            $this->random_state = microtime() . getmypid();
        }

        private function encode64($input, $count) {
            $output = '';
            $i = 0;
            do {
                $value = ord($input[$i++]);
                $output .= $this->itoa64[$value & 0x3f];
                if ($i < $count)
                    $value |= ord($input[$i]) << 8;
                $output .= $this->itoa64[($value >> 6) & 0x3f];
                if ($i++ >= $count)
                    break;
                if ($i < $count)
                    $value |= ord($input[$i]) << 16;
                $output .= $this->itoa64[($value >> 12) & 0x3f];
                if ($i++ >= $count)
                    break;
                $output .= $this->itoa64[($value >> 18) & 0x3f];
            } while ($i < $count);
            return $output;
        }

        private function gensalt_private($input) {
            $output = '$P$';
            $output .= $this->itoa64[min($this->iteration_count_log2 + 5, 30)];
            $output .= $this->encode64($input, 6);
            return $output;
        }

        private function crypt_private($password, $setting) {
            $output = '*0';
            if (substr($setting, 0, 2) === '*0') $output = '*1';

            $id = substr($setting, 0, 3);
            if ($id !== '$P$' && $id !== '$H$')
                return $output;

            $count_log2 = strpos($this->itoa64, $setting[3]);
            if ($count_log2 < 7 || $count_log2 > 30)
                return $output;

            $count = 1 << $count_log2;
            $salt = substr($setting, 4, 8);
            if (strlen($salt) !== 8)
                return $output;

            $hash = md5($salt . $password, TRUE);
            do {
                $hash = md5($hash . $password, TRUE);
            } while (--$count);

            $output = substr($setting, 0, 12);
            $output .= $this->encode64($hash, 16);

            return $output;
        }

        public function checkPassword($password, $stored_hash) {
            $hash = $this->crypt_private($password, $stored_hash);
            return $hash === $stored_hash;
        }

        public function hashPassword($password) {
            $random = '';
            for ($i = 0; $i < 6; $i++) {
                $random .= chr(mt_rand(0, 255));
            }
            $salt = $this->gensalt_private($random);
            return $this->crypt_private($password, $salt);
        }
    }
}
