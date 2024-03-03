<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Category;
use App\Models\SubItem;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::get()->count();
        $categoryCount = Category::get()->count();
        $itemCount = SubItem::get()->count();
        $borrowCount = Borrow::get()->count();

        $latestBorrows = Borrow::latest()->limit(4)->get();

        $categories = Category::all();
        $maxSubitemsCategory = null;
        $maxSubitemsCount = 0;
        foreach ($categories as $category) {
            $subitemsCount = $category->items()->withCount('subitems')->get()->sum('subitems_count');
            if ($subitemsCount > $maxSubitemsCount) {
                $maxSubitemsCount = $subitemsCount;
                $maxSubitemsCategory = $category;
            }
        }

        return view('pages.dashboard.index', compact('userCount', 'categoryCount', 'itemCount', 'borrowCount', 'latestBorrows', 'categories', 'maxSubitemsCount'));
    }
}
