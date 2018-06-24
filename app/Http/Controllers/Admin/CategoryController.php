<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Отображение списка категорий
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::paginate(10)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Открыте формы создания новых категорий
    public function create()
    {
        //
        return view('admin.categories.create', [
            'category' => [],
            
            //categories - дерево коллекций
            //with('findChildrenCat') - коллекции с вложенными категориями
            //where('parent_id', 0) - получаем категории, которые являются только родителями и никому не подчиняются
            'categories' => Category::with('findChildrenCat')->where('parent_id', 0)->get(),
            
            //Некий символ, определяющий вложенность. Для наглядности визуализации
            'delimiter' => ''
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //Запись вновь созданных категорий в DB
    public function store(Request $request)
    {
        //Метод для массового заполнения аттрибутов модели
        Category::create($request->all());
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     //Отображение записи
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     //Открыте формы редактирования категорий
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            //Коллекцию категорий
            'category' => $category,
            
            //categories - дерево коллекций
            //with('findChildrenCat') - коллекции с вложенными категориями
            //where('parent_id', 0) - получаем категории, которые являются только родителями и никому не подчиняются
            'categories' => Category::with('findChildrenCat')->where('parent_id', 0)->get(),
            
            //Некий символ, определяющий вложенность. Для наглядности визуализации вложенности
            'delimiter' => ''
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     //Запись отредпктированных категорий в базу
    public function update(Request $request, Category $category)
    {
        //
        $category->update($request->except('slug'));
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     //Удаление записи категории
    public function destroy(Category $category)
    {
        //
        $category->delete();
        
        return redirect()->route('admin.category.index');
    }
}
