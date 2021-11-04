<template>
    <div>
        <li class="nav-item dropdown dropdown-notification mr-25">
            <a class="nav-link nav-link-style-bell" href="javascript:void(0);" data-toggle="dropdown">
                <i class="ficon" data-feather="bell"></i>
                <span class="badge badge-pill badge-danger badge-up" v-if="notifications.length">{{
                        notifications.length
                    }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                    <div class="dropdown-header d-flex">
                        <h4 class="notification-title mb-0 mr-auto">{{ $t('backend.notification.notification.notificaciones') }}</h4>
                        <div class="badge badge-pill badge-light-success" v-if="notifications.length">
                            {{ notifications.length }} {{ $t('backend.notification.notification.nuevas') }}
                        </div>
                    </div>
                </li>
                <li class="scrollable-container media-list">
                    <div class="media d-flex align-items-start" v-if="!notifications.length">
                        <div class="media-body">
                            <p class="media-heading text-center">
                                <span class="font-weight-bolder">{{ $t('backend.notification.notification.no_hay_notificaciones') }}</span>
                            </p>
                        </div>
                    </div>
                    <a class="d-flex"
                       v-for="(notification, index) in notifications"
                       :key="index"
                       :href="`/`+language+`/admin-projects/`+notification.slugProject"
                       @click="linkNotification(index, notification)"
                    >
                        <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <div class="avatar">
                                    <img :src="notification.pictureUser" alt="avatar" width="32"
                                         height="32">
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="media-heading">
                                <span class="font-weight-bolder">{{ notification.nameUser }} 🎉
                                </span> {{ $t('backend.notification.notification.ha_registrado_un') }}
                                <div class="badge badge-pill badge-light-success">{{ $t('backend.notification.notification.nuevo_proyecto') }}</div>
                                <small class="notification-text">{{ $t('backend.notification.notification.es_necesario_revisarlo') }}</small>
                            </div>
                        </div>
                    </a>
                <li class="dropdown-menu-footer">
                    <a class="btn btn-primary btn-block" href="javascript:void(0)"
                       @click="openModalHistorialNotification()">{{ $t('backend.notification.notification.ver_todas_las_notificaciones') }}</a>
                </li>
            </ul>
        </li>
        <vs-popup class="holamundo" :title="$t('backend.notification.notification.historial_notificaciones')" :active.sync="popupActivo">
            <div class="row">
                <div class="col-12 ">
                    <p class="text-justify pr-2 pr-2">{{ $t('backend.notification.notification.text_info_modal_notificaciones') }}</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 ">
                    <div class="pt-2 pr-2 pl-2">
                        <input class="form-control" :placeholder="$t('backend.notification.notification.buscar_por_nombre_fecha')"
                               v-model="filters.seach.value"/>
                        <div class="row">
                            <div class="col-12 col-md-8 col-lg-8 pt-1">
<!--                                <input-form-->
<!--                                    label="Filtrar por estado"-->
<!--                                    id="txtLaguangeEmail"-->
<!--                                    errorMsg-->
<!--                                    :required="false"-->
<!--                                    :modelo.sync="filters.state.value"-->
<!--                                    :msgServer.sync="errors.filters"-->
<!--                                    type="multiselect"-->
<!--                                    selectLabel="Tipo de documento"-->
<!--                                    :multiselect="{ options: optionsStateNoti,-->
<!--                                           selectLabel:'Filtar por estado',-->
<!--                                           selectedLabel:'Seleccionado',-->
<!--                                           deselectLabel: 'Desmarcar',-->
<!--                                          placeholder: 'Filtrar por estado',-->
<!--                                          taggable : true,-->
<!--                                          'track-by':'id',-->
<!--                                          label: 'name',-->
<!--                                          'custom-label': state=>state.name-->
<!--                                        }"-->
<!--                                ></input-form>-->
                            </div>
                        </div>
                    </div>
                    <div id="div-with-loading"></div>
                    <v-table v-if="dataAllNotification.length"
                        class="table table-bordered table-hover"
                        :data="dataAllNotification"
                        :currentPage.sync="currentPage"
                        :filters="filters"
                        @totalPagesChanged="totalPages = $event"
                    >
                        <thead slot="head">
                        <th class="text-center">{{ $t('backend.notification.notification.titulo_tabla_notificacion') }}</th>
                        <th class="text-center">{{ $t('backend.notification.notification.titulo_tabla_estado') }}</th>
                        <th class="text-center">{{ $t('backend.notification.notification.titulo_tabla_acciones') }}</th>
                        </thead>
                        <tbody slot="body" slot-scope="{displayData}">
                        <tr v-for="(row, index) in displayData" :key="row.id">
                            <td class="p-1" @click="viewMarkRead(row.notification)">
                                <vs-tooltip :text="row.state === 0 ? $t('backend.notification.notification.ver_como_leida'): $t('backend.notification.notification.ver_notificacion')"
                                            class="d-inline-block pr-1" position="top">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left ml-1 mt-1">
                                            <div class="avatar">
                                                <img :src='row.notification.pictureUser' alt="avatar" width="32"
                                                     height="32">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading ml-1" style="margin-bottom: 0;">
                                <span class="font-weight-bolder">{{ row.name }} 🎉
                                </span> {{ $t('backend.notification.notification.ha_registrado_un') }}
                                            <div class="badge badge-pill badge-light-success ml-1">{{ $t('backend.notification.notification.nuevo_proyecto') }}</div>
                                            <small class="notification-text">{{ $t('backend.notification.notification.es_necesario_revisarlo') }}</small>
                                            <p class="ml-1">{{ row.date }}</p>
                                        </div>
                                    </div>
                                </vs-tooltip>
                            </td>
                            <td class="text-center" @click="markRead(row.state, row.id)">
                                <vs-tooltip :text="row.state === 0 ? $t('backend.notification.notification.marcar_como_leida'): $t('backend.notification.notification.marcar_como_no_leida')"
                                            class="d-inline-block " position="top">
                                    <span
                                        :class="`badge badge-pill badge-light-${ row.state == 1 ? 'success' : 'warning' }`">{{
                                            row.state == 1 ? $t('backend.notification.notification.visto') : $t('backend.notification.notification.no_visto')
                                        }}</span>
                                </vs-tooltip>
                            </td>
                            <td class="text-center">
                                <vs-tooltip :text="$t('backend.notification.notification.eliminar_notificacio_historial')"
                                            class="d-inline-block " position="top">
                                    <vs-icon @click="deleteNotification(row.id, row.notification.id)" icon="delete" size="small"  color="#ea5455"></vs-icon>
                                </vs-tooltip>
                            </td>

                        </tr>

                        </tbody>
                    </v-table>
                    <div  class="media d-flex align-items-start pt-1" v-if="!dataAllNotification.length">
                        <div class="media-body">
                            <p class="media-heading text-center">
                                <span class="font-weight-bolder">{{  $t('backend.notification.notification.no_hay_notificaciones_modal') }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="text-center justify-content-center">
                        <!--                        <smart-pagination-->
                        <!--                            class="text-center "-->
                        <!--                            :currentPage.sync="currentPage"-->
                        <!--                            :totalPages="totalPages"-->
                        <!--                        />-->
                    </div>
                </div>
            </div>

        </vs-popup>
    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';
import Multiselect from "vue-multiselect";

export default {
    name: "Notifications",
    components: {
        Multiselect,
    },
    data() {
        return {
            notifications: [],
            moment: moment,
            colorLoading: '#161d31',
            popupActivo: false,
            dataAllNotification: [],
            currentPage: 1,
            language: window.lang, //Idioma actual de la aplicación
            totalPages: 0,
            issNotification: false,
            filters: {
                seach: {value: '', keys: ['date', 'name']},
                state: {value: {id: null}, custom: this.filterForState}
            },
            optionsStateNoti: [
                {
                    id: 2,
                    name: 'Todos'
                },

                {
                    id: 0,
                    name: 'No visto'
                },
                {
                    id: 1,
                    name: 'Visto'
                }
            ],
            errors: {},
        }
    },
    methods: {
        // updateStates(value){
        //     if (value === null){
        //         this.getAllNotifications();
        //         return
        //     }
        // },
        filterForState(filterValue, row) {

            if (filterValue.id === 0 || filterValue.id === 1) {
                return row.state === filterValue.id
            }else if(filterValue.id === 2){
                return row.state >= filterValue.id
            }
            return row.state >= filterValue.id
        },
        viewMarkRead(notification){
            console.log(notification)
            let value = null
            window.open(`/`+this.language+`/admin-projects/${notification.slugProject}`,"_blank");
            this.linkNotification(value, notification)
            this.getAllNotifications();
        },
        markRead(state, idNotification) {
            const data = new FormData();
            data.append('stateNotification', state);
            data.append('idNotification', idNotification);
            console.log('state', state, 'id notificación', idNotification)
            // window.location.href = ''
            axios.post('/api/state-notification-change', data).then(resp => {
                this.getAllNotifications();
            }).catch(err => {
                console.log(err)
            })
        },
        openModalHistorialNotification() {
            this.popupActivo = true
            this.getAllNotifications();
        },
        getAllNotifications() {
            this.dataAllNotification = [];
            this.$vs.loading({
                container: '#div-with-loading',
                color: this.colorLoading,
                scale: 0.6,
                text: 'Cargando'
            })
            setTimeout(() => {
                axios.get('/api/get-all-notifications-user').then(resp => {
                    // this.dataAllNotification = resp.data.data
                    for (let i = 0; i < resp.data.data.length; i++) {
                        let noti = JSON.parse(resp.data.data[i].notification)

                        this.dataAllNotification.push({
                            id: resp.data.data[i].id,
                            notification: noti,
                            name: noti.nameUser,
                            date: this.moment(resp.data.data[i].created_at).locale(this.language).format("dddd, MMMM Do YYYY, hh:mm:s A"),
                            state: resp.data.data[i].state
                        })
                        this.getNotificationEcho();

                    }
                }).catch(err => {
                    console.log('funcion get', err)
                })
                this.$vs.loading.close('#div-with-loading > .con-vs-loading')
            }, 150)

        },
        linkNotification(index, notification) {
            console.log(notification);
            const data = new FormData();
            data.append('notification', JSON.stringify(notification));
            axios.post('/api/viewed-notification', data).then(resp => {
                this.notifications.splice(index, 1)
            }).catch(err => {

            });
        },
        deleteNotification(idNotification, idProject){

            const data = new FormData();
            data.append('idNotification', idNotification);

            Swal.fire({
                title: 'Atención',
                html: this.$t('backend.notification.notification.esta_seguro_eliminar_notificacion')+'<br><span style="font-size: 0.9rem">'+this.$t('backend.notification.notification.sera_eliminada_del_historial')+'</span>',
                confirmButtonColor: "#F05E7D",
                cancelButtonColor: "#79ebdf",
                confirmButtonText: this.$t('backend.notification.notification.alert_button_aceptar'),
                cancelButtonText: this.$t('backend.notification.notification.alert_button_cancelar'),
                customClass: "swal-confirmation",
                showCancelButton: true,
                reverseButtons: true,
                allowOutsideClick: false,
            }).then(result => {
                    if (result.value) {
                        axios.post('/api/delete-notification', data).then(resp => {
                            this.getNotificationEcho();
                            this.getAllNotifications();
                        }).catch(err => {

                        })
                    }
            });
        },
        setNotificationEcho() {
            window.Echo.private('new-project-notification')
                .listen('.NewProjectNotification', (e) => {
                    console.log(e.project)
                    this.notifications.push({
                        id: e.project.id,
                        slugProject: e.project.slug,
                        pictureUser: e.project.pictureUser,
                        nameUser: e.project.nameUser,
                        lastNameUser: e.project.lastNameUser,
                    })
                    this.getAllNotifications();
                });
        },
        getNotificationEcho() {
            let getNotifications = []
            this.notifications = []
            axios.get(`/api/get-notification-user/${this.user_id}`).then(resp => {
                getNotifications = resp.data.data
                if (getNotifications.length > 0) {
                    this.notifications = []
                    for (let i = 0; i < getNotifications.length; i++) {
                        this.notifications.push(JSON.parse(getNotifications[i].notification))
                    }
                }
            }).catch(err => {

            });
        }
    },
    props: ['user_id'],
    mounted() {
        this.getNotificationEcho();
        this.setNotificationEcho();
    }
}
</script>

<style scoped>

</style>
