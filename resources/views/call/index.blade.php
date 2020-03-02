@extends('layouts.web')

@section('content')
<style scoped>
    .flex {
        display: flex;
    }

    .items-center {
        align-items: center;
    }

    .justify-between {
        justify-content: space-between;
    }

    .vl {
        border-left: 2px solid #ccc;
        position: relative;
        display: inline-block;
        height: 50px;
    }

    .vl .text {
        position: absolute;
        left: -10px;
        top: 10px;
        background: #F3F3F3;
        padding: 2px;
    }

    @media (max-width: 768px) {
        .vl {
            border-left-width: 0px;
            border-top: 2px solid #ccc;
            height: auto;
            width: 100%;
        }

        .vl .text {
            position: absolute;
            left: 50%;
            top: -15px;
            background: #F3F3F3;
            padding: 2px;
        }
    }

    .text-sm {
        font-size: 12px;
    }
</style>


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

<div class="col-lg-12 grid-margin stretch-card" id="app">
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

                <div class="row my-2">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Upload an Audio file</label>
                            <file-input name="audio"></file-input>
                            <span class="text-sm"><b>wav, ogg, mp3 are the only extensions supported</b></span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="vl">
                            <p class="text"><b>OR</b></p>
                        </div>
                    </div>
                    <div class="col-md-5 py-1">
                        <record-audio></record-audio>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact">Contacts</label>
                    <select name="contact" class="form-control">
                        <option value="0">All</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endsection
