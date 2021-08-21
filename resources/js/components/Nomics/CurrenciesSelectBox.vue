<template>
    <v-autocomplete
        v-model="selected"
        :loading="isLoading"
        :items="items"
        item-text="name"
        item-value="id"
        label="Select"
        return-object
        single-line
        @change="changeSelectedCurrency"
    ></v-autocomplete>
</template>

<script>
import nomics from "../../api/nomics";

export default {
    data() {
        return {
            selected: {},
            items: [],
            isLoading: true,
        }
    },
    async mounted() {
        this.loadItems();
    },
    methods: {
        changeSelectedCurrency: function () {
            this.$emit('currencyChange', this.selected);
        },
        loadItems: async function () {
            this.isLoading = true;
            this.items = await this.getCurrencies();

            if (this.items.length) {
                this.selected = this.items[0];
                this.changeSelectedCurrency();
            }
            this.isLoading = false;
        },
        getCurrencies: async () => {
            try {
                return (await nomics.currencies()).data;
            } catch (exception) {
                alert('exception occurred');
            }
        }
    }
}
</script>
