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
                    <input type="email" name="txtEmail" id="" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPassword" id="" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="txtremember" id=""> Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    
        <div class="form-box register">
            <h2>Registrate</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txtuser" id="" required>
                    <label>User</label>
                </div>
                <div class="input-box">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="text" name="txtcall" required>
                        <label>phone</label>
                    </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="txtemail" id="" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtpassword" id="" required>
                    <label>Password</label>x
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="txtconditions" id=""> i agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="login-link">login</a></p>
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
