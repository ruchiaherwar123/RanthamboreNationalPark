@extends('Frontend.Layout.main')
@section('title', $pageTitle)
@section('keywords', $pageKeywords)
@section('description', $pageDescription)
@section('section')
<style>
    p{
        text-align:justify;
    }
</style>

<div class="breadcrumb-area breed27">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="breadcrumb-wrap">
<h2>{{$tigerstory[0]->title}}</h2>
<ul class="breadcrumb-links">
<li>
<a href="{{url('/')}}">Home</a>
<i class="bx bx-chevron-right"></i>
</li>
<li>{{$tigerstory[0]->title}}</li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="destinations-area mt-5">
  <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="package-card shadow mb-5 brd-thm1">
                <div class="package-details text-justify">
                    <p style="text-align:justify;">{!!$tigerstory[0]->description!!}</p>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection