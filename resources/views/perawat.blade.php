@extends('index')
@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline-block mr-3">Daftar Perawat</h4>
                <button class="btn btn-info" data-toggle="modal" data-target="#tambahPerawat"><i class="mdi mdi-plus"></i>Tambah Perawat</button>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Nama</th>
                            <th>Dokter</th>
                            <th>Jenis Kelamin</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                        <tbody>
                            @if (!empty($perawats))
                                @foreach ($perawats as $perawat)
                                    <tr>
                                        <td>{{ $perawat->nama }}</td>
                                        <td>{{ $perawat->dokters()->first()->nama ?? 'belum ada dokter'}}</td>
                                        <td>{{ $perawat->jenis_kelamins()->first()->jns_kelamin }}</td>
                                        <td>{{ $perawat->created_at }}</td>
                                        <td>{{ $perawat->updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-target="#perawatEdit{{ $perawat->id }}" data-toggle="modal">Edit</button>
                                            <form action="{{ route('perawat.destroy',$perawat->id) }}" method="post" class="d-inline-block">
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
                    @if (!empty($perawats))
                        @foreach ($perawats as $perawat)
                        <!-- Modal edit perawat-->
                        <div class="modal fade" id="perawatEdit{{ $perawat->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="">Edit Perawat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('perawat.update',$perawat->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group row mx-auto">
                                            <label for="nama" class="col-4 col-form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="col-8 form-control" value="{{ $perawat->nama }}">
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="dokter" class="col-4 col-form-label">dokter</label>
                                            <select name="dokter" id="dokter" class="col-8 form-control">
                                                <option value="">--pilih--</option>
                                                @if (count($dokters)>0)
                                                    @foreach ($dokters as $dokter)
                                                        <option value="{{$dokter->id}}" {{ ($dokter->nama == ( $perawat->dokters()->first()->nama ?? '')) ? 'selected' : ''}}>{{$dokter->nama}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="col-8 form-control">
                                                <option value="">--pilih--</option>
                                                @if (count($jns_kelamins)>0)
                                                    @foreach ($jns_kelamins as $jns_kelamin)
                                                        <option value="{{$jns_kelamin->id}}" {{ ($jns_kelamin->jns_kelamin == $perawat->jenis_kelamins()->first()->jns_kelamin) ? 'selected' : ''}}>{{$jns_kelamin->jns_kelamin}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <!-- Modal tambah perawat-->
                    <div class="modal fade" id="tambahPerawat" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="">Tambah Perawat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('perawat.store') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group row mx-auto">
                                        <label for="nama" class="col-4 col-form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="col-8 form-control" value="">
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label for="dokter" class="col-4 col-form-label">dokter</label>
                                        <select name="dokter" id="dokter" class="col-8 form-control">
                                            <option value="">--pilih--</option>
                                            @if (count($dokters)>0)
                                                @foreach ($dokters as $dokter)
                                                    <option value="{{$dokter->id}}">{{$dokter->nama}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="col-8 form-control">
                                            <option value="">--pilih--</option>
                                            @if (count($jns_kelamins)>0)
                                                @foreach ($jns_kelamins as $jns_kelamin)
                                                    <option value="{{$jns_kelamin->id}}">{{$jns_kelamin->jns_kelamin}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection