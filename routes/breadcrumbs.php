<?php
// Home
// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


// admin index
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('پنل مدیریت', route('admin.dashboard'));
});

// admin / users
Breadcrumbs::for('admin.users', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('کاربران', route('admin.users'));
});

// admin / admins
Breadcrumbs::for('admin.admins', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('مدیران', route('admin.admins'));
});

// admin / profile
Breadcrumbs::for('admin.profile', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('پروفایل مدیریت', route('admin.profile'));
});

// admin / profile / mobile
Breadcrumbs::for('admin.mobile', function ($trail) {
    $trail->parent('admin.profile');
    $trail->push('ویرایش شماره موبایل', route('admin.change.mobile'));
});
// roles
Breadcrumbs::for('admin.roles', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('نقش ها', route('admin.roles'));
});

Breadcrumbs::for('admin.roles.assign.users', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('تخصیص نقش ها', route('admin.role.list.users'));
    $trail->push('لیست کاربران', route('admin.role.list.users'));
});

Breadcrumbs::for('admin.roles.assign', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست کاربران', route('admin.role.list.users'));
    $trail->push('تخصیص نقش ها', route('admin.roles.assign.form'));
});


// perms
Breadcrumbs::for('admin.perms', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(' مجوز ها', route('admin.perms'));
});

Breadcrumbs::for('admin.perms.assign.users', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('تخصیص مجوزها', route('admin.perm.list.users'));
    $trail->push('لیست کاربران', route('admin.perm.list.users'));
});

Breadcrumbs::for('admin.perms.assign', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست کاربران', route('admin.perm.list.users'));
    $trail->push('تخصیص مجوزها', route('admin.perms.assign.form'));

});


// category
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('دسته بندی ها', route('admin.category.index'));

});
Breadcrumbs::for('admin.category.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('دسته بندی ها', route('admin.category.index'));
    $trail->push('دسته بندی جدید', route('admin.category.create'));

});
Breadcrumbs::for('admin.category.edit', function ($trail, $category) {
    $trail->parent('admin.dashboard');
    $trail->push('دسته بندی ها', route('admin.category.index'));
    $trail->push('ویرایش دسته بندی');
    $trail->push($category, route('admin.category.edit', $category));
});

// product type
// Breadcrumbs::for('admin.product.type.index', function ($trail) {
//    $trail->parent('admin.dashboard');
//    $trail->push('نوع کالا', route('admin.product.type.index'));
// });

// brands
Breadcrumbs::for('admin.brands', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('برند ها', route('admin.brand.index'));
});
Breadcrumbs::for('admin.brands.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('برند ها', route('admin.brand.index'));
    $trail->push('برند جدید', route('admin.brand.create'));
});
Breadcrumbs::for('admin.brands.edit', function ($trail, $brand) {
    $trail->parent('admin.dashboard');
    $trail->push('برند ها', route('admin.brand.index'));
    $trail->push('ویرایش برند');
    $trail->push($brand, route('admin.brand.edit', $brand));
});

// assign brands
Breadcrumbs::for('admin.brand.type', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('تخصیص برند', route('admin.brand.type'));
    $trail->push('نوع کالا', route('admin.brand.type'));
});

Breadcrumbs::for('admin.brand.assign', function ($trail, $type) {
    $trail->parent('admin.dashboard');
    $trail->push('نوع کالا', route('admin.brand.type'));
    $trail->push($type, route('admin.brand.assign', $type));
});


// index product
Breadcrumbs::for('admin.product.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست کالاها', route('admin.product.index'));
});
// create color
Breadcrumbs::for('admin.create.color', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.color_management'));
});
// create product basic
Breadcrumbs::for('admin.create.product.basic', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push('محصول جدید',route('admin.product.create.basic'));
});

// edit product basic
Breadcrumbs::for('admin.edit.product.basic', function ($trail,$product) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push('ویرایش محصول');
    $trail->push($product);
});

// create product image
Breadcrumbs::for('admin.create.product.images', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push($title);
    $trail->push(__('messages.product_images'));
});

// create product attribute
Breadcrumbs::for('admin.create.product.meta', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push($title);
    $trail->push(__('messages.product_meta'));
});

// create product warranty
Breadcrumbs::for('admin.create.product.warranty', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push($title);
    $trail->push(__('messages.warranty'));
});

// create product color
Breadcrumbs::for('admin.create.product.colors', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push($title);
    $trail->push(__('messages.product_colors'));
});

// create category attribute
Breadcrumbs::for('admin.create.category.attribute', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.category_attribute_management'), route('admin.category.attribute.index'));
});

// create category attribute value
Breadcrumbs::for('admin.create.category.attribute.value', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست ویژگی ها',route('admin.category.attribute.index'));
    $trail->push($title);
});

// admin comment section
Breadcrumbs::for('admin.comment.product.list', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('مدیریت نظرات');
    $trail->push('لیست محصولات',route('admin.product_comments.index'));
});
// admin product comments section
Breadcrumbs::for('admin.product.comments.list', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('مدیریت نظرات',route('admin.product_comments.index'));
    $trail->push('لیست نظرات');
    $trail->push($title);
});

// stock section
Breadcrumbs::for('admin.product.stock.list', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.stock_management'));

});

// add stock section
Breadcrumbs::for('admin.product.add.stock', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.add_to_stock'));
    $trail->push($title);

});

// edit stock section
Breadcrumbs::for('admin.product.edit.stock', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.modify_stock'));
    $trail->push($title);

});

// all payments
Breadcrumbs::for('admin.all.payments', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.all_payments'));
});

// single payment
Breadcrumbs::for('admin.show.payment', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.show_payment'));
    $trail->push(__('messages.transaction_code'));
    $trail->push($title);
});

// offline payment
Breadcrumbs::for('admin.offline.payments', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.offline_payments'),route('admin.payments.offline.index'));

});

// online payment
Breadcrumbs::for('admin.online.payments', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push( __('messages.online_payments'),route('admin.payments.online.index'));

});

// online payment
Breadcrumbs::for('admin.cash.payments', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.payment_on_the_spot'),route('admin.payments.cash.index'));
});

// common discount
Breadcrumbs::for('admin.common.discount.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.common_discount'));
});
Breadcrumbs::for('admin.common.discount.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.common_discount_list'),route('admin.common.discount.index'));
    $trail->push(__('messages.new_common_discount'));
});

Breadcrumbs::for('admin.common.discount.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.common_discount_list'),route('admin.common.discount.index'));
    $trail->push(__('messages.edit_common_discount'));
});

// amazing sales
Breadcrumbs::for('admin.amazing.sale.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.amazing_sales_list'),route('admin.amazing.sale.index'));
});

Breadcrumbs::for('admin.amazing.sale.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.amazing_sales_list'),route('admin.amazing.sale.index'));
    $trail->push(__('messages.new_amazing_sales_list'));
});

Breadcrumbs::for('admin.amazing.sale.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.amazing_sales_list'),route('admin.amazing.sale.index'));
    $trail->push(__('messages.amazing_sale_edit'));
});

// coupons
Breadcrumbs::for('admin.coupons.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.coupon_discount_list'),route('admin.coupons.index'));
});

Breadcrumbs::for('admin.coupons.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.coupon_discount_list'),route('admin.coupons.index'));
    $trail->push(__('messages.new_coupon'));
});

Breadcrumbs::for('admin.coupons.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.coupon_discount_list'),route('admin.coupons.index'));
    $trail->push(__('messages.edit_coupon'));
});


//// order

// all orders
Breadcrumbs::for('admin.orders.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.all_orders'),route('admin.orders.index'));
});

// new orders
Breadcrumbs::for('admin.orders.new', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.orders_new'),route('admin.orders.new'));
});

// sending orders
Breadcrumbs::for('admin.orders.sending', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.orders_sending'),route('admin.orders.sending'));
});
// canceled orders
Breadcrumbs::for('admin.orders.canceled', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.orders_canceled'),route('admin.orders.canceled'));
});
//  unpaid orders
Breadcrumbs::for('admin.orders.unpaid', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.orders_unpaid'),route('admin.orders.unpaid'));
});

// returned orders
Breadcrumbs::for('admin.orders.returned', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.orders_returned'),route('admin.orders.returned'));
});


// delivery

Breadcrumbs::for('admin.delivery.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.delivery_management'),route('admin.delivery.index'));
});
Breadcrumbs::for('admin.delivery.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.new_delivery'),route('admin.delivery.create'));

});

Breadcrumbs::for('admin.delivery.edit', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.edit_delivery'));
    $trail->push($title);
});

// order factor
Breadcrumbs::for('admin.order.factor', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.all_orders'),route('admin.orders.index'));
    $trail->push(__('messages.order_factor'));
    $trail->push($title);
});
// order details
Breadcrumbs::for('admin.order.details', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.all_orders'),route('admin.orders.index'));
    $trail->push(__('messages.order_details'));

});

// setting

Breadcrumbs::for('admin.setting.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.setting_site'),route('admin.setting.index'));
});

Breadcrumbs::for('admin.setting.edit', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.edit_setting_site'));
    $trail->push($title);
});

Breadcrumbs::for('admin.tag.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('messages.tags_management'));
});

Breadcrumbs::for('admin.product.create.tags', function ($trail,$title) {
    $trail->parent('admin.dashboard');
    $trail->push('لیست محصولات', route('admin.product.index'));
    $trail->push($title);
    $trail->push(__('messages.tags_management'));
});



// specification
//Breadcrumbs::for('admin.specification', function ($trail) {
//    $trail->parent('admin.dashboard');
//    $trail->push('مشخصات فنی', route('admin.specification.index'));
//});
//
//Breadcrumbs::for('admin.specification.create', function ($trail,$type_id,$type_title) {
//    $trail->parent('admin.dashboard');
//    $trail->push('نوع کالا',route('admin.specification.index'));
//    $trail->push('مشخصات فنی', route('admin.specification.new',$type_id));
//    $trail->push($type_title);
//});

// specification options

//Breadcrumbs::for('admin.specification.options', function ($trail) {
//    $trail->parent('admin.dashboard');
//    $trail->push('مقادیر مشخصات فنی',route('admin.specification.option.index'));
//
//});
//
//Breadcrumbs::for('admin.specification.options.create', function ($trail,$category_id,$category_title) {
//    $trail->parent('admin.dashboard');
//    $trail->push('نوع کالا', route('admin.specification.option.index'));
//    $trail->push('مقادیر مشخصات فنی', route('admin.specification.option.new',$category_id));
//    $trail->push($category_title);
//});


// attribute
//
//Breadcrumbs::for('admin.attributes', function ($trail) {
//    $trail->parent('admin.dashboard');
//    $trail->push('ویژگی ها', route('admin.attributes.index'));
//});
//
//Breadcrumbs::for('admin.attributes.create', function ($trail) {
//    $trail->parent('admin.dashboard');
//    $trail->push('ویژگی ها', route('admin.attributes.index'));
//    $trail->push('ویژگی جدید', route('admin.attributes.create'));
//});
//
//Breadcrumbs::for('admin.attributes.edit', function ($trail, $attribute) {
//    $trail->parent('admin.dashboard');
//    $trail->push('ویژگی ها', route('admin.attributes.index'));
//    $trail->push('ویرایش ویژگی');
//    $trail->push($attribute, route('admin.attributes.edit', $attribute));
//});

// attribute value

//Breadcrumbs::for('admin.attributes.value', function ($trail, $attribute) {
//    $trail->parent('admin.dashboard');
//    $trail->push('ویژگی ها', route('admin.attributes.index'));
//    $trail->push($attribute, route('admin.attributes.value', $attribute));
//});
//
//
//Breadcrumbs::for('admin.attributes.value.create', function ($trail) {
//    $trail->parent('admin.dashboard');
//    $trail->push('ویژگی ها', route('admin.attributes.index'));
//    $trail->push('مقدار جدید', route('admin.attributes.values.create'));
//});
