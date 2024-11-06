<header x-data="{ atTop: true, opened: false }" @scroll.window="atTop = (window.pageYOffset < 60)"
    :class="{ 'scrolled': !atTop }">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <picture>
                    <source type="image/webp" srcset="<?= $url ?>assets/img/webp/logo.webp">
                    <img src="<?= $url ?>assets/img/logo.jpg" class="img-fluid" alt="Raposo Auto Shopping" width="140"
                        height="104">
                </picture>
            </div>
            <div class="col d-flex align-items-center justify-content-end gap-2">
                <ul class="position-fixed position-lg-relative d-lg-flex menu col-auto justify-items-center align-items-center gap-2"
                    :class="{ 'active': opened }">
                    <li class="close d-lg-none"><button @click="opened = false" class="btn-icon" id="close-btn"
                            aria-label="Clique para fechar o menu"><i class="fa-solid fa-xmark"></i></button></li>
                    <li><a href="<?= $url ?>" class="menu-btn">Home</a></li>
                    <li><a href="#" class="menu-btn">Lojas</a></li>
                    <li><a href="#servicos" class="menu-btn">Serviços</a></li>
                    <li><a href="#como-chegar" class="menu-btn">Como Chegar</a></li>
                    <li class="position-relative" x-data="{ opened: false }">
                        <button class="dropdown" @click.outside="opened = false" @click="opened = !opened"
                            :class="{ 'active': opened }">
                            Links úteis <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <ul :class="{ 'active': opened }">
                            <li><a target="_blank" href="https://veiculos.fipe.org.br">Tabela FIPE <i
                                        class="fa-solid fa-up-right-from-square"></i></a></li>
                            <li><a target="_blank" href="https://www.detran.sp.gov.br">Site DETRAN <i
                                        class="fa-solid fa-up-right-from-square"></i></a></li>
                            <li><a target="_blank" href="https://www.olhonocarro.com.br">Histórico Veicular <i
                                        class="fa-solid fa-up-right-from-square"></i></a></li>
                            <li><a target="_blank"
                                    href="https://www.detran.sp.gov.br/wps/portal/portaldetran/cidadao/veiculos/fichaservico/certidaopropriedadeveiculo/a4e43e64-dc74-48dc-8432-b5385e9aa77f/">Certidão
                                    de Propriedade <i class="fa-solid fa-up-right-from-square"></i></a></li>
                        </ul>
                    </li>
                </ul>
                <div>
                    <a href="<?= $whatsapplink ?>" target="_blank" class="btn btn-sm btn-whats"><i
                            class="fa-brands fa-whatsapp"></i><span
                            class="d-none d-md-block"><?= $whatsapp ?></span></a>
                </div>
                <div class="admin-link">
                    <a href="<?= $url ?>admin" aria-label="Acessar área administrativa" class="btn-icon"><i
                            class="fa-solid fa-user-large"></i></a>
                </div>

                <div class="d-lg-none">
                    <button @click="opened = true" class="btn-icon" id="menu-toggle"
                        aria-label="Clique para exibir o menu"><i class="fa-solid fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
