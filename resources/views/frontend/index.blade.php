@extends('frontend.master_dashboard')
@section('main')

@section('title')
    Home Easy Multi Vendor Shop 
@endsection

     @include('frontend.home.home_slider')
 
        <!--End hero slider-->
     @include('frontend.home.home_features_category')

        <!--End category slider-->
     
        <!--End banners-->


	

        <!--Products Tabs-->
 
 

    

        
        <!--End Best Sales-->
 



        <!-- Fashion Category -->


        <!--End Fashion Category -->





        <!-- SweetHome Category -->


        <!--End SweetHome Category -->


 





  
        <!-- Mobile Category -->


        <!--End Mobile Category -->


 

        <!--End 4 columns-->

 

  <!--Vendor List -->

@include('frontend.home.home_vendor_list')

 <!--End Vendor List -->

@endsection