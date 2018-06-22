@foreach ($categories as $category_list)

  <option value="{{$category_list->id or ""}}"
    {{--Этот блок только для редактирования категорий--}}
    @isset($category->id)

      @if ($category->parent_id == $category_list->id)
        selected=""
      @endif

      @if ($category->id == $category_list->id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$category_list->title or ""}}
  </option>

  @if(count($category_list->findChildrenCat) > 0)
    {{--Если у категории есть хоть одна вложенная категория - снова подключаем этот же самый шаблон--}}
    @include('admin.categories.partials.categories', [
      {{--Во вновь подключенный рекурсионным образом шаблон передаем только категории, 
      которые является вложенными для данной категории--}}
      'categories' => $category_list->findChildrenCat,
      {{--при каждой итерации добавляем в delimiter новый дефис для визуального отличия от вышестоящих--}}
      'delimiter'  => ' - ' . $delimiter
    ])
    
  @endif
@endforeach