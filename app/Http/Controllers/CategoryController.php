<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
class CategoryController extends Controller
{
    public function index()
    {
      return view('Settings.Category');
    }
    public function indexData()
    {
      return category::get();
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:30|unique:categories',
      ]);

      $catDB = new category;
      $catDB->name = $request->name;
      $catDB->save();
      return ['success'=>'success'];
    }
    public function delete($id)
    {
      category::where('id', $id)->delete();
      return ['success'=>'success'];
    }
}
