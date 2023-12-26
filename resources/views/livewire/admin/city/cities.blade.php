<div>

    <div class="row  list-cities bg-white mb-4">
        <div class="my-5" style="height:320px">
            <table class="table table-striped">
                <thead class="border-bottom-3 border-top-3">
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.title') }}</th>
                    <th>{{ __('messages.edit_model') }}</th>
                    <th>{{ __('messages.delete_model') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $cities as $item )
                    <tr class="text-center">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td><a href="{{ route('admin.city.edit',$item->id) }}" class="btn btn-primary btn-sm">{{ __('messages.edit_model') }}</a></td>
                        <td>
                            <form action="{{ route('admin.city.delete',$item->id) }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="province" value="{{ $item->province_id }}">
                                <button type="submit" class="btn btn-sm btn-danger delete-item">{{ __('messages.delete_model') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row d-flex justify-content-center bg-white">
        <div class="col-lg-2 col-md-2 my-3 py-3">
            {{ $cities->links() }}
        </div>
    </div>

</div>
