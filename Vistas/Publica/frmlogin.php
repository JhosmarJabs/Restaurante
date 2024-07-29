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
                    <input type="email" name="txtEmailI" id="" required>
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPasswordI" id="" required>
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
                    <input type="text" name="txtNombre" id="" required>
                    <label>Nombre</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txtApellido" id="" required>
                    <label>Apellidos</label>
                </div>
                <div class="input-box">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="text" name="txtTelefono" required>
                        <label>Telefono</label>
                    </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="txtEmail" id="" required>
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPassword" id="" required>
                    <label>Contraseña</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="txtconditions" id="" require> Acepto los terminos y condiciones</label>
                </div>
                <button type="submit" class="btn">Registrarme</button>
                <div class="login-register">
                    <p>Ya tienes una cuenta? <a href="#" class="login-link">Iniciar sesion</a></p>
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
