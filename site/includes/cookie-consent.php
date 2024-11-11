<div x-data="consentCookies()" x-init="checkConsent()" class="cookie-consent" :class="{ 'active': showBar }">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-auto pb-2 pb-md-0">
                <p class="text-bold">Cookies</p>
            </div>
            <div class="col pb-4 pb-md-0">
                <p>Ao usar este site, você aceita automaticamente o uso de cookies. <a
                        href="<?= $url; ?>politica-privacidade" target="_blank">Acessar Política de privacidade</a></p>
            </div>
            <div class="col-md-auto"><button aria-label="Entendo os termos de uso dos cookies"
                    @click="consent()">Entendido</button></div>
        </div>
    </div>
</div>

<script>
    function consentCookies() {
        return {
            showBar: false,
            checkConsent() {
                consent = window.localStorage.getItem('cookieConsent');
                if (consent) return
                this.showBar = true;
            },
            consent() {
                window.localStorage.setItem('cookieConsent', true);
                this.showBar = false;
            }
        }
    }
</script>
