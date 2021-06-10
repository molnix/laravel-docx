<div id="Log_of_incoming_documents" class="tab-content tab-content_overflow">
    <div class="popup__wrapper">
        <div class="cl-btn-7" onclick="close_popups()"></div>
        <h2>Журнал регистрации входящих документов</h2>
        <a href="{{route('download_Log_of_incoming_documents',['id'=>$voting->id])}}">Скачать файл</a>
        <form id="Update_Log_of_incoming_documents" class="form_overflow" action="{{route('create_Log_of_incoming_documents',['id'=>$voting->id])}}" method="post">
            @csrf
            <div>
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <td>Дата поступления</td>
                        <td>Регистрационный номер (для обращений граждан номер дополняется индексом «О»)</td>
                        <td>Коррес¬пондент (для обращений граждан также адрес, номер телефона и (или) адрес электронной почты)</td>
                        <td>Номер документа</td>
                        <td>Дата документа</td>
                        <td>Краткое содержание документа</td>
                        <td>Резолюция</td>
                        <td>Исполнитель</td>
                        <td>Дата начала исполнения</td>
                        <td>Дата конца исполнения</td>
                        <td>Отметка об исполнении</td>
                        <td>Номер дела, куда помещен исполненный документ</td>
                        <td>Удалить строку</td>
                    </tr>
                    </thead>
                    <tbody id="Log_of_incoming_documents_table">
                    @if(isset($log_incoming_documents))
                        @foreach($log_incoming_documents as $log)
                            <tr class="Log_of_incoming_documents_inputs">
                                <td><input type="date" name="date_receipt[]" value="{{$log->date_receipt}}"></td>
                                <td><input type="text" name="number[]" value="{{$log->number}}"></td>
                                <td><input type="text" name="correspondent[]" value="{{$log->correspondent}}"></td>
                                <td><input type="text" name="number_doc[]" value="{{$log->number_doc}}"></td>
                                <td><input type="date" name="date_doc[]" value="{{$log->date_doc}}"></td>
                                <td><input type="text" name="content[]" value="{{$log->content}}"></td>
                                <td><input type="text" name="resolution[]" value="{{$log->resolution}}"></td>
                                <td><input type="text" name="executer[]" value="{{$log->executer}}"></td>
                                <td><input type="date" name="term_start[]" value="{{$log->term_start}}"></td>
                                <td><input type="date" name="term_end[]" value="{{$log->term_end}}"></td>
                                <td><input type="text" name="mark[]" value="{{$log->mark}}"></td>
                                <td><input type="text" name="case[]" value="{{$log->case}}"></td>
                                <td>
                                    <button class="btn-danger-table" type="button" onclick="$(this).closest('.Log_of_incoming_documents_inputs').remove();">Удалить строку</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="block-btn">
                    <button id="Create_Log_of_incoming_documents_Btn" class="btn-blue" type="button">Создать ячейки</button>
                    <button id="Delete_Log_of_incoming_documents_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                </div>
            </div>
            <div class="block-btn">
                <button class="btn-submit" type="submit" form="Update_Log_of_incoming_documents" class="btn">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
