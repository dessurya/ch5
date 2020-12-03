var win = $(window);

// for dekstop
if(win.width() >= 768){
    var initNavbar = 168;
    win.scroll(function () {
        if (win.scrollTop() >= initNavbar) {
            $( "#navigasibar" ).addClass( "scroll" );
        }
        else if (win.scrollTop() <= initNavbar) {
            $( "#navigasibar" ).removeClass( "scroll" );
        }
    });
}
// end for dekstop

// for mobile
if(win.width() <= 768){
    $('#navigasibar #burger-icon').click(function(){
        $('#navigasibar').toggleClass("aktif");
    });
    var initNavbar = 68;
    win.scroll(function () {
        if (win.scrollTop() >= initNavbar) {
            $( "#navigasibar" ).addClass( "scroll_mobile" );
        }
        else if (win.scrollTop() <= initNavbar) {
            $( "#navigasibar" ).removeClass( "scroll_mobile" );
        }
    });
}
// for mobile

// message
    $(function() {
        $('a#op_cu').click(function() {
            $('#message').toggleClass('open');
            if(win.width() <= 768){
                $('#navigasibar').toggleClass("aktif");
            }
        });
        $('#message #box #content #absenM0 img, a.op_cu.btn-link.blue').click(function() {
            if($(this).hasClass('op_cu')){
                $('input[name = subject]').val($(this).data('name'));
                // $('textarea[name = message]').val('Halo, Admin! Please Give More Descript Of '+$(this).data('name'));
            }
            else{
                $('input[name = subject]').val('');
                // $('textarea[name = message]').val('');
            }
            $('#message').toggleClass('open');
        });
    });

    $(function(){
        $(document).on('submit', '#message form', function(){
            var url   = $(this).attr('action');
            var data  = $(this).serializeArray();

            console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data,
                beforeSend: function() {
                    $('#message #box #content .input label').html('').hide();
                    $('#message #box #content #response').show();
                    $('#message #box #content #response label').html('Waiting... Send Your Request...');
                },
                success: function(data) {
                    $('#message #box #content #response label').html(data.msg);
                    if (data.response == false) {
                        $.each(data.resault, function(key, val){
                            $('#message #box #content .input label#e_'+key).html(val).show();
                        });
                        window.setTimeout(function() {
                            $('#message #box #content .input label').html('').hide();
                        }, 2750);
                    }
                    grecaptcha.reset();
                }
            });
            return false;
        });
    });
    

// message

// animate scrool to
    $(function() {
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                        }, 1500);
                    return false;
                }
            }
        });
    });
// animate scrool to
    
