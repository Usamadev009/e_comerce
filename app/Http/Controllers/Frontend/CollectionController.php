<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Subcategory;
use App\Models\Product;

class CollectionController extends Controller
{
    public function groupview($group_url)
    {
        $group = Group::where('url',$group_url)->first();
        $category = Category::where('group_id',$group->id)->where('status','!=','2')->where('status','0')->get();
        return view('frontend.collections.category',compact('category','group'));
    }

    public function categoryview($group_url, $cate_url)
    {
        $category = Category::where('url',$cate_url)->first();
        $subcategory = Subcategory::where('category_id',$category->id)->where('status','!=','2')->where('status','0')->get();
        return view('frontend.collections.sub_category',compact('category','subcategory'));
    }

    public function subcategoryview($group_url, $cate_url, $subcate_url, Request $request)
    {
        $subcategory = Subcategory::where('url',$subcate_url)->first();
        $category_id = $subcategory->category_id;

        $subcategorylist = Subcategory::where('category_id',$category_id)->get();

        if($request->get('sort') == 'price_asc')
        {
            $products = Product::where('sub_category_id',$subcategory->id)->orderBy('offer_price','asc')->where('status','!=','2')->where('status',0)->get();
        }
        elseif($request->get('sort') == 'price_desc')
        {
            $products = Product::where('sub_category_id',$subcategory->id)->orderBy('offer_price','desc')->where('status','!=','2')->where('status',0)->get();
        }
        elseif($request->get('sort') == 'newest')
        {
            $products = Product::where('sub_category_id',$subcategory->id)->orderBy('created_at','desc')->where('status','!=','2')->where('status',0)->get();
        }
        elseif($request->get('sort') == 'popularity')
        {
            $products = Product::where('sub_category_id',$subcategory->id)->where('popular_products','1')->where('status','!=','2')->where('status',0)->get();
        }
        elseif($request->get('filterbrand'))
        {
            $checked = $_GET['filterbrand'];

            // Filter with name
            $subcategory_filter = Subcategory::whereIn('name', $checked)->get();
            $subcateid = [];
            foreach($subcategory_filter as $scid_list)
            {
                array_push($subcateid, $scid_list->id);
            }
            // End - Filter with name

            $products = Product::whereIn('sub_category_id',$subcateid)->where('status','!=','2')->where('status','0')->get();
        }
        else
        {
            $products = Product::where('sub_category_id',$subcategory->id)->where('status','!=','2')->where('status','0')->get();
        }
        return view('frontend.collections.products',compact('subcategory','products','subcategorylist'));
    }

    public function productview($group_url, $cate_url, $subcate_url, $prod_url)
    {
            $products = Product::where('url',$prod_url)->where('status',0)->first();
            return view('frontend.collections.single_product',compact('products'));
    }

    public function SearchautoComplete(Request $request)
    {
        $query = $request->get('term','');
        $products = Product::where('name','LIKE','%'.$query.'%')->where('status','0')->get();

        $data = [];
        foreach ($products as $items) {
            $data[] = [
                'value'=>$items->name,
                'id'=>$items->id,
            ];
        }
        if(count($data))
        {
            return $data;
        }
        else
        {
            return ['value'=>'No Result Found','id'=>''];
        }
    }

    public function result(Request $request)
    {
        $searchingdata = $request->search_product;
        $products = Product::where('name','LIKE','%'.$searchingdata.'%')->where('status','0')->first();

        if($products)
        {
            if(isset($_POST['searchbtn']))
            {
                return redirect('collection/'.$products->subcategory->category->group->url.'/'.
                $products->subcategory->category->url.'/'.$products->subcategory->url);
            }
            else
            {
                return redirect('collection/'.$products->subcategory->category->group->url.'/'.
                $products->subcategory->category->url.'/'.$products->subcategory->url.'/'.$products->url);
            }
                // return redirect('search/'.$products->url);
        }
        else
        {
            return redirect('/')->with('status','Product Not Available');
        }
    }
}
