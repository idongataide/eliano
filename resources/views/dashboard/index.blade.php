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
                            <span class="info-box-number">{{ \App\Models\user::count() }}</span>
                        
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
               <div class="panel-heading"><b>Order Status Summary Chart</b></div>
               <div class="panel-body">
                   <canvas id="canvas-order-status" height="200" width="600"></canvas>
               </div>
           </div>
       </div>

       <div class="col-md-8">
           <div class="panel panel-default">
               <div class="panel-heading"><b>COLLECTION STATISTIC</b></div>
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
                                    <div class="progress" data-toggle="tooltip"
                                         title="Target:{{number_format($target,2)}}">

                                        <div class="progress-bar bg-teal progress-bar-striped active"
                                             style="width: {{$percent}}%">
                                            <span>{{$percent}}% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
           </div>
       </div>

       

       


</div>
</div>
</div>

<script src="{{ asset('assets/plugins/amcharts/amcharts.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/serial.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/pie.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/themes/light.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/plugins/export/export.min.js') }}"
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
                "title": "{{trans_choice('general.actual',1)}}",
                "type": "smoothedLine",
                "valueField": "actual"
            }, {
                "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
                "bullet": "round",
                "bulletSize": 8,
                "lineColor": "#d1655d",
                "lineThickness": 4,
                "negativeLineColor": "#d1cf0d",
                "title": "{{trans_choice('general.expected',2)}}",
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
                    "path": "{{asset('assets/plugins/amcharts/plugins/export/libs')}}/"
                }
            }, "legend": {
                "position": "bottom",
                "marginRight": 100,
                "autoMargins": false
            },


        });

    </script>

@endsection
