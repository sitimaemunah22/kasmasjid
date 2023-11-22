<DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>

    <body>
        <section class="bg-main vh-80">
            <div class="bg-main container-fluid py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100 pt-5">
                    <div class="col-md-8 col-lg-6 col-xl-4 pt-5 mt-5">
                        <div class="card bg-main shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h2 class="text-gradient">Selamat Datang Di Masjid AL-AMIN</h2>
                                    <p class="text-gradient">Silakan buat akun Anda</p>
                                </div>
                                <form action="">
                                    <!-- Username input -->


                                    <!-- Password input -->
                                    <div class="mb-3">
                                        <label for="nik" class="form-label text-gradient">NIK</label>
                                        <input type="nik" id="nik" class="form-control" name="nik" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label text-gradient">Username</label>
                                        <input type="userame" id="username" class="form-control" name="username" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label text-gradient">Password</label>
                                        <input type="password" id="password" class="form-control" name="password" required />
                                    </div>



                                    <div class="text-danger errors">
                                        <p class="err-message"></p>
                                    </div>
                                    @csrf

                                    <!-- Submit button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-gradient btn-lg btn-block">Register</button>
                                        <br> Sudah memiliki akun?</br> <a href="{{url('/login')}}">Login</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script type="module">
            $('form').submit(async function (e) {
            e.preventDefault();
            let nik = $('#nik').val();
            let username = $('#username').val();
            let password = $('#password').val();
            var _tok     = "{{csrf_token()}}"

            await axios({
                method: 'post',
                url: "{{url('/login')}}",
                data: {
                    nik : nik,
                    username : username,
                    password : password,
                    _token   : _tok
                }
            }).then(async () => {
                swal.fire({
                    title: 'Register berhasil!',
                    text: 'Redirecting to login...',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                }).then(()=>{
                    window.location.href = '/login'
                    console.log('success')}
                )
            }).catch(({response}) => {
                if (!$('.err-message').text()) {
                    $('.err-message').append(document.createTextNode(response.data.errors.message))
                }
            })

        })
    </script>
    </body>

    </html>