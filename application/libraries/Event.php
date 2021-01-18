<?php

class Event
{
    /* For events */
    public static $callbacks = [];

    /* For extra content, such as javascript */
    public static $content = [];


    public static function add_content($content, $type) {

        if(isset(self::$content[$type])) {
            self::$content[$type][] = $content;
        } else {
            self::$content[$type] = [ $content ];
        }

    }


    public static function get_content($type) {

        $fullContent = '';

        if(isset(self::$content[$type])) {
            foreach (self::$content[$type] as $content) {

                $fullContent .= $content;

            }
        }

        return $fullContent;

    }
}