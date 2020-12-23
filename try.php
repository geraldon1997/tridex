<script>
    $('#amount_in_dollar').keyup(() => {
        var currency = $('#currency').val();
        var amount = $('#amount').val();

        $.ajax({
            type : 'GET',
            url : 'https://blockchain.info/tobtc?currency='+currency+'&value='+usd,
            success : (data) => {
                $('#btc').val(data);
            }
        })
    })
</script>