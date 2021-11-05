<template>
  <li class="nav-item dropdown dropdown-language">
    <a
      class="nav-link dropdown-toggle"
      id="dropdown-coin"
      href="javascript:void(0);"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <p style="margin: 0">Moneda</p>
      <i class="flag-icon" :class="typeCurrency.icon"></i>
      <span class="selected-language">
        {{ typeCurrency.name }}
      </span>
    </a>
    <div
      class="dropdown-menu dropdown-menu-right"
      aria-labelledby="dropdown-coin"
    >
      <a
        class="dropdown-item"
        v-for="typeCurrency in typeCurrencies"
        :key="typeCurrency.key"
        :title="typeCurrency.description"
        @click="changeCurrency(typeCurrency)"
      >
        <i class="flag-icon" :class="typeCurrency.icon"></i>
        {{ typeCurrency.name }}
      </a>
    </div>
  </li>
</template>
<script>
export default {
  name: "CurrencyList",
  data() {
    return {
      typeCurrency: null,
    };
  },
  computed: {
    current() {
      return "COP";
    },
  },
  created() {
    this.typeCurrencies = [
      {
        key: "COP",
        name: "COP",
        icon: "flag-icon-co",
        description: "Pesos colombianos"
      },
      {
        key: "USD",
        name: "USD",
        icon: "flag-icon-us",
        description: "Dolar"
      },
    ];

    this.typeCurrency = this.typeCurrencies.find((typeCurrency) => {
      return typeCurrency.key === this.getCurrentKey();
    });
  },
  methods: {
    changeCurrency(typeCurrency) {
      this.typeCurrency = typeCurrency;
      this.updateTypeCurrency(typeCurrency.key);
    },
    getCurrentKey() {
      this.updateTypeCurrency(window.localStorage.getItem("currency") || "COP");
      return window.currency;
    },
    updateTypeCurrency(key) {
      window.currency = key;
      window.localStorage.setItem("currency", key);
      eventBus.$emit("currency", window.currency);
    },
  },
};
</script>
