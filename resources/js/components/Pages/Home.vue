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
                min-height="200"
                type="card"
            ></v-skeleton-loader>
            <v-card
                v-else-if="currencyExists"
                elevation="2"
                outlined
                shaped
                tile
                max-width="300"
                min-width="300"
                min-height="200"
                class="mx-auto"
            >
                <v-card-title>{{ currency.name }} ({{ currency.currency }})</v-card-title>
                <v-card-text>
                    <div class="my-4 text-subtitle-1">
                        Price: ${{ currency.price }}
                    </div>
                </v-card-text>
                <v-card-text>
                    <v-chip>Status: {{ currency.status }}</v-chip>
                </v-card-text>
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
                const currencies = (await nomics.currencyRate(this.selected.id)).data;

                this.currency = currencies.length > 0 ? currencies[0] : {};
                this.cardLoading = false;
            } catch (exception) {
                alert('exception occurred');
            }
        },
        getCurrencies: async () => {
            try {
                return await nomics.currencies();
            } catch (exception) {
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
