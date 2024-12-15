<?php

namespace components;

class IconHelper
{

    public static function userIcon() {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64" fill="white">
                  <!-- Circle for head -->
                  <circle cx="32" cy="20" r="12" />
                  <!-- Ellipse for body -->
                  <ellipse cx="32" cy="48" rx="20" ry="12" />
                </svg>
                ';
    }

}