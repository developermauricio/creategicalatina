<template>
    <div>
        <div class="layout">
            <!-- ommited -->
            <SocialChat
                icon
                class="messenger-chat"
                :attendants="attendants"
            >
                <p slot="header">Si tienes alguna duda o necesitas ayuda, no dudes en contáctarnos.</p>
                <template v-slot:button>
                    <img
                        src="https://raw.githubusercontent.com/ktquez/vue-social-chat/master/src/icons/whatsapp.svg"
                        alt="icon whatsapp"
                        aria-hidden="true"
                    >
                </template>
                <small slot="footer">Horario disponible: 8am to 6pm</small>
            </SocialChat>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatFloatingCustomer",

    data() {
        return {
            attendants: [
                {
                    app: 'whatsapp',
                    label: 'Director Ejecutivo Asociado',
                    name: 'Felipe González',
                    number: '+573508999696',
                    avatar: {
                        src: '/images/chat/felipe-gonzalesz.png',
                        alt: 'felipe-gonzales'
                    }
                },
            ],
        }
    }
}
</script>

<style>
.vsc-popup-header{
    background-color: #283046 !important;
}
.vsc-popup-button:focus, .vsc-popup-button:hover{
    box-shadow: 0 0 0 3px #fff, 0 0 0 6px #79ebdf !important;
}
.vsc-popup-button--default{
    background-color: #F05E7D !important;
}
.vsc-popup{
    margin-bottom: 3rem !important;
    z-index: 9999999999999 !important;
}
</style>
