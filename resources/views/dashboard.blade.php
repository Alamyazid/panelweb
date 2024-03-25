@extends('layouts.master')
@section('content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h4>
               Dashboard</h4>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                  <svg class="stroke-icon">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
     @section('scss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    @endsection
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row size-column">
        <div class="col-xxl-10 col-md-12 box-col-8 grid-ed-12">
          <div class="row">
            <div class="col-xxl-5 col-md-7 box-col-7">
              <div class="row"> 
                <div class="col-sm-12"> 
                  <div class="card o-hidden">             
                    <div class="card-body balance-widget"><span class="f-w-500 f-light">Total Balance</span>
                      <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22">IDR.<span class="counter">{{ number_format(Auth::user()->balance) }} </span><span class="f-light f-14 f-w-400 ms-1">this month</span></h4><a class="purchase-btn btn btn-primary btn-hover-effect f-w-500" href="{{ route('invoce.index') }}">Tap Up Balance</a>
                      <div class="mobile-right-img"><img class="left-mobile-img" src="{{ asset('assets/images/dashboard-2/widget-img.png') }}" alt=""><img class="mobile-img" src="{{ asset('assets/images/dashboard-2/mobile.gif') }}" alt="mobile with coin"></div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card small-widget">
                    <div class="card-body primary">
                      <span class="f-light">Level</span>
                      <div class="d-flex align-items-end gap-1">
                        <h4>{{ ucfirst(auth()->user()->getRoleNames()[0]) }} <span class="fs-6"></span>
                        </h4>
                      </div>
                      <div class="bg-gradient">
                        <svg class="stroke-icon svg-fill">
                          <use href="{{ asset('assets/svg/icon-sprite.svg') }}#stroke-starter-kit"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6"> 
                  <div class="card small-widget"> 
                    <div class="card-body warning"><span class="f-light">Total Belanja</span>
                      <div class="d-flex align-items-end gap-1">
                        <h4>IDR. {{ number_format(\App\Models\Account::where('user_id', Auth()->user()->id)->sum('charge'),2,',','.') }}</h4>
                      </div>
                      <div class="bg-gradient"> 
                        <svg class="stroke-icon svg-fill">
                          <use href="{{ asset('assets/svg/icon-sprite.svg#cart') }}"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6"> 
                  <div class="card small-widget"> 
                    <div class="card-body secondary"><span class="f-light">Total Deposit</span>
                      <div class="d-flex align-items-end gap-1">
                        <h4>IDR. {{ number_format($totalDeposite,2,',','.') }}</h4>
                      </div>
                      <div class="bg-gradient"> 
                        <svg class="stroke-icon svg-fill">
                          <use href="{{ asset('assets/svg/icon-sprite.svg#new-order') }}"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6"> 
                  <div class="card small-widget"> 
                    <div class="card-body success"><span class="f-light">Bergabung</span>
                      <div class="d-flex align-items-end gap-1">
                        <h4>{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d') }}<span class="fs-6 f-light">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('M Y') }}</h4>
                      </div>
                      <div class="bg-gradient"> 
                        <svg class="stroke-icon svg-fill">
                          <use href="{{ asset('assets/svg/icon-sprite.svg#customers') }}"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-md-5 col-sm-6 box-col-5"> 
              <div class="appointment">
                <div class="card">
                  <div class="card-header card-no-border">
                    <div class="header-top">
                      <h5 class="m-0">Valuable Customer</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="appointment-table customer-table table-responsive">
                      <table class="table table-bordernone">
                        <tbody>
                          <tr>
                            <td><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('assets/images/dashboard/user/1.jpg') }}" alt="user"></td>
                            <td class="img-content-box"><a class="f-w-500" href="#">Jane Cooper</a><span class="f-light">alma.*****@gmail.com</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('assets/images/dashboard/user/2.jpg') }}" alt="user"></td>
                            <td class="img-content-box"><a class="f-w-500" href="#">Cameron Willia</a><span class="f-light">tim.j****s@gmail.com</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('assets/images/dashboard/user/9.jpg') }}" alt="user"></td>
                            <td class="img-content-box"><a class="f-w-500" href="#">Floyd Miles</a><span class="f-light">kenzi.****on@gmail.com</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('assets/images/dashboard/user/5.jpg') }}" alt="user"></td>
                            <td class="img-content-box"><a class="f-w-500" href="#">Dianne Russell</a><span class="f-light">c****s.weaver@gmail.com</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('assets/images/dashboard/user/3.jpg') }}" alt="user"></td>
                            <td class="img-content-box"><a class="f-w-500" href="#">Guy Hawkins</a><span class="f-light">curtis.w****r@gmail.com</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              
             
            
          </div>
        </div>
        
           <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h5 class="mb-1">Informasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive" style="overflow-x: unset !important">
                            <div id="informasi_wrapper" class="dataTables_wrapper no-footer">
                                <div id="informasi_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                                <table class="display dataTable no-footer" id="informasi" role="grid" style="width: 1235px;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 75px;">Tanggal</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 144px;">Subjek</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 942px;">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" class="odd">
                                            <td class="text-center">19-08-2023</td>
                                            <td class="text-center">Deposit</td>
                                            <td class="text-center">Jika deposit tidak masuk dalam 30 menit silahkan hubungi admin, jika belum ada 30 menit dimohon untuk menunggu.</td>
                                        </tr>
                                        <tr role="row" class="even">
                                            <td class="text-center">19-08-2023</td>
                                            <td class="text-center">Remote Web API</td>
                                            <td class="text-center">News AutoScript Support Remote Web API Service.</td>
                                        </tr>
                                        <tr role="row" class="even">
                                            <td class="text-center">19-08-2023</td>
                                            <td class="text-center">Users Level</td>
                                            <td class="text-center">Saat ini sistem menyediakan system users level reseller.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
@endpush