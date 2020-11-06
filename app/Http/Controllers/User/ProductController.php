<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;

class ProductController extends Controller
{

    //AllProducts
    public function AllProducts()
    {
        $allData = Product::where('status', '1')
            ->latest('id')
            ->paginate(6);

        $category = '';

        return view('user.products', compact('allData', 'category'));
    }

    //SubProducts
    public function SubProducts($sub_id)
    {
        $allData = Product::where('status', '1')
            ->where('sub_id', $sub_id)
            ->latest('id')
            ->paginate(6);

        $subcatData = Subcategory::where('id', $sub_id)->with('category')->first();

        $category = $subcatData->category->name;
        $subcategory = $subcatData->name;

        return view('user.products', compact('allData', 'category', 'subcategory'));
    }

    //CatProducts
    public function CatProducts($cat_id)
    {
        $allData = Product::where('status', '1')
            ->where('cat_id', $cat_id)
            ->latest('id')
            ->paginate(6);

    
        $category = Category::find($cat_id);

        //dd($category);

        // echo $category;
        // exit();

        return view('user.products', compact('allData', 'category'));
    }

}
