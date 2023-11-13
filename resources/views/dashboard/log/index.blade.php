@extends('layouts.app')
@section('title', 'Log Activity')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-2">
            <a class="btn btn-gradient" href="{{url('/dashboard')}}">
                Kembali</a>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hovered DataTable">
                        <thead>
                        <tr>
                            <th>Log ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Log</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        ?>
                        @foreach($logs as $log)
                            <tr>
                                <td class="col-1">{{$no++}}</td>
                                <td>{{$log->username}}</td>
                                <td>{{$log->action}}</td>
                                <td>{{$log->log}}</td>
                                <td>{{$log->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable();
    </script>
@endsection
