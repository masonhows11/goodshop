<?php


namespace App\Repositories;


//use App\Models\Option;
use App\Models\Product;
//use App\Models\ProductSpecification;
//use App\Models\Specification;
use Illuminate\Support\Facades\DB;

class ProductSpecificationRepository
{

//    public function getProductSpecifications($product_id)
//    {
//        return DB::table('specifications')
//            ->join('product_specifications', 'specifications.id', '=', 'product_specifications.specification_id')
//            ->join('products', 'products.id', '=', 'product_specifications.product_id')
//            ->where('products.id', '=', $product_id)
//            ->select('product_specifications.id',
//                'specifications.title',
//                'product_specifications.filterable',
//                'product_specifications.detail_page',
//                'product_specifications.front_type',
//                'product_specifications.display_order',
//                'product_specifications.product_id',
//                'product_specifications.type_id',
//                'product_specifications.value')
//            ->orderBy('display_order')->get();
//    }
//
//    public function getProductSpecification($request)
//    {
//        return DB::table('specifications')
//            ->join('product_specifications', 'specifications.id', '=', 'product_specifications.specification_id')
//            ->join('products', 'products.id', '=', 'product_specifications.product_id')
//            ->where('products.id', '=', $request->product_id)->where('product_specifications.id', '=', $request->product_specification_id)
//            ->select('product_specifications.id',
//                'product_specifications.specifications_id',
//                'specifications.title',
//                'product_specifications.filterable',
//                'product_specifications.detail_page',
//                'product_specifications.front_type',
//                'product_specifications.display_order',
//                'product_specifications.product_id',
//                'product_specifications.type_id',
//                'product_specifications.value')
//            ->orderBy('display_order')->get()->toArray();
//    }
//
//    public function storeSpecifications($request)
//    {
//
//        $option = '';
//        $type = $request->input('specific_type');
//        switch ($type) {
//            case "Select":
//            case "MultiSelect":
//                $option = Option::whereIn('id', $request->spec_option)->select('id', 'title')->get();
//                break;
//            case "TextArea":
//            case "TextBox":
//                $option = json_encode(explode(",", $request->spec_option));
//                break;
//            default:
//        }
//        return ProductSpecification::create([
//            'type_id' => $request->type_id,
//            'product_id' => $request->product_id,
//            'specification_id' => $request->specification,
//            'front_type' => $request->specific_type,
//            'filterable' => $request->filterable,
//            'detail_page' => $request->detail_page,
//            'display_order' => $request->display_order,
//            'value' => $option,
//        ]);
//
//    }
//
//    public function updateSpecification($request)
//    {
//
//        $option = '';
//        $type = $request->input('specific_type');
//        switch ($type) {
//            case "Select":
//            case "MultiSelect":
//                $option = Option::whereIn('id', $request->spec_option)->select('id', 'title')->get();
//                break;
//            case "TextArea":
//            case "TextBox":
//                $option = json_encode(explode(",", $request->spec_option));
//                break;
//            default:
//        }
//        return ProductSpecification::where('id', $request->id)
//            ->where('specification_id', $request->specific_id)
//            ->where('product_id', $request->product_id)
//            ->where('type_id', $request->type_id)
//            ->update([
//                'type_id' => $request->type_id,
//                'front_type' => $request->specific_type,
//                'filterable' => $request->filterable,
//                'detail_page' => $request->detail_page,
//                'display_order' => $request->display_order,
//                'value' => $option,
//            ]);
//    }


}
