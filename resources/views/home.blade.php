@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    My Date
                    <a href="{{ route('user.create') }}" class="btn btn-primary float-right">Input Data</a>
                </div>

                <div class="card-body">
                    <?php
                        if($msg_success = Session::get('success')){
                            $class = "alert alert-success alert-dismissable";
                            $msg = $msg_success;
                        } else if($msg_info = Session::get('info')){
                            $class = "alert alert-info alert-dismissable";
                            $msg = $msg_info;
                        } else if($msg_warning = Session::get('warning')){
                            $class = "alert alert-warning alert-dismissable";
                            $msg = $msg_warning;
                        } else {
                            $class = "d-none";
                            $msg = "";
                        }
                    ?>
                    <div class="{{ $class }}" id="alert-msg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ $msg }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                
                                    <th width="20" class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Nilai</th>    
                                    <th class="text-center">Action</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td width="20" class="text-center">{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="nilai">{{ $item->nilai }}</span></td>
                                    <td class="text-center" style="width:100px">
                                        <div class="btn-group">
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ url('user/destroy/'.$item->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger btn-sm">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var nilai = $("td.nilai");
    // console.log(nilai[0]);
    
    for(var i = 0; i < nilai.length; i++){
        console.log(nilai[i]);
        // var test = $(nilai[i]).text();
        
        if($(nilai[i]).text() > 60){
            $(nilai[i]).addClass("green");
        } else {
            $(nilai[i]).addClass("red");
        }
    }
});
</script>
@endsection