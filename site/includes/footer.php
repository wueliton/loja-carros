<footer>
    <div class="container py-4 d-flex justify-content-between">
        <img src="./assets/img/logo.png" alt="" class="img-fluid logo-footer">

        <div class="d-flex  flex-column">



            <div>
                <p style="text-align: center;"><strong>Atendimento</strong></p>
                <div class="d-flex">
                    <p><strong>Segunda a Sexta</strong> das 10H às 19H /</p>
                    <p><strong> Sábado</strong> das 09H às 20H / </p>
                    <p><strong> Domingo</strong> das 10H às 18H </p>
                </div>
            </div>
        </div>

    </div>
</footer>

<!-- Fim do Footer -->

<div class="icone-conceito">
    <a href="https://www.conceitopublicidade.com.br/" target="_blank" rel="nofollow">
        <img src="<?= $url ?>/assets/img/conceito.png" alt="<?= $nomeEmpresa; ?>" title="<?= $nomeEmpresa; ?>" class="img-fluid">
    </a>
    <a href="<?= $linkNavSecurity ?>" target="_blank" rel="nofollow">
        <img src="<?= $url ?>/assets/img/cadeado.png" alt="<?= $nomeEmpresa; ?>" title="<?= $nomeEmpresa; ?>" class="img-fluid">
    </a>
    <a href="<?= $linkResponsinator ?>" target="_blank" rel="nofollow">
        <img src="<?= $url ?>/assets/img/celular.png" alt="<?= $nomeEmpresa; ?>" title="<?= $nomeEmpresa; ?>" class="img-fluid">
    </a>
</div>


<div id="popup-promocao" class="div-pai">
    <div class="cookieConsentContainer" id="cookieConsentContainer" style="opacity: 1; display: flex;">
        <div class="container">
            <div class="cookieTitle">
                <h2>Cookies</h2>
            </div>
            <div class="cookieDesc">
                <p>Ao usar este site, você aceita automaticamente o uso de cookies. <a href="<?= $url; ?>politica-privacidade" target="_blank">Acessar Política de privacidade</a></p>
            </div>
            <div class="cookieButton"><a onclick="mouseOn();">Entendido</a></div>
        </div>
    </div>
</div>
</body>

</html>

<?php
echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
let form = document.querySelector("#orcamento-formulary");
form.addEventListener("submit", e => {
    e.preventDefault();
    $("#orcamento-formulary :input").each(function(index, el) {
        if ($(el).val().length != 0) {
            allBlank = false;
        }
        });

        if (allBlank == true) {
            alert("Todos os campos são obrigatórios.");
            } else {
                grecaptcha.execute();
            }
            });

            function sendForm(token) {
                data = $("#orcamento-formulary").serialize();
                $("#orcamento-formulary").html("<h3>Aguarde...</h3><p>Estamos enviando a sua mensagem, por favor, aguarde.</p>");
                const url = "php/cadastro-form.php";
                const config = {
                    method: "post",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8"
                        },
                        body: data
                    };

                    fetch(url, config).then(res => {
                        return res.json();
                        }).then(json => {
                            if (json.result == "sucesso") {
                                $("#orcamento-formulary").html("<h3>E-mail enviado com sucesso!</h3><p>Em breve enviaremos mais informações.</p>");
                                } else {
                                    $("#orcamento-formulary").html("<h3>Erro</h3><p>Houve um erro ao tentar enviar, solicitamos por gentileza que tente novamente mais tarde.</p>");
                                }
                                });

                            }
                            </script>';


?>

<script src="<?= $url ?>/assets/js/script15.js"></script>
<?php include("includes/schema.php"); ?>
<script src="<?= $url; ?>assets/js/popup.js" defer></script>
