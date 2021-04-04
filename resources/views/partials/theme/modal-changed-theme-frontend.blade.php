<div class="modal fade text-left" id="modal-change-theme-frontend" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-background-theme">
            <div class="modal-header modal-header-background-theme">
                <h4 class="modal-title" id="myModalLabel17">Apariencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row pt-1 pb-1">
                    <div class="col-12">
                        <p>Elige cómo se ve <img width="100" src="/images/creategica-logo.png" alt="">. Seleccione un solo tema o sincronícelo con su sistema y cambie automáticamente entre temas diurnos y nocturnos.</p>
                    </div>
                </div>
<!-- Tarjetas para cambiar el tema para mobile-->
                <div class="row">
                    <div class="col-12">
                        <cards-change-theme></cards-change-theme>
                    </div>
                </div>
<!-- Tarjetas para cambiar el tema para escritorio-->
                <div class="row" style="display: none">
                    <div class="col-6 col-lg-4 col-md-4">
                        <div class="card icon-theme card-light card-theme-change  active" value-theme="2">
                            <img class="card-img-top" src="/images/theme/img-light-mode.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title theme-change">Light Mode</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4">
                        <div class="card icon-theme card-dark card-theme-change" value-theme="1">
                            <img class="card-img-top" src="/images/theme/img-dark-mode.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title theme-change">Dark Mode</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4">
                        <div class="card icon-theme card-system card-theme-change" value-theme="3">
                            <img class="card-img-top" src="/images/theme/img-system-theme.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title theme-change">Según el sistema</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Aceptar') }}</button>
            </div>
        </div>
    </div>
</div>
