@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Not Authorized - Pages')

@section('page-style')
<!-- Page -->
@vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection


@section('content')
<!-- Not Authorized -->
<div class="container-xxl container-p-y">
  <div class="misc-wrapper">
    <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">401</h1>
    <h4 class="mb-2 mx-2">You are not authorized! 🔐</h4>
    <p class="mb-6 mx-2">You don’t have permission to access this page. Go Home!</p>
    <a href="{{url('/')}}" class="btn btn-primary">Back to home</a>
    <div class="mt-6">
      <img src="{{asset('assets/img/illustrations/girl-with-laptop-'.$configData['style'].'.png')}}" alt="page-misc-not-authorized-light" width="500" class="img-fluid" data-app-light-img="illustrations/girl-with-laptop-light.png" data-app-dark-img="illustrations/girl-with-laptop-dark.png">
    </div>
  </div>
</div>
<!-- /Not Authorized -->
@endsection
