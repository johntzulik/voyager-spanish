<?php

namespace VoyagerChineseLang;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use TCG\Voyager\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use VoyagerSpanishLang\Policies\MenuPolicy;

class VoyagerSpanishLangServiceProvider extends ServiceProvider
{
   
    protected $policies = [
        Menu::class => MenuPolicy::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        app(Dispatcher::class)->listen('voyager.menu.display', function ($menu) {
            $this->convertSpanish($menu);
        });
        config(['app.locale' => 'es_MX']);
        config(['voyager.multilingual.enabled' => true]);
        config(['voyager.multilingual.default' => 'es_MX']);
        config(['voyager.multilingual.locales' => array_merge(config('voyager.multilingual.locales'), ['es_MX'])]);
    }

      /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    protected function convertSpanish(Menu  $menu)
    {
        if($menu->name == 'admin'){
            $menuName = 'admin-es_MX';
            $menu_cn = Menu::where('name', '=', $menuName)
            ->with(['parent_items.children' => function ($q) {
                $q->orderBy('order');
            }])
            ->first();
            $items = $menu_cn->parent_items->sortBy('order');
            $items = self::processItems($items);
            $menu->parent_items = $items;
        }
    }

    public static function processItems($items)
    {
        $items = $items->transform(function ($item) {
            // Translate title
            $item->title = $item->getTranslatedAttribute('title');
            // Resolve URL/Route
            $item->href = $item->link(true);

            if ($item->href == url()->current() && $item->href != '') {
                // The current URL is exactly the URL of the menu-item
                $item->active = true;
            } elseif (Str::startsWith(url()->current(), Str::finish($item->href, '/'))) {
                // The current URL is "below" the menu-item URL. For example "admin/posts/1/edit" => "admin/posts"
                $item->active = true;
            }
            if (($item->href == url('') || $item->href == route('voyager.dashboard')) && $item->children->count() > 0) {
                // Exclude sub-menus
                $item->active = false;
            } elseif ($item->href == route('voyager.dashboard') && url()->current() != route('voyager.dashboard')) {
                // Exclude dashboard
                $item->active = false;
            }

            if ($item->children->count() > 0) {
                $item->setRelation('children', static::processItems($item->children));

                if (!$item->children->where('active', true)->isEmpty()) {
                    $item->active = true;
                }
            }

            return $item;
        });

        // Filter items by permission
        $items = $items->filter(function ($item) {
            return !$item->children->isEmpty() || Auth::user()->can('browse', $item);
        })->filter(function ($item) {
            // Filter out empty menu-items
            if ($item->url == '' && $item->route == '' && $item->children->count() == 0) {
                return false;
            }

            return true;
        });

        return $items->values();
    }
}