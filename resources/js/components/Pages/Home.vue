<template>
    <v-container fluid>
        <v-row align="center">
            <v-col cols="4">
                <v-subheader>Currencies:</v-subheader>
            </v-col>

            <v-col cols="4">
                <currencies-select-box @currencyChange="changeCurrency"/>
            </v-col>

            <v-col cols="4">
                <v-btn @click="search" class="primary">Search</v-btn>
            </v-col>
        </v-row>
        <v-row align="center">
            <currencies-details :currenciesIds="selectedCurrenciesIds" ref="currenciesDetails"/>
        </v-row>
    </v-container>
</template>

<script>

import CurrenciesSelectBox from '../Nomics/CurrenciesSelectBox';
import CurrenciesDetails from "../Nomics/CurrenciesDetails";

export default {
    data() {
        return {
            selectedCurrencies: [],
        }
    },
    components: {
        'currencies-select-box': CurrenciesSelectBox,
        'currencies-details': CurrenciesDetails,
    },
    methods: {
        search: function () {
            this.$refs.currenciesDetails.search();
        },
        changeCurrency: function (currency) {
            this.selectedCurrencies = [currency];
        }
    },
    computed: {
        selectedCurrenciesIds: function () {
            return this.selectedCurrencies.map((currency) => currency.id);
        }
    }
}
</script>
