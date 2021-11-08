import TrmApi from "trm-api";
const trmApi = new TrmApi("tDmDmDSnlAfsO00S2DEJtyTSv");

let currencies = null;
let check = false;
let callbacksSuccess = [];
let callbacksError = [];

const numberFormat =  new Intl.NumberFormat('es-co', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
});

const getDataApi = () => {
    check = true;
    trmApi.latest().then(response => {
        currencies = {
            COP: {
                value: 1,
                unit: 'COP',
                config: {
                    style: 'currency',
                    currency: 'COP',
                    minimumFractionDigits: 0
                }
            },
            USD: {
                value: parseFloat(response.valor),
                unit: response.unidad,
                config: {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 0
                }
            }
        };
        callbacksSuccess.forEach(s => {
            s(currencies)
        });
    }).catch(err => {
        console.log(err);
        callbacksError.forEach(e => {
            e(err)
        });
    });
}

export const formatCurrency =  (number, config = null) =>  {
    if (config){
        if (window.lang == "en"){
            return new Intl.NumberFormat('en', config).format(number);
        }
        return new Intl.NumberFormat('es-co', config).format(number);
    }
    return numberFormat.format(number);
};

export const formatValue = (value, to, type = 'COP') => {
    if (!currencies) {
        return null;
    }

    if (type == to){
        return value;
    }

    if (currencies[type].unit == type) {
        const currency = currencies[to];
        return value / currency.value;
    } else {
        console.error("falta implementar");
        return 99999999;
    }
}

export const fullFormatValue = (value, to, type = 'COP') => {
    if (!to){
        to = window.currency;
    }
    const data = currencies[to];
    if (data){
        const price = formatValue(value, to, type = 'COP');
        return formatCurrency(price, data.config);
    }
    return null;
}

export const getCurrencies = (cbSuccess, cbError = null) => {
    if (currencies) {
        cbSuccess(currencies)
        return;
    }

    callbacksSuccess.push(cbSuccess);
    if (cbError) {
        callbacksError.push(cbError);
    }
    if (check) {
        return;
    }
    getDataApi()
}


getDataApi();
