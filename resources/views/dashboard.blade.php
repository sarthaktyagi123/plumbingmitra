<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Dashboard - Easy Shop Online Store </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
 <!-- Toaster -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
 <!-- Toaster   -->

 <!-- dataTables -->
 <link href="{{ asset('adminbackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
 <!-- dataTables -->

</head>

<body>
 
    <!-- Quick view -->
    @include('frontend.body.header')
    <!--End header-->

    <main class="main pages">
      @yield('user')
    </main>
     


 @include('frontend.body.footer')

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
   <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
    
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })

            // Initialize an array to keep track of selected item IDs
            //var selectedItems = [];

            // Function to add an item to the selected items array
        function addToCartDetailsItems() {
            // Check if the item is already selected
            //var index = selectedItems.indexOf(id);

            //if (index === -1) {
                // If not selected, add it to the array
               // selectedItems.push(id);
                var item_name = $('#item_name').text();
                var id = $('#dproduct_id').text();
                var company_name = $('#company_name').text();
                var other_specialty = $('#other_specialty').text();
            

                // Retrieve item details from HTML elements
                // var item_name = $('#item_name_' + id).text();
                // var company_name = $('#company_name_' + id).text();
                // var other_specialty = $('#other_specialty_' + id).text();

                // Optional: Highlight selected items in the UI
                //$('#item_name_' + id).addClass('selected-item');

                // Display alert message
                // const Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top-end',
                //     icon: 'info',
                //     showConfirmButton: false,
                //     timer: 3000
                // });

                // Toast.fire({
                //     type: 'info',
                //     title: 'Item added to the cart. Details: ' + item_name + ', ' + company_name + ', ' + other_specialty
                // });
                $.ajax({
                    url: "/ucart/data/store",      // URL to send the request to
                    method: "POST",                  // HTTP method (GET, POST, PUT, DELETE, etc.)
                    data: {                         // Data to be sent to the server
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                        item_name: item_name,
                        company_name: company_name,
                        other_specialty: other_specialty
                    },
                    dataType: "json",               // Expected data type of the response
                    success: function(data) {   // Callback function to handle successful response
                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: data.success ? 'success' : 'error',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                type: data.success ? 'success' : 'error',
                                title: data.success || data.error
                            });
                        console.log(data);
                    },
                    error: function(error) {        // Callback function to handle errors
                        console.error(error);
                    },
                    beforeSend: function() { 
                        $('#item_name_' + id).addClass('selected-item');

                        // Display alert message
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'info',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        Toast.fire({
                            type: 'info',
                            title: 'request to item cart is bieng made Details: Processing '
                        });

                    },
                    // complete: function() {          // Callback function to run regardless of success or failure
                    //     // Perform actions like hiding a loading spinner
                    //     $('#item_name_' + id).addClass('selected-item');

                    //     // Display alert message
                    //     const Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         icon: 'info',
                    //         showConfirmButton: false,
                    //         timer: 3000
                    //     });

                    //     Toast.fire({
                    //         type: 'info',
                    //         title: 'Item added to the cart. Details: ' + item_name + ', ' + company_name + ', ' + other_specialty
                    //     });
                    // }
                });

                
                
            // } else {
            //     // If already selected, remove it from the array
            //     selectedItems.splice(index, 1);

            //     // Optional: Remove highlight from the UI
            //     $('#item_name_' + id).removeClass('selected-item');
            // }
        }

// Function to send selected items to the server


     /// Eend Details Page Add To Cart Product 


 </script>


<script type="text/javascript">
    function cart() {
        $.ajax({
            type: 'GET',
            url: '/get-cart-product',
            dataType: 'json',
            success: function (response) {
                var rows = "";
                $.each(response.carts, function (key, value) {
                    rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30"></td>
                        <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" alt="#"></td>
                        <td class="product-des product-name">
                            <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name}</a></h6>
                        </td>
                        <td class="price" data-title="Price">
                            <h4 class="text-body">$${value.price}</h4>
                        </td>
                        <td class="price" data-title="Price">
                            ${value.options.color == null
                                ? `<span>.... </span>`
                                : `<h6 class="text-body">${value.options.color}</h6>`
                            }
                        </td>
                        <td class="price" data-title="Price">
                            ${value.options.size == null
                                ? `<span>.... </span>`
                                : `<h6 class="text-body">${value.options.size}</h6>`
                            }
                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            <div class="detail-extralink mr-15">
                                <div class="detail-qty border radius">
                                    <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                    <a type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                            <h4 class="text-brand">$${value.subtotal}</h4>
                        </td>
                        <td class="action text-center" data-title="Remove">
                            <a type="submit" class="text-body" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a>
                        </td>
                    </tr>`;
                });
                $('#cartPage').html(rows);
            }
        });
    }
    cart();

    function cartRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/cart-remove/" + id,
            success: function (data) {
                cart();
                miniCart();
                couponCalculation();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
            }
        });
    }

    function cartIncrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/cart-increment/" + rowId,
            dataType: 'json',
            success: function (data) {
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }

    function cartDecrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/cart-decrement/" + rowId,
            dataType: 'json',
            success: function (data) {
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }

    function applyCoupon() {
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            url: "/coupon-apply",
            dataType: 'json',
            data: {
                coupon_name: coupon_name,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.validity) {
                    couponCalculation();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
            }
        });
    }

    function couponCalculation() {
        $.ajax({
            type: 'GET',
            url: "/coupon-calculation",
            dataType: 'json',
            success: function (data) {
                var couponCal = "";
                if (data.hasOwnProperty('coupon_name')) {
                    couponCal = `<tr>
                        <td class="text-right">
                            <h6 class="text-muted">Coupon (${data.coupon_name})</h6>
                        </td>
                        <td class="text-right">
                            <h6 class="text-muted">-$${data.discount_amount}</h6>
                        </td>
                    </tr>`;
                }
                couponCal += `<tr>
                    <td class="text-right">
                        <h6 class="text-muted">Total</h6>
                    </td>
                    <td class="text-right">
                        <h6 class="text-muted">$${data.total_amount}</h6>
                    </td>
                </tr>`;
                $('#couponCalField').html(couponCal);
            }
        });
    }
</script>




<script type="text/javascript">
    
    function miniCart(){
       $.ajax({
           type: 'GET',
           url: '/product/mini/cart',
           dataType: 'json',
           success:function(response){
               // console.log(response)
   
           $('span[id="cartSubTotal"]').text(response.cartTotal);
           $('#cartQty').text(response.cartQty);
   
           var miniCart = ""
   
           $.each(response.carts, function(key,value){
              miniCart += ` <ul>
               <li>
                   <div class="shopping-cart-img">
                       <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                   </div>
                   <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                       <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                       <h4><span>${value.qty} × </span>${value.price}</h4>
                   </div>
                   <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                       <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"  ><i class="fi-rs-cross-small"></i></a>
                   </div>
               </li> 
           </ul>
           <hr><br>  
                  `  
             });
   
               $('#miniCart').html(miniCart);
   
           }
   
       })
    }
     miniCart();
   
   
     /// Mini Cart Remove Start 
      function miniCartRemove(rowId){
        $.ajax({
           type: 'GET',
           url: '/minicart/product/remove/'+rowId,
           dataType:'json',
           success:function(data){
           miniCart();
                // Start Message 
   
               const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',
                     icon: 'success', 
                     showConfirmButton: false,
                     timer: 3000 
               })
               if ($.isEmptyObject(data.error)) {
                       
                       Toast.fire({
                       type: 'success',
                       title: data.success, 
                       })
   
               }else{
                  
              Toast.fire({
                       type: 'error',
                       title: data.error, 
                       })
                   }
   
                 // End Message  
   
           }
   
   
   
        })
      }
   
   
   
       /// Mini Cart Remove End 
   
   
   </script>

<script src="{{ asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('adminbackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>


<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>


</body>

</html>