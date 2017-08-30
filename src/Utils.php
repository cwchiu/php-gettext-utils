<?php
namespace cwchiu\gettext;

class Utils
{

    public function __construct()
    {
    }

    public static function changeDomain($domain, $locale_dir)
    {
        bindtextdomain($domain, $locale_dir);
        textdomain($domain);
    }

    public static function changeLanguage($lang = 'en_GB')
    {
        // I18N support information here
        // try out some locale options:
        // 1) For debian works @euro or .UTF8 or .UTF-8
        // 2) Mac OS X needs putenv()
        $lang = explode("_", $language);

        setlocale(LC_ALL, "");
        setlocale(LC_MESSAGES, "");

        if (setlocale(LC_ALL, $lang[0])) {
            setlocale(LC_MESSAGES, $lang[0]);
        } elseif (setlocale(LC_ALL, $language)) {
            setlocale(LC_MESSAGES, $language);
        } elseif (setlocale(LC_ALL, $language . ".iso88591")) {
            setlocale(LC_MESSAGES, $language . ".iso88591");
        } elseif (setlocale(LC_ALL, $language . "@euro")) {
            setlocale(LC_MESSAGES, $language . "@euro");
        } elseif (setlocale(LC_ALL, $language . ".UTF-8")) {
            setlocale(LC_MESSAGES, $language . ".UTF-8");
        } elseif (setlocale(LC_ALL, $language . ".UTF8")) {
            setlocale(LC_MESSAGES, $language . ".UTF8");
        } else {
            $language = "en_GB";
            setlocale(LC_ALL, $language);
            setlocale(LC_MESSAGES, $language);
        }

        putenv("LANGUAGE=" . $language);
        putenv("LANG=" . $language);

    }
}
