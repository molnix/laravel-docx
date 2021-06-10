<div id="Log_of_outgoing_PEC_documents_registration" class="tab-content tab-content_overflow">
    <div class="popup__wrapper">
        <div class="cl-btn-7" onclick="close_popups()"></div>
        <h2>Журнала регистрации исходящих документов УИК</h2>
        <a href="{{route('download_Log_of_outgoing_PEC_documents_registration',['id'=>$voting->id])}}">Скачать файл</a>
        <form id="Update_Log_of_outgoing_PEC_documents_registration" class="form_overflow" action="{{route('create_Log_of_outgoing_PEC_documents_registration',['id'=>$voting->id])}}" method="post">
            @csrf
            <div>
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <td>Дата отправления документа</td>
                        <td>Регистрационный номер</td>
                        <td>Адресат</td>
                        <td>Краткое содержание документа</td>
                        <td>Кто подписал документ</td>
                        <td>Исполнитель</td>
                        <td>Номер дела с копией исходящего документа</td>
                        <td>Удалить строку</td>
                    </tr>
                    </thead>
                    <tbody id="Log_of_outgoing_PEC_documents_registration_table">
                    @if(isset($log_outgoing_documents))
                        @foreach($log_outgoing_documents as $log)
                            <tr class="Log_of_outgoing_PEC_documents_registration_inputs">
                                <td><input type="date" name="date[]" value="{{$log->date}}"></td>
                                <td><input type="text" name="number[]" value="{{$log->number}}"></td>
                                <td><input type="text" name="recipient[]" value="{{$log->recipient}}"></td>
                                <td><input type="text" name="summary_document[]" value="{{$log->summary_document}}"></td>
                                <td><input type="text" name="person_signed_doc[]" value="{{$log->person_signed_doc}}"></td>
                                <td><input type="text" name="executor[]" value="{{$log->executor}}"></td>
                                <td><input type="text" name="case[]" value="{{$log->case}}"></td>
                                <td>
                                    <button class="btn-danger-table" type="button" onclick="$(this).closest('.Log_of_outgoing_PEC_documents_registration_inputs').remove();">Удалить строку</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="block-btn">
                    <button id="Create_Log_of_outgoing_PEC_documents_registration_Btn" class="btn-blue" type="button">Создать ячейки</button>
                    <button id="Delete_Log_of_outgoing_PEC_documents_registration_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                </div>
            </div>
            <div class="block-btn">
                <button class="btn-submit" type="submit" form="Update_Log_of_outgoing_PEC_documents_registration" class="btn">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
