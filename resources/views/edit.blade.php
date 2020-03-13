@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Data
                </div>
                {{ Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) }}
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger text-left">
                        Oops, telah terjadi beberapa kesalahan:
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="timer well" style="font-size: 50px"></div>
                            <p>
                                <button type="button" class="btn btn-default" onClick="$('.timer').countimer('start');">Start</button>
                                <button type="button" class="btn btn-warning" onClick="$('.timer').countimer('stop');">Stop</button>
                                <button type="button" class="btn btn-success" onClick="$('.timer').countimer('resume');">Resume</button></p>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('Nama', 'Nama') }}
                        {{ Form::text('name', $user->name, ['class'=>'form-control', 'placeholder' => 'Nama Anda']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Email', 'Email') }}
                        {{ Form::text('email', $user->email, ['class'=>'form-control', 'placeholder' => 'Email Anda']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Alamat', 'Alamat') }}
                        {{ Form::textarea('address', $user->address, ['class'=>'form-control', 'placeholder' => 'Nama Anda']) }}</div>
                    <div class="form-group">
                        {{ Form::label('Nilai', 'Nilai') }}
                        <div class="row">
                            <div class="col-md-10">
                                {{ Form::number('nilai', $user->nilai, ['class'=>'form-control', 'placeholder' => 'Nilai', 'id' => 'nilai']) }}
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="generate_nilai" class="btn btn-secondary float-right">Generate Nilai</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-info">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{ asset('countimer/dist/ez.countimer.js') }}"></script>
<script type="text/javascript">
$( document ).ready(function() {
    $('.timer').countimer({
        autoStart : false
    });
    $("#generate_nilai").click(function(){
        var nilai = Math.floor(Math.random() * 50) + 50;
        $("#nilai").val(nilai);
    });
});
</script>
@endsection