

@include('includes.css')
<div class="login-container">
    <!-- Login box start -->
    <form id="login-form">
        @csrf
        <div class="login-box">
            <div class="login-form">
                <a href="#" class="login-logo">
                    <img src="images/images.png" alt="Logo" />
                </a>
                <div class="login-welcome">
                    Bienvenido, <br />Por favor ingrese sus credenciales de acceso.
                </div>
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input wire:model="form.email" id="email" class="block mt-1 w-full form-control" type="email" name="email" required autofocus autocomplete="username">
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Contraseña</label>
                        <!-- <a href="forgot-password.html" class="btn-link ml-auto">Forgot password?</a> -->
                    </div>
                    <input wire:model="form.password" id="password" class="block mt-1 w-full form-control"
                        type="password"
                        name="password"
                        required autocomplete="current-password">
                </div>
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                    </label>
                </div>
                <div class="login-form-actions">
                    <button type="submit" class="btn"> <span class="icon"> <i class="bi bi-arrow-right-circle"></i> </span>
                        Ingresar</button>
                </div>
                @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- <div class="login-form-footer">
                    <div class="additional-link">
                        Don't have an account? <a href="#"> Signup</a>
                    </div>
                </div> -->
            </div>
        </div>
    </form>
</div>
@include('includes.js')
<script>
$(document).ready(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault(); // Previene el envío normal del formulario

        // Obtiene los datos del formulario
        var email = $('#email').val();
        var password = $('#password').val();
        var remember = $('#remember').is(':checked') ? 1 : 0;

        // Realiza la solicitud AJAX
        $.ajax({
            url: '{{ route("authenticate") }}', // Asegúrate de que esta ruta esté definida en tus rutas
            method: 'POST',
            data: {
                email: email,
                password: password,
                remember: remember,
                _token: '{{ csrf_token() }}' // Incluye el token CSRF
            },
            success: function(response) {
                // Redirige a la vista de dashboard si la autenticación es exitosa
                window.location.href = response.redirect;
            },
            error: function(xhr) {
                // Maneja errores, muestra un mensaje si las credenciales son incorrectas
                var errorMessage = xhr.responseJSON.error;
                alert(errorMessage); // Puedes mostrarlo en un elemento HTML en lugar de una alerta
            }
        });
    });
});
</script>