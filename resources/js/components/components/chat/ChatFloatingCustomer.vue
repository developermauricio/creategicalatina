<template>
    <div>
        <div class="layout">
            <!-- ommited -->
            <SocialChat
                icon
                class="messenger-chat"
                :attendants="attendants"
            >
                <p slot="header">{{ $t('frontend.chat.chat-floating-customer.titulo_si_tiene_duda_ayuda_chat_floating_customer') }}</p>
                <template v-slot:button>
                    <img
                        src="https://raw.githubusercontent.com/ktquez/vue-social-chat/master/src/icons/whatsapp.svg"
                        alt="icon whatsapp"
                        aria-hidden="true"
                    >
                </template>
                <small slot="footer">{{ $t('frontend.chat.chat-floating-customer.titulo_horario_disponible') }} 8am {{ $t('frontend.chat.chat-floating-customer.titulo_horario_disponible_a') }} 6pm</small>
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
