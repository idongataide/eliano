@extends('layouts.app_admin')
@section('title', 'Dashboard')
@section('content')
<section class="content-header">
    <h1 class="pull-left">Dashboard</h1>
</section>
<div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
                <div class="box-body">
                    <div class="row">  
                    
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">TOTAL BORROWERS</span>
                            <span class="info-box-number">{{ \App\Models\loan::whereNotIn('status',
            ['pending', 'closed','declined','withdrawn', 'pending_reschedule','written_off'])->count() }}</span>
                        
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-bar-chart"></i></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">LOANS RELEASED</span>
                            <span class="info-box-number">{{ number_format(\App\Helpers\GeneralHelper::loans_total_principal(),2) }}</span>
                        
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-download"></i></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">PAYMENTS</span>
                            <span class="info-box-number">{{ number_format(\App\Helpers\GeneralHelper::loans_total_paid(),2) }}</span>
                        
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">DUE AMOUNT</span>
                            <span class="info-box-number">{{ number_format(\App\Helpers\GeneralHelper::loans_total_due(),2) }}</span>
                        
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>

                    
                </div>
             

        
</div>
</div>

<div class="row">

        <div class="col-md-4">
           <div class="panel panel-default">
               <div class="panel-heading"><b>Loan Status</b></div>
               <div class="panel-body">
                   <div class="responsive">
                        <canvas id="loan_status_pie" height="250"></canvas>
                   </div>

                    <div class="list-group no-border no-padding-top">
                        @foreach(json_decode($loan_statuses) as $key)
                            <a href="#" class="list-group-item">
                                <span class="badge bg-{{$key->class}} pull-right">{{$key->value}}</span>
                                {{$key->label}}
                            </a>
                        @endforeach
                    </div>

               </div>
           </div>
       </div>

       <div class="col-md-8">
           <div class="panel panel-default">
               <div class="panel-heading"><b>Collection Statistics</b></div>
               <div class="panel-body">
                    <?php
                            $target = 0;
                            foreach (\App\Models\loanschedule::where('year', date("Y"))->where('month',
                                date("m"))->get() as $key) {
                                $target = $target + $key->principal + $key->interest + $key->fees + $key->penalty;
                            }
                            $paid_this_month = \App\Models\loantransaction::where('transaction_type',
                                'repayment')->where('reversed', 0)->where('year', date("Y"))->where('month',
                                date("m"))->sum('credit');
                            if ($target > 0) {
                                $percent = round(($paid_this_month / $target) * 100);
                            } else {
                                $percent = 0;
                            }
                    ?>

                        <div class="container-fluid">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="content-group">
                                            <h5 class="text-semibold no-margin">{{$basic->currency_sym}}{{ number_format(\App\Models\LoanTransaction::where('transaction_type','repayment')->where('reversed', 0)->where('date',date("Y-m-d"))->sum('credit'),2) }}  </h5>
                                             <span class="text-muted text-size-small">Today</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="content-group">
                                         <h5 class="text-semibold no-margin">{{$basic->currency_sym}}{{ number_format(\App\Models\LoanTransaction::where('transaction_type','repayment')->where('reversed', 0)->whereBetween('date',array('date_sub(now(),INTERVAL 1 WEEK)','now()'))->sum('credit'),2) }} </h5>
                                         <span class="text-muted text-size-small">Last Week</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="content-group">
                                          <h5 class="text-semibold no-margin">{{$basic->currency_sym}}{{ number_format($paid_this_month,2) }} </h5>
                                          <span class="text-muted text-size-small">This Month</span>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6 class="no-margin text-semibold">Monthly Target</h6>
                                    </div>
                                    <div class="progress" data-toggle="tooltip" title="Target:{{number_format($target,2)}}">

                                        <div class="progress-bar bg-teal progress-bar-striped active"
                                             style="width: {{$percent}}%">
                                            <span>{{$percent}}% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Monthly Overview</h6>
                                </div>
                                <div class="panel-body">
                                    <div id="monthly_actual_expected_data" class="chart" style="height: 320px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     </div>

       

       


</div>
</div>
</div>

<script src="{{ asset('amcharts/amcharts.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('amcharts/serial.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('amcharts/pie.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('amcharts/themes/light.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('amcharts/plugins/export/export.min.js') }}"
            type="text/javascript"></script>
    <script>
        AmCharts.makeChart("monthly_actual_expected_data", {
            "type": "serial",
            "theme": "light",
            "autoMargins": true,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',

            "dataProvider": {!! $monthly_actual_expected_data !!},
            "valueAxes": [{
                "axisAlpha": 0,

            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
                "bullet": "round",
                "bulletSize": 8,
                "lineColor": "#370fc6",
                "lineThickness": 4,
                "negativeLineColor": "#0dd102",
                "title": "actual",
                "type": "smoothedLine",
                "valueField": "actual"
            }, {
                "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
                "bullet": "round",
                "bulletSize": 8,
                "lineColor": "#d1655d",
                "lineThickness": 4,
                "negativeLineColor": "#d1cf0d",
                "title": "expected",
                "type": "smoothedLine",
                "valueField": "expected"
            }],
            "categoryField": "month",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0,
                "labelRotation": 30,

            }, "export": {
                "enabled": true,
                "libs": {
                    "path": "{{asset('amcharts/plugins/export/libs')}}/"
                }
            }, "legend": {
                "position": "bottom",
                "marginRight": 100,
                "autoMargins": false
            },


        });

    </script>
    <script src="{{ asset('chartjs/Chart.min.js') }}"    type="text/javascript"></script>
    <script>
        var ctx3 = document.getElementById("loan_status_pie").getContext("2d");
        var data3 ={!! $loan_statuses !!};
        var myPieChart = new Chart(ctx3).Pie(data3, {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 0,
            animationSteps: 100,
            tooltipCornerRadius: 0,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,

            legend: {
                display: true,
                labels: {
                    fontColor: 'rgb(255, 99, 132)'
                }
            }
        });
    </script>

@endsection
