<template>
    <div v-if="extension === 'docx' || extension === 'pptx' || extension === 'xlsx'">
<!--        <VueDocPreview :value="'https://creategicalatina.aicode-test.art/storage/archives/silvio-aiGX198TEZ-terminos referencia creación y diseño de portafolios digitales y taller de creación de portafolios digitales - rev as 2.docx'" type="office"/>-->
        <VueDocPreview :value="urlActual+dataArchiveUrl" type="office"/>
    </div>
    <div v-else-if="extension === 'pdf' || extension === 'csv'">
                <iframe :src="'https://docs.google.com/viewer?url='+urlActual+dataArchiveUrl+'&embedded=true'" style="border: none; width: 100%; height: 50rem"></iframe>
<!--        <iframe :src="'https://docs.google.com/viewer?url=https://creategicalatina.aicode-test.art/storage/archives/francisco-GGmrgk3mP5-beegridtable.csv&embedded=true'"  style="border: none; width: 100%; height: 50rem"></iframe>-->
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
    }
}
</script>

<style scoped>

</style>
