<template>
  <div>
    <div>
      <button v-if="!hasFilters" class="btn btn-default" @click="openFilter">
        Sin filtro
      </button>
      <button v-else class="btn btn-default" @click="openFilter">
        {{ minParse }}
        <br />
        {{ maxParse }}
      </button>
    </div>
    <vs-popup
      class="showFilter"
      title="Filtro"
      :button-close-hidden="false"
      :active="showFilter"
    >
      <div class="row m-0">
        <div class="col">
          <input-form
            label="Minimo"
            :id="minId"
            pattern="all"
            errorMsg="Ingrese una fecha de vencimiento válida"
            :modelo.sync="min"
            type="date"
            :datepicker="{
              'id': minId,
              'clear-button': true,
              'bootstrap-styling': true,
            }"
          ></input-form>
        </div>
        <div class="col">
          <input-form
            label="Maximo"
            :id="maxId"
            pattern="all"
            errorMsg="Ingrese una fecha de vencimiento válida"
            :modelo.sync="max"
            type="date"
            :datepicker="{
              'id': maxId,
              'clear-button': true,
              'bootstrap-styling': true,
            }"
          ></input-form>
        </div>
        <div class="col-12 text-right">
          <button class="btn btn-default" @click="closeFilter">Cancelar</button>
          <button class="btn btn-primary" @click="updateFilters">
            Aceptar
          </button>
        </div>
      </div>
    </vs-popup>
  </div>
</template>

<script>
export default {
  props:{
    code: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      min: null,
      max: null,
      showFilter: false,
      final: {
        min: null,
        max: null,
      },
    };
  },
  computed: {
    hasFilters() {
      return this.final.min || this.final.max;
    },
    minParse() {
      if (!this.final.min) {
        return "";
      }
      return `Desde: ${this.formatDate(this.final.min)}`;
    },
    maxParse() {
      if (!this.final.max) {
        return "";
      }
      return `Hasta: ${this.formatDate(this.final.max)}`;
    },
    minId(){
      return `${this.code}_max`;
    },
    maxId(){
      return `${this.code}_min`;
    }
  },
  methods: {
    closeFilter() {
      this.showFilter = false;
    },
    openFilter() {
      this.showFilter = true;
    },
    updateFilters() {
      this.final.min = this.min;
      this.final.max = this.max;
      const callback = window.filters[this.code];
      if (callback){
        callback();
      }
      this.closeFilter();
    },
    formatDate(date) {
      const text = new Intl.DateTimeFormat(
        window.lang == "es" ? "es-Co" : window.lang,
        { year: "numeric", month: "numeric", day: "numeric" }
      ).format(new Date(date));
      return text;
    },
  },
};
</script>

<style>
.showFilter.vs-component.con-vs-popup {
  align-items: flex-start;
}

.showFilter.vs-component.con-vs-popup .vs-popup--content {
  overflow: inherit;
}

.showFilter.vs-component.con-vs-popup .vs-popup--close {
  display: none;
}
</style>
