@extends( 'dash.include.master_dash')
@section( 'dash_page_title')
    {{ __('messages.order_details') }}
@endsection
@section( 'breadcrumb')
    {{ Breadcrumbs::render('admin.order.details') }}
@endsection
@section( 'dash_main_content')
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <a class="btn btn-sm btn-primary"
                       href="{{ route('admin.orders.index') }}">{{ __('messages.all_orders') }}</a>
                </div>
            </div>
        </div>


        <div class="row  order-list bg-white">
            <div class=" my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.product_name') }}</th>
                        <th>{{ __('messages.percent_amazing_sale') }}</th>
                        <th>{{ __('messages.price_amazing_sale') }}</th>
                        <td>{{ __('messages.quantity') }}</td>
                        <th>{{ __('messages.total_price_product') }}</th>
                        <th>{{ __('messages.total_price') }}</th>
                        <th>{{ __('messages.color') }}</th>
                        <th>{{ __('messages.warranty') }}</th>
                        <th>{{ __('messages.attributes') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $order->orderItems as $item)
                        <tr class="text-center">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->singleProduct->title_persian ?? '-' }}</td>
                            <td>{{ $item->amazingSale ? $item->amazingSale->percentage .' ' . __('messages.percentage') : '-' }}</td>
                            <td>{{ $item->amazing_sale_discount_amount .' ' . __('messages.toman') ?? '-' }}</td>
                            <td>{{ $item->number  ?? '-' }}</td>
                            <td>{{ number_format(floatval($item->final_product_price)) . ' ' . __('messages.toman') ?? '-' }}</td>
                            <td>{{ number_format(floatval($item->final_total_price )) . ' ' . __('messages.toman') ?? '-' }}</td>
                            <td>{{ $item->color->color_name ?? '-' }}</td>
                            <td>{{ $item->warranty->guarantee_name ?? '-' }}</td>
                            <td>
                                @forelse($item->orderItemAttribute as $attr)
                                    {{ $attr->categoryAttribute->title ?? '-' }}
                                    :
                                    {{ $attr->categoryAttributeValue->value ?? '-' }}
                                @empty
                                  {{ '-' }}
                                @endforelse
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
