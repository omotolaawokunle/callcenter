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

<div class="container" id="app">
    <div class="my-3">
    </div>
    <form action="/broadcast/sendBroadcast" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>Record/Upload Message</h4>
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
        <hr>
        <div class="form-group my-2">
            <h4>Choose Contacts</h4>
            @foreach($contacts as $contact)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="contacts[]" id="{{ 'contact'. $contact['id']}}" value="{{$contact}}" />
                <label class="custom-control-label py-1" for="{{ 'contact'. $contact['id']}}">{{$contact['name']}}</label>
            </div>
            @endforeach
        </div>
        <div class="my-2"><button type="submit" class="btn btn-info">Submit</button></div>
    </form>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>@endsection