<template>
    <div>
        <input type="hidden" @click="getDataPurchase" id="inputGetDataPurchaseOrderSenEmail"/>
        <vs-sidebar  parent="body" default-index="1" color="primary" class="sidebarx w-sidebar-send-purchase"
                    position-right spacer v-model="activeSidebar">
            <div class="content-header-sidebar">
                <h3>Enviar Orden de Pago</h3>
            </div>
            <form method="post">
                <div class="row p-2">
                    <div class="col-12">
                        <input-form
                            id="txtNameUserTeam"
                            label="Asunto"
                            pattern="alf"
                            errorMsg="Ingrese un Asunto Válido"
                            requiredMsg="El Asunto es requerido"
                            :modelo.sync="subject"
                            :required="true"
                            :msgServer.sync="errors.subject"
                        ></input-form>
                    </div>
                    <div class="col-12">
                        <label>Enviar a <span style="color: red">*</span></label>
                        <tags-input element-id="tags"
                                    v-model="selectedEmail"
                                    @keyup="onKeyUpSearchEmail"
                                    :existing-tags="filterEmails"
                                    :typeahead="true"
                                    placeholder="Ingresar correo electrónico"
                                    discard-search-text="Descartar resultados de búsqueda"
                                    :sort-search-results="true"
                                    id-field="id"
                                    text-field="email"
                        >

                        </tags-input>
                        <p style="font-size: 0.8rem">(Se agrego por defecto el correo electrónico del cliente)</p>
                    </div>
                    <div class="col-12 pt-1">
                        <input-form
                            :showLabel="true"
                            label="Mensaje"
                            id="txtObservacionesPauta"
                            pattern="all"
                            :errorMsg="$t('err_msg_definition')"
                            :requiredMsg="$t('req_msg_definition')"
                            :required="false"
                            :modelo.sync="message"
                            type="ckeditor"
                            :options="{ rows: '20' ,
                                  editor: editor,
                                  config: editorConfig
                                }"
                        ></input-form>
                    </div>
                </div>
                <div class="row pr-2 pl-2">
                    <div class="col-12">
                        <a @click="sendEmail()" class="btn btn-primary btn-block">Enviar</a>
                    </div>
                </div>
            </form>
        </vs-sidebar>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "@ckeditor/ckeditor5-build-classic/build/translations/es.js";
import Swal from "sweetalert2";

export default {
    name: "SidebarSendPurchaseOrder",
    components: {
        ClassicEditor,
    },
    data() {
        return {
            activeSidebar: false,
            subject: 'Nueva Orden de Pago',

            errors: {},
            value: [
                {
                    email: null
                }
            ],
            message: '',
            idPurchase: null,
            chipsEmail: [],
            selectedEmail: [{
                id: '',
                email: '',
                name: '',
            }],
            slug: null,
            codePurchase: null,
            project: null,
            expiration: null,
            filterEmails: [],
            load: false,
            editor: ClassicEditor,
            editorConfig: {
                language: window.lang,
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',]
            },
        }
    },
    methods: {
        getDataPurchase(e) {
            e.preventDefault();
            this.idPurchase = e.target.value;
            this.selectedEmail =[{
                id: '',
                email: '',
                name: ''
            }]
            this.$vs.loading({
                color: '#3f4f6e',
                text: 'Espere un momento por favor...'
            })

            setTimeout(() => {
                axios.get('/api/get-data-purchase-order/' + this.idPurchase).then(resp => {
                    if (resp.data.data.company){
                        this.selectedEmail[0].id = resp.data.data.company.email
                        this.selectedEmail[0].email = resp.data.data.company.email
                        this.selectedEmail[0].name = resp.data.data.company.name

                    }else{
                        this.selectedEmail[0].id = resp.data.data.customer.user.email
                        this.selectedEmail[0].email = resp.data.data.customer.user.email
                        this.selectedEmail[0].name = resp.data.data.customer.user.name

                    }
                    this.slug = resp.data.data.slug
                    this.project = resp.data.data.project.name
                    this.expiration = resp.data.data.expiration
                    this.codePurchase = resp.data.data.code

                })
                this.activeSidebar = true
                this.$vs.loading.close()
            }, 1000)

        },

        onKeyUpSearchEmail(e) {
            let email = e.target.value;
            let maxCharacter = email.length
            if (maxCharacter === 2) {
                axios.get('/api/filter-email/' + email).then(resp => {
                    console.log(resp.data.data)
                    this.filterEmails = resp.data.data
                })
                maxCharacter = 0
            }
        },
        sendEmail(){
            eventBus.$emit("validarFormulario");
            setTimeout(() => {
                let resp = this;
                /***  VALIDANDO LOS ERRORES Y MOSTRANDO UNA ALERTA  ***/
                if (document.querySelectorAll(".is-invalid").length > 0) {
                    this.$toast.error({
                        title: 'Error',
                        message: 'Revisa que los campos requeridos tengan datos',
                        showDuration: 1000,
                        hideDuration: 6000,
                        position: 'top right',
                    })
                    return;
                }

                const data = new FormData()
                data.append('subject', this.subject);
                data.append('message', this.message);
                data.append('project', this.project);
                data.append('slug', this.slug);
                data.append('code', this.codePurchase);
                data.append('idPurchase', this.idPurchase);
                data.append('expiration', this.expiration);
                data.append('emails',JSON.stringify(this.selectedEmail));
                Swal.fire({
                    title: this.$t('backend.project.billing.swal_alert_confirmar'),
                    text: '¿Esta seguro de envia la orden de pago?',
                    confirmButtonColor: "#F05E7D",
                    cancelButtonColor: "#79ebdf",
                    confirmButtonText: this.$t('backend.project.billing.swal_alert_aceptar'),
                    cancelButtonText: this.$t('backend.project.billing.swal_alert_cancelar'),
                    customClass: "swal-confirmation",
                    showCancelButton: true,
                    reverseButtons: true,
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.value) {
                        this.$vs.loading({
                            color: '#3f4f6e',
                            text: 'Enviando...'
                        })
                        axios.post('/api/store-send-email-purchase-order', data).then(res => {
                            this.$toast.success({
                                title: 'Muy Bien',
                                message: 'Orden de Pago Enviada Correctamente',
                                showDuration: 1000,
                                hideDuration: 8000,
                                position: 'top right',
                            })
                            setTimeout(() => {
                                this.$vs.loading.close()
                            }, 2300)
                            // window.location = '/' + this.language + "/purchase-orders";
                        }).catch(err => {
                            console.log('mostrando el error', err)
                            this.$toast.error({
                                title: this.$t('backend.project.billing.toast_alert_algo_salio_mal'),
                                message: this.$t('backend.project.billing.toast_alert_comunicate_administrador'),
                                showDuration: 1000,
                                hideDuration: 8000,
                            })
                            setTimeout(() => {
                                this.$vs.loading.close()
                            }, 2300)
                        });
                    }
                })

            }, 200)
        },

    },

}
</script>

<style>
.w-sidebar-send-purchase .vs-sidebar {
    max-width: 400px !important;
}

</style>
