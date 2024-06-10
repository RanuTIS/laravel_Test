<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@latest/dist/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript" src="{{ asset('assets/js/app.js') }}?_<?= time()?>"></script>
<script>
    // Show Plan Widget
    $(document).on('click', '.plans', function() {
        $('.plans_box').show();
    });
    $(document).on('click', '.container,.container-fluid,.containers,.instruction-wrapper', function() {
        $('.plans_box').hide()
    });
    setTimeout(function() {
        shopifyAuthenticatedFetch('/total-login-registration', {
            method: "GET"
        }).then(async (response) => { 
            var result = await response.json();
            console.log(typeof(result.totalLogin));
            var currentPlan = "{{$userPlan}}";
            console.log(currentPlan);
            if (result.status == 200) {
                loginPercent = ((result.totalLogin * 100) / 150).toFixed(2);
                var percentageValue = parseFloat(loginPercent).toFixed();
                // console.log(typeof(parseInt(percentageValue)));
                $('.hMenuStatBlk div.hMenuStatBlkBar span').css('width', parseInt(percentageValue)+"%");  
                // show total in free Plan
                if (currentPlan == "free")
                {
                    var loginTxt = `<strong>` + loginPercent + `%</strong> (` + result.totalLogin + ` of 150 Login This month)`;
                    if(result.totalLogin < 85)
                    {
                        $('.totalLoginProgress, #loginProgress').css('background-color','#70cf80');
                    } 
                }
                // show total in plus plan 
                else
                {
                    var loginTxt = `<strong>` + loginPercent + `%</strong> (` + result.totalLogin + ` Login This month)`;
                    $('.totalLoginProgress, #loginProgress').css('background-color','#70cf80');
                }
                
                $('.hMenuStatBlkDesc').html(loginTxt);
            }
        });
    }, 1000);
</script> 