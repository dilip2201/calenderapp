@extends('layout.app')

@section('content')
@section('pageTitle', 'Dashboard')

 <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-content" style="text-align: center; padding: 15px 0px;">
                                    <div class="imageload" style="width: 420px;
    height: 420px;
    text-align: center;
    border: 1px solid #000;
    border-radius: 50%;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    display: inline-flex;">
                                        <img src="{{ URL::asset('public/images/foodism-new-logo.png') }}" style="height: 380px; width: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection