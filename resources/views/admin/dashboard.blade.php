@extends('admin.layouts.master')
@section('title', 'Welcome Admin Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
<div class="row">
    <div class="col">
        <a href="#" class="info-box hover-zoom-effect cursor-pointer" style="background-color: #d2242ad1;">
            <div class="icon">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Today Students</div>
                <div class="number text-white">{{$today_users}}</div>
            </div>
        </a>
    </div>

    <div class="col">
        <a href="#" class="info-box bg-purple hover-zoom-effect cursor-pointer">
            <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Today Fee Collection</div>
                <div class="number text-white">Rs. {{$today_fee}}</div>
            </div>
        </a>
    </div>

    <div class="col">
        <a href="#" class="info-box bg-dark hover-zoom-effect cursor-pointer">
            <div class="icon">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Today Assign Course</div>
                <div class="number text-white"> {{$today_assign}}</div>
            </div>
        </a>
    </div>

    <div class="col">
        <a href="#" class="info-box bg-pink hover-zoom-effect cursor-pointer">
            <div class="icon">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Weekly Student</div>
                <div class="number text-white">{{$weekly_users}}</div>
            </div>
        </a>
    </div>

    <div class="col">
        <a href="#" class="info-box hover-zoom-effect cursor-pointer" style="background-color: darkgoldenrod">
            <div class="icon">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Weekly Assign Course</div>
                <div class="number text-white">{{$weekly_assign}}</div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="#" class="info-box bg-dark hover-zoom-effect cursor-pointer">
            <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Weekly Fee Collection</div>
                <div class="number text-white">Rs. {{$weekly_fee}}</div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="#" class="info-box bg-pink hover-zoom-effect cursor-pointer">
            <div class="icon">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Monthly Students</div>
                <div class="number">{{$monthly_users}}</div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="#" class="info-box hover-zoom-effect cursor-pointer" style="background-color: #d2242ad1;">
            <div class="icon">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Month Assign Course</div>
                <div class="number text-white"> {{$monthly_assign}}</div>
            </div>
        </a>
    </div>


    <div class="col">
        <a href="#" class="info-box hover-zoom-effect cursor-pointer" style="background-color: darkgoldenrod">
            <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text text-white">Monthly Fee Collect</div>
                <div class="number text-white">Rs. {{$monthly_fee}}</div>
            </div>
        </a>
    </div>



    <div class="col">
        <a href="#" class="info-box bg-purple hover-zoom-effect cursor-pointer">
            <div class="icon">
                <i class="fa fa-inr"></i>
            </div>
            <div class="content">
                <div class="text text-white">Total Fee Collection</div>
                <div class="number text-white">Rs. {{$total_fee}}</div>
            </div>
        </a>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="container-highcharts"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footscript')
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var datas = <?php echo json_encode($datas); ?>;
        Highcharts.chart('container-highcharts', {
            title: {
                text: 'Mission IAS Student List in <?php echo date('Y'); ?>'
            },
            subtitle: {
                text: 'Mission IAS User List'
            },
            xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ]
            },
            yAxis: {
                title: {
                    text: 'Number of Missio IAS Students'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total Member',
                data: datas
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endpush
