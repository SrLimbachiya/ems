<?php

namespace components;


class SideBarMenuItems
{
    public static function getAdminItems()
    {
        $items = [];

        array_push($items,
            [
                'class' => 'submenu',
                'items' => [
                    ['label' => 'Home', 'options' => ['class' => 'menu-head']],
                    ['label' => 'Dashboard', 'url' => ['/dashboard/index']],
                    ['label' => 'All Employees', 'url' => ['/employee/index']],
                    ['label' => 'Settings', 'options' => ['class' => 'menu-head']],
                    ['label' => 'Masters', 'url' => ['/masters/index']],

                ]
            ]
        );

        return $items;
    }
}