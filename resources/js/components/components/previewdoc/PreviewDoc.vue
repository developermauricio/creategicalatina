<template>
    <div v-if="extension === 'docx' || extension === 'pptx' || extension === 'xlsx'">
<!--        <VueDocPreview :value="'https://creategicalatina.aicode-test.art/storage/archives/silvio-aiGX198TEZ-terminos referencia creación y diseño de portafolios digitales y taller de creación de portafolios digitales - rev as 2.docx'" type="office"/>-->
        <VueDocPreview :value="urlActual+dataArchiveUrl" type="office"/>
    </div>
</template>

<script>
import VueDocPreview from 'vue-doc-preview'
export default {
    name: "PreviewDoc",
    components:{
        VueDocPreview
    },
    data() {
        return {
            urlActual: null
        }
    },
    props: ['dataArchiveUrl', 'extension'],
    mounted() {
        this.urlActual = window.location.origin;
        console.log('url actual',this.urlActual);
    }
}
</script>

<style scoped>

</style>
