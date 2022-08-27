<div class="form-group">
    <label> Select Category Level</label>
        <select class="form-control selectpicker select2" data-style="py-0" name="parent_id" id="parent_id" style="width: 100%;line-height: 100% !important;">
            <option value="0" @if(isset($getCategoriesData['parent_id']) && $getCategoriesData['parent_id'] == 0) selected @endif>Main Category</option>
                @if(!empty($getCategories))
                    @foreach($getCategories as $category)
                        <option value="{{$category['id']}}" @if(isset($getCategoriesData['parent_id']) && $getCategoriesData['parent_id'] == $category['id'])  selected @endif>&nbsp;&raquo; {{$category['category_name']}}</option>
                        @if(!empty($category['subcategories']))
                            @foreach($category['subcategories'] as $subcategory)
                                <option value="{{$subcategory['id']}}">&nbsp;&raquo;&raquo;&raquo; {{$subcategory['category_name']}}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
        </select>
</div>