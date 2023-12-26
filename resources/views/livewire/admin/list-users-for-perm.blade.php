<div>
    @section('dash_page_title')
        {{ __('messages.perms_assignment') }}
    @endsection
    @section('breadcrumb')
       {{ Breadcrumbs::render('admin.perms.assign.users') }}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.perms_assignment') }} / {{ __('messages.admin_users_list') }}</h3>
                </div>
            </div>
        </div>

        <div class="row admin-list-users bg-white">
            <div class="my-2  rounded-3 list-content">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th> تخصیص مجوز</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($users)
                        @foreach($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="mb-3">
                                    <a href="{{ route('admin.perms.assign.form',['user_id'=>$user->id]) }}"
                                       class="btn btn-primary  btn-sm mb-3">
                                        تخصیص مجوز
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 mt-5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
