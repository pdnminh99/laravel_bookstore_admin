@extends('layouts.admin')

@section('content')

    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    @include('containers.breadcrumb')
                    {{--                    @include('components.control')--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-8">
                <x-card>
                    @slot('card_header')
                        Custom Header
                    @endslot

                    @slot('card_sub_header')
                        Custom Sub Header
                    @endslot

                    @slot('card_body')
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                        </div>
                    @endslot
                </x-card>
            </div>
            <div class="col-xl-4">
                <x-card>
                    @slot('card_header')
                        Custom Header
                    @endslot

                    @slot('card_sub_header')
                        Custom Sub Header
                    @endslot

                    @slot('card_body')
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas"></canvas>
                        </div>
                    @endslot
                </x-card>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <x-card>
                    @slot('card_header')
                        Responsive table
                    @endslot

                    @slot('card_sub_header')
                        Custom Sub Header
                    @endslot

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Page name</th>
                                <th scope="col">Visitors</th>
                                <th scope="col">Unique users</th>
                                <th scope="col">Bounce rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">/argon/</th>
                                <td>4,569</td>
                                <td>340</td>
                                <td>
                                    <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">/argon/index.html</th>
                                <td>3,985</td>
                                <td>319</td>
                                <td>
                                    <i class="fas fa-arrow-down text-warning mr-3"></i>
                                    46,53%
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">/argon/charts.html</th>
                                <td>3,513</td>
                                <td>294</td>
                                <td>
                                    <i class="fas fa-arrow-down text-warning mr-3"></i>
                                    36,49%
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">/argon/tables.html</th>
                                <td>2,050</td>
                                <td>147</td>
                                <td>
                                    <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">/argon/profile.html</th>
                                <td>1,795</td>
                                <td>190</td>
                                <td>
                                    <i class="fas fa-arrow-down text-danger mr-3"></i>
                                    46,53%
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
            <div class="col-xl-4">
                <x-card>
                    @slot('card_header')
                        Responsive table
                    @endslot

                    @slot('card_sub_header')
                        Custom Sub Header
                    @endslot

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Referral</th>
                                <th scope="col">Visitors</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Facebook</th>
                                <td>1,480</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">60%</span>
                                        <div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-gradient-danger"
                                                    role="progressbar"
                                                    aria-valuenow="60"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width: 60%"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Facebook</th>
                                <td>5,480</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">70%</span>
                                        <div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-gradient-success"
                                                    role="progressbar"
                                                    aria-valuenow="70"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width: 70%"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Google</th>
                                <td>4,807</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">80%</span>
                                        <div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-gradient-primary"
                                                    role="progressbar"
                                                    aria-valuenow="80"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width: 80%"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Instagram</th>
                                <td>3,678</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">75%</span>
                                        <div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-gradient-info"
                                                    role="progressbar"
                                                    aria-valuenow="75"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width: 75%"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">twitter</th>
                                <td>2,645</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">30%</span>
                                        <div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-gradient-warning"
                                                    role="progressbar"
                                                    aria-valuenow="30"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width: 30%"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
        </div>
    </div>

@endsection
