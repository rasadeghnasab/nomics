<template>
    <v-container fluid>
        <v-row align="center">
            <v-col cols="4">
                <v-subheader>
                    Currencies:
                </v-subheader>
            </v-col>

            <v-col cols="4">
                <v-autocomplete
                    v-model="selected"
                    :items="items"
                    item-text="name"
                    item-value="id"
                    label="Select"
                    return-object
                    single-line
                ></v-autocomplete>
            </v-col>

            <v-col cols="4">
                <v-btn @click="search" class="primary">Search</v-btn>
            </v-col>
        </v-row>
        <v-row align="center" v-if="currencyExists || cardLoading">
            <v-skeleton-loader
                v-if="cardLoading"
                class="mx-auto"
                max-width="300"
                min-width="300"
                type="card"
            ></v-skeleton-loader>
            <v-card
                v-else-if="currencyExists"
                elevation="2"
                outlined
                shaped
                tile
                class="mx-auto my-12"
            >
                <v-card-title v-text="currency.name"></v-card-title>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>

import nomics from '../../api/nomics';

export default {
    data() {
        return {
            cardLoading: false,
            selected: {},
            items: [],
            currency: {},
        }
    },
    async mounted() {
        this.items = (await this.getCurrencies()).data;

        if (this.items.length) {
            this.selected = this.items[0];
        }
    },
    methods: {
        search: async function () {
            this.cardLoading = true;
            try {
                this.currency = (await nomics.currencyRate(this.selected.id));
                this.cardLoading = false;
            } catch (exception) {
                console.log('exception', exception);
                alert('exception occurred');
            }
        },
        getCurrencies: async () => {
            try {
                return await nomics.currencies();
            } catch (exception) {
                console.log('exception', exception);
                alert('exception occurred');
            }
        }
    },
    computed: {
        currencyExists: function () {
            return this.currency && Object.keys(this.currency).length > 0 && this.currency.constructor === Object;
        }
    }
}
</script>
