/**
 * Created by PracticanteTI1 on 24/05/2016.
 */
/**
 * Documento de JavaScript principal para la sección de Aministrador(Backend)
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 **/

var Menu = {
    initEventsAndProperties: function () {

        $('.sidebar-menu .menu-active').each(function(){
            if(!$(this).hasClass('active')){
                $(this).addClass('active')
            }

            $(this).parents('li').addClass('active');
        });
    }
}