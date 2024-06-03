@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                    <div class="d-flex d-flex align-items-center justify-content-between">
                        <div>
                            <h2>352</h2>
                            <p class="fontsize-sm m-0">Invoice Sent</p>
                        </div>
                        <div class="rounded-circle iq-card-icon dark-icon-light iq-bg-primary "> <i class="ri-inbox-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch ">

                <div class="iq-card-body">
                    <div class="d-flex d-flex align-items-center justify-content-between">
                        <div>
                            <h2>$37k</h2>
                            <p class="fontsize-sm m-0">Credited</p>
                        </div>
                        <div class="rounded-circle iq-card-icon iq-bg-danger"><i class="ri-radar-line"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                    <div class="d-flex d-flex align-items-center justify-content-between">
                        <div>
                            <h2>32%</h2>
                            <p class="fontsize-sm m-0">Employee Costs</p>
                        </div>
                        <div class="rounded-circle iq-card-icon iq-bg-warning "><i class="ri-price-tag-3-line"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                    <div class="d-flex d-flex align-items-center justify-content-between">
                        <div>
                            <h2>27h</h2>
                            <p class="fontsize-sm m-0">Payment Delay</p>
                        </div>
                        <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-refund-line"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
