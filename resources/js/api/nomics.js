export default {
    currencies() {
        return axios.get('nomics/currencies');
    },

    currencyRate(currenciesIds) {
        return axios.get('nomics/currencies/rate', {
            params: {
                ids: currenciesIds
            }
        })
    }
}
