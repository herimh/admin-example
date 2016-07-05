Users = {

    initEventsAndProperties: function()
    {
        //Event to compare Password And Repeat Password
        $('#user_edit_form, #user_create_form').find('button[type=submit]').click(function (event) {
            var password = $(this).closest('form').find('#form_password').val();
            var repeatPassword = $(this).closest('form').find('#form_repeat_password').val();

            if (password != repeatPassword){
                $(this).closest('form').find('.unequal-password-label').removeClass('hide');
                return false;
            }
        });
    }

}