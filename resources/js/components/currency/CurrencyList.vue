<template>
  <li class="nav-item dropdown dropdown-language" :class="{ show: toggleShow }">
    <a
      class="nav-link dropdown-toggle"
      id="dropdown-coin"
      href="javascript:void(0);"
      aria-haspopup="true"
      :aria-expanded="toggleShow"
      @click="changeShow"
    >
      <i class="flag-icon" :class="icono"></i>
      <span class="selected-language"> {{ nameLang }} </span>
      /
      <span class="selected-currency">
        {{ nameCurrency }}
      </span>
    </a>
    <div
      class="dropdown-menu dropdown-menu-right p-2"
      :class="{ show: toggleShow }"
      aria-labelledby="dropdown-config"
    >
      <p class="title">Idioma</p>
      <select
        name="lang"
        id="lang"
        class="form-control form-control-sm"
        v-model="typeLang"
      >
        <option
          v-for="typeLang in typeLangs"
          :value="typeLang.key"
          :key="typeLang.key"
          :title="typeLang.description"
        >
          {{ typeLang.name }}
        </option>
      </select>

      <p class="title">Moneda</p>
      <select
        name="currency"
        id="currency"
        class="form-control form-control-sm"
        v-model="typeCurrency"
      >
        <option
          v-for="typeCurrency in typeCurrencies"
          :value="typeCurrency.key"
          :key="typeCurrency.key"
          :title="typeCurrency.description"
        >
          {{ typeCurrency.name }}
        </option>
      </select>
      <div class="pt-2">
        <button class="btn btn-primary btn-block" @click="updateConfig">
          Guardar
        </button>
      </div>
    </div>
  </li>
</template>
<script>
export default {
  name: "CurrencyList",
  props: {
    langs: {
      type: Object,
      require: true,
    },
    route_lang: {
      type: String,
      require: true,
    },
  },
  data() {
    return {
      toggleShow: false,
      typeCurrency: null,
      typeLang: null,
      reload: false,
    };
  },
  computed: {
    typeCurrencyObject() {
      return this.typeCurrencies.find((typeCurrency) => {
        return typeCurrency.key === this.typeCurrency;
      });
    },
    typeLangObject() {
      return this.typeLangs.find((typeLang) => {
        return typeLang.key === this.typeLang;
      });
    },
    current() {
      return "COP";
    },
    icono() {
      if (this.typeLangObject) {
        return this.typeLangObject.icon;
      }
    },
    nameCurrency() {
      if (this.typeCurrencyObject) {
        return this.typeCurrencyObject.name;
      }
    },
    nameLang() {
      if (this.typeLangObject) {
        return this.typeLangObject.name;
      }
    },
  },
  created() {
    this.typeCurrencies = [
      {
        key: "COP",
        name: "COP",
        icon: "flag-icon-co",
        description: "Pesos colombianos",
      },
      {
        key: "USD",
        name: "USD",
        icon: "flag-icon-us",
        description: "Dolar",
      },
    ];

    this.typeLangs = [];

    Object.keys(this.langs).forEach((key) => {
      const lang = this.langs[key];
      this.typeLangs.push({
        key: lang["data-language"],
        name: lang["language"],
        icon: lang["flag"],
      });
    });

    this.typeCurrency = this.getCurrentKey();
    this.typeLang = this.getCurrentKeyLang();
  },
  methods: {
    changeCurrency() {
      this.updateTypeCurrency(this.typeCurrency);
    },
    getCurrentKey() {
      const value = window.localStorage.getItem("currency");
      if (value) {
        this.updateTypeCurrency(value);
        return value;
      }

      this.updateTypeCurrency("COP");
      return "COP";
    },
    updateTypeCurrency(key) {
      window.currency = key;
      window.localStorage.setItem("currency", key);
    },
    changeShow() {
      this.toggleShow = !this.toggleShow;
    },
    changeLang() {
      this.updateTypeLang(this.typeLang);
    },
    getCurrentKeyLang() {
      const value = window.localStorage.getItem("lang");
      if (value) {
        this.updateTypeLang(value);
        return value;
      }

      this.updateTypeLang(this.typeLangs[0].key);
      return this.typeLangs[0].key;
    },
    updateTypeLang(key) {
      window.localStorage.setItem("lang", key);
      axios
        .get(this.route_lang.replace("__NA__", key))
        .then(() => {
          if (this.reload) {
            window.location.reload();
          }
        })
        .catch(() => {
          if (this.reload) {
            window.location.reload();
          }
        });
    },
    updateConfig() {
      this.reload = true;
      this.changeCurrency();
      this.changeLang();
    },
  },
};
</script>
<style scoped>
.title {
  margin: 0.1rem;
  padding-top: 0.5rem;
}
.dropdown-menu {
  min-width: 16rem;
}
</style>
