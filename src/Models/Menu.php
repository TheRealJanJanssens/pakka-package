<?php

namespace TheRealJanJanssens\Pakka\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Session;

class Menu extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name' => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'name' => 'required',
        ]);
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Gets all the menus in a link array
    |
    | This is used in the layout editor to display the menus in the select menus options
    | Outputs [id => name ,...]
    |------------------------------------------------------------------------------------
    */
    
    public static function getMenuLinks()
    {
        $pages = Menu::select([
            'menus.id',
            'menus.name',
        ])
        ->orderBy('menus.id')
        ->get()->toArray();
        
        if (! empty($pages)) {
            foreach ($pages as $page) {
                $result[$page["id"]] = $page['name'];
            }
        } else {
            $result = [];
        }
        
        return $result;
    }
    
    public static function getMenuOrFirst($id = null)
    {
        if (empty($id)) {
            $query = Cache::remember('menus.first-menu', 60 * 60 * 24, function () {
                return Menu::select('menus.id')->where('id', '!=', 1)->first();
            });
            $id = $query->id;
        } else {
            $id;
        }

        return Session::get('menus')[$id];
    }

    /*
    |--------------------------------------------------------------------------
    | Constructs Menus
    |--------------------------------------------------------------------------
    |
    | Constructs a menu with all its subitems.
    |
    | $id is the id of the menu that you want to be constructed.
    |
    */
    public static function constructMenu($id = null)
    {
        $defaultLocale = env('APP_LOCALE');
        $currentAuth = 0; //Default auth role to 0 if not set. It isn't set when 'php artisan route:list' and throws a 'Trying to get property of non-object' error because the value is NULL
        if (! empty(auth()->user()->role)) {
            $currentAuth = auth()->user()->role;
        }
        
        if ($id !== null) {
            $menus = Menu::where('id', $id)->get()->toArray();
        } else {
            $menus = Menu::get()->toArray();
        }
        
        //Constructs AdminMenu when not in database
        if (empty($menus)) {        
            Menu::create([
                'id' => 1,
                'name' => 'Beheerpaneel',
            ]);
            
            $menuItems = [
                0 => [
                    'menu' => 1,
                    'position' => 1,
                    'icon' => 'ti-home',
                    'name' => 'genmen01',
                    'link' => 'dashboard',
                    'permission' => 5,
                    'translation' => [
                        'input_name' => 'name', 
                        'translation_id' => 'genmen01', 
                        'text' => 'Dashboard',
                        'language_code' => $defaultLocale
                    ]
                ],
                1 => [
                    'menu' => 1,
                    'position' => 2,
                    'icon' => 'ti-user',
                    'name' => 'genmen02',
                    'translation_id' => ['name' => ''],
                    'link' => 'users',
                    'permission' => 10,
                    'translation' => [
                        'input_name' => 'name', 
                        'translation_id' => 'genmen02', 
                        'text' => 'Gebruikers',
                        'language_code' => $defaultLocale
                    ]
                ],
                2 => [
                    'menu' => 1,
                    'position' => 3,
                    'icon' => 'ti-menu',
                    'name' => 'genmen03',
                    'translation_id' => ['name' => ''],
                    'link' => 'menu',
                    'permission' => 10,
                    'translation' => [
                        'input_name' => 'name', 
                        'translation_id' => 'genmen03', 
                        'text' => 'Menu',
                        'language_code' => $defaultLocale
                    ]
                ],
                3 => [
                    'menu' => 1,
                    'position' => 4,
                    'icon' => 'ti-pencil-alt',
                    'name' => "genmen04",
                    'translation_id' => ['name' => ''],
                    'link' => 'content',
                    'permission' => 5,
                    'translation' => [
                        'input_name' => 'name', 
                        'translation_id' => 'genmen04', 
                        'text' => "Pagina's",
                        'language_code' => $defaultLocale
                    ]
                ],
            ];
            
            foreach ($menuItems as $menuItem) {
                MenuItem::create($menuItem);
                Translation::create($menuItem['translation']);
            }
            
            //Get the freshly made menu and items
            $menus = Menu::get()->toArray();
        }
        
        $i = 0;
        foreach ($menus as $menu) {
            $menuId = $menu['id'];
            
            $result[$menuId] = $menu;
            
            $items = MenuItem::getMenuItems($menuId, $currentAuth)->toArray();
                        
            //Duplicate $items with true position for constructing parents
            //$itemsDuplicate = $items;
            
            //reverses all menu items so if proper positioned subitems can be constructed
            $items = array_reverse($items);
    
            foreach ($items as $masterKey => $item) {
                //edit to allow parents
                if (isset($item['parent'])) {
                    //Loops to find its parent
                    foreach ($items as $key => $subitem) {
                        if ($subitem['id'] == $item['parent']) {
                            if (! isset($items[$key]['items'])) {
                                //makes new item
                                $items[$key]['items'][0] = $items[$masterKey];
                            } else {
                                //Puts new elemen in front to respect correct position
                                array_unshift($items[$key]['items'], $items[$masterKey]);
                            }
                        }
                    }
                }
            }
            
            //Removes subitems that are not in their parent
            foreach ($items as $key => $item) {
                if (! empty($item["parent"])) { //!isset($item["items"]) &&
                    unset($items[$key]);
                }
            }
           
            //Restores true position in menu
            $items = array_reverse($items);
            
            $result[$menuId]['items'] = $items;
        }

        return $result;
    }

    //ROUTE GENERATION (move to service provider?)
    public static function prepareRoute($page, $link, $hasChild = false){
        $result['id'] = $page['id'];
        $result['template'] = $page['template'];
        $result['page_uid'] = $page['page_uid'];
        $slug = !empty($link['preslug']) ? $link['preslug'].'/'.$link['slug'] : $link['slug'];
        $parameters = $hasChild ? "/{param1?}/{param2?}" : "";

        //only give it optional parameters if it is last nested item
        if($page['position'] == 1){
            $result['slugs']["page.index"] = "";
        }

        $pageAs = 'page.'.$link['slug']; //basic route without nesting
        $menuAs = 'page.menu.'.str_replace('/','_',$slug); //route with navigation nesting

        $result['slugs'][$pageAs] = $link['slug'].$parameters;
        $result['slugs'][$menuAs] = $slug.$parameters;
        $result['slugs']['locale.'.$pageAs] ="{locale?}/".$link['slug'].$parameters;
        $result['slugs']['locale.'.$menuAs] ="{locale?}/".$slug.$parameters;

        return $result;
    }

    public static function linkPages($menuItems, $preslug = null){
        $pages = Page::getPages(2,1);
        $result = [];
        foreach($menuItems as $items){
            $uid = $items['page_uid'];
            $pageKey = array_search($uid, array_column($pages, 'page_uid'));
            $slug = !empty($preslug) ? $preslug.'/'.$items['link'] : $items['link'];

            $result[$uid] = Menu::prepareRoute($pages[$pageKey], ["preslug" => $preslug, "slug" => $items['link']], !isset($items['items']));

            if(isset($items['items'])){
                $result = array_replace_recursive($result, Menu::linkPages($items['items'],$slug));
            }
        }
        return $result;
    }

    public static function generateRoutes(){
        $menus = Menu::constructMenu();
        $result = [];
        foreach($menus as $menu){
            if($menu['id'] == 1){
                continue;
            }

            if($menu['items']){
                foreach($menu['items'] as $items){
                    $result = Cache::tags('content')->remember('routes.'.$items['page_uid'], 60 * 60 * 24, function () use ($result,$menu) {
                        return array_replace_recursive($result, Menu::linkPages($menu['items']));
                    });
                }
            }
        }
        
        return $result;
    }
}
