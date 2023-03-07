<?php

namespace App\Modules\Core;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class SpecialChars
{
    public static function removeAccents($string)
    {
        $transliterator = \Transliterator::createFromRules(
            ':: Any-Latin; :: Latin-ASCII; :: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;',
            \Transliterator::FORWARD
        );

        return $transliterator->transliterate($string);
    }

    public static function onlyNumeric($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    public static function onlyString($string)
    {
        return preg_replace('/\d/', '', $string);
    }
}
