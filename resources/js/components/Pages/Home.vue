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
                max-width="300"
                min-width="300"
                class="mx-auto"
            >
                <v-card-title>{{ currency.name }} ({{ currency.currency }})</v-card-title>
                <v-card-text>
                    <v-row
                        align="center"
                        class="mx-0"
                    >
                        <div class="grey--text ms-4">
                            ${{ currency.price }}
                        </div>
                    </v-row>

                    <div class="my-4 text-subtitle-1">
                        $ • Italian, Cafe
                    </div>
                </v-card-text>
                <v-card-text>
                    <v-chip>High: {{currency.}}</v-chip>

                    <v-chip>7:30PM</v-chip>

                    <v-chip>8:00PM</v-chip>

                    <v-chip>9:00PM</v-chip>
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
                console.log(this.selected.id);
                const currencies = (await nomics.currencyRate(this.selected.id)).data;

                this.currency = currencies.length > 0 ? currencies[0] : {};
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
