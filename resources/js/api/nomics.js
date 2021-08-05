export default {
    currencies() {
        return axios.get('nomics/currencies');
    },

    currencyRate(currencies_ids) {
        return axios.get('nomics/currencies/rate', {
            params: {
                id: currencies_ids
            }
        })
    }
}
