<template>
    <div>
        <v-skeleton-loader
            v-for="currencyId in currenciesIds"
            :key="currencyId"
            v-if="isSearching"
            max-width="300"
            min-width="300"
            min-height="200"
            type="article, chip"
        ></v-skeleton-loader>
        <div v-for="currency in currencies"
             v-if="!isSearching"
        >
            <v-card
                elevation="2"
                outlined
                shaped
                tile
                max-width="300"
                min-width="300"
                min-height="200"
            >
                <v-card-text>
                    <div>{{ currency.currency }}</div>
                    <p class="text-h4 text--primary">
                        {{ currency.name }}
                    </p>
                    <div class="my-4 text-subtitle-1">
                        Price: ${{ currency.price }}
                    </div>
                </v-card-text>
                <v-card-text>
                    <v-chip>Status: {{ currency.status }}</v-chip>
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<script>
import nomics from "../../api/nomics";

export default {
    props: {
        currenciesIds: {
            required: false,
            type: Array,
            default: () => [],
        }
    },
    data() {
        return {
            currencies: [],
            isSearching: false,
        }
    },
    methods: {
        search: async function () {
            this.isSearching = true;
            try {
                const ids = this.currenciesIds.join(',');
                const currencies = (await nomics.currencyRate(ids)).data;

                this.currencies = currencies.length > 0 ? [currencies[0]] : [{}];
                this.isSearching = false;
            } catch (exception) {
                alert('exception occurred');
            }
        }
    }
}
</script>
