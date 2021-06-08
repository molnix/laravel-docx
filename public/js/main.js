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
