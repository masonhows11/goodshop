<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class AdminCrudController extends Controller
{
    public function create(Request $request)
    {
        try {
            $province  = Province::findOrFail($request->id);
            $provinceId = $province->id;
            return view('dash.address_city.create', ['province' => $province ,'provinceId' => $provinceId]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
