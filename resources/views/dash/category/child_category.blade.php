@foreach($child as $category)
    <div class="card  item-category">
        <div class="card-header">
            {{--start category content --}}
            <div class="item-category-title">
                @if(count($category->children))
                    <a class="btn my-3" href="#collapse{{ $category->id }}" data-bs-toggle="collapse"><h6>{{ $category->title_persian }}</h6></a>
                @else
                    <a class="btn my-3" href="#collapse{{ $category->id }}" data-bs-toggle="collapse"><h6>{{ $category->title_persian }}</h6></a>
                @endif
            </div>
            <div class="item-category-actions d-flex justify-content-center align-items-center">
                @if($category->parent_id == null)
                    <a href="javascript:void(0)" class="alert {{ $category->has_spec ? 'alert-success' : '' }}  me-2">  {{ $category->has_spec == '1' ? 'دارای مشخصات فنی' : '' }} </a>
                    <a href="javascript:void(0)" class="alert {{ $category->has_brand ? 'alert-success' : ''}}  me-2">  {{ $category->has_brand == '1' ? 'دارای برند' : '' }} </a>
                    <a href="{{ route('admin.category.edit',['id'=>$category->id]) }}" class="mx-4"><i class="fas fa-edit"></i></a>
                    <a href="#" wire:click.prevent="deleteConfirmation({{ $category->id }})"><i class="fas fa-trash" ></i></a>
                @else
                    <a href="javascript:void(0)" class="alert {{ $category->has_spec ? 'alert-success' : '' }}  me-2">  {{ $category->has_spec == '1' ? 'دارای مشخصات فنی' : '' }} </a>
                    <a href="javascript:void(0)" class="alert {{ $category->has_brand ? 'alert-success' : ''}}  me-2">  {{ $category->has_brand == '1' ? 'دارای برند' : '' }} </a>
                    <a href="{{ route('admin.category.edit',['id'=>$category->id]) }}" class="mx-4"><i class="fas fa-edit"></i></a>
                    <a href="#" wire:click.prevent="detachCategory({{ $category->id }})" class="mx-4"><i class="fa fa-unlink"></i></a>
                    <a href="#" wire:click.prevent="deleteConfirmation({{ $category->id }})"><i class="fas fa-trash" ></i></a>
                @endif
            </div>
            {{--end category content --}}
        </div>
    </div>
    <div class="collapse show" id="collapse{{$category->id}}">
        @if(!$category->chlidren)
            @include('dash.category.child_category',['child'=>$category->children])
        @endif
    </div>
@endforeach
