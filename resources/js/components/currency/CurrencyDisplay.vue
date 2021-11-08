<template>
  <span>{{ currency | currency(config) }}</span>
</template>

<script>
import { formatValue, getCurrencies } from "../../trm";

export default {
  name: "CurrencyDisplay",
  props: {
    value: {
      type: Number,
      require: true,
    },
    from: {
      type: String,
      default: "COP",
    },
    to: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      currencies: null,
      convertDefault: "USD",
    };
  },
  created() {
    getCurrencies((currencies) => {
      this.currencies = currencies;
    });
    this.convertDefault = window.currency;
    eventBus.$on("currency", (currency) => {
      this.convertDefault = currency;
    });
  },
  computed: {
    currency() {
      if (this.convertTo === this.from) {
        return this.value;
      }
      return formatValue(this.value, this.convertTo, this.from);
    },
    convertTo() {
      return this.to ? this.to : this.convertDefault;
    },
    config() {
      if (!this.currencies) {
        return null;
      }
      return this.currencies[this.convertTo].config;
    },
  },
};
</script>
