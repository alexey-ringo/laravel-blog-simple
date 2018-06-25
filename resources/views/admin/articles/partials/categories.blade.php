@foreach ($categories as $category)

  <option value="{{$category->id or ""}}"
    {{--Этот блок только для редактирования новости - если она существует--}}
    @isset($article->id)
      {{--Перебираем список всех категорий на этой новости--}}
      @foreach($article->morphCategoriesToMany as $category_article)
        {{--Если категория из общего списка привязана к новости...--}}
          {{--то данная категория д.б. выбрана--}}
          @if($category->id == $category_article->id)
          selected="selected"
          @endif
      @endforeach
    @endisset

    >
    {!! $delimiter or "" !!}{{$category->title or ""}}
  </option>

  @if(count($category->findChildrenCat) > 0)
    {{--Если у категории есть хоть одна вложенная категория - снова подключаем этот же самый шаблон--}}
    @include('admin.articles.partials.categories', [
      {{--Во вновь подключенный рекурсионным образом шаблон передаем только категории, 
      которые является вложенными для данной категории--}}
      'categories' => $category->findChildrenCat,
      {{--при каждой итерации добавляем в delimiter новый дефис для визуального отличия от вышестоящих--}}
      'delimiter'  => ' - ' . $delimiter
    ])
    
  @endif
@endforeach