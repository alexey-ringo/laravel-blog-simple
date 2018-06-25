<div class="form-group">
    <label for="">Статус</ladel>
    <select class="form-control" name="published">
        {{--Если есть сущ. id - значит это обновление --}}
        @if(isset($article->id))
            <option value="0" @if($article->published == 0) selected="" @endif>
            Не опубликовано
            </option>
            <option value="1" @if($article->published == 1) selected="" @endif>
            Опубликовано
            </option>
        @else
            <option value="0" selected="">Не опубликовано</option>
            <option value="1" selected="">Опубликовано</option>
        @endif
    </select>
</div>

<div class="form-group"> 
    <label for="">Заголовок</label>
    <input type="text" class="form-control" name="title" placeholder="Заголовок новости" 
            value="{{$article->title or ""}}" required>
</div>

<div class="form-group">            
    <label for="">Slug(Уникальное значение)</label>
    <input class="form-control" type="text" name="slug" placeholder="Автоматическая генерация" 
            value="{{$article->slug or ""}}" readonly="">
</div>

<div class="form-group">            
    <label for="">Родительская категория</label>
    {{--Множественное присваивание категорий--}}
    <select class="form-control" name="categories[]" multiple="">
        @include('admin.articles.partials.categories', ['categories' => $categories])
    </select>
</div>

<div class="form-group">
    <label for="">Краткое описание</label>
    <textarea class="form-control" id="description_short" 
        name="description_short">{{$article->description_short or ""}}</textarea>
</div>

<div class="form-group">
    <label for="">Полное описание</label>
    <textarea class="form-control" id="description" 
        name="description">{{$article->description or ""}}</textarea>
</div>

    <hr />
    
<div class="form-group">
    <label for="">Мета заголовок</label>
    <input type="text" class="form-control" name="meta_title" 
        placeholder="Мета заголовок" value="{{$article->meta_title or ""}}">
</div>

<div class="form-group">
    <label for="">Мета описание</label>
    <input type="text" class="form-control" name="meta_description" 
        placeholder="Мета описание" value="{{$article->meta_description or ""}}">
</div>

<div class="form-group">
    <label for="">Ключевые слова</label>
    <input type="text" class="form-control" name="meta_keyword" 
        placeholder="Ключевые слова, через запятую" value="{{$article->meta_keyword or ""}}">
</div>

    <hr />

    <input class="btn btn-primary" type="submit" value="Сохранить">
    
</div>