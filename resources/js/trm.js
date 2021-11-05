import TrmApi from "trm-api";
const trmApi = new TrmApi("tDmDmDSnlAfsO00S2DEJtyTSv");

let currencies = null;
let check = false;
let callbacksSuccess = [];
let callbacksError = [];

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
