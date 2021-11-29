@extends('layouts.mainlayout')
@section('title', 'Dashboard')
@section('body')

<section class="content">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12">
        <h2>Dashboard</h2>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/app"><i class="zmdi zmdi-home"></i> Home </a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ul><button type="button" class="btn btn-primary btn-icon mobile_menu"><i class="zmdi zmdi-sort-amount-desc"></i></button>
      </div>
      <div class="col-lg-5 col-md-6 col-sm-12"></div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon traffic">
          <div class="body">
            <h6>Missionaries</h6>
            <h2> 1 </h2>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon sales">
          <div class="body">
            <h6>Adoptions</h6>
            <h2> 0 </h2>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon email">
          <div class="body">
            <h6>Events</h6>
            <h2> 4 </h2>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon domains">
          <div class="body">
            <h6>Enquiries</h6>
            <h2> 6 </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="header">
        <h6>Unread Notifications</h6>
      </div>
      <div class="body">
        <div>
          <div class="row clearfix">
            <div class="col-sm-12">
              <ul class="cbp_tmtimeline">
                <li>
                  <div class="cbp_tmicon bg-green"><i class="fa fa-bell"></i></div>
                  <div class="cbp_tmlabel">
                    <div class="cbp_tmtime"><span>24 September 2020 14:17 pm</span></div><button href="/app/prayerneeds" class="btn btn-link" style="font-size: 14px; color: black;">New Prayer Request from Mission Enablers</button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div tabindex="0" aria-label="Loading" class="vld-overlay is-active is-full-page" style="display: none;">
        <div class="vld-background"></div>
        <div class="vld-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" height="40" width="40" fill="blue">
            <rect x="0" y="13" width="4" height="5">
              <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
              <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
            </rect>
            <rect x="10" y="13" width="4" height="5">
              <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
              <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
            </rect>
            <rect x="20" y="13" width="4" height="5">
              <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
              <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
            </rect>
          </svg></div>
      </div>
    </div>
  </div>
</section>

@endsection