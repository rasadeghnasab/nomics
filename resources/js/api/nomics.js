export default {
    currencies() {
        return axios.get('nomics/currencies');
    },

    currencyDetail(currenciesIds) {
        return axios.get('nomics/currencies/rate', {
            params: {
                ids: currenciesIds
            }
        })
    }
}
