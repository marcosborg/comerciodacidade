<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMySubCategoryRequest;
use App\Http\Requests\StoreMySubCategoryRequest;
use App\Http\Requests\UpdateMySubCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MySubCategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mySubCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('my_sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mySubCategories.create');
    }

    public function store(StoreMySubCategoryRequest $request)
    {
        $mySubCategory = MySubCategory::create($request->all());

        return redirect()->route('admin.my-sub-categories.index');
    }

    public function edit(MySubCategory $mySubCategory)
    {
        abort_if(Gate::denies('my_sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mySubCategories.edit', compact('mySubCategory'));
    }

    public function update(UpdateMySubCategoryRequest $request, MySubCategory $mySubCategory)
    {
        $mySubCategory->update($request->all());

        return redirect()->route('admin.my-sub-categories.index');
    }

    public function show(MySubCategory $mySubCategory)
    {
        abort_if(Gate::denies('my_sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mySubCategories.show', compact('mySubCategory'));
    }

    public function destroy(MySubCategory $mySubCategory)
    {
        abort_if(Gate::denies('my_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mySubCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyMySubCategoryRequest $request)
    {
        $mySubCategories = MySubCategory::find(request('ids'));

        foreach ($mySubCategories as $mySubCategory) {
            $mySubCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
