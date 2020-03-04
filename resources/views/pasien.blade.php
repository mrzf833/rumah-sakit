@extends('index')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-inline-block mr-3">Daftar Pasien</h4>
                    <button class="btn btn-info" data-toggle="modal" data-target="#tambah-pasien"><i class="mdi mdi-plus"></i>Tambah Pasien</button>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Nomor hp</th>
                                    <th>Dibuat</th>
                                    <th>Diubah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pasiens)>0)
                                @foreach ($pasiens as $pasien)
                                <tr>
                                    <td>{{ $pasien->nama }}</td>
                                    <td>{{ $pasien->jenis_kelamins()->first()->jns_kelamin }}</td>
                                    <td>{{ $pasien->alamat }}</td>
                                    <td>{{ $pasien->no_hp }}</td>
                                    <td>{{ $pasien->created_at }}</td>
                                    <td>{{ $pasien->updated_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#editpasien{{ $pasien->id }}">Edit</button>
                                        <form action="{{ route('pasien.destroy',$pasien->id) }}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6"><h1>MAAF DAFTAR PASIEN BELUM ADA</h1></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- Modal tambah pasien -->
                        <div class="modal fade" id="tambah-pasien" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="">Tambah Pasien</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('pasien.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row mx-auto">
                                            <label for="nama" class="col-4 col-form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="col-8 form-control">
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="jns_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                                            <select name="jns_kelamin" id="jns_kelamin" class="col-8 form-control">
                                                <option value="">--pilih--</option>
                                                @if (!empty($jenis_kelamins))
                                                    @foreach ($jenis_kelamins as $jns)
                                                        <option value="{{ $jns->id }} ">{{ $jns->jns_kelamin }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="alamat" class="col-4 col-form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="2" class="col-8 form-control"></textarea>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="no_hp" class="col-4 col-form-label">Nomor HP</label>
                                            <input type="text" name="no_hp" id="no_hp" class="col-8 form-control">
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
                        @foreach ($pasiens as $pas)
                        <div class="modal fade" id="editpasien{{ $pas->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="">Edit Pasien</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('pasien.update',$pas->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group row mx-auto">
                                            <label for="nama" class="col-4 col-form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="col-8 form-control" value="{{ $pas->nama }}">
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="jns_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                                            <select name="jns_kelamin" id="jns_kelamin" class="col-8 form-control">
                                                <option value="">--pilih--</option>
                                                @if (!empty($jenis_kelamins))
                                                    @foreach ($jenis_kelamins as $jns)
                                                        <option value="{{ $jns->id }} " {{ ($jns->jns_kelamin == $pas->jenis_kelamins()->first()->jns_kelamin) ? 'selected' : '' }}>{{ $jns->jns_kelamin }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="alamat" class="col-4 col-form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="2" class="col-8 form-control">{{ $pas->alamat }}</textarea>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label for="no_hp" class="col-4 col-form-label">Nomor HP</label>
                                            <input type="text" name="no_hp" id="no_hp" class="col-8 form-control" value="{{ $pas->no_hp }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection