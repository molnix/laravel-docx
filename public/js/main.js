$(document).ready(function (){
    $('#files-input').on('change', function(){
        $('#count-input-files').html("Файлов выбранно: "+this.files.length);
    });

    $( "#CreateInputBtn" ).click(function() {
        $('#WorkersList').append("<div class='input-worker'> Сотрудник:</br> <input type='text' name='workers[]'></br> Место работы:</br> <input type='text' name='workers_workplace[]'></br> <button class='btn-list-danger' type='button' onclick='$(this).parent().remove();'>Удалить поле</button> </div>");
    });
    $( "#DeleteInputBtn" ).click(function() {
        $(".input-worker:last-child").remove();
    });

    $("#CreateApplicationLogBtn").click(function(){
        $("#ApplicationLogTable").append('<tr class="application_log_inputs"><td><input type="number" name="number[]"></td><td><input type="date" name="date[]"></td><td><input type="text" name="time[]"></td><td><input type="text" name="participant_name[]" list="WorkersDatalist" autocomplete="no"></td><td><input type="text" name="adress[]"></td><td><input type="text" name="person_accepted_name[]" list="WorkersDatalist" autocomplete="no"></td><td><input type="text" name="note[]"></td><td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.application_log_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#DeleteApplicationLogBtn").click(function(){
        $(".application_log_inputs:last-child").remove();
    });

    $("#CreateList_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_Btn").click(function(){
        $("#List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_Table").append('<tr class="List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_inputs"><td><input type="text" name="name[]" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"></td><td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#DeleteList_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_Btn").click(function(){
        $(".List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_inputs:last-child").remove();
    });

    $("#CreateList_oznakomleniya_c_protokolom_and_resheniyami_Btn").click(function(){
        $("#List_oznakomleniya_c_protokolom_and_resheniyami_Table").append('<tr class="List_oznakomleniya_c_protokolom_and_resheniyami_inputs"><td><input type="text" name="name[]" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"></td><td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.List_oznakomleniya_c_protokolom_and_resheniyami_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#DeleteList_oznakomleniya_c_protokolom_and_resheniyami_Btn").click(function(){
        $(".List_oznakomleniya_c_protokolom_and_resheniyami_inputs:last-child").remove();
    });

    $("#CreateVotingCountVotesPersonsListBtn").click(function(){
        $("#VotingCountVotesPersonsListTable").append('<tr class="voting_count_votes_persons_list_inputs"><td><input type="number" name="number[]"></td><td><input type="text" name="name[]" list="WorkersDatalist" autocomplete="no"></td> <td><input type="text" name="status[]"></td> <td><input type="text" name="represent[]" list="WorkersDatalist" autocomplete="no"></td> <td><input type="text" name="contact[]"></td> <td><input type="text" name="hours_start[]"></td> <td><input type="text" name="minuts_start[]"></td> <td><input type="text" name="hours_end[]"></td> <td><input type="text" name="minuts_end[]"></td> <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.voting_count_votes_persons_list_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#DeleteVotingCountVotesPersonsListBtn").click(function(){
        $(".voting_count_votes_persons_list_inputs:last-child").remove();
    });

    $("#Create_Telephone_message_log_Btn").click(function(){
        $("#Telephone_message_log_table").append('<tr class="Telephone_message_log_inputs"> <td><input type="text" name="number[]"></td><td><input type="datetime-local" name="date[]"></td><td><input type="text" name="person_transmitting[]" placeholder="В. В. Фамилия" list="WorkersDatalist" autocomplete="no"></td><td><input type="text" name="person_transmitting_status[]"></td><td><input type="text" name="person_adopted[]" placeholder="В. В. Фамилия" list="WorkersDatalist" autocomplete="no"></td><td><input type="text" name="person_adopted_status[]"></td><td><input type="text" name="content[]"></td><td><input type="text" name="note[]"></td>   <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.Telephone_message_log_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#Delete_Telephone_message_log_Btn").click(function(){
        $(".Telephone_message_log_inputs:last-child").remove();
    });

    $("#Create_Register_of_applications_appeals_for_voting_outside_the_voting_premises_Btn").click(function(){
        $("#Register_of_applications_appeals_for_voting_outside_the_voting_premises_table").append('<tr class="Register_of_applications_appeals_for_voting_outside_the_voting_premises_inputs"><td><input type="text" name="voter_name[]" placeholder="Фамилия Имя Отчество"></td><td><input type="text" name="voter_address[]"></td><td><input type="text" name="reason_calling_commission[]"></td><td><input type="datetime-local" name="datetime_oral_appeal[]"></td><td><input type="datetime-local" name="datetime_written_appeal[]"></td><td><input type="text" name="name_transmitting_appeal[]" placeholder="Фамилия Имя Отчество"></td><td><input type="text" name="address_transmitting_appeal[]"></td><td><input type="text" name="name_accepted_appeal[]" placeholder="Фамилия Имя Отчество" list="WorkersDatalist"></td>   <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.Register_of_applications_appeals_for_voting_outside_the_voting_premises_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#Delete_Register_of_applications_appeals_for_voting_outside_the_voting_premises_Btn").click(function(){
        $(".Register_of_applications_appeals_for_voting_outside_the_voting_premises_inputs:last-child").remove();
    });

    $("#Create_Register_registration_issuance_certified_copies_Btn").click(function(){
        $("#Register_registration_issuance_certified_copies_table").append('<tr class="Register_registration_issuance_certified_copies_inputs"><td><input type="text" name="number[]"></td><td><input type="text" name="person_accepted_protocol[]" placeholder="Фамилия Имя Отчество"></td><td><input type="text" name="person_accepted_protocol_status[]"></td><td><input type="text" name="personal_assured_name[]" placeholder="И. О. Фамилия" list="MainWorkers" autocomplete="no"></td><td><input type="datetime-local" name="datetime_issuing[]"></td><td><input type="text" name="telephone[]"></td>   <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.Register_registration_issuance_certified_copies_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#Delete_Register_registration_issuance_certified_copies_Btn").click(function(){
        $(".Register_registration_issuance_certified_copies_inputs:last-child").remove();
    });

    $("#Create_Log_of_registration_of_PEC_decisions_Btn").click(function(){
        $("#Log_of_registration_of_PEC_decisions_table").append('<tr class="Log_of_registration_of_PEC_decisions_inputs"><td><input type="date" name="date[]"></td><td><input type="text" name="number[]"></td><td><input type="text" name="name[]"></td><td><input type="text" name="number_sheets_decisions[]"></td><td><input type="text" name="number_sheets_applications[]"></td><td><input type="text" name="executor[]"></td><td><input type="text" name="note[]"></td>   <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.Log_of_registration_of_PEC_decisions_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#Delete_Log_of_registration_of_PEC_decisions_Btn").click(function(){
        $(".Log_of_registration_of_PEC_decisions_inputs:last-child").remove();
    });
<<<<<<< HEAD

    $("#Create_Log_of_incoming_documents_Btn").click(function(){
        $("#Log_of_incoming_documents_table").append('<tr class="Log_of_incoming_documents_inputs"><td><input type="date" name="date_receipt[]"></td><td><input type="text" name="number[]"></td><td><input type="text" name="correspondent[]"></td><td><input type="text" name="number_doc[]"></td><td><input type="date" name="date_doc[]"></td><td><input type="text" name="content[]"></td><td><input type="text" name="resolution[]"></td><td><input type="text" name="executer[]"></td><td><input type="date" name="term_start[]"></td><td><input type="date" name="term_end[]"></td><td><input type="text" name="mark[]"></td><td><input type="text" name="case[]"></td>   <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.Log_of_incoming_documents_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#Delete_Log_of_incoming_documents_Btn").click(function(){
        $(".Log_of_registration_of_PEC_decisions_inputs:last-child").remove();
    });

    $("#Create_Log_of_outgoing_PEC_documents_registration_Btn").click(function(){
        $("#Log_of_outgoing_PEC_documents_registration_table").append('<tr class="Log_of_outgoing_PEC_documents_registration_inputs"><td><input type="date" name="date[]"></td><td><input type="text" name="number[]"></td><td><input type="text" name="recipient[]"></td><td><input type="text" name="summary_document[]"></td><td><input type="text" name="person_signed_doc[]"></td><td><input type="text" name="executor[]"></td><td><input type="text" name="case[]"></td>   <td><button class="btn-danger-table" type="button" onclick="$(this).closest('+"'.Log_of_outgoing_PEC_documents_registration_inputs'"+').remove();">Удалить строку</button></td></tr>');
    });
    $("#Delete_Log_of_outgoing_PEC_documents_registration_Btn").click(function(){
        $(".Log_of_outgoing_PEC_documents_registration_inputs:last-child").remove();
    });
=======
>>>>>>> 424386cfa9fc2585fd7fa33671fe4f14418ecbed
});
function open_popup(id){
    $(id).css({
        'display': 'block',
    });
    $('body').addClass('lock');
}
function close_popups(){
    $('.tab-content').css({
        'display':'none',
    });
    $('body').removeClass('lock');
}
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }

    });


})(jQuery);
