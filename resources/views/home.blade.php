@extends('layouts.web')

@section('content')
<div class="row">
<div class="col-md-4 grid-margin stretch-card average-price-card">
    <div class="card text-white">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-2 align-items-center">
          <h2 class="font-weight-semibold mb-0">4</h2>
          <div class="icon-holder">
            <i class="mdi mdi-phone-outline"></i>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Total Offered</h5>
          <p class="text-white mb-0">Total Queue calls</p>
        </div>
      </div>
    </div>
</div>

<div class="col-md-4 grid-margin stretch-card average-price-card">
    <div class="card text-white">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-2 align-items-center">
          <h2 class="font-weight-semibold mb-0">3</h2>
          <div class="icon-holder">
            <i class="mdi mdi-phone-incoming"></i>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Answered</h5>
          <p class="text-white mb-0">Answered Queue calls</p>
        </div>
      </div>
    </div>
</div>

<div class="col-md-4 grid-margin stretch-card average-price-card">
    <div class="card text-white">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-2 align-items-center">
          <h2 class="font-weight-semibold mb-0">1</h2>
          <div class="icon-holder">
            <i class="mdi mdi-phone-missed"></i>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Abandoned</h5>
          <p class="text-white mb-0">Abandoned Queue calls</p>
        </div>
      </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-md-4 grid-margin stretch-card average-price-card">
    <div class="card text-white">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-2 align-items-center">
          <h2 class="font-weight-semibold mb-0">00:40:25</h2>
          <div class="icon-holder">
            <i class="mdi mdi-phone-outline"></i>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Average Talktime</h5>
          <p class="text-white mb-0">Queue calls talktime</p>
        </div>
      </div>
    </div>
</div>

<div class="col-md-4 grid-margin stretch-card average-price-card">
    <div class="card text-white">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-2 align-items-center">
          <h2 class="font-weight-semibold mb-0">80%</h2>
          <div class="icon-holder">
            <i class="mdi mdi-phone-incoming"></i>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Average answer rate</h5>
          <p class="text-white mb-0">Queue calls answer rate</p>
        </div>
      </div>
    </div>
</div>

<div class="col-md-4 grid-margin stretch-card average-price-card">
    <div class="card text-white">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-2 align-items-center">
          <h2 class="font-weight-semibold mb-0">20%</h2>
          <div class="icon-holder">
            <i class="mdi mdi-phone-missed"></i>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Average abandon rate</h5>
          <p class="text-white mb-0">Queue calls answer rate</p>
        </div>
      </div>
    </div>
</div>
</div>
@endsection
