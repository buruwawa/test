@extends('layouts.app')
@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="tc_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @role('Admin|Sales|Account')
                        <div class="row">

                            <div class="col-lg-6 col-xl-4">
                                <div class="card card-custom gutter-b bg-white border-0 ">

                                    <div class="card-body">
                                        <h3 class="text-body font-weight-bold">Report1</h3>

                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-dark font-weight-bold font-size-h1 mr-3">
                                        Tsh. <span
                                            class="" data-target="400">
                                        {{ number_format(  $thedaily->daily_sales+$collection_daily) }}</span>
                                    </span>
                                </div>
                                <div class="text-black-50 mt-3">
                                    <span class="font-weight-bold text-dark">  Cash</span>
                                    <span class="btn-sm bg-secondary">
                                    <a href="{{ route('transactions','daily') }}">
                                          <span class="text-white">
                                        {{ number_format(  $thedaily->daily_cash) }} </span></a>
                                </span> &nbsp;
                                <span class="float-right">
                                    <span class="font-weight-bold text-dark">Payment</span>
                                <span class="btn-sm bg-primary text-white ">
                                    {{ number_format( $collection_daily) }}
                                </span>
                                </span>
                                <hr>
                                <span>
                                    <span class="font-weight-bold text-dark">Credit</span>
                                <span class="btn-sm bg-danger ">
                                    <a href="#">
                                    <span class="text-white">  {{ number_format($thedaily->daily_balance) }} </span>
                                </a>
                            </span>
                            </span>
                            &nbsp;
                                <span class="float-right" >
                                    <span class="font-weight-bold text-dark">Profit</span>
                                <span class="btn-sm  bg-success">
                                    <a href="#">
                         <span class="text-white">
                             {{ number_format($daily_profits->total_selling - $daily_profits->total_buying) }}
                            </span>
                            </span>
                                </a>
                            </span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card card-custom gutter-b bg-white border-0 ">

                                    <div class="card-body">
                                        <h3 class="text-body font-weight-bold">Report2</h3>

                                        <div class="mt-3">
                                            <div class="d-flex align-items-center">
                                                <span class="text-dark font-weight-bold font-size-h1 mr-3">Tsh. <span
                                                        class="" data-target="6000">
                                                    {{ number_format($theweekly->weekly_sales+$collection_weekly) }}</span></span>
                                            </div>
                                            <div class="text-black-50 mt-3">
                                                <span class="font-weight-bold text-dark">Cash</span>
                                                <span class="btn-sm bg-secondary">
                                                <a href="{{ route('transactions','weekly') }}">
                                                    <span class="text-white">{{ number_format($theweekly->weekly_cash) }}  </span></a>
                                            </span> &nbsp;
                                            <span class="float-right">
                                                <span class="font-weight-bold text-dark">  Payment</span>
                                            <span class="btn-sm bg-primary text-white float-right"> {{ number_format( $collection_weekly) }}
                                                </span>
                                                </span>
                                                <hr>

                                            <span>
                                                <span class="font-weight-bold text-dark">Credit</span>
                                                <span class="btn-sm bg-danger ">
                                                <a href="#"> <span class="text-white"> {{ number_format($theweekly->weekly_balance) }} </span></a>
                                            </span>
                                            </span>
                                                &nbsp;
                                                <span class="float-right" >
                                                    <span class="font-weight-bold text-dark">Profit</span>
                                                    <span class="btn-sm  bg-success">
                                                        <a href="#">
                                             <span class="text-white">
                                                        {{ number_format($weekly_profits->total_selling - $weekly_profits->total_buying) }}
                                                       </span>
                                                           </a>
                                                       </span>
                                                       </span>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card card-custom gutter-b bg-white border-0">

                                    <div class="card-body">
                                        <h3 class="text-body font-weight-bold">Report3</h3>

                                        <div class="mt-3">
                                            <div class="d-flex align-items-center">
                                                <span class="text-dark font-weight-bold font-size-h1 mr-3">
                                                    <span >Tsh.
                                                    {{ number_format($themonthly->monthly_sales+$collection_monthly) }}</span></span>
                                            </div>
                                            <div class="text-black-50 mt-3">
                                                <span class="font-weight-bold text-dark">Cash</span>
                                                <span class="btn-sm bg-secondary">
                                                <a href="{{ route('transactions','monthly') }}">
                                                    <span class="text-white">
                                                    {{ number_format($themonthly->monthly_cash) }}
                                                </span></a>
                                            </span> &nbsp;
                                            <span class="float-right" >
                                              <span class="font-weight-bold text-dark">Payment  </span>
                                            <span class="btn-sm bg-primary text-white float-right"> {{ number_format( $collection_monthly) }}
                                                </span>
                                                </span>
                                                <hr>

                                            <span>
                                                <span class="font-weight-bold text-dark">Credit</span>
                                                <span class="btn-sm bg-danger ">
                                                <a href="#"> <span class="text-white">{{ number_format($themonthly->monthly_balance) }}</span></a>
                                            </span>
                                            </span>

                                                &nbsp;
                                                <span class="float-right">
                                                    <span class="font-weight-bold text-dark">Profit</span>
                                                    <span class="btn-sm  bg-success">
                                                        <a href="#">
                                             <span class="text-white">
                                                        {{ number_format(
                                                            $monthly_profits->total_selling - $monthly_profits->total_buying) }}
                                                       </span>
                                                           </a>
                                                       </span>
                                                       </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                              <div class="col-lg-8 col-xl-8">
                                <div class="card card-custom gutter-b bg-white border-0">
                                                <div class="card-header align-items-center  border-0">
                                                    <div class="card-title mb-0">
                                                        <h3 class="card-label text-body font-weight-bold mb-0">Report4 <span class="text-success"> Tsh. 300,000,000 </span>
                                                        </h3>
                                                    </div>

                                                </div>
                                                <div class="card-body pt-3">
                                                    <div id="chart-4">
                                                    </div>
                                                </div>
                                            </div>
                              </div>
                        
                            <div class="col-lg-4 col-xl-4">
                                            <div class="card card-custom gutter-b bg-white border-0">
                                                <div class="card-header align-items-center  border-0">
                                                    <div class="card-title mb-0">
                                                        <h3 class="card-label text-body font-weight-bold mb-0">Report4
                                                        </h3>
                                                    </div>

                                                </div>
                                                <div class="card-body px-0">
                                                    <ul class="list-group scrollbar-1" style="height: 300px;">
                                                      <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
                                                        <div class="list-left d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-primary text-white mr-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-lightning-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
                                                                  </svg>
                                                              </span>
                                                          <div class="list-content">
                                                            <span class="list-title text-body">Pending Orders</span>
                                                            <small class="text-muted d-block">
                                                                <span> <a href="/order">
                                                                {{ $pending_orders }}
                                                            </a> </span> orders</small>
                                                          </div>

                                                        </div>
                                                        <span>
                                                            <span> <a href="/order">
                                                            {{ $pending_orders }}
                                                        </a> </span>
                                                    </span>
                                                      </li>
                                                      <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
                                                        <div class="list-left d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-secondary text-white mr-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-bar-chart-line-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
                                                                  </svg>
                                                              </span>
                                                          <div class="list-content">
                                                            <span class="list-title text-body">Stock alert</span>
                                                            <small class="text-muted d-block">39.4k New Sales</small>
                                                          </div>
                                                        </div>
                                                        <span>26M</span>
                                                      </li>
                                                      <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
                                                        <div class="list-left d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-success text-white mr-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-credit-card-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4z"/>
                                                                    <path fill-rule="evenodd" d="M0 7v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H3z"/>
                                                                  </svg>
                                                              </span>
                                                          <div class="list-content">
                                                            <span class="list-title text-body">Company Value</span>
                                                            <small class="text-muted d-block">43.5k New Revenue</small>
                                                          </div>
                                                        </div>
                                                        <span>15.89M</span>
                                                      </li>

                                                      <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
                                                        <div class="list-left d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-warning text-white mr-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-lightning-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
                                                                  </svg>
                                                              </span>
                                                          <div class="list-content">
                                                            <span class="list-title text-body">Fast moving product</span>
                                                            <small class="text-muted d-block">New Users</small>
                                                          </div>
                                                        </div>
                                                        <span>1.2k</span>
                                                      </li>
                                                      <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
                                                        <div class="list-left d-flex align-items-center">
                                                            <span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-info text-white mr-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-lightning-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
                                                                  </svg>
                                                              </span>
                                                          <div class="list-content">
                                                            <span class="list-title text-body">Top sales shop</span>
                                                            <small class="text-muted d-block">New Visits</small>
                                                          </div>
                                                        </div>
                                                        <span>4.6k</span>
                                                      </li>
                                                    </ul>
                                                  </div>
                                              </div>
                                        </div>
                            @isset($pending_orders )

										{{--  <div class="col-lg-6  col-xl-8">
											<div class="card card-custom gutter-b bg-white border-0">
												<div class="card-header align-items-center  border-0">
													<div class="card-title mb-0">
														<h3 class="card-label text-body font-weight-bold mb-0">Report5 <span class="text-success"> Tsh. 300,000,000 </span>
														</h3>
													</div>

												</div>
												<div class="card-body pt-3">
													<div id="chart-4">
													</div>
												</div>
											</div>
										</div>


										<div class="col-lg-6 col-xl-4">
											<div class="card card-custom gutter-b bg-white border-0">
												<div class="card-header align-items-center  border-0">
													<div class="card-title mb-0">
														<h3 class="card-label text-body font-weight-bold mb-0">Last Update
														</h3>
													</div>

												</div>
												<div class="card-body px-0">
													<ul class="list-group scrollbar-1" style="height: 300px;">
													  <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
														<div class="list-left d-flex align-items-center">
															<span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-primary text-white mr-2">
																<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-lightning-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
																  </svg>
															  </span>
														  <div class="list-content">
															<span class="list-title text-body">Pending Orders</span>
															<small class="text-muted d-block">
                                                                <span> <a href="/order">
                                                                {{ $pending_orders }}
                                                            </a> </span> orders</small>
														  </div>

														</div>
														<span>
                                                            <span> <a href="/order">
                                                            {{ $pending_orders }}
                                                        </a> </span>
                                                    </span>
													  </li>
													  <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
														<div class="list-left d-flex align-items-center">
															<span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-secondary text-white mr-2">
																<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-bar-chart-line-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
																  </svg>
															  </span>
														  <div class="list-content">
															<span class="list-title text-body">Stock alert</span>
															<small class="text-muted d-block">39.4k New Sales</small>
														  </div>
														</div>
														<span>26M</span>
													  </li>
													  <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
														<div class="list-left d-flex align-items-center">
															<span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-success text-white mr-2">
																<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-credit-card-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4z"/>
																	<path fill-rule="evenodd" d="M0 7v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H3z"/>
																  </svg>
															  </span>
														  <div class="list-content">
															<span class="list-title text-body">Company Value</span>
															<small class="text-muted d-block">43.5k New Revenue</small>
														  </div>
														</div>
														<span>15.89M</span>
													  </li>

													  <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
														<div class="list-left d-flex align-items-center">
															<span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-warning text-white mr-2">
																<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-lightning-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
																  </svg>
															  </span>
														  <div class="list-content">
															<span class="list-title text-body">Fast moving product</span>
															<small class="text-muted d-block">New Users</small>
														  </div>
														</div>
														<span>1.2k</span>
													  </li>
													  <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between py-2">
														<div class="list-left d-flex align-items-center">
															<span class="d-flex align-items-center justify-content-center rounded svg-icon w-45px h-45px bg-info text-white mr-2">
																<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-lightning-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
																  </svg>
															  </span>
														  <div class="list-content">
															<span class="list-title text-body">Top sales shop</span>
															<small class="text-muted d-block">New Visits</small>
														  </div>
														</div>
														<span>4.6k</span>
													  </li>
													</ul>
												  </div>
											  </div>
										</div>  --}}
                            @endisset

                        </div>
                        @endrole
                        @role('')
                        <div class="alert alert-info">You do not have permission, kindly contact system admin</div>
                        @endrole
                    </div>

                </div>
            </div>

        </div>
    </div>



    @endsection


