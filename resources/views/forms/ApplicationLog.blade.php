<div id="ApplicationLog" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>Журнал заявлений</h2>
                <a href="{{route('download_application_log',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdateApplicationLog" class="form_overflow" action="{{route('create_application_log',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <div class="fields">
                        <label for="">Дата в заголовке:</label>
                        <input type="text" placeholder="01.01.2021" name="main_date" style="max-width:200px;"
                               @if(isset($application_logs->date))
                               value="{{$application_logs->date}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">ОБЩЕРОССИЙСКОЕ ГОЛОСОВАНИЕ:</label>
                        <input type="text" placeholder="по вопросу одобрения изменений в Конституцию Российской Федерации" name="for_question" style="max-width:500px;"
                               @if(isset($application_logs->for_question))
                               value="{{$application_logs->for_question}}"
                            @endif
                        >
                    </div>
                    <div>
                        <table style="width:100%;">
                            <thead>
                            <tr>
                                <td>№</td>
                                <td>Дата</td>
                                <td>Время</td>
                                <td>Фамилия, имя, отчество участника голосования</td>
                                <td>Адрес</td>
                                <td>Фамилия и инициалы лица принявшего заявление</td>
                                <td>Примечание</td>
                                <td>Удалить строку</td>
                            </tr>
                            </thead>
                            <tbody id="ApplicationLogTable">
                            @if(isset($application_logs->application_log_data))
                                @foreach($application_logs->application_log_data as $application_log)
                                    <tr class="application_log_inputs">
                                        <td>
                                            <input type="number" name="number[]" value="{{$application_log->number}}">
                                        </td>
                                        <td>
                                            <input type="date" name="date[]" value="{{$application_log->date}}">
                                        </td>
                                        <td>
                                            <input type="text" name="time[]" value="{{$application_log->time}}">
                                        </td>
                                        <td>
                                            <input type="text" name="participant_name[]" list="WorkersDatalist" value="{{$application_log->participant_name}}" autocomplete="no">
                                        </td>
                                        <td>
                                            <input type="text" name="adress[]" value="{{$application_log->adress}}">
                                        </td>
                                        <td>
                                            <input type="text" name="person_accepted_name[]" list="WorkersDatalist" value="{{$application_log->person_accepted_name}}" autocomplete="no">
                                        </td>
                                        <td>
                                            <input type="text" name="note[]" value="{{$application_log->note}}">
                                        </td>
                                        <td>
                                            <button class="btn-danger-table" type="button" onclick="$(this).closest('.application_log_inputs').remove();">Удалить строку</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="block-btn">
                            <button id="CreateApplicationLogBtn" class="btn-blue" type="button">Создать ячейки</button>
                            <button id="DeleteApplicationLogBtn" class="btn-danger" type="button">Удалить ячейки</button>
                        </div>
                    </div>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdateApplicationLog" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>