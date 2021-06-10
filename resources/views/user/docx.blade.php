<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}" defer></script>
    <script src="{{asset('js/main.js')}}" defer></script>
    <link rel="stylesheet" href="{{asset('css/docx.css')}}">
    <title>Documents</title>
</head>
<body>
@include('user.header')

<main id="Main" class="main">
    <div class="left-part">
        <div class="form__wrapper">
            <h2>Добавить новые документы</h2>
            <form class="form-input-files" action="{{route('create_new_documents',['id'=>$voting->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="fields">
                    <label class="btn-files" for="files-input">Выбрать новые файлы</label>
                    <p id="count-input-files"></p>
                    <input id="files-input" type="file" name="files[]" multiple style="display:none;">
                </div>
                <div class="fields">
                    <input class="btn-submit" type="submit" value="Загрузить новые файлы">
                </div>
            </form>
        </div>

        <div class="form__wrapper">
        <h2>Отметьте нужные акты и прочее</h2>
                <form class="form-input-documents" action="{{route('update_documents',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <div class="form-input-documents_list overflow-avto">
                        @foreach($documents as $document)
                            <div class="documents_list_item">
                                @if(in_array($document->id, $selected_documents->pluck('id')->toArray()))
                                    <div class="fields">
                                        <p>{{$document->name}}</p>
                                        <input checked type="checkbox" name="files[]" value="{{$document->id}}">
                                    </div>
                                @else
                                    <div class="fields">
                                        <p>{{$document->name}}</p>
                                        <input class="checkbox" type="checkbox" name="files[]" value="{{$document->id}}">
                                    </div>
                                @endif
                                <a class="btn-danger" href="{{route('delete_document',['id'=>$voting->id,'document_id'=>$document->id])}}">Удалить файл</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="fields">
                        <input class="btn-submit" type="submit" value="Сохранить">
                    </div>
                </form>
        </div>
    </div>

    <div class="right-part">
        <div class="form__wrapper">
            <h2>Список редактируемых документов:</h2>
            <ul class="tab-block">
                <li><button type="button" onclick="open_popup('#WorkPlan')">План работы УИК в период проведения выборов</button></li>
                <li><button type="button" onclick="open_popup('#PlanSolution')">Решение о плане работы</button></li>
                <li><button type="button" onclick="open_popup('#FireInstruction')">Инструкция о мерах пожарной безопасности на избирательном участке</button></li>
                <li><button type="button" onclick="open_popup('#List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti')">Лист ознакомления с правилами пожарной безопасности</button></li>
                <li><button type="button" onclick="open_popup('#List_oznakomleniya_c_protokolom_and_resheniyami')">Лист ознакомления с протоколом и решениями</button></li>
                <li><button type="button" onclick="open_popup('#VotingCountVotesPersonsList')">СПИСОК лиц, присутствовавших при проведении голосования, подсчете голосов избирателей</button></li>

                <li><button type="button" onclick="open_popup('#Telephone_message_log')">Журнал регистрации телефонограмм</button></li>
                <li><button type="button" onclick="open_popup('#Register_of_applications_appeals_for_voting_outside_the_voting_premises')">РЕЕСТР заявлений (обращений) о голосовании вне помещения для голосования</button></li>
                <li><button type="button" onclick="open_popup('#Register_registration_issuance_certified_copies')">РЕЕСТР регистрации выдачи заверенных копий протокола участковой избирательной комиссии об итогах голосования по выборам</button></li>
                <li><button type="button" onclick="open_popup('#Log_of_registration_of_PEC_decisions')">Журнал регистрации решений УИК</button></li>
                <li><button type="button" onclick="open_popup('#Log_of_incoming_documents')">Журнал регистрации входящих документов</button></li>
                <li><button type="button" onclick="open_popup('#Log_of_outgoing_PEC_documents_registration')">Журнала регистрации исходящих документов УИК</button></li>

                <li><button type="button" onclick="open_popup('#EquipmentSolution')">Решение о схеме размещения оборудования</button></li>
                <li><button type="button" onclick="open_popup('#ApplicationLog')">Журнал заявлений</button></li>
            </ul>
        </div>

        <div class="form-update-main-data">
            <div class="form__wrapper">
                <form id="UpdateVoting" action="{{route('update_voting',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <h2>Изменить основные данные</h2>
                    <div class="fields">
                        <p><label for="">Вид голосования:</label></br>
                        <input id="input_voting_type_name" list="voting_type_name" type="text" name="voting_type_name"></p>
                        <datalist id="voting_type_name">
                            @foreach($voting_types as $voting_type)
                                @if($voting->voting_type_id==$voting_type->id)
                                    <option id="datalist_selected" value="{{$voting_type->name}}"></option>
                                @else
                                    <option value="{{$voting_type->name}}"></option>
                                @endif
                            @endforeach
                        </datalist>
                    </div>
                    <div class="fields">
                        <p><label for="">Номер участка:</label></br>
                        <input type="number" name="plot_number" value="{{$voting->plot_number}}"></p>
                    </div>
                    <div class="fields">
                        <p><label for="">День голосования:</label></br>
                        <input type="text" name="voting_day" value="{{$voting->voting_day}}"></p>
                    </div>
                    <div class="fields">
                        <p><label for="voting_type_name">Председатель:</label></br>
                        <input type="text" name="chairman" value="{{$chairman->name}}"></br>
                        <label for="voting_type_name">Место работы:</label></br>
                        <input type="text" name="chairman_workplace" value="{{$chairman->workplace}}"></p>
                    </div>
                    <div class="fields">
                        <p><label for="">Заместитель председателя:</label></br>
                        <input type="text" name="vice_chairman" value="{{$vice_chairman->name}}"></br>
                        <label for="">Место работы:</label></br>
                        <input type="text" name="vice_chairman_workplace" value="{{$vice_chairman->workplace}}"></p>
                    </div>
                    <div class="fields">
                        <p><label for="">Секретарь:</label></br>
                        <input type="text" name="secretary" value="{{$secretary->name}}"></br>
                        <label for="">Место работы:</label></br>
                        <input type="text" name="secretary_workplace" value="{{$secretary->workplace}}"></p>
                    </div>

                    <h3>Штат сотрудников:</h3>
                    <div id="WorkersList" class="workers_list overflow-avto">
                        @foreach($workers as $worker)
                            <div class='fields list-border'>
                                <p><label for="">Сотрудник:</label></br>
                                <input class='input100' type='text' name='workers[]' value='{{$worker->name}}'></br>
                                <label for="">Место работы:</label></br>
                                <input class='input100' type='text' name='workers_workplace[]' value='{{$worker->workplace}}'></br>
                                <button class='btn-list-danger' type='button' onclick='$(this).parent().remove();'>
                                    Удалить поле
                                </button></p>
                            </div>
                        @endforeach
                    </div>
                    <div class="block-btn">
                        <button id="CreateInputBtn" class="btn-blue" type="button">
                            + Добавить поле
                        </button>
                        <button id="DeleteInputBtn" class="btn-danger" type="button">
                            - Удалить поле
                        </button>
                    </div>
                    <div class="block-btn">
                        <button id="CreateVotingBtn" class="btn-submit" type="submit" form="UpdateVoting" class="btn">
                            Обновить данные о голосовании
                        </button>
                    </div>
                </form>
            </div>
            <div class="form__wrapper">
                <form id="DownloadDocuments" method="post">
                    @csrf
                    <h2>Скачать документы</h2>
                    <button class="btn-submit" type="submit" form="DownloadDocuments" class="btn">
                        Скачать документы
                    </button>
                </form>
            </div>

        </div>

        @include('forms.VotingCountVotesPersonsList')
        @include('forms.ApplicationLog')
        @include('forms.List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti')
        @include('forms.List_oznakomleniya_c_protokolom_and_resheniyami')
        @include('forms.FireInstruction')
        @include('forms.WorkPlan')
        @include('forms.EquipmentSolution')
        @include('forms.PlanSolution')
        @include('forms.TelephoneMessageLog')
        @include('forms.Register_of_applications_(appeals)_for_voting_outside_the_voting_premises')
        @include('forms.Register_of_registration_issuance_of_certified_copies_of_the_protocol_of_the_precinct_election_commission_on_the_results_of_voting_on_elections')
        @include('forms.Log_of_registration_of_PEC_decisions')
        @include('forms.Log_incoming_documents')
        @include('forms.Log_of_outgoing_PEC_documents_registration')
        <datalist id="WorkersDatalist">
        @foreach($voting->workers as $worker)
        <option value="{{$worker->name}}">{{$worker->name}}</option>
        @endforeach
        </datalist>
        <datalist id="MainWorkers">
            @foreach($main_workers as $worker)
                <option value="{{$worker}}">{{$worker}}</option>
            @endforeach
        </datalist>
    </div>
</main>


    <script>
        let selected = document.getElementById('datalist_selected');
        let datalist = document.getElementById('input_voting_type_name');
        datalist.value = selected.value;
    </script>
</body>
</html>
