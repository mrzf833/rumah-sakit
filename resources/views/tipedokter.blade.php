@extends('index')
@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline-block mr-3">Tipe Dokter</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Tipe Dokter</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @if (count($tipe_dokters)>0)
                                @foreach ($tipe_dokters as $tipe_dokter)
                                    <tr>
                                        <td>{{ $tipe_dokter->tp_dokter }}</td>
                                        <td>{{ $tipe_dokter->created_at }}</td>
                                        <td>{{ $tipe_dokter->updated_at }}</td>
                                        <td>
                                            <form action="{{ route('destroy.tipe',$tipe_dokter->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection