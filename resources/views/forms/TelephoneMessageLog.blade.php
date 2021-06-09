<div id="Telephone_message_log" class="tab-content tab-content_overflow">
    <div class="popup__wrapper">
        <div class="cl-btn-7" onclick="close_popups()"></div>
        <h2>Журнал регистрации телефонограмм</h2>
        <a href="{{route('download_telephone_message_log',['id'=>$voting->id])}}">Скачать файл</a>
        <form id="Update_Telephone_message_log" class="form_overflow" action="{{route('create_telephone_message_log',['id'=>$voting->id])}}" method="post">
            @csrf
            <div>
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <td>Регистрационный номер</td>
                        <td>Дата и время принятия/передачи телефонограммы</td>
                        <td>Инициалы, фамилия, передавшего телефонограмму</td>
                        <td>Cтатус лица, передавшего телефонограмму</td>
                        <td>Инициалы, фамилия, принявшего телефонограмму</td>
                        <td>Cтатус лица, принявшего телефонограмму</td>
                        <td>Содержание телефонограммы</td>
                        <td>Примечание</td>
                        <td>Удалить строку</td>
                    </tr>
                    </thead>
                    <tbody id="Telephone_message_log_table">
                    @if(isset($telephone_message_logs))
                        @foreach($telephone_message_logs as $log)
                            <tr class="Telephone_message_log_inputs">
                                <td>
                                    <input type="text" name="number[]" value="{{$log->number}}">
                                </td>
                                <td>
                                    <input type="datetime-local" name="date[]" value="{{date('Y-m-d\TH:i', strtotime($log->date))}}">
                                </td>
                                <td>
                                    <input type="text" name="person_transmitting[]" value="{{$log->person_transmitting}}" placeholder="В. В. Фамилия" list="WorkersDatalist" autocomplete="no">
                                </td>
                                <td>
                                    <input type="text" name="person_transmitting_status[]" value="{{$log->person_transmitting_status}}">
                                </td>
                                <td>
                                    <input type="text" name="person_adopted[]" value="{{$log->person_adopted}}" placeholder="В. В. Фамилия" list="WorkersDatalist" autocomplete="no">
                                </td>
                                <td>
                                    <input type="text" name="person_adopted_status[]" value="{{$log->person_adopted_status}}">
                                </td>
                                <td>
                                    <input type="text" name="content[]" value="{{$log->content}}">
                                </td>
                                <td>
                                    <input type="text" name="note[]" value="{{$log->note}}">
                                </td>
                                <td>
                                    <button class="btn-danger-table" type="button" onclick="$(this).closest('.Telephone_message_log_inputs').remove();">Удалить строку</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="block-btn">
                    <button id="Create_Telephone_message_log_Btn" class="btn-blue" type="button">Создать ячейки</button>
                    <button id="Delete_Telephone_message_log_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                </div>
            </div>
            <div class="block-btn">
                <button class="btn-submit" type="submit" form="Update_Telephone_message_log" class="btn">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
