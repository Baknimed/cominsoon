<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Tfeatures;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class TfeaturesController extends Controller
{
    private $features;

    public function __construct(Tfeatures $features)
    {
        $this->features = $features;
    }

    public function list()
    {
        $features = $this->features->getListAll();

        return view('admin.features.t_features_list', [
            'amenities' => $features
        ]);
    }

    public function create(Request $request)
    {
        $rule_factory = RuleFactory::make([
            '%name%' => '',
            'icon' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $file_name = $this->uploadImage($icon, '');
            $data['icon'] = $file_name;
        }

        $model = new Tfeatures();
        $model->fill($data)->save();

        return back()->with('success', 'Add features success!');
    }

    public function update(Request $request)
    {
        $rule_factory = RuleFactory::make([
            'amenities_id' => 'required',
            '%name%' => '',
            'icon' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $file_name = $this->uploadImage($icon, '');
            $data['icon'] = $file_name;
        }

        $model = Tfeatures::findOrFail($request->amenities_id);
        $model->fill($data)->save();

        return back()->with('success', 'Update amenities success!');
    }

    public function destroy($id)
    {
        Tfeatures::destroy($id);
        return back()->with('success', 'Delete amenities success!');
    }
}
