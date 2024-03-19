@extends('layouts/layoutMaster')

@section('title', 'Miscellaneous - Extended UI')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/clipboard/clipboard.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/idletimer/idletimer.js')}}"></script>
<script src="{{asset('assets/vendor/libs/numeral/numeral.js')}}"></script>
<script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-misc-clipboardjs.js')}}"></script>
<script src="{{asset('assets/js/extended-ui-misc-idle-timer.js')}}"></script>
<script src="{{asset('assets/js/extended-ui-misc-numeraljs.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Extended UI /</span> Miscellaneous
</h4>

<div class="row">
  <!-- Clipboard -->
  <div class="col-12">
    <div class="card mb-4">
      <h5 class="card-header">Clipboard</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4 col-sm-12 pe-0 mb-md-0 mb-2">
            <input class="form-control" id="clipboard-example" type="text" value="Copy Me!" />
          </div>
          <div class="col-md-4 col-sm-12">
            <button class="clipboard-btn btn btn-primary me-2" data-clipboard-action="copy" data-clipboard-target="#clipboard-example">
              Copy
            </button>
            <button class="clipboard-btn btn btn-primary" data-clipboard-action="cut" data-clipboard-target="#clipboard-example">
              Cut
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Clipboard -->

  <!-- Ideal Timer -->
  <div class="col-12">
    <div class="card mb-4">
      <h5 class="card-header">Ideal Timer</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 col-12 mb-md-0 mb-4">
            <p>
              Document
              <small>5 second timeout</small>
            </p>
            <div class="btn-group mb-3">
              <button type="button" id="document-Pause" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Pause</span><i class="ti ti-player-pause ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="document-Resume" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Resume</span><i class="ti ti-player-play ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="document-Elapsed" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Elapsed</span><i class="ti ti-hourglass ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="document-Init" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Init</span><i class="ti ti-plus ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="document-Destroy" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Destroy</span><i class="ti ti-x ti-xs d-sm-none"></i>
              </button>
            </div>
            <textarea rows="10" cols="30" id="document-Status" class="form-control"></textarea>
          </div>
          <div class="col-md-6 col-12">
            <p>
              Element
              <small>3 second timeout</small>
            </p>
            <div class="btn-group mb-3">
              <button type="button" id="element-Reset" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Reset</span><i class="ti ti-refresh ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="element-LastActive" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Last Active</span><i class="ti ti-clock-2 ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="element-Remaining" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">Remaining</span><i class="ti ti-device-watch-stats-2 ti-xs d-sm-none"></i>
              </button>
              <button type="button" id="element-State" class="btn btn-primary btn-sm">
                <span class="d-none d-sm-block">State</span><i class="ti ti-device-watch ti-xs d-sm-none"></i>
              </button>
            </div>
            <textarea rows="10" cols="30" id="element-Status" class="form-control"></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Ideal Timer -->

  <!-- NumeralJS -->
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">Numeral JS</h5>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table ">
            <thead>
              <tr>
                <th class="border-top-0">Input</th>
                <th class="border-top-0">Value</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>numeral(974)</td>
                <td class="dNum"></td>
              </tr>
              <tr>
                <td>numeral(1230974).format('0.0a')</td>
                <td class="fNum"></td>
              </tr>
              <tr>
                <td>numeral(1000.234).format('$0,0.00')</td>
                <td class="fCurrency"></td>
              </tr>
              <tr>
                <td>numeral(3467479682787).format('0.000 ib')</td>
                <td class="fBytes"></td>
              </tr>
              <tr>
                <td>numeral(0.974878234).format('0.000%')</td>
                <td class="fPercent"></td>
              </tr>
              <tr>
                <td>numeral(63846).format('00:00:00')</td>
                <td class="fTime"></td>
              </tr>
              <tr>
                <td>numeral(1123456789).format('0,0e+0')</td>
                <td class="fExponential"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /NumeralJS -->
</div>

@endsection
