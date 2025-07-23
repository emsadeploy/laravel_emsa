@extends('layouts.guest')

@section('content')
   
 <div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary-subtle">
                        <div class="row">
                            <div class="col-10">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">¡Bienvenido de nuevo!</h5>
                                    <p>Inicia sesión para continuar en EMSA.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div class="auth-logo">
                            <a href="index.html" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>

                            <a href="index.html" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="/images/logo_emsa.png" alt="" class="rounded-circle" height="60">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label">Email</label>
                                    <input type="email" value="carlos@example.com" name="email" class="form-control" id="email" required autofocus>
                                </div>
        
                                <div class="mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input value="12345678" name="password" type="password" class="form-control" aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>

                                
                                
                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                </div>
                                
                            </form>
                        </div>
    
                    </div>
                </div>
               

            </div>
        </div>
    </div>
</div>

@endsection
