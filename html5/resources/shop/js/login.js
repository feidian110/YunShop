$('.aui-show').click(function() {
                let pass_type = $('input.password').attr('type');

                if (pass_type === 'password') {
                    $('input.password').attr('type', 'text');
                    $('.aui-show').removeClass('operate-eye-open').addClass('operate-eye-close');
                } else {
                    $('input.password').attr('type', 'password');
                    $('.aui-show').removeClass('operate-eye-close').addClass('operate-eye-open');
                }
            });
			