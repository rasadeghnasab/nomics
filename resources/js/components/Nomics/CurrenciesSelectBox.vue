<template>
    <v-autocomplete
        v-model="selected"
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
        }
    },
    async mounted() {
        this.items = (await this.getCurrencies()).data;

        if (this.items.length) {
            this.selected = this.items[0];
            this.changeSelectedCurrency();
        }
    },
    methods: {
        changeSelectedCurrency: function() {
            this.$emit('currencyChange', this.selected);
        },
        getCurrencies: async () => {
            try {
                return await nomics.currencies();
            } catch (exception) {
                alert('exception occurred');
            }
        }
    }
}
</script>
