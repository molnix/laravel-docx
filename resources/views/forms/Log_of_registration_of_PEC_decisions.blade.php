<div id="Log_of_registration_of_PEC_decisions" class="tab-content tab-content_overflow">
    <div class="popup__wrapper">
        <div class="cl-btn-7" onclick="close_popups()"></div>
        <h2>Журнал регистрации решений УИК</h2>
        <a href="{{route('download_Log_of_registration_of_PEC_decisions',['id'=>$voting->id])}}">Скачать файл</a>
        <form id="Update_Log_of_registration_of_PEC_decisions" class="form_overflow" action="{{route('create_Log_of_registration_of_PEC_decisions',['id'=>$voting->id])}}" method="post">
            @csrf
            <div>
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <td>Дата принятия решения</td>
                        <td>Номер решения</td>
                        <td>Наименование решения</td>
                        <td>Количество листов решения</td>
                        <td>Количество листов приложения</td>
                        <td>Исполнитель</td>
                        <td>Примечание</td>
                        <td>Удалить строку</td>
                    </tr>
                    </thead>
                    <tbody id="Log_of_registration_of_PEC_decisions_table">
                    @if(isset($log_of_registration_of_PEC_decisions))
                        @foreach($log_of_registration_of_PEC_decisions as $log)
                            <tr class="Log_of_registration_of_PEC_decisions_inputs">
                                <td><input type="date" name="date[]" value="{{$log->date}}"></td>
                                <td><input type="text" name="number[]" value="{{$log->number}}"></td>
                                <td><input type="text" name="name[]" value="{{$log->name}}"></td>
                                <td><input type="text" name="number_sheets_decisions[]" value="{{$log->number_sheets_decisions}}"></td>
                                <td><input type="text" name="number_sheets_applications[]" value="{{$log->number_sheets_applications}}"></td>
                                <td><input type="text" name="executor[]" value="{{$log->executor}}"></td>
                                <td><input type="text" name="note[]" value="{{$log->note}}"></td>
                                <td>
                                    <button class="btn-danger-table" type="button" onclick="$(this).closest('.Log_of_registration_of_PEC_decisions_inputs').remove();">Удалить строку</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="block-btn">
                    <button id="Create_Log_of_registration_of_PEC_decisions_Btn" class="btn-blue" type="button">Создать ячейки</button>
                    <button id="Delete_Log_of_registration_of_PEC_decisions_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                </div>
            </div>
            <div class="block-btn">
                <button class="btn-submit" type="submit" form="Update_Log_of_registration_of_PEC_decisions" class="btn">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
