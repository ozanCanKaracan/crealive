<footer class="footer footer-static footer-light" style="position: fixed; bottom: 0; width: 100%;">
    <p class="clearfix mb-0">
        <span class="float-md-start d-block d-md-inline-block mt-25">&copy; 2023 | <?php
            $text='Tüm hakları saklıdır';
            $translate=(language($text)) ? language($text) : $text;
            ?> <?= $translate?>
        <a class="ms-25" href="" target="_blank">Crealive</a>
    </p>
</footer>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<div class="modal fade" id="ajaxModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CMS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContainer">

            </div>
        </div>
    </div>
</div>
    <!-- END: Footer-->
<script src="app-assets/js/core/app-menu.js"></script>
<script src="app-assets/js/core/app.js"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
