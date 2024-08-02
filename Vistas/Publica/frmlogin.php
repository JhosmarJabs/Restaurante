    <div class="container-login">
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>
        <div class="form-box login">
            <h2>Iniciar sesion</h2>
            <form action="/restaurante/index?clase=controladorpublico&metodo=login" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="txtEmailI" id="" class="patron-correo requerido">
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPasswordI" id="" required >
                    <label>Contraseña</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="txtremember" id=""> Recordar</label>
                    <a href="#">Olvidaste la contraseña?</a>
                </div>
                <button type="submit" class="btn">Iniciar Sesion</button>
                <div class="login-register">
                    <p>Aun no tienes cuenta? <a href="#" class="register-link">Resgistrate</a></p>
                </div>
            </form>
        </div>
        <div class="form-box register">
            <h2>Registro</h2>
            <form action="/restaurante/index?clase=controladorpublico&metodo=register" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txtNombre" id="" required pattern="^[a-zA-Z\s]+$" title="El nombre solo debe contener letras y espacios." maxlength="20">
                    <label>Nombre</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txtApellido" id="" required pattern="^[a-zA-Z\s]+$" title="Los apellidos solo deben contener letras y espacios." maxlength="20">
                    <label>Apellidos</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                    <input type="tel" name="txtTelefono" required pattern="^\d{10}$" title="El número de teléfono debe contener 10 dígitos." maxlength="13">
                    <label>Teléfono</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="txtEmail" id="" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor ingrese un correo válido." maxlength="25">
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPassword" id="" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número." maxlength="25">
                    <label>Contraseña</label>
                </div>
                <div class="remember-forgot">
                <label><input type="checkbox" name="txtconditions" id="" required> Acepto los términos y condiciones</label>
                </div>
                    <button type="submit" class="btn">Registrarme</button>
                <div class="login-register">
                    <p>¿Ya tienes una cuenta? <a href="#" class="login-link">Iniciar sesión</a></p>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <script>
        const wrapper = document.querySelector('.wrapper');
        const loginLink = document.querySelector('.login-link');
        const registerLink = document.querySelector('.register-link');
        const btnPopup = document.querySelector('.btnLogin-popup');
        const iconClose = document.querySelector('.icon-close');

        registerLink.addEventListener('click', () => {
        wrapper.classList.add('active');
        });

        loginLink.addEventListener('click', () => {
        wrapper.classList.remove('active');
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
