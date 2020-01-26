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
            <h4 class="card-title"><button type="button" class="btn btn-primary btn-fw" data-toggle="modal" data-target="#exampleModal">
                    <i class="mdi mdi-plus-outline"></i>Add Contact</button></h4>
            <p class="card-description"> Contact Details </p>
            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th> Name </th>
                  <th> Contact Number </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
              @foreach($contacts as $contact)
                <tr>
                  <td> {{$contact->name}} </td>
                  <td> {{$contact->number}} </td>
                  <td> <button type="button" class="btn btn-primary btn-fw" data-toggle="modal" data-target="#editModal{{ $contact->id }}">
                    <i class="mdi mdi-plus-outline"></i>Edit</button>
                    <a  href="contact/{{$contact->id}}/delete" type="button" class="btn btn-danger btn-fw">
                    <i class="mdi mdi-delete-outline"></i>Delete</a> </td>
                </tr>

                <div class="modal fade" id="editModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Edit Contact Number</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form class="forms-sample" method="post" action="contact/{{$contact->id}}">
				        	{{ csrf_field() }}
				        	{{ method_field('PATCH') }}
				          <div class="form-group">
				            <label for="exampleInputEmail1">Name</label>
				            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" value="{{ $contact->name }}">
				          </div>
				          <div class="form-group">
				            <label for="exampleInputPassword1">Number</label>
				            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Number" name="number" value="{{ $contact->number }}">
				          </div> 
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-success">Save changes</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
                @endforeach()
              </tbody>
            </table>
          </div>
        </div>
      </div>

              <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Contact Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" method="post" action="contact/create">
        	{{ csrf_field() }}
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Number</label>
            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Number" name="number">
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
