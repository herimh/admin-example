/**
 * Created by PracticanteTI1 on 24/02/2016.
 */
/**
 * Documento de JavaScript principal para la sección de Aministrador(Backend)
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 **/

var Main = {
    initBasicProperties: function () {

        //Initialize Select2 Elements
        $.fn.select2.defaults.set('language', 'es');
        $(".select2").select2({
            allowClear: true,
            minimumResultsForSearch: 10,
        });

        //Initialize DatePicker Elements
        $('.datepicker').datepicker({
            language: 'es',
            format: 'yyyy-mm-dd'
        });

        //Date range picker
        $('.daterange').daterangepicker({
            format: 'YYYY-MM-DD',
            locale: {
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                fromLabel: 'Del',
                toLabel: 'Al',
                //weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                //daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.months(),
                //firstDay: moment.localeData()._week.dow
            }
        });

        //Initializa X-Editable
        $.fn.editable.defaults.mode = 'popup';
        $('.x-editable').editable();

        //$('input[type="textarea"]').wysihtml5();
        $('textarea').wysihtml5();

        $('.list-action-delete, .show-action-delete').click(function () {
            $(this).submit();
        });


        $(document)
            .on('ifChanged', '.batch-select-all', function (event) {
                if ($(event.target).prop('checked') == true) {
                    $('.batch-item').prop('checked', true);
                } else {
                    $('.batch-item').prop('checked', false);
                }
                Main.generateICheck();
            })
            .on('ifChanged', '.batch-item', function (event) {
                $('.batch-select-all').prop('checked', Main.isAllBatchItemsSelected());
                Main.generateICheck();
            })
            .on('submit', '#submit_batch_action', function(event){
                $(this).append($('input.batch-item').clone());
                return true;
            })
            .on('change', '#setPerPage', function (event){
               $(this).closest('form').submit();
            })
            .on('change', '#form_state_id', function(event){
                console.log('state change');
                loadOptionsForSelect.request($(this).val(), '#form_city_id')
            })
            .on('change', '#billingAddress_state_id', function(event){
                loadOptionsForSelect.request($(this).val(), '#billingAddress_city_id')
            })
            .on('blur', '#billingAddress_zip_code', function(event){
                loadAddressFromApi.request(event, $(this).val(), '#billingAddress_')
            })
            .on('keydown', '#billingAddress_zip_code', function(event){
                if ( event.which == 13 ){
                    loadAddressFromApi.request(event, $(this).val(), '#billingAddress_');
                    return false;
                }
            });

        loadOptionsForSelect = {
            request: function (filterBy, toElement) {
                var params = '?'+$(toElement).data('filter_by') + '='+filterBy;
                var url = $(toElement).data('url') + params;
                Main.ajaxRequest('GET', url, null, loadOptionsForSelect.show, toElement)
            },
            show: function(result, toElement){
                $(toElement).find('option').remove();
                $(toElement).append(result.options);
                $(toElement).select2();
            }
        }

        loadAddressFromApi = {
            request: function (event, filterBy, toForm ) {
                var params = '?'+$(event.target).data('filter_by') + '='+filterBy;
                var url = $(event.target).data('url') + params;
                Main.ajaxRequest('GET', url, null, loadAddressFromApi.show, toForm)
            },
            show: function (result, toForm) {
                $(toForm+'state_id').val(result.state_id);
                $(toForm+'state_id').select2({allowClear: true});

                $(toForm+'city_id').find('option').remove();
                $(toForm+'city_id').append(result.cities);
                $(toForm+'suburb_id').find('option').remove();
                $(toForm+'suburb_id').append(result.suburbs);

                $(toForm+'city_id').select2({allowClear: true});
                $(toForm+'suburb_id').select2({allowClear: true});
            }
        }

        //Initialize other properties

        Main.generateICheck();
    },

    /*---- Realiza todas las peticiones de ajax -------*/
    /**@Param _type: tipo de peticion ej. POST, GET, ...
     /**@Param _ulr: destino de la peticion
     /**@Param _data: datos enviados, normalmente se usan en POST
     /**@Param _callback: funcion a disparar al terminando la peticion
     /**@Param _event: evento que hizo el llamado a esta funcion*/

    ajaxRequest: function (_type, _url, _data, _callback, _event) {
        $.ajax({
            type: _type,
            url: _url,
            data: _data,
            dataType: 'json'
        }).done(function (response) {
            _callback(response, _event);
        }).fail(function (response) {
            /**TODO: mensaje cuando falle la petición*/
        }).always(function () {
            /**TODO: mensaje cuando se halla hecho la peticion */
        })
    },

    generateICheck: function () {
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].full-icheck, input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    },

    isAllBatchItemsSelected: function () {
        var status = true;
        $('.batch-item').each(function(event){
            if ($(this).prop('checked') == false){
                status = false;
                return;
            }
        });

        return status;
    }
}

$(document).ready(function(event){
    Main.initBasicProperties();
    Users.initEventsAndProperties();
    Menu.initEventsAndProperties();
});