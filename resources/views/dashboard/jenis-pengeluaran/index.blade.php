@extends('layouts.app')
@section('title', 'Manajemen Jenis Pengeluaran')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-2">
            <a class="btn btn-gradient" href="{{url('/dashboard')}}">
                Kembali</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#tambah-jenis-pengeluaran-modal"> Tambah
            </button>
            <!-- Tambah Jenis Surat Modal -->
            <div class="modal fade" id="tambah-jenis-pengeluaran-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jaenis Pengeluaran</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-jenis-pengeluaran-form">
                                <div class="form-group">
                                    <label>Jenis Pengeluaran</label>
                                    <input placeholder="example" type="text" class="form-control mb-3"
                                           name="jenis_pengeluaran"
                                           required/>
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-gradient" form="tambah-jenis-pengeluaran-form">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hovered DataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Pengeluaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jenis_pengeluaran as $js)
                            <tr idJS="{{$js->id}}">
                                <td class="col-1">{{$js->kode jenis pengeluaran}}</td>
                                <td>{{$js->nama jenis pengeluaran}}</td>
                                <td class="col-2">
                                    <!-- Button  edit modal -->
                                    <button type="button" class="editBtn btn btn-gradient" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal-{{$js->id}}" idJS="{{$js->id}}">
                                        Edit
                                    </button>
                                    <button class="hapusBtn btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <!-- Edit Jenis Surat Modal -->
                            <div class="modal fade" id="edit-modal-{{$js->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Pengeluaran</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form id="edit-js-form-{{$js->id}}">
                                                <div class="form-group">
                                                    <label>Jenis Pengeluaran</label>
                                                    <input placeholder="example" type="text" class="form-control mb-3"
                                                           name="jenis_pengeluaran"
                                                           value="{{$js->jenis_pengeluaran}}"
                                                           required/>
                                                    @csrf
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-gradient edit-btn"
                                                    form="edit-js-form-{{$js->id}}">
                                                Edit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        /*-------------------------- TAMBAH USER -------------------------- */
        $('#tambah-jenis-pengeluaran-form').on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(e.target);
            axios.post('/dashboard/pengeluaran/jenis/tambah', Object.fromEntries(data))
                .then(() => {
                    $('#tambah-jenis-pengeluaran-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    })
                })
                .catch(() => {
                    swal.fire('Gagal tambah data!', '', 'warning');
                });
        })

        /*-------------------------- EDIT USER -------------------------- */
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idJS = $(this).attr('idJS');
            $(`#edit-js-form-${idJS}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id'] = idJS;
                axios.post(`/dashboard/pengeluaran/jenis/${idJS}/edit`, data)
                    .then(() => {
                        $(`#edit-modal-${idJS}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal tambah data!', '', 'warning');
                    })
            })
        })

        /*-------------------------- HAPUS USER -------------------------- */
        $('.table').on('click', '.hapusBtn', function () {
            let idJS = $(this).closest('tr').attr('idJS');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    //dilakukan proses hapus
                    axios.delete(`/dashboard/pengeluaran/jenis/${idJS}/delete`)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function () {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            } else {
                                swal.fire('Gagal di hapus!', '', 'warning');
                            }
                        }).catch(function (error) {
                        swal.fire('Data gagal di hapus!', '', 'error').then(function () {
                            //Refresh Halaman
                            location.reload();
                        });
                    });
                }
            });
        })
    </script>
@endsection
