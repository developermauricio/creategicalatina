<template>
    <div class="form-changed-password" style="display: none">
        <h4 class="card-title mb-1">{{ $t('backend.profile.changed-password.titulo_cambiar_contrasena') }} 🔒</h4>
        <p class="card-text mb-2">{{ $t('backend.profile.changed-password.texto_ingrese_contrasena') }}</p>
        <div class="form-group">

            <input-form
                id="txtPassword"
                :label="$t('backend.profile.changed-password.titulo_nueva_contrasena')"
                pattern="all"
                type="password"
                :requiredMsg="$t('backend.profile.changed-password.texto_contrasena_requerida')"
                :modelo.sync="password"
                :required="true"
                :msgServer.sync="errors.password"
            ></input-form>
        </div>
        <div class="form-group">
            <input-form
                id="txtConfirmationPassword"
                :label="$t('backend.profile.changed-password.titulo_confirmar_contrasena')"
                pattern="all"
                type="password"
                :requiredMsg="$t('backend.profile.changed-password.texto_contrasena_confirmar_requerida')"
                :modelo.sync="password_confirmation"
                :required="true"
                :msgServer.sync="errors.password_confirmation"
            ></input-form>
            <p style="margin-top: -1rem;font-size: 0.9rem; display: none"
               id="text-verify-password" class="text-danger">{{  $t('backend.profile.changed-password.mensaje_confirmar_contrasena') }}</p>
        </div>
        <button @click="changedPassword" class="btn btn-primary btn-block" tabindex="3">{{ $t('backend.profile.changed-password.btn_cambiar_contrasena') }}
        </button>
    </div>
</template>

<script>
export default {
    name: "ChangedPassword",
    data() {
        return {
            password: '',
            password_confirmation: '',
            passwordState: window.stateShowPassword,
            errors: {},
        }
    },
    methods: {
        changedPassword() {
            eventBus.$emit("validarFormulario");
            setTimeout(() => {
                    let resp = this;
                    /***  VALIDANDO LOS ERRORES Y MOSTRANDO UNA ALERTA  ***/
                    if (document.querySelectorAll(".is-invalid").length > 0) {
                        this.$toast.error({
                            title: 'Error',
                            message: this.$t('backend.profile.changed-password.toast_error_mensaje'),
                            showDuration: 1000,
                            hideDuration: 6000,
                            position: 'top right',
                        })
                        return;
                    }
                    const data = new FormData()
                    data.append('password', this.password)
                    data.append('password_confirmation', this.password_confirmation)

                    Swal.fire({
                        title: this.$t('backend.profile.changed-password.texto_alerta_confirmar'),
                        text: this.$t('backend.profile.changed-password.texto_alerta_esta_seguro_contrasena'),
                        confirmButtonColor: "#F05E7D",
                        cancelButtonColor: "#79ebdf",
                        confirmButtonText: this.$t('backend.profile.changed-password.btn_alerta_aceptar'),
                        cancelButtonText: this.$t('backend.profile.changed-password.btn_alerta_cancelar'),
                        customClass: "swal-confirmation",
                        showCancelButton: true,
                        reverseButtons: true,
                        allowOutsideClick: false,
                    }).then(result => {
                        if (result.value) {
                            axios.post('/api/update-password-user', data)
                            .then(resp =>{
                                this.$toast.success({
                                    title: this.$t('backend.profile.changed-password.toast_susscess_titulo'),
                                    message: this.$t('backend.profile.changed-password.toast_susscess_mensaje'),
                                    showDuration: 1000,
                                    hideDuration: 5000,
                                    position: 'top right',
                                })
                                location.reload();
                            }).catch(err =>{
                                this.$toast.error({
                                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                                    message: err,
                                    showDuration: 1000,
                                    hideDuration: 8000,

                                })
                            })
                        }
                    })

                }, 200
            )
            ;
        }
    },
    watch: {
        password_confirmation: function (val) {
            let data = this
            if (val) {
                console.log(val);
                if (data.password !== val) {
                    $("#txtConfirmationPassword").addClass("is-invalid");
                    $("#text-verify-password").css("display", "block");
                } else {
                    $("#txtConfirmationPassword").removeClass("is-invalid");
                    $("#text-verify-password").css("display", "none");
                }
            }
        }
        ,
    },
    props: ['dataStateChangedPassword']
}
</script>

<style scoped>

</style>
