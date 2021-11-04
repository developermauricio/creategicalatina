<form action="https://gateway.payulatam.com/ppp-web-gateway/">

</form>

'<form action="'.$this->gateway_url.'" method="post" id="payu_latam_form">' . implode('', $payu_args_array)
    . '<input type="submit" id="submit_payu_latam" value="' .__('Pagar', 'payu_latam').'" /></form>';
