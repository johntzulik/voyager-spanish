<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
class ChineseTableSeeder extends Seeder
{
    public function run(){
        $menu = Menu::firstOrNew([
            'name'   => 'admin-es_MX',
        ]);
        if($menu->exists){
            return null;
        }
        DB::table('menus')->insert(['name'=>'admin-es_MX']);
        $menu_id = DB::getPdo()->lastInsertId();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Tablero'),
            'url'     => '',
            'route'   => 'voyager.dashboard',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-boat',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Administración de medios'),
            'url'     => '',
            'route'   => 'voyager.media.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-images',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 5,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Gestión de usuarios'),
            'url'     => '',
            'route'   => 'voyager.users.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Gestión de autoridad'),
            'url'     => '',
            'route'   => 'voyager.roles.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-lock',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }
        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu_id,
        //     'title'   => __('artículo'),
        //     'url'     => '',
        //     'route'   => 'voyager.posts.index',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-news',
        //         'color'      => null,
        //         'parent_id'  => null,
        //         'order'      => 2,
        //     ])->save();
        // }
        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu_id,
        //     'title'   => __('página'),
        //     'url'     => '',
        //     'route'   => 'voyager.pages.index',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-file-text',
        //         'color'      => null,
        //         'parent_id'  => null,
        //         'order'      => 2,
        //     ])->save();
        // }
        // $menuItem = MenuItem::firstOrNew([
        //     'menu_id' => $menu_id,
        //     'title'   => __('分类'),
        //     'url'     => '',
        //     'route'   => 'voyager.categories.index',
        // ]);
        // if (!$menuItem->exists) {
        //     $menuItem->fill([
        //         'target'     => '_self',
        //         'icon_class' => 'voyager-categories',
        //         'color'      => null,
        //         'parent_id'  => null,
        //         'order'      => 2,
        //     ])->save();
        // }

        $toolsMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('herramienta'),
            'url'     => '',
        ]);
        if (!$toolsMenuItem->exists) {
            $toolsMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-tools',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 9,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Gestión de menú'),
            'url'     => '',
            'route'   => 'voyager.menus.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-list',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 10,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Gestión de base de datos '),
            'url'     => '',
            'route'   => 'voyager.database.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-data',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 11,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('información de ayuda '),
            'url'     => '',
            'route'   => 'voyager.compass.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-compass',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 12,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('BREAD'),
            'url'     => '',
            'route'   => 'voyager.bread.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-bread',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 13,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Enganchar'),
            'url'     => '',
            'route'   => 'voyager.hooks',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-hook',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 13,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu_id,
            'title'   => __('Configurar'),
            'url'     => '',
            'route'   => 'voyager.settings.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-settings',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 14,
            ])->save();
        }
    }
}
