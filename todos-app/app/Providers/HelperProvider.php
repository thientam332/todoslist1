<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    static function mb_trim1($str, $charlist = NULL, $encoding = NULL) {
        if ($encoding === NULL) {
            $encoding = mb_internal_encoding(); // Get internal encoding when not specified.
        }
        if ($charlist === NULL) {
            $charlist = "\\x{20}\\x{9}\\x{A}\\x{D}\\x{0}\\x{B}\\x{3000}"; // Standard charlist, same as trim.
        } else {
            $chars = preg_split('//u', $charlist, -1, PREG_SPLIT_NO_EMPTY); // Splits the string into an array, character by character.
            foreach ($chars as $c => &$char) {
                if (preg_match('/^\x{2E}$/u', $char) && preg_match('/^\x{2E}$/u', $chars[$c+1])) { // Check for character ranges.
                    $ch1 = hexdec(substr($chars[$c-1], 3, -1));
                    $ch2 = (int)substr(mb_encode_numericentity($chars[$c+2], [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1);
                    $chs = '';
                    for ($i = $ch1; $i <= $ch2; $i++) { // Loop through characters in Unicode order.
                        $chs .= "\\x{" . dechex($i) . "}";
                    }
                    unset($chars[$c], $chars[$c+1], $chars[$c+2]); // Unset the now pointless values.
                    $chars[$c-1] = $chs; // Set the range.
                } else {
                    $char = "\\x{" . dechex(substr(mb_encode_numericentity($char, [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1)) . "}"; // Convert the character to it's unicode codepoint in \x{##} format.
                }
            }
            $charlist = implode('', $chars); // Return the array to string type.
        }
        $pattern = '/(^[' . $charlist . ']+)|([' . $charlist . ']+$)/u'; // Define the pattern.
        return preg_replace($pattern, '', $str); // Return the trimmed value.
    }
    public function mb_trim($str)
    {
       $str = mb_ereg_replace ("　", " ", $str);
       $str = trim($str);

       return $str;
    }
}
