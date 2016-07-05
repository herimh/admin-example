<ul>
	@foreach($categories as $subindex => $category)
        @if(count($category->children) > 0)
            <li class="has_children" key="{{ $category->id }}">
                <input type="checkbox" id="node-a{{$index.'-a'.$subindex}}" />
                <input style="display: none" type="checkbox" data-key = "{{ $category->id }}" name="assigned_cat[{{ $category->id }}]" value="false"/>

                <label>
                    <input type="checkbox" class="category-check" value="{{ $category->id }}"
                           @if($category->isAssignedToReplica($object->id)) checked @endif /><span></span>
                </label>
                <label for="node-a{{$index.'-a'.$subindex}}">{{ $category->name }}</label>
                @include('vendor.base_admin._form_widget_assign_product_child',
                   ['categories' => $category->children, 'index' => ($index.'-a'.$subindex)])
            </li>
        @else
            <li class="has_children" key="{{ $category->id }}">
                <input type="checkbox" id="node-a{{$index.'-a'.$subindex}}" />
                <input style="display: none" type="checkbox" name="assigned_cat[{{ $category->id }}]" value="false"/>

                <label>
                    <input type="checkbox" class="category-check" value="{{ $category->id }}"
                              @if($category->isAssignedToReplica($object->id)) checked @endif/>
                    <span></span>
                </label>
                <label for="node-a{{$index.'-a'.$subindex}}">{{ $category->name }}</label>

                <ul class="products-container" loaded="false" url="{{ route('mastershop.category.products',
                        ['categoryId' => $category->id, 'index' => $index, 'subindex' => $subindex, 'replicaId' => $object->id]) }}">

                </ul>

            </li>
        @endif
    @endforeach
</ul>