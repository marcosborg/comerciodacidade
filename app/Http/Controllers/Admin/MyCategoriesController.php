<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMyCategoryRequest;
use App\Http\Requests\StoreMyCategoryRequest;
use App\Http\Requests\UpdateMyCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyCategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('my_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myCategories.create');
    }

    public function store(StoreMyCategoryRequest $request)
    {
        $myCategory = MyCategory::create($request->all());

        return redirect()->route('admin.my-categories.index');
    }

    public function edit(MyCategory $myCategory)
    {
        abort_if(Gate::denies('my_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myCategories.edit', compact('myCategory'));
    }

    public function update(UpdateMyCategoryRequest $request, MyCategory $myCategory)
    {
        $myCategory->update($request->all());

        return redirect()->route('admin.my-categories.index');
    }

    public function show(MyCategory $myCategory)
    {
        abort_if(Gate::denies('my_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myCategories.show', compact('myCategory'));
    }

    public function destroy(MyCategory $myCategory)
    {
        abort_if(Gate::denies('my_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyMyCategoryRequest $request)
    {
        $myCategories = MyCategory::find(request('ids'));

        foreach ($myCategories as $myCategory) {
            $myCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
