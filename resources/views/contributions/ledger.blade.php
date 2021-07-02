@extends('layouts.app_admin')
@section('title', 'Contribution Ledger')
@section('content')
<section class="content-header">
    <h1 class="pull-left">Contribution Ledger</h1>
    <div class="row">
    {!! Form::open(['route' => 'postcontributionledger']) !!}
    <div class="col-lg-12">
            <div class="controls form-inline well">

            <div class="form-group">
                <label class="col-md-4 col-xs-12 control-label">Start Date:</label>
                <div class="col-sm-8 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                        <input type="text" class="form-control datepicker" required name="start_date" value="{{ $start_date }}" >
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 col-xs-12 control-label">End Date:</label>
                <div class="col-sm-8 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                        <input type="text" class="form-control datepicker" required name="end_date" value="{{ $end_date }}" >
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">View</button>
              </div>
            </div>

            {!! Form::close() !!}
        </div>
</section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                   <div id="wdr-trans_summary"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('backend/webdata/webdatarocks.toolbar.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('backend/webdata/webdatarocks.js') }}"></script>
    <link href="{{ asset('backend/webdata/webdatarocks.min.css') }}" rel="stylesheet" />

    <script>
	 
    var d = new Date();
    var n = d.getFullYear();
    var pivot = new WebDataRocks({
        container: "#wdr-trans_summary",
		beforetoolbarcreated: customizeToolbar,
        toolbar: true,
		height: 600,
        report: {
            dataSource: {
               data : getData()
        },
        "slice": {
        "rows": [
            {
                "uniqueName": "registration_no"
            }
        ],
        "columns": [
            {
                "uniqueName": "Measures"
            },
            {
                "uniqueName": "payment_date"
            },
            {
                "uniqueName":"registration_no"
            },
            {
                "uniqueName":"name"
            },
            {
                "uniqueName":"plan"
            },
            {
                "uniqueName": "amount"
            }
        ],
        "measures": [
            {
                "uniqueName": "amount",
                "aggregation": "sum"
            }
        ],
        "expands": {
            "rows": [
                {
                    "tuple": [
                        "payment_date"
                    ]
                }
            ]
        }
    },
    "options": {
        "grid": {
            "type": "flat",
            "showTotals": "off"
        }
    },
    "conditions": [
        {
            "formula": "#value > 0",
            "format": {
                "backgroundColor": "#FFFFFF",
                "color": "#000000",
                "fontFamily": "arial",
                "fontSize": "12px"
            }
        }
    ],
    "formats": [
        {
            "name": "",
            "thousandsSeparator": ",",
            "decimalSeparator": ".",
            "decimalPlaces": 2,
            "currencySymbol": "",
            "currencySymbolAlign": "right",
            "nullValue": "",
            "textAlign": "right",
            "isPercent": false
        }
    ],
    "tableSizes": {
        "columns": [
            {
                "idx": 0,
                "width": 152
            },
            {
                "idx": 1,
                "width": 126
            }
        ]
    }
}
});
	  

function getData() {
    let data = {!! json_encode($data) !!};
    let results = JSON.parse(data);   
	return jsonDataanaylysis = results;
}
 function customizeToolbar(toolbar) {
    var tabs = toolbar.getTabs(); // get all tabs from the toolbar
    toolbar.getTabs = function() {
        delete tabs[0]; //connect
		delete tabs[1]; //open
		delete tabs[2];// save
		//delete tab[3];//export
		delete tabs[4]; //format
		delete tabs[5]; //options
		delete tabs[6]; //field
		//delete tab[7]; //full screen
        return tabs;
    }
}         
    </script>
@endsection