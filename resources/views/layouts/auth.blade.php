@include('partials.header')

<div class="wrapper">
    @yield('content')
</div>



@include('partials.scripts')
@livewireScripts
</body>
<script>
    document.querySelector('.vercontraseña').addEventListener('click', e => {
        const toggle = e.currentTarget;
        const passwordInput = document.querySelector('#floatingPassword');
        const openIcon = toggle.querySelector('.icon-open');
        const closedIcon = toggle.querySelector('.icon-closed');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            openIcon.style.display = 'none';
            closedIcon.style.display = 'block';
        } else {
            passwordInput.type = 'password';
            openIcon.style.display = 'block';
            closedIcon.style.display = 'none';
        }
    });
</script>
</html>
