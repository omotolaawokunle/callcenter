@extends('layouts.web')

@section('content')

    @if (session('success'))
      <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('success') }}
      </div>
    @elseif (session('error'))
      <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('error') }}
      </div>
    @endif

	<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Blast Audio</h4>
            <!-- <p class="card-description"> Blast SMS </p> -->
            <form class="forms-sample" method="post" action="call/create" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                  </div>

                  <div class="form-group">
                      <label for="exampleTextarea1">Audio File</label>
                      <input class="form-control" id="exampleTextarea1" type="file" name="audio"></input>
                  </div>

                  <div class="form-group">
                    <label for="contact">Contacts</label>
                    <select name="contact" class="form-control">
                      <option value="0">All</option>
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Send</button>
              </div>
            </form>
          </div>
        </div>
@endsection
