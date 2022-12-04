    var isOpen = false;
    $(document).ready(function() {
        $('#myTabs a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        })

        $('#btn_movil').click(function(event) {
            if (isOpen) {
                $('.movil').animate({ top: '-594' });
                isOpen = false;
            } else {
                $('.movil').animate({ top: '0px' });
                isOpen = true;
            }
        });


        AOS.init({
            duration: 1200,
            disable: window.innerWidth < 1024
        });

        $('a[href="#section-scroll"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
        });


    });


    function GetURLParameter(argument) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == argument) {
                return sParameterName[1];
            }
        }
    }