<?php

namespace App\Providers;

use App\Blog\Sections\Repositories\SectionRepository;
use App\Shop\Carts\Repositories\CartRepository;
use App\Shop\Carts\ShoppingCart;
use App\Shop\Categories\Category;
use App\Blog\Sections\Section;
use App\Shop\Categories\Repositories\CategoryRepository;
use App\Shop\Employees\Employee;
use App\Shop\Employees\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

/**
 * Class GlobalTemplateServiceProvider
 * @package App\Providers
 * @codeCoverageIgnore
 */
class GlobalTemplateServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'layouts.admin.app',
            'frontend.layouts.app',
            'layouts.admin.sidebar',
            'admin.shared.products',
            'admin.shared.articles'
        ], function ($view) {
            $view->with('admin', Auth::guard('employee')->user());
        });

        view()->composer(['layouts.front.app', 'frontend.layouts.app', 'front.categories.sidebar-category'], function ($view) {
            $view->with('categories', $this->getCategories());
            $view->with('sections', $this->getSections());
            $view->with('cartCount', $this->getCartCount());
        });

        /**
         * breadcumb
         */
        view()->composer([
            "layouts.admin.app"
        ], function ($view) {
            $breadcumb = [
                ["name" => "Dashboard", "url" => route("admin.dashboard"), "icon" => "fa fa-dashboard"],
            ];
            $paths = request()->segments();
            if (count($paths) > 1) {
                foreach ($paths as $key => $pah) {
                    if ($key == 1)
                        $breadcumb[] = ["name" => ucfirst($pah), "url" => request()->getBaseUrl() . "/" . $paths[0] . "/" . $paths[$key], 'icon' => config("module.admin." . $pah . ".icon")];
                    elseif ($key == 2)
                        $breadcumb[] = ["name" => ucfirst($pah), "url" => request()->getBaseUrl() . "/" . $paths[0] . "/" . $paths[1] . "/" . $paths[$key], 'icon' => config("module.admin." . $pah . ".icon")];
                }
            }
            $view->with(
                [
                    "breadcumbs" => $breadcumb
                ]
            );
        });


        view()->composer(['layouts.front.category-nav'], function ($view) {
            $view->with('categories', $this->getCategories());
        });
    }

    /**
     * Get all the categories
     *
     */
    private function getCategories()
    {
        $categoryRepo = new CategoryRepository(new Category);
        return $categoryRepo->listCategories('name', 'asc', 1)->whereIn('parent_id', [1]);
    }

    /**
 * Get all the sections
 *
 */
    private function getSections()
    {
        $sectionRepo = new SectionRepository(new Section);
        return $sectionRepo->listSections('name', 'asc', 1)->whereIn('parent_id', [1]);
    }

    /**
     * @return int
     */
    private function getCartCount()
    {
        $cartRepo = new CartRepository(new ShoppingCart);
        return $cartRepo->countItems();
    }

    /**
     * @param Employee $employee
     * @return bool
     */
    private function isAdmin(Employee $employee)
    {
        $employeeRepo = new EmployeeRepository($employee);
        return $employeeRepo->hasRole('admin');
    }
}
