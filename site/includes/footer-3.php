<footer>
    <div class="container py-5 border-bottom">
        <div class="row py-4">
            <div class="col-lg-4 d-flex flex-column gap-2 mb-5 mb-lg-0">
                <h3 class="h6 mb-3">Saiba mais</h3>
                <a href="">Sobre a Raposo Auto Shopping</a>
                <a href="">Mapa do Site</a>
            </div>
            <div class="col-lg-4 d-flex flex-column gap-2 mb-5 mb-lg-0">
                <h3 class="h6 mb-3">Atendimento</h3>
                <p><strong>Segunda à Sexta</strong> das 10h às 19h</p>
                <p><strong>Sábado</strong> das 19h às 20h</p>
                <p><strong>Domingo</strong> das 10h às 18h</p>
            </div>
            <div class="col-lg-4 d-flex flex-column gap-2 mb-5 mb-lg-0">
                <h3 class="h6 mb-3">Links Úteis</h3>
                <a target="_blank" href="https://veiculos.fipe.org.br">Tabela FIPE <i
                        class="fa-solid fa-up-right-from-square"></i></a>
                <a target="_blank" href="https://www.detran.sp.gov.br">Site DETRAN <i
                        class="fa-solid fa-up-right-from-square"></i></a>
                <a target="_blank" href="https://www.olhonocarro.com.br">Histórico Veicular <i
                        class="fa-solid fa-up-right-from-square"></i></a>
                <a target="_blank"
                    href="https://www.detran.sp.gov.br/wps/portal/portaldetran/cidadao/veiculos/fichaservico/certidaopropriedadeveiculo/a4e43e64-dc74-48dc-8432-b5385e9aa77f/">Certidão
                    de Propriedade <i class="fa-solid fa-up-right-from-square"></i></a>
            </div>
        </div>
    </div>
    <div class="container py-5 body-alt">
        <div class="row align-items-center">
            <div class="col-auto d-flex align-items-center gap-2">
                <img src="https://www.raposoautoshopping.com.br//assets/img/logo.jpeg" width="60"
                    alt="Raposo Auto Shopping">
                Raposo Auto Shopping
            </div>
            <div class="col footer-icons d-flex align-items-center justify-content-center gap-2">
                <a href="https://www.conceitopublicidade.com.br/" target="_blank" rel="nofollow">
                    <img src="<?= $url ?>/assets/img/conceito.png" alt="<?= $nomeEmpresa; ?>"
                        title="<?= $nomeEmpresa; ?>" class="img-fluid">
                </a>
                <a href="<?= $linkNavSecurity ?>" target="_blank" rel="nofollow">
                    <img src="<?= $url ?>/assets/img/cadeado.png" alt="<?= $nomeEmpresa; ?>"
                        title="<?= $nomeEmpresa; ?>" class="img-fluid">
                </a>
                <a href="<?= $linkResponsinator ?>" target="_blank" rel="nofollow">
                    <img src="<?= $url ?>/assets/img/celular.png" alt="<?= $nomeEmpresa; ?>"
                        title="<?= $nomeEmpresa; ?>" class="img-fluid">
                </a>
            </div>
            <div class="col-auto">
                &copy; 2024 Todos os direitos reservados
            </div>
        </div>
    </div>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".carousel", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });

        var menuToggle = document.getElementById('menu-toggle');
        var menu = document.querySelector('.menu');
        menuToggle.addEventListener('click', function () {
            menu.classList.toggle('active');
        });

        var menuDropdown = document.querySelector('.dropdown');
        menuDropdown.addEventListener('click', function () {
            menuDropdown.classList.toggle('active');
            document.querySelector('.dropdown + ul').classList.toggle('active');
        });

        var closeBtn = document.getElementById('close-btn');
        closeBtn.addEventListener('click', function () {
            menu.classList.remove('active');
        });

    </script>
</footer>
</body>

</html>